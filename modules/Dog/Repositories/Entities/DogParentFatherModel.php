<?php

namespace Modules\Dog\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class DogParentFatherModel extends Model
{
    protected $table = 'dog_parent_father_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['dog_id','father_id'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];

    public function father()
    {
        return $this->belongsTo('Modules\\Dog\\Repositories\\Entities\\DogFatherModel','father_id','id');
    }

}
