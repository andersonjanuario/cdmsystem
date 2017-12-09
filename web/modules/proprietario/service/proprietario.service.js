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
        this.findById = findById;


        function findAll() {
            var timestamp = new Date().getTime();
            var _params = {
                'timestamp':timestamp
            };
            return $http.get(_baseUrl,{params:_params});
        };

        function findById(codigo) {
            var timestamp = new Date().getTime();
            var _params = {
                'timestamp':timestamp
            };
            return $http.get(_baseUrl + '/' +codigo , {params:_params});
        };


        function findByFilter(skipIn, takeIn, pesquisa, order, sort) {
            var skip = undefined;
            var take = undefined;
            if(angular.isUndefined(skipIn) && angular.isUndefined(takeIn)){
                skip = 0;                
                take = 5;
            } else {
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


        function create(proprietario) {
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
