<?php

namespace Modules\Seller\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class SellerModel extends Model
{
    protected $table = 'seller_account_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['type','suburb_id','state_id','address','photo','language','find_out','about','newsletter','terms','smartphone','verified','suspicious','user_id','slug'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = ['suspicious'];

    protected $guarded = ['id','user_id'];

    public function users()
    {
        return $this->belongsTo('Modules\\Auth\\Repositories\\Entities\\AuthModel','user_id','id');
    }

    public function review()
    {
        return $this->hasMany('Modules\\SellerComments\\Repositories\\Entities\\SellerCommentsModel','user_id','user_id');
    }

    public function dogs()
    {
        return $this->hasMany('Modules\\Dog\\Repositories\\Entities\\DogModel','seller_id','user_id');
    }

    public function seller_enquiry()
    {
        return $this->hasMany('Modules\\Seller\\Repositories\\Entities\\SellerEnquiryModel','seller_id','user_id');
    }

    public function suburb()
    {
        return $this->hasOne('Modules\\Location\\Repositories\\Entities\\LocationSuburbModel','id','suburb_id');
    }

    public function state()
    {
        return $this->hasOne('Modules\\Location\\Repositories\\Entities\\LocationStateModel','id','state_id');
    }

    public function verification()
    {
        return $this->hasOne('Modules\\Seller\\Repositories\\Entities\\SellerVerificationModel','seller_id','user_id');
    }

    public function verification_hobby()
    {
        return $this->hasOne('Modules\\Seller\\Repositories\\Entities\\SellerHobbyVerificationModel','seller_id','user_id');
    }

}
