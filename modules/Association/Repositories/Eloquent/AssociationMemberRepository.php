<?php

namespace Modules\Association\Repositories\Eloquent;

use Modules\Association\Repositories\Contracts\AssociationMemberRepositoryInterface;
use Modules\Association\Repositories\Entities\AssociationMemberModel;
use Modules\Foundation\Repositories\Eloquent\FoundationModelRepository;

class AssociationMemberRepository extends FoundationModelRepository implements AssociationMemberRepositoryInterface
{

    protected $model;

    public function __construct(AssociationMemberModel $associationMemberModel)
    {
        $this->model = $associationMemberModel;
    }

}
