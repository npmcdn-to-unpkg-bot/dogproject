<?php

namespace Modules\Association\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;


class AssociationEnquiryModel extends Model
{
    protected $table = 'association_enquiry_entities';

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
