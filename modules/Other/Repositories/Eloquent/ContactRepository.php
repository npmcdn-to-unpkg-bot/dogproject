<?php

namespace Modules\Other\Repositories\Eloquent;

use Modules\Foundation\Repositories\Eloquent\FoundationModelRepository;
use Modules\Other\Repositories\Contracts\ContactRepositoryInterface;
use Modules\Other\Repositories\Entities\ContactModel;

class ContactRepository extends FoundationModelRepository implements ContactRepositoryInterface
{
    protected $model;

        public function __construct(ContactModel $ContactModel)
        {
            $this->model = $ContactModel;
        }


}
