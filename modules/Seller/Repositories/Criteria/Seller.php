<?php namespace Modules\Seller\Repositories\Criteria;

use Modules\Foundation\Repositories\Contracts\CriteriaInterface;
//use Bosnadev\Repositories\Contracts\CriteriaInterface;
use Modules\Foundation\Repositories\Eloquent\Criteria;
use Modules\Foundation\Repositories\Contracts\FoundationModelRepositoryInterface as Repository;
//use Modules\Seller\Repositories\Contracts\SellerRepositoryInterface as Repository;
//use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;
//use Bosnadev\Repositories\Contracts\RepositoryInterface;

class Seller extends Criteria  {

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $query = $model->where('type', '=', 'seller');
        return $query;
    }
}