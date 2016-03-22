<?php

namespace Modules\Association\Repositories\Eloquent;

use Modules\Association\Repositories\Contracts\AssociationInviteRepositoryInterface;
use Modules\Association\Repositories\Entities\AssociationMemberInviteModel;
use Modules\Foundation\Repositories\Eloquent\FoundationModelRepository;

class AssociationInviteRepository extends FoundationModelRepository implements AssociationInviteRepositoryInterface
{
    protected $model;

    public function __construct(AssociationMemberInviteModel $associationMemberInviteModel)
    {
        $this->model = $associationMemberInviteModel;
    }

}
