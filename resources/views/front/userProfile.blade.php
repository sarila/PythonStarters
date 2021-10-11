@extends('front.includes.front_design')

@section('front_title')
    User Profile -   {{ $theme->site_title }}
@endsection

@section('content')
    <section class="user-dashboard">
        <div class="container">
            <div class="row">
                @include('front.partials._dashboardlinks')

                <div class="col-lg-9 col-md-12">
                    <div class="my-profile">
                        <h5>User Profile</h5>
                        <div class="user-basicinfo d-flex">
                            <div class="col-md-6">
                                <div class="myprofile-left">
                                    <ul>
                                        <li>Name:</li>
                                        <li>E-Mail Address:</li>
                                        <li>Contact Number:</li>
                                        <li>Address:</li>
                                        <li>Joined Date:</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="myprofile-right">
                                    <ul>
                                        <li>{{ $user->name }}</li>
                                        <li>{{ $user->email }}</li>
                                        <li>{{ $user->phone }}</li>
                                        <li>{{ $user->address }}</li>
                                        <li>{{ toFormattedNepaliDate($user->created_at) }} </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection
