<?php

namespace Modules\Seller\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;


class SellerVerificationModel extends Model
{
    protected $table = 'seller_verification_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['seller_id','type','number'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = [];

    public function seller()
    {
        return $this->belongsTo('Modules\\Seller\\Repositories\\Entities\\SellerModel','seller_id','user_id');
    }

}
