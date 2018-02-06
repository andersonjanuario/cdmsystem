(function () {
    'use strict';
    angular
    .module('cdm.system.module.visitante')
    .factory('VisitanteMoradorFactory', VisitanteMoradorFactory);
    
    VisitanteMoradorFactory.$inject = [];
    var visitante = {};


    function VisitanteMoradorFactory(){

        var exports = {
            VisitanteMorador: VisitanteMorador,
            convert: convert,
            convertList: convertList,            
            getVisitanteMorador:getVisitanteMorador,
            setVisitanteMorador:setVisitanteMorador,
            limparVisitanteMorador:limparVisitanteMorador 
        };

        return exports;

        function formaterData(dataIn){
            if(!angular.isUndefined(dataIn) && dataIn !== null && dataIn !== ''){
                var data = new Date(dataIn);
                return ("0" + data.getDate()).slice(-2).toString() + '/'+ ("0" + (data.getMonth() + 1)).slice(-2).toString() +'/'+  data.getFullYear().toString();
            }
        }


        function VisitanteMorador(morador_id,nome,numero_apto,bloco_apto,bosque_apto,data_visita) {
            this.id = morador_id;
            this.nome = nome;
            this.numero_apto = numero_apto;
            this.bloco_apto = bloco_apto;
            this.bosque_apto = bosque_apto;
            this.data_visita = formaterData(data_visita);
            this.apartamento = 'Bosque: '+bosque_apto+' - Bloco: '+bloco_apto+' - Apto: '+numero_apto
        }

        function convertDate(data){
            return new Date(parseInt(data));
        }


        function convert(item) {
            return new VisitanteMorador(
               item.morador_id,
               item.nome,
               item.numero_apto,
               item.bloco_apto,
               item.bosque_apto,
               item.data_visita);
        }


        function convertList(items) {
            var converted = [];

            for (var i = 0; i < items.length; ++i) {
                converted.push(this.convert(items[i]));
            }

            return converted;
        }


        function getVisitanteMorador(){
            return this.visitante;
        }

        function setVisitanteMorador(item){
            this.visitante = item;
        }

        function limparVisitanteMorador(){
            this.visitante = undefined;
        }


    }
})();
