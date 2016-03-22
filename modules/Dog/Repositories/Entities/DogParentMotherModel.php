<?php

namespace Modules\Dog\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class DogParentMotherModel extends Model
{
    protected $table = 'dog_parent_mother_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['dog_id','mother_id'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];

    public function mother()
    {
        return $this->belongsTo('Modules\\Dog\\Repositories\\Entities\\DogMotherModel','mother_id','id');
    }

}
