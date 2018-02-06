(function () {
    'use strict';
    angular
    .module('cdm.system.module.visitante')
    .factory('VisitanteFactory', VisitanteFactory);
    
    VisitanteFactory.$inject = [];
    var visitante = {};


    function VisitanteFactory(){

        var exports = {
            Visitante: Visitante,
            convert: convert,
            convertList: convertList,
            convertBack:convertBack,
            getVisitante:getVisitante,
            setVisitante:setVisitante,
            limparVisitante:limparVisitante 
        };

        return exports;


        function Visitante(id,nome,cpf,rg,foto,idade) {
            this.id = id;
            this.nome = nome;
            this.cpf = cpf;
            this.rg = rg;
            this.foto = foto;
            this.idade = idade;
        }

        function convertDate(data){
            return new Date(parseInt(data));
        }


        function convert(item) {
            return new Visitante(
               item.id,
               item.nome,
               item.cpf,
               item.rg,
               item.foto,
               item.idade);
        }


        function convertList(items) {
            var converted = [];

            for (var i = 0; i < items.length; ++i) {
                converted.push(this.convert(items[i]));
            }

            return converted;
        }

        function convertBack(morador,visitantes) {
            var converted = {};
                converted.morador_id = morador.id;
                converted.visitantes = visitantes;                
            return converted;
        }

        function getVisitante(){
            return this.visitante;
        }

        function setVisitante(item){
            this.visitante = item;
        }

        function limparVisitante(){
            this.visitante = undefined;
        }


    }
})();
