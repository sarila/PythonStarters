@extends('admin.includes.admin_design_v2')

@section('title') Social Media Settings -  {{ config('app.name', 'Laravel') }} @endsection


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
                                <h3 class="page-title">Social Media Settings</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    @include('admin.includes._message')

                    <form method="post" action="{{ route('socialUpdate', $social->id) }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                           <a href="{{ $social->facebook  }}" target="_blank"> <i class="fa fa-facebook"></i></a>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="facebook" value="{{ $social->facebook }}">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                           <a href="{{ $social->twitter  }}" target="_blank"> <i class="fa fa-twitter"></i></a>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="twitter" value="{{ $social->twitter }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                           <a href="{{ $social->instagram  }}" target="_blank"> <i class="fa fa-instagram"></i></a>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="instagram" value="{{ $social->instagram }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                           <a href="{{ $social->youtube  }}" target="_blank" style="color: #FF0000; font-size: 20px"> <i class="fa fa-youtube"></i></a>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="youtube" value="{{ $social->youtube }}">
                                </div>
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

@endsection
