<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use DataTables;


class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('admin_page', 'videos');
        return view('admin.videos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::put('admin_page', 'add_videos');
        return view('admin.videos.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $rule = [
            'title' => 'required',
            'description' => 'required',
            'youtube_url' => 'sometimes',
            'video' => 'sometimes| file | max:300000',
        ];
        $customMessages = [
            'title.required'  => 'Please enter the title for video',
            'description.required'  => 'Please enter short description',
            'video.file'  => 'Video must be of file type',
            'video.max'  => 'Video must be under 300000 mb size',
        ];
        $this->validate($request, $rule, $customMessages);

        $admin_id = Auth::guard('admin')->user()->id ?? null;
        $user_id = auth()->user()->id ??  null; 
        if ($admin_id == null && $user_id == null) {
            Session::flash('error_message', 'Sign in to user accout or admin account to add video');
            return redirect()->route('login_user');
        }
        $video = new Video();
        $video->title = $data['title'];
        $video->description = $data['description'];
        $video->youtube_url = $data['youtube_url'];
        if($request->hasFile('video')){
            $video_tmp = $request->file('video');
            if($video_tmp->isValid()){
                $video_name = $video_tmp->getClientOriginalName();
                $extension = $video_tmp->getClientOriginalExtension();
                $videoName = $video_name.'-'.rand().'.'.$extension;
                $video_path = 'public/uploads/videos/';
                $video_tmp->move($video_path, $videoName);
                $video->video = $videoName;

            }
        }
        $video->admin_id = $admin_id; 
        $video->user_id = $user_id; 
        $video->save();
        // dd($data);
        Session::flash('success_message', 'Video has been added successfully');
        return redirect()->route('videos.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return view('admin.videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $data = $request->all();
        $rule = [
            'title' => 'required',
            'description' => 'required',
            'youtube_url' => 'sometimes',
            'video' => 'sometimes| file | max:300000',
        ];
        $customMessages = [
            'title.required'  => 'Please enter the title for video',
            'description.required'  => 'Please enter short description',
            'video.file'  => 'Video must be of file type',
            'video.max'  => 'Video must be under 300000 mb size',
        ];
        $this->validate($request, $rule, $customMessages);

        $admin_id = $video->admin_id;
        $user_id = $video->user_id;
    
        if ($admin_id == null && $user_id == null) {
            Session::flash('error_message', 'Sign in to user accout or admin account to add video');
            return redirect()->route('login_user');
        }
        $video->title = $data['title'];
        $video->description = $data['description'];
        $video->youtube_url = $data['youtube_url'];
        if($request->hasFile('video')){
            $video_tmp = $request->file('video');
            if($video_tmp->isValid()){
                $video_name = $video_tmp->getClientOriginalName();
                $extension = $video_tmp->getClientOriginalExtension();
                $videoName = $video_name.'-'.rand().'.'.$extension;
                $video_path = 'public/uploads/videos/';
                $video_tmp->move($video_path, $videoName);
                $video->video = $videoName;

            }
        }
       
        $video->save();
        Session::flash('success_message', 'Video has been updated successfully');
        return redirect()->route('videos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->delete();
        $video_path = 'public/uploads/videos/';

        if (!empty($video->video)) {
            if (file_exists($video_path . $video->video)) {
                unlink($video_path . $video->video);
            }
        }
        Session::flash('success_message', 'Video Deleted successfully!');
        return redirect()->back();
    }


    // Show Data in Datattable
    public function dataTable(){
        $model = Video::latest()->get();
        // dd($model);
        return DataTables::of($model)
            ->addColumn('action', function ($model){
                return view ('admin.videos._actions', [
                    'model' => $model,
                    'url_show' => route('videos.show', $model->id),
                    'url_edit' => route('videos.edit', $model->id),
                    'url_destroy' => route('videos.destroy', $model->id),
                    
                ]);
            })
            ->editColumn('author', function ($model){
                return $model->author->name ?? "null";
            })
            ->editColumn('created_at', function ($model){
                return $model->created_at->diffForHumans();
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);

    }
}
