<?php
namespace models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = "users";
    public $timestamps = false;

    public function roles()
    {
        return $this->belongsTo(Role::class,'role_id', 'id');
    }

}