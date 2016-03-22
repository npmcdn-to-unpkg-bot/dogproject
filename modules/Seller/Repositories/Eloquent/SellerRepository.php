<?php

namespace Modules\Seller\Repositories\Eloquent;


use Modules\Foundation\Repositories\Eloquent\FoundationModelRepository;
use Modules\Seller\Repositories\Contracts\SellerRepositoryInterface;
use Modules\Seller\Repositories\Entities\SellerModel;

class SellerRepository extends FoundationModelRepository implements  SellerRepositoryInterface
{
    protected $model;

        public function __construct(SellerModel $SellerModel)
        {
            $this->model = $SellerModel;
        }

}
