(function(angular){
	'use strict';
	angular.module('app').controller('LoginCtrl', ['LoginModel','$location','store','$rootScope', function(LoginModel,$location,store,$rootScope){

		var vm = this;
		vm.login = login;
        vm.modalsignup = modalsignup;
        vm.create = create;

        insitemup;
        insitem;

        function insitem(){
            vm.item = {
                'email':'',
                'pass':''
            }
        }

        function insitemup(){
            vm.itemup = {
                'name':'',
                'email':'',
                'pass':''
            }
        }

        /**Create**/
        function create(){
            LoginModel.create(vm.itemup).then(function(res) {
                console.info('Create',res);
                if(!res.data.error) {
                    insitemup;
                    $('#modalsignup').modal('hide');
                }
            });
        }

        /**Modal SignUp**/
        function modalsignup(){
            insitemup;
            $('#modalsignup').modal('show');
        }

		/*Login*/
		function login(){
            LoginModel.login(vm.item).then(function(res) {
                console.info('Login',res);
                if(!res.data.error) {
                    store.set('token', res.data.token);
                    $rootScope.user = res.data.user;
                    $location.path("/");
                }
            });
        }
	}]);
})(window.angular);