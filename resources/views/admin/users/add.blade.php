@extends('admin.includes.admin_design')

@section('title') Add New User @endsection



@section('content')
    <div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Users</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add New</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{ route('users') }}" class="btn add-btn" ><i class="fa fa-eye"></i> All Users</a>
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


                        <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name"> Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">E-Mail Address <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone"> Phone Number </label>
                                        <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address"> Address </label>
                                        <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pass">Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="confirm_password" id="pass" value="{{ old('confirm_password') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Image </label>
                                        <input type="file" class="form-control" name="image" id="pass" accept="image/*" onchange="readURL(this);">
                                    </div>

                                    <img src="{{ asset('public/default/avatar.png') }}" style="width: 100px" id="one">

                                </div>
                            </div>


                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" checked name="welcome">
                                                <label class="form-check-label" for="invalidCheck2">
                                                    Send Welcome Message
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>






                            <div class="col-md-12">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Add User</button>
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

@section('js')
    <script>
        function readURL(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(100)
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
