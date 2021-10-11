<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function news() { 
        return $this->belongsTo(News::class, 'news_id');
    }

    //Placement of Ad
    public function getPlacementAttribute($placement) {
        switch($placement){
            case 0:
                return 'Header';
                break;
            case 1:
                return 'Index Page(Full Width)';
                break;
            case 2:
                return 'Sidebar';
                break;
            case 3:
                return 'Category Specific';
                break;
            case 4:
                return 'Index Page(Square)';
                break;
            default: 
                break;
        }
    }
} 
