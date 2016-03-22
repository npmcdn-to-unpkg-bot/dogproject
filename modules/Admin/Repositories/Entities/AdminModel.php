<?php namespace Modules\Admin\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;


use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class AdminModel extends Model implements AuthenticatableContract,AuthorizableContract,CanResetPasswordContract
{

    use Authenticatable, Authorizable, CanResetPassword;


    protected $table = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'password','role'];
    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $hidden = ['password'];
    //protected $guarded = ['id'];

    protected $primaryKey   = 'id';

    /**
     *
     * Encrypts password on inserting
     * @param $value
     */

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Checking role for admin, used in frozen node administrator.
     * @param $role
     * @param $id
     * @return bool
     */

    public function hasRole($role,$id)
    {
        if(AdminModel::where('role', $role)->where('id',$id)->exists())
        {
            return true;
        }
        return false;
    }


}