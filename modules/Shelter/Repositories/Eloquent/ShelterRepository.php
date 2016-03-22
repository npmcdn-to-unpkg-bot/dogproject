<?php

namespace Modules\Shelter\Repositories\Eloquent;

use Modules\Foundation\Repositories\Eloquent\FoundationModelRepository;
use Modules\Shelter\Repositories\Contracts\ShelterRepositoryInterface;
use Modules\Shelter\Repositories\Entities\ShelterModel;

class ShelterRepository extends FoundationModelRepository implements ShelterRepositoryInterface
{
    protected $model;

        public function __construct(ShelterModel $ShelterModel)
        {
            $this->model = $ShelterModel;
        }


}
