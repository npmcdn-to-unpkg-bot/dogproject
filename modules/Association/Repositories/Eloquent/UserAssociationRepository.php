<?php

namespace Modules\Association\Repositories\Eloquent;

use Modules\Association\Repositories\Contracts\UserAssociationRepositoryInterface;
use Modules\Association\Repositories\Entities\AssociationMemberModel;
use Modules\Foundation\Repositories\Eloquent\FoundationModelRepository;

class UserAssociationRepository extends FoundationModelRepository implements  UserAssociationRepositoryInterface
{
    protected $model;

    public function __construct(AssociationMemberModel $associationMemberModel)
    {
        $this->model = $associationMemberModel;
    }
}
