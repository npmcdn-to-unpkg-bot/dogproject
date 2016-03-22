<?php

namespace Modules\ShelterComments\Repositories\Eloquent;

use Modules\Foundation\Repositories\Eloquent\FoundationModelRepository;
use Modules\ShelterComments\Repositories\Contracts\ShelterReviewRepositoryInterface;
use Modules\ShelterComments\Repositories\Entities\ShelterReviewModel;

class ShelterReviewRepository extends FoundationModelRepository implements ShelterReviewRepositoryInterface
{
    protected $model;

        public function __construct(ShelterReviewModel $ShelterReviewModel)
        {
            $this->model = $ShelterReviewModel;
        }



}
