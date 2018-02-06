(function() {
    'use strict';

    angular
        .module('cdm.system.module.area')
        .controller('AreaManterController', AreaManterController);

    AreaManterController.$inject = ['$scope', 'AreaFactory', 'AreaService', '$state'];


    function AreaManterController($scope, AreaFactory, AreaService, $state) {
        //Atributos
        var vm = this;
        vm.titulo = undefined;
        vm.area = undefined;
        vm.alerts = [];        

        //Instancia Metodos
        vm.cadastrar = cadastrar;
        vm.addAlert = addAlert;
        vm.closeAlert = closeAlert;
        
        
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
            var objeto = AreaFactory.getArea();
            verificarTitulo(objeto);
            if (angular.isUndefined(objeto)) {
                vm.area = {};
            } else {
                vm.area = objeto;                               
            }
            AreaFactory.limparArea();
        }

        function verificarTitulo(objeto){
            if (angular.isUndefined(objeto)) {
                vm.titulo = "Cadastro do Area";
            }else if(objeto.isView){
                vm.titulo = "Visualização do Area";
            }else{
                vm.titulo = "Edição do Area";
            }
        }

        function cadastrar(form) {
            if (form.$valid) {
                var areaConverted = AreaFactory.convertBack(vm.area);
                if (angular.isUndefined(areaConverted.id)) {
                    AreaService.create(areaConverted).then(function onSuccess(response) {
                        activate();
                    }).catch(function onError(response) {
                        vm.addAlert('alert-danger', response.data.message);
                    });
                    vm.addAlert('alert-success', 'Sucesso!');
                } else {                    
                    AreaService.update(areaConverted).then(function onSuccess(response) {
                        vm.addAlert('alert-danger', 'Sucesso!');
                        $state.go('area-listar');
                    }).catch(function onError(response) {
                        vm.addAlert('alert-danger', response.data.message);
                    });                    
                }
            }else{
                vm.addAlert('alert-danger', 'Preencha os campos obrigatórios!');
            }

        }


        activate();

    }
})();