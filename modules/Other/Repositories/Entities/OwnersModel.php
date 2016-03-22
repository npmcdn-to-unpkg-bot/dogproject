<?php

namespace Modules\Other\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class OwnersModel extends Model
{
    protected $table = 'owners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['name','last_name'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];


    public function cars()
    {
        return $this->belongsToMany('Modules\Other\Repositories\Entities\CarsModel','owners_cars','car_id','owner_id');
    }


//    public function cars()
//    {
//        return $this->belongsToMany('Modules\Other\Repositories\Entities\CarsModel','owners_cars','car_id','owner_id');
//    }

}
