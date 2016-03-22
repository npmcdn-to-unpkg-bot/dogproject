<?php

namespace Modules\Association\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class AssociationMemberModel extends Model
{
    protected $table = 'association_member_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['seller_id','association_id'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasMany('Modules\\Auth\\Repositories\\Entities\\AuthModel','id','seller_id');
    }

    public function association()
    {
        return $this->hasMany('Modules\\Association\\Repositories\\Entities\\AssociationModel','user_id','association_id');
    }

    public function userDashboard()
    {
        return $this->hasOne('Modules\\Auth\\Repositories\\Entities\\AuthModel','id','seller_id');
    }

    public function associationDashboard()
    {
        return $this->hasOne('Modules\\Association\\Repositories\\Entities\\AssociationModel','user_id','association_id');
    }


}
