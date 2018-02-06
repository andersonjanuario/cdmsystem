(function() {
    'use strict';

    angular
        .module('cdm.system.module.proprietario')
        .controller('ProprietarioManterController', ProprietarioManterController);

    ProprietarioManterController.$inject = ['$scope', 'ProprietarioFactory', 'ProprietarioService', '$state'];


    function ProprietarioManterController($scope, ProprietarioFactory, ProprietarioService, $state) {
        //Atributos
        var vm = this;
        vm.titulo = undefined;
        vm.proprietario = undefined;
        vm.alerts = [];

        //Instancia Metodos
        vm.cadastrar = cadastrar;
        vm.removerFoto = removerFoto;
        vm.findById = findById;
        vm.addAlert = addAlert;
        vm.closeAlert = closeAlert;


        //Metodos
        function removerFoto(){
            vm.proprietario.foto = 'images/user.png';
        }


        function addAlert(type, message) {
        //    $log.info('addAlert type: ' + type + '; message: ' + message + '.');
            vm.alerts.push({
                "type": type,
                "msg": message
            });
        }

        function closeAlert(index) {
            vm.alerts.splice(index, 1);
        }

        function activate() {
            var objeto = ProprietarioFactory.getProprietario();
            verificarTitulo(objeto);
            if (angular.isUndefined(objeto)) {
                vm.proprietario = {
                    adimplente: 'S',
                    morador: 'S',
                    foto: 'images/user.png'
                };
            } else {
                vm.proprietario = objeto;
                vm.findById(vm.proprietario.id);                
            }
            ProprietarioFactory.limparProprietario();
        }

        function verificarTitulo(objeto){
            if (angular.isUndefined(objeto)) {
                vm.titulo = "Cadastro do Proprietário";
            }else if(objeto.isView){
                vm.titulo = "Visualização do Proprietário";
            }else{
                vm.titulo = "Edição do Proprietário";
            }
        }

        function cadastrar(form) {
            if (form.$valid) {
                var proprietarioConverted = ProprietarioFactory.convertBack(vm.proprietario);
                if (angular.isUndefined(proprietarioConverted.id)) {
                    ProprietarioService.create(proprietarioConverted).then(function onSuccess(response) {                        
                        activate();
                    }).catch(function onError(response) {
                        vm.addAlert('alert-danger', 'Erro!');
                    });
                    vm.addAlert('alert-success', 'Sucesso!');
                } else {                    
                    ProprietarioService.update(proprietarioConverted).then(function onSuccess(response) {
                        vm.addAlert('alert-danger', 'Erro!');
                        $state.go('proprietario-listar');
                    }).catch(function onError(response) {
                        vm.addAlert('alert-danger', 'Erro!');
                    });                    
                }
            }else{
                vm.addAlert('alert-danger', 'Preencha os campos obrigatórios!');
            }

        }

        function findById(codigo) {
            ProprietarioService.findById(codigo).then(function onSuccess(response) {
                var objeto = ProprietarioFactory.convert(response.data);                
                vm.proprietario.foto = objeto.foto; 
            }).catch(function onError(response) {
                vm.addAlert('alert-danger', 'Erro!');
            });
        };

        $scope.uploadFile = function (element) {
            var file = element.files;
            vm.proprietario.imagemName = "../" + file[0].name;
            vm.proprietario.imagem = file[0];
            var reader = new FileReader();
            reader.onload = function (loadEvent) {
                $scope.$apply(function () {
                    vm.proprietario.foto = loadEvent.target.result;
                    
                });
            };
            reader.readAsDataURL(file[0]);
            $scope.$apply();            
        };



        activate();

    }
})();