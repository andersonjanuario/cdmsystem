angular
    .module('cdm.system.module')
    .run(appRun);

/* @ngInject */
function appRun(routerHelper) {
    routerHelper.configureStates(getStates());
}

function getStates() {
    return [
        {
            state: 'home',
            config: {
                url: 'cdmsystem/web/',
                controller: 'HomeController',
                controllerAs: 'HomeCtrl',
                templateUrl: 'modules/home/templates/home.template.html',
                resolve: {
                    loadDeps: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            serie: true,
                            files: [
                            'modules/home/home.module.js',
                            'modules/home/controller/home.controller.js'
                            ]});
                    }]
                }  
            }
        },
        {
            state: 'proprietario-manter',
            config: {
                url: 'cdmsystem/web/',
                controller: 'ProprietarioManterController',
                controllerAs: 'ProprietarioManterCtrl',
                templateUrl: 'modules/proprietario/templates/proprietario.manter.template.html',
                resolve: {
                    loadDeps: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            serie: true,
                            files: [
                            'modules/proprietario/proprietario.module.js',
                            'modules/proprietario/service/proprietario.service.js',
                            'modules/proprietario/controller/proprietario.manter.controller.js'
                            ]});
                    }]
                }                                
            }
        },                                 
        {
            state: 'proprietario-listar',
            config: {
                url: 'cdmsystem/web/',
                controller: 'ProprietarioListarController',
                controllerAs: 'ProprietarioListarCtrl',
                templateUrl: 'modules/proprietario/templates/proprietario.listar.template.html',
                resolve: {
                    loadDeps: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            serie: true,
                            files: [
                            'modules/proprietario/proprietario.module.js',
                            'modules/proprietario/service/proprietario.service.js',
                            'modules/proprietario/controller/proprietario.listar.controller.js'
                            ]});
                    }]
                }                                
            }
        }
        
    ];
}
