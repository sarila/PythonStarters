@extends('admin.includes.admin_design')

@section('title') All Categories -  {{ config('app.name', 'Laravel') }} @endsection


@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">All Categories</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">All Categories</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{ route('category.add') }}" class="btn add-btn"><i class="fa fa-plus"></i> Add Category</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            @include('admin.includes._message')

            <div class="row">
                <div class="col-sm-12">
                    <div class="card mb-0">

                        <div class="card-body">

                            <div class="table-responsive">
                                <table class=" category-datatable table table-stripped mb-0" id="category-datatable">
                                    <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Category Name</th>
                                        <th>Category Name (नेपाली)</th>
                                        <th >Parent Category</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /Page Wrapper -->

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" id="modal-header">
                    <h4 class="modal-title" id="modal-title">Form Input</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body" id="modal-body">
                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')
    <!-- Datatable JS -->
    <script src="{{ asset('public/backend/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('public/backend/assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/jquery.sweet-alert.custom.js') }}"></script>

    <script>
        $('.category-datatable').DataTable({
            processing: true,
            serverSide: true,
            sorting: true,
            searchable : false,
            responsive: true,
            ajax: "{{ route('table.category') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'category_name', name: 'category_name'},
                {data: 'category_name_np', name: 'category_name_np'},
                {data: 'parent_id', name: 'parent_id'},
                {data: 'action', name: 'action', orderable: false}
            ]
        });

        $('body').on('click', '.btn-show', function (event) {
            event.preventDefault();
            var me = $(this),
                url = me.attr('href'),
                title = me.attr('title');
            $('#modal-title').text(title);
            $('#modal-btn-save').addClass('hide');
            $.ajax({
                url: url,
                dataType: 'html',
                success: function (response) {
                    $('#modal-body').html(response);
                }
            });
            $('#modal').modal('show');
        });


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
                    window.location.href =  SITEURL + "/admin/" + deleteFunction + "/" + id;
                });
        });
    </script>



@endsection
