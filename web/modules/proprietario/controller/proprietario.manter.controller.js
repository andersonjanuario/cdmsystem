(function() {
    'use strict';

    angular
        .module('cdm.system.module.proprietario')
        .controller('ProprietarioManterController', ProprietarioManterController);

    ProprietarioManterController.$inject = ['$scope', 'ProprietarioFactory', 'ProprietarioService', '$state'];


    function ProprietarioManterController($scope, ProprietarioFactory, ProprietarioService, $state) {
        var vm = this;
        vm.titulo = "proprietario manter";
        vm.proprietario = undefined;

        vm.cadastrar = cadastrar;

        function activate() {
            var objeto = ProprietarioFactory.getProprietario();
            if (angular.isUndefined(objeto)) {
                vm.proprietario = {
                    adimplente: 'S',
                    morador: 'S'
                };
            } else {
                vm.proprietario = objeto;
                ProprietarioFactory.limparProprietario();
            }
        }

        function cadastrar(form) {
            if (form.$valid) {
                var proprietarioConverted = ProprietarioFactory.convertBack(vm.proprietario);
                if (angular.isUndefined(proprietarioConverted.id)) {
                    ProprietarioService.create(proprietarioConverted).then(function onSuccess(response) {
                        console.log(response.data);
                        activate();
                    }).catch(function onError(response) {
                        console.log(response);
                    });
                } else {                    
                    ProprietarioService.update(proprietarioConverted).then(function onSuccess(response) {
                        console.log(response.data);
                        $state.go('proprietario-listar');
                    }).catch(function onError(response) {
                        console.log(response);
                    });                    
                }
            }

        }

        function remover(codigo) {
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