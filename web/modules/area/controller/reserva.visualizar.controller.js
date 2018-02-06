(function () {
    'use strict';

    angular
    .module('cdm.system.module.area')
    .controller('ReservaVisualizarController', ReservaVisualizarController);

    ReservaVisualizarController.$inject = ['$scope','ReservaService','ReservaFactory','$state'];


    function ReservaVisualizarController($scope, ReservaService,ReservaFactory,$state) {
        //Atributos
        var vm = this;
        vm.titulo = "Listagem dos Reservas";  
        vm.events = [];
        vm.reservas = [];

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        
        //Instancia Metodos
        vm.findAll = findAll;
        vm.remover = remover;
        vm.visualizar = visualizar;
        vm.checarClasse = checarClasse;
        $scope.eventClick = eventClick;
        


        /* alert on eventClick */
        vm.alertOnEventClick = function( date, jsEvent, view){
            vm.alertMessage = (date.title + ' was clicked ');
        };
        /* alert on Drop */
         vm.alertOnDrop = function(event, delta, revertFunc, jsEvent, ui, view){
           vm.alertMessage = ('Event Droped to make dayDelta ' + delta);
        };
        /* alert on Resize */
        vm.alertOnResize = function(event, delta, revertFunc, jsEvent, ui, view ){
           vm.alertMessage = ('Event Resized to make dayDelta ' + delta);
        };
        /* add and removes an event source of choice */
        vm.addRemoveEventSource = function(sources,source) {
          var canAdd = 0;
          angular.forEach(sources,function(value, key){
            if(sources[key] === source){
              sources.splice(key,1);
              canAdd = 1;
            }
          });
          if(canAdd === 0){
            sources.push(source);
          }
        };
        /* add custom event*/
        vm.addEvent = function(evento,indice) {
          var classe = vm.checarClasse(evento);
          vm.events.push({
              title: evento.area.titulo +' - '+ evento.morador.nome,
              start: new Date(evento.reserva),
              end: new Date(evento.reserva),
              allDay: true,
              stick: true,
              className: [classe],
              index: indice
          });
        };
        /* remove event */
        vm.remove = function(index) {
          vm.events.splice(index,1);          
        };

        /* Render Tooltip */
        vm.eventRender = function( event, element, view ) {
            element.attr({'tooltip': event.title,
                         'tooltip-append-to-body': true});
            $compile(element)(vm);
        };

        function eventClick(indice){
          console.log(indice);
        }

        /* config object */
        vm.uiConfig = {
          calendar:{
            height: 450,
            editable: true,
            header:{
              left: 'title',
              center: '',
              right: 'today prev,next'
            },
            eventClick: vm.alertOnEventClick,
            eventDrop: vm.alertOnDrop,
            eventResize: vm.alertOnResize,
            eventRender: vm.eventRender
          }
        };


        /* event sources array*/
        vm.eventSources = [vm.events];                     
        

        //Metodos      
        function activate() {
           vm.findAll();
        }

        function visualizar (objeto) {
            objeto.isView = true;
            ReservaFactory.setReserva(objeto);
            $state.go('reserva-manter');              
        } 


        function remover(codigo){
            ReservaService.remove(codigo).then(function onSuccess(response) {                
                activate();
            }).catch(function onError(response) {
                console.log(response);
            });
        }


        function checarClasse(evento){
          var timeStamp = new Date().getTime();
          if(evento.status === 'R'){
            if(evento.reserva < timeStamp){
              return 'old-event';
            }else{
              return '';
            }
          }else if(evento.status === 'C'){
            return 'canceled-event';
          }else if(evento.status === 'P'){
            return 'pendente-event';
          }
        }


        function findAll() {
            ReservaService.findAll().then(function onSuccess(response) {
                vm.reservas = ReservaFactory.convertList(response.data);    
                if(vm.reservas.length > 0){
                  for (var i = 0; i < vm.reservas.length; ++i) {
                    vm.addEvent(vm.reservas[i],i);
                  }                  
                }                
            }).catch(function onError(response) {
                console.log(response);
            });
        };


        activate(); 

    }
})();
