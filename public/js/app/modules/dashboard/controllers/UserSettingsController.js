module.controller('UserSettingsController', function($rootScope, $scope, loggedUser, State, Suburb, User, Seller, Upload, toastr, BeyondiThorAuth) {

    $rootScope.seller = (loggedUser.role == "1") ? loggedUser : {};

    $scope.selectedState = loggedUser.seller.state.name;

    $scope.selectedSuburb = loggedUser.seller.suburb.suburb;

    /**
     * Select State Function
     *
     * @param state
     */
    $scope.selectState = function(state) {

        $scope.selectedState = state.name;
        $scope.selectedSuburb = 'Loading Suburbs...';

        Suburb.getList({"state_id": state.id}).then(function(suburbs) {

            $scope.selectedSuburb = 'Please Select...';
            $scope.suburbs = suburbs.plain();
        });

        $scope.seller.seller.state_id = state.id;
    };

    /**
     * Get State Lists
     */

    State.getList().then(function(states) {
        $scope.states = states.plain();
    });

    /**
     * Get Suburb Lists
     *
     */

    Suburb.getList({"state_id": loggedUser.seller.state.id}).then(function(suburbs) {

        $scope.suburbs = suburbs.plain();
    });

    /**
     * Upload Seller Image
     *
     * @param file
     * @param id
     */

    $scope.uploadSellerPic = function(file) {
        return file.upload = Upload.upload({
            url: 'http://api.petagree/api/seller/image',
            data: {avatar: file},
            headers: {'Authorization': 'Bearer ' + BeyondiThorAuth.accessToken }
        });
    };

    /**
     * Select Suburb Function
     *
     * @param key
     * @param id
     */

    $scope.selectSuburb = function(suburb) {
        $scope.selectedSuburb = suburb.suburb;
        $scope.seller.seller.suburb_id = suburb.id;
    };


    $scope.updateUser = function(user, seller, avatar, password) {

        User.patchUser(user).then(function(user) {
            toastr.success('Account informations are up - to date.','Success');

            Seller.putSeller(seller).then(function(seller) {
                toastr.success('Seller informations are up - to date.','Success');

                if(typeof avatar != 'undefined') {

                    $scope.uploadSellerPic(avatar).then(function(res) {
                        toastr.success('Avatar was successfully changed','Success');
                    });
                }
                if(typeof password != 'undefined') {

                    User.changePassword(password).then(function() {
                        toastr.success('Account password is changed','Success');
                    });
                }

            });
        });
    };

});