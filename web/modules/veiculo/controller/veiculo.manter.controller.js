(function() {
    'use strict';

    angular
        .module('cdm.system.module.veiculo')
        .controller('VeiculoManterController', VeiculoManterController);

    VeiculoManterController.$inject = ['$scope', 'VeiculoFactory', 'VeiculoService', '$state','ApartamentoService','ApartamentoFactory'];


    function VeiculoManterController($scope, VeiculoFactory, VeiculoService, $state,ApartamentoService,ApartamentoFactory) {
        //Atributos
        var vm = this;
        vm.titulo = undefined;
        vm.veiculo = undefined;
        vm.alerts = [];
        vm.apartamentos = [];

        //Instancia Metodos
        vm.cadastrar = cadastrar;
        vm.addAlert = addAlert;
        vm.closeAlert = closeAlert;
        vm.findApartamentoAll = findApartamentoAll;
        
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
            var objeto = VeiculoFactory.getVeiculo();
            verificarTitulo(objeto);
            if (angular.isUndefined(objeto)) {
                vm.veiculo = { tipo: 'M'};
            } else {
                vm.veiculo = objeto;                               
            }
            VeiculoFactory.limparVeiculo();
            vm.findApartamentoAll();
        }

        function verificarTitulo(objeto){
            if (angular.isUndefined(objeto)) {
                vm.titulo = "Cadastro do Veiculo";
            }else if(objeto.isView){
                vm.titulo = "Visualização do Veiculo";
            }else{
                vm.titulo = "Edição do Veiculo";
            }
        }

        function cadastrar(form) {
            if (form.$valid) {
                var veiculoConverted = VeiculoFactory.convertBack(vm.veiculo);
                if (angular.isUndefined(veiculoConverted.id)) {
                    VeiculoService.create(veiculoConverted).then(function onSuccess(response) {
                        activate();
                    }).catch(function onError(response) {
                        vm.addAlert('alert-danger', response.data.message);
                    });
                    vm.addAlert('alert-success', 'Sucesso!');
                } else {                    
                    VeiculoService.update(veiculoConverted).then(function onSuccess(response) {
                        vm.addAlert('alert-danger', 'Sucesso!');
                        $state.go('veiculo-listar');
                    }).catch(function onError(response) {
                        vm.addAlert('alert-danger', response.data.message);
                    });                    
                }
            }else{
                vm.addAlert('alert-danger', 'Preencha os campos obrigatórios!');
            }

        }

        function remover(codigo) {
            VeiculoService.remove(codigo).then(function onSuccess(response) {
                console.log(response.data);
                activate();
            }).catch(function onError(response) {
                vm.addAlert('alert-danger', response.data.message);
            });
        }


        function findApartamentoAll() {
            ApartamentoService.findAll().then(function onSuccess(response) {
                vm.apartamentos = ApartamentoFactory.convertList(response.data);                
            }).catch(function onError(response) {
                vm.addAlert('alert-danger', response.data.message);
            });
        };        

        activate();

    }
})();