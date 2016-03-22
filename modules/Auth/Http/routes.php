<?php

$api = app('Dingo\Api\Routing\Router');


$api->version('v1', function ($api)
{

    /**
     * @SWG\Get(
     *  path="/auth/user",
     *  description="Get user information from token.",
     *  operationId="getAuthUser",
     *  tags={"Auth"},
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/userId")
     * ),
     *
     *@SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired.<br>-----------------------------------------------------------------------<br>The token has been blacklisted<br>-----------------------------------------------------------------------Unable to authenticate with invalid token.<br>"
     * )
     *
     * )
     *
     */

    $api->get('auth/user', ['middleware' =>'api.auth','uses' => 'Modules\Auth\Http\Controllers\AuthController@getAuthUser']);


    $api->get('auth/user/with', ['middleware' =>'api.auth','uses' => 'Modules\Auth\Http\Controllers\AuthController@getUserWith']);

    /**
     * @SWG\Patch(
     *  path="/auth/user",
     *  description="Updates user based on token.",
     *  operationId="getUpdate",
     *  tags={"Auth"},
     *
     * @SWG\Parameter(
     *  name="first_name",
     *  in = "query",
     *  description="First name of the user.",
     *  required=false,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="last_name",
     *  in = "query",
     *  description="Last name of the user.",
     *  required=false,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="email",
     *  in = "query",
     *  description="Email of the user.",
     *  required=false,
     *  type="string"
     * ),
     *
     *
     * @SWG\Parameter(
     *  name="contact_number",
     *  in = "query",
     *  description="Phone number of the user.",
     *  required=false,
     *  type="string"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/userId")
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired.<br>-----------------------------------------------------------------------<br>The token has been blacklisted<br>-----------------------------------------------------------------------Unable to authenticate with invalid token.<br>"
     * )
     * )
     *
     */

    $api->patch('auth/user', ['middleware' =>'api.auth','uses' => 'Modules\Auth\Http\Controllers\AuthController@patchAuthUser']);

    /**
     * @SWG\Patch(
     *  path="/auth/user/password",
     *  description="Method for changing password",
     *  operationId="patchAuthUserPassword",
     *  tags={"Auth"},
     *
     * @SWG\Parameter(
     *  name="password",
     *  in = "query",
     *  description="New password",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="password_confirmation",
     *  in = "query",
     *  description="Confirm new password.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/userId")
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable Entity."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired.<br>-----------------------------------------------------------------------<br>The token has been blacklisted<br>-----------------------------------------------------------------------Unable to authenticate with invalid token.<br>"
     * )
     * )
     *
     */

    $api->patch('auth/user/password', ['middleware' =>'api.auth','uses' => 'Modules\Auth\Http\Controllers\AuthController@patchAuthUserPassword']);

    /**
     * @SWG\Post(
     *  path="/auth/user",
     *  description="Register user.",
     *  operationId="postAuthUser",
     *  tags={"Auth"},
     *
     * @SWG\Parameter(
     *  name="first_name",
     *  in = "query",
     *  description="First name of the user.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="last_name",
     *  in = "query",
     *  description="Last name of the user.",
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
     *  name="password",
     *  in = "query",
     *  description="Password",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="contact_number",
     *  in = "query",
     *  description="Phone number of the user.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="role",
     *  in = "query",
     *  description="Role of the user.",
     *  required=true,
     *  type="integer",
     *  enum="13",
     * ),
     *
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/token")
     * ),
     *
     * @SWG\Response(
     *  response="500",
     *  description="Internal error."
     *  ),
     *
     *
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable Entity."
     *     )
     *
     * )
     *
     */

    $api->post('auth/user', ['uses' => 'Modules\Auth\Http\Controllers\AuthController@postAuthUser']);

    /**
     * @SWG\Delete(
     *  path="/auth/user",
     *  description="Deletes user based on token.",
     *  operationId="deleteAuthUser",
     *  tags={"Auth"},
     *
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired.<br>-----------------------------------------------------------------------<br>The token has been blacklisted<br>-----------------------------------------------------------------------Unable to authenticate with invalid token.<br>"
     * )
     * )
     *
     */

    $api->delete('auth/user', ['middleware' =>'api.auth','uses' => 'Modules\Auth\Http\Controllers\AuthController@deleteAuthUser']);

    /**
     * @SWG\Get(
     *  path="/auth/token",
     *  description="Log in and get the token.",
     *  operationId="getAuthToken",
     *  tags={"Auth"},
     *
     * @SWG\Parameter(
     *  name="email",
     *  in = "query",
     *  description="Email of user that needs to be authenticated.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="password",
     *  in = "query",
     *  description="Password of user that needs to be authenticated.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/token")
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable Entity."
     *     ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Incorrect email / password combination.<br>--------------------------------------<br>Inactive user.",
     *  @SWG\Schema(ref="#/definitions/ErrorResult")
     * )
     * )
     *
     */

    $api->get('auth/token', ['uses' => 'Modules\Auth\Http\Controllers\AuthController@getAuthToken']);

    /**
     * @SWG\Get(
     *  path="/auth/token/refresh",
     *  description="Get refreshed token from expired token",
     *  operationId="getAuthTokenRefresh",
     *  tags={"Auth"},
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/newToken")
     * ),
     *
     *
     * @SWG\Response(
     *  response="498",
     *  description="Token has expired",
     *  @SWG\Schema(ref="#/definitions/ErrorResult")
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Token invalid",
     *  @SWG\Schema(ref="#/definitions/ErrorResult")
     * )
     * )
     *
     */

    $api->get('auth/token/refresh', ['middleware' =>'bynd.api.auth.refresh' ,'uses' => 'Modules\Auth\Http\Controllers\AuthController@getAuthTokenRefresh']);

    /**
     * @SWG\Get(
     *  path="/auth/token/destroy",
     *  description="Logs out user based on token.",
     *  operationId="getAuthTokenDestroy",
     *  tags={"Auth"},
     *
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired.<br>-----------------------------------------------------------------------<br>The token has been blacklisted<br>-----------------------------------------------------------------------Unable to authenticate with invalid token.<br>"
     * )
     * )
     *
     */

    $api->get('auth/token/destroy', ['middleware' =>'api.auth' ,'uses' => 'Modules\Auth\Http\Controllers\AuthController@getAuthTokenDestroy']);

    /**
     * @SWG\Get(
     *  path="/auth/token/blacklist",
     *  description="Logs out user based and blacklists their token.",
     *  operationId="getAuthTokenBlacklist",
     *  tags={"Auth"},
     *
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired.<br>-----------------------------------------------------------------------<br>The token has been blacklisted<br>-----------------------------------------------------------------------Unable to authenticate with invalid token.<br>"
     * )
     * )
     *
     */

    $api->get('auth/token/blacklist', ['middleware' =>'api.auth' ,'uses' => 'Modules\Auth\Http\Controllers\AuthController@getAuthTokenDestroy']);

    // Password reset link request routes...

    /**
     * @SWG\Post(
     *  path="/auth/user/reset/password",
     *  description="Gets password reset token on mail.",
     *  operationId="postResetToken",
     *  tags={"Auth"},
     *
     * @SWG\Parameter(
     *  name="email",
     *  in = "query",
     *  description="Email of user to send reset password token to.",
     *  required=true,
     *  type="string"
     * ),
     *
     *
     * @SWG\Response(
     *  response="200",
     *  description="We have e-mailed your password reset link!"
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable Entity."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="We can't find a user with that e-mail address."
     * )
     *
     * )
     *
     */

    $api->post('auth/user/reset/password', ['uses' => 'Modules\Auth\Http\Controllers\AuthController@postAuthUserResetPassword']); //in trait

    /**
     * @SWG\Patch(
     *  path="/auth/user/reset/password",
     *  description="Resets password.",
     *  operationId="patchAuthUserResetPassword",
     *  tags={"Auth"},
     *
     * @SWG\Parameter(
     *  name="token",
     *  in = "query",
     *  description="Token for reseting password.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="password",
     *  in = "query",
     *  description="New password.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="password_confirmation",
     *  in = "query",
     *  description="New password.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="Your password has been reset!"
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable Entity."
     * ),
     *
     * @SWG\Response(
     *  response="400",
     *  description="This password reset token is invalid."
     * )
     *
     * )
     *
     */

    $api->patch('auth/user/reset/password', ['uses' => 'Modules\Auth\Http\Controllers\AuthController@patchAuthUserResetPassword']); //in trait

    /**
     * @SWG\Post(
     *  path="/auth/token/validate",
     *  description="Validates reset password token.",
     *  operationId="postAuthTokenValidate",
     *  tags={"Auth"},
     *
     * @SWG\Parameter(
     *  name="reset_token",
     *  in = "query",
     *  description="Token for reseting password.",
     *  required=true,
     *  type="string"
     * ),
     *
     *
     * @SWG\Response(
     *  response="202",
     *  description=""
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable Entity."
     * ),
     *
     * @SWG\Response(
     *  response="403",
     *  description="Token does not exists."
     * ),
     *
     * @SWG\Response(
     *  response="400",
     *  description="Your password reset token has expired."
     * )
     *
     * )
     *
     */

    $api->post('auth/token/validate', ['uses' => 'Modules\Auth\Http\Controllers\AuthController@postAuthTokenValidate']);

});

