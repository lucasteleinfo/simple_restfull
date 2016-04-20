(function(angular){
	'use strict';
	angular.module('app').run(["$rootScope", 'jwtHelper', 'store', '$location', function($rootScope, jwtHelper, store, $location){
		$rootScope.$on('$routeChangeStart', function (event, next) {
			var decodeToken;
			var item;
	        var token = store.get("token");
	        if(!token){
	            $location.path("/login");
	        } else {
		        var bool = jwtHelper.isTokenExpired(token);
		        if(bool === true){
		            $location.path("/login");
		            store.remove('token');
		        } else {
		        	decodeToken = jwtHelper.decodeToken(token);
		        	item = {
		        		'id':decodeToken.id,
		        		'name':decodeToken.name,
		        		'email':decodeToken.email,
		        	}
		        	$rootScope.user = item;
		        }
	    	}
	    });
	}]);
})(window.angular);