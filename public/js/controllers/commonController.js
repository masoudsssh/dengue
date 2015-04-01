	// dengueApp version 1.0

	// create the controller and inject Angular's $scope
	dengueApp.controller('commonController', function($scope, $http, $modal, $rootScope, $location) {	
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

			modalInstance.result.then(function (selectedItem) {
				obj = $(".header-link").parent();
				obj.find(".header-link").hide();
				obj.find('.header-link-logout').show();
				$("#user-info #user-name").html(selectedItem).show();
				$("#user-info").show();
				$location.path('/dashboard');
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

	dengueApp.controller('faqController', function($scope, $http) {	
		$scope.oneAtATime = true;

		$scope.groups = [
		{
			title: 'Is account registration required?',
			content: 'Account registration at KBD is only required if you will be selling or buying themes. This ensures a valid communication channel for all parties involved in any transactions. '
		},
		{
			title: 'Is this the latest version of an item?',
			content: 'Each item in KBD is maintained to its latest version. This ensures its smooth operation.'
		},
		{
			title: 'Is account registration required?',
			content: 'Account registration at KBD is only required if you will be selling or buying themes. This ensures a valid communication channel for all parties involved in any transactions. '
		},
		{
			title: 'Is this the latest version of an item?',
			content: 'Each item in KBD is maintained to its latest version. This ensures its smooth operation.'
		},
		{
			title: 'Is account registration required?',
			content: 'Account registration at KBD is only required if you will be selling or buying themes. This ensures a valid communication channel for all parties involved in any transactions. '
		},
		{
			title: 'Is this the latest version of an item?',
			content: 'Each item in KBD is maintained to its latest version. This ensures its smooth operation.'
		}
		];

		$scope.status = {
			isFirstOpen: true,
			isFirstDisabled: false
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
					$modalInstance.close(data.message.name);
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
			$location.path('/index');
		}).
		error(function(error) {
			$scope.status = 'Unable to logout: ' + error.message;
		});

	});


	dengueApp.controller('profileController', function($scope, $http, $modal, $rootScope, $location, userModel) {	
		$scope.updateProfile = function(){
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
	});
