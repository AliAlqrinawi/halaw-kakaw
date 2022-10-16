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
            <h4 class="content-title mb-0 my-auto">{{ trans('coupons.home') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> /
                {{ trans('times.page_title') }}</span>
        </div>

    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<div id="error_message"></div>
<div class="modal" id="modalAddDeliveryType">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ trans('times.page_title') }}</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="formDeliveryType" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('category.Title_E') }} :</label>
                            <input type="text" class="form-control" name="title_en" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('category.Title_A') }} :</label>
                            <input type="text" class="form-control" name="title_ar" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success AddDeliveryType" id="AddDeliveryType">{{ trans('category.Save') }}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('category.Close') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->
<div class="modal" id="modalEditDeliveryType">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ trans('times.page_title') }}</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="ali" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="id_DeliveryType">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('category.Title_E') }} :</label>
                            <input type="text" class="form-control" name="title_en" id="title_en" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('category.Title_A') }}:</label>
                            <input type="text" class="form-control" name="title_ar" id="title_ar" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="EditClient">{{ trans('category.Save') }}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('category.Close') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->
<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="row row-xs wd-xl-80p">
                    <div class="col-sm-6 col-md-3 mg-t-10">
                        <button class="btn btn-info-gradient btn-block" id="ShowModalAddDeliveryType">
                            <a href="#" style="font-weight: bold; color: beige;">{{ trans('times.add') }}</a>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive hoverable-table">
                    <table class="table table-hover" id="get_DeliveryTypes" style=" text-align: center;">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">{{ trans('app_users.name') }}</th>
                                <th class="border-bottom-0">{{ trans('app_users.status') }}</th>
                                <th class="border-bottom-0">{{ trans('category.Processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
<script>
var local = "{{ App::getLocale() }}";
var i = 1;
var table = $('#get_DeliveryTypes').DataTable({
    // processing: true,
    ajax: '{!! route("get_times") !!}',
    columns: [{
            'data': 'id',
            'className': 'text-center text-lg text-medium'
        },
        {
            'data': null,
            'className': 'text-center text-lg text-medium',
            render: function(data, row, type) {
                if (local == "en") {
                    return data.title_en;
                } else {
                    return data.title_ar;
                }
            },
        },
        {
            'data': null,
            render: function(data, row, type) {
                var phone;
                if (data.status == '1') {
                    return `<button class="btn btn-success-gradient btn-block" id="status" data-id="${data.id}" data-viewing_status="${data.status}">{{ trans('category.Active') }}</button>`;
                } else {
                    return `<button class="btn btn-danger-gradient btn-block" id="statusoff" data-id="${data.id}" data-viewing_status="${data.status}">{{ trans('category.iActive') }}</button>`;
                }
            },
        },
        {
            'data': null,
            render: function(data, row, type) {
                return `
                <button class="modal-effect btn btn-sm btn-info" id="ShowModalEditDeliveryType" data-id="${data.id}"><i class="las la-pen"></i></button>
                <button class="modal-effect btn btn-sm btn-danger" id="DeleteDeliveryType" data-id="${data.id}"><i class="las la-trash"></i></button>
                        `;
            },
            orderable: false,
            searchable: false
        },
    ],
});
//  view modal DeliveryType
$(document).on('click', '#ShowModalAddDeliveryType', function(e) {
    e.preventDefault();
    $('#modalAddDeliveryType').modal('show');
});
// DeliveryType admin
$(document).on('click', '.AddDeliveryType', function(e) {
    e.preventDefault();
    let formdata = new FormData($('#formDeliveryType')[0]);
    // console.log(formdata);
    // console.log("formdata");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '{{ route("add_times") }}',
        data: formdata,
        contentType: false,
        processData: false,
        success: function(response) {
            // console.log("Done");
            $('#AddDeliveryType').text('Saving');
            $('#error_message').html("");
            $('#error_message').addClass("alert alert-info");
            $('#error_message').text(response.message);
            $('#modalAddDeliveryType').modal('hide');
            $('#formDeliveryType')[0].reset();
            table.ajax.reload();
        }
    });
});
// view modification data
$(document).on('click', '#ShowModalEditDeliveryType', function(e) {
    e.preventDefault();
    var id_DeliveryType = $(this).data('id');
    $('#modalEditDeliveryType').modal('show');
    $.ajax({
        type: 'GET',
        url: '{{ url("admin/times/edit") }}/' + id_DeliveryType,
        data: "",
        success: function(response) {
            console.log(response);
            if (response.status == 404) {
                console.log('error');
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-danger");
                $('#error_message').text(response.message);
            } else {
                $('#ali')[0].reset();
                $('#id_DeliveryType').val(id_DeliveryType);
                $('#title_en').val(response.data.title_en);
                $('#title_ar').val(response.data.title_ar);
            }
        }
    });
});
$(document).on('click', '#EditClient', function(e) {
    e.preventDefault();
    let formdata = new FormData($('#ali')[0]);
    var id_DeliveryType = $('#id_DeliveryType').val();
    console.log(formdata);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '{{ url("admin/times/update") }}/' + id_DeliveryType,
        data: formdata,
        contentType: false,
        processData: false,
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
                $('#EditClient').text('Saving');
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-info");
                $('#error_message').text(response.message);
                $('#modalEditDeliveryType').modal('hide');
                table.ajax.reload();
            }
        }
    });
});
$(document).on('click', '#DeleteDeliveryType', function(e) {
    e.preventDefault();
    var id_DeliveryType = $(this).data('id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url: '{{ url("admin/times/delete") }}/' + id_DeliveryType,
        data: '',
        contentType: false,
        processData: false,
        success: function(response) {
            $('#error_message').html("");
            $('#error_message').addClass("alert alert-danger");
            $('#error_message').text(response.message);
            table.ajax.reload();
        }
    });
});

$(document).on('click', '#status', function(e) {
    e.preventDefault();
    // console.log("Alliiiii");
    var edit_id = $(this).data('id');
    var status = $(this).data('viewing_status');
    if (status == 1) {
        status = 0;
    } else {
        status = 1;
    }
    var data = {
        id: edit_id,
        status: status
    };
    // console.log(status);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '{{ route("deliveryTypes.status") }}',
        data: data,
        success: function(response) {
            $('#error_message').html("");
            $('#error_message').addClass("alert alert-danger");
            $('#error_message').text(response.message);
            table.ajax.reload();
        }
    });
});
$(document).on('click', '#statusoff', function(e) {
    e.preventDefault();
    // console.log("Alliiiii");
    var edit_id = $(this).data('id');
    var status = $(this).data('viewing_status');
    if (status == 1) {
        status = 0;
    } else {
        status = 1;
    }
    var data = {
        id: edit_id,
        status: status
    };
    // console.log(status);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '{{ route("deliveryTypes.status") }}',
        data: data,
        success: function(response) {
            $('#error_message').html("");
            $('#error_message').addClass("alert alert-danger");
            $('#error_message').text(response.message);
            table.ajax.reload();
        }
    });
});
</script>
@endsection