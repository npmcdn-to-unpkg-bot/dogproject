module.controller('RegisterController',['$scope', 'State', 'Suburb','User','Seller', function($scope, State, Suburb, User,Seller) {

    //TODO: Add validation fields

    /**
     * Register form object
     *
     * @type {{}}
     */

    $scope.register = {};

    /**
     * Australian States
     */

    $scope.selectedState = 'Please Select...';

    /**
     * Australian Suburbs
     */

    $scope.selectedSuburb = 'Please Select...';

    /**
     * Breeder Tyoe
     */

    $scope.selectedType = 'Please Select...';

    /**
     * Get Suburb Lists
     */

    //Suburb.getList({"state_id": 1}).then(function(suburbs) {
    //    $scope.suburbs = suburbs.plain();
    //});

    /**
     * Get State Lists
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

        $scope.register.state_id = id;
    };

    /**
     * Select Suburb Function
     *
     * @param key
     * @param id
     */

    $scope.selectSuburb = function(key,id) {
        $scope.selectedSuburb = $scope.suburbs[key].suburb;
        $scope.register.suburb_id = id;
    };


    /**
     * Select Type
     */

    $scope.selectType = function(type) {
        $scope.register.type = type;
        $scope.selectedType =  type.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
    };

    /**
     *
     *
     * @param registerForm
     * @param register
     */
    $scope.registerSeller = function(registerForm,register) {

        //we are appending role for seller
        register.role = 1;
        // checking if form is valid, if yes
        // proceed with request
        if(registerForm.$valid) {

            User.post(register).then(function(user) {
                //appending saved user id
                register.user_id = user.data.id;

                //saving seller
                Seller.post(register).then(function() {

                    //cleaning form data
                    registerForm.$setPristine();
                    //cleaning register scope
                    $scope.register = {};
                    //cleaning suburb select
                    $scope.suburbs = {};
                    //selecting form syles
                    $scope.selectedState    = "Please Select ...";
                    $scope.selectedSuburb   = "Please Select ...";
                    $scope.selectedType     = "Please Select ...";
                    //TODO: TRIGGER CONFIRM MESSAGE

                }).catch(function(res) {
                    //TODO: make delete of user if seller save do not succeed
                });

            }).catch(function(res) {

                if(res.status === 422) {
                    $scope.registerErrors = res.data.errors;
                }
            });
        }
    };
}]);