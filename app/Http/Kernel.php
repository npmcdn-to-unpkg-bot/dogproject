<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \Barryvdh\Cors\HandleCors::class
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'bynd.api.auth.refresh' => \Modules\Auth\Http\Middleware\BeyondiRefreshToken::class,
        'beyondi.auth' => \Modules\Auth\Http\Middleware\BeyondiAuth::class,
        'bynd.api.permission.association' => \Modules\Association\Http\Middleware\AssociationMiddleware::class,
        'bynd.api.permission.seller' => \Modules\Seller\Http\Middleware\SellerMiddleware::class,
        'bynd.api.permission.shelter' => \Modules\Shelter\Http\Middleware\ShelterMiddleware::class,
        'bynd.api.permission.seller.verified' => \Modules\Seller\Http\Middleware\SellerVerifiedMiddleware::class,
        'bynd.api.permission.seller.hobby' => \Modules\Seller\Http\Middleware\SellerHobbyMiddleware::class,
        'modifyInput' => \Modules\Dog\Http\Middleware\ModifyInput::class,
    ];
}
