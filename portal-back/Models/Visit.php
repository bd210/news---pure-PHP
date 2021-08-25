<?php
namespace models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $table = "visits";
    public $timestamps = false;


    public function posts()
    {

        return $this->belongsTo(Post::class, 'post_id', 'id');

    }
}