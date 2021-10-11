@extends('front.includes.front_design')

@section('front_title')
    समाचार लेख्नुहोस -   {{ $theme->site_title }}
@endsection

@section('content')
    <section class="user-dashboard">
        <div class="container">
            <div class="row">
                @include('front.partials._dashboardlinks')


                <div class="col-lg-9">
                    <div class="edit-profile">
                        <h5 style="margin-bottom: 20px">समाचार लेख्नुहोस
                        </h5>

                       @include('admin.includes._message')

                        <form action="{{ route('storeNews') }}" method="post" enctype="multipart/form-data">
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
                                        <textarea rows="10" cols="5" class="form-control editor1" id="editor1"   name="news_content" style="height:300px">
                                                     {{ old('news_content') }}
                                                  </textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Post Image </label>
                                        <input type="file" name="thumbnail_image" class="form-control" id="image" accept="image/*" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="video">Post Video </label>
                                        <input type="file" name="video" class="form-control" id="video" >
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="text-center">
                                        <label for=""></label>
                                        <button type="submit" class="btn btn-primary btn-block" style="margin-top: 10px; background-color: #FF0000 !important; border: #FF0000">Add News</button>
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
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection
