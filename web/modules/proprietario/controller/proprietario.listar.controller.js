(function () {
    'use strict';

    angular
    .module('cdm.system.module.proprietario')
    .controller('ProprietarioListarController', ProprietarioListarController);

    ProprietarioListarController.$inject = ['$scope','ProprietarioService','ProprietarioFactory'];


    function ProprietarioListarController($scope, ProprietarioService,ProprietarioFactory) {
        //Atributos
        var vm = this;
        vm.titulo = "proprietario listar";  
        vm.proprietarios = [];

        //Instancia Metodos
        vm.findAll = findAll;
        vm.atualizar = atualizar;
        vm.remover = remover;


        //Metodos
        function activate() {
           vm.findAll();
        }


        function atualizar(objeto){

        }

        function remover(codigo){
            ProprietarioService.remove(codigo).then(function onSuccess(response) {
                console.log(response.data);
                activate();
            }).catch(function onError(response) {
                console.log(response);
            });
        }


       function findAll() {
        ProprietarioService.findAll().then(function onSuccess(response) {
            console.log(response.data);
            vm.proprietarios = ProprietarioFactory.convertList(response.data);
            console.log(vm.proprietarios);
        }).catch(function onError(response) {
            console.log(response);
        });
    };




    activate();

}
})();
