<?php

namespace Modules\Shelter\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class ShelterModel extends Model
{
    protected $table = 'shelter_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['user_id','name','web_address','address','suburb_id','state_id','facebook','twitter','instagram','about','avatar','advert_photo','slug','newsletter','terms'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];

    public function key_members()
    {
        return $this->hasMany('Modules\\Shelter\\Repositories\\Entities\\ShelterKeyMemberModel','shelter_id','user_id');
    }

    public function suburb()
    {
        return $this->hasOne('Modules\\Location\\Repositories\\Entities\\LocationSuburbModel','id','suburb_id');
    }

    public function state()
    {
        return $this->hasOne('Modules\\Location\\Repositories\\Entities\\LocationStateModel','id','state_id');
    }

    public function user()
    {
        return $this->belongsTo('Modules\\Auth\\Repositories\\Entities\\AuthModel','user_id','id');
    }

    public function review()
    {
        return $this->hasMany('Modules\\ShelterComments\\Repositories\\Entities\\ShelterReviewModel','shelter_id','user_id');
    }

    public function dogs()
    {
        return $this->hasMany('Modules\\Dog\\Repositories\\Entities\\DogModel','seller_id','user_id');
    }

    public function shelter_enquiry()
    {
        return $this->hasMany('Modules\\Shelter\\Repositories\\Entities\\ShelterDogEnquiryModel','shelter_id','user_id');
    }

}
