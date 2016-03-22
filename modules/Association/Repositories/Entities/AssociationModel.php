<?php

namespace Modules\Association\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;


class AssociationModel extends Model
{
    protected $table = 'association_entities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['user_id','name','suburb_id','state_id','avatar', 'breed','about','banner_image','slug','website'];

    /**
     * The attributes that are guarded.
     *
     * @var array
     */

    protected $hidden = [];

    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsTo('Modules\\Auth\\Repositories\\Entities\\AuthModel','user_id','id');
    }

    public function members()
    {
        return $this->hasMany('Modules\\Association\\Repositories\\Entities\\AssociationMemberModel','association_id','user_id');
    }

    public function key_members()
    {
        return $this->hasMany('Modules\\Association\\Repositories\\Entities\\AssociationKeyMemberModel','association_id','user_id');
    }

    public function breed()
    {
        return $this->hasOne('Modules\\Foundation\\Repositories\\Entities\\DogBreedModel','id','breed');
    }

    public function suburb()
    {
        return $this->hasOne('Modules\\Location\\Repositories\\Entities\\LocationSuburbModel','id','suburb_id');
    }

    public function state()
    {
        return $this->hasOne('Modules\\Location\\Repositories\\Entities\\LocationStateModel','id','state_id');
    }

}
