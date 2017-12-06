(function () {
    'use strict';

    angular
    .module('cdm.system.module.proprietario')
    .controller('ProprietarioListarController', ProprietarioListarController);

    ProprietarioListarController.$inject = ['$scope','ProprietarioService'];


    function ProprietarioListarController($scope, ProprietarioService) {
        var vm = this;
        vm.titulo = "proprietario listar";  
        vm.findAll = findAll;

        function activate() {
         vm.findAll();
     }


     function findAll() {
        ProprietarioService.findAll().then(function onSuccess(response) {
            console.log(response.data);

        }).catch(function onError(response) {
            console.log(response);
        });
    };




    activate();

}
})();
