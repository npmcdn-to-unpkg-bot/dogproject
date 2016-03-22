module.controller('DashboardController', function($rootScope, $scope, loggedUser, Upload) {

    $rootScope.seller = (loggedUser.role == "1") ? loggedUser : {};

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
    console.log($scope.rating1,$scope.rating2,$scope.rating3,$scope.rating4,$scope.rating5);
});

module.controller('ListController', function($rootScope, $scope, loggedUser, Other, Dog, Upload, BeyondiThorAuth) {


    /**
     * Dog List object
     *
     * @type {{}}
     */

    $scope.dog = {};


    /**
     * Parent Slider Object
     *
     * @type {{start: number, range: {min: number, max: number}, step: number}}
     */
    $rootScope.parentSlider = {start:1,range:{'min':1,'max':3},step:1};

    /**
     * Type of Listing Selected
     */

    $scope.selectedListing = 'Please Select...';

    /**
     * Dog Breed Selected
     */

    $scope.selectedBreed = 'Please Select...';

    /**
     * Selected Father
     *
     * @type {string}
     */

    $scope.selectedFather = 'Please Select...';

    /**
     * Selected Mother
     *
     * @type {string}
     */
    $scope.selectedMother = 'Please Select...';

    /**
     * Dog Parent Object
     *
     * @type {{}}
     */

    $rootScope.parent = {};

    /**
     * Parent Breed Selected
     *
     */
    $rootScope.parentBreedSelected = 'Please Select...';

    /**
     * Current Seller in scope
     */

    $rootScope.seller = (loggedUser.role == "1") ? loggedUser : {};

    /**
     *  Get Dog Beeds
     *
     */

    Other.getBreed().then(function(breeds) {

        $rootScope.breeds = breeds.data

    });

    /**
     *  Get Dog Fathers
     */

    Dog.getFather().then(function(father) {
        $rootScope.fathers = father.data;
    });

    /**
     *  Get Dog Mothers
     */

    Dog.getMother().then(function(mother) {
        $rootScope.mothers = mother.data;
    });

    /**
     * Add new father
     *
     * @param type
     *
     */

    $scope.addNewFather = function() {
        $rootScope.father = true;
        $scope.resetSelectedFather();
    };

    /**
     * Add new mother
     *
     */

    $scope.addNewMother = function() {
        $rootScope.mother = true;
        $scope.resetSelectedMother();
    };

    /**
     * Select Breed
     *
     */

    $scope.selectBreed = function(breed) {

        $scope.selectedBreed = breed.breed;
        $scope.dog.breed_id  = breed.id;
    };

    $scope.resetSelectedBreed = function() {
        $scope.selectedBreed = 'Please Select...'
    }

    /**
     * Select Listing Type
     *
     */

    $scope.selectListingType = function(type) {

        $scope.selectedListing = type.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
        $scope.dog.type_of_listing  = type;
    };

    /**
     * Reset Selected Dog Type
     *
     */

    $scope.resetSelectedType = function() {
        $scope.selectedListing = 'Please Select...';
    };

    /**
     * Select mother and show edit form
     *
     * @param mother
     */

    $scope.selectMother = function(mother) {
        //adding to dog object for saving child
        $scope.dog.mother_id = mother.id;
        //adding into dropdown selection button
        $scope.selectedMother = mother.name;
        //adding into show selected mother to show image
        $scope.showSelectedMother = mother;
        $rootScope.mother = false;
    };

    /**
     * Reset Selected Mother
     *
     */

    $scope.resetSelectedMother = function() {
        $scope.dog.mother_id = '';
        $scope.selectedMother = 'Please Select...';
        $scope.showSelectedMother = false;
    };

    /**
     * Select Father
     *
     * @param father
     */

    $scope.selectFather = function(father) {
        //adding to dog object for saving child
        $scope.dog.father_id = father.id;
        //adding into dropdown selection button
        $scope.selectedFather = father.name;
        //adding into show selected mother to show image
        $scope.showSelectedFather = father;
        $rootScope.father = false;
    };

    /**
     * Reset Selected Father
     *
     */

    $scope.resetSelectedFather = function() {
        $scope.dog.father_id = '';
        $scope.selectedFather = 'Please Select...';
        $scope.showSelectedFather = false;
    };

    /**
     * Upload Father Image
     *
     * @param file
     */
    $scope.uploadFatherPic = function(file,id) {
        file.upload = Upload.upload({
            url: 'http://api.petagree/api/dog/father/image',
            data: {image: file, father_id: id},
            headers: {'Authorization': 'Bearer ' + BeyondiThorAuth.accessToken }
        });
    };
    /**
     * Upload Father Image
     *
     * @param files array
     * @param id integer
     */
    $scope.uploadDogPic = function(files,id) {
        Upload.upload({
            url: 'http://api.petagree/api/dog/images',
            data: {images: files, dog_id: id},
            headers: {'Authorization': 'Bearer ' + BeyondiThorAuth.accessToken }
        });
    };

    /**
     * Upload Father Image
     *
     * @param file
     */
    $scope.uploadMotherPic = function(file,id) {
        file.upload = Upload.upload({
            url: 'http://api.petagree/api/dog/mother/image',
            data: {image: file, mother_id: id},
            headers: {'Authorization': 'Bearer ' + BeyondiThorAuth.accessToken }
        });
    };



    /**
     * Select Parent Breed
     *
     */

    $rootScope.selectParentBreed = function(breed) {

        $rootScope.parentBreedSelected = breed.breed;
        $rootScope.parent.breed_id  = breed.id;
    };

    /**
     * Save Parent
     *
     * @param parentForm
     * @param parent
     *
     */

    $rootScope.saveParent = function(parentForm,parent,type) {

        // we need to check if form is valid
        if(parentForm.$valid) {

            //crating father
            if(type == 'father') {

                Dog.postFather(parent).then(function(dog){
                    // posting father picture after create is finished and
                    // updating image field
                    $scope.uploadFatherPic(parent.parentImage, dog.data);
                    // updating scope so new parents are loaded
                    Dog.getFather().then(function(father) {
                        $rootScope.fathers = father.data;
                    });

                });
            }
            //creating mother
            else if (type == 'mother') {

                Dog.postMother(parent).then(function(dog){
                    // posting mother picture after create is finished and
                    // updating image field.
                    $scope.uploadMotherPic(parent.parentImage, dog.data);

                    Dog.getMother().then(function(father) {
                        $rootScope.mothers = father.data;
                    });
                });
            }
            // cleaning form
            parentForm.$setPristine();
            $rootScope.parent = {};
            $rootScope.parentSlider = {start:1,range:{'min':1,'max':3},step:1};
        }
    }


    $scope.listDog = function(listForm,dog) {

        if(listForm.$valid) {

            Dog.post(dog).then(function(savedDog) {

                $scope.uploadDogPic($scope.prepareImages(dog.image),savedDog.data.id);
                $scope.dog = {};
                $scope.resetSelectedFather();
                $scope.resetSelectedMother();
                $scope.resetSelectedBreed();
                $scope.resetSelectedType();

            }).catch(function(response) {
                //TODO: HANDLE RESPONSE ERROR
                console.log(response);
            });
        }

        listForm.$setPirstine();
    };

    $scope.prepareImages = function(images) {

        var prepared = []
        angular.forEach(images,function(value,key) {
            if(value !== null) {
                prepared.push(value);
            }
        });

        return prepared;
    }
});
