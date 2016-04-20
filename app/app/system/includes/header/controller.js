(function(angular){
	'use strict';
	angular.module('app').controller('HeaderCtrl', ['HeaderModel','$rootScope','$location','store', function(HeaderModel,$rootScope,$location,store){
		var vm = this;
		vm.logout = logout;

		function logout(){
			store.remove('token');
			$rootScope.user = null;
			$location.path('/login');
		}
	}]);
})(window.angular);