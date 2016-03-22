<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api)
{

    /**
     * @SWG\Get(
     *  path="/state",
     *  description="Returns all states",
     *  operationId="getState",
     *  tags={"Location"},
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/locationState")
     * )
     *
     * )
     *
     */

    $api->get('state', ['uses' => 'Modules\Location\Http\Controllers\LocationController@getState']);

    /**
     * @SWG\Get(
     *  path="/suburb",
     *  description="Returns all suburbs",
     *  operationId="getSuburb",
     *  tags={"Location"},
     *
     * @SWG\Parameter(
     *  name="state_id",
     *  in = "query",
     *  description="Id of state where suburb is.",
     *  required=true,
     *  type="string"
     * ),
     *
     * @SWG\Response(
     *  response="200",
     *  description="",
     *  @SWG\Schema(ref="#/definitions/locationSuburb")
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

    $api->get('suburb', ['uses' => 'Modules\Location\Http\Controllers\LocationController@getSuburb']);





});