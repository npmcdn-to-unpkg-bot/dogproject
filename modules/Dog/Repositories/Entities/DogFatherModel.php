<?php

namespace Modules\Dog\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DogFatherModel extends Model
{
    use SoftDeletes;

    protected $table = 'dog_father_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['name', 'breed_id', 'birth_date', 'image', 'temperament', 'energy', 'intelligence', 'maintenance', 'seller_id', 'profile_uri'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    public function breed()
    {
        return $this->hasOne('Modules\\Foundation\\Repositories\\Entities\\DogBreedModel','id','breed_id');
    }

}
