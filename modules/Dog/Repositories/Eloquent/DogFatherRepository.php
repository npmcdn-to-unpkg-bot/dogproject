<?php

namespace Modules\Dog\Repositories\Eloquent;

use Modules\Dog\Repositories\Contracts\DogFatherRepositoryInterface;
use Modules\Dog\Repositories\Entities\DogFatherModel;
use Modules\Foundation\Repositories\Eloquent\FoundationModelRepository;

class DogFatherRepository extends FoundationModelRepository implements DogFatherRepositoryInterface
{
    protected $model;

    public function __construct(DogFatherModel $DogModel)
    {
        $this->model = $DogModel;
    }
}
