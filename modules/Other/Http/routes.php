<?php

$api = app('Dingo\Api\Routing\Router');


$api->version('v1', function ($api)
{

    /**
     * @SWG\Post(
     *  path="/other/enquiry",
     *  description="Creates new enquiry for petagree",
     *  operationId="postOtherEnquiry",
     *  tags={"Other"},
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="User's name.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="email",
     *  in = "query",
     *  description="Email of the user.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="contact_number",
     *  in = "query",
     *  description="Telephone number of the user.",
     *  required=true,
     *  type="string"
     * ),
     *
     *  @SWG\Parameter(
     *  name="contact_type",
     *  in = "query",
     *  description="Contact type",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="enquiry",
     *  in = "query",
     *  description="Users enquiry body.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity"
     * ),
     *
     *  @SWG\Response(
     *  response="403",
     *  description="You have exceeded your rate limit."
     * )
     *
     *
     * )
     *
     */

    $api->post('other/enquiry', ['middleware' => 'api.throttle', 'limit' => 10, 'expires' => 10,'uses' => 'Modules\Other\Http\Controllers\OtherController@postOtherEnquiry']);


    $api->get('other/breeds', ['uses' => 'Modules\Other\Http\Controllers\OtherController@getDogBreed']);
});