(function() {
    'use strict';

    angular
        .module('cdm.system.module.area')
        .controller('ReservaManterController', ReservaManterController);

    ReservaManterController.$inject = ['$scope', 'ReservaFactory', 'ReservaService', '$state' ,'AreaService','AreaFactory','ApartamentoService', 'ApartamentoFactory','MoradorFactory', 'MoradorService'];


    function ReservaManterController($scope, ReservaFactory, ReservaService, $state, AreaService, AreaFactory,ApartamentoService, ApartamentoFactory,MoradorFactory, MoradorService) {
        //Atributos
        var vm = this;
        vm.titulo = undefined;
        vm.reserva = undefined;
        vm.alerts = []; 
        vm.areas = [];
        vm.apartamentos = [];
        //vm.apartamento = {};
        vm.moradores = [];
        //vm.morador = {};
        vm.modadorDisabled = true;
        vm.isUpdate = false;              

        //Instancia Metodos
        vm.cadastrar = cadastrar;
        vm.addAlert = addAlert;
        vm.closeAlert = closeAlert;
        vm.findAreaAll = findAreaAll;
        vm.findApartamentoAll = findApartamentoAll;
        vm.carregarMoradores = carregarMoradores;
        vm.findMoradoresByApartamento = findMoradoresByApartamento;
        vm.findApartamentoById = findApartamentoById;

        
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
            var objeto = ReservaFactory.getReserva();
            verificarTitulo(objeto);
            if (angular.isUndefined(objeto)) {
                vm.isUpdate = false;
                vm.reserva = {
                    area:{},
                    morador:{},
                    apartamento:{},
                    status: 'R',
                    saldo : 0
                };
                vm.findAreaAll(false);
            } else {
                vm.isUpdate = true;
                vm.reserva = objeto;                               
                vm.findAreaAll(true);
            }
            ReservaFactory.limparReserva();
            vm.findApartamentoAll();            
        }

        function verificarTitulo(objeto){
            if (angular.isUndefined(objeto)) {
                vm.titulo = "Cadastro do Reserva";
            }else if(objeto.isView){
                vm.titulo = "Visualização do Reserva";
            }else{
                vm.titulo = "Edição do Reserva";
            }
        }

        function cadastrar(form) {
            if (form.$valid) {
                var reservaConverted = ReservaFactory.convertBack(vm.reserva);
                if (angular.isUndefined(reservaConverted.id)) {
                    ReservaService.create(reservaConverted).then(function onSuccess(response) {
                        activate();
                    }).catch(function onError(response) {
                        vm.addAlert('alert-danger', response.data.message);
                    });
                    vm.addAlert('alert-success', 'Sucesso!');
                } else {                    
                    ReservaService.update(reservaConverted).then(function onSuccess(response) {
                        vm.addAlert('alert-danger', 'Sucesso!');
                        $state.go('reserva-listar');
                    }).catch(function onError(response) {
                        vm.addAlert('alert-danger', response.data.message);
                    });                    
                }
            }else{
                vm.addAlert('alert-danger', 'Preencha os campos obrigatórios!');
            }

        }

        function findAreaAll(isUpdate) {
            AreaService.findAll().then(function onSuccess(response) {
                vm.areas = AreaFactory.convertList(response.data); 
                if(!angular.isUndefined(vm.areas) && vm.areas !== null && vm.areas.length > 0 &&  isUpdate === false){
                    vm.reserva.area = vm.areas[0];                    
                }                                 
            }).catch(function onError(response) {
                vm.addAlert('alert-danger', response.data.message);
            });
        };  


        function findApartamentoAll(isUpdate) {
            ApartamentoService.findAll().then(function onSuccess(response) {
                vm.apartamentos = ApartamentoFactory.convertList(response.data);
                if(!angular.isUndefined(vm.apartamentos) && vm.apartamentos !== null && vm.apartamentos.length > 0){
                    if(isUpdate === false){
                        vm.reserva.apartamento = vm.apartamentos[0];
                    }else{
                        vm.findApartamentoById(vm.reserva.apartamento.id);
                    }
                    vm.carregarMoradores();
                }                
            }).catch(function onError(response) {
                vm.addAlert('alert-danger', response.data.message);
            });
        };  

        function carregarMoradores(){
            if(!angular.isUndefined(vm.reserva.apartamento.id) && vm.reserva.apartamento.id !== null && vm.reserva.apartamento.id !== '' ){
                vm.findMoradoresByApartamento(vm.reserva.apartamento.id);
            }else{
                vm.moradores = [];
                vm.reserva.morador = {};
                vm.modadorDisabled = true;
            }
        }

        function findMoradoresByApartamento(codigo) {
            MoradorService.findByApartamento(codigo).then(function onSuccess(response) {
                vm.moradores = MoradorFactory.convertList(response.data);
                if(!angular.isUndefined(vm.moradores) && vm.moradores !== null && vm.moradores.length > 0){
                    vm.reserva.morador = vm.moradores[0];                   
                    vm.modadorDisabled = false;
                }else{
                    vm.modadorDisabled = true;
                }                                                  
            }).catch(function onError(response) {
                vm.addAlert('alert-danger', response.data.message);
                vm.modadorDisabled = true;
            });
        };


        function findApartamentoById(codigo) {
            ApartamentoService.findById(codigo).then(function onSuccess(response) {
                vm.reserva.apartamento = ApartamentoFactory.convert(response.data);                
            }).catch(function onError(response) {
                vm.addAlert('alert-danger', 'Erro!');
            });
        };                 


        activate();

    }
})();