<?php

namespace Modules\Association\Repositories\Eloquent;

use Modules\Association\Repositories\Contracts\AssociationRepositoryInterface;
use Modules\Association\Repositories\Entities\AssociationModel;
use Modules\Foundation\Repositories\Eloquent\FoundationModelRepository;

class AssociationRepository extends FoundationModelRepository implements AssociationRepositoryInterface
{
    protected $model;

        public function __construct(AssociationModel $AssociationModel)
        {
            $this->model = $AssociationModel;
        }



}
