<?php

namespace Modules\Foundation\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;


class DogBreedModel extends Model
{
    protected $table = 'dog_breed_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];

}
