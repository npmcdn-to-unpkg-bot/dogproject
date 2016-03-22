<?php

namespace Modules\Association\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;


class AssociationKeyMemberModel extends Model
{
    protected $table = 'association_key_members_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['association_id','type','name', 'email','user_id'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('Modules\\Auth\\Repositories\\Entities\\AuthModel','user_id','id');
    }

    public function association()
    {
        return $this->belongsTo('Modules\\Auth\\Repositories\\Entities\\AuthModel','association_id','id');
    }

}
