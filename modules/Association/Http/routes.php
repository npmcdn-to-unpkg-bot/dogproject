<?php

$api = app('Dingo\Api\Routing\Router');


$api->version('v1', function ($api)
{
    /**
     * @SWG\Post(
     *  path="/association",
     *  description="Request creation of new association",
     *  operationId="postAssociation",
     *  tags={"Association"},
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="Name of the association.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="first_name",
     *  in = "query",
     *  description="First name of the key representative (profile owner).",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="last_name",
     *  in = "query",
     *  description="Last name of the key representative (profile owner).",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="email",
     *  in = "query",
     *  description="Email of the association",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="contact_number",
     *  in = "query",
     *  description="Telephone number for contact.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="suburb_id",
     *  in = "query",
     *  description="Location of the association.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="state_id",
     *  in = "query",
     *  description="Location of the association.",
     *  required=true,
     *  type="integer"
     * ),
     *
     *
     * @SWG\Response(
     *  response="201",
     *  description=""
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity."
     * )
     *
     * )
     *
     */

    $api->post('association', ['uses' => 'Modules\Association\Http\Controllers\AssociationController@postAssociation']);

    /**
     * @SWG\Get(
     *  path="/association/slug/{slug}",
     *  description="Get association members.",
     *  operationId="getAssociationMembers",
     *  tags={"Association"},
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
     *  @SWG\Schema(ref="#/definitions/slugAssociation")
     * ),
     *
     * @SWG\Response(
     *  response="404",
     *  description="Slug not found."
     * )
     *
     *
     * )
     *
     */

    $api->get('association/slug/{slug}', ['uses' => 'Modules\Association\Http\Controllers\AssociationController@getAssociationSlug']);

    $api->get('association/frontpage', ['uses' => 'Modules\Association\Http\Controllers\AssociationController@getAssociationFrontPage']);

    /**
     * @SWG\Post(
     *  path="/association/enquiry",
     *  description="Creates new enquiry for seller",
     *  operationId="postSellerEnquiry",
     *  tags={"Association"},
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="Name of the user.",
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
     *  name="enquiry",
     *  in = "query",
     *  description="Enquiry of the user.",
     *  required=true,
     *  type="string"
     * ),
     *
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity"
     * ),
     *
     * @SWG\Response(
     *  response="403",
     *  description="You have exceeded your rate limit."
     * )
     *
     * )
     *
     */

    $api->post('association/enquiry', ['middleware' => 'api.throttle', 'limit' => 1, 'expires' => 10, 'uses' => 'Modules\Association\Http\Controllers\AssociationController@postAssociationEnquiry']);

});

$api->version('v1',['middleware' => 'api.auth|bynd.api.permission.association'], function ($api)
{

    /**
     * @SWG\Put(
     *  path="/association",
     *  description="Edit all association information",
     *  operationId="putAssociation",
     *  tags={"Association"},
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="Name of the association.",
     *  required=true,
     *  type="string"
     * ),
     *
     *
     * @SWG\Parameter(
     *  name="suburb_id",
     *  in = "query",
     *  description="Location of the association.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="state_id",
     *  in = "query",
     *  description="Location of the association.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="breed",
     *  in = "query",
     *  description="Dog breed of the association.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="about",
     *  in = "query",
     *  description="General information of the association.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/editAssociation")
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable Entity."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired.<br>-----------------------------------------------------------------------<br>The token has been blacklisted<br>-----------------------------------------------------------------------Unable to authenticate with invalid token.<br>------------------------------------<br>Only association profiles can access this resource."
     * )
     *
     * )
     *
     */

    $api->put('association', ['uses' => 'Modules\Association\Http\Controllers\AssociationController@putAssociation']);

    /**
     * @SWG\Patch(
     *  path="/association",
     *  description="Edit some of the association information",
     *  operationId="patchAssociation",
     *  tags={"Association"},
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="Name of the association.",
     *  required=false,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="suburb_id",
     *  in = "query",
     *  description="Location of the association.",
     *  required=false,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="state_id",
     *  in = "query",
     *  description="Location of the association.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="breed",
     *  in = "query",
     *  description="Dog breed of the association.",
     *  required=false,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="about",
     *  in = "query",
     *  description="General information of the association.",
     *  required=false,
     *  type="string"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/editAssociation")
     * ),
     *
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable Entity."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired.<br>-----------------------------------------------------------------------<br>The token has been blacklisted<br>-----------------------------------------------------------------------Unable to authenticate with invalid token.<br>------------------------------------<br>Only association profiles can access this resource."
     * )
     * )
     *
     */

    $api->patch('association', ['uses' => 'Modules\Association\Http\Controllers\AssociationController@patchAssociation']);

    /**
     * @SWG\Post(
     *  path="/association/members",
     *  description="Add association members.",
     *  operationId="postAssociationMembers",
     *  tags={"Association"},
     *
     * @SWG\Parameter(
     *  name="suburb_id",
     *  in = "query",
     *  description="State where member lives.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="state_id",
     *  in = "query",
     *  description="Location of the association.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="member_email",
     *  in = "query",
     *  description="Mail of the breeder (new member).",
     *  required=true,
     *  type="string"
     * ),
     *
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable Entity."
     * ),
     *
     * @SWG\Response(
     *  response="403",
     *  description="Invite is allready sent to this user!"
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired.<br>-----------------------------------------------------------------------<br>The token has been blacklisted<br>-----------------------------------------------------------------------Unable to authenticate with invalid token.<br>------------------------------------<br>Only association profiles can access this resource."
     * )
     * )
     *
     */

    $api->post('association/members', ['uses' => 'Modules\Association\Http\Controllers\AssociationController@postAssociationMembers']);

    /**
     * @SWG\Delete(
     *  path="/association/members",
     *  description="Delete association members.",
     *  operationId="deleteAssociationMembers",
     *  tags={"Association"},
     *
     * @SWG\Parameter(
     *  name="id",
     *  in = "query",
     *  description="Delete member with given ID.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Response(
     *  response="404",
     *  description="User not found"
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable Entity."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired.<br>-----------------------------------------------------------------------<br>The token has been blacklisted<br>-----------------------------------------------------------------------Unable to authenticate with invalid token.<br>------------------------------------<br>Only association profiles can access this resource."
     * )
     * )
     *
     */

    $api->delete('association/members', ['uses' => 'Modules\Association\Http\Controllers\AssociationController@deleteAssociationMembers']);


    /**
     * @SWG\Get(
     *  path="/association/with",
     *  description="Get association relations that are manually specified.",
     *  operationId="getAssociationWith",
     *  tags={"Association"},
     *
     * @SWG\Parameter(
     *  name="relations",
     *  in = "query",
     *  description="Names of relations that user wants to get information from. Relations avaliable : users,breed,suburb,state,key_members,members",
     *  required=true,
     *  type="string"
     * ),
     *
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/associationWith")
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable Entity."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired.<br>-----------------------------------------------------------------------<br>The token has been blacklisted<br>-----------------------------------------------------------------------Unable to authenticate with invalid token.<br>------------------------------------<br>Only association profiles can access this resource."
     * )
     * )
     *
     */


    $api->get('association/with', ['uses' => 'Modules\Association\Http\Controllers\AssociationController@getAssociationWith']);

    /**
     * @SWG\Post(
     *  path="/association/images",
     *  description="Post association images.",
     *  operationId="postAssociationImages",
     *  tags={"Association"},
     *
     * @SWG\Parameter(
     *  name="avatar",
     *  in = "query",
     *  description="Avatar of the association.",
     *  required=true,
     *  type="file"
     * ),
     *
     * @SWG\Parameter(
     *  name="images",
     *  in = "query",
     *  description="Images of the association.",
     *  required=true,
     *  type="array",
     *  items="file"
     * ),
     *
     * @SWG\Parameter(
     *  name="banner_image",
     *  in = "query",
     *  description="Banner image of the association.",
     *  required=true,
     *  type="file"
     * ),
     *
     *
     * @SWG\Response(
     *  response="400",
     *  description="Size of images is too big"
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable Entity."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired.<br>-----------------------------------------------------------------------<br>The token has been blacklisted<br>-----------------------------------------------------------------------Unable to authenticate with invalid token.<br>------------------------------------<br>Only association profiles can access this resource."
     * )
     * )
     *
     */

    $api->post('association/images', ['uses' => 'Modules\Association\Http\Controllers\AssociationController@postAssociationImages']);

    /**
     * @SWG\Post(
     *  path="/association/keymembers",
     *  description="Post association keymembers.",
     *  operationId="postAssociationKeymembers",
     *  tags={"Association"},
     *
     * @SWG\Parameter(
     *  name="type",
     *  in = "query",
     *  description="Type of key member.",
     *  required=true,
     *  type="array",
     *  @SWG\Items(type = "string")
     * ),
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="Name of key member.",
     *  required=true,
     *  type="array",
     *  @SWG\Items(type = "string")
     * ),
     *
     * @SWG\Parameter(
     *  name="email",
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
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired.<br>-----------------------------------------------------------------------<br>The token has been blacklisted<br>-----------------------------------------------------------------------Unable to authenticate with invalid token.<br>------------------------------------<br>Only association profiles can access this resource."
     * )
     * )
     *
     */

    $api->post('association/keymembers', ['uses' => 'Modules\Association\Http\Controllers\AssociationController@postAssociationKeyMembers']);

    /**
     * @SWG\Delete(
     *  path="/association/keymembers",
     *  description="Delete association keymembers.",
     *  operationId="deleteAssociationKeymembers",
     *  tags={"Association"},
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
     *  description="Keymember belongs to other association"
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired.<br>-----------------------------------------------------------------------<br>The token has been blacklisted<br>-----------------------------------------------------------------------Unable to authenticate with invalid token.<br>------------------------------------<br>Only association profiles can access this resource."
     * )
     * )
     *
     */

    $api->delete('association/keymembers', ['uses' => 'Modules\Association\Http\Controllers\AssociationController@deleteAssociationKeyMembers']);



});



