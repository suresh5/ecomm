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

    
     public function author(){
        return $this->hasOne('App\User','id','author_id');
    }
    public function author_info(){
        return $this->hasOne('App\User','id','author_id');
    }

      public static function getPostBySlug($slug){
        return Post::with(['tag_info','author_info'])->where('slug',$slug)->where('status','active')->first();
    }

    public function comments(){
        return $this->hasMany(PostComment::class)->whereNull('parent_id')->where('status','active')->with('user_info')->orderBy('id','DESC');
    }
    public function allComments(){
        return $this->hasMany(PostComment::class)->where('status','active');
    }


    // public static function getProductByCat($slug){
    //     // dd($slug);
    //     return Category::with('products')->where('slug',$slug)->first();
    //     // return Product::where('cat_id',$id)->where('child_cat_id',null)->paginate(10);
    // }

    // public static function getBlogByCategory($id){
    //     return Post::where('post_cat_id',$id)->paginate(8);
    // }
    public static function getBlogByTag($slug){
        // dd($slug);
        return Post::where('tags',$slug)->paginate(8);
    }

    public static function countActivePost(){
        $data=Post::where('status','active')->count();
        if($data){
            return $data;
        }
        return 0;
    }

        public function scopeArticles($query)
        {
        return $query->where('content_type', 'article')->where('status', 'published');
        }

        public function scopeVideos($query)
        {
        return $query->where('content_type', 'video')->where('status', 'published');
        }

        public function scopeShorts($query)
        {
        return $query->where('content_type', 'short')->where('status', 'published');
        }

        public function scopeBreaking($query)
        {
        return $query->where('is_featured', 1)->where('status', 'published');
        }
}


