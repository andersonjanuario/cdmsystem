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
                            'modules/proprietario/factory/proprietario.factory.js',
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
                            'modules/proprietario/factory/proprietario.factory.js',
                            'modules/proprietario/controller/proprietario.listar.controller.js'
                            ]});
                    }]
                }                                
            }
        },
        {
            state: 'apartamento-manter',
            config: {
                url: 'cdmsystem/web/',
                controller: 'ApartamentoManterController',
                controllerAs: 'ApartamentoManterCtrl',
                templateUrl: 'modules/apartamento/templates/apartamento.manter.template.html',
                resolve: {
                    loadDeps: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            serie: true,
                            files: [
                            'modules/apartamento/apartamento.module.js',
                            'modules/proprietario/proprietario.module.js',
                            'modules/apartamento/service/apartamento.service.js',
                            'modules/proprietario/service/proprietario.service.js',
                            'modules/proprietario/factory/proprietario.factory.js',
                            'modules/apartamento/factory/apartamento.factory.js',
                            'modules/apartamento/controller/apartamento.manter.controller.js'
                            ]});
                    }]
                }                                
            }
        },
        {
            state: 'apartamento-listar',
            config: {
                url: 'cdmsystem/web/',
                controller: 'ApartamentoListarController',
                controllerAs: 'ApartamentoListarCtrl',
                templateUrl: 'modules/apartamento/templates/apartamento.listar.template.html',
                resolve: {
                    loadDeps: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            serie: true,
                            files: [
                            'modules/apartamento/apartamento.module.js',
                            'modules/apartamento/service/apartamento.service.js',
                            'modules/apartamento/factory/apartamento.factory.js',
                            'modules/apartamento/controller/apartamento.listar.controller.js'
                            ]});
                    }]
                }                                
            }
        },
        {
            state: 'veiculo-manter',
            config: {
                url: 'cdmsystem/web/',
                controller: 'VeiculoManterController',
                controllerAs: 'VeiculoManterCtrl',
                templateUrl: 'modules/veiculo/templates/veiculo.manter.template.html',
                resolve: {
                    loadDeps: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            serie: true,
                            files: [                            
                            'modules/apartamento/apartamento.module.js',
                            'modules/apartamento/service/apartamento.service.js',
                            'modules/apartamento/factory/apartamento.factory.js',                            
                            'modules/veiculo/veiculo.module.js',
                            'modules/veiculo/service/veiculo.service.js',
                            'modules/veiculo/factory/veiculo.factory.js',
                            'modules/veiculo/controller/veiculo.manter.controller.js'
                            ]});
                    }]
                }                                
            }
        },        
        {
            state: 'veiculo-listar',
            config: {
                url: 'cdmsystem/web/',
                controller: 'VeiculoListarController',
                controllerAs: 'VeiculoListarCtrl',
                templateUrl: 'modules/veiculo/templates/veiculo.listar.template.html',
                resolve: {
                    loadDeps: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            serie: true,
                            files: [                            
                            'modules/apartamento/apartamento.module.js',
                            'modules/apartamento/service/apartamento.service.js',
                            'modules/apartamento/factory/apartamento.factory.js',                            
                            'modules/veiculo/veiculo.module.js',
                            'modules/veiculo/service/veiculo.service.js',
                            'modules/veiculo/factory/veiculo.factory.js',
                            'modules/veiculo/controller/veiculo.listar.controller.js'
                            ]});
                    }]
                }                                
            }
        },                       
        {
            state: 'morador-manter',
            config: {
                url: 'cdmsystem/web/',
                controller: 'MoradorManterController',
                controllerAs: 'MoradorManterCtrl',
                templateUrl: 'modules/morador/templates/morador.manter.template.html',
                resolve: {
                    loadDeps: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            serie: true,
                            files: [                            
                            'modules/apartamento/apartamento.module.js',
                            'modules/apartamento/service/apartamento.service.js',
                            'modules/apartamento/factory/apartamento.factory.js',                            
                            'modules/morador/morador.module.js',
                            'modules/morador/service/morador.service.js',
                            'modules/common/service/parentesco.service.js',
                            'modules/morador/factory/morador.factory.js',
                            'modules/morador/controller/morador.manter.controller.js'
                            ]});
                    }]
                }                                
            }
        },        
        {
            state: 'morador-listar',
            config: {
                url: 'cdmsystem/web/',
                controller: 'MoradorListarController',
                controllerAs: 'MoradorListarCtrl',
                templateUrl: 'modules/morador/templates/morador.listar.template.html',
                resolve: {
                    loadDeps: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            serie: true,
                            files: [                            
                            'modules/apartamento/apartamento.module.js',
                            'modules/apartamento/service/apartamento.service.js',
                            'modules/apartamento/factory/apartamento.factory.js',                            
                            'modules/morador/morador.module.js',
                            'modules/morador/service/morador.service.js',
                            'modules/morador/factory/morador.factory.js',
                            'modules/morador/controller/morador.listar.controller.js'
                            ]});
                    }]
                }                                
            }
        },
        {
            state: 'area-manter',
            config: {
                url: 'cdmsystem/web/',
                controller: 'AreaManterController',
                controllerAs: 'AreaManterCtrl',
                templateUrl: 'modules/area/templates/area.manter.template.html',
                resolve: {
                    loadDeps: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            serie: true,
                            files: [
                            'modules/area/area.module.js',
                            'modules/area/service/area.service.js',
                            'modules/area/factory/area.factory.js',
                            'modules/area/controller/area.manter.controller.js'
                            ]});
                    }]
                }                                
            }
        },                                 
        {
            state: 'area-listar',
            config: {
                url: 'cdmsystem/web/',
                controller: 'AreaListarController',
                controllerAs: 'AreaListarCtrl',
                templateUrl: 'modules/area/templates/area.listar.template.html',
                resolve: {
                    loadDeps: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            serie: true,
                            files: [
                            'modules/area/area.module.js',
                            'modules/area/service/area.service.js',
                            'modules/area/factory/area.factory.js',
                            'modules/area/controller/area.listar.controller.js'
                            ]});
                    }]
                }                                
            }
        },
        {
            state: 'visitante-listar',
            config: {
                url: 'cdmsystem/web/',
                controller: 'VisitanteListarController',
                controllerAs: 'VisitanteListarCtrl',
                templateUrl: 'modules/visitante/templates/visitante.listar.template.html',
                resolve: {
                    loadDeps: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            serie: true,
                            files: [
                            'modules/visitante/visitante.module.js',
                            'modules/visitante/service/visitante.service.js',
                            'modules/visitante/factory/visitante.factory.js',
                            'modules/visitante/controller/visitante.listar.controller.js'
                            ]});
                    }]
                }                                
            }
        }, 
        {
            state: 'visitante-manter',
            config: {
                url: 'cdmsystem/web/',
                controller: 'VisitanteManterController',
                controllerAs: 'VisitanteManterCtrl',
                templateUrl: 'modules/visitante/templates/visitante.manter.template.html',
                resolve: {
                    loadDeps: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            serie: true,
                            files: [
                            'modules/apartamento/apartamento.module.js',
                            'modules/apartamento/service/apartamento.service.js',
                            'modules/apartamento/factory/apartamento.factory.js',
                            'modules/morador/morador.module.js',
                            'modules/morador/service/morador.service.js',
                            'modules/morador/factory/morador.factory.js',                                                        
                            'modules/visitante/visitante.module.js',
                            'modules/visitante/service/visitante.service.js',
                            'modules/visitante/factory/visitante.factory.js',
                            'modules/visitante/controller/visitante.manter.controller.js'
                            ]});
                    }]
                }                                
            }
        },                 
        {
            state: 'visitante-morador-listar',
            config: {
                url: 'cdmsystem/web/',
                controller: 'VisitanteMoradorListarController',
                controllerAs: 'VisitanteMoradorListarCtrl',
                templateUrl: 'modules/visitante/templates/visitante.morador.listar.template.html',
                resolve: {
                    loadDeps: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            serie: true,
                            files: [
                            'modules/morador/morador.module.js',
                            'modules/visitante/visitante.module.js',
                            'modules/morador/service/morador.service.js',
                            'modules/visitante/factory/visitante.morador.factory.js',
                            'modules/visitante/controller/visitante.morador.listar.controller.js'
                            ]});
                    }]
                }                                
            }
        },
        {
            state: 'reserva-manter',
            config: {
                url: 'cdmsystem/web/',
                controller: 'ReservaManterController',
                controllerAs: 'ReservaManterCtrl',
                templateUrl: 'modules/area/templates/reserva.manter.template.html',
                resolve: {
                    loadDeps: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            serie: true,
                            files: [
                            'modules/apartamento/apartamento.module.js',
                            'modules/apartamento/service/apartamento.service.js',
                            'modules/apartamento/factory/apartamento.factory.js',
                            'modules/morador/morador.module.js',
                            'modules/morador/service/morador.service.js',
                            'modules/morador/factory/morador.factory.js',                                                        
                            'modules/area/area.module.js',
                            'modules/area/service/area.service.js',
                            'modules/area/factory/area.factory.js',                            
                            'modules/area/service/reserva.service.js',
                            'modules/area/factory/reserva.factory.js',
                            'modules/area/controller/reserva.manter.controller.js'
                            ]});
                    }]
                }                                
            }
        },
        {
            state: 'reserva-visualizar',
            config: {
                url: 'cdmsystem/web/',
                controller: 'ReservaVisualizarController',
                controllerAs: 'ReservaVisualizarCtrl',
                templateUrl: 'modules/area/templates/reserva.visualizar.template.html',
                resolve: {
                    loadDeps: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            serie: true,
                            files: [
                            'modules/area/area.module.js',
                            'modules/area/service/reserva.service.js',
                            'modules/area/factory/reserva.factory.js',
                            'modules/area/controller/reserva.visualizar.controller.js'
                            ]});
                    }]
                }                                
            }
        },
        {
            state: 'reserva-listar',
            config: {
                url: 'cdmsystem/web/',
                controller: 'ReservaListarController',
                controllerAs: 'ReservaListarCtrl',
                templateUrl: 'modules/area/templates/reserva.listar.template.html',
                resolve: {
                    loadDeps: ['$ocLazyLoad', function($ocLazyLoad) {
                        return $ocLazyLoad.load({
                            serie: true,
                            files: [
                            'modules/area/area.module.js',
                            'modules/area/service/reserva.service.js',
                            'modules/area/factory/reserva.factory.js',
                            'modules/area/controller/reserva.listar.controller.js'
                            ]});
                    }]
                }                                
            }
        }                           

    ];
}
