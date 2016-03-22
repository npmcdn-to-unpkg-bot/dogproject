<?php

namespace Modules\Foundation\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;


class SuburbStateModel extends Model
{
    protected $table = 'suburbs_state';

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
