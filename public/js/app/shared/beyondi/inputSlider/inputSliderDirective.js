angular.module('petagree').directive('byndInputSlider', function() {
    return {
        restrict: 'E',
        scope: {
            slide: '=ngModel'
        },
        require: 'ngModel',
        link: function($scope, $element, $attrs) {

            $scope.slide = $scope.$eval($attrs.noUiSlider).start;

            var slider  = noUiSlider.create( $element[0],
                $scope.$eval($attrs.noUiSlider)
            );

            slider.on('set',function(object)
            {
                if(object.length == 1) {
                    $scope.slide = parseInt(object[0]);
                } else {
                    $scope.slide = object;
                }
            })
        }
    };
});