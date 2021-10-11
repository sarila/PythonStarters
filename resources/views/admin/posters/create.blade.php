@extends('admin.includes.admin_design')

@section('site_title') Add New Poster @endsection



@section('content')
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Poster</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Poster</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{ route('posters.index') }}" class="btn add-btn" ><i class="fa fa-eye"></i> All Poster</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->



            @include('admin.includes._message')

            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('posters.store') }}" enctype="multipart/form-data">
                        @csrf
                       <div class="row">
                           <div class="col-md-7">
                               <div class="card">
                                   <div class="card-header">
                                       <h4 class=" text-uppercase">
                                           Poster Details
                                       </h4>
                                   </div>
                                   <div class="card-body">
                                       <div class="row">
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label for="title">Title <span class="text-danger">*</span></label>
                                                   <input type="text" name="title" class="form-control" value="{{old('title')}}">
                                               </div>
                                           </div>

                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label for="placement">Select Placement for this ad <span class="text-danger">*</span> </label>
                                                   <select name="placement" id="placement" class="form-control select">
                                                        <option selected disabled>Select Placement for this ad</option>
                                                        <option value="0">Header</option>
                                                        <option value="1">Index Page (Full width banner)</option>
                                                        <option value="2">Sidebar</option>
                                                        <option value="3">Category Specific</option>
                                                        <option value="4">Index Page(square)</option>
                                                   </select>
                                               </div>
                                           </div>

                                           <div class="col-md-12">
                                               <div class="form-group">
                                                   <label for="category_id">Category</label>
                                                    <select name="category_id" id="category_id" class="form-control select">
                                                        <option selected value="">If Category Specific, Choose the category:</option>
                                                        @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                        @endforeach
                                                   </select>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card-body">
                                       <div class="row">
                                            <div class="col-md-6">
                                               <div class="text-right">
                                                   <label for=""></label>
                                                   <button type="submit" class="btn btn-primary btn-block" style="margin-top: 10px">Add Poster</button>
                                               </div>
                                           </div>
                                       </div>
                                    </div>
                               </div>
                           </div>
                           <div class="col-md-5">
                               <div class="card">
                                   <div class="card-header">
                                       <h4 class=" text-uppercase">
                                           Media Settings
                                       </h4>
                                   </div>
                                   <div class="card-body">
                                       <div class="row">
                                           <div class="col-md-12">

                                               <img class="img-responsive" src="https://via.placeholder.com/380x230?text=Thumbnail+Image" alt="" style="margin-bottom: 10px" id="one">

                                               <div class="form-group">
                                                   <label for="image"> Image </label>
                                                   <input type="file" name="image" class="form-control" id="image" accept="image/*" onchange="readURL(this);">
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
@endsection

@section('js')
    <script>
        function readURL(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(380)
                       .height(230)
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
