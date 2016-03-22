<?php

namespace Modules\Shelter\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;


class ShelterDogEnquiryModel extends Model
{
    protected $table = 'shelter_dog_enquiry_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['shelter_id','dog_id','name','email','contact_number','enquiry','review_token','reviewed'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];

    public function dogs()
    {
        return $this->hasOne('Modules\\Dog\\Repositories\\Entities\\DogModel','id','dog_id');
    }

    public function shelter()
    {
        return $this->belongsTo('Modules\\Shelter\\Repositories\\Entities\\ShelterModel','shelter_id','user_id');
    }



}
