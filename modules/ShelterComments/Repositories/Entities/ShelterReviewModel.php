<?php

namespace Modules\ShelterComments\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class ShelterReviewModel extends Model
{
    protected $table = 'shelter_review_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['shelter_id','rating1','rating2','rating3','rating4','rating5','name','suburb_id','state_id','about','contact_number','approved'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];

    public function suburb()
    {
        return $this->hasOne('Modules\\Location\\Repositories\\Entities\\LocationSuburbModel','id','suburb_id');
    }

    public function state()
    {
        return $this->hasOne('Modules\\Location\\Repositories\\Entities\\LocationStateModel','id','state_id');
    }

    public function shelter()
    {
        return $this->belongsTo('Modules\\Shelter\\Repositories\\Entities\\ShelterModel','shelter_id','user_id');
    }

}
