angular.module('petagree').directive('byndUiModal', ['$uibModal', function($uibModal) {
    return {
        restrict: 'A',
        scope:true,
        link: function($scope, $element, $attrs) {

            if(typeof $attrs.scopeForward != 'undefined')
            {
                $scope.item = $scope.$eval($attrs.scopeForward);
            }

            console.log($scope.item);

            $scope.open = function() {

                $uibModal.open({
                    animation: true,
                    templateUrl: 'js/app/shared/beyondi/uiModal/templates/' + $attrs.byndUiModal + '.template.html',
                    size:'lg',
                    resolve: {
                        item: function () {
                            return $scope.item;
                        }
                    },
                    controller: 'ModalController'
                });
            };
        }
    };
}]);