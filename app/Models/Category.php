<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['title','slug','summary','photo','status','is_parent','parent_id','added_by', 'engname',       // ✅ add this
    'ishomepage','position'];

    public function parent_info(){
        return $this->hasOne('App\Models\Category','id','parent_id');
    }
    public static function getAllCategory(){
        return  Category::orderBy('id','DESC')->with('parent_info')->paginate(10);
    }

    public static function shiftChild($cat_id){
        return Category::whereIn('id',$cat_id)->update(['is_parent'=>1]);
    }
    public static function getChildByParentID($id){
        return Category::where('parent_id',$id)->orderBy('id','ASC')->pluck('title','id');
    }

    public function child_cat(){
        return $this->hasMany('App\Models\Category','parent_id','id')->where('status','active');
    }
    public static function getAllParentWithChild(){
        return Category::with('child_cat')->where('is_parent',1)->where('status','active')->orderBy('title','ASC')->get();
    }
    public function products(){
        return $this->hasMany('App\Models\Product','cat_id','id')->where('status','active');
    }
    public function sub_products(){
        return $this->hasMany('App\Models\Product','child_cat_id','id')->where('status','active');
    }
    public static function getProductByCat($slug){
        // dd($slug);
        return Category::with('products')->where('slug',$slug)->first();
        // return Product::where('cat_id',$id)->where('child_cat_id',null)->paginate(10);
    }
    public static function getProductBySubCat($slug){
        // return $slug;
        return Category::with('sub_products')->where('slug',$slug)->first();
    }
    public static function countActiveCategory(){
        $data=Category::where('status','active')->count();
        if($data){
            return $data;
        }
        return 0;
    }

    public function attributes()
{
    return $this->belongsToMany(Attribute::class, 'attribute_category');
}

public function attributeValues()
{
    return $this->belongsToMany(AttributeValue::class);
}

public function posts()
{
    return $this->hasMany(\App\Models\Post::class, 'category_id')
        ->where('content_type', 'post');
}

public function videos()
{
    return $this->hasMany(\App\Models\Post::class, 'category_id')
        ->where('content_type', 'video');
}

public function shorts()
{
    return $this->hasMany(\App\Models\Post::class, 'category_id')
        ->where('content_type', 'short');
}
public function children()
{
    return $this->hasMany(Category::class, 'parent_id');
}
public function allDescendantIds()
{
    return $this->children()->pluck('id')->merge([$this->id]);
}

public function parent()
{
    return $this->belongsTo(Category::class, 'parent_id');
}

}
