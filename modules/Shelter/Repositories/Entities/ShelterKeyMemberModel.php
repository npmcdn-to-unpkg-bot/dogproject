<?php

namespace Modules\Shelter\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class ShelterKeyMemberModel extends Model
{
    protected $table = 'shelter_key_member_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['shelter_id','type','name','email','user_id'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];

    public function shelter()
    {
        return $this->belongsTo('Modules\\Shelter\\Repositories\\Entities\\ShelterModel','shelter_id','user_id');
    }

    public function users()
    {
        return $this->belongsTo('Modules\\Auth\\Repositories\\Entities\\AuthModel','user_id','id');
    }


}
