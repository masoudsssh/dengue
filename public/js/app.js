	// create the module and name it dengueApp
	var dengueApp = angular.module('dengueApp', ['ngRoute', 'ui.bootstrap', 'datatables', 'ngResource', 'angularFileUpload' ] );

	dengueApp.directive('addthisToolbox', ['$timeout', function($timeout) {
		return {
			restrict : 'A',
			transclude : true,
			replace : true,
			template : '<div ng-transclude></div>',
			link : function($scope, element, attrs) {
				$timeout(function () {
					addthis.init();
					addthis.toolbox($(element).get(), {}, {
						url: attrs.url,
						title : "My Awesome Blog",
						description : 'Checkout this awesome post on blog.me'        
					});
				});
			}
		};
	}]);