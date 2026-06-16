<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'slug',
        'body',
        'excerpt',
        'published',
    ];
    protected $casts = [
        // converts 0 1 to boolean
        'published' => 'boolean',
    ];

    protected static function booted():void{
        // creating and updating works before writing in db before create and update ie Runs before a new post is saved
        static::creating(function (Post $post){
            if (empty($post->slug)){
                $post->slug = Str::slug($post->title);
            }
        });
        static::updating(function (Post $post){
            // isDirty checks if somehting has changed or not. If title changes -> slug changes before updating and saving the title. ie Runs before an existing post in updated
            if ($post->isDirty('title') && !$post->isDirty('slug')){
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function scopePublished(Builder $query)
    {
        // we can do published() by using this. Post::published() shortcut
        return $query->where('published',true);
    }
//$post->url
    public function getUrlAttribute():string{
        return route('posts.show',$this->slug);
    }
// One blog post can have many likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
//  Checks if a specific user already liked this post.
    public function isLikedBy($user):bool{
        if(!$user) return false;
        return $this->likes()->where('user_id',$user->id)->exists();
    }

//  Returns the number of likes as a number.
    public function likeCount(): int
    {
        return $this->likes()->count();
    }
}
