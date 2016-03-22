<?php

namespace Modules\Location\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class LocationSuburbModel extends Model
{
    protected $table = 'location_suburb_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['state_id','suburb','postcode'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];


}
