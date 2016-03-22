(function (window, angular, undefined) {
    'use strict';
    var urlBase = "http://api.petagree/api";
    var authHeader = 'authorization';

    var module = angular.module('thorServices', ['restangular']);


    module
        .config(function (RestangularProvider) {
            // configuring Restangular to work with every factory which we will
            // design
            RestangularProvider
                .setBaseUrl(urlBase)
                .addFullRequestInterceptor(function (element, operation, what, url,headers, params) {

                    headers.Authorization = 'Bearer ' + localStorage['ThorAPI-accessToken'];

                })
                .addResponseInterceptor(function (data, operation, what, url, response, deferred) {

                    if (operation === "getList") {
                        return data;
                    }

                    return response;
                });

        });


    module
        .factory('User', ['BeyondiThorResource', 'BeyondiThorAuth', function (BeyondiThorResource) {
            return BeyondiThorResource('user');
        }])
        .factory('Dog', ['BeyondiThorResource', 'BeyondiThorAuth', function (BeyondiThorResource) {
            return BeyondiThorResource('dog');
        }])
        .factory('Other', ['BeyondiThorResource', 'BeyondiThorAuth', function (BeyondiThorResource) {
            return BeyondiThorResource('other');
        }])
        .factory('Seller', ['BeyondiThorResource', 'BeyondiThorAuth', function (BeyondiThorResource) {
            return BeyondiThorResource('seller');
        }])
        .factory('Token', ['BeyondiThorResource', 'BeyondiThorAuth', function (BeyondiThorResource) {
            return BeyondiThorResource('token');
        }])
        .factory('State', ['BeyondiThorResource', function (BeyondiThorResource) {
            return BeyondiThorResource('state')
        }])
        .factory('Suburb', ['BeyondiThorResource', function (BeyondiThorResource) {
            return BeyondiThorResource('suburb')
        }]);


    module
        .factory('BeyondiThorAuth', function () {
            var props = ['accessToken', 'currentUserId', 'rememberMe'],
                propsPrefix = 'ThorAPI-';

            /**
             * Constructor function for Authentication Service
             *
             * @constructor
             */

            function BeyondiThorAuth() {
                var self = this;

                props.forEach(function (name) {
                    self[name] = load(name);
                });

                this.currentUseData = null;
            };

            BeyondiThorAuth.prototype.save = function () {
                var self = this,
                    storage = this.rememberMe ? localStorage : sessionStorage;

                props.forEach(function (name) {
                    save(storage, name, self[name]);
                });
            };

            BeyondiThorAuth.prototype.setUser = function (accessToken, userData) {
                this.accessToken = accessToken;
                this.currentUserId = this.getClaimsFromToken(accessToken);
                this.currentUserData = userData;
            };

            BeyondiThorAuth.prototype.clearUser = function () {
                this.accessToken = null;
                this.currentUserId = null;
                this.currentUserData = null;
            };

            BeyondiThorAuth.prototype.clearStorage = function () {
                props.forEach(function (name) {
                    save(sessionStorage, name, null);
                    save(localStorage, name, null);
                });
            };

            BeyondiThorAuth.prototype.getClaimsFromToken = function(accessToken) {
                var token = accessToken;
                var user = {};
                if (typeof token !== 'undefined') {
                    var encoded = token.split('.')[1];
                    user = JSON.parse(urlBase64Decode(encoded));
                }
                return user.sub;
            };

            return new BeyondiThorAuth();

            function save(storage, name, value) {
                var key = propsPrefix + name;
                // Note: LocalStorage converts the value to string
                // This is handle when we are cleaning storage
                // We are using empty string as a marker for null/undefined values.
                if (value == null) value = '';
                storage[key] = value;
            }

            function load(name) {
                var key = propsPrefix + name;
                return localStorage[key] || sessionStorage[key] || null;
            }

            function urlBase64Decode(str) {
                var output = str.replace('-', '+').replace('_', '/');
                switch (output.length % 4) {
                    case 0:
                        break;
                    case 2:
                        output += '==';
                        break;
                    case 3:
                        output += '=';
                        break;
                    default:
                        throw 'Illegal base64url string!';
                }
                return window.atob(output);
            }
        })
        .provider('BeyondiThorResource', function BeyondiThorResourceProvider() {

            this.$get = ['Restangular', function (Restangular) {

                return function (name) {

                    //this is addition for Petagree, needs to be removed
                        return Restangular.withConfig(function (RestangularConfigurer) {
                            //setting base url
                            if(name == 'token' || name == 'user') {
                                RestangularConfigurer
                                    .setBaseUrl('http://api.petagree/api/auth');
                            }

                                //adding transofrmation to the services.
                            RestangularConfigurer.addElementTransformer(name, true, function (worker) {
                                    if(name == 'token') {
                                        worker.addRestangularMethod('login', 'get', '');
                                    }
                                    if(name == 'user') {
                                        worker.addRestangularMethod('getUser','get','with');
                                        worker.addRestangularMethod('changePassword','patch','password');
                                        worker.addRestangularMethod('patchUser','patch','');
                                    }
                                    if(name == 'other') {
                                        worker.addRestangularMethod('getBreed','get','breeds');
                                    }
                                    if(name == 'dog') {
                                        // get methods father
                                        worker.addRestangularMethod('getFather','get','father');
                                        // get method for slug
                                        worker.addRestangularMethod('getBySlug','get','slug');
                                        // post methods father
                                        worker.addRestangularMethod('postFather','post','father');
                                        // get methods mother
                                        worker.addRestangularMethod('getMother','get','mother');
                                        // post methods father
                                        worker.addRestangularMethod('postMother','post','mother');
                                        // get dog with method
                                        worker.addRestangularMethod('getWith','get','with');
                                    }
                                    if(name == 'seller') {
                                        //put method for seller
                                        worker.addRestangularMethod('putSeller','put','');
                                        //post method for seller
                                        worker.addRestangularMethod('verifySeller','post','verified/verification');
                                        worker.addRestangularMethod('enquiry','post','enquiry');
                                        worker.addRestangularMethod('requestReview','post','review/request');
                                        worker.addRestangularMethod('reviewToken','post','review/token/validate');
                                        worker.addRestangularMethod('reviewSeller','post','review');
                                    }
                                    return worker;
                                });
                        }).service(name);
                    return Restangular.service(name);
                }
            }];
        });
})(window, window.angular);