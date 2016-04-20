(function(angular){
	'use strict';
	angular.module('app').factory('LoginModel',['$http','APP_SETTINGS','$q', function($http,APP_SETTINGS,$q) {
        return {
            create: function(item) {
                var data = $.param(item);
                var deferred;
                deferred = $q.defer();
                $http({
                    method:'post',
                    data:data,
                    url: APP_SETTINGS.URL_API+'login/signup',
                    headers : {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                })
                .then(function(res) {
                    deferred.resolve(res);
                })
                .then(function(error) {
                    deferred.reject(error);
                })
                return deferred.promise;
            },
            login: function(item) {
                var data = $.param(item);
                var deferred;
                deferred = $q.defer();
                $http({
                    method:'post',
                    data:data,
                    url: APP_SETTINGS.URL_API+'login/authenticate',
                    headers : {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                    }
                })
                .then(function(res) {
                    deferred.resolve(res);
                })
                .then(function(error) {
                    deferred.reject(error);
                })
                return deferred.promise;
            },
        }
	}]);
})(window.angular);