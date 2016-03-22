<?php

namespace Modules\Other\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class CarsModel extends Model
{
    protected $table = 'cars';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['brand','owner_id'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];

    public function owners()
    {
        return $this->belongsToMany('Modules\Other\Repositories\Entities\OwnersModel','owners_cars','car_id','owner_id');
    }


}
