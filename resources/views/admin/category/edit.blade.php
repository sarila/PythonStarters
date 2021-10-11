@extends('admin.includes.admin_design')

@section('site_title') Edit {{ $category->category_name_np }}@endsection



@section('content')
    <div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Categories</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit {{ $category->category_name_np }}</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('category.index') }}" class="btn add-btn" ><i class="fa fa-eye"></i> All Categories</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">



                    <div class="card-body">
                        <form method="post" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="parent_id">Parent Category </label>
                                        <select name="parent_id" id="parent_id" class="form-control select">
                                            <option value="0" @if($category->parent_id == 0) selected @endif>No Parent Category</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}" @if($cat->id == $category->parent_id) selected @endif>{{ $cat->category_name_np }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_name">Category Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="category_name" id="category_name" value="{{ $category->category_name }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_name_np">Category Name (नेपाली) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="category_name_np" id="category_name_np" value="{{ $category->category_name_np }}">
                                    </div>
                                </div>
                            </div>


                            <hr>

                            <h4 class=" text-uppercase">
                                SEO Settings
                            </h4>

                            <hr>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="seo_title" style="font-size: 14px">SEO Title</label>
                                        <input class="form-control" type="text" name="seo_title" id="seo_title" value="{{ $category->seo_title }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="seo_subtitle" style="font-size: 14px">SEO Sub Title</label>
                                        <input class="form-control" type="text" name="seo_subtitle" id="seo_subtitle" value="{{ $category->seo_subtitle }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" style="font-size: 14px">SEO Description</label>
                                        <input class="form-control" type="text" name="description" id="description" value="{{ $category->description }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="keywords" style="font-size: 14px">SEO Keywords</label>
                                        <input class="form-control" type="text" name="keywords" id="keywords" value="{{ $category->keywords }}" >
                                    </div>
                                </div>
                            </div>






                            <div class="col-md-12">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Update Category</button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>

        </div>



    </div>
    <!-- /Page Content -->
    </div>
@endsection


