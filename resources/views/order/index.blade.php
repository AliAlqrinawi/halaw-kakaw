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
            <h4 class="content-title mb-0 my-auto">Home</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> /
                Categories</span>
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
<div class="row">


    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="row row-xs wd-xl-80p">
                    <div class="col-sm-6 col-md-3 mg-t-10">
                        <button class="btn btn-info-gradient btn-block" id="ShowModalAddCategory">
                            <a href="#" style="font-weight: bold; color: beige;">Add Category</a>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive hoverable-table">
                    <table class="table table-hover" id="get_categories" style=" text-align: center;">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">Title</th>
                                <th class="border-bottom-0">Description</th>
                                <th class="border-bottom-0">Image</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Processes</th>
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
<script>
var local = "{{ App::getLocale() }}";
var table = $('#get_categories').DataTable({
    // processing: true,
    ajax: '{!! route("get_orders") !!}',
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
                    return `<button class="btn btn-purple-gradient btn-block" id="status" data-id="${row.id}" data-viewing_status="${row.status}">${row.status}</button>`;
                } else if (row.status == 'pay_pending') {
                    return `<button class="btn btn-primary-gradient btn-block" id="status" data-id="${row.id}" data-viewing_status="${row.status}">${row.status}</button>`;
                } else if (row.status == 'shipping') {
                    return `<button class="btn btn-success-gradient btn-block" id="status" data-id="${row.id}" data-viewing_status="${row.status}">${row.status}</button>`;
                } else if (row.status == 'shipping_complete') {
                    return `<button class="btn btn-info-gradient btn-block" id="status" data-id="${row.id}" data-viewing_status="${row.status}">${row.status}</button>`;
                } else if (row.status == 'complete') {
                    return `<button class="btn btn-danger-gradient btn-block" id="status" data-id="${row.id}" data-viewing_status="${row.status}">${row.status}</button>`;
                    return "<span class='btn btn-danger-gradient btn-block' >تم تاكيد الاستلام</span>";
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
                <button class="btn btn-success btn-sm" id="Management" data-id="${data.id}" data-created="${data.created_at}" data-payment="${data.payment.title_en}"
                data-address="${data.address.address}" data-delivery_type="${data.delivery_type_title.title_ar}" data-user_id="${data.user.id}"
                data-user_name="${data.user.first_name + " " + data.user.last_name}"
                data-mobile_number="${data.user.mobile_number}" data-user_agent="${data.user_agent}"><i class="fa fa-clipboard"></i> Details</button>
                <button class="modal-effect btn btn-sm btn-info" id="ShowModalEditCategory" data-id="${data.id}"><i class="las la-pen"></i></button>
                <button class="modal-effect btn btn-sm btn-danger" id="DeleteCategory" data-id="${data.id}"><i class="las la-trash"></i></button>
`;
            },
            orderable: false,
            searchable: false
        },
    ],
});
//  view modal Category
$(document).on('click', '#ShowModalAddCategory', function(e) {
    e.preventDefault();
    $('#modalAddCategory').modal('show');
});
// Category admin
$(document).on('click', '.AddCategory', function(e) {
    e.preventDefault();
    let formdata = new FormData($('#formcategory')[0]);
    // console.log(formdata);
    // console.log("formdata");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '{{ route("add_category") }}',
        data: formdata,
        contentType: false,
        processData: false,
        success: function(response) {
            // console.log("Done");
            $('#AddCategory').text('Saving');
            $('#error_message').html("");
            $('#error_message').addClass("alert alert-info");
            $('#error_message').text(response.message);
            $('#modalAddCategory').modal('hide');
            $('#formcategory')[0].reset();
            table.ajax.reload();
        }
    });
});
// view modification data
$(document).on('click', '#ShowModalEditCategory', function(e) {
    e.preventDefault();
    var id_category = $(this).data('id');
    $('#modalEditCategory').modal('show');
    $.ajax({
        type: 'GET',
        url: '{{ url("admin/category/edit") }}/' + id_category,
        data: "",
        success: function(response) {
            console.log(response);
            if (response.status == 404) {
                console.log('error');
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-danger");
                $('#error_message').text(response.message);
            } else {
                $('#id_category').val(id_category);
                $('#title_en').val(response.data.title_en);
                $('#title_ar').val(response.data.title_ar);
                $('#description_en').val(response.data.description_en);
                $('#description_ar').val(response.data.description_ar);
                if (response.data.status == '1') {
                    $("select option[value='1']").attr("selected", "selected");
                } else {
                    $("select option[value='0']").attr("selected", "selected");
                }
            }
        }
    });
});
$(document).on('click', '#EditClient', function(e) {
    e.preventDefault();
    var data = {
        title_en: $('#title_en').val(),
        title_ar: $('#title_ar').val(),
        description_en: $('#description_en').val(),
        description_ar: $('#description_ar').val(),
        image: $('#image').val(),
        status: $('#status').val(),
    };
    // let formdata = new FormData($('#formeditadmin')[0]);
    var id_category = $('#id_category').val();
    console.log(data);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '{{ url("admin/category/update") }}/' + id_category,
        data: data,
        dataType: false,
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
                $('#modalEditCategory').modal('hide');
                table.ajax.reload();
            }
        }
    });
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
        url: '{{ url("admin/category/delete") }}/' + id_category,
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

$(document).on('click'  , '#Management' , function(e){
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
</script>

@endsection
