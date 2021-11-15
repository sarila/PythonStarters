@extends('admin.includes.admin_design_v2')

@section('title') Company Settings -  {{ config('app.name', 'Laravel') }} @endsection


@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Company Settings</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    @include('admin.includes._message')

                    <form method="post" action="{{ route('companyUpdate', $company->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Company Location</label>
                            <div class="col-lg-9">
                                <input name="address" class="form-control" type="text" value="{{ $company->address }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Phone numbers</label>
                            <div class="col-lg-9">
                                <input name="phone" class="form-control" type="text" value="{{ $company->phone }}">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Email Address</label>
                            <div class="col-lg-9">
                                <input name="email" class="form-control" type="text" value="{{ $company->email }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Tagline</label>
                            <div class="col-lg-9">
                                <input name="tagline" class="form-control" type="text" value="{{ $company->tagline }}">
                            </div>
                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->
@endsection

@section('js')
    <script>
        function readURL(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(85)
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        function readURL2(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#two')
                        .attr('src', e.target.result)
                        .width(16)
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".phone").select2({
               tags: true,
               tokenSeparators: [',', ' ']
            })
        })
       
    </script>
     
@endsection
