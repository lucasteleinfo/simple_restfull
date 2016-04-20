(function(angular){
	'use strict';
	angular.module('app').factory('HeaderModel', function($http,APP_SETTINGS) {

        var getAll = APP_SETTINGS.URL_WS+'servicos/getall';
        
		var data = {};
        
        data.getAll = function () {
			return $http.get(getAll);
		};
		return data;
	});
})(window.angular);