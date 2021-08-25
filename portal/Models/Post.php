<?php
namespace models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = "posts";
    protected $guarded = [];


    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


    public function files()
    {
        return $this->belongsToMany(File::class, 'post_files', 'post_id','file_id');
    }



    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }


    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }


    public function approved()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }


    public function edited()
    {
        return $this->belongsTo(User::class, 'edited_by', 'id');
    }


    public function visits()
    {
        return $this->hasMany(Visit::class, 'post_id', 'id');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_likes', 'post_id', 'user_id');
    }
}