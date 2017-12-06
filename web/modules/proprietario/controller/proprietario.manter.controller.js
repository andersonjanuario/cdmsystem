(function () {
    'use strict';

    angular
    .module('cdm.system.module.proprietario')
    .controller('ProprietarioManterController', ProprietarioManterController);

    ProprietarioManterController.$inject = ['$scope','ProprietarioFactory','ProprietarioService'];


    function ProprietarioManterController($scope,ProprietarioFactory,ProprietarioService) {
        var vm = this;
        vm.titulo = "proprietario manter";     
        vm.proprietario = undefined; 

        vm.cadastrar = cadastrar;
        
        function activate() {
            vm.proprietario = {}; 
        }

        function cadastrar(form){
            if (form.$valid) {
                 var proprietarioConverted = ProprietarioFactory.convertBack(vm.proprietario); 
                 ProprietarioService.create(proprietarioConverted).then(function onSuccess(response) {
                    console.log(response.data);
                    activate();                
                }).catch(function onError(response) {
                    console.log(response);
                });
            }
        }   


        function remover(codigo){
             ProprietarioService.remove(codigo).then(function onSuccess(response) {
                console.log(response.data);
                activate();                
            }).catch(function onError(response) {
                console.log(response);
            });
        }


    activate();

}
})();
