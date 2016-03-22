<?php namespace Modules\Foundation\Repositories\Eloquent;

use Modules\Foundation\Repositories\Contracts\FoundationModelRepositoryInterface as Repository;
use Modules\Foundation\Repositories\Contracts\FoundationModelRepositoryInterface;

abstract class Criteria {

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public abstract function apply($model, Repository $repository);
}