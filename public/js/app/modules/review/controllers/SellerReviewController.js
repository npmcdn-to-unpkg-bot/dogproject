module.controller('SellerReviewController', function($scope, $state, reviewToken, State, Suburb, Seller,toastr) {

    $scope.rating = {
        rating1: 1,
        rating2: 1,
        rating3: 1,
        rating4: 1,
        rating5: 1,
        review_token: reviewToken.review_token
    };

    /**
     * Australian States
     */

    $scope.selectedState = 'Please Select...';

    /**
     * Australian Suburbs
     */

    $scope.selectedSuburb = 'Please Select...';

    /**
     * Get Australian states.
     *
     */

    State.getList().then(function(states) {
        $scope.states = states.plain();
    });

    /**
     * Select State Function and Load Suburbs.
     *
     * @param key
     * @param id
     */

    $scope.selectState = function(key,id) {

        $scope.selectedState = $scope.states[key].name;
        $scope.selectedSuburb = 'Loading Suburbs...';

        Suburb.getList({"state_id": id}).then(function(suburbs) {

            $scope.selectedSuburb = 'Please Select...';
            $scope.suburbs = suburbs.plain();
        });

        $scope.rating.state_id = id;
    };

    /**
     * Select Suburb Function
     *
     * @param key
     * @param id
     */

    $scope.selectSuburb = function(key,id) {
        $scope.selectedSuburb = $scope.suburbs[key].suburb;
        $scope.rating.suburb_id = id;
    };

    $scope.leaveReview = function(reviewForm,rating) {

        if(reviewForm.$valid) {

            Seller.reviewSeller(rating).then(function(response){
                toastr.success('Your review is submitted. Thank you!','Success!');
                $state.go('home');
            });

        }
    }
});