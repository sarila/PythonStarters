@extends('admin.includes.admin_design')

@section('title') Edit Janata News -  {{ config('app.name', 'Laravel') }} @endsection



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
                            <li class="breadcrumb-item active">Edit News</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{ route('janata.index') }}" class="btn add-btn" ><i class="fa fa-eye"></i> All News</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->



            @include('admin.includes._message')

            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('janata.update', $post->id) }}" enctype="multipart/form-data">
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
                                                   <label for="news_type_id">News Type </label>
                                                   <select name="news_type_id" id="news_type_id" class="form-control select">
                                                       <option selected disabled>Select News Type</option>
                                                       @foreach($news_types as $type)
                                                           <option value="{{ $type->id }}" @if($type->id == $post->news_type_id) selected @endif>{{ $type->title }}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                           </div>

                                           <div class="col-md-12">
                                               <div class="form-group">
                                                   <label for="news_title">News Title <span class="text-danger">*</span></label>
                                                   <input type="text" class="form-control" name="news_title" id="news_title" value="{{ $post->news_title }}">
                                               </div>
                                           </div>

                                           <div class="col-md-12">
                                               <div class="form-group">
                                                   <label>News Content</label>
                                                   <textarea rows="10" cols="5" class="form-control editor1" id="editor1"  name="news_content" style="height:500px">
                                                     {{ $post->news_content }}
                                                  </textarea>
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

                                               @if(!empty($post->thumbnail_image))
                                                   <img class="img-responsive" src="{{ asset('public/uploads/news/janata/'.$post->thumbnail_image) }}" height="230" width="380" alt="" style="margin-bottom: 10px" id="one">
                                               @else
                                                   <img class="img-responsive" src="https://via.placeholder.com/380x230?text=Thumbnail+Image" alt="" style="margin-bottom: 10px" id="one">
                                               @endif

                                               <div class="form-group">
                                                   <input type="hidden" name="current_image" value="{{ $post->thumbnail_image }}">
                                                   <label for="image">Post Image </label>
                                                   <input type="file" name="thumbnail_image" class="form-control" id="image" accept="image/*" onchange="readURL(this);">
                                               </div>
                                                   @if(!empty($post->thumbnail_image))
                                                   <a href="" class="pull-right btn-delete" rel="{{ $post->id }}" rel1="delete-newsimage">Delete Image</a>
                                                       @endif
                                           </div>

                                           <div class="col-md-12">
                                               <div class="form-group">
                                                   <label for="video">Post Video </label>
                                                   <input type="file" name="video" class="form-control" id="video">
                                               </div>
                                               @if(!empty($post->video))
                                                   <a href="{{ asset('public/uploads/news/janata/videos/'.$post->video) }}" class="pull-right" target="_blank"> &nbsp;  View Video</a>
                                                   <a href="" class="pull-right btn-delete" rel="{{ $post->id }}" rel1="delete-newsvideo">Delete Video | </a>
                                               @endif
                                           </div>


                                           <div class="col-md-12">
                                               <div class="form-group">
                                                   <div class="form-group">
                                                       <label for="status"> Status </label>
                                                       <select name="status" id="status" class="form-control select">
                                                           <option selected disabled>Select Status</option>
                                                           <option value="0" @if($post->status == 0)  selected @endif>Pending</option>
                                                           <option value="1" @if($post->status == 1)  selected @endif>Verified</option>
                                                       </select>
                                                   </div>
                                               </div>
                                           </div>

                                           <div class="col-md-12">
                                               <div class="text-right">
                                                   <label for=""></label>
                                                   <button type="submit" class="btn btn-primary btn-block" style="margin-top: 10px">Update News</button>
                                               </div>
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

    <script src="{{ asset('public/backend/assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/jquery.sweet-alert.custom.js') }}"></script>

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
            height: '538'
        });
    </script>

    <script>
        $('body').on('click', '.btn-delete', function (event) {
            event.preventDefault();
            var SITEURL = '{{ URL::to('') }}';
            var id = $(this).attr('rel');
            var deleteFunction = $(this).attr('rel1');
            swal({
                    title: "Are You Sure? ",
                    text: "You will not be able to recover this record again",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, Delete it!"
                },
                function () {
                    window.location.href =  SITEURL + "/admin/" + deleteFunction + "/" + id;
                });
        });
    </script>


@endsection
