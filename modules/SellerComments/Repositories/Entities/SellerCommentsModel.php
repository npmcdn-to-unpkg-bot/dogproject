<?php

namespace Modules\SellerComments\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class SellerCommentsModel extends Model
{
    protected $table = 'seller_review_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['user_id','rating1','rating2','rating3','rating4','rating5','name','suburb_id','state_id','about','contact_number','approved'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = ['approved'];

    protected $guarded = ['id'];

    public function suburb()
    {
        return $this->hasOne('Modules\\Location\\Repositories\\Entities\\LocationSuburbModel','id','suburb_id');
    }

    public function state()
    {
        return $this->hasOne('Modules\\Location\\Repositories\\Entities\\LocationStateModel','id','state_id');
    }

    public function seller()
    {
        return $this->belongsTo('Modules\\Seller\\Repositories\\Entities\\SellerModel','user_id','user_id');
    }

}
