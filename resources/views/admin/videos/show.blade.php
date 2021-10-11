@extends('admin.includes.admin_design')

@section('title') All Videos -  {{ config('app.name', 'Laravel') }} @endsection


@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">All Videos</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">All Videos</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{ route('videos.create') }}" class="btn add-btn"><i class="fa fa-plus"></i> Add Videos</a>
                    </div>
                </div>
            </div>


            <div class="row">
                <table class="table table-hover">
                    <tr>
                        <th>Title</th>
                        <td>
                            {{ $video->title }}
                        </td>
                    </tr>

                    <tr>
                        <th>Description</th>
                        <td>
                            {{ $video->description}}
                        </td>
                    </tr>

                    @if($video->admin_id != null)
                    <tr>
                        <th>Admin</th>
                        <td>
                            {{ $video->author->name }}
                        </td>
                    </tr>
                    @endif

                    @if($video->youtube_url != null)
                    <tr>
                        <th>URL</th>
                        <td>
                            {{ $video->youtube_url }}
                        </td>
                    </tr>
                    @endif

                    @if($video->video != null)
                    <tr>
                        <th>Video</th>
                        <td>
                            <a href="{{asset( 'public/uploads/videos/'.$video->video)}}">
                                <video>
                                    <source src="{{asset( 'public/uploads/videos/'.$video->video)}}" type="">
                                </video>
                            </a>
                            
                        </td>
                    </tr>
                    @endif
                </table>
            </div>

        </div>
    </div>



