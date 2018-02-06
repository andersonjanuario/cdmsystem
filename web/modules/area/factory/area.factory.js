(function () {
    'use strict';
    angular
    .module('cdm.system.module.area')
    .factory('AreaFactory', AreaFactory);
    
    AreaFactory.$inject = [];
    var area = {};


    function AreaFactory(){

        var exports = {
            Area: Area,
            convert: convert,
            convertList: convertList,
            convertBack:convertBack,
            getArea:getArea,
            setArea:setArea,
            limparArea:limparArea 
        };

        return exports;


        function Area(id, titulo, descricao) {
            this.id = id;
            this.titulo = titulo;
            this.descricao = descricao;            
        }

        function convertDate(data){
            return new Date(parseInt(data));
        }


        function convert(item) {
            return new Area(
               item.id,
               item.titulo, 
               item.descricao);
        }


        function convertList(items) {
            var converted = [];

            for (var i = 0; i < items.length; ++i) {
                converted.push(this.convert(items[i]));
            }

            return converted;
        }

        function convertBack(area) {
            var converted = {};
                converted.id = area.id;
                converted.titulo = area.titulo;
                converted.descricao = area.descricao;                           
            return converted;
        }

        function getArea(){
            return this.area;
        }

        function setArea(item){
            this.area = item;
        }

        function limparArea(){
            this.area = undefined;
        }


    }
})();
