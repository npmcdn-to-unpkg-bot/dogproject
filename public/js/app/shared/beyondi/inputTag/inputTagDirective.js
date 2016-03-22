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