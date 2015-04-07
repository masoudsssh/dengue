// dengueApp version 1.0

dengueApp.controller('faqController', function($scope, $rootScope, $http, $modal, faqModel) {	

		if( $rootScope.role!=2 ){
			$("#create-faq").hide();
		}

		faqModel.getFaqs()
		.success(function (data) {
			$scope.faqs = data ;
		})
		.error(function (error) {
	        //  $scope.status = 'Unable to load customer data: ' + error.message;
	    });

		$scope.openFaqModal = function (size) {
			var modalInstance = $modal.open({
				templateUrl: '/faqModal.html',
				controller: 'storeFaqController',
				size: size,
				resolve: {
					params: function () {
						return '';//$scope.params;
					}
				}
			});

			modalInstance.result.then(function (param) {
				faqModel.getFaqs()
				.success(function (data) {
					$scope.faqs = data ;
				})
				.error(function (error) {
			        //  $scope.status = 'Unable to load customer data: ' + error.message;
			    });
				$rootScope.$$phase || $rootScope.$apply();
			}, function () {
				//$log.info('Modal dismissed at: ' + new Date());
			});
		};

	});

	dengueApp.controller('storeFaqController', function($scope, $http, $modalInstance, faqModel){
		$scope.cancel = function () {
			$modalInstance.dismiss('cancel');
		};

		$scope.submitFaq = function () {
			var newFaq = {
				question: $scope.question,
				answer: $scope.answer
			};
			faqModel.insertFaq( newFaq )
			.success(function () {
				$modalInstance.close(newFaq);
			}).
			error(function(error) {
				$scope.status = 'Unable to insert faq: ' + error.message;
			});
		};
	});