<?php namespace Modules\Seller\Http\Middleware;

use Modules\Auth\Http\Middleware\Roles\FoundationMiddleware;

class SellerHobbyMiddleware extends FoundationMiddleware
{

    public function __construct()
    {
        parent::__construct(1 ,"Only hobby seller profiles can access this resource.", "hobby");
    }

}