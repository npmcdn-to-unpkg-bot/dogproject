<?php

namespace Modules\Dog\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class StaffPickDogModel extends Model
{
    protected $table = 'staff_pick_dog_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['dog_id'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];

    public function dog()
    {
        return $this->hasOne('Modules\\Dog\\Repositories\\Entities\\DogModel','id','dog_id');
    }

}
