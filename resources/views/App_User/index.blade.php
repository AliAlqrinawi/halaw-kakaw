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
            <h4 class="content-title mb-0 my-auto">{{ trans('app_users.Home') }}</h4><span
                class="text-muted mt-1 tx-13 mr-2 mb-0"> /
                {{ trans('app_users.app') }}</span>
        </div>

    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<div id="error_message"></div>
<div class="modal" id="modalAddcredit">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ trans('app_users.app') }}</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="formcategory" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="id" id="idid">
                        <div class="form-group col-md-12">
                            <label for="credit">{{ trans('app_users.charged_balance') }}</label>
                            <input type="number" class="form-control" id="credit" name="credit">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="note">{{ trans('app_users.Notes') }}</label>
                            <textarea class="form-control" id="note" name="note" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success AddCategory"
                            id="Addcredit1">{{ trans('category.Save') }}</button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('category.Close') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Management</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="payment/update" method="post" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="patch">
                    <input type="hidden" name="_token" value="o2RMVxMUvjafmzNYvClExYr7nxek043oY40uUqoM">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="row">
                        <table class="table table-hover" id="example1" data-page-length="50"
                            style=" text-align: center;">
                            <thead>
                                <tr>
                                    <th>العنوان</th>
                                    <th>الوصف</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <td id="Numberorders"></td>
                                </tr>
                                <tr>
                                    <th>{{ trans('app_users.activation_code') }}</th>
                                    <td id="Totalinvoices"></td>
                                </tr>
                                <tr>
                                    <th>{{ trans('app_users.mobile') }}</th>
                                    <td id="pieces"></td>
                                </tr>
                                <tr>
                                    <th>{{ trans('app_users.name') }}</th>
                                    <td id="date"></td>
                                </tr>
                                <tr>
                                    <th>{{ trans('app_users.charged_balance') }}</th>
                                    <td id="Payment"></td>
                                </tr>
                                <!-- <tr>
                                    <th>Governorate</th>
                                    <td id="Governorate"></td>
                                </tr>
                                <tr>
                                    <th>Delivery time</th>
                                    <td id="Delivery_time"></td>
                                </tr>
                                <tr>
                                    <th>Customer Number</th>
                                    <td id="Customer_Number"></td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td id="Name"></td>
                                </tr>
                                <tr>
                                    <th>Mobile number</th>
                                    <td id="Mobile_number"></td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td id="Total"></td>
                                </tr>
                                <tr>
                                    <th>Device type</th>
                                    <td id="Device_type"></td>
                                </tr>
                                <tr>
                                    <th>Notes</th>
                                    <td id="Notes"></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="table-responsive hoverable-table">
                    @can('customer-view')
                    <table class="table table-hover" id="get_appUser" style=" text-align: center;">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">{{ trans('app_users.name') }}</th>
                                <th class="border-bottom-0">{{ trans('app_users.email') }}</th>
                                <th class="border-bottom-0">{{ trans('app_users.mobile') }}</th>
                                <th class="border-bottom-0">{{ trans('app_users.charged_balance') }}</th>
                                <th class="border-bottom-0">{{ trans('app_users.status') }}</th>
                                <th class="border-bottom-0">{{ trans('app_users.activation_code') }}</th>
                                <th class="border-bottom-0">
                                    @canany([ 'categories-update' , 'categories-delete' ])
                                    {{ trans('category.Processes') }}
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
<script>
var local = "{{ App::getLocale() }}";
var table = $('#get_appUser').DataTable({
    // processing: true,
    ajax: '{!! route("get_appUser") !!}',
    columns: [{
            'data': 'id',
            'className': 'text-center text-lg text-medium'
        },
        {
            'data': null,
            'className': 'text-center text-lg text-medium',
            render: function(data, row, type) {
                return data.first_name + " " + data.last_name;
            },
        },
        {
            'data': 'email',
            'className': 'text-center text-lg text-medium',
        },
        {
            'data': 'mobile_number',
        },
        {
            'data': 'credit',
        },
        {
            'data': null,
            render: function(data, row, type) {
                var phone;
                if (data.status == 'active') {
                    return `<button class="btn btn-success-gradient btn-block" id="active" data-id="${data.id}" data-viewing_status="${data.status}">{{ trans('category.Active') }}</button>`;

                } else if (data.status == 'inactive') {
                    return `<button class="btn btn-danger-gradient btn-block" id="inactive" data-id="${data.id}" data-viewing_status="${data.status}">{{ trans('category.iActive') }}</button>`;
                } else {
                    return `<button class="btn btn-warning-gradient btn-block" id="pending_activation" data-id="${data.id}" data-viewing_status="${data.status}">{{ trans('app_users.pActive') }}</button>`;
                }
            },
        },
        {
            'data': 'activation_code',
        },
        {
            'data': null,
            render: function(data, row, type) {
                return `
                <button class="btn btn-success btn-sm" id="Management" data-id="${data.id}" data-created="${data.activation_code}" data-payment="${data.mobile_number}"
                data-address="${data.first_name + " " + data.last_name}" data-delivery_type="${data.credit}"><i class="fa fa-clipboard"></i> {{ trans('orders.Details') }}</button>
                @can('customer-update')
                <button class="modal-effect btn btn-sm btn-info" id="Addcredit" data-id="${data.id}"><i class="fa fa-cogs"></i> {{ trans('app_users.Add_Credit') }}</button>
                @endcan
                @can('customer-delete')
                <button class="modal-effect btn btn-sm btn-danger" id="DeleteappUser" data-id="${data.id}"><i class="las la-trash"></i></button>
                @endcan
                
                `;
            },
            orderable: false,
            searchable: false
        },
    ],
});
$(document).on('click', '#DeleteappUser', function(e) {
    e.preventDefault();
    var id_appUser = $(this).data('id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url: '{{ url("admin/appUser/delete") }}/' + id_appUser,
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
$(document).on('click', '#active', function(e) {
    e.preventDefault();
    // console.log("Alliiiii");
    var edit_id = $(this).data('id');
    var status = $(this).data('viewing_status');
    if (status == "active") {
        status = "inactive";
    } else {
        status = "pending_activation";
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
        url: '{{ route("appuser.status") }}',
        data: data,
        success: function(response) {
            // $('#error_message').html("");
            // $('#error_message').addClass("alert alert-danger");
            // $('#error_message').text(response.message);
            table.ajax.reload();
        }
    });
});
$(document).on('click', '#pending_activation', function(e) {
    e.preventDefault();
    // console.log("Alliiiii");
    var edit_id = $(this).data('id');
    var status = $(this).data('viewing_status');
    if (status == "pending_activation") {
        status = "active";
    } else {
        status = "inactive";
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
        url: '{{ route("appuser.status") }}',
        data: data,
        success: function(response) {
            // $('#error_message').html("");
            // $('#error_message').addClass("alert alert-danger");
            // $('#error_message').text(response.message);
            table.ajax.reload();
        }
    });
});
$(document).on('click', '#inactive', function(e) {
    e.preventDefault();
    // console.log("Alliiiii");
    var edit_id = $(this).data('id');
    var status = $(this).data('viewing_status');
    if (status == "inactive") {
        status = "pending_activation";
    } else {
        status = "active";
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
        url: '{{ route("appuser.status") }}',
        data: data,
        success: function(response) {
            // $('#error_message').html("");
            // $('#error_message').addClass("alert alert-danger");
            // $('#error_message').text(response.message);
            table.ajax.reload();
        }
    });
});
$(document).on('click', '#Addcredit', function(e) {
    e.preventDefault();
    console.log("dsadsadsa");
    $('#modalAddcredit').modal('show');
    var id = $(this).data('id');
    $('#Addcredit1').click(function(e) {
        e.preventDefault();
        var data = {
            id: id,
            credit: $('#credit').val(),
            // note:$('#note').val(), 
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '{{ route("ds") }}',
            data: data,
            success: function(response) {
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-danger");
                $('#error_message').text(response.message);
                $('#modalAddcredit').modal('hide');
                table.ajax.reload();
            }
        });
    });
});
$(document).on('click', '#Management', function(e) {
    e.preventDefault();
    $('#exampleModal2').modal('show');
    var id = $(this).data('id');
    var created = $(this).data('created');
    var payment = $(this).data('payment');
    var address = $(this).data('address');
    var delivery_type = $(this).data('delivery_type');
    // var user_id = $(this).data('user_id');
    // var user_name = $(this).data('user_name');
    // var mobile_number = $(this).data('mobile_number');
    // var user_agent = $(this).data('user_agent');
    $('#Numberorders').text(id);
    $('#Totalinvoices').text(created);
    $('#pieces').text(payment);
    $('#date').text(address);
    $('#Payment').text(delivery_type);
    // $('#Customer_Number').text(user_id);
    // $('#Name').text(user_name);
    // $('#Mobile_number').text(mobile_number);
    // $('#Device_type').text(user_agent);
   
});
</script>
@endsection