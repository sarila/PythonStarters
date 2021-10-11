@extends('front.includes.front_design')

@section('front_title')
    Change Password -   {{ $theme->site_title }}
@endsection

@section('content')

    <section class="user-dashboard">
        <div class="container">
            <div class="row">

                @include('front.partials._dashboardlinks')


                <div class="col-lg-9">
                    <div class="edit-profile">
                        <h5>Update Password</h5>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(Session::has('flash_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('flash_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if(Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ Session::get('error_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <br>
                        <form action="{{ route('userUpdatePassword', $user->id) }}"  style="line-height: 2.3rem;" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="current_password"><strong>Old Password</strong></label>
                            <br>
                            <input type="password" id="current_password" name="current_password" class="w-100 pl-2">
                            <br>
                            <label for="password"><strong>New Password</strong></label>
                            <br>
                            <input type="password" id="password" name="password" class="w-100 pl-2">
                            <br>
                            <label for="pass"><strong>Confirm Password</strong></label>
                            <br>
                            <input type="password" id="pass" name="confirm_password"  class="w-100 pl-2">




                            <button class="button button1 mt-3" type="submit">Submit</button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
