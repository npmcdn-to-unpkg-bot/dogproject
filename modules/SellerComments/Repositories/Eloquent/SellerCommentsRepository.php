<?php

namespace Modules\SellerComments\Repositories\Eloquent;

use Modules\Foundation\Repositories\Eloquent\FoundationModelRepository;
use Modules\SellerComments\Repositories\Contracts\SellerCommentsRepositoryInterface;
use Modules\SellerComments\Repositories\Entities\SellerCommentsModel;

class SellerCommentsRepository extends FoundationModelRepository implements SellerCommentsRepositoryInterface
{
    protected $model;

        public function __construct(SellerCommentsModel $SellerCommentsModel)
        {
            $this->model = $SellerCommentsModel;
        }


}
