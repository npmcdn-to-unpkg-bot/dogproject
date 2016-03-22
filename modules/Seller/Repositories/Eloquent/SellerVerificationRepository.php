<?php

namespace Modules\Seller\Repositories\Eloquent;

use Modules\Foundation\Repositories\Eloquent\FoundationModelRepository;
use Modules\Seller\Repositories\Contracts\SellerVerificationRepositoryInterface;
use Modules\Seller\Repositories\Entities\SellerVerificationModel;

class SellerVerificationRepository extends FoundationModelRepository implements SellerVerificationRepositoryInterface
{
    protected $model;

    public function __construct(SellerVerificationModel $SellerModel)
    {
        $this->model = $SellerModel;
    }

}
