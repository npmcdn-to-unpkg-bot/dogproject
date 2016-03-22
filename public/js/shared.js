angular.module('petagree')

    .directive('byndInputTag', function() {
    return {
        restrict: 'E',
        scope: { tags: '=' },
        template:

        '<input type="text" class="form-control" placeholder="Add another bread?" ng-model="tag_value" /> ' +
        '<div class="tags">' +
        '<ul class="list-unstyled"><li ng-repeat="(idx, tag) in tags"><a class="tag" ng-click="removeTag(idx)"><i class="fa fa-times"></i>{{tag}}</a></li></ul>' +
        '</div>',

        link: function ( $scope, $element ) {

            if(!$scope.tags.length) {
                $scope.tags = [];
            }

            // FIXME: this is lazy and error-prone
            var input = angular.element( $element.children()[0] );

            // This adds the new tag to the tags array
            $scope.addTag = function() {
                $scope.tags.push( $scope.tag_value );
                $scope.tag_value = "";
            };

            // This is the ng-click handler to remove an item
            $scope.removeTag = function ( idx ) {
                $scope.tags.splice( idx, 1 );
            };

            // Capture all keypresses
            input.bind( 'keypress', function ( event ) {
                // But we only care when Enter was pressed
                if ( event.keyCode == 13 ) {
                    // There's probably a better way to handle this...
                    $scope.$apply( $scope.addTag );
                }
            });
        }
    };
});
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
angular.module('petagree').controller('ModalController', function ($scope, $uibModalInstance, item,Seller, toastr) {

    $scope.item = item;

    $scope.review = {email:[]};

    $scope.currentDate = new Date();

    //$scope.ok = function () {
    //    $uibModalInstance.close($scope.selected.item);
    //};
    //
    //$scope.cancel = function () {
    //    $uibModalInstance.dismiss('cancel');
    //};

    $scope.addReviewField = function() {
        $scope.item.push('email'+ $scope.item.length);
    }

    $scope.requestReview = function(reviewForm,review) {

        console.log(review);

        if(reviewForm.$valid) {

            Seller.requestReview(review).then(function(response) {
                console.log(response);
                toastr.success('Your request for reviews are sent to the your customers!','Success!')

            }).catch(function(response){

            })
        }
    }
});
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
//# sourceMappingURL=shared.js.map
