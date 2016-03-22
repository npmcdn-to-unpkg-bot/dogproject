<?php

namespace Modules\Shelter\Repositories\Eloquent;

use Modules\Foundation\Repositories\Eloquent\FoundationModelRepository;
use Modules\Shelter\Repositories\Contracts\ShelterKeyMemberRepositoryInterface;
use Modules\Shelter\Repositories\Entities\ShelterKeyMemberModel;

class ShelterKeyMemberRepository extends FoundationModelRepository implements ShelterKeyMemberRepositoryInterface
{
    protected $model;

    public function __construct(ShelterKeyMemberModel $shelterKeyMemberModel)
    {
        $this->model = $shelterKeyMemberModel;
    }

}
