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