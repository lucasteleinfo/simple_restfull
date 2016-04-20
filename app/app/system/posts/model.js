(function(angular){
	'use strict';
	angular.module('app').factory('PostModel',['$http','$q','APP_SETTINGS','store',function($http,$q,APP_SETTINGS,store)
{
    return{
        get: function() {
            var deferred;
            deferred = $q.defer();
            $http({
                method: 'GET',
                skipAuthorization: false,
                url: APP_SETTINGS.URL_API+'posts/getall',
                headers : {
                    'Authorization':store.get('token')
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
        create: function(item) {
            var data = $.param(item);
            var deferred;
            deferred = $q.defer();
            $http({
                method:'post',
                data:data,
                url: APP_SETTINGS.URL_API+'posts/create',
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                    'Authorization':store.get('token')
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
        update: function(item) {
            var data = $.param(item);
            var deferred;
            deferred = $q.defer();
            $http({
                method:'post',
                data:data,
                url: APP_SETTINGS.URL_API+'posts/update',
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                    'Authorization':store.get('token')
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
        del: function(item) {
            var data = $.param(item);
            var deferred;
            deferred = $q.defer();
            $http({
                method:'post',
                data:data,
                url: APP_SETTINGS.URL_API+'posts/delete',
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                    'Authorization':store.get('token')
                }
            })
            .then(function(res) {
                deferred.resolve(res);
            })
            .then(function(error) {
                deferred.reject(error);
            })
            return deferred.promise;
        }
    }
}])
})(window.angular);