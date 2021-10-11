@extends('admin.includes.admin_design')

@section('site_title') Add New Videos @endsection



@section('content')
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Videos</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Videos</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{ route('videos.index') }}" class="btn add-btn" ><i class="fa fa-eye"></i> All Videos</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->



            @include('admin.includes._message')

            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('videos.store') }}" enctype="multipart/form-data">
                        @csrf
                       <div class="row">
                           <div class="col-md-7">
                               <div class="card">
                                   <div class="card-header">
                                       <h4 class=" text-uppercase">
                                           Video Details
                                       </h4>
                                   </div>
                                   <div class="card-body">
                                       <div class="row">

                                           <div class="col-md-12">
                                               <div class="form-group">
                                                   <label for="title">Video Title <span class="text-danger">*</span></label>
                                                   <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                                               </div>
                                           </div>

                                           <div class="col-md-12">
                                               <div class="form-group">
                                                   <label>Video Description <span class="text-danger">*</span></label>
                                                   <textarea rows="10" cols="5" class="form-control editor1" id="editor1"   name="description" style="height:300px">{{ old('description') }}</textarea>
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
                                           <!--  <div class="col-md-12">
                                                <label for="choices">Your Upload?<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="radio" id="yt_link" name="choice" value="0">
                                                    <label for="yt_link">Youtube URL</label>
                                                    <input type="radio" id="video_file" name="choice" value="1">
                                                    <label for="video_file">Video File</label>
                                                </div>
                                            </div> -->
                                            <div class="col-md-12 yt_link">
                                               <div class="form-group">
                                                   <label for="youtube_url">Youtube Link</label>
                                                   <input type="text" name="youtube_url" class="form-control" id="youtube_url">
                                               </div>
                                            </div>

                                            <div class="col-md-12 video_file">
                                               <div class="form-group">
                                                   <label for="video">Video </label>
                                                   <input type="file" name="video" class="form-control" id="video">
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
                                       <div class="text-right">
                                           <label for=""></label>
                                           <button type="submit" class="btn btn-primary btn-block" style="margin-top: 10px">Add Video</button>
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
            height: '300',
        });

    </script>

    <script>
        $(document).ready(function() {
            var value = $("input[type='radio'][name='rate']:checked").val();
            // $('#choices').on('change', function() {
            //     var value = $(this).val();
                if (value == 0) {
                    $('.yt_link').show();
                } else {
                    $('.video_file').show();
                }
            // });
        });
    </script>


@endsection
