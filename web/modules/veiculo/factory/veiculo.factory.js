(function () {
    'use strict';
    angular
    .module('cdm.system.module.veiculo')
    .factory('VeiculoFactory', VeiculoFactory);
    
    VeiculoFactory.$inject = [];
    var veiculo = {};


    function VeiculoFactory(){

        var exports = {
            Veiculo: Veiculo,
            convert: convert,
            convertList: convertList,
            convertBack:convertBack,
            getVeiculo:getVeiculo,
            setVeiculo:setVeiculo,
            limparVeiculo:limparVeiculo 
        };

        return exports;


        function Veiculo(id, placa, descricao, cor, tipo, numero_apto, bloco_apto, bosque_apto, apartamento_id ) {
            this.id = id;
            this.placa = placa;
            this.descricao = descricao;
            this.cor = cor;
            this.tipo = tipo
            this.apartamento = {
                id: apartamento_id,
                numero: numero_apto,
                bloco: bloco_apto,
                bosque: bosque_apto,
                descricao: 'Bosque: '+bosque_apto+' - Bloco: '+bloco_apto+' - Apto: '+numero_apto            
            }            
        }

        function convertDate(data){
            return new Date(parseInt(data));
        }


        function convert(item) {
            return new Veiculo(
               item.id,
               item.placa, 
               item.descricao, 
               item.cor, 
               item.tipo,
               item.numero_apto,
               item.bloco_apto,
               item.bosque_apto,
               item.apartamento_id);
        }


        function convertList(items) {
            var converted = [];

            for (var i = 0; i < items.length; ++i) {
                converted.push(this.convert(items[i]));
            }

            return converted;
        }

        function convertBack(veiculo) {
            var converted = {};
                converted.id = veiculo.id;
                converted.placa = veiculo.placa;
                converted.descricao = veiculo.descricao;
                converted.cor = veiculo.cor;
                converted.tipo = veiculo.tipo
                converted.apartamento_id = veiculo.apartamento.id;                
            return converted;
        }

        function getVeiculo(){
            return this.veiculo;
        }

        function setVeiculo(item){
            this.veiculo = item;
        }

        function limparVeiculo(){
            this.veiculo = undefined;
        }


    }
})();
