<?php
namespace models;


use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{

    protected $table = "post_tags";
    protected $guarded = [];
    public $timestamps = false;

}