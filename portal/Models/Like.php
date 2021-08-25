<?php
namespace models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    protected $table = "post_likes";
    protected $guarded = [];
    public $timestamps = false;

}