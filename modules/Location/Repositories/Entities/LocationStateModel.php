<?php

namespace Modules\Location\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class LocationStateModel extends Model
{
    protected $table = 'location_state_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['name','abbreviation'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];


}
