(function () {
    'use strict';
    angular
    .module('cdm.system.module.proprietario')
    .factory('ProprietarioFactory', ProprietarioFactory);
    
    ProprietarioFactory.$inject = [];
    var proprietario = {};


    function ProprietarioFactory(){

        var exports = {
            Proprietario: Proprietario,
            convert: convert,
            convertList: convertList,
            convertBack:convertBack,
            getProprietario:getProprietario,
            setProprietario:setProprietario,
            limparProprietario:limparProprietario 
        };

        return exports;


        function Proprietario(id,nome,email,cpf,rg,foto,adimplente,debito,morador,fone_principal,fone_secundario) {
            this.id = id;
            this.nome = nome;
            this.email = email;
            this.cpf = cpf;
            this.rg = rg;
            this.foto = foto;
            this.adimplente = adimplente;
            this.debito = debito;
            this.morador = morador;
            this.fonePrincipal = fone_principal;
            this.foneSecundario = fone_secundario;
        }

        function convertDate(data){
            return new Date(parseInt(data));
        }


        function convert(item) {
            return new Proprietario(
               item.id,
               item.nome,
               item.email,
               item.cpf,
               item.rg,
               item.foto,
               item.adimplente,
               item.debito,
               item.morador,
               item.fone_principal,
               item.fone_secundario);
        }


        function convertList(items) {
            var converted = [];

            for (var i = 0; i < items.length; ++i) {
                converted.push(this.convert(items[i]));
            }

            return converted;
        }

        function convertBack(proprietario) {
            var converted = {};
                converted.id = proprietario.id;
                converted.nome = proprietario.nome;
                converted.email = proprietario.email;
                converted.cpf = proprietario.cpf;
                converted.rg = proprietario.rg;
                converted.foto = proprietario.foto;
                converted.adimplente = proprietario.adimplente;
                converted.debito = proprietario.debito;
                converted.morador = proprietario.morador;
                converted.fone_principal = proprietario.fonePrincipal;
                converted.fone_secundario = proprietario.foneSecundario;
            return converted;
        }

        function getProprietario(){
            return this.proprietario;
        }

        function setProprietario(item){
            this.proprietario = item;
        }

        function limparProprietario(){
            this.proprietario = undefined;
        }


    }
})();
