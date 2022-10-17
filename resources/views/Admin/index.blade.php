@extends('layouts.master')
@section('css')

@section('title')
المستخدمين
@stop

<!-- Internal Data table css -->

<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ trans('admins.home') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> /
            {{ trans('admins.content_title') }}</span>
        </div>
        
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<div id="error_message"></div>
<div class="modal" id="modalAddAdmin">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ trans('admins.content_title') }}</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="formadmin">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('admins.user_name') }} :</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('admins.email') }} :</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('admins.phone') }} :</label>
                            <input type="number" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('admins.password') }} :</label>
                            <input type="text" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success AddAdmin" id="AddAdmin">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->
<div class="modal" id="modalEditAdmin">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ trans('admins.content_title') }}</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="formeditadmin">
                    <input type="hidden" class="form-control" id="id_admin">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('admins.user_name') }} :</label>
                            <input type="text" class="form-control" id="admin_name" name="name" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('admins.email') }} :</label>
                            <input type="email" class="form-control" id="admin_email" name="email" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('admins.phone') }} :</label>
                            <input type="number" class="form-control" id="admin_phone" name="phone" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('admins.password') }} :</label>
                            <input type="text" class="form-control" id="admin_password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="EditAdmin">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->
<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                @can('member-create')
                <div class="row row-xs wd-xl-80p">
                    <div class="col-sm-6 col-md-3 mg-t-10">
                        <button class="btn btn-info-gradient btn-block" id="ShowModalAddAdmin">
                            <a href="#" style="font-weight: bold; color: beige;">{{ trans('admins.Add_User') }}</a>
                        </button>
                    </div>
                </div>
                @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive hoverable-table">
                @can('member-view')
                    <table class="table table-hover" id="get_admins" style=" text-align: center;">
                        <thead>
                            <tr>
                                <th class="wd-10p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">{{ trans('admins.user_name') }}</th>
                                <th class="wd-20p border-bottom-0">{{ trans('admins.email') }}</th>
                                <th class="wd-15p border-bottom-0">{{ trans('admins.phone') }}</th>
                                <th class="wd-10p border-bottom-0">
                                @canany([ 'member-update' , 'member-delete' ])
                                {{ trans('admins.Processes') }}
                                @endcanany
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>
@can('member-view')
<script>
    
var table = $('#get_admins').DataTable({
    // processing: true,
    ajax: '{!! route("get_admins") !!}',
    columns: [
        {
            'data': 'id',
            'className': 'text-center text-lg text-medium'
        },
        {
            'data': 'name',
            'className': 'text-center text-lg text-medium'
        },
        {
            'data': 'email',
            'className': 'text-center text-lg text-medium'
        },
        {
            'data': null,
            render: function(data, row, type) {
                var phone;
                if (data.phone) {
                    phone = data.phone
                } else {
                    phone = "No num"
                }
                return phone;
            },
        },
        {
            'data': null,
            render: function(data, row, type) {
                return `
                @can('member-update')
                <button class="modal-effect btn btn-sm btn-info" id="ShowModalEditAdmin" data-id="${data.id}"><i class="las la-pen"></i></button>
                @endcan
                @can('member-delete')
                <button class="modal-effect btn btn-sm btn-danger" id="DeleteAdmin" data-id="${data.id}"><i class="las la-trash"></i></button>
                @endcan
                `;
            
            },
            orderable: false,
            searchable: false
        },
    ],
});
</script>
@endcan
<script>
//  view modal admin
$(document).on('click', '#ShowModalAddAdmin', function(e) {
    e.preventDefault();
    $('#modalAddAdmin').modal('show');
});
// create admin
$(document).on('click', '.AddAdmin', function(e) {
    e.preventDefault();
    let formdata = new FormData($('#formadmin')[0]);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: 'http://127.0.0.1:8000/admin/admin/add',
        data: formdata,
        contentType: false,
        processData: false,
        success: function(response) {
            // console.log("Done");
            $('#AddAdmin').text('Saving');
            $('#error_message').html("");
            $('#error_message').addClass("alert alert-info");
            $('#error_message').text(response.message + " " + response.data.name);
            $('#modalAddAdmin').modal('hide');
            $('#formadmin')[0].reset();
            table.ajax.reload();
        }
    });
    $.ajaxError()
});
// view modification data
$(document).on('click', '#ShowModalEditAdmin', function(e) {
    e.preventDefault();
    var id_admin = $(this).data('id');
    $('#modalEditAdmin').modal('show');
    $.ajax({
        type: 'GET',
        url: 'http://127.0.0.1:8000/admin/admin/edit/' + id_admin,
        data: "",
        success: function(response) {
            console.log(response);
            if (response.status == 404) {
                console.log('error');
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-danger");
                $('#error_message').text(response.message);
            } else {
                $('#id_admin').val(id_admin);
                $('#admin_name').val(response.data.name);
                $('#admin_email').val(response.data.email);
                $('#admin_phone').val(response.data.phone);
                $('#admin_password').val(response.data.password);
            }
        }
    });
});
$(document).on('click', '#EditAdmin', function(e) {
    e.preventDefault();
    var data = {
        name: $('#admin_name').val(),
        email: $('#admin_email').val(),
        phone: $('#admin_phone').val(),
        password: $('#admin_password').val(),
    };
    // let formdata = new FormData($('#formeditadmin')[0]);
    var id_admin = $('#id_admin').val();
    console.log(data);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: 'http://127.0.0.1:8000/admin/admin/update/' + id_admin,
        data: data,
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.status == 400) {
                // errors
                $('#list_error_messagee').html("");
                $('#list_error_messagee').addClass("alert alert-danger");
                $.each(response.errors, function(key, error_value) {
                    $('#list_error_messagee').append('<li>' + error_value + '</li>');
                });
            } else if (response.status == 404) {
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-danger");
                $('#error_message').text(response.message);
            } else {
                $('#EditAdmin').text('Saving');
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-info");
                $('#error_message').text(response.message);
                $('#modalEditAdmin').modal('hide');
                // $('#FormEditWork')[0].reset();
                table.ajax.reload();
            }
        }
    });
});
$(document).on('click', '#DeleteAdmin', function (e) {
            e.preventDefault();
            var id_admin = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'DELETE',
                url: 'http://127.0.0.1:8000/admin/admin/delete/' + id_admin,
                data: '',
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#error_message').html("");
                    $('#error_message').addClass("alert alert-danger");
                    $('#error_message').text(response.message);
                    table.ajax.reload();
                }
            });
        });
</script>



@endsection