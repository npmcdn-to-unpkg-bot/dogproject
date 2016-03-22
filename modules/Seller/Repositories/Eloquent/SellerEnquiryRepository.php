<?php

namespace Modules\Seller\Repositories\Eloquent;

use Modules\Foundation\Repositories\Eloquent\FoundationModelRepository;
use Modules\Seller\Repositories\Contracts\SellerEnquiryRepositoryInterface;
use Modules\Seller\Repositories\Entities\SellerEnquiryModel;

class SellerEnquiryRepository extends FoundationModelRepository implements SellerEnquiryRepositoryInterface
{
    protected $model;

    public function __construct(SellerEnquiryModel $SellerModel)
    {
        $this->model = $SellerModel;
    }
}
