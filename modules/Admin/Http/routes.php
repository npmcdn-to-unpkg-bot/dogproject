<?php

$api = app('Dingo\Api\Routing\Router');


$api->version('v1', function ($api)
{

    $api->get('admin/login', ['uses' => 'Modules\Admin\Http\Controllers\AdminController@getAdminLogin']);

});