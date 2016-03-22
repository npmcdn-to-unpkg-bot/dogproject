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