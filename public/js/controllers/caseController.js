	// dengueApp version 1.0

	// create the controller and inject Angular's $scope
	dengueApp.controller('caseController', function($scope, $http, $modal, $rootScope, caseModel) {	
		// var addthis_config = {"data_track_addressbar":true};
		caseModel.getCases()
		.success(function (data) {
			$scope.cases = data ;
		})
		.error(function (error) {
	        //  $scope.status = 'Unable to load customer data: ' + error.message;
	    });

		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=630143383797876&version=v2.0";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

	    $scope.open = function (size) {
			var modalInstance = $modal.open({
				templateUrl: '/newCaseReportModal.html',
				controller: 'storeCaseReportController',
				size: size,
				resolve: {
					params: function () {
						return '';//$scope.params;
					}
				}
			});

			modalInstance.result.then(function (selectedItem) {
				caseModel.getCases()
				.success(function (data) {
					$scope.cases = data ;
				})
				.error(function (error) {
			        //  $scope.status = 'Unable to load customer data: ' + error.message;
			    });
				$rootScope.$$phase || $rootScope.$apply();
			}, function () {
				//$log.info('Modal dismissed at: ' + new Date());
			});
		};

		$scope.openNewsModal = function (size) {

			var modalInstance = $modal.open({
				templateUrl: '/newsModal.html',
				controller: 'storeNewsController',
				size: size,
				resolve: {
					params: function () {
						return '';//$scope.params;
					}
				}
			});

			modalInstance.result.then(function (selectedItem) {
				caseModel.getCases()
				.success(function (data) {
					$scope.cases = data ;
				})
				.error(function (error) {
			        //  $scope.status = 'Unable to load customer data: ' + error.message;
			    });
				$rootScope.$$phase || $rootScope.$apply();
			}, function () {
				//$log.info('Modal dismissed at: ' + new Date());
			});
		};


		var cityPoints = {};
		cityPoints[0] = {
			center: new google.maps.LatLng(3.858113, 101.999798),
			id: 0,
			addr: '<b>Nama Lokaliti Wabak :</b> APT SEMARAK BB <br/> <b>Tempoh Masa Wabak Berlaku :</b> 4',
			magnitude: 3000
		};
		cityPoints[1] = {
			center: new google.maps.LatLng(3.714352, 102.000073),
			id: 1, 
			addr: '<b>Nama Lokaliti Wabak :</b> APT SEMARAK BB <br/> <b>Tempoh Masa Wabak Berlaku :</b> 14',
			magnitude: 2500
		};
		cityPoints[2] = {
			center: new google.maps.LatLng(3.552234, 101.943684),
			id: 2,
			addr: '<b>Nama Lokaliti Wabak :</b> APT SEMARAK BB <br/> <b>Tempoh Masa Wabak Berlaku :</b> 24',
			magnitude: 5000
		}
		var cityCircle;
		var infoWindow = new google.maps.InfoWindow();  

		function initialize() {
			var mapOptions = {
				zoom: 9,
				center: new google.maps.LatLng(3.552234, 101.943684),
				mapTypeId: google.maps.MapTypeId.TERRAIN
			};

			var map = new google.maps.Map(document.getElementById('map-canvas'),
				mapOptions);

			for (i in cityPoints) {
				var magnitudeOptions = {
					strokeColor: '#FF0000',
					strokeOpacity: 0.8,
					strokeWeight: 2,
					fillColor: '#FF0000',
					fillOpacity: 0.35,
					map: map,
					center: cityPoints[i].center,
					radius: cityPoints[i].magnitude,
					id:cityPoints[i].id,
					addr:cityPoints[i].addr,
					infoWindowIndex: i
				};
				cityCircle = new google.maps.Circle(magnitudeOptions);

				google.maps.event.addListener(cityCircle, 'click', (function(cityCircle, i) {
					return function() {
						infoWindow.setContent(cityPoints[i].addr);
						infoWindow.setPosition(cityCircle.getCenter());
						infoWindow.open(map);
					}
				})(cityCircle, i));
			}
		}
		google.maps.event.addDomListener(window, 'load', initialize);

	});


	dengueApp.controller('storeCaseReportController', function($scope, $http, $modalInstance, FileUploader, caseModel) {	
		$scope.cancel = function () {
			$modalInstance.dismiss('cancel');
		};

		var uploader = $scope.uploader = new FileUploader({
            url: '/upload'
        });

        $scope.submitCase = function () {
			if( $('#createCase input[type="file"]').val()==""){
				$('#createCaseAlert').show();
				$scope.attachment = 'The attachment field is required.';
			}
		};

        uploader.onCompleteAll = function(){
			var newCase = {
				description: $scope.description,
				title: $scope.title,
				category: 2
			};
			caseModel.insertCase( newCase )
			.success(function () {
				$modalInstance.close(newCase);
			}).
			error(function(error) {
				$scope.status = 'Unable to insert ticket: ' + error.message;
			});
		};
	});

	dengueApp.controller('storeNewsController', function($scope, $http, $modalInstance, FileUploader, caseModel) {	
		$scope.cancel = function () {
			$modalInstance.dismiss('cancel');
		};

		var uploader = $scope.uploader = new FileUploader({
            url: '/upload'
        });

        $scope.submitNews = function () {
			if( $('#createNews input[type="file"]').val()==""){
				$('#createNewsAlert').show();
				$scope.attachment = 'The attachment field is required.';
			}
		};

        uploader.onCompleteAll = function(){
			var newCase = {
				description: $scope.description,
				title: $scope.title,
				category: 1
			};
			caseModel.insertCase( newCase )
			.success(function () {
				$modalInstance.close(newCase);
			}).
			error(function(error) {
				$scope.status = 'Unable to insert ticket: ' + error.message;
			});
		};
	});
