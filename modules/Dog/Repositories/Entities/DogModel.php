<?php

namespace Modules\Dog\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class DogModel extends Model
{
    protected $table = 'dog_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['breed_id','state_id','suburb_id','birth_date','type_of_listing', 'sex', 'male_qty', 'female_qty', 'cost','about','name','vaccination','vet_checked','desexed','de_warmed','micro_chipped','registration_papers','family_dog','indoor_dog','energetic','friendly','outdoor_dog','relaxed','seller_id','listing_status','sold','mother_id','father_id','slug'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];

    public function owner()
    {
        return $this->belongsTo('Modules\\Seller\\Repositories\\Entities\\SellerModel','seller_id','user_id');
    }

    public function shelter()
    {
        return $this->belongsTo('Modules\\Shelter\\Repositories\\Entities\\ShelterModel','seller_id','user_id');
    }

    public function mother()
    {
        return $this->hasOne('Modules\\Dog\\Repositories\\Entities\\DogMotherModel','id','mother_id');
    }

    public function father()
    {
        return $this->hasOne('Modules\\Dog\\Repositories\\Entities\\DogFatherModel','id','father_id');
    }

    public function breed()
    {
        return $this->hasOne('Modules\\Foundation\\Repositories\\Entities\\DogBreedModel','id','breed_id');
    }
}
