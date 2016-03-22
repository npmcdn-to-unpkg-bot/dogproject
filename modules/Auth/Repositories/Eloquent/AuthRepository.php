<?php

namespace Modules\Auth\Repositories\Eloquent;

use Modules\Auth\Repositories\Contracts\AuthRepositoryInterface;
use Modules\Auth\Repositories\Entities\AuthModel;
use Modules\Foundation\Repositories\Eloquent\FoundationModelRepository;


class AuthRepository extends FoundationModelRepository implements AuthRepositoryInterface
{
    protected $model;

        public function __construct(AuthModel $AuthModel)
        {
            $this->model = $AuthModel;
        }

    /**
     * Check if user with this mail exists and is active
     *
     * @param $email
     * @return mixed
     */
    public function isActive($email)
    {
        return $this->model->where('email',$email)->where('status','active')->first();
    }

}
