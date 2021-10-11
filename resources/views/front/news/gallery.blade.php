@extends('front.includes.front_design')

@section('front_title')
    News Image Gallery -   {{ $theme->site_title }}
@endsection

@section('content')
    <section class="user-dashboard">
        <div class="container">
            <div class="row">
                @include('front.partials._dashboardlinks')




                <div class="col-lg-9">

                    @include('admin.includes._message')
                    <div class="edit-profile">
                        <h5 style="margin-bottom: 20px">News Gallery
                            <div class="text-right">
                                <a href="{{ route('userNews') }}" class="btn btn-info" style="background-color: #FF0000 !important; border: #FF0000"> <i class="fa fa-eye"></i> सबै समाचार</a>
                            </div>
                        </h5>

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

                                        <form method="post" action="{{ route('janatanewsStoreGallery', $news->id) }}" enctype="multipart/form-data"
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
            </div>
        </div>
    </section>
@endsection



@section('js')
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
@endsection
