<?php

namespace Modules\Seller\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class SellerEnquiryModel extends Model
{
    protected $table = 'seller_enquiry_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['seller_id','dog_id','name','email','contact_number','enquiry','review_token','reviewed'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = ['reviewed'];

    protected $guarded = ['id'];

    public function dogs()
    {
        return $this->hasOne('Modules\\Dog\\Repositories\\Entities\\DogModel','id','dog_id');
    }

    public function seller()
    {
        return $this->belongsTo('Modules\\Seller\\Repositories\\Entities\\SellerModel','seller_id','user_id');
    }


}
