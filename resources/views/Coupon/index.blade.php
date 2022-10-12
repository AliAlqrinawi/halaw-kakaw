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
                Coupons</span>
        </div>

    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<div id="error_message"></div>
<div class="modal" id="modalAddCoupon">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Coupons</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="formCoupon" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Code :</label>
                            <input type="text" class="form-control" name="code" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Count Number :</label>
                            <input type="text" class="form-control" name="count_number" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Code Limit :</label>
                            <input type="text" class="form-control" name="code_limit" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Code Max :</label>
                            <input type="text" class="form-control" name="code_max" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">End At :</label>
                            <input type="datetime-local" class="form-control" name="end_at" required>
                        </div>
                        <div class="form-group col-md-12">
                            <!-- <label class="form-label"> Coupon Status :</label>
                            <select name="type" class="form-control">
                                <option value="1">Fixed Amount</option>
                                <option value="0">Percent</option>
                            </select> -->
                            <label class="col-sm-5"> Fixed Amount : <input type="radio" name="type" value="1"
                                    required></label>

                            <label class="col-sm-5"> Percent : <input type="radio" name="type" value="0"
                                    required></label>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="col-sm-5"> Active : <input type="radio" name="status" value="1"
                                    required></label>

                            <label class="col-sm-5"> Not Active : <input type="radio" name="status" value="0"
                                    required></label>

                            <!-- <label > Not Active :</label>
                            <input type="radio" name="status" value="0" required> -->

                            <!-- <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select> -->
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Discount :</label>
                            <input type="text" class="form-control" name="discount" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success AddCoupon" id="AddCoupon">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->
<div class="modal" id="modalEditCoupon">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Coupons</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="formeditadmin" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="id_Coupon">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Code :</label>
                            <input type="text" class="form-control" name="code" id="code" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Count Number :</label>
                            <input type="text" class="form-control" name="count_number" id="count_number" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Code Limit :</label>
                            <input type="text" class="form-control" name="code_limit" id="code_limit" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Code Max :</label>
                            <input type="text" class="form-control" name="code_max" id="code_max" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">End At :</label>
                            <input type="datetime-local" class="form-control" name="end_at" id="end_at" required>
                        </div>
                        <div class="form-group col-md-12">
                            <!-- <label class="form-label"> Coupon Status :</label>
                            <select name="type" class="form-control">
                                <option value="1">Fixed Amount</option>
                                <option value="0">Percent</option>
                            </select> -->
                            <label class="col-sm-5"> Fixed Amount : <input type="radio" class="type" name="type"
                                    id="type1" value="1" required></label>

                            <label class="col-sm-5"> Percent : <input type="radio" class="type" name="type" id="type2"
                                    value="0" required></label>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="col-sm-5"> Active : <input type="radio" class="status" name="status"
                                    id="status1" value="1" required></label>

                            <label class="col-sm-5"> Not Active : <input type="radio" class="status" name="status"
                                    id="status2" value="0" required></label>

                            <!-- <label > Not Active :</label>
                            <input type="radio" name="status" value="0" required> -->

                            <!-- <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select> -->
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Discount :</label>
                            <input type="text" class="form-control" name="discount" id="discount" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="EditClient">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                        <button class="btn btn-info-gradient btn-block" id="ShowModalAddCoupon">
                            <a href="#" style="font-weight: bold; color: beige;">Add Coupon</a>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive hoverable-table">
                    <table class="table table-hover" id="get_Coupons" style=" text-align: center;">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">Code</th>
                                <th class="border-bottom-0">Discount</th>
                                <th class="border-bottom-0">Percent</th>
                                <th class="border-bottom-0">Limit</th>
                                <th class="border-bottom-0">Max</th>
                                <th class="border-bottom-0">Use Number</th>
                                <th class="border-bottom-0">Was Use Number</th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Prosess</th>
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
var table = $('#get_Coupons').DataTable({
    // processing: true,
    ajax: '{!! route("get_coupons") !!}',
    columns: [{
            'data': 'id',
            'className': 'text-center text-lg text-medium'
        },
        {
            'data': 'code',
            'className': 'text-center text-lg text-medium',
        },
        {
            'data': 'discount',
            'className': 'text-center text-lg text-medium',
        },
        {
            'data': 'percent',
            'className': 'text-center text-lg text-medium',
        },
        {
            'data': 'code_limit',
            'className': 'text-center text-lg text-medium',
        },
        {
            'data': 'code_max',
            'className': 'text-center text-lg text-medium',
        },
        {
            'data': 'count_number',
            'className': 'text-center text-lg text-medium',
        },
        {
            'data': 'use_number',
            'className': 'text-center text-lg text-medium',
        },
        {
            'data': 'end_at',
            'className': 'text-center text-lg text-medium',
        },
        {
            'data': null,
            render: function(data, row, type) {
                var phone;
                if (data.status == '1') {
                    return `<button class="btn btn-success-gradient btn-block">Active</button>`;
                } else {
                    return `<button class="btn btn-danger-gradient btn-block">Not Active</button>`;
                }
            },
        },
        {
            'data': null,
            render: function(data, row, type) {
                return `<button class="modal-effect btn btn-sm btn-info" id="ShowModalEditCoupon" data-id="${data.id}"><i class="las la-pen"></i></button>
                                <button class="modal-effect btn btn-sm btn-danger" id="DeleteCoupon" data-id="${data.id}"><i class="las la-trash"></i></button>`;
            },
            orderable: false,
            searchable: false
        },
    ],
});
//  view modal Coupon
$(document).on('click', '#ShowModalAddCoupon', function(e) {
    e.preventDefault();
    $('#modalAddCoupon').modal('show');
});
// Coupon admin
$(document).on('click', '.AddCoupon', function(e) {
    e.preventDefault();
    let formdata = new FormData($('#formCoupon')[0]);
    // console.log(formdata);
    // console.log("formdata");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '{{ route("add_coupons") }}',
        data: formdata,
        contentType: false,
        processData: false,
        success: function(response) {
            // console.log("Done");
            $('#AddCoupon').text('Saving');
            $('#error_message').html("");
            $('#error_message').addClass("alert alert-info");
            $('#error_message').text(response.message);
            $('#modalAddCoupon').modal('hide');
            $('#formCoupon')[0].reset();
            table.ajax.reload();
        }
    });
});
// view modification data
$(document).on('click', '#ShowModalEditCoupon', function(e) {
    e.preventDefault();
    var id_Coupon = $(this).data('id');
    $('#modalEditCoupon').modal('show');
    $.ajax({
        type: 'GET',
        url: '{{ url("admin/coupons/edit") }}/' + id_Coupon,
        data: "",
        success: function(response) {
            console.log(response);
            if (response.status == 404) {
                console.log('error');
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-danger");
                $('#error_message').text(response.message);
            } else {
                $('#id_Coupon').val(id_Coupon);
                $('#code').val(response.data.code);
                $('#count_number').val(response.data.count_number);
                $('#percent').val(response.data.percent);
                $('#code_limit').val(response.data.code_limit);
                $('#code_max').val(response.data.code_max);
                $('#end_at').val(response.data.end_at);
                if (response.data.type == '1') {
                    $("#type1").attr("checked", "checked");
                    $('#discount').val(response.data.discount);
                } else {
                    $("#type2").attr("checked", "checked");
                    $('#discount').val(response.data.percent);
                }
                if (response.data.status == '1') {
                    $("#status1").attr("checked", "checked");
                } else {
                    $("#status2").attr("checked", "checked");
                }
            }
        }
    });
});
$(document).on('click', '#EditClient', function(e) {
    e.preventDefault();
    var data = {
        code: $('#code').val(),
        count_number: $('#count_number').val(),
        percent: $('#percent').val(),
        code_limit: $('#code_limit').val(),
        code_max: $('#code_max').val(),
        end_at: $('#end_at').val(),
        status: $('.status').val(),
        status: $('.type').val(),
        discount: $('#discount').val()
    };
    // let formdata = new FormData($('#formeditadmin')[0]);
    var id_Coupon = $('#id_Coupon').val();
    console.log(data);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '{{ url("admin/coupons/update") }}/' + id_Coupon,
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
                $('#modalEditCoupon').modal('hide');
                table.ajax.reload();
            }
        }
    });
});
$(document).on('click', '#DeleteCoupon', function(e) {
    e.preventDefault();
    var id_Coupon = $(this).data('id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url: '{{ url("dashbord/Coupon/delete") }}/' + id_Coupon,
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
</script>
@endsection