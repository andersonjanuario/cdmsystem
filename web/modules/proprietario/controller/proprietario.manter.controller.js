(function () {
    'use strict';

    angular
            .module('cdm.system.module.proprietario')
            .controller('ProprietarioManterController', ProprietarioManterController);

    ProprietarioManterController.$inject = ['$scope'];


    function ProprietarioManterController($scope) {
        var vm = this;
        vm.titulo = "proprietario manter";      
        
        function activate() {}



        activate();

    }
})();
