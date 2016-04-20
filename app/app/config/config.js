(function(angular){
	'use strict';
	angular.module('app').config(["$routeProvider", "$httpProvider", "jwtInterceptorProvider",  func]);

	function func ($routeProvider, $httpProvider, jwtInterceptorProvider) {
	    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
	    
	    jwtInterceptorProvider.tokenGetter = [function() {
	        return localStorage.getItem('token');
	    }];

	    $httpProvider.interceptors.push('jwtInterceptor');

		$routeProvider
	    .when("/", {
	        templateUrl: 'app/system/home/view.html',
	        controller: 'HomeCtrl',
	        controllerAs: 'vm',
	        authorization: true,
	        resolve: {
                'check':function($rootScope,$location){
                    if (!$rootScope.user) {
                    	$location.path('/login');
                    }
                }
            }
	    })
	    .when("/login", {
	        templateUrl: 'app/system/login/view.html',
	        controller: 'LoginCtrl',
	        controllerAs: 'vm',
	        authorization: false,
	        resolve: {
                'check':function($rootScope,$location){
                    if ($rootScope.user) {
                    	$location.path('/');
                    }
                }
            }
	    })
	    .when("/posts", {
	        templateUrl: 'app/system/posts/view.html',
	        controller: 'PostCtrl',
	        controllerAs: 'vm',
	        authorization: true,
	        resolve: {
                'check':function($rootScope,$location){
                    if (!$rootScope.user) {
                    	$location.path('/login');
                    }
                }
            }
	    })
	    .otherwise({
            redirectTo: '/'
        });
	};
})(window.angular);