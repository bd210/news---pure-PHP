<?php
namespace models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $table = "roles";
    protected $guarded = [];
    public $timestamps = false;

    public function users()
    {

        return $this->hasMany(User::class, 'role_id', 'id');

    }


    public function permissions()
    {

        return $this->belongsToMany(Permission::class, 'permission_roles', 'role_id', 'permission_id');

    }
}