<?php
namespace Modules\Auth\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class PasswordResetModel extends Model
{
    protected $table = 'password_resets';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = ['first_name','last_name','password','email','contact_number','role','status','is_active','remember_token'];
    /**
     * The attributes that are guarded.
     *
     * @var array
     */


    protected $guarded = ['id'];


}
