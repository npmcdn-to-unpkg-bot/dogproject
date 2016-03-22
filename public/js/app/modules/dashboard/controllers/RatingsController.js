module.controller('RatingsController', function($rootScope,$scope, loggedUser) {

    $rootScope.seller = (loggedUser.role == "1") ? loggedUser : {};

    $scope.emailFields = ['email'];

    $scope.rating1 = 0;
    $scope.rating2 = 0;
    $scope.rating3 = 0;
    $scope.rating4 = 0;
    $scope.rating5 = 0;


    $scope.handleReview = function(ratings) {

        angular.forEach(ratings,function(rating) {

            $scope.rating1 += parseFloat(rating.rating1);
            $scope.rating2 += parseFloat(rating.rating2);
            $scope.rating3 += parseFloat(rating.rating3);
            $scope.rating4 += parseFloat(rating.rating4);
            $scope.rating5 += parseFloat(rating.rating5);
        });

        $scope.rating1 = $scope.rating1 / loggedUser.seller.review.length;
        $scope.rating2 = $scope.rating2 / loggedUser.seller.review.length;
        $scope.rating3 = $scope.rating3 / loggedUser.seller.review.length;
        $scope.rating4 = $scope.rating4 / loggedUser.seller.review.length;
        $scope.rating5 = $scope.rating5 / loggedUser.seller.review.length;
    };

    $scope.handleReview(loggedUser.seller.review);
});