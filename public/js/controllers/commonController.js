	// dengueApp version 1.0

	// create the controller and inject Angular's $scope
	dengueApp.controller('commonController', function($scope, $http, $modal, $rootScope, $location) {	
		if( $rootScope.role!=2 ){
			$("#create-news").hide();
			$("#controlkitLink").hide();
		}else{
			$("#create-news").show();
			$("#controlkitLink").show();
		}

		$scope.openLoginModal = function (size) {
			var modalInstance = $modal.open({
				templateUrl: '/loginModal.html',
				controller: 'loginController',
				size: size,
				resolve: {
					params: function () {
						return '';//$scope.params;
					}
				}
			});

			modalInstance.result.then(function (params) {
				obj = $(".header-link").parent();
				obj.find(".header-link").hide();
				obj.find('.header-link-logout').show();
				var param = params.split(',');

				if( param[2]!="" ){
					$('#profileImage').attr("src", param[2]);
				}
				$("#user-info #user-name").html(param[0]).show();
				$("#user-info").show();
				
				$rootScope.role = param[1];

				if( $rootScope.role!=2 ){
					$("#create-news").hide();
					$("#controlkitLink").hide();
				}else{
					$("#create-news").show();
					$("#controlkitLink").show();
				}

				$location.path('/index');
				//$rootScope.$$phase || $rootScope.$apply();
			}, function () {
				//$log.info('Modal dismissed at: ' + new Date());
			});
		};


		$scope.openSignupModal = function (size) {
			var modalInstance = $modal.open({
				templateUrl: '/signupModal.html',
				controller: 'signupController',
				size: size,
				resolve: {
					params: function () {
						return '';//$scope.params;
					}
				}
			});

			modalInstance.result.then(function (selectedItem) {
				$rootScope.$$phase || $rootScope.$apply();
			}, function () {
				//$log.info('Modal dismissed at: ' + new Date());
			});
		};


	});




	dengueApp.controller('loginController', function($scope, $http, $modalInstance, userModel) {	
		$scope.cancel = function () {
			$modalInstance.dismiss('cancel');
		};

		$scope.login = function () {
			var newCredential = {
				email: $scope.username,
				password: $scope.password
			};

			userModel.login( newCredential )
			.success(function (data) {
				if(data.status==200){
					$modalInstance.close(data.message.name+","+data.message.role_id+","+data.message.image);
				}else{
					$('#loginAlert').html("<li>"+data.message+"</li>").show();
				}
			}).
			error(function(error) {
				$scope.status = 'Unable to login: ' + error.message;
			});
		};
	});

	dengueApp.controller('signupController', function($scope, $http, $modalInstance, FileUploader, userModel) {	
		$scope.cancel = function () {
			$modalInstance.dismiss('cancel');
		};

		$scope.signup = function () {
			var newUser = {
				name: $scope.name,
				email: $scope.username,
				password: $scope.password,
				password_confirmation: $scope.password_confirmation
			};

			userModel.insertUser( newUser )
			.success(function (data) {
				if(data.status==200){
					$modalInstance.close(newUser);
				}
			}).
			error(function(error) {
				msg = "";
				$.each(error, function(idx, obj) {
				  msg += "<li>"+obj[0]+"</li>";
				});
				$('#signupAlert').html(msg).show();
				$scope.status = 'Unable to signup: ' + error.message;
			});
		};
	});


	dengueApp.controller('logoutController', function($scope, $http, $modal, $rootScope, $location, userModel) {	
		
		userModel.logout()
		.success(function (data) {
			obj = $(".header-link").parent();
			obj.find(".header-link").show();
			obj.find('.header-link-logout').hide();
			$("#user-info").hide();
			$rootScope.role=0;
			$location.path('/index');
		}).
		error(function(error) {
			$scope.status = 'Unable to logout: ' + error.message;
		});

	});


	dengueApp.controller('profileController', function($scope, $http, $modal, $rootScope, $location, FileUploader, userModel) {	
		var uploader = $scope.uploader = new FileUploader({
            url: '/upload'
        });

		$scope.updateProfile = function(){
			if( $('#updateProfile input[type="file"]').val()==""){
				var user = {
					name: $scope.name,
					email: $scope.username,
					password: $scope.password,
					password_confirmation: $scope.password_confirmation
				};

				userModel.updateUser( user )
				.success(function (data) {
					if(data.status==200){
						$("#user-info #user-name").html($scope.name).show();
						$('#profileAlert').hide();
						$('#profileInfoAlert').html(data.message).show();
					}
				}).
				error(function(error) {
					msg = "";
					$.each(error, function(idx, obj) {
						msg += "<li>"+obj[0]+"</li>";
					});
					$('#profileInfoAlert').hide();
					$('#profileAlert').html(msg).show();
					$scope.status = 'Unable to update profile: ' + error.message;
				});
			}
		}


		uploader.onCompleteAll = function(){
			var user = {
				name: $scope.name,
				email: $scope.username,
				password: $scope.password,
				password_confirmation: $scope.password_confirmation
			};

			userModel.updateUser( user )
			.success(function (data) {
				if(data.status==200){
					$("#user-info #user-name").html($scope.name).show();

					$('#profileImage').attr("src", data.user.image);
					$('#profileAlert').hide();
					$('#profileInfoAlert').html(data.message).show();
				}
			}).
			error(function(error) {
				msg = "";
				$.each(error, function(idx, obj) {
					msg += "<li>"+obj[0]+"</li>";
				});
				$('#profileInfoAlert').hide();
				$('#profileAlert').html(msg).show();
				$scope.status = 'Unable to update profile: ' + error.message;
			});
		}

	});
