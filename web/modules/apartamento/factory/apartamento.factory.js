(function () {
    'use strict';
    angular
    .module('cdm.system.module.apartamento')
    .factory('ApartamentoFactory', ApartamentoFactory);
    
    ApartamentoFactory.$inject = [];
    var apartamento = {};


    function ApartamentoFactory(){

        var exports = {
            Apartamento: Apartamento,
            convert: convert,
            convertList: convertList,
            convertBack:convertBack,
            getApartamento:getApartamento,
            setApartamento:setApartamento,
            limparApartamento:limparApartamento 
        };

        return exports;


        function Apartamento(id, numero, bloco, bosque, proprietario_id,nome_prop, cpf_prop, fone_principal_prop,fone_secundario_prop,rg_prop) {
            this.id = id;
            this.numero = numero;
            this.bloco = bloco;
            this.bosque = bosque;
            this.descricao = 'Bosque: '+bosque+' - Bloco: '+bloco+' - Apto: '+numero;
            this.proprietario = {
                id: proprietario_id,
                nome: nome_prop,
                cpf: cpf_prop,
                fonePrincipal: fone_principal_prop,
                foneSecundario: fone_secundario_prop,                           
                rg: rg_prop
            }            
        }

        function convertDate(data){
            return new Date(parseInt(data));
        }


        function convert(item) {
            return new Apartamento(
               item.id,
               item.numero,
               item.bloco,
               item.bosque,
               item.proprietario_id,
               item.nome_prop, 
               item.cpf_prop, 
               item.fone_principal_prop,
               item.fone_secundario_prop,
               item.rg_prop);
        }


        function convertList(items) {
            var converted = [];

            for (var i = 0; i < items.length; ++i) {
                converted.push(this.convert(items[i]));
            }

            return converted;
        }

        function convertBack(apartamento) {
            var converted = {};
                converted.id = apartamento.id;
                converted.numero = apartamento.numero;
                converted.bloco = apartamento.bloco;
                converted.bosque = apartamento.bosque;
                converted.proprietario_id = apartamento.proprietario.id;                
            return converted;
        }

        function getApartamento(){
            return this.apartamento;
        }

        function setApartamento(item){
            this.apartamento = item;
        }

        function limparApartamento(){
            this.apartamento = undefined;
        }


    }
})();
