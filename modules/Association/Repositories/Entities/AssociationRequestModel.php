<?php

namespace Modules\Association\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;


class AssociationRequestModel extends Model
{
    protected $table = 'association_request_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['name','first_name','last_name','email','contact_number','website','suburb_id','state_id','status'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];

}
