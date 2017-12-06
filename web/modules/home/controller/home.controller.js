(function () {
    'use strict';

    angular
            .module('cdm.system.module.home')
            .controller('HomeController', HomeController);

    HomeController.$inject = ['$scope'];


    function HomeController($scope) {
        var vm = this;
        vm.titulo = "home";      
        
        function activate() {}



        activate();

    }
})();
