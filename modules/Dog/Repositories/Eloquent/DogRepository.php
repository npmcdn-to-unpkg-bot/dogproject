<?php

namespace Modules\Dog\Repositories\Eloquent;

use Modules\Dog\Repositories\Contracts\DogRepositoryInterface;
use Modules\Dog\Repositories\Entities\DogModel;
use Modules\Foundation\Repositories\Eloquent\FoundationModelRepository;

class DogRepository extends FoundationModelRepository implements DogRepositoryInterface
{
    protected $model;

        public function __construct(DogModel $DogModel)
        {
            $this->model = $DogModel;
        }

    //TODO

//    public function filterDogs(array $parameters)
//    {
//        $query = $this->model;
//        foreach ($relations as $value)
//        {
//            $query = $query->with($value);
//        }
//        $query = $query->where($where);
//        return $query->get();
//    }

}
