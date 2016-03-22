<?php

namespace Modules\Other\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model
{
    protected $table = 'petagree_enquiry_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['name','email','contact_number','contact_type','enquiry'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];


}
