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