(function () {
    'use strict';

    angular
            .module('cdm.system.module')
            .controller('AppController', AppController);

    AppController.$inject = ['$scope','$rootScope', '$log','$state'];


    function AppController($scope,$rootScope, $log, $state) {
        var vm = this;
        //var $log = $log.getLogger('CONSTANTES.LOG_FORUM');
        vm.titulo = "Jatobás";
        vm.getHome = getHome;
        vm.getProprietarioListar = getProprietarioListar;
        vm.getProprietarioNovo = getProprietarioNovo;

        function activate() {
            $state.go('home');
        }

        function getProprietarioListar (){
             $state.go('proprietario');
        }

        function getProprietarioNovo (){
             $state.go('proprietario');
        }

        function getHome (){
             $state.go('home');
        }

//        $rootScope.$on('$stateChangeError', function(event) {
 // $state.go('404');
//});

        activate();

    }
})();
