<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['slug', 'tags'];
    protected $appends = ['image_url'];

    protected function getImageUrlAttribute()
    {
        return $this->cover_image ? asset("storage/$this->cover_image") : "https://placeholder.com/assets/images/150x150-2-500x500.png";
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
