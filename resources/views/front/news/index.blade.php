@extends('front.includes.front_design')

@section('front_title')
    My News -   {{ $theme->site_title }}
@endsection

@section('content')
    <section class="user-dashboard">
        <div class="container">
            <div class="row">
                @include('front.partials._dashboardlinks')




                <div class="col-lg-9">

                    @include('admin.includes._message')
                    <div class="edit-profile">
                        <h5 style="margin-bottom: 20px">My News
                            <div class="text-right">
                                <a href="{{ route('addNews') }}" class="btn btn-info" style="background-color: #FF0000 !important; border: #FF0000"> <i class="fa fa-plus"></i> समाचार लेख्नुहोस</a>
                            </div>
                        </h5>





                        <table id="example" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Image</th>
                                <th>News Title</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($news as $item)
                            <tr>
                                <td>{{ $item->index + 1 }}</td>
                                <td>
                                    @if(!empty($item->thumbnail_image))
                                        <img src="{{ asset('public/uploads/news/janata/'.$item->thumbnail_image) }}" alt="{{ $item->news_title }}" style="max-width: 130px; max-height: 100px;">
                                    @else
                                        <img src="{{ asset('public/default/noimage.png') }}" style="max-width: 130px; max-height: 100px;">
                                    @endif
                                </td>
                                <td>{{ $item->news_title }}</td>
                                <td>
                                    @if($item->status == 0)
                                        <span class="badge badge-warning" style="color: white;">Pending</span>
                                    @else
                                        <span class="badge badge-primary" style="color: white;">Approved</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('editNews', $item->id) }}" data-toggle="tooltip" title="Edit" data-placement="bottom" class="btn btn-sm btn-outline-info">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="{{ route('janatanewsGallery', $item->id) }}" data-toggle="tooltip" title="Gallery" data-placement="bottom" class="btn btn-sm btn-outline-warning">
                                        <i class="fa fa-image"></i>
                                    </a>

                                    <a href="" class="btn-delete btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Delete" data-placement="bottom" rel="{{ $item->id }}" rel1="delete-janatanews" >
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>

                        </table>
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

    <script src="{{ asset('public/backend/assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/jquery.sweet-alert.custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
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
                    window.location.href =  SITEURL + "/" + deleteFunction + "/" + id;
                });
        });
    </script>


@endsection
