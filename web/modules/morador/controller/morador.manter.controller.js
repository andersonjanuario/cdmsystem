(function() {
    'use strict';

    angular
        .module('cdm.system.module.morador')
        .controller('MoradorManterController', MoradorManterController);

    MoradorManterController.$inject = ['$scope', 'MoradorFactory', 'MoradorService', '$state','ApartamentoService','ApartamentoFactory','ParentescoService'];


    function MoradorManterController($scope, MoradorFactory, MoradorService, $state,ApartamentoService,ApartamentoFactory,ParentescoService) {
        //Atributos
        var vm = this;
        vm.titulo = undefined;
        vm.morador = undefined;
        vm.alerts = [];
        vm.apartamentos = [];

        //Instancia Metodos
        vm.cadastrar = cadastrar;
        vm.addAlert = addAlert;
        vm.closeAlert = closeAlert;
        vm.findApartamentoAll = findApartamentoAll;
        vm.removerFoto = removerFoto;
        vm.findById = findById;
        vm.findParentescoAll = findParentescoAll;


     
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
            var objeto = MoradorFactory.getMorador();
            verificarTitulo(objeto);
            if (angular.isUndefined(objeto)) {
                vm.morador = {};
            } else {
                vm.morador = objeto;
                vm.findById(vm.morador.id);                                    
            }
            MoradorFactory.limparMorador();
            vm.findApartamentoAll();
            vm.findParentescoAll();
        }

        function verificarTitulo(objeto){
            if (angular.isUndefined(objeto)) {
                vm.titulo = "Cadastro do Morador";
            }else if(objeto.isView){
                vm.titulo = "Visualização do Morador";
            }else{
                vm.titulo = "Edição do Morador";
            }
        }

        function cadastrar(form) {
            if (form.$valid) {
                var moradorConverted = MoradorFactory.convertBack(vm.morador);
                if (angular.isUndefined(moradorConverted.id)) {
                    MoradorService.create(moradorConverted).then(function onSuccess(response) {
                        activate();
                    }).catch(function onError(response) {
                        vm.addAlert('alert-danger', response.data.message);
                    });
                    vm.addAlert('alert-success', 'Sucesso!');
                } else {                    
                    MoradorService.update(moradorConverted).then(function onSuccess(response) {
                        vm.addAlert('alert-danger', 'Sucesso!');
                        $state.go('morador-listar');
                    }).catch(function onError(response) {
                        vm.addAlert('alert-danger', response.data.message);
                    });                    
                }
            }else{
                vm.addAlert('alert-danger', 'Preencha os campos obrigatórios!');
            }

        }


        function findApartamentoAll() {
            ApartamentoService.findAll().then(function onSuccess(response) {
                vm.apartamentos = ApartamentoFactory.convertList(response.data);                
            }).catch(function onError(response) {
                vm.addAlert('alert-danger', response.data.message);
            });
        };  


        function findParentescoAll() {
            ParentescoService.findAll().then(function onSuccess(response) {
                vm.parentescos = response.data;                
            }).catch(function onError(response) {
                vm.addAlert('alert-danger', response.data.message);
            });
        };  


        function removerFoto(){
            vm.morador.foto = 'images/user.png';
        }


        $scope.uploadFile = function (element) {
            var file = element.files;
            vm.morador.imagemName = "../" + file[0].name;
            vm.morador.imagem = file[0];
            var reader = new FileReader();
            reader.onload = function (loadEvent) {
                $scope.$apply(function () {
                    vm.morador.foto = loadEvent.target.result;
                    
                });
            };
            reader.readAsDataURL(file[0]);
            $scope.$apply();            
        };

        function findById(codigo) {
            MoradorService.findById(codigo).then(function onSuccess(response) {
                var objeto = MoradorFactory.convert(response.data);                
                vm.morador.foto = objeto.foto; 
            }).catch(function onError(response) {
                vm.addAlert('alert-danger', 'Erro!');
            });
        };                              

        activate();

    }
})();