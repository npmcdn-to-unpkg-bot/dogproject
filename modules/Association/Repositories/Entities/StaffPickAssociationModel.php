<?php

namespace Modules\Association\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class StaffPickAssociationModel extends Model
{
    protected $table = 'staff_pick_association_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['association_id'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];

    public function association()
    {
        return $this->hasOne('Modules\\Association\\Repositories\\Entities\\AssociationModel','id','association_id');
    }

}
