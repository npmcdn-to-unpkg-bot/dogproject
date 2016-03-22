<?php namespace Modules\Shelter\Http\Middleware;

use Modules\Auth\Http\Middleware\Roles\FoundationMiddleware;

class ShelterMiddleware extends FoundationMiddleware
{

    public function __construct()
    {
        parent::__construct(3 ,"Only shelter profiles can access this resource.");
    }

}