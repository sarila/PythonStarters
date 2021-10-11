<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use DataTables;
use DB;

class CategoryController extends Controller
{
    // Index Page
    public function index(){
        $current_user = Auth::guard('admin')->user();
        Session::put('admin_page', 'category');
        return view ('admin.category.index');
    }

    // Add Category
    public function add(){
        Session::put('admin_page', 'add_category');
        $categories = Category::where('parent_id', 0)->get();
        return view ('admin.category.add', compact('categories'));
    }

    // Store Category
    public function store(Request $request){
        $data = $request->all();
        $rules = [
            'category_name' => 'required|max:255|unique:categories,category_name',
            'category_name_np' => 'required|max:255',
        ];
        $customMessages = [
            'name.required' => 'Category Name is required',
            'name.max' => 'You are not allowed to enter more than 255 Characters',
            'name.unique' => 'Category Name already exists in our database',
            'category_name_np.required' => 'Category Code is required',
            'category_name_np.max' => 'You are not allowed to enter more than 255 Characters',
        ];
        $this->validate($request, $rules, $customMessages);
        $category = new Category();
        $category->category_name = $data['category_name'];
        $category->category_name_np = $data['category_name_np'];
        $category->slug = Str::slug($data['category_name']);
        $category->parent_id = $data['parent_id'];
        $category->seo_title = $data['seo_title'];
        $category->seo_subtitle = $data['seo_subtitle'];
        $category->description = $data['description'];
        $category->keywords = $data['keywords'];
        $category->save();
        Session::flash('success_message', 'Category has been added successfully');
        return redirect()->route('category.index');
    }

    public function show($id)
    {
        $model = Category::findOrFail($id);
        return view ('admin.category.show', compact('model'));
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        $categories = Category::where('parent_id', 0)->get();
        Session::put('admin_page', 'edit_category');
            return view('admin.category.edit', compact('categories', 'category'));
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $rules = [
            'category_name' => 'required|max:255',
            'category_name_np' => 'required|max:255',
        ];
        $customMessages = [
            'name.required' => 'Category Name is required',
            'name.max' => 'You are not allowed to enter more than 255 Characters',
            'category_name_np.required' => 'Category Code is required',
            'category_name_np.max' => 'You are not allowed to enter more than 255 Characters',
        ];
        $this->validate($request, $rules, $customMessages);
        $category = Category::findOrFail($id);
        $category->category_name = $data['category_name'];
        $category->category_name_np = $data['category_name_np'];
        $category->slug = Str::slug($data['category_name']);
        $category->parent_id = $data['parent_id'];
        $category->seo_title = $data['seo_title'];
        $category->seo_subtitle = $data['seo_subtitle'];
        $category->description = $data['description'];
        $category->keywords = $data['keywords'];
        $category->save();
        Session::flash('success_message', 'Category has been updated successfully');
        return redirect()->route('category.index');
    }

    public function dataTable(){
        $model = Category::latest()->get();
        return DataTables::of($model)
            ->addColumn('action', function ($model){
                return view ('admin.category._actions', [
                    'model' => $model,
                    'url_show' => route('category.show', $model->id),
                    'url_edit' => route('category.edit', $model->id),
                    'url_destroy' => route('category.destroy', $model->id),
                ]);
            })
            ->editColumn('parent_id', function ($model){
                if($model->parent_id == 0){
                    return "Main Category";
                } else {
                    return $model->subCategory->category_name_np;
                }
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);

    }

    // Delete
    public function destroy($id){
            $category = Category::findOrFail($id);
            $category->delete();
            DB::table('categories')->where('parent_id', $id)->delete();
            DB::table('news')->where('category_id', $id)->delete();
            Session::flash('success_message', 'Category has been deleted successfully');
            return redirect()->back();
    }
}
