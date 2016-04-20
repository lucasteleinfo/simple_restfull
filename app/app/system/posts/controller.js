(function(angular){
	'use strict';
	angular.module('app').controller('PostCtrl', ['PostModel', function(PostModel){
		var vm = this;
        vm.modalcreate = modalcreate;
        vm.modaledit = modaledit;
        vm.modaldel = modaldel;
        vm.insert = insert;
        vm.update = update;
        vm.delete = del;
        vm.items = [];
        vm.headerModal;

        getall();
        insItem();

        function insItem(){
            vm.item = {
                'des':'',
                'inf':'',
            };
        }
        /**CRUD**/
        function insert(){
            PostModel.create(vm.item).then(function(res) {
                console.info('Create',res);
                if(!res.data.error) {
                    insItem();
                    getall();
                    $('#modal').modal('hide');
                }
            });
        }
        function update(){
            PostModel.update(vm.item).then(function(res) {
                console.info('Update',res);
                if(!res.data.error) {
                    insItem();
                    getall();
                    $('#modaledit').modal('hide');
                }
            });
        }
        function del(){
            PostModel.del(vm.item).then(function(res) {
                console.info('Delete',res);
                if(!res.data.error) {
                    insItem();
                    getall();
                    $('#modaldel').modal('hide');
                }
            });
        }
        /**Modal**/
        function modalcreate(){
            insItem();
            vm.headerModal = 'Novo Post';
            $('#modal').modal('show');
        }
        function modaledit(item){
            vm.item = angular.copy(item);
            vm.headerModal = 'Alterar Post';
            $('#modaledit').modal('show');
        }
        function modaldel(item){
            vm.item = angular.copy(item);
            vm.headerModal = 'Tem certeza em deletar?';
            $('#modaldel').modal('show');
        }
        /**GETALL**/
        function getall() {
            PostModel.get().then(function(res) {
                if(!res.data.error) {
                    vm.items = res.data;
                }
            });
        }
	}]);
})(window.angular);