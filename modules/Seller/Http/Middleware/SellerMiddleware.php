<?php namespace Modules\Seller\Http\Middleware;

use Modules\Auth\Http\Middleware\Roles\FoundationMiddleware;

class SellerMiddleware extends FoundationMiddleware
{

    public function __construct()
    {
        parent::__construct(1 ,"Only seller profiles can access this resource.");
    }

}