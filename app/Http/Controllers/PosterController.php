<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use DataTables;

use App\Models\Category;

class PosterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('admin_page', 'posters');
        return view('admin.posters.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posters.create', compact('categories'));
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
            'title' => 'required | string',
            'placement' => 'required',
            'youtube_url' => 'sometimes',
            'image' => 'sometimes| file | max:6000',
        ];
        $customMessages = [
            'title.required'  => 'Please enter the title for image',
            'title.string'  => 'Title should be of string',
            'placement.required'  => 'Placement is required',
            'image.file'  => 'Image must be of file type',
            'image.max'  => 'Image must be under 3000 size',
        ];
        $this->validate($request, $rule, $customMessages);

        $poster = new Poster();
        
        if($request->hasFile('image')){
            $image_tmp = $request->file('image');
            if($image_tmp->isValid()){
                $image_name = $image_tmp->getClientOriginalName();
                $extension = $image_tmp->getClientOriginalExtension();
                $imageName = $image_name.'-'.rand().'.'.$extension;
                $image_path = 'public/uploads/posters/';
                $image_tmp->move($image_path, $imageName);
                $poster->image = $imageName;

            }
        }
        $poster->title = $data['title'];
        $poster->placement = $data['placement'];
        $poster->category_id = $data['category_id'];

        $poster->save();

        Session::flash('success_message', 'Poster has been added successfully');
        return redirect()->route('posters.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poster  $poster
     * @return \Illuminate\Http\Response
     */
    public function show(Poster $poster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poster  $poster
     * @return \Illuminate\Http\Response
     */
    public function edit(Poster $poster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poster  $poster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poster $poster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poster  $poster
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poster $poster)
    {
        //
    }



     // Show Data in Datattable
    public function dataTable(){
        $model = Poster::latest()->get();
        // dd($model);
        return DataTables::of($model)
            ->addColumn('action', function ($model){
                return view ('admin.posters._actions', [
                    'model' => $model,
                    'url_show' => route('posters.show', $model->id),
                    'url_edit' => route('posters.edit', $model->id),
                    'url_destroy' => route('posters.destroy', $model->id),
                    
                ]);
            })
            ->editColumn('category', function ($model){
                return $model->category->name ?? "null";
            })
            ->editColumn('created_at', function ($model){
                return $model->created_at->diffForHumans();
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);

    }
}
