<?php

namespace Modules\Shelter\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;


class ShelterEnquiryModel extends Model
{
    protected $table = 'shelter_enquiry_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['name','email','enquiry'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];

}
