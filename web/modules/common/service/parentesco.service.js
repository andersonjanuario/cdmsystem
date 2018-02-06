(function() {
    'use strict';

    angular
    .module('cdm.system.module')
    .service('ParentescoService', ParentescoService);

    ParentescoService.$inject = ['$http'];

    function ParentescoService($http) {

        var _baseUrl = 'http://localhost:8091/cdmsystem/public/parentesco';

        // Methods
        this.findById = findById;
        this.findAll = findAll;


        function findAll() {
            var timestamp = new Date().getTime();
            var _params = {
                'timestamp':timestamp
            };
            return $http.get(_baseUrl ,{params:_params});
        };

        function findById(codigo) {
            var timestamp = new Date().getTime();
            var _params = {
                'timestamp':timestamp
            };
            return $http.get(_baseUrl + '/' +codigo , {params:_params});
        };    

    }
})();
