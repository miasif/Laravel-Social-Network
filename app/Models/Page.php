<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FollowerPage;
use App\Models\User;
use App\Models\Post;

class Page extends Model
{
    use HasFactory;

    // public function following()
    // {
    //     return $this->belongsToMany(User::class, 'follower_pages', 'page_id','user_id');
    // }
    // public function posts()
    // {
    //     return $this->belongsToMany(Post::class, 'page_posts', 'page_id', 'post_id');
    // }
   
}
