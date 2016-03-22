<?php namespace Modules\Association\Http\Middleware;

use Modules\Auth\Http\Middleware\Roles\FoundationMiddleware;

class AssociationMiddleware extends FoundationMiddleware
{

    public function __construct()
    {
        parent::__construct(2 ,"Only association profiles can access this resource.");
    }

}