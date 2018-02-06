(function () {
	'use strict';

	angular.module('cdm.system.module').directive('alerta', Alerta);

	Alerta.$inject = [];

function Alerta() {
	return {
		restrict: 'AEC',
		link: function(scope, el, attr, controller){},
		scope:{
			alerts: "@alerts"
		},
		templateUrl: "modules/common/templates/alerta.template.html",
		controller: ['$scope', function($scope){
				var vm = this;
				vm.closeAlert = closeAlert;
				vm.alerts = alerts;
				function closeAlert(index){
					vm.alerts.splice(index, 1);
				}

		}],
		controllerAs:"alertaCtrl"
	};
};

})();
