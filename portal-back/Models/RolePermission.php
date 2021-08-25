<?php
namespace models;


use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{

    protected $table = "permission_roles";
    protected $guarded = [];
    public $timestamps = false;

}