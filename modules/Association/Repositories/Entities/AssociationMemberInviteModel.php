<?php

namespace Modules\Association\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class AssociationMemberInviteModel extends Model
{
    protected $table = 'association_member_invite_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['association_id', 'seller_id', 'member_email','suburb_id','state_id','status','requested','number'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];


}
