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
            <h4 class="content-title mb-0 my-auto">{{ trans('orders.home') }}</h4><span
                class="text-muted mt-1 tx-13 mr-2 mb-0"> /
                {{ trans('orders.page_title') }}</span>
        </div>

    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<div id="error_message"></div>
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
                                    <th>Number of customer orders</th>
                                    <td id="Numberorders"></td>
                                </tr>
                                <tr>
                                    <th>Total customer invoices</th>
                                    <td id="Totalinvoices"></td>
                                </tr>
                                <tr>
                                    <th>number of pieces</th>
                                    <td id="pieces"></td>
                                </tr>
                                <tr>
                                    <th>date of order</th>
                                    <td id="date"></td>
                                </tr>
                                <tr>
                                    <th>Payment method</th>
                                    <td id="Payment"></td>
                                </tr>
                                <tr>
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
                                </tr>
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
@can('order-view')
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <form action="" method="get">
                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-3" id="fnWrapper">
                            <label>{{trans('orders.status')}} :</label>
                            <select class="form-control form-control-md mg-b-20" name="payment_status"
                                id="payment_status">
                                <option value="">{{ trans('orders.all') }}</option>
                                <option value="new">{{ trans('orders.new') }}</option>
                                <option value="pay_pending">{{ trans('orders.pay_pending') }}</option>
                                <option value="shipping_complete">{{ trans('orders.shipping_complete') }}</option>
                                <option value="shipping">{{ trans('orders.shipping') }}</option>
                                <option value="complete">{{ trans('orders.complete') }}</option>
                            </select>
                        </div>
                        <div class="parsley-input col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>{{trans('orders.payment_method')}} :</label>
                            <select class="form-control form-control-md mg-b-20" name="type_customer"
                                id="type_customer">
                                <option value="">{{ trans('orders.all') }}</option>
                                @foreach($payment as $payment)
                                <option value="{{ $payment->id }}">{{ $payment->title_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="parsley-input col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>{{trans('orders.phone')}} :</label>
                            <input type="number" class="form-control form-control-md mg-b-20" name="entry_status"
                                id="entry_status">
                        </div>
                        <div class="parsley-input col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>{{trans('orders.payment_status')}} :</label>
                            <select class="form-control form-control-md mg-b-20" id="cat_id" name="cat_id">
                                <option value="">{{ trans('orders.all') }}</option>
                                <option value="2">معلق للدفع</option>
                                <option value="1">تم الدفع</option>
                                <option value="3">فشل الدفع</option>
                            </select>
                        </div>
                    </div>
                </form>
                <button type="submit" class="btn btn-primary" id="s">{{ trans('orders.Sarech') }}</button>
            </div>
        </div>
    </div>
</div>
@endcan
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="table-responsive hoverable-table">
                @can('order-view')
                    <table class="table table-hover" id="get_categories" style=" text-align: center;">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">{{ trans('orders.name') }}</th>
                                <th class="border-bottom-0">{{ trans('orders.status') }}</th>
                                <th class="border-bottom-0">{{ trans('orders.payment') }}</th>
                                <th class="border-bottom-0">{{ trans('orders.total') }}</th>
                                <th class="border-bottom-0">         
                                @canany([ 'order-view' , 'order-delete' ])
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
$('#s').click(function(e) {
    e.preventDefault();
    console.log('asadlasd');
    var payment_status = $('#payment_status').val();
    var type_customer = $('#type_customer').val();
    var entry_status = $('#entry_status').val();
    var cat_id = $('#cat_id').val();

    $('#get_categories').DataTable({
        bDestroy: true,
        ajax: {
            url: '{{url("admin/orders/flters")}}/?payment_status=' + payment_status +
                '&type_customer=' + type_customer + '&entry_status=' + entry_status + '&cat_id=' +
                cat_id,
            cache: true
        },
        columns: [{
                'data': 'id',
                'className': 'text-center text-lg text-medium'
            },
            {
                'data': null,
                'className': 'text-center text-lg text-medium',
                render: function(data, row, type) {
                    return data.user.first_name + " " + data.user.last_name;
                },
            },
            {
                'data': null,
                'className': 'text-center text-lg text-medium',
                render: function(row, data, type) {
                    if (row.status == 'new') {
                        return `<button class="btn btn-purple-gradient btn-block" id="status" data-id="${row.id}" data-viewing_status="${row.status}">{{ trans('orders.new') }}</button>`;
                    } else if (row.status == 'pay_pending') {
                        return `<button class="btn btn-primary-gradient btn-block" id="status" data-id="${row.id}" data-viewing_status="${row.status}">{{ trans('orders.pay_pending') }}</button>`;
                    } else if (row.status == 'shipping') {
                        return `<button class="btn btn-success-gradient btn-block" id="status" data-id="${row.id}" data-viewing_status="${row.status}">{{ trans('orders.shipping') }}</button>`;
                    } else if (row.status == 'shipping_complete') {
                        return `<button class="btn btn-info-gradient btn-block" id="status" data-id="${row.id}" data-viewing_status="${row.status}">{{ trans('orders.shipping_complete') }}</button>`;
                    } else if (row.status == 'complete') {
                        return `<button class="btn btn-success-gradient btn-block" id="status" data-id="${row.id}" data-viewing_status="${row.status}">{{ trans('orders.complete') }}</button>`;
                    } else {
                        return '';
                    }
                },
            },
            {
                'data': 'payment.title_en',
            },
            {
                'data': 'total_cost',
            },
            {
                'data': null,
                render: function(data, row, type) {
                    return `
                @can('order-view')
                <button class="btn btn-success btn-sm" id="Management" data-id="${data.id}" data-created="${data.created_at}" data-payment="${data.payment.title_en}"
                data-address="${data.address.address}" data-delivery_type="${data.delivery_type_title.title_ar}" data-user_id="${data.user.id}"
                data-user_name="${data.user.first_name + " " + data.user.last_name}"
                data-mobile_number="${data.user.mobile_number}" data-user_agent="${data.user_agent}"><i class="fa fa-clipboard"></i> {{ trans('orders.Details') }}</button>
                @endcan
                <button class="btn btn-success btn-sm" id="Request_Accept" data-id="${data.id}" data-status="${data.status}"><i class="las la-clipboard"> {{ trans('orders.Request_Accept') }} </i></button>
                <button class="btn btn-success btn-sm" id="charged" data-id="${data.id}" data-status="${data.status}"><i class="las la-clipboard"> {{ trans('orders.Charged') }} </i></button>
                <button class="btn btn-success btn-sm" id="Receipt_confirmed" data-id="${data.id}" data-status="${data.status}"><i class="las la-clipboard">  {{ trans('orders.Receipt confirmed') }}</i></button>
                @can('order-delete')
                <button class="modal-effect btn btn-sm btn-danger" id="DeleteCategory" data-id="${data.id}"><i class="las la-trash"></i></button>
                @endcan
                `;
                },
                orderable: false,
                searchable: false
            },
        ],
    });
    $('#get_categories').addClass('col-sm-12');
});
var table = $('#get_categories').DataTable({
    // processing: true,
    ajax: {
        url: '{{ url("admin/orders/flters") }}',
        cache: true
    },
    columns: [{
            'data': 'id',
            'className': 'text-center text-lg text-medium'
        },
        {
            'data': null,
            'className': 'text-center text-lg text-medium',
            render: function(data, row, type) {
                return data.user.first_name + " " + data.user.last_name;
            },
        },
        {
            'data': null,
            'className': 'text-center text-lg text-medium',
            render: function(row, data, type) {
                if (row.status == 'new') {
                    return `<button class="btn btn-purple-gradient btn-block" id="status" data-id="${row.id}" data-viewing_status="${row.status}">{{ trans('orders.new') }}</button>`;
                } else if (row.status == 'pay_pending') {
                    return `<button class="btn btn-primary-gradient btn-block" id="status" data-id="${row.id}" data-viewing_status="${row.status}">{{ trans('orders.pay_pending') }}</button>`;
                } else if (row.status == 'shipping') {
                    return `<button class="btn btn-success-gradient btn-block" id="status" data-id="${row.id}" data-viewing_status="${row.status}">{{ trans('orders.shipping') }}</button>`;
                } else if (row.status == 'shipping_complete') {
                    return `<button class="btn btn-info-gradient btn-block" id="status" data-id="${row.id}" data-viewing_status="${row.status}">{{ trans('orders.shipping_complete') }}</button>`;
                } else if (row.status == 'complete') {
                    return `<button class="btn btn-success-gradient btn-block" id="status" data-id="${row.id}" data-viewing_status="${row.status}">{{ trans('orders.complete') }}</button>`;
                } else {
                    return '';
                }
            },
        },
        {
            'data': 'payment.title_en',
        },
        {
            'data': 'total_cost',
        },
        {
            'data': null,
            render: function(data, row, type) {
                return `
                @can('order-view')
                <button class="btn btn-success btn-sm" id="Management" data-id="${data.id}" data-created="${data.created_at}" data-payment="${data.payment.title_en}"
                data-address="${data.address.address}" data-delivery_type="${data.delivery_type_title.title_ar}" data-user_id="${data.user.id}"
                data-user_name="${data.user.first_name + " " + data.user.last_name}"
                data-mobile_number="${data.user.mobile_number}" data-user_agent="${data.user_agent}"><i class="fa fa-clipboard"></i> {{ trans('orders.Details') }}</button>
                @endcan
                <button class="btn btn-success btn-sm" id="Request_Accept" data-id="${data.id}" data-status="${data.status}"><i class="las la-clipboard"> {{ trans('orders.Request_Accept') }} </i></button>
                <button class="btn btn-success btn-sm" id="charged" data-id="${data.id}" data-status="${data.status}"><i class="las la-clipboard"> {{ trans('orders.Charged') }} </i></button>
                <button class="btn btn-success btn-sm" id="Receipt_confirmed" data-id="${data.id}" data-status="${data.status}"><i class="las la-clipboard">  {{ trans('orders.Receipt confirmed') }}</i></button>
                @can('order-delete')
                <button class="modal-effect btn btn-sm btn-danger" id="DeleteCategory" data-id="${data.id}"><i class="las la-trash"></i></button>
                @endcan
                `;
            },
            orderable: false,
            searchable: false
        },
    ],
});
$(document).on('click', '#DeleteCategory', function(e) {
    e.preventDefault();
    var id_category = $(this).data('id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url: '{{ url("admin/orders/delete") }}/' + id_category,
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
        url: '{{ route("update.status") }}',
        data: data,
        success: function(response) {
            $('#error_message').html("");
            $('#error_message').addClass("alert alert-danger");
            $('#error_message').text(response.message);
            table.ajax.reload();
        }
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
    var user_id = $(this).data('user_id');
    var user_name = $(this).data('user_name');
    var mobile_number = $(this).data('mobile_number');
    var user_agent = $(this).data('user_agent');
    $('#Numberorders').text(id);
    $('#date').text(created);
    $('#Payment').text(payment);
    $('#Governorate').text(address);
    $('#Delivery_time').text(delivery_type);
    $('#Customer_Number').text(user_id);
    $('#Name').text(user_name);
    $('#Mobile_number').text(mobile_number);
    $('#Device_type').text(user_agent);

});
$(document).on('click', '#Request_Accept', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var status = $(this).data('status');
    var data = {
        id:id,
        status:status
    };
    console.log(data);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '{{ url("order/update/status") }}',
        data: data,
        success: function(response) {
            $('#error_message').html("");
            $('#error_message').addClass("alert alert-danger");
            $('#error_message').text(response.message);
            table.ajax.reload();
        }
    });
});
$(document).on('click', '#charged', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var status = $(this).data('status');
    var data = {
        id:id,
        status:status
    };
    console.log(data);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '{{ url("order2/update/status") }}',
        data: data,
        success: function(response) {
            $('#error_message').html("");
            $('#error_message').addClass("alert alert-danger");
            $('#error_message').text(response.message);
            table.ajax.reload();
        }
    });
});
$(document).on('click', '#Receipt_confirmed', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var status = $(this).data('status');
    var data = {
        id:id,
        status:status
    };
    console.log(data);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '{{ url("order3/update/status") }}',
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