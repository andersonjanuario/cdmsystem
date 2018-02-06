(function() {
    'use strict';

    angular
    .module('cdm.system.module.morador')
    .service('MoradorService', MoradorService);

    MoradorService.$inject = ['$http'];

    function MoradorService($http) {
        var _Url = 'http://localhost:8091/cdmsystem/public/';
        var _baseUrl = _Url + 'morador';
        var _baseUrlVisitMorador = _Url + 'visitantemorador'

        // Methods
        this.create = create;
        this.update = update;
        this.remove = remove;
        this.findByFilter = findByFilter;
        this.findAll = findAll;
        this.findById = findById;
        this.findByApartamento = findByApartamento;
        this.findMoradoresByVisitId = findMoradoresByVisitId;
        this.findByDateMorador = findByDateMorador;


        function findAll() {
            var timestamp = new Date().getTime();
            var _params = {
                'timestamp':timestamp
            };
            return $http.get(_baseUrl + '/all' ,{params:_params});
        };

        function findById(codigo) {
            var timestamp = new Date().getTime();
            var _params = {
                'timestamp':timestamp
            };
            return $http.get(_baseUrl + '/' +codigo , {params:_params});
        };

        function findByApartamento(codigo) {
            var timestamp = new Date().getTime();
            var _params = {
                'timestamp':timestamp
            };
            return $http.get(_baseUrl + '/findByApartamento/' +codigo , {params:_params});
        };


        function findMoradoresByVisitId(codigo) {
            var timestamp = new Date().getTime();
            var _params = {
                'timestamp':timestamp
            };
            return $http.get(_baseUrlVisitMorador + '/moradores/' +codigo , {params:_params});
        };        


        function findByFilter(skipIn, takeIn, pesquisa, order, sort) {
            var skip = 0;
            var take = 5;
            if(!angular.isUndefined(skipIn) && !angular.isUndefined(takeIn)){
                skip = (skipIn - 1)*takeIn;
                take = takeIn;
            } 

            var timestap = new Date().getTime();
            var _params = {
                'skip': skip,
                'take': take,
                'pesquisa': pesquisa,
                'order': order,
                'sort': (sort === false)?'desc':'asc',
                'timestap':timestap
            };
            return $http.get(_baseUrl, { params: _params });
        };


        function create(morador) {
            return $http.post(_baseUrl,morador);
        };


        function update(morador) {
            return $http.put(_baseUrl + '/' + morador.id, morador);
        };


        function remove(codigo) {
            return $http.delete(_baseUrl + '/' +codigo);
        };


        function findByDateMorador(skipIn, takeIn, pesquisa, order, sort) {
            var skip = 0;
            var take = 5;
            if(!angular.isUndefined(skipIn) && !angular.isUndefined(takeIn)){
                skip = (skipIn - 1)*takeIn;
                take = takeIn;
            } 

            var timestap = new Date().getTime();
            var _params = {
                'skip': skip,
                'take': take,
                'pesquisa': pesquisa,
                'order': order,
                'sort': (sort === false)?'desc':'asc',
                'timestap':timestap
            };
            return $http.get(_baseUrlVisitMorador + '/data', { params: _params });
        };        


    }
})();
