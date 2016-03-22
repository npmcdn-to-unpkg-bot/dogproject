<?php namespace Modules\Seller\Http\Middleware;

use Modules\Auth\Http\Middleware\Roles\FoundationMiddleware;

class SellerVerifiedMiddleware extends FoundationMiddleware
{

    public function __construct()
    {
        parent::__construct(1 ,"Only verified seller profiles can access this resource.", "verified");
    }

}