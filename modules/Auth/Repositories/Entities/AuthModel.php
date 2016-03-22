<?php

namespace Modules\Auth\Repositories\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


/**
 * Class AuthModel
 * @ORM\Entity(repositoryClass="Modules\Auth\Repositories\Entities")
 * @ORM\Table(name="users")
 * * @SWG\Definition(
 * definition="User",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="first_name", type="string"),
 * @SWG\Property(property="last_name", type="string"),
 * @SWG\Property(property="password", type="string"),
 * @SWG\Property(property="email", type="string"),
 * @SWG\Property(property="contact_number", type="string"),
 * )
 */
class AuthModel extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    protected $table = 'user_account_entities';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','last_name','password','email','contact_number','role','status','remember_token'];
    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = ['password', 'remember_token','status'];

    protected $guarded = ['id'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function seller()
    {
        return $this->hasOne('Modules\\Seller\\Repositories\\Entities\\SellerModel','user_id','id');
    }

    public function association()
    {
        return $this->hasMany('Modules\\Association\\Repositories\\Entities\\AssociationMemberModel','seller_id','id');
    }
}
