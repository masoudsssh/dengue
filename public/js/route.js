//  dengueApp version 1.0
	dengueApp.config(function($routeProvider, $locationProvider ) {
		$routeProvider

		.when('/index' , {
			  controller:  'caseController',
			  templateUrl: '/views/case.html'
		})

		.when('/dashboard' , {
			  controller:  'caseController',
			  templateUrl: '/views/dashboard.html'
		})

		.when('/profile' , {
			  controller:  'profileController',
			  templateUrl: '/views/profile.html'
		})

		.when('/logout' , {
			  controller:  'logoutController',
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

