<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use App\Models\JanataNews;
use App\Models\News;
use App\Models\NewsGallery;
use App\Models\NewsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;


class FrontEndController extends Controller
{
    // Index page
    public function index(){
        $latest_news = News::where(['status' => 1])->latest()->with('likes')->paginate(4);
        $featured_news = News::where(['status' => 1])->where('is_featured', 1)->latest()->with('likes')->skip(1)->take(4)->get();
        $featured_news_top = News::where(['status' => 1])->where('is_featured', 1)->latest()->with('likes')->take(1)->get();
        return view ('front.index', compact( 'latest_news', 'featured_news', 'featured_news_top'));
    }

    // Category News
    public function categoryNews($slug){
        $category = Category::where('slug', $slug)->first();
        $category_news = News::where('category_id', $category->id)->latest()->with('likes')->paginate(6);
        return view ('front.categoryNews', compact('category', 'category_news'));
    }

    // Write News
    public function writeNews(){
        return view ('front.writeNews');
    }

    // Janata News
    public function janataNews(){
        $janata_news = JanataNews::where(['status' => 1])->latest()->paginate(2);
        return view ('front.janataNews', compact('janata_news'));
    }

    // User Login
    public function userLogin(){
        if(Auth::guard('web')->check()) {
            return redirect()->route('userDashboard');
        } else {
            return view('front.userLogin');

        }
    }

    // User Register
    public function userRegister(){
        return view ('front.userRegister');
    }

    // Videos
    public function videos(){
        $videos = Video::latest()->get();
        return view('front.videos', compact('videos'));
    }

    // Pradesh News
    public function pradeshNews($slug){
        $pradesh = NewsType::where('slug', $slug)->first();
        $pradesh_news = News::where('news_type_id', $pradesh->id)->latest()->with('likes')->paginate(6);
        return view ('front.pradeshNews', compact('pradesh', 'pradesh_news'));
    }

    // Featured News
    public function featuredNews(){
        $featured_news = News::where('status', 1)->where('is_featured', 1)->latest()->with('likes')->paginate(12);
        return view ('front.featuredNews', compact('featured_news'));
    }

    // Single News
    public function newsSingle($slug){
        $news = News::where('slug', $slug)->first();
        $gallery_images = NewsGallery::where('news_id', $news->id)->latest()->get();
        $related_news = News::where('status', 1)->where('category_id', $news->category_id)->where('id', '!=' , $news->id)->latest()->with('likes')->take(8)->get();

        $newsKey = 'news_' .$news->id;
        if(!Session::has($newsKey)){
            $news->increment('view_count');
            Session::put($newsKey, 1);
        }

        return view ('front.newsSingle', compact('news', 'gallery_images', 'related_news'));
    }

    // Single News
    public function newsSingleJanata($slug){
        $news = JanataNews::where('slug', $slug)->first();
        $gallery_images = NewsGallery::where('news_id', $news->id)->latest()->with('likes')->get();
        $related_news = News::where('status', 1)->where('category_id', $news->category_id)->where('id', '!=' , $news->id)->latest()->take(8)->get();


        return view ('front.newsSingle', compact('news', 'gallery_images', 'related_news'));
    }

    //Search news 
    public function search(Request $request) {
            
        $search_news=DB::table('news')->where('news_title','LIKE','%'.$request->title."%")->get();
        return view('front.searchresult', compact('search_news'));
        
    }
}
