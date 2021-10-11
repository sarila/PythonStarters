<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\JanataNews;
use App\Models\JanataNewsGallery;
use App\Models\NewsGallery;
use App\Models\NewsType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class UserController extends Controller
{
    // Register User
    public function registerUser(Request $request){
        $data = $request->all();
        $validateData = $request->validate([
            'name' => 'required|max:255|min:6',
            'password' => 'required|min:6',
            'confirm_password' => 'required_with:password|same:password|min:6'
        ]);
        // Check User Email
        $userCount = User::where('email', $data['email'])->count();
        if($userCount > 0){
            return redirect()->back()->with('error_message', 'Email Already Exists in Our Database');
        }
        $user = new User();
        $user->name = ucwords(strtolower($data['name']));
        $user->email = strtolower($data['email']);
        $user->password = bcrypt($data['password']);
        $user->save();

        $messageData = [
            'email' => strtolower($data['email']),
            'name' => ucwords(strtolower($data['name'])),
            'code' => base64_encode($data['email'])
        ];
        $email = strtolower($data['email']);
        Mail::send('emails.verify', $messageData, function($message) use ($email){
            $message->to($email)->subject('E-Mail Verification Message');
        });

        return redirect()->back()->with('success_message', 'An Email Verification link has been sent to your email. Please verify your email address to login');
    }

    public function userDashboard(){
        $user = Auth::guard('web')->user();
        $published_news = JanataNews::where('user_id', $user->id)->where('status', 1)->latest()->take(5)->get();
        return view ('front.userDashboard', compact('user', 'published_news'));
    }
    public function login_user(Request $request){
        $data = $request->all();
        if(Auth::attempt(['email' => $data['email'],'password' => 'password', 'verified' => 1])){
            Session::put('frontSession', $data['email']);
            return redirect()->route('userDashboard');
        }else {
            return redirect()->back()->with('error_message', 'Invalid Username or Password');
        }
    }

    public function userLogout(){
        Auth::logout();
        Session::forget('frontSession');
        return redirect('/user/login');
    }

    public function userProfile(){
        $user = Auth::guard('web')->user();
        return view ('front.userProfile', compact('user'));
    }

    public function userProfileEdit(){
        $user = Auth::guard('web')->user();
        return view ('front.userProfileEdit', compact('user'));
    }

    public function userProfileUpdate(Request $request, $id){
        $data = $request->all();
        $user = User::findOrFail($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->address = $data['address'];
        $user->phone = $data['phone'];

        $currentDate = Carbon::now()->toTimeString();

        $random = Str::random(10);
        if($request->hasFile('image')){
            $image_tmp = $request->file('image');
            if($image_tmp->isValid()){
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = $random . '.' . $extension;
                $image_path = 'public/uploads/profile/' . $filename;
                Image::make($image_tmp)->save($image_path);
                $user->image = $filename;
            }
        }
        $user->save();


        return redirect()->back()->with('flash_message', 'Profile Has Been Updated Successfully');
    }

    public function userChangePassword(){
        $user = Auth::guard('web')->user();
        return view ('front.userChangePassword', compact('user'));
    }

    public function userUpdatePassword(Request $request, $id){
        $data = $request->all();
        $validateData = $request->validate([
            'current_password' => 'required|max:255|min:6',
            'password' => 'required|min:6',
            'confirm_password' => 'required_with:password|same:password|min:6'
        ]);
        $user = User::findOrFail($id);
        $current_user_password = $user->password;
        $data = $request->all();
        if(Hash::check($data['current_password'], $current_user_password)){
            $user->password = bcrypt($data['password']);
            $user->save();
            Session::flash('flash_message', 'User Password Has Been Updated Successfully');
            return redirect()->back();
        } else {
            Session::flash('error_message', 'Your Current Password Does not Match with our database');
            return redirect()->back();
        }
    }

    // confirm account code
    public function confirmAccount($email){
        $email = base64_decode($email);
        $userCount = User::where('email', $email)->count();
        if($userCount > 0){
            $userDetails = User::where('email', $email)->first();
            if($userDetails->verified == 1){
                return redirect('user/login')->with('success_message', 'Your Email is already activated');
            } else {
                User::where('email', $email)->update(['verified' => 1]);
                // Send Welcome Email
                $messageData = ['email' => $email,'name' => $userDetails->name];
                Mail::send('emails.welcome', $messageData, function($message) use ($email){
                    $message->to($email)->subject('Welcome To Janata ko Online');
                });
                return redirect('user/login')->with('success_message', 'Your Email has been activated');
            }
        } else {
            abort(404);
        }
    }


    // User News
    public function userNews(){
        $news = JanataNews::where('user_id', auth()->user()->id)->latest()->get();
        return view ('front.news.index', compact('news'));
    }

    // Add News
    public function addNews(){
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
        return view ('front.news.add', compact('categories_dropdown', 'news_types'));
    }

    // Store News
    public function storeNews(Request $request){
        $data = $request->all();
        $rule = [
            'news_title' => 'required',
            'category_id' => 'required',
            'news_content' => 'required',
        ];
        $customMessages = [
            'post_title.required'  => 'Please enter the news title',
            'category_id.required'  => 'Please Select Category',
            'news_content.required'  => 'Please enter news content',
        ];
        $this->validate($request, $rule, $customMessages);
        $news = new JanataNews();
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
        $news->user_id = $data['user_id'];
        $news->save();
        Session::flash('success_message', 'News has been added successfully');
        return redirect()->back();

    }

    public function editNews($id){
        $news = JanataNews::findOrFail($id);

        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option selected disabled > Select </option>";
        foreach($categories as $cat){
            if($cat->id == $news->category_id){
                $selected = "selected";
            } else {
                $selected = "";
            }
            $categories_dropdown .= "<option value='".$cat->id."' ".$selected."> ".$cat->category_name_np." </option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach($sub_categories as $sub_cat){
                if($sub_cat->id == $news->category_id){
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $categories_dropdown .= "<option value='".$sub_cat->id."' ".$selected.">  &nbsp; &nbsp; --- ".$sub_cat->category_name_np."  </option>";
            }
        }

        $news_types = NewsType::all();

        return view ('front.news.edit', compact('news', 'categories_dropdown', 'news_types'));
    }

    public function deleteJanataImage($id){
        $newsImage = JanataNews::findOrFail($id);
        $image_path = 'public/uploads/news/janata/';
        if(file_exists($image_path.$newsImage->thumbnail_image)){
            unlink($image_path.$newsImage->thumbnail_image);
        }
        JanataNews::where('id', $id)->update(['thumbnail_image' => NULL ]);
        Session::flash('success_message', 'News Image has been deleted successfully');
        return redirect()->back();
    }

    public function deleteJanataVideo($id){
        $newsImage = JanataNews::findOrFail($id);
        $image_path = 'public/uploads/news/janata/videos/';
        if(file_exists($image_path.$newsImage->video)){
            unlink($image_path.$newsImage->video);
        }
        JanataNews::where('id', $id)->update(['video' => NULL ]);
        Session::flash('success_message', 'News Video has been deleted successfully');
        return redirect()->back();
    }


    // Store News
    public function updateNews(Request $request, $id){
        $data = $request->all();
        $rule = [
            'news_title' => 'required',
            'category_id' => 'required',
            'news_content' => 'required',
        ];
        $customMessages = [
            'post_title.required'  => 'Please enter the news title',
            'category_id.required'  => 'Please Select Category',
            'news_content.required'  => 'Please enter news content',
        ];
        $this->validate($request, $rule, $customMessages);
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
        $news->user_id = $data['user_id'];
        $news->status = 0;
        $news->save();
        Session::flash('success_message', 'News has been Updated successfully');
        return redirect()->back();

    }

    public function deleteJanataNews($id){
        $post = JanataNews::findOrFail($id);
        $post->delete();
        $image_path = 'public/uploads/news/janata/';
        $video_path = 'public/uploads/news/janata/videos';

        if (!empty($post->thumbnail_image)) {
            if (file_exists($image_path . $post->thumbnail_image)) {
                unlink($image_path . $post->thumbnail_image);
            }
        }

        if (!empty($post->video)) {
            if (file_exists($video_path . $post->video)) {
                unlink($video_path . $post->video);
            }
        }

        Session::flash('success_message', 'News has been deleted successfully');
        return redirect()->back();
    }

    public function janatanewsGallery($id){
        $news = JanataNews::findOrFail($id);
        $images = JanataNewsGallery::where('janata_news_id', $id)->latest()->get();
        return view ('front.news.gallery', compact('images', 'news'));
    }

    public function newsStoreGallery(Request $request, $id)
    {
        $news = JanataNewsGallery::findOrFail($id);
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('uploads/news/gallery/'),$imageName);
        $imageUpload = new JanataNewsGallery();
        $imageUpload->image = $imageName;
        $imageUpload->janata_news_id = $id;
        $imageUpload->save();
        Session::flash('success_message', 'News Gallery has been added successfully');
        return redirect()->back();
//        return response()->json(['success'=>$imageName]);
    }

    public function deleteJanataGalleryImage(Request $request)
    {
        $filename =  $request->get('filename');
        JanataNewsGallery::where('image',$filename)->delete();
        $path=public_path().'/uploads/news/gallery/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
}
