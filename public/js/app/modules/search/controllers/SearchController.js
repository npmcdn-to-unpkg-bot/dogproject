module.controller('SearchController', function($scope, Dog, $location, dogs) {

    $scope.search = {};

    $scope.search.tags = ['test'];

    $scope.dogs = dogs;

    $scope.currentPage = 1;

    $scope.numPerPage = 10;

    $scope.maxSize = 5;


    angular.forEach(_.values($scope.$eval($location.search().filter)), function(filter,key) {
        angular.forEach(filter,function(value,key) {
            $scope.search[key] = value;
        });
    });

    /**
     * Watch Pagination
     *
     */

    $scope.$watch('currentPage + numPerPage', function() {
        var begin = (($scope.currentPage - 1) * $scope.numPerPage)
            , end = begin + $scope.numPerPage;

        $scope.filteredDogs = $scope.dogs.slice(begin, end);
    });

    /**
     * Watch Dogs Collection
     *
     */

    $scope.$watch('dogs',function() {
        var begin = (($scope.currentPage - 1) * $scope.numPerPage)
            , end = begin + $scope.numPerPage;

        $scope.filteredDogs = $scope.dogs.slice(begin, end);
    });

    /**
     * Update Filters and get filtered dogs.
     *
     * @param filters
     */

    $scope.updateFilters = function (filters) {

        $scope.filter = {whereBetween:{},whereIn:{}};

        angular.forEach(filters,function(filter,key) {

            var cleanFilter = _.compact(_.values(filter));

            if(cleanFilter.length) {

                if(key == 'cost') {
                    $scope.filter.whereBetween[key] = filter;
                } else {
                    $scope.filter.whereIn[key] = filter;
                }
            }
        });

        if(_.isEmpty($scope.filter.whereIn)) {
            delete $scope.filter.whereIn;
        }

        if(_.isEmpty($scope.filter.whereBetween)) {
            delete $scope.filter.whereBetween;
        }

        $location.search('filter',JSON.stringify($scope.filter));
        $scope.filterDogs($scope.filter);
    };

    /**
     * Filter Dogs
     *
     * @param filter
     */

    $scope.filterDogs = function(filter) {

        if(typeof filter != 'undefined') {
            Dog.getWith({relations:'owner,mother,father,breed,shelter',filter:filter}).then(function(dogs){
                $scope.dogs = dogs.data;
            });
        }
    };
});