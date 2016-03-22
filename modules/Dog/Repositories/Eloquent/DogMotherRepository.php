<?php

namespace Modules\Dog\Repositories\Eloquent;

use Modules\Dog\Repositories\Contracts\DogMotherRepositoryInterface;
use Modules\Dog\Repositories\Entities\DogMotherModel;
use Modules\Foundation\Repositories\Eloquent\FoundationModelRepository;

class DogMotherRepository extends FoundationModelRepository implements DogMotherRepositoryInterface
{
    protected $model;

    public function __construct(DogMotherModel $DogModel)
    {
        $this->model = $DogModel;
    }

}
