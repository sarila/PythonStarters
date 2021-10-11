@extends('front.includes.front_design')

@section('front_title')
    Edit समाचार लेख्नुहोस -   {{ $theme->site_title }}
@endsection

@section('content')
    <section class="user-dashboard">
        <div class="container">
            <div class="row">
                @include('front.partials._dashboardlinks')


                <div class="col-lg-9">
                    <div class="edit-profile">
                        <h5 style="margin-bottom: 20px">Edit समाचार लेख्नुहोस
                        </h5>

                       @include('admin.includes._message')

                        <form action="{{ route('updateNews', $news->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">

                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id; }}">

                                    <div class="form-group">
                                        <label for="parent_id">Under Category </label>
                                        <select name="category_id" id="category_id" class="form-control select">
                                            <?php echo $categories_dropdown; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="parent_id">Select Pradesh </label>
                                        <select name="news_type_id" id="news_type_id" class="form-control select">
                                            <option selected disabled>Select News Type</option>
                                            @foreach($news_types as $type)
                                                <option value="{{ $type->id }}" @if($type->id == $news->news_type_id) selected @endif>{{ $type->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="news_title">News Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="news_title" id="news_title" value="{{ $news->news_title }}">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>News Content</label>
                                        <textarea rows="10" cols="5" class="form-control editor1" id="editor1"   name="news_content" style="height:300px">
                                                     {{ $news->news_content }}
                                                  </textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Post Image </label>
                                        <input type="file" name="thumbnail_image" class="form-control" id="image" accept="image/*" onchange="readURL(this);">
                                    </div>
                                    @if(!empty($news->thumbnail_image))
                                        <img class="img-responsive" src="{{ asset('public/uploads/news/janata/'.$news->thumbnail_image) }}" height="230" width="380" alt="" style="margin-bottom: 10px" id="one">
                                    @else
                                        <img class="img-responsive" src="https://via.placeholder.com/380x230?text=Thumbnail+Image" alt="" style="margin-bottom: 10px" id="one">
                                    @endif

                                    @if(!empty($news->thumbnail_image))
                                        <a href="" class="pull-right btn-delete" rel="{{ $news->id }}" rel1="delete-janata">Delete Image</a>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="video">Post Video </label>
                                        <input type="file" name="video" class="form-control" id="video" >
                                    </div>

                                    @if(!empty($news->video))
                                        <a href="{{ asset('public/uploads/news/janata/videos/'.$news->video) }}" class="pull-right" target="_blank"> &nbsp;  View Video | </a>
                                        <a href="" class="pull-right btn-delete" rel="{{ $news->id }}" rel1="delete-janatavideo">Delete Video  </a>
                                    @endif
                                </div>


                                <div class="col-md-12">
                                    <div class="text-center">
                                        <label for=""></label>
                                        <button type="submit" class="btn btn-primary btn-block" style="margin-top: 10px; background-color: #FF0000 !important; border: #FF0000">Update News</button>
                                    </div>
                                </div>
                            </div>


                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('front_css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
@endsection

@section('front_js')
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('public/backend/assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/jquery.sweet-alert.custom.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>

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
                    window.location.href =  SITEURL + "/" + deleteFunction + "/" + id;
                });
        });
    </script>
@endsection
