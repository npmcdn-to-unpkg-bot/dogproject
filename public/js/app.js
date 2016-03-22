var module = angular.module('petagree',[
    'ngFileUpload',
    'thorServices',
    'byndFilters',
    'ui.router',
    'ui.bootstrap',
    'ngAnimate',
    'angularMoment',
    'toastr'
]);
angular.module('petagree').config([
    '$stateProvider', '$urlRouterProvider', '$locationProvider', function ($stateProvider, $urlRouterProvider, $locationProvider) {
        $urlRouterProvider.otherwise('/');
        $urlRouterProvider.when('', '/');

        $stateProvider
            .state('home', {
                url: '/',
                templateUrl: 'js/app/modules/home/views/home.view.html',
                controller: 'HomeController'
            })
            .state('search', {
                url: '/search',
                templateUrl: 'js/app/modules/search/views/search.view.html',
                controller: 'SearchController',
                resolve: {
                    dogs: function (Dog,$location) {
                        return Dog.getWith({relations:'owner,mother,father,breed,shelter',filter:$location.search().filter}).then(function(dogs){
                            return dogs.data;
                        }).catch(function() {
                            $location.search({});
                            return Dog.getWith({relations:'owner,mother,father,breed,shelter',filter:$location.search().filter}).then(function(dogs){
                                return dogs.data;
                            });
                        });
                    }
                }
            })
            .state('dogs', {
                url: '/dogs/:slug',
                templateUrl: 'js/app/modules/dogs/views/dogs.view.html',
                controller: 'DogsController',
                resolve: {
                    dog: function(Dog, $stateParams) {
                        return Dog.getBySlug({slug:$stateParams.slug}).then(function(dog) {
                            return dog.customGET(dog.data.id + '/with',{relations:'owner,mother,father,breed,shelter'}).then(function(found){
                                return found.data[0];
                            })
                        });
                    }
                }
            })
            .state('register', {
                url: '/register',
                templateUrl: 'js/app/modules/register/views/register.view.html',
                controller: 'RegisterController'
            })
            .state('login', {
                url: '/login',
                templateUrl: 'js/app/modules/login/views/login.view.html',
                controller: 'LoginController'
            })
            .state('association', {
                url: '/association',
                templateUrl: 'js/app/modules/association/views/association.view.html'
            })
            .state('about', {
                url: '/about',
                templateUrl: 'js/app/modules/about/views/about.view.html'
            })
            .state('rescue-shelter', {
                url: '/rescue-shelter',
                templateUrl: 'js/app/modules/shelter/views/shelter.view.html'
            })
            .state('review', {
                url: '/seller/review/:reviewId',
                templateUrl: 'js/app/modules/review/views/review-seller.view.html',
                controller: 'SellerReviewController',
                resolve: {
                    reviewToken: function(Seller,$stateParams,$location) {
                        return Seller.reviewToken({review_token: $stateParams.reviewId}).then(function(response) {
                            return response.data;
                        }).catch(function(response) {
                            $location.path('/');
                        })
                    }
                }
            })
            .state('dashboard', {
                templateUrl: 'js/app/modules/dashboard/views/dashboard.view.html',
                resolve: {
                    loggedUser: function (User) {
                        return User.getUser({relations: 'seller,association'}).then(function (user) {
                            // we need to check user first and then load him with his relations by his
                            // role
                            return user.data;
                        });
                    }
                }
            })
            .state('dashboard.index', {
                url: '/dashboard',
                templateUrl: 'js/app/modules/dashboard/views/index.view.html',
                authenticate: true,
                controller: 'DashboardController'
            })
            .state('dashboard.list-dog', {
                url: '/dashboard/list-dog',
                templateUrl: 'js/app/modules/dashboard/views/list-dog.view.html',
                authenticate: true,
                controller: 'ListController'
            })
            .state('dashboard.user-settings', {
                url: '/dashboard/user-settings',
                templateUrl: 'js/app/modules/dashboard/views/user-settings.view.html',
                authenticate: true,
                controller: 'UserSettingsController'
            })
            .state('dashboard.verification', {
                url: '/dashboard/verification',
                templateUrl: 'js/app/modules/dashboard/views/verification.view.html',
                authenticate: true,
                controller: 'VerificationController'
            })
            .state('dashboard.ratings', {
                url: '/dashboard/ratings',
                templateUrl: 'js/app/modules/dashboard/views/ratings.view.html',
                authenticate: true,
                controller: 'RatingsController'
            });

        $locationProvider.html5Mode(true).hashPrefix('!');
    }])
    .config(function (toastrConfig) {
        angular.extend(toastrConfig, {
            autoDismiss: false,
            containerId: 'toast-container',
            maxOpened: 0,
            newestOnTop: true,
            positionClass: 'toast-top-right',
            preventDuplicates: false,
            preventOpenDuplicates: false,
            target: 'body',
            timeOut: 3000,
            extendedTimeOut: 3000
        });
    })
    .run(['$rootScope', '$state', 'BeyondiThorAuth', function ($rootScope, $state, BeyondiThorAuth) {
        $rootScope.$on('$stateChangeStart', function (event, toState) {
            // redirect to login page if not logged in
            if (toState.authenticate && !BeyondiThorAuth.currentUserId) {
                event.preventDefault(); //prevent current page from loading
                $state.go('app.login');
            }
        });
    }]);
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
module.controller('VerificationController', function($rootScope, $scope, loggedUser, Upload, Seller, toastr, BeyondiThorAuth) {

    $rootScope.seller = (loggedUser.role == "1") ? loggedUser : {};

    $scope.selectedOrganisation = 'Please select organisation...';

    $scope.verification = {};

    $scope.selectOrganisation = function(id) {
        $scope.selectedOrganisation = id;
        $scope.verification.type = id;
    };

    $scope.resetOrganisation = function() {
        $scope.selectedOrganisation = 'Please select organisation...';
    };

    /**
     * Upload Seller Proof
     *
     * @param file
     * @param id
     */

    $scope.uploadSellerProof = function(file) {
        return file.upload = Upload.upload({
            url: 'http://api.petagree/api/seller/verification/proof',
            data: {proof: file},
            headers: {'Authorization': 'Bearer ' + BeyondiThorAuth.accessToken }
        });
    };


    $scope.verifySeller = function(verification,proof) {

        Seller.verifySeller(verification).then(function(seller) {

            $scope.resetOrganisation();
            $scope.verification = {};

            if(typeof proof != 'undefined') {
                $scope.uploadSellerProof(proof).then(function() {
                    $scope.proof = {};
                });
            }
            toastr.success('Your verification enquiry is received.','Success');

        }).catch(function(response) {
            if(response.status == 400) {
                toastr.success('You request for verification is already accepted.','Information');
            }
        });
    }

});
module.controller('HomeController', function($scope) {

    $scope.names = ["john", "bill", "charlie", "robert", "alban", "oscar", "marie", "celine", "brad", "drew", "rebecca", "michel", "francis", "jean", "paul", "pierre", "nicolas", "alfred", "gerard", "louis", "albert", "edouard", "benoit", "guillaume", "nicolas", "joseph"];
});
module.controller('LoginController',['$scope','$state','User','Token','BeyondiThorAuth', function($scope,$state, User, Token,BeyondiThorAuth) {

    $scope.loginSeller = function (loginForm,credentials) {

        if(loginForm.$valid) {

            Token.login(credentials).then(function(token) {

                BeyondiThorAuth.setUser(token.data.token);
                BeyondiThorAuth.rememberMe = true;
                BeyondiThorAuth.save();
                $state.go('dashboard.index');

            }).catch(function(response) {

            });
        }
    }

}]);

module.controller('DogsController', function($scope, dog, Seller,toastr) {

    /**
     * Create empty enquiry object
     *
     * @type {{}}
     */

    $scope.enquiry = {};

    /**
     * Add resolved dog into
     * the scope
     *
     */

    $scope.dog = dog;

    /**
     * Get current date and calculate
     * dog life by days
     *
     * @type {Date}
     *
     */

    $scope.currentDate = new Date();

    /**
     * Hide contact form until clicked
     *
     * @type {boolean}
     */

    $scope.reveal = false;


    $scope.sendEnquiry = function(enquiryForm,enquiry) {

        if(enquiryForm.$valid) {
            //send seller enquiry
            Seller.enquiry(enquiry).then(function(response) {
                if(response.status == 201) {
                    toastr.success('Your Enquiry is sent to '+ dog.owner.users.first_name + ' ' + dog.owner.users.last_name ,'Success');

                    $scope.resetEnquiry();
                    $scope.reveal = false;
                    enquiryForm.$setPristine();
                }
            });
        }
    };

    $scope.resetEnquiry = function()
    {
        $scope.enquiry = {};
        $scope.enquiry.seller_id = dog.owner.users.id;
        $scope.enquiry.dog_id = dog.id;
    };

    //seller id is actually user id in seller table
    $scope.enquiry.seller_id = dog.owner.users.id;
    $scope.enquiry.dog_id = dog.id;
});
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
//# sourceMappingURL=modules.js.map

//# sourceMappingURL=app.js.map
