(function(angular){
	'use strict';
	angular.module('app').factory('HomeModel', function($http,APP_SETTINGS) {

        var getLogin = APP_SETTINGS.URL_API+'login/authenticate';
        
		var data = {};
        var config = {
            headers : {
            	skipAuthorization: true,
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        }
/*        data.getAll = function () {
			return $http.get(getAll);
		};
*/
		data.getLogin = function (item) {
			var post = $.param({
                'email':item.email,
                'pass':item.pass,
            });
            return $http.post(getLogin, post, config);
		};
		return data;
	});
})(window.angular);