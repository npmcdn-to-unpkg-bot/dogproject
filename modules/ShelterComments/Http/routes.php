<?php

$api = app('Dingo\Api\Routing\Router');
$api->version('v1',['middleware' => 'api.auth|bynd.api.permission.shelter'], function ($api)
{

    /**
     * @SWG\Post(
     *  path="/shelter/review/request",
     *  description="Shelter requests review from customers",
     *  operationId="postShelterReviewRequest",
     *  tags={"ShelterComments"},
     *
     * @SWG\Parameter(
     *  name="email",
     *  in = "query",
     *  description="Email of customer",
     *  required=true,
     *  type="array",
     *  @SWG\Items(type = "string")
     * ),
     *
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity"
     * ),
     *
     *  @SWG\Response(
     *  response="403",
     *  description="Shelter doesn't have enquiries for given email.<br>----------------------------------------<br>Review already requested for given email."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only shelter profiles can access this resource."
     * )
     *
     * )
     *
     */

    $api->post('shelter/review/request', ['uses' => 'Modules\ShelterComments\Http\Controllers\ShelterCommentsController@postShelterReviewRequest']);

});

$api->version('v1', function ($api)
{

    /**
     * @SWG\Post(
     *  path="/shelter/review",
     *  description="Customer writes review for shelter",
     *  operationId="postShelterReview",
     *  tags={"ShelterComments"},
     *
     * @SWG\Parameter(
     *  name="shelter_review_token",
     *  in = "query",
     *  description="Token for writting review.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="rating1",
     *  in = "query",
     *  description="Rating1",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="rating2",
     *  in = "query",
     *  description="Rating2",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="rating3",
     *  in = "query",
     *  description="Rating3",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="rating4",
     *  in = "query",
     *  description="Rating4",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="rating5",
     *  in = "query",
     *  description="Rating5",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="Name of the customer",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="suburb_id",
     *  in = "query",
     *  description="Suburb id",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="state_id",
     *  in = "query",
     *  description="State id",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="about",
     *  in = "query",
     *  description="Customer comments",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="contact_number",
     *  in = "query",
     *  description="Number",
     *  required=true,
     *  type="string"
     * ),
     *
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity"
     * )
     *
     *
     * )
     *
     */

    $api->post('shelter/review', ['uses' => 'Modules\ShelterComments\Http\Controllers\ShelterCommentsController@postShelterReview']);

    /**
     * @SWG\Post(
     *  path="/shelter/review/token/validate",
     *  description="Validates review token",
     *  operationId="postShelterReviewTokenValidate",
     *  tags={"ShelterComments"},
     *
     * @SWG\Parameter(
     *  name="review_token",
     *  in = "query",
     *  description="Token for writting review.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Response(
     *  response="400",
     *  description="Token does not exists.<br>------------------------------<br>Review is already written."
     * ),
     *
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity"
     * ),
     *
     *
     * )
     *
     */

    $api->post('shelter/review/token/validate', ['uses' => 'Modules\ShelterComments\Http\Controllers\ShelterCommentsController@postShelterReviewTokenValidate']);

});

