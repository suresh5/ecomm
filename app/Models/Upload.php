<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

     protected $fillable = [
        'type',
        'path',
        'uploaded_by',
    ];

     public const TYPES = [
        'cover_image',
        'web_thumbnail',
        'app_thumbnail',
        'video',
        'shorts',
    ];

     /**
     * Get the user who uploaded the asset.
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Optional: Get the post linked to the asset (if you add post_id later).
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Access full URL (assuming you store just relative path).
     */
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }

}
