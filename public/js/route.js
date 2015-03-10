//  dengueApp version 1.0
	dengueApp.config(function($routeProvider, $locationProvider ) {
		$routeProvider

		.when('/index' , {
			  controller:  'caseController',
			  templateUrl: '/views/case.html'
		});

		// .otherwise({
	 //        redirectTo: '/'
	 //    });
		

		$locationProvider.html5Mode({
		  enabled: true,
		  requireBase: false
		});

	});

