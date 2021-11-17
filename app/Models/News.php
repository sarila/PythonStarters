<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class News extends Model
{
    use HasFactory;
    public $user_id;
    // $user_id = Auth::user() ? Auth::user()->user_id : null; 


    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function news_type(){
        return $this->belongsTo(NewsType::class, 'news_type_id');
    }

    public function author(){
        return $this->belongsTo(Admin::class, 'author_id');
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

// Appends
    protected $appends = ['likes'];

    // Accessors
    public function getLikesAttribute()
    {
        $likes = Like::where('news_id',$this->id)->where('like',1)->count();
        $dislikes = Like::where('news_id', $this->id)->where('like',0)->count();
        return [
            'likes' => $likes,
            'dislikes' => $dislikes
        ];
    }
// Helper Function
    public function isLiked($user)
    {

        $user_id = $user ? $user->id : null;
        // dd($user_id);
        if ($user_id != null) {
            $like = Like::where('news_id', $this->id)->where('user_id', $user_id)->first() ? Like::where('news_id', $this->id)->where('user_id', $user_id)->first()->like : 3;
            // var_dump($like);
            return $like;
        }
        else {
            return null;
        }
        // dd($like);


        // return isset($user_id) ? Like::where('news_id',$this->id)->where('user_id',$user_id)->where('like',1)? 1 : Like::where('news_id',$this->id)->where('user_id',$user_id)->where('like',0)? 0 : null : null;
    }
   
}
