@extends('admin.includes.admin_design')

@section('title') Image Gallery for News -  {{ config('app.name', 'Laravel') }} @endsection


@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">News Image Gallery</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('post.index') }}">News Gallery Image</a></li>
                            <li class="breadcrumb-item active">{{ $news->news_title }}</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{ route('post.index') }}" class="btn add-btn"><i class="fa fa-eye"></i> View All News</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->


            @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="height: 40px; padding: 10px;">
                    {{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="position: relative; top: -10px;">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <form method="post" action="{{ route('newsStoreGallery', $news->id) }}" enctype="multipart/form-data"
                                  class="dropzone" id="dropzone">
                                @csrf
                            </form>

                            <section class="comp-section comp-cards" id="comp_cards">

                                <div class="row">
                                    @foreach($images as $image)
                                        <div class="col-12 col-md-4 col-lg-3 d-flex">
                                            <div class="card flex-fill">
                                                <img alt="" src="{{ asset('public/uploads/news/gallery/'.$image->image) }}" class="card-img-top">
                                                <a class="btn-delete btn" href="javascript:" rel="{{ $image->id }}" rel1="image-delete" style="color: red"><i class="fa fa-trash-o m-r-5" style="color: red;"></i> Delete</a>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                            </section>
                        </div>


                    </div>
                </div>

            </div>


        </div>
    </div>
    <!-- /Page Wrapper -->

@endsection

@section('js')

    <script src="{{ asset('public/backend/assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/jquery.sweet-alert.custom.js') }}"></script>

    <script type="text/javascript">
        Dropzone.options.dropzone =
            {
                maxFilesize: 12,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time+file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function(file)
                {
                    var name = file.upload.filename;
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: '{{ route('deleteImage') }}',
                        data: {filename: name},
                        success: function (data){
                            console.log("File has been successfully removed!!");
                        },
                        error: function(e) {
                            console.log(e);
                        }});
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },

                success: function(file, response)
                {
                    console.log(response);
                },
                error: function(file, response)
                {
                    return false;
                }
            };
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
