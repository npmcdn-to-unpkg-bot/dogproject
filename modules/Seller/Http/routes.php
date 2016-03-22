<?php

$api = app('Dingo\Api\Routing\Router');
$api->version('v1',['middleware' => 'api.auth|bynd.api.permission.seller'], function ($api)
{

    /**
     * @SWG\Put(
     *  path="/seller",
     *  description="Updates seller, whole row.",
     *  operationId="putSeller",
     *  tags={"Seller"},
     *
     * @SWG\Parameter(
     *  name="type",
     *  in = "query",
     *  description="Type of seller.",
     *  required=true,
     *  type="string",
     *  enum ={"hobby","verified"}
     * ),
     *
     * @SWG\Parameter(
     *  name="suburb_id",
     *  in = "query",
     *  description="Location.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * * @SWG\Parameter(
     *  name="state_id",
     *  in = "query",
     *  description="Location.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="address",
     *  in = "query",
     *  description="Address of the seller.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="language",
     *  in = "query",
     *  description="Language seller wants to use.",
     *  required=true,
     *  type="string"
     * ),
     *
     *
     * @SWG\Parameter(
     *  name="find_out",
     *  in = "query",
     *  description="How did seller found out this site.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="about",
     *  in = "query",
     *  description="Some information about seller.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="newsletter",
     *  in = "query",
     *  description="Does seller wants to receive newsletter",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="terms",
     *  in = "query",
     *  description="Does seller agrees to our terms.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="smartphone",
     *  in = "query",
     *  description="Use smartphone for this account.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/sellerModel")
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
     * ),
     *
     * @SWG\Response(
     *  response="404",
     *  description="User not found."
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity"
     * ),
     *
     * @SWG\Response(
     *  response="500",
     *  description="Error internal."
     * )
     * )
     *
     */

    $api->put('seller', ['uses' => 'Modules\Seller\Http\Controllers\SellerController@putSeller']);

    /**
     * @SWG\Patch(
     *  path="/seller",
     *  description="Updates seller, only parts of row.",
     *  operationId="patchSeller",
     *  tags={"Seller"},
     *
     * @SWG\Parameter(
     *  name="type",
     *  in = "query",
     *  description="Type of seller.",
     *  required=false,
     *  type="string",
     *  enum ={"hobby","verified"}
     * ),
     *
     * @SWG\Parameter(
     *  name="suburb_id",
     *  in = "query",
     *  description="Location.",
     *  required=false,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="state_id",
     *  in = "query",
     *  description="Location.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="address",
     *  in = "query",
     *  description="Address of the seller.",
     *  required=false,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="language",
     *  in = "query",
     *  description="Language seller wants to use.",
     *  required=false,
     *  type="string"
     * ),
     *
     *
     * @SWG\Parameter(
     *  name="find_out",
     *  in = "query",
     *  description="How did seller found out this site.",
     *  required=false,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="about",
     *  in = "query",
     *  description="Some information about seller.",
     *  required=false,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="newsletter",
     *  in = "query",
     *  description="Does seller wants to receive newsletter",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="terms",
     *  in = "query",
     *  description="Does seller agrees to our terms.",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="smartphone",
     *  in = "query",
     *  description="Use smartphone for this account.",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/sellerModel")
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
     * ),
     * @SWG\Response(
     *  response="404",
     *  description="User not found."
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity"
     * ),
     *
     * @SWG\Response(
     *  response="500",
     *  description="Error internal."
     * )
     * )
     *
     */

    $api->patch('seller', ['uses' => 'Modules\Seller\Http\Controllers\SellerController@patchSeller']);

    /**
     * @SWG\Get(
     *  path="/seller/with",
     *  description="Returns list of all sellers and specified related information",
     *  operationId="getSellerWith",
     *  tags={"Seller"},
     *
     * @SWG\Parameter(
     *  name="relations",
     *  in = "query",
     *  description="Names of relations that user wants to get information from. Relations avaliable : review,users,seller_enquiry,verification,suburb,state,dogs",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/sellerWith")
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity"
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
     * )
     * )
     *
     */

    $api->get('seller/with', ['uses' => 'Modules\Seller\Http\Controllers\SellerController@getSellerWith']);

    /**
     * @SWG\Post(
     *  path="/seller/image",
     *  description="Post seller avatar",
     *  operationId="postSellerImage",
     *  tags={"Seller"},
     *
     * @SWG\Parameter(
     *  name="avatar",
     *  in = "query",
     *  description="Avatar of the seller.",
     *  required=true,
     *  type="file"
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
     * )
     * )
     *
     */

    $api->post('seller/image', ['uses' => 'Modules\Seller\Http\Controllers\SellerController@postSellerImage']);

    /**
     * @SWG\Post(
     *  path="/seller/association",
     *  description="Accept association join request.",
     *  operationId="postSellerAssociation",
     *  tags={"Seller"},
     *
     * @SWG\Parameter(
     *  name="association_id",
     *  in = "query",
     *  description="Id of the association that invited seller to join in.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity."
     * ),
     *
     * @SWG\Response(
     *  response="400",
     *  description="Seller is already part of association.<br>------------------------------------------<br>Invite wasn't sent to this seller."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
     * )
     * )
     *
     */

    $api->post('seller/association', ['uses' => 'Modules\Seller\Http\Controllers\SellerController@postSellerAssociation']);

    /**
     * @SWG\Post(
     *  path="/seller/hobby/verification",
     *  description="Verification for hobby breeder.",
     *  operationId="postSellerHobbyVerification",
     *  tags={"Seller"},
     *
     * @SWG\Parameter(
     *  name="question1",
     *  in = "query",
     *  description="Question1.",
     *  required=true,
     *  type="integer",
     *  enum="01"
     * ),
     *
     * @SWG\Parameter(
     *  name="question2",
     *  in = "query",
     *  description="Question2.",
     *  required=true,
     *  type="integer",
     *  enum="01"
     * ),
     *
     * @SWG\Parameter(
     *  name="question3",
     *  in = "query",
     *  description="Question3.",
     *  required=true,
     *  type="integer",
     *  enum="01"
     * ),
     *
     * @SWG\Parameter(
     *  name="question4",
     *  in = "query",
     *  description="Question4.",
     *  required=true,
     *  type="integer",
     *  enum="01"
     * ),
     *
     * @SWG\Parameter(
     *  name="question5",
     *  in = "query",
     *  description="Question5.",
     *  required=true,
     *  type="integer",
     *  enum="01"
     * ),
     *
     * @SWG\Parameter(
     *  name="question6",
     *  in = "query",
     *  description="Question6.",
     *  required=true,
     *  type="integer",
     *  enum="01"
     * ),
     *
     * @SWG\Parameter(
     *  name="question7",
     *  in = "query",
     *  description="Question7.",
     *  required=true,
     *  type="integer",
     *  enum="01"
     * ),
     *
     * @SWG\Parameter(
     *  name="question8",
     *  in = "query",
     *  description="Question8.",
     *  required=true,
     *  type="integer",
     *  enum="01"
     * ),
     *
     * @SWG\Parameter(
     *  name="question9",
     *  in = "query",
     *  description="Question9.",
     *  required=true,
     *  type="integer",
     *  enum="01"
     * ),
     *
     * @SWG\Parameter(
     *  name="question10",
     *  in = "query",
     *  description="Question10.",
     *  required=true,
     *  type="integer",
     *  enum="01"
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity."
     * ),
     *
     * @SWG\Response(
     *  response="400",
     *  description="Seller already submitted verification information.<br>------------------------------------------<br>Seller not found or does not need verification."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource.<br>-----------------------------------------------------------------------<br>Seller is not a hobby breeder."
     * )
     * )
     *
     */


    /**
     * @SWG\Post(
     *  path="/seller/verified/verification",
     *  description="Verification for verified breeder.",
     *  operationId="postSellerVerifiedVerification",
     *  tags={"Seller"},
     *
     * @SWG\Parameter(
     *  name="type",
     *  in = "query",
     *  description="Type of verification",
     *  required=true,
     *  type="string",
     *  enum="12"
     * ),
     *
     * @SWG\Parameter(
     *  name="number",
     *  in = "query",
     *  description="Registration number",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity."
     * ),
     *
     * @SWG\Response(
     *  response="400",
     *  description="Seller already submitted verification information.<br>------------------------------------------<br>Seller not found or does not need verification."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource.<br>-----------------------------------------------------------------------<br>Seller is not verified breeder."
     * )
     * )
     *
     */

    $api->post('seller/{type}/verification', ['uses' => 'Modules\Seller\Http\Controllers\SellerController@postSellerVerification']);

    /**
     * @SWG\Post(
     *  path="/seller/verification/proof",
     *  description="Proof for verification",
     *  operationId="postSellerVerificationProof",
     *  tags={"Seller"},
     *
     * @SWG\Parameter(
     *  name="proof",
     *  in = "query",
     *  description="Verification proof",
     *  required=true,
     *  type="file"
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity."
     * ),
     *
     * @SWG\Response(
     *  response="403",
     *  description="Only verified seller profiles can access this resource."
     * ),
     *
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource.<br>-----------------------------------------------------------------------<br>Seller is not a hobby breeder."
     * )
     * )
     *
     */

    $api->post('seller/verification/proof', ['middleware' => 'bynd.api.permission.seller.verified','uses' => 'Modules\Seller\Http\Controllers\SellerController@postSellerVerificationProof']);

    /**
     * @SWG\Get(
     *  path="/seller/hobby/verification",
     *  description="Get verification for hobby breeder.",
     *  operationId="getSellerHobbyVerification",
     *  tags={"Seller"},
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/sellerHobbyVerification")
     * ),
     *
     * @SWG\Response(
     *  response="400",
     *  description="Seller didn't send verification information."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource.<br>-----------------------------------------------------------------------<br>Seller is not a hobby breeder."
     * )
     * )
     *
     */

    /**
     * @SWG\Get(
     *  path="/seller/verified/verification",
     *  description="Get verification for verified breeder.",
     *  operationId="getSellerVerifiedVerification",
     *  tags={"Seller"},
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/sellerVerification")
     * ),
     *
     * @SWG\Response(
     *  response="400",
     *  description="Seller didn't send verification information."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource.<br>-----------------------------------------------------------------------<br>Seller is not a hobby breeder."
     * )
     * )
     *
     */

    $api->get('seller/{type}/verification', ['uses' => 'Modules\Seller\Http\Controllers\SellerController@getSellerVerification']);

    /**
     * @SWG\Post(
     *  path="/seller/join/association",
     *  description="Seller sends request to association",
     *  operationId="postSellerJoinAssociation",
     *  tags={"Seller"},
     *
     * @SWG\Parameter(
     *  name="association_id",
     *  in = "query",
     *  description="Id association wants to join in",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="number",
     *  in = "query",
     *  description="Number within association",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity."
     * ),
     *
     * @SWG\Response(
     *  response="400",
     *  description="Seller is already in process for joining."
     * ),
     *
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource.<br>-----------------------------------------------------------------------<br>Seller is not a hobby breeder."
     * )
     * )
     *
     */

    $api->post('seller/join/association', ['uses' => 'Modules\Seller\Http\Controllers\SellerController@postSellerJoinAssociation']);

    /**
     * @SWG\Patch(
     *  path="/seller/dog/final",
     *  description="Seller selling dog.",
     *  operationId="patchSellerDogFinal",
     *  tags={"Seller"},
     *
     * @SWG\Parameter(
     *  name="dog_id",
     *  in = "query",
     *  description="Id of the dog seller wants to sell",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/dogID")
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity."
     * ),
     *
     * @SWG\Response(
     *  response="400",
     *  description="Wrong dog type.<br>-----------------------------<br>Dog belongs to other seller."
     * ),
     *
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource.<br>-----------------------------------------------------------------------<br>Seller is not a hobby breeder."
     * )
     * )
     *
     */

    $api->patch('seller/dog/final', ['uses' => 'Modules\Seller\Http\Controllers\SellerController@patchSellerDogFinal']);

    /**
     * @SWG\Patch(
     *  path="/seller/litter/final",
     *  description="Seller selling dog from litter",
     *  operationId="patchSellerLitterFinal",
     *  tags={"Seller"},
     *
     * @SWG\Parameter(
     *  name="litter_id",
     *  in = "query",
     *  description="Id of dog litter",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="sex",
     *  in = "query",
     *  description="Sex of the dog from litter",
     *  required=true,
     *  type="string",
     *  enum={"male","female"}
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/dogID")
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity."
     * ),
     *
     * @SWG\Response(
     *  response="400",
     *  description="Wrong dog type.<br>-----------------------------<br>Dog belongs to other seller.<br>-----------------------------<br>Dog not available."
     * ),
     *
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource.<br>-----------------------------------------------------------------------<br>Seller is not a hobby breeder."
     * )
     * )
     *
     */

    $api->patch('seller/litter/final', ['uses' => 'Modules\Seller\Http\Controllers\SellerController@patchSellerLitterFinal']);
});

$api->version('v1', function ($api)
{

    /**
     * @SWG\Post(
     *  path="/seller",
     *  description="Creates new seller",
     *  operationId="postSeller",
     *  tags={"Seller"},
     *
     * @SWG\Parameter(
     *  name="type",
     *  in = "query",
     *  description="Type of seller.",
     *  required=true,
     *  type="string",
     *  enum ={"hobby","verified"}
     * ),
     *
     * @SWG\Parameter(
     *  name="suburb_id",
     *  in = "query",
     *  description="Location.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * * @SWG\Parameter(
     *  name="state_id",
     *  in = "query",
     *  description="Location.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="address",
     *  in = "query",
     *  description="Address of the seller.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="language",
     *  in = "query",
     *  description="Language seller wants to use.",
     *  required=true,
     *  type="string"
     * ),
     *
     *
     * @SWG\Parameter(
     *  name="find_out",
     *  in = "query",
     *  description="How did seller found out this site.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="about",
     *  in = "query",
     *  description="Some information about seller.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="newsletter",
     *  in = "query",
     *  description="Does seller wants to receive newsletter",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="terms",
     *  in = "query",
     *  description="Does seller agrees to our terms.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="smartphone",
     *  in = "query",
     *  description="Use smartphone for this account.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired"
     * ),
     * @SWG\Response(
     *  response="404",
     *  description="User not found."
     * ),
     * @SWG\Response(
     *  response="403",
     *  description="Seller with that id already exists."
     * ),
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity"
     * )
     * )
     *
     */

    $api->post('seller', ['uses' => 'Modules\Seller\Http\Controllers\SellerController@postSeller']);

    /**
     * @SWG\Post(
     *  path="/seller/enquiry",
     *  description="Creates new enquiry for seller",
     *  operationId="postSellerEnquiry",
     *  tags={"Seller"},
     *
     * @SWG\Parameter(
     *  name="seller_id",
     *  in = "query",
     *  description="Id of the seller.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="dog_id",
     *  in = "query",
     *  description="Id of the dog user is interested in.",
     *  required=true,
     *  type="integer"
     * ),
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
     *  description="Enquiry is allready sent!"
     * ),
     *
     * @SWG\Response(
     *  response="400",
     *  description="Dog belongs to other seller."
     * )
     *
     * )
     *
     */

    $api->post('seller/enquiry', ['uses' => 'Modules\Seller\Http\Controllers\SellerController@postSellerEnquiry']);

    /**
     * @SWG\Get(
     *  path="/seller/slug/{slug}",
     *  description="Get seller slug.",
     *  operationId="getSellerSlug",
     *  tags={"Seller"},
     *
     * @SWG\Parameter(
     * 			name="slug",
     * 			in="path",
     * 			required=true,
     * 			type="string",
     * 			description="slug",
     * 		),
     *
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/sellerSlug")
     * ),
     *
     * @SWG\Response(
     *  response="404",
     *  description="Slug not found."
     * )
     * )
     *
     */

    $api->get('seller/slug/{slug}', ['uses' => 'Modules\Seller\Http\Controllers\SellerController@getSellerSlug']);


});



