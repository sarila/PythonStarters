<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use App\Models\Category;
use App\Models\News;
use App\Models\Like;
use App\Models\NewsGallery;
use App\Models\NewsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Image;
use DataTables;

class PostController extends Controller
{
    // Index Page
    public function index(){
        Session::put('admin_page', 'post');
        return view('admin.post.index');
    }

    // Index Page
    public function featured(){
        Session::put('admin_page', 'featured');
        return view('admin.post.featured');
    }

    // Add News
    public function add(){
        Session::put('admin_page', 'add_post');

        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option selected disabled > Select Category </option>";
        foreach($categories as $cat){
            $categories_dropdown .= "<option value='".$cat->id."'> ".$cat->category_name_np." </option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach($sub_categories as $sub_cat){
                $categories_dropdown .= "<option value='".$sub_cat->id."'>  &nbsp; &nbsp;  ".$sub_cat->category_name_np."  </option>";
            }
        }
        $news_types = NewsType::all();
        return view('admin.post.add', compact('categories_dropdown', 'news_types'));
    }

    // Store
    public function store(Request $request){
        $data = $request->all();
        $rule = [
            'news_title' => 'required',
            'category_id' => 'required',
            'news_content' => 'required',
            'status' => 'required',
        ];
        $customMessages = [
            'post_title.required'  => 'Please enter the news title',
            'category_id.required'  => 'Please Select Category',
            'news_content.required'  => 'Please enter news content',
            'status.required'  => 'Please Select Status',
        ];
        $this->validate($request, $rule, $customMessages);
        $news = new News();
        $news->news_title = $data['news_title'];
        $news->slug = Str::slug($data['news_title']);
        $news->category_id = $data['category_id'];
        if(!empty($data['news_type_id'])){
            $news->news_type_id = $data['news_type_id'];
        } else {
            $news->news_type_id = 0;
        }
        $news->news_content = $data['news_content'];

        $slug = Str::slug($data['news_title']);
        $currentDate = rand(1, 999999);
        if ($request->hasFile('thumbnail_image')) {
            $image_tmp = $request->file('thumbnail_image');
            if ($image_tmp->isValid()) {
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = $slug . '-' . $currentDate . '.' . $extension;
                $image_path = 'public/uploads/news/' . $filename;
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
                $video_path = 'public/uploads/news/videos/';
                $video_tmp->move($video_path, $videoName);
                $news->video = $videoName;

            }
        }

        $news->author_id = Auth::guard('admin')->user()->id;

        if($data['status'] == 1){
            $news->status = 1;
        } else {
            $news->status = 0;
        }

        if($data['status'] == 1){
            $news->is_featured = 1;
        } else {
            $news->is_featured = 0;
        }
        $news->seo_title = $data['seo_title'];
        $news->seo_subtitle = $data['seo_subtitle'];
        $news->description = $data['description'];
        $news->keywords = $data['keywords'];
        $news->save();
        Session::flash('success_message', 'News has been added successfully');
        return redirect()->route('post.index');
    }

    public function dataTable(){
        $model = News::latest()->get();
        return DataTables::of($model)
            ->addColumn('action', function ($model){
                return view ('admin.post._actions', [
                    'model' => $model,
                    'url_show' => route('post.show', $model->id),
                    'url_edit' => route('post.edit', $model->id),
                    'url_destroy' => route('post.destroy', $model->id),
                    'url_gallery' => route('newsGallery', $model->id),
                ]);
            })
            ->editColumn('category_id', function ($model){
                return $model->category->category_name_np;
            })
            ->editColumn('author', function ($model){
                return $model->author->name;
            })
            ->editColumn('status', function ($model){
                if($model->status == 1){
                    return "Published";
                } else {
                    return "Draft";
                }
            })
            ->editColumn('created_at', function ($model){
                return $model->created_at->diffForHumans();
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);

    }


    public function featuredPost(){
        $model = News::where('is_featured', 1)->latest()->get();
        return DataTables::of($model)
            ->addColumn('action', function ($model){
                return view ('admin.post._actions', [
                    'model' => $model,
                    'url_show' => route('post.show', $model->id),
                    'url_edit' => route('post.edit', $model->id),
                    'url_destroy' => route('post.destroy', $model->id),
                    'url_gallery' => route('newsGallery', $model->id),
                ]);
            })
            ->editColumn('category_id', function ($model){
                return $model->category->category_name_np;
            })
            ->editColumn('author', function ($model){
                return $model->author->name;
            })
            ->editColumn('status', function ($model){
                if($model->status == 1){
                    return "Published";
                } else {
                    return "Draft";
                }
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
        $model = News::findOrFail($id);
        $news->incrementReadCount();
        return view ('admin.post.show', compact('model'));
    }

    // Add News
    public function edit($id){
        Session::put('admin_page', 'post');
        $post = News::findOrFail($id);
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
        return view('admin.post.edit', compact('categories_dropdown', 'news_types', 'post'));
    }

    // Update
    public function update(Request $request, $id){
        $data = $request->all();
        $rule = [
            'news_title' => 'required',
            'category_id' => 'required',
            'news_content' => 'required',
            'status' => 'required',
        ];

        $customMessages = [
            'post_title.required'  => 'Please enter the news title',
            'category_id.required'  => 'Please Select Category',
            'news_content.required'  => 'Please enter news content',
            'status.required'  => 'Please Select Status',
        ];
        $this->validate($request, $rule, $customMessages);
        $news = News::findOrFail($id);
        $news->news_title = $data['news_title'];
        $news->slug = Str::slug($data['news_title']);
        $news->category_id = $data['category_id'];

        if(!empty($data['news_type_id'])){
            $news->news_type_id = $data['news_type_id'];
        } else {
            $news->news_type_id = 0;
        }


        $news->news_content = $data['news_content'];

        $slug = Str::slug($data['news_title']);
        $currentDate = rand(1, 999999);
        if ($request->hasFile('thumbnail_image')) {
            $image_tmp = $request->file('thumbnail_image');
            if ($image_tmp->isValid()) {
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = $slug . '-' . $currentDate . '.' . $extension;
                $image_path = 'public/uploads/news/' . $filename;
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
                $video_path = 'public/uploads/news/videos/';
                $video_tmp->move($video_path, $videoName);
                $news->video = $videoName;

            }
        }

        $news->author_id = Auth::guard('admin')->user()->id;

        if($data['status'] == 1){
            $news->status = 1;
        } else {
            $news->status = 0;
        }

        if(!empty($data['is_featured'])) {
            if ($data['is_featured'] == "on") {
                $news->is_featured = 1;
            } else {
                $news->is_featured = 0;
            }
        } else {
            $news->is_featured = 0;
        }

        $news->seo_title = $data['seo_title'];
        $news->seo_subtitle = $data['seo_subtitle'];
        $news->description = $data['description'];
        $news->keywords = $data['keywords'];
        $news->save();



        Session::flash('success_message', 'News has been updated successfully');
        return redirect()->back();
    }

    public function destroy($id){
            $post = News::findOrFail($id);
            $post->delete();
            $image_path = 'public/uploads/news/';
            $video_path = 'public/uploads/news/videos/';

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

            Session::flash('success_message', 'News has been deleted successfully');
            return redirect()->back();
        }

        public function deleteNewsImage($id){
             $newsImage = News::findOrFail($id);
             $image_path = 'public/uploads/news/';
             if(file_exists($image_path.$newsImage->thumbnail_image)){
                 unlink($image_path.$newsImage->thumbnail_image);
             }
             News::where('id', $id)->update(['thumbnail_image' => NULL ]);
            Session::flash('success_message', 'News Image has been deleted successfully');
            return redirect()->back();
        }


        // Images Gallery
    public function newsGallery($id){
        $news = News::findOrFail($id);
        $images = NewsGallery::where('news_id', $id)->latest()->get();
        return view ('admin.post.gallery', compact('images', 'news'));
    }
    public function newsStoreGallery(Request $request, $id)
    {
        $news = News::findOrFail($id);
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('uploads/news/gallery/'),$imageName);
        $imageUpload = new NewsGallery();
        $imageUpload->image = $imageName;
        $imageUpload->news_id = $id;
        $imageUpload->save();
        Session::flash('success_message', 'News Gallery has been added successfully');
        return redirect()->back();
    //       return response()->json(['success'=>$imageName]);
    }

    public function deleteImage(Request $request)
    {
        $filename =  $request->get('filename');
        NewsGallery::where('image',$filename)->delete();
        $path=public_path().'/uploads/news/gallery/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    public function deleteImageIndividual($id){
        $image = NewsGallery::findOrFail($id);
        $image->delete();
        $image_path = 'public/uploads/news/gallery/';
        if(!empty($image->image)){
            if(file_exists($image_path.$image->image)){
                unlink($image_path.$image->image);
            }
        }
        Session::flash('success_message', 'Image has been Deleted successfully');
        return redirect()->back();
    }

    //Like and dislike News

    public function likePost(Request $request)
    {
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = News::findOrFail($post_id);
        $user = auth()->user() ? auth()->user() : null ;
        if($user == null) {
            return response()->json([
                'user_logedin'=> false
            ]);
        }
        else {
            $like = $user->likes()->where('news_id', $post_id)->first();
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
            $like->news_id = $post->id;
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
