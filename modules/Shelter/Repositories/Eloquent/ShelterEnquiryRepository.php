<?php

namespace Modules\Shelter\Repositories\Eloquent;

use Modules\Foundation\Repositories\Eloquent\FoundationModelRepository;
use Modules\Shelter\Repositories\Contracts\ShelterEnquiryRepositoryInterface;
use Modules\Shelter\Repositories\Entities\ShelterDogEnquiryModel;

class ShelterEnquiryRepository extends FoundationModelRepository implements ShelterEnquiryRepositoryInterface
{
    protected $model;

        public function __construct(ShelterDogEnquiryModel $dogEnquiryModel)
        {
            $this->model = $dogEnquiryModel;
        }

}
