(function() {
    'use strict';

    angular
    .module('cdm.system.module.area')
    .service('ReservaService', ReservaService);

    ReservaService.$inject = ['$http'];

    function ReservaService($http) {

        var _baseUrl = 'http://localhost:8091/cdmsystem/public/areamorador';

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
            return $http.get(_baseUrl + '/all' ,{params:_params});
        };

        function findById(codigo) {
            var timestamp = new Date().getTime();
            var _params = {
                'timestamp':timestamp
            };
            return $http.get(_baseUrl + '/' +codigo , {params:_params});
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


        function create(reserva) {
            return $http.post(_baseUrl,reserva);
        };


        function update(reserva) {
            return $http.put(_baseUrl + '/' + reserva.id, reserva);
        };


        function remove(codigo) {
            return $http.delete(_baseUrl + '/' +codigo);
        };


    }
})();
