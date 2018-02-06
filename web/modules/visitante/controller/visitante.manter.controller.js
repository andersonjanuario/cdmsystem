(function() {
    'use strict';

    angular
        .module('cdm.system.module.visitante')
        .controller('VisitanteManterController', VisitanteManterController);

    VisitanteManterController.$inject = ['$scope', 'VisitanteFactory', 'VisitanteService', '$state','ApartamentoService','ApartamentoFactory','MoradorFactory', 'MoradorService'];


    function VisitanteManterController($scope, VisitanteFactory, VisitanteService, $state, ApartamentoService, ApartamentoFactory,MoradorFactory, MoradorService) {
        //Atributos
        var vm = this;
        vm.titulo = undefined;
        vm.visitante = undefined;
        vm.alerts = [];
        vm.apartamentos = [];
        vm.visitantes = [];
        vm.apartamento = {};
        vm.moradores = [];
        vm.morador = {};
        vm.modadorDisabled = true;
        
        //Instancia Metodos
        vm.cadastrar = cadastrar;
        vm.removerFoto = removerFoto;
        vm.findById = findById;
        vm.addAlert = addAlert;
        vm.closeAlert = closeAlert;
        vm.findApartamentoAll = findApartamentoAll;
        vm.addVisitante = addVisitante;
        vm.removeVisitante  =removeVisitante;
        vm.findMoradoresByApartamento = findMoradoresByApartamento;
        vm.carregarMoradores = carregarMoradores;
        vm.findMoradorById = findMoradorById;


        //Metodos
        function removerFoto(){
            vm.visitante.foto = 'images/user.png';
        }


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
            var objeto = VisitanteFactory.getVisitante();
            verificarTitulo(objeto);
            vm.visitantes = [];
            if (angular.isUndefined(objeto)) {
                vm.visitante = {               
                    foto: 'images/user.png'
                };
            } else {
                vm.visitante = objeto;
                vm.findById(vm.visitante.id);                
            }
            VisitanteFactory.limparVisitante();
            vm.findApartamentoAll();
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
            if (!angular.isUndefined(vm.morador.id) && vm.morador.id !== null && (vm.visitantes.length > 0)) {
                var visitanteConverted = VisitanteFactory.convertBack(vm.morador,vm.visitantes);
                VisitanteService.create(visitanteConverted).then(function onSuccess(response) {                        
                    activate();
                }).catch(function onError(response) {
                    vm.addAlert('alert-danger', 'Erro!');
                });
                vm.addAlert('alert-success', 'Sucesso!');
            }else{
                vm.addAlert('alert-danger', 'Preencha os campos obrigatórios!');
            }

        }


        function removeVisitante(index){
            vm.visitantes.splice(index,1);
        }

        function addVisitante(form){
            if (form.$valid) {
                vm.isSelected = true;
                vm.visitantes.push(angular.copy(vm.visitante));
                vm.visitante = {foto: 'images/user.png'};
            }else{
                vm.addAlert('alert-danger', 'Preencha os campos obrigatórios!');
            }            
        }

        function findById(codigo) {
            VisitanteService.findById(codigo).then(function onSuccess(response) {
                var objeto = VisitanteFactory.convert(response.data);                
                vm.visitante.foto = objeto.foto;
                vm.findMoradorById(objeto.id) 
            }).catch(function onError(response) {
                vm.addAlert('alert-danger', 'Erro!');
            });
        };

        $scope.uploadFile = function (element) {
            var file = element.files;
            vm.visitante.imagemName = "../" + file[0].name;
            vm.visitante.imagem = file[0];
            var reader = new FileReader();
            reader.onload = function (loadEvent) {
                $scope.$apply(function () {
                    vm.visitante.foto = loadEvent.target.result;
                    
                });
            };
            reader.readAsDataURL(file[0]);
            $scope.$apply();            
        };

        function findApartamentoAll() {
            ApartamentoService.findAll().then(function onSuccess(response) {
                vm.apartamentos = ApartamentoFactory.convertList(response.data);
                if(!angular.isUndefined(vm.apartamentos) && vm.apartamentos !== null && vm.apartamentos.length > 0){
                    vm.apartamento = vm.apartamentos[0];
                    vm.carregarMoradores();
                }                
            }).catch(function onError(response) {
                vm.addAlert('alert-danger', response.data.message);
            });
        };  

        function carregarMoradores(){
            if(!angular.isUndefined(vm.apartamento.id) && vm.apartamento.id !== null && vm.apartamento.id !== '' ){
                vm.findMoradoresByApartamento(vm.apartamento.id);
            }else{
                vm.moradores = [];
                vm.morador = {};
                vm.modadorDisabled = true;
            }
        }


        function findMoradoresByApartamento(codigo) {
            MoradorService.findByApartamento(codigo).then(function onSuccess(response) {
                vm.moradores = MoradorFactory.convertList(response.data);
                if(!angular.isUndefined(vm.moradores) && vm.moradores !== null && vm.moradores.length > 0){
                    vm.morador = vm.moradores[0];                   
                    vm.modadorDisabled = false;
                }else{
                    vm.modadorDisabled = true;
                }                                                  
            }).catch(function onError(response) {
                vm.addAlert('alert-danger', response.data.message);
                vm.modadorDisabled = true;
            });
        }; 


        function findMoradorById(codigo){
            MoradorService.findMoradoresByVisitId(codigo).then(function onSuccess(response) {
                if(!angular.isUndefined(response.data) && response.data !== null && response.data.length > 0){
                    vm.morador = MoradorFactory.convert(response.data[0]);                                
                }
            }).catch(function onError(response) {
                vm.addAlert('alert-danger', 'Erro!');
            });
        }       



        activate();

    }
})();