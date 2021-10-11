@extends('front.includes.front_design')

@section('front_title')
{{ $user->name }} Profile Edit -   {{ $theme->site_title }}
@endsection

@section('content')
    <section class="user-dashboard">
        <div class="container">
            <div class="row">
                @include('front.partials._dashboardlinks')


                <div class="col-lg-9">
                    <div class="edit-profile">
                        <h5>Edit Profile</h5>

                        @if(Session::has('flash_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('flash_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif


                        <br>
                        <form action="{{ route('userProfileUpdate', $user->id) }}"  style="line-height: 2.3rem;" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="fname"><strong>Name</strong></label>
                            <br>
                            <input type="text" id="fname" name="name" class="w-100 pl-2" value="{{ $user->name }}">
                            <br>
                            <label for="email"><strong>E-Mail Address</strong></label>
                            <br>
                            <input type="email" id="email" name="email" value="{{ $user->email }}" class="w-100 pl-2">

                            <br>
                            <label for="phone"><strong>Phone Number</strong></label>
                            <br>
                            <input type="number" id="phone" name="phone" value="{{ $user->phone }}" class="w-100 pl-2">

                            <br>
                            <label for="address"><strong>Address</strong></label>
                            <br>
                            <input type="text" id="address" name="address" value="{{ $user->address }}" class="w-100 pl-2">

                            <br>
                            <label for="image"><strong>Profile Image</strong></label>
                            <br>
                            <input type="file" id="image" name="image" class="w-100 pl-2" accept="image/*">
                            <input type="hidden" name="current_image" value="{{ $user->image }}">


                            <button class="button button1 mt-3" type="submit">Submit</button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
