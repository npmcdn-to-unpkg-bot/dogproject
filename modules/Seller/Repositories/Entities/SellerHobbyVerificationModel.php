<?php

namespace Modules\Seller\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;


class SellerHobbyVerificationModel extends Model
{
    protected $table = 'seller_hobby_verification_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['seller_id','question1','question2','question3','question4','question5','question6','question7','question8','question9','question10'];

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
