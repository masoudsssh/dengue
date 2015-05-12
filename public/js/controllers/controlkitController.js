// dengueApp version 1.0

dengueApp.controller('controlkitController', function($scope, $rootScope, $http, $modal, controlKit) {	

	if( $rootScope.role!=2 ){
		$("#create-news").hide();
		$("#controlkitLink").hide();
	}else{
		$("#create-news").show();
		$("#controlkitLink").show();
	}

	$scope.openControlKitModal = function(size){
		var modalInstance = $modal.open({
			templateUrl: '/controlKitModal.html',
			controller: 'storeControlKitController',
			size: size,
			resolve: {
				params: function () {
						return '';//$scope.params;
					}
				}
			});

		modalInstance.result.then(function (params) {
			controlKit.getControlKitRequests()
			.success(function (data) {
				$scope.controlkitrequests = data ;
			})
			.error(function (error) {
				        //  $scope.status = 'Unable to load customer data: ' + error.message;
				    });
				//$rootScope.$$phase || $rootScope.$apply();
			}, function () {
				//$log.info('Modal dismissed at: ' + new Date());
			});
	}


	controlKit.getControlKitRequests()
	.success(function (data) {
		$scope.controlkitrequests = data ;
	})
	.error(function (error) {
	        //  $scope.status = 'Unable to load customer data: ' + error.message;
	    });

});



dengueApp.controller('storeControlKitController', function($scope, $http, $modalInstance, controlKit) {	
	$scope.cancel = function () {
		$modalInstance.dismiss('cancel');
	};

	$scope.submitControlKitRequest = function () {
		var newRequest = {
			email: $scope.email,
			name: $scope.name,
			address: $scope.address
		};

		controlKit.insertControlKitRequest( newRequest )
		.success(function (data) {
			if(data.status==200){
				$modalInstance.close(newRequest);
			}else{
				console.log(data);
				$('#createControlKitAlert').html("<li>"+data.email[0]+"</li>").show();
			}
		}).
		error(function(error) {
			$scope.status = 'Unable to submit the request: ' + error.message;
			$('#createControlKitAlert').html("<li>"+error.email[0]+"</li>").show();
		});
	};
});