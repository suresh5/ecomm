<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'cat_id',
        'content_type',
        'article_type',
        'thumbnail',
        'cover_image',
        'detail_image',
        'app_thumbnail',
        'video_url',
        'image_url',
        'is_featured',
        'is_trending',
        'status'
    ];
   
     public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

     // Many-to-Many Relationship with tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }


      public static function getAllPost(){
        return Post::with(['cat_info','author_info'])->orderBy('id','DESC')->paginate(10);
    }

    public function cat_info(){
        return $this->hasOne('App\Models\Category','id','category_id');
    }

    
    public function author_info(){
        return $this->hasOne('App\User','id','author_id');
    }
}


