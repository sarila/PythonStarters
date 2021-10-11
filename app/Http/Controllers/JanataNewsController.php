<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Like;
use App\Models\JanataNews;
use App\Models\NewsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class JanataNewsController extends Controller
{
    // Janata Index
    public function index(){
        Session::put('admin_page', 'janata');
        return view ('admin.janata.index');
    }

    public function dataTable(){
        $model = JanataNews::latest()->get();
        return DataTables::of($model)
            ->addColumn('action', function ($model){
                return view ('admin.janata._actions', [
                    'model' => $model,
                    'url_show' => route('janata.show', $model->id),
                    'url_edit' => route('janata.edit', $model->id),
                    'url_destroy' => route('janata.destroy', $model->id),

                ]);
            })
            ->editColumn('category_id', function ($model){
                return $model->category->category_name_np;
            })
            ->editColumn('author', function ($model){
                return $model->user->name;
            })
            ->editColumn('status', function ($model){
                return view('admin.janata.span', [
                    'model' => $model
                ]);
            })
            ->editColumn('created_at', function ($model){
                return $model->created_at->diffForHumans();
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);

    }

    public function show($id)
    {
        $model = JanataNews::findOrFail($id);
        return view ('admin.janata.show', compact('model'));
    }

    public function destroy($id){
        $post = JanataNews::findOrFail($id);
        $post->delete();
        $image_path = 'public/uploads/news/janata/';
        $video_path = 'public/uploads/news/janata/videos/';

        if (!empty($post->thumbnail_image)) {
            if (file_exists($image_path . $post->thumbnail_image)) {
                unlink($image_path . $post->thumbnail_image);
            }
        }

        if (!empty($post->video)) {
            if (file_exists($video_path . $post->image)) {
                unlink($video_path . $post->image);
            }
        }

        Session::flash('success_message', 'Janata News has been deleted successfully');
        return redirect()->back();
    }

    // Add News
    public function edit($id){
        Session::put('admin_page', 'janata');
        $post = JanataNews::findOrFail($id);
        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option selected disabled > Select </option>";
        foreach($categories as $cat){
            if($cat->id == $post->category_id){
                $selected = "selected";
            } else {
                $selected = "";
            }
            $categories_dropdown .= "<option value='".$cat->id."' ".$selected."> ".$cat->category_name_np." </option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach($sub_categories as $sub_cat){
                if($sub_cat->id == $post->category_id){
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $categories_dropdown .= "<option value='".$sub_cat->id."' ".$selected.">  &nbsp; &nbsp; --- ".$sub_cat->category_name_np."  </option>";
            }
        }

        $news_types = NewsType::all();
        return view('admin.janata.edit', compact('categories_dropdown', 'news_types', 'post'));
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $news = JanataNews::findOrFail($id);
        $news->news_title = $data['news_title'];
        $news->slug = Str::slug($data['news_title']);
        $news->category_id = $data['category_id'];
        if(!empty($data['news_type_id'])){
            $news->news_type_id = $data['news_type_id'];
        } else {
            $news->news_type_id = 0;
        }
        $news->news_content = $data['news_content'];

        $news->status = $data['status'];

        $slug = Str::slug($data['news_title']);
        $currentDate = rand(1, 999999);
        if ($request->hasFile('thumbnail_image')) {
            $image_tmp = $request->file('thumbnail_image');
            if ($image_tmp->isValid()) {
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = $slug . '-' . $currentDate . '.' . $extension;
                $image_path = 'public/uploads/news/janata/' . $filename;
                // Resize Image Code
                Image::make($image_tmp)->save($image_path);
                // Store image name in products table
                $news->thumbnail_image = $filename;
            }
        }
        if($request->hasFile('video')){
            $video_tmp = $request->file('video');
            if($video_tmp->isValid()){
                $video_name = $video_tmp->getClientOriginalName();
                $extension = $video_tmp->getClientOriginalExtension();
                $videoName = $video_name.'-'.rand().'.'.$extension;
                $video_path = 'public/uploads/news/janata/videos';
                $video_tmp->move($video_path, $videoName);
                $news->video = $videoName;

            }
        }
        $news->save();
        Session::flash('success_message', 'News has been updated successfully');
        return redirect()->back();
    }


    //Like and dislike Janata News

    public function likePost(Request $request)
    {
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = JanataNews::findOrFail($post_id);
        $user = auth()->user() ? auth()->user() : null ;
        if($user == null) {
            return response()->json([
                'user_logedin'=> false
            ]);
        }
        else {
            $like = $user->likes()->where('janata_news_id', $post_id)->first();
            if ($like) {
                $already_liked = $like->like;
                $update = true;
                if ($already_liked == $is_like) {
                    $like->delete();
                    return response()->json($post->likes);
                }
            }
            else {
                $like = new Like();
            }
            $like->like = $is_like;
            $like->user_id = $user->id;
            $like->janata_news_id = $post->id;
            if($update) {
                $like->update();
            }
            else {
                $like->save();
            }
            return response()->json($post->likes);
        }
    }
}
