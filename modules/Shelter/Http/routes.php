<?php

$api = app('Dingo\Api\Routing\Router');


$api->version('v1', function ($api)
{

    /**
     * @SWG\Get(
     *  path="/shelter/slug/{slug}",
     *  description="Returns shelter and specified related information based on slug",
     *  operationId="getShelterSlug",
     *  tags={"Shelter"},
     *
     * @SWG\Parameter(
     *  name="slug",
     *  in = "path",
     *  description="Shelter slug",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/shelterSlug")
     * ),
     *
     * @SWG\Response(
     *  response="404",
     *  description="Slug not found."
     * )
     * )
     *
     */

    $api->get('shelter/slug/{slug}', ['uses' => 'Modules\Shelter\Http\Controllers\ShelterController@getShelterSlug']);

    /**
     * @SWG\Post(
     *  path="/shelter/enquiry",
     *  description="Creates new shelter enquiry",
     *  operationId="postShelterEnquiry",
     *  tags={"Shelter"},
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="Name of user",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="email",
     *  in = "query",
     *  description="Email of user",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="enquiry",
     *  in = "query",
     *  description= "Enquiry",
     *  required=true,
     *  type="string"
     * ),
     *
     *
     * @SWG\Response(
     *  response="403",
     *  description="You have exceeded your rate limit."
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity"
     * )
     * )
     *
     */

    $api->post('shelter/enquiry', ['middleware' => 'api.throttle', 'limit' => 1, 'expires' => 10, 'uses' => 'Modules\Shelter\Http\Controllers\ShelterController@postShelterEnquiry']);

    /**
     * @SWG\Post(
     *  path="/shelter/dog/enquiry",
     *  description="Creates new dog enquiry for shelter",
     *  operationId="postShelterDogEnquiry",
     *  tags={"Shelter"},
     *
     * @SWG\Parameter(
     *  name="shelter_id",
     *  in = "query",
     *  description="Id of shelter",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="dog_id",
     *  in = "query",
     *  description="Id of dog",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description= "Name",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="email",
     *  in = "query",
     *  description= "Email",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="contact_number",
     *  in = "query",
     *  description= "Contact number",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="enquiry",
     *  in = "query",
     *  description= "Enquiry",
     *  required=true,
     *  type="string"
     * ),
     *
     *
     * @SWG\Response(
     *  response="403",
     *  description="Enquiry is allready sent!"
     * ),
     *
     * @SWG\Response(
     *  response="400",
     *  description="Dog belongs to other shelter."
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity"
     * )
     * )
     *
     */

    $api->post('shelter/dog/enquiry', ['uses' => 'Modules\Shelter\Http\Controllers\ShelterController@postShelterDogEnquiry']);

});

$api->version('v1',['middleware' => 'api.auth'], function ($api)
{

    /**
     * @SWG\Post(
     *  path="/shelter",
     *  description="Creates new shelter",
     *  operationId="postShelter",
     *  tags={"Shelter"},
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="Name of shelter",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="web_address",
     *  in = "query",
     *  description="Web address of shelter",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="address",
     *  in = "query",
     *  description= "Address of shelter",
     *  required=true,
     *  type="string"
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
     *  name="facebook",
     *  in = "query",
     *  description="Facebook of the shelter.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="twitter",
     *  in = "query",
     *  description="Twitter of the shelter.",
     *  required=true,
     *  type="string"
     * ),
     *
     *
     * @SWG\Parameter(
     *  name="instagram",
     *  in = "query",
     *  description="Instagram of the shelter",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="about",
     *  in = "query",
     *  description="Some information about shelter.",
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
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired"
     * ),
     *
     * @SWG\Response(
     *  response="403",
     *  description="Shelter with that id already exists."
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity"
     * )
     * )
     *
     */

    $api->post('shelter', ['uses' => 'Modules\Shelter\Http\Controllers\ShelterController@postShelter']);


});

$api->version('v1',['middleware' => 'api.auth|bynd.api.permission.shelter'], function ($api)
{

    /**
     * @SWG\Put(
     *  path="/shelter",
     *  description="Edits whole shelter resource",
     *  operationId="putShelter",
     *  tags={"Shelter"},
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="Name of shelter",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="web_address",
     *  in = "query",
     *  description="Web address of shelter",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="address",
     *  in = "query",
     *  description= "Address of shelter",
     *  required=true,
     *  type="string"
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
     *  name="facebook",
     *  in = "query",
     *  description="Facebook of the shelter.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="twitter",
     *  in = "query",
     *  description="Twitter of the shelter.",
     *  required=true,
     *  type="string"
     * ),
     *
     *
     * @SWG\Parameter(
     *  name="instagram",
     *  in = "query",
     *  description="Instagram of the shelter",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="about",
     *  in = "query",
     *  description="Some information about shelter.",
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
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only shelter profiles can access this resource."
     * ),
     *
     * @SWG\Response(
     *  response="404",
     *  description="Shelter not found."
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity"
     * )
     * )
     *
     */

    $api->put('shelter', ['uses' => 'Modules\Shelter\Http\Controllers\ShelterController@putShelter']);

    /**
     * @SWG\Patch(
     *  path="/shelter",
     *  description="Edits partial shelter resource",
     *  operationId="patchShelter",
     *  tags={"Shelter"},
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="Name of shelter",
     *  required=false,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="web_address",
     *  in = "query",
     *  description="Web address of shelter",
     *  required=false,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="address",
     *  in = "query",
     *  description= "Address of shelter",
     *  required=false,
     *  type="string"
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
     * * @SWG\Parameter(
     *  name="state_id",
     *  in = "query",
     *  description="Location.",
     *  required=false,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="facebook",
     *  in = "query",
     *  description="Facebook of the shelter.",
     *  required=false,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="twitter",
     *  in = "query",
     *  description="Twitter of the shelter.",
     *  required=false,
     *  type="string"
     * ),
     *
     *
     * @SWG\Parameter(
     *  name="instagram",
     *  in = "query",
     *  description="Instagram of the shelter",
     *  required=false,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="about",
     *  in = "query",
     *  description="Some information about shelter.",
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
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only shelter profiles can access this resource."
     * ),
     *
     * @SWG\Response(
     *  response="404",
     *  description="Shelter not found."
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity"
     * )
     * )
     *
     */

    $api->patch('shelter', ['uses' => 'Modules\Shelter\Http\Controllers\ShelterController@patchShelter']);


    /**
     * @SWG\Get(
     *  path="/shelter/with",
     *  description="Returns shelter and specified related information",
     *  operationId="getShelterWith",
     *  tags={"Shelter"},
     *
     * @SWG\Parameter(
     *  name="relations",
     *  in = "query",
     *  description="Names of relations that user wants to get information from. Relations avaliable : key_members,suburb,state,user,review,dogs,shelter_enquiry",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/shelterWith")
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity"
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only shelter profiles can access this resource."
     * )
     * )
     *
     */

    $api->get('shelter/with', ['uses' => 'Modules\Shelter\Http\Controllers\ShelterController@getShelterWith']);


    /**
     * @SWG\Post(
     *  path="/shelter/images",
     *  description="Post shelter avatar",
     *  operationId="postShelterImages",
     *  tags={"Shelter"},
     *
     * @SWG\Parameter(
     *  name="avatar",
     *  in = "query",
     *  description="Avatar of the shelter.",
     *  required=true,
     *  type="file"
     * ),
     *
     * @SWG\Parameter(
     *  name="advert_photo",
     *  in = "query",
     *  description="Advert photo of the shelter.",
     *  required=true,
     *  type="file"
     * ),
     *
     * @SWG\Parameter(
     *  name="images[]",
     *  in = "query",
     *  description="Images of the shelter",
     *  required=true,
     *  type="array",
     *  items="file"
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

    $api->post('shelter/images', ['uses' => 'Modules\Shelter\Http\Controllers\ShelterController@postShelterImages']);

    /**
     * @SWG\Post(
     *  path="/shelter/keymembers",
     *  description="Post shelter keymembers.",
     *  operationId="postShelterKeymembers",
     *  tags={"Shelter"},
     *
     * @SWG\Parameter(
     *  name="type[]",
     *  in = "query",
     *  description="Type of key member.",
     *  required=true,
     *  type="array",
     *  @SWG\Items(type = "string")
     * ),
     *
     * @SWG\Parameter(
     *  name="name[]",
     *  in = "query",
     *  description="Name of key member.",
     *  required=true,
     *  type="array",
     *  @SWG\Items(type = "string")
     * ),
     *
     * @SWG\Parameter(
     *  name="email[]",
     *  in = "query",
     *  description="Email of keymember.",
     *  required=true,
     *  type="array",
     *  @SWG\Items(type = "string")
     * ),
     *
     *
     *
     * @SWG\Response(
     *  response="400",
     *  description="Not all data is provided."
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable Entity."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired.<br>-----------------------------------------------------------------------<br>The token has been blacklisted<br>-----------------------------------------------------------------------Unable to authenticate with invalid token.<br>------------------------------------<br>Only shelter profiles can access this resource."
     * )
     * )
     *
     */

    $api->post('shelter/keymembers', ['uses' => 'Modules\Shelter\Http\Controllers\ShelterController@postShelterKeyMembers']);

    /**
     * @SWG\Delete(
     *  path="/shelter/keymembers",
     *  description="Delete shelter keymembers.",
     *  operationId="deleteShelterKeymembers",
     *  tags={"Shelter"},
     *
     * @SWG\Parameter(
     *  name="id",
     *  in = "query",
     *  description="Id of key member.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable Entity."
     * ),
     *
     * @SWG\Response(
     *  response="400",
     *  description="Keymember belongs to other shelter"
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired.<br>-----------------------------------------------------------------------<br>The token has been blacklisted<br>-----------------------------------------------------------------------Unable to authenticate with invalid token.<br>------------------------------------<br>Only shelter profiles can access this resource."
     * )
     * )
     *
     */

    $api->delete('shelter/keymembers', ['uses' => 'Modules\Shelter\Http\Controllers\ShelterController@deleteShelterKeyMembers']);

});



