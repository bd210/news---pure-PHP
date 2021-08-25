<?php
namespace models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table = "comments";
    public $timestamps = false;


    public function posts()
    {

        return $this->belongsTo(Post::class, 'post_id', 'id');

    }


    public function users()
    {

        return $this->belongsTo(User::class, 'approved_comm', 'id');

    }


}