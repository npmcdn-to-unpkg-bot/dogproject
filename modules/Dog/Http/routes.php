<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',['middleware' => 'api.auth|bynd.api.permission.seller'], function ($api)
{

    /**
     * @SWG\Post(
     *  path="/dog",
     *  description="Add new dog to listing",
     *  operationId="postDog",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="breed_id",
     *  in = "query",
     *  description="Id of dog breed.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="birth_date",
     *  in = "query",
     *  description="Date when dog was born.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="type_of_listing",
     *  in = "query",
     *  description="Type of listing (single,mature, litter).",
     *  required=true,
     *  type="string",
     *  enum ={"single","mature","litter"}
     * ),
     *
     * @SWG\Parameter(
     *  name="sex",
     *  in = "query",
     *  description="M or f",
     *  required=false,
     *  type="string",
     *  enum="mf"
     * ),
     *
     * @SWG\Parameter(
     *  name="male_qty",
     *  in = "query",
     *  description="Number of male dogs in litter",
     *  required=false,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="female_qty",
     *  in = "query",
     *  description="Number of female dogs in litter",
     *  required=false,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="cost",
     *  in = "query",
     *  description="Price of dog.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="about",
     *  in = "query",
     *  description="Information about dog.",
     *  required=true,
     *  type="string"
     * ),
     *
     *
     * @SWG\Parameter(
     *  name="mother_id",
     *  in = "query",
     *  description="Id of dog mother.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="father_id",
     *  in = "query",
     *  description="Id of dog father.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="vaccination",
     * in = "query",
     *  description="Is dog vaccinated.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="vet_checked",
     *  in = "query",
     *  description="Is dog vet checked.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="desexed",
     *  in = "query",
     *  description="Is dog desexed.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="de_warmed",
     *  in = "query",
     *  description="Is dog de-warmed.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="micro_chipped",
     *  in = "query",
     *  description="Is dog micro chipped.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="registration_papers",
     *  in = "query",
     *  description="Does dog have registration papers.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Response(
     *  response="400",
     *  description="Father dog does not belong to this seller.<br>------------------------------------------------<br>Mother dog does not belong to this seller."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
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

    $api->post('dog', ['uses' => 'Modules\Dog\Http\Controllers\DogController@postDog']);

    /**
     * @SWG\Put(
     *  path="/dog",
     *  description="Update whole dog information",
     *  operationId="putDog",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="id",
     *  in = "query",
     *  description="Id of dog that needs update.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="breed_id",
     *  in = "query",
     *  description="Id of dog breed.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="birth_date",
     *  in = "query",
     *  description="Date when dog was born.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="type_of_listing",
     *  in = "query",
     *  description="Type of listing (single,mature, litter).",
     *  required=true,
     *  type="string",
     *  enum ={"single","mature","litter"}
     * ),
     *
     * @SWG\Parameter(
     *  name="sex",
     *  in = "query",
     *  description="M or f",
     *  required=false,
     *  type="string",
     *  enum="mf"
     * ),
     *
     * @SWG\Parameter(
     *  name="male_qty",
     *  in = "query",
     *  description="Number of male dogs in litter",
     *  required=false,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="female_qty",
     *  in = "query",
     *  description="Number of female dogs in litter",
     *  required=false,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="cost",
     *  in = "query",
     *  description="Price of dog.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="about",
     *  in = "query",
     *  description="Information about dog.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="mother_id",
     *  in = "query",
     *  description="Id of dog mother.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="father_id",
     *  in = "query",
     *  description="Id of dog father.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="vaccination",
     * in = "query",
     *  description="Is dog vaccinated.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="vet_checked",
     *  in = "query",
     *  description="Is dog vet checked.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="desexed",
     *  in = "query",
     *  description="Is dog desexed.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="de_warmed",
     *  in = "query",
     *  description="Is dog de-warmed.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="micro_chipped",
     *  in = "query",
     *  description="Is dog micro chipped.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="registration_papers",
     *  in = "query",
     *  description="Does dog have registration papers.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     * @SWG\Schema(ref="#/definitions/editDog")
     * ),
     *
     * @SWG\Response(
     *  response="400",
     *  description="Father dog does not belong to this seller.<br>------------------------------------------------<br>Mother dog does not belong to this seller.<br>-------------------------------------------<br>Wrong type of listing."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
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

    $api->put('dog', ['uses' => 'Modules\Dog\Http\Controllers\DogController@putDog']);

    /**
     * @SWG\Patch(
     *  path="/dog",
     *  description="Update partial dog information",
     *  operationId="patchDog",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="id",
     *  in = "query",
     *  description="Id of dog that needs update.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="breed_id",
     *  in = "query",
     *  description="Id of dog breed.",
     *  required=false,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="birth_date",
     *  in = "query",
     *  description="Date when dog was born.",
     *  required=false,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="type_of_listing",
     *  in = "query",
     *  description="Type of listing (single,mature, litter).",
     *  required=true,
     *  type="string",
     *  enum ={"single","mature","litter"}
     * ),
     *
     * @SWG\Parameter(
     *  name="sex",
     *  in = "query",
     *  description="M or f",
     *  required=false,
     *  type="string",
     *  enum="mf"
     * ),
     *
     * @SWG\Parameter(
     *  name="male_qty",
     *  in = "query",
     *  description="Number of male dogs in litter",
     *  required=false,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="female_qty",
     *  in = "query",
     *  description="Number of female dogs in litter",
     *  required=false,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="cost",
     *  in = "query",
     *  description="Price of dog.",
     *  required=false,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="about",
     *  in = "query",
     *  description="Information about dog.",
     *  required=false,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="mother_id",
     *  in = "query",
     *  description="Id of dog mother.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="father_id",
     *  in = "query",
     *  description="Id of dog father.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="vaccination",
     * in = "query",
     *  description="Is dog vaccinated.",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="vet_checked",
     *  in = "query",
     *  description="Is dog vet checked.",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="desexed",
     *  in = "query",
     *  description="Is dog desexed.",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="de_warmed",
     *  in = "query",
     *  description="Is dog de-warmed.",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="micro_chipped",
     *  in = "query",
     *  description="Is dog micro chipped.",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="registration_papers",
     *  in = "query",
     *  description="Does dog have registration papers.",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     * @SWG\Schema(ref="#/definitions/editDog")
     * ),
     *
     * @SWG\Response(
     *  response="400",
     *  description="Father dog does not belong to this seller.<br>------------------------------------------------<br>Mother dog does not belong to this seller.<br>-------------------------------------------<br>Wrong type of listing."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
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

    $api->patch('dog', ['uses' => 'Modules\Dog\Http\Controllers\DogController@patchDog']);

    /**
     * @SWG\Delete(
     *  path="/dog",
     *  description="Delete dog.",
     *  operationId="deleteDog",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="id",
     *  in = "query",
     *  description="Id of dog that needs to be deleted.",
     *  required=true,
     *  type="integer"
     * ),
     *
     *
     *
     * @SWG\Response(
     *  response="400",
     *  description="Dog belongs to other seller."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
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

    $api->delete('dog', ['uses' => 'Modules\Dog\Http\Controllers\DogController@deleteDog']);

    /**
     * @SWG\Post(
     *  path="/dog/mother",
     *  description="Add dog mother",
     *  operationId="postDogMother",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="breed_id",
     *  in = "query",
     *  description="Id of dog breed.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="Name of dog.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="birth_date",
     *  in = "query",
     *  description="Date when dog was born.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="temperament",
     *  in = "query",
     *  description="Temperament scale.",
     *  required=true,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Parameter(
     *  name="energy",
     *  in = "query",
     *  description="Energy scale.",
     *  required=true,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Parameter(
     *  name="intelligence",
     *  in = "query",
     *  description="Intelligence scale.",
     *  required=true,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Parameter(
     *  name="maintenance",
     *  in = "query",
     *  description="Maintenance scale.",
     *  required=true,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     * @SWG\Schema(ref="#/definitions/dogMotherId")
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
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

    $api->post('dog/mother', ['uses' => 'Modules\Dog\Http\Controllers\DogController@postDogMother']);

    ////Novo

    /**
     * @SWG\Put(
     *  path="/dog/mother",
     *  description="Edit dog mother",
     *  operationId="putDogMother",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="id",
     *  in = "query",
     *  description="Id to perform update.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="breed_id",
     *  in = "query",
     *  description="Id of dog breed.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="Name of dog.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="birth_date",
     *  in = "query",
     *  description="Date when dog was born.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="temperament",
     *  in = "query",
     *  description="Temperament scale.",
     *  required=true,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Parameter(
     *  name="energy",
     *  in = "query",
     *  description="Energy scale.",
     *  required=true,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Parameter(
     *  name="intelligence",
     *  in = "query",
     *  description="Intelligence scale.",
     *  required=true,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Parameter(
     *  name="maintenance",
     *  in = "query",
     *  description="Maintenance scale.",
     *  required=true,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     * @SWG\Schema(ref="#/definitions/dogParents")
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
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

    $api->put('dog/mother', ['uses' => 'Modules\Dog\Http\Controllers\DogController@putDogMother']);

    /**
     * @SWG\Patch(
     *  path="/dog/mother",
     *  description="Update partial dog mother information",
     *  operationId="patchDogMother",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="id",
     *  in = "query",
     *  description="Id to perform update.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="breed_id",
     *  in = "query",
     *  description="Id of dog breed.",
     *  required=false,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="Name of dog.",
     *  required=false,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="birth_date",
     *  in = "query",
     *  description="Date when dog was born.",
     *  required=false,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="temperament",
     *  in = "query",
     *  description="Temperament scale.",
     *  required=false,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Parameter(
     *  name="energy",
     *  in = "query",
     *  description="Energy scale.",
     *  required=false,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Parameter(
     *  name="intelligence",
     *  in = "query",
     *  description="Intelligence scale.",
     *  required=false,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Parameter(
     *  name="maintenance",
     *  in = "query",
     *  description="Maintenance scale.",
     *  required=false,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     * @SWG\Schema(ref="#/definitions/dogParents")
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
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

    $api->patch('dog/mother', ['uses' => 'Modules\Dog\Http\Controllers\DogController@patchDogMother']);


    /////

    /**
     * @SWG\Get(
     *  path="/dog/mother",
     *  description="Get all dogs mother for user",
     *  operationId="getDogMother",
     *  tags={"Dog"},
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     * @SWG\Schema(ref="#/definitions/dogParentData")
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
     * )
     * )
     *
     */

    $api->get('dog/mother', ['uses' => 'Modules\Dog\Http\Controllers\DogController@getDogMother']);

    /**
     * @SWG\Post(
     *  path="/dog/mother/image",
     *  description="Add dog mother image",
     *  operationId="postDogMotherImage",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="image",
     *  in = "query",
     *  description="Image of dog mother",
     *  required=true,
     *  type="file"
     * ),
     *
     * @SWG\Parameter(
     *  name="mother_id",
     *  in = "query",
     *  description="Id of dog mother",
     *  required=true,
     *  type="integer"
     * ),
     *
     *
     * @SWG\Response(
     *  response="400",
     *  description="Mother dog belongs to other seller."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
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

    $api->post('dog/mother/image', ['uses' => 'Modules\Dog\Http\Controllers\DogController@postDogMotherImage']);

    /**
     * @SWG\Delete(
     *  path="/dog/mother",
     *  description="Delete dog mother",
     *  operationId="deleteDogMother",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="id",
     *  in = "query",
     *  description="Id of dog mother to delete.",
     *  required=true,
     *  type="integer"
     * ),
     *
     *
     * @SWG\Response(
     *  response="400",
     *  description="Dog mother does not belong to this seller."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
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

    $api->delete('dog/mother', ['uses' => 'Modules\Dog\Http\Controllers\DogController@deleteDogMother']);

    /**
     * @SWG\Post(
     *  path="/dog/father",
     *  description="Add dog father",
     *  operationId="postDogFather",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="breed_id",
     *  in = "query",
     *  description="Id of dog breed.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="Name of dog.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="birth_date",
     *  in = "query",
     *  description="Date when dog was born.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="temperament",
     *  in = "query",
     *  description="Temperament scale.",
     *  required=true,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Parameter(
     *  name="energy",
     *  in = "query",
     *  description="Energy scale.",
     *  required=true,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Parameter(
     *  name="intelligence",
     *  in = "query",
     *  description="Intelligence scale.",
     *  required=true,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Parameter(
     *  name="maintenance",
     *  in = "query",
     *  description="Maintenance scale.",
     *  required=true,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     * @SWG\Schema(ref="#/definitions/dogFatherId")
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
     *
     * )
     *
     */

    $api->post('dog/father', ['uses' => 'Modules\Dog\Http\Controllers\DogController@postDogFather']);

    /**
     * @SWG\Get(
     *  path="/dog/father",
     *  description="Get all dogs father for user",
     *  operationId="getDogFather",
     *  tags={"Dog"},
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     * @SWG\Schema(ref="#/definitions/dogParentData")
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
     * )
     * )
     *
     */

    $api->get('dog/father', ['uses' => 'Modules\Dog\Http\Controllers\DogController@getDogFather']);

    ////Novo

    /**
     * @SWG\Put(
     *  path="/dog/father",
     *  description="Edit dog father",
     *  operationId="putDogFather",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="breed_id",
     *  in = "query",
     *  description="Id of dog breed.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="Name of dog.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="birth_date",
     *  in = "query",
     *  description="Date when dog was born.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="temperament",
     *  in = "query",
     *  description="Temperament scale.",
     *  required=true,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Parameter(
     *  name="energy",
     *  in = "query",
     *  description="Energy scale.",
     *  required=true,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Parameter(
     *  name="intelligence",
     *  in = "query",
     *  description="Intelligence scale.",
     *  required=true,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Parameter(
     *  name="maintenance",
     *  in = "query",
     *  description="Maintenance scale.",
     *  required=true,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     * @SWG\Schema(ref="#/definitions/dogParents")
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
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

    $api->put('dog/father', ['uses' => 'Modules\Dog\Http\Controllers\DogController@putDogFather']);

    /**
     * @SWG\Patch(
     *  path="/dog/father",
     *  description="Update partial dog father information",
     *  operationId="patchDogFather",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="breed_id",
     *  in = "query",
     *  description="Id of dog breed.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="Name of dog.",
     *  required=false,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="birth_date",
     *  in = "query",
     *  description="Date when dog was born.",
     *  required=false,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="temperament",
     *  in = "query",
     *  description="Temperament scale.",
     *  required=false,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Parameter(
     *  name="energy",
     *  in = "query",
     *  description="Energy scale.",
     *  required=false,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Parameter(
     *  name="intelligence",
     *  in = "query",
     *  description="Intelligence scale.",
     *  required=false,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Parameter(
     *  name="maintenance",
     *  in = "query",
     *  description="Maintenance scale.",
     *  required=false,
     *  type="integer",
     *  enum="123"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     * @SWG\Schema(ref="#/definitions/dogParents")
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
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

    $api->patch('dog/father', ['uses' => 'Modules\Dog\Http\Controllers\DogController@patchDogFather']);

    /////

    /**
     * @SWG\Post(
     *  path="/dog/father/image",
     *  description="Add dog father image",
     *  operationId="postDogFatherImage",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="image",
     *  in = "query",
     *  description="Image of dog mother",
     *  required=true,
     *  type="file"
     * ),
     *
     * @SWG\Parameter(
     *  name="father_id",
     *  in = "query",
     *  description="Id of dog father",
     *  required=true,
     *  type="integer"
     * ),
     *
     *
     * @SWG\Response(
     *  response="400",
     *  description="Father dog belongs to other seller."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
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

    $api->post('dog/father/image', ['uses' => 'Modules\Dog\Http\Controllers\DogController@postDogFatherImage']);

    /**
     * @SWG\Delete(
     *  path="/dog/father",
     *  description="Delete dog father",
     *  operationId="deleteDogFather",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="id",
     *  in = "query",
     *  description="Id of dog father to delete.",
     *  required=true,
     *  type="integer"
     * ),
     *
     *
     * @SWG\Response(
     *  response="400",
     *  description="Dog father does not belong to this seller."
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
     *
     * )
     *
     */

    $api->delete('dog/father', ['uses' => 'Modules\Dog\Http\Controllers\DogController@deleteDogFather']);

    /**
     * @SWG\Post(
     *  path="/dog/images",
     *  description="Post dog images",
     *  operationId="postDogImages",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="dog_id",
     *  in = "query",
     *  description="Id of dog whose pictures are uploading.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="images",
     *  in = "query",
     *  description="Images of the dog.",
     *  required=true,
     *  type="array",
     *  @SWG\Items(type = "string")
     * ),
     *
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
     *
     * )
     *
     */

    $api->post('dog/images', ['uses' => 'Modules\Dog\Http\Controllers\DogController@postDogImages']);

    /**
     * @SWG\Get(
     *  path="/dog/litter/count",
     *  description="Get count of dog litters by specific seller",
     *  operationId="getDogLitterCount",
     *  tags={"Dog"},
     *
     * @SWG\Response(
     *  response="200",
     *  description=""
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only seller profiles can access this resource."
     * )
     *
     * )
     *
     */

    ////////novo

    $api->get('dog/litter/count', ['uses' => 'Modules\Dog\Http\Controllers\DogController@getDogLitterCount']);


});

$api->version('v1', ['middleware' => 'api.auth|bynd.api.permission.shelter'], function ($api)
{

    /**
     * @SWG\Post(
     *  path="/dog/rescue",
     *  description="Add new rescue dog to listing",
     *  operationId="postDogRescue",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="breed_id",
     *  in = "query",
     *  description="Id of dog breed.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="Name of rescue dog.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="birth_date",
     *  in = "query",
     *  description="Date when dog was born.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="sex",
     *  in = "query",
     *  description="M or f",
     *  required=true,
     *  type="string",
     *  enum="mf"
     * ),
     *
     * @SWG\Parameter(
     *  name="cost",
     *  in = "query",
     *  description="Price of dog.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="about",
     *  in = "query",
     *  description="Information about dog.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="vaccination",
     * in = "query",
     *  description="Is dog vaccinated.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="vet_checked",
     *  in = "query",
     *  description="Is dog vet checked.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="desexed",
     *  in = "query",
     *  description="Is dog desexed.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="de_warmed",
     *  in = "query",
     *  description="Is dog de-warmed.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="micro_chipped",
     *  in = "query",
     *  description="Is dog micro chipped.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="registration_papers",
     *  in = "query",
     *  description="Does dog have registration papers.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="family_dog",
     *  in = "query",
     *  description="Is rescue dog family dog",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="indoor_dog",
     *  in = "query",
     *  description="Is rescue dog indoor dog",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="energetic",
     *  in = "query",
     *  description="Is rescue dog energetic dog",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="friendly",
     *  in = "query",
     *  description="Is rescue dog friendly dog",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="outdoor_dog",
     *  in = "query",
     *  description="Is rescue dog outdoor dog",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="relaxed",
     *  in = "query",
     *  description="Is rescue dog relaxed dog",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only shelter profiles can access this resource."
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity."
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

    $api->post('dog/rescue', ['middleware' => 'api.throttle', 'limit' => 3, 'expires' => 1, 'uses' => 'Modules\Dog\Http\Controllers\DogController@postDogRescue']);

    /**
     * @SWG\Put(
     *  path="/dog/rescue",
     *  description="Edit whole rescue dog resource",
     *  operationId="putDogRescue",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="id",
     *  in = "query",
     *  description="Id of rescue dog.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="breed_id",
     *  in = "query",
     *  description="Id of dog breed.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="Name of rescue dog.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="birth_date",
     *  in = "query",
     *  description="Date when dog was born.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="sex",
     *  in = "query",
     *  description="M or f",
     *  required=true,
     *  type="string",
     *  enum="mf"
     * ),
     *
     * @SWG\Parameter(
     *  name="cost",
     *  in = "query",
     *  description="Price of dog.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="about",
     *  in = "query",
     *  description="Information about dog.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="vaccination",
     * in = "query",
     *  description="Is dog vaccinated.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="vet_checked",
     *  in = "query",
     *  description="Is dog vet checked.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="desexed",
     *  in = "query",
     *  description="Is dog desexed.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="de_warmed",
     *  in = "query",
     *  description="Is dog de-warmed.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="micro_chipped",
     *  in = "query",
     *  description="Is dog micro chipped.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="registration_papers",
     *  in = "query",
     *  description="Does dog have registration papers.",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="family_dog",
     *  in = "query",
     *  description="Is rescue dog family dog",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="indoor_dog",
     *  in = "query",
     *  description="Is rescue dog indoor dog",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="energetic",
     *  in = "query",
     *  description="Is rescue dog energetic dog",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="friendly",
     *  in = "query",
     *  description="Is rescue dog friendly dog",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="outdoor_dog",
     *  in = "query",
     *  description="Is rescue dog outdoor dog",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="relaxed",
     *  in = "query",
     *  description="Is rescue dog relaxed dog",
     *  required=true,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Response(
     *  response="400",
     *  description="Dog belongs to other shelter."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only shelter profiles can access this resource."
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

    $api->put('dog/rescue', ['uses' => 'Modules\Dog\Http\Controllers\DogController@putDogRescue']);

    /**
     * @SWG\Patch(
     *  path="/dog/rescue",
     *  description="Edit partial rescue dog resource",
     *  operationId="patchDogRescue",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="id",
     *  in = "query",
     *  description="Id of rescue dog.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="breed_id",
     *  in = "query",
     *  description="Id of dog breed.",
     *  required=false,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="name",
     *  in = "query",
     *  description="Name of rescue dog.",
     *  required=false,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="birth_date",
     *  in = "query",
     *  description="Date when dog was born.",
     *  required=false,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="sex",
     *  in = "query",
     *  description="M or f",
     *  required=false,
     *  type="string",
     *  enum="mf"
     * ),
     *
     * @SWG\Parameter(
     *  name="cost",
     *  in = "query",
     *  description="Price of dog.",
     *  required=false,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="about",
     *  in = "query",
     *  description="Information about dog.",
     *  required=false,
     *  type="string"
     * ),
     *
     * @SWG\Parameter(
     *  name="vaccination",
     * in = "query",
     *  description="Is dog vaccinated.",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="vet_checked",
     *  in = "query",
     *  description="Is dog vet checked.",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="desexed",
     *  in = "query",
     *  description="Is dog desexed.",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="de_warmed",
     *  in = "query",
     *  description="Is dog de-warmed.",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="micro_chipped",
     *  in = "query",
     *  description="Is dog micro chipped.",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="registration_papers",
     *  in = "query",
     *  description="Does dog have registration papers.",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="family_dog",
     *  in = "query",
     *  description="Is rescue dog family dog",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="indoor_dog",
     *  in = "query",
     *  description="Is rescue dog indoor dog",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="energetic",
     *  in = "query",
     *  description="Is rescue dog energetic dog",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="friendly",
     *  in = "query",
     *  description="Is rescue dog friendly dog",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="outdoor_dog",
     *  in = "query",
     *  description="Is rescue dog outdoor dog",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Parameter(
     *  name="relaxed",
     *  in = "query",
     *  description="Is rescue dog relaxed dog",
     *  required=false,
     *  type="integer",
     *  enum="10",
     * ),
     *
     * @SWG\Response(
     *  response="400",
     *  description="Dog belongs to other shelter."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only shelter profiles can access this resource."
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

    $api->patch('dog/rescue', ['uses' => 'Modules\Dog\Http\Controllers\DogController@patchDogRescue']);

    /**
     * @SWG\Delete(
     *  path="/dog/rescue",
     *  description="Delete dog rescue.",
     *  operationId="deleteDogRescue",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="id",
     *  in = "query",
     *  description="Id of dog rescue that needs to be deleted.",
     *  required=true,
     *  type="integer"
     * ),
     *
     *
     *
     * @SWG\Response(
     *  response="400",
     *  description="Dog belongs to other shelter."
     * ),
     *
     * @SWG\Response(
     *  response="401",
     *  description="Failed to authenticate because of bad credentials or an invalid authorization header.<br>-----------------------------------------------------------------------<br>Wrong number of segments.<br>-----------------------------------------------------------------------<br>Token Signature could not be verified.<br>-----------------------------------------------------------------------<br>Could not decode token. The token is an invalid JWS.<br>-----------------------------------------------------------------------<br>Token has expired<br>-----------------------------------------------------------------------<br>Only shelter profiles can access this resource."
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

    $api->delete('dog/rescue', ['uses' => 'Modules\Dog\Http\Controllers\DogController@deleteDog']);

    /**
     * @SWG\Post(
     *  path="/dog/rescue/images",
     *  description="Post dog rescue images",
     *  operationId="postDogRescueImages",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="id",
     *  in = "query",
     *  description="Id of dog whose pictures are uploading.",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Parameter(
     *  name="images",
     *  in = "query",
     *  description="Images of the dog.",
     *  required=true,
     *  type="array",
     *  @SWG\Items(type = "string")
     * ),
     *
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
     *
     * )
     *
     */

    $api->post('dog/rescue/images', ['uses' => 'Modules\Dog\Http\Controllers\DogController@postDogRescueImages']);

});

$api->version('v1', function ($api)
{

    $api->get('dog', ['middleware' => 'modifyInput','uses' => 'Modules\Dog\Http\Controllers\DogController@getDog']);

    $api->get('dog/frontpage', ['uses' => 'Modules\Dog\Http\Controllers\DogController@getDogFrontPage']);

    /**
     * @SWG\Get(
     *  path="/dog/with",
     *  description="Returns all dog info and related information",
     *  operationId="getDogWith",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="relations",
     *  in = "query",
     *  description="Names of relations that user wants to get information from. Relations avaliable : owner,mother,father,breed,shelter",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/dogWith")
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
     *
     * )
     *
     */

    $api->get('dog/with', ['uses' => 'Modules\Dog\Http\Controllers\DogController@getDogWith']);

    /**
     * @SWG\Get(
     *  path="/dog/{id}",
     *  description="Returns single dog info",
     *  operationId="getDogId",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="id",
     *  in = "path",
     *  description="Id of dog",
     *  required=true,
     *  type="integer"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/editDog")
     * ),
     *
     *
     * @SWG\Response(
     *  response="404",
     *  description="Dog not found"
     * )
     *
     * )
     *
     */

    $api->get('dog/{id}', ['uses' => 'Modules\Dog\Http\Controllers\DogController@getDogId']);

    /**
     * @SWG\Get(
     *  path="/dog/{id}/with",
     *  description="Returns single dog info and related information",
     *  operationId="getDogIdWith",
     *  tags={"Dog"},
     *
     * @SWG\Parameter(
     *  name="relations",
     *  in = "query",
     *  description="Names of relations that user wants to get information from. Relations avaliable : owner,mother,father,breed,shelter",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/dogWith")
     * ),
     *
     * @SWG\Response(
     *  response="422",
     *  description="Unprocessable entity"
     * )
     *
     * )
     *
     */

    $api->get('dog/{id}/with', ['uses' => 'Modules\Dog\Http\Controllers\DogController@getDogIdWith']);


});