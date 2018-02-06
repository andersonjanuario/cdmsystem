(function () {
    'use strict';
    angular
    .module('cdm.system.module.area')
    .factory('ReservaFactory', ReservaFactory);
    
    ReservaFactory.$inject = [];
    var reserva = {};


    function ReservaFactory(){

        var exports = {
            Reserva: Reserva,
            convert: convert,
            convertList: convertList,
            convertBack:convertBack,
            getReserva:getReserva,
            setReserva:setReserva,
            limparReserva:limparReserva 
        };

        return exports;


        function covertGetTime(dataIn){
            if(!angular.isUndefined(dataIn) && dataIn !== null && dataIn !== ''){
                var data = dataIn.replace('/','').replace('/','');
                var dia = parseInt(data.substr(0,2));
                var mes = parseInt(data.substr(2,2));
                var ano = parseInt(data.substr(4,4));
                return new Date(ano,(mes-1),dia).getTime(); 
            }else{
                return undefined;
            }
        }

        function convertDateToString(dataIn){
            if(!angular.isUndefined(dataIn) && dataIn !== null && dataIn !== ''){
                var data = dataIn.replace('-','').replace('-','');
                var dia = data.substr(6,2);
                var mes = data.substr(4,2);
                var ano = data.substr(0,4);                
                return dia +'/'+ mes +'/'+ ano;
            }else{
                return undefined;
            }
        }   


        function convertDate(dataIn){
            if(!angular.isUndefined(dataIn) && dataIn !== null && dataIn !== ''){
                var data = dataIn.replace('-','').replace('-','');
                var dia = parseInt(data.substr(6,2));
                var mes = parseInt(data.substr(4,2));
                var ano = parseInt(data.substr(0,4));
                return new Date(ano,(mes-1),dia).getTime(); 
            }else{
                return undefined;
            }                        
        }


        function Reserva(id,area_id,nome_area, morador_id,nome_morad,rg_morad, reserva, status, saldo, apartamento_id_morad) {
            this.area = {
                id:area_id,
                titulo: nome_area
            };
            this.morador = {
                id:morador_id,
                nome: nome_morad,
                rg: rg_morad
            };
            this.apartamento = {
                id: apartamento_id_morad
            }
            this.id = id;
            this.reserva = convertDate(reserva);
            this.data = convertDateToString(reserva);
            this.status = status;
            this.saldo = saldo; 
        }


        function convert(item) {
            return new Reserva(
              item.id,  
              item.area_id,
              item.nome_area, 
              item.morador_id,
              item.nome_morad,
              item.rg_morad, 
              item.reserva, 
              item.status, 
              item.saldo,
              item.apartamento_id_morad);
        }


        function convertList(items) {
            var converted = [];

            for (var i = 0; i < items.length; ++i) {
                converted.push(this.convert(items[i]));
            }

            return converted;
        }

        function convertBack(reserva) {
            var converted = {};
                converted.id = reserva.id;
                converted.area_id = reserva.area.id;
                converted.morador_id = reserva.morador.id;
                converted.reserva = covertGetTime(reserva.data);
                converted.status = reserva.status;
                converted.saldo = reserva.saldo; 

            return converted;
        }

        function getReserva(){
            return this.reserva;
        }

        function setReserva(item){
            this.reserva = item;
        }

        function limparReserva(){
            this.reserva = undefined;
        }


    }
})();
