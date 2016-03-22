<?php

namespace Modules\Seller\Repositories\Eloquent;

use Modules\Foundation\Repositories\Eloquent\FoundationModelRepository;
use Modules\Seller\Repositories\Contracts\SellerHobbyVerificationRepositoryInterface;
use Modules\Seller\Repositories\Entities\SellerHobbyVerificationModel;

class SellerHobbyVerificationRepository extends FoundationModelRepository implements SellerHobbyVerificationRepositoryInterface
{
    protected $model;

    public function __construct(SellerHobbyVerificationModel $SellerModel)
    {
        $this->model = $SellerModel;
    }

}
