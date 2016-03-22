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
