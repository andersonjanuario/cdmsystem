(function () {
    'use strict';
    angular
    .module('cdm.system.module.morador')
    .factory('MoradorFactory', MoradorFactory);
    
    MoradorFactory.$inject = [];
    var morador = {};


    function MoradorFactory(){

        var exports = {
            Morador: Morador,
            convert: convert,
            convertList: convertList,
            convertBack:convertBack,
            getMorador:getMorador,
            setMorador:setMorador,
            limparMorador:limparMorador 
        };

        return exports;

        function convertDate(data) {
            if(!angular.isUndefined(data) && data !== null && data !== ''){
                var data = new Date(data);
                var dataTexto = ("0" + data.getDate()).slice(-2).toString() + '/' +
                ("0" + (data.getMonth() + 1)).slice(-2).toString() + '/' + 
                data.getFullYear().toString(); 
                return dataTexto;
            }else{
                return undefined;
            }
        }     


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

        function Morador(id, nome, email, cpf, inquilino, foto,idade,entrada,saida,status,rg,fone_principal,fone_secundario, numero_apto, bloco_apto, bosque_apto, apartamento_id, parentesco_id, descricao_parent ) {
            this.id = id;
            this.nome = nome;
            this.email = email;
            this.cpf = cpf;
            this.inquilino = inquilino;
            this.foto = foto;
            this.idade = idade;
            this.entrada = convertDate(entrada);
            this.saida = convertDate(saida);
            this.status = status+'';
            this.rg = rg;
            this.fone_principal = fone_principal;
            this.fone_secundario = fone_secundario;
            this.parentesco_id = parentesco_id;
            this.parentesco = {
                id: parentesco_id,
                descricao: descricao_parent
            };
            this.apartamento = {
                id: apartamento_id,
                numero: numero_apto,
                bloco: bloco_apto,
                bosque: bosque_apto,
                descricao: 'Bosque: '+bosque_apto+' - Bloco: '+bloco_apto+' - Apto: '+numero_apto
            };            
        }


        function convert(item) {
            return new Morador(
               item.id,
               item.nome, 
               item.email, 
               item.cpf, 
               item.inquilino, 
               item.foto,
               item.idade,
               item.entrada,
               item.saida,
               item.status,
               item.rg,
               item.fone_principal,
               item.fone_secundario,
               item.numero_apto,
               item.bloco_apto,
               item.bosque_apto,
               item.apartamento_id,
               item.parentesco_id,
               item.descricao_parent);
        }


        function convertList(items) {
            var converted = [];

            for (var i = 0; i < items.length; ++i) {
                converted.push(this.convert(items[i]));
            }

            return converted;
        }


        function convertBack(morador) {
            var converted = {};
            converted.id = morador.id;
            converted.nome = morador.nome;
            converted.email = morador.email;
            converted.cpf = morador.cpf;
            converted.inquilino = morador.inquilino;
            converted.foto = morador.foto;
            converted.idade = morador.idade;
            converted.entrada = covertGetTime(morador.entrada); //morador.entrada;
            converted.saida = covertGetTime(morador.saida); //morador.saida;
            converted.status = morador.status;
            converted.rg = morador.rg;
            converted.fone_principal = morador.fone_principal;
            converted.fone_secundario = morador.fone_secundario;
            converted.parentesco_id = morador.parentesco.id;
            converted.apartamento_id = morador.apartamento.id;                
            return converted;
        }

        function getMorador(){
            return this.morador;
        }

        function setMorador(item){
            this.morador = item;
        }

        function limparMorador(){
            this.morador = undefined;
        }


    }
})();
