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