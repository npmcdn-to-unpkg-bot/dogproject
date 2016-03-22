<?php

namespace Modules\Association\Repositories\Eloquent;

use Modules\Association\Repositories\Contracts\AssociationKeyMemberRepositoryInterface;
use Modules\Association\Repositories\Entities\AssociationKeyMemberModel;
use Modules\Foundation\Repositories\Eloquent\FoundationModelRepository;

class AssociationKeyMemberRepository extends FoundationModelRepository implements AssociationKeyMemberRepositoryInterface
{
    protected $model;

    public function __construct(AssociationKeyMemberModel $associationKeyMemberModel)
    {
        $this->model = $associationKeyMemberModel;
    }

}
