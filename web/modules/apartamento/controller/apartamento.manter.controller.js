(function() {
    'use strict';

    angular
        .module('cdm.system.module.apartamento')
        .controller('ApartamentoManterController', ApartamentoManterController);

    ApartamentoManterController.$inject = ['$scope', 'ApartamentoFactory', 'ApartamentoService', '$state','ProprietarioService','ProprietarioFactory'];


    function ApartamentoManterController($scope, ApartamentoFactory, ApartamentoService, $state,ProprietarioService,ProprietarioFactory) {
        //Atributos
        var vm = this;
        vm.titulo = undefined;
        vm.apartamento = undefined;
        vm.alerts = [];
        vm.proprietarios = [];

        //Instancia Metodos
        vm.cadastrar = cadastrar;
        vm.addAlert = addAlert;
        vm.closeAlert = closeAlert;
        vm.findProprietarioAll = findProprietarioAll;
        
        //Metodos
        function addAlert(type, message) {
            vm.alerts.push({
                "type": type,
                "msg": message
            });
        }

        function closeAlert(index) {
            vm.alerts.splice(index, 1);
        }

        function activate() {
            var objeto = ApartamentoFactory.getApartamento();
            verificarTitulo(objeto);
            if (angular.isUndefined(objeto)) {
                vm.apartamento = {};
            } else {
                vm.apartamento = objeto;
                //vm.findById(vm.apartamento.id);                
            }
            ApartamentoFactory.limparApartamento();
            vm.findProprietarioAll();
        }

        function verificarTitulo(objeto){
            if (angular.isUndefined(objeto)) {
                vm.titulo = "Cadastro do Apartamento";
            }else if(objeto.isView){
                vm.titulo = "Visualização do Apartamento";
            }else{
                vm.titulo = "Edição do Apartamento";
            }
        }

        function cadastrar(form) {
            if (form.$valid) {
                var apartamentoConverted = ApartamentoFactory.convertBack(vm.apartamento);
                if (angular.isUndefined(apartamentoConverted.id)) {
                    ApartamentoService.create(apartamentoConverted).then(function onSuccess(response) {
                        activate();
                    }).catch(function onError(response) {
                        vm.addAlert('alert-danger', response.data.message);
                    });
                    vm.addAlert('alert-success', 'Sucesso!');
                } else {                    
                    ApartamentoService.update(apartamentoConverted).then(function onSuccess(response) {
                        vm.addAlert('alert-danger', 'Sucesso!');
                        $state.go('apartamento-listar');
                    }).catch(function onError(response) {
                        vm.addAlert('alert-danger', response.data.message);
                    });                    
                }
            }else{
                vm.addAlert('alert-danger', 'Preencha os campos obrigatórios!');
            }

        }


        function findProprietarioAll() {
            ProprietarioService.findAll().then(function onSuccess(response) {
                vm.proprietarios = ProprietarioFactory.convertList(response.data);                
            }).catch(function onError(response) {
                vm.addAlert('alert-danger', response.data.message);
            });
        };        

        activate();

    }
})();