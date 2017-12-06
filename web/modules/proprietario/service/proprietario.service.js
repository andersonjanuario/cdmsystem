(function() {
    'use strict';

    angular
    .module('cdm.system.module.proprietario')
    .service('ProprietarioService', ProprietarioService);

    ProprietarioService.$inject = ['$http'];

    function ProprietarioService($http) {

        var _baseUrl = 'http://localhost:8091/cdmsystem/public/proprietario';

        // Methods
        this.create = create;
        this.update = update;
        this.remove = remove;
        this.findByFilter = findByFilter;
        this.findAll = findAll;


        function findAll() {
            var timestamp = new Date().getTime();
            var _params = {
                'timestamp':timestamp
            };
            return $http.get(_baseUrl,{params:_params});
        };



        function findByFilter(codigo,assunto, texto, solucao, dataInicioVigencia,
            dataPrevisao,status, numeroPagina, top,sort,asc) {
            if(angular.isUndefined(numeroPagina) && angular.isUndefined(top)){
                skip = 0;
                top = 5;
            } else {
                var skip = (numeroPagina - 1)*top;
            }
            var timestap = new Date().getTime();
            var _params = {
                'codigo': codigo,
                'assunto': assunto,
                'texto': texto,
                'solucao': solucao,
                'dataInicioVigencia': dataInicioVigencia,
                'dataPrevisao': dataPrevisao,
                'status': status,
                'skip': skip,
                'top': top,
                'sort': sort,
                'asc': asc,
                'timestap':timestap
            };


            return $http.get(_baseUrl, { params: _params });
        };



        function create(proprietario) {
            /*return $http({
                method: 'POST',
                url: _baseUrl,
                data: $.param(proprietario),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });*/
            return $http.post(_baseUrl,proprietario);
        };


        function update(proprietario) {
            return $http.put(_baseUrl + '/' + proprietario.id, proprietario);
        };


        function remove(codigo) {
            return $http.delete(_baseUrl + '/' +codigo);
        };


    }
})();
