@extends('admin.includes.admin_design')

@section('site_title') Add New News @endsection



@section('content')
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">News</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add News</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{ route('post.index') }}" class="btn add-btn" ><i class="fa fa-eye"></i> All News</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->



            @include('admin.includes._message')

            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
                        @csrf
                       <div class="row">
                           <div class="col-md-7">
                               <div class="card">
                                   <div class="card-header">
                                       <h4 class=" text-uppercase">
                                           News Details
                                       </h4>
                                   </div>
                                   <div class="card-body">
                                       <div class="row">
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label for="category_id">Under Category </label>
                                                   <select name="category_id" id="category_id" class="form-control select">
                                                       <?php echo $categories_dropdown; ?>

                                                   </select>
                                               </div>
                                           </div>

                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label for="news_type_id">Select Pradesh </label>
                                                   <select name="news_type_id" id="news_type_id" class="form-control select">
                                                       <option selected disabled>Select News Type</option>
                                                       @foreach($news_types as $type)
                                                           <option value="{{ $type->id }}">{{ $type->title }}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                           </div>

                                           <div class="col-md-12">
                                               <div class="form-group">
                                                   <label for="news_title">News Title <span class="text-danger">*</span></label>
                                                   <input type="text" class="form-control" name="news_title" id="news_title" value="{{ old('news_title') }}">
                                               </div>
                                           </div>

                                           <div class="col-md-12">
                                               <div class="form-group">
                                                   <label>News Content</label>
                                                   <textarea rows="10" cols="5" class="form-control editor1" id="editor1"   name="news_content" style="height:900px">
                                                     {{ old('news_content') }}
                                                  </textarea>
                                               </div>
                                           </div>


                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" value="1"  name="is_featured">
                                                      <label class="form-check-label" for="invalidCheck2">
                                                          Featured Post
                                                      </label>
                                                  </div>
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
                                                   <label for="image">Post Image </label>
                                                   <input type="file" name="thumbnail_image" class="form-control" id="image" accept="image/*" onchange="readURL(this);">
                                               </div>
                                           </div>

                                           <div class="col-md-12">
                                               <div class="form-group">
                                                   <label for="video">Post Video </label>
                                                   <input type="file" name="video" class="form-control" id="video">
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card-body">
                                       <hr>
                                       <h4 class=" text-uppercase">
                                           SEO Settings
                                       </h4>

                                       <hr>
                                       <div class="row">
                                           <div class="col-md-12">
                                               <div class="form-group">
                                                   <label for="seo_title" style="font-size: 14px">SEO Title</label>
                                                   <input class="form-control" type="text" name="seo_title" id="seo_title" >
                                               </div>
                                           </div>
                                           <div class="col-md-12">
                                               <div class="form-group">
                                                   <label for="seo_subtitle" style="font-size: 14px">SEO Sub Title</label>
                                                   <input class="form-control" type="text" name="seo_subtitle" id="seo_subtitle" >
                                               </div>
                                           </div>

                                           <div class="col-md-12">
                                               <div class="form-group">
                                                   <label for="description" style="font-size: 14px">SEO Description</label>
                                                   <input class="form-control" type="text" name="description" id="description" >
                                               </div>
                                           </div>

                                           <div class="col-md-12">
                                               <div class="form-group">
                                                   <label for="keywords" style="font-size: 14px">SEO Keywords</label>
                                                   <input class="form-control" type="text" name="keywords" id="keywords" >
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>


                           </div>
                       </div>

                            <div class="card">
                                <div class="card-body">
                                   <div class="row">
                                       <div class="col-md-6">
                                               <div class="form-group">
                                                       <div class="form-group">
                                                           <label for="status"> Status </label>
                                                           <select name="status" id="status" class="form-control select">
                                                               <option selected disabled>Select Status</option>
                                                               <option value="0">Draft</option>
                                                               <option value="1">Published</option>
                                                           </select>
                                                      </div>
                                       </div>
                                       </div>
                                    <div class="col-md-6">
                                           <div class="text-right">
                                               <label for=""></label>
                                               <button type="submit" class="btn btn-primary btn-block" style="margin-top: 10px">Add News</button>
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
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('editor1', {
            filebrowserUploadUrl: "{{route('ckeditor.store', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
            height: '538',
        });

    </script>


@endsection
