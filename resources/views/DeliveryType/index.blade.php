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
                Governorates</span>
        </div>

    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<div id="error_message"></div>
<div class="modal" id="modalAddGovernorat">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Governorates</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="formGovernorat" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Worktime :</label>
                            <input type="text" class="form-control" name="title_en" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">English working hours :</label>
                            <input type="text" class="form-control" name="title_ar" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">time_from :</label>
                            <input type="time" class="form-control" name="time_from">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">time_to :</label>
                            <input type="time" class="form-control" name="time_to">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="checkbox"  name="sat" value="1">
                            <label for="sat">sat</label>

                            <input type="checkbox"  name="sun" value="1">
                            <label for="sun">sun</label>


                            <input type="checkbox" name="mon" value="1">
                            <label for="mon">mon</label>


                            <input type="checkbox" name="tue" value="1">
                            <label for="tue">tue</label>


                            <input type="checkbox" name="wed" value="1">
                            <label for="wed">wed</label>


                            <input type="checkbox" name="thu" value="1">
                            <label for="thu">thu</label>


                            <input type="checkbox" name="fri" value="1">
                            <label for="fri">fri</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success AddGovernorat" id="AddGovernorat">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->
<div class="modal" id="modalEditGovernorat">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Governorates</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="ali" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="id_Governorat">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Worktime :</label>
                            <input type="text" class="form-control" name="title_en" id="title_en" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">English working hours :</label>
                            <input type="text" class="form-control" name="title_ar" id="title_ar" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">time_from :</label>
                            <input type="time" class="form-control" id="time_from" name="time_from">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">time_to :</label>
                            <input type="time" class="form-control" id="time_to" name="time_to">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="checkbox" id="sat" name="sat"  value="1">
                            <label for="sat">sat</label>

                            <input type="checkbox" id="sun" name="sun"  value="1">
                            <label for="sun">sun</label>


                            <input type="checkbox" id="mon" name="mon" value="1">
                            <label for="mon">mon</label>


                            <input type="checkbox" id="tue" name="tue" value="1">
                            <label for="tue">tue</label>


                            <input type="checkbox" id="wed" name="wed" value="1">
                            <label for="wed">wed</label>


                            <input type="checkbox" id="thu" name="thu" value="1">
                            <label for="thu">thu</label>


                            <input type="checkbox" id="fri" name="fri" value="1">
                            <label for="fri">fri</label>
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
                        <button class="btn btn-info-gradient btn-block" id="ShowModalAddGovernorat">
                            <a href="#" style="font-weight: bold; color: beige;">Add Governorat</a>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive hoverable-table">
                    <table class="table table-hover" id="get_Governorates" style=" text-align: center;">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">Name</th>
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
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
<script>
var local = "{{ App::getLocale() }}";
var table = $('#get_Governorates').DataTable({
    // processing: true,
    ajax: '{!! route("get_deliveryTypes") !!}',
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
                    return `<button class="btn btn-success-gradient btn-block">Active</button>`;
                } else {
                    return `<button class="btn btn-danger-gradient btn-block">Not Active</button>`;
                }
            },
        },
        {
            'data': null,
            render: function(data, row, type) {
                return `
                <a class="btn btn-sm btn-success" href="{{ url('admin/city') }}/${data.id}"><i class="fa fa-bars"></i> Cities</a>
                <button class="modal-effect btn btn-sm btn-info" id="ShowModalEditGovernorat" data-id="${data.id}"><i class="las la-pen"></i></button>
                <button class="modal-effect btn btn-sm btn-danger" id="DeleteGovernorat" data-id="${data.id}"><i class="las la-trash"></i></button>
                        `;
            },
            orderable: false,
            searchable: false
        },
    ],
});
//  view modal Governorat
$(document).on('click', '#ShowModalAddGovernorat', function(e) {
    e.preventDefault();
    $('#modalAddGovernorat').modal('show');
});
// Governorat admin
$(document).on('click', '.AddGovernorat', function(e) {
    e.preventDefault();
    let formdata = new FormData($('#formGovernorat')[0]);
    // console.log(formdata);
    // console.log("formdata");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '{{ route("add_deliveryTypes") }}',
        data: formdata,
        contentType: false,
        processData: false,
        success: function(response) {
            // console.log("Done");
            $('#AddGovernorat').text('Saving');
            $('#error_message').html("");
            $('#error_message').addClass("alert alert-info");
            $('#error_message').text(response.message);
            $('#modalAddGovernorat').modal('hide');
            $('#formGovernorat')[0].reset();
            table.ajax.reload();
        }
    });
});
// view modification data
$(document).on('click', '#ShowModalEditGovernorat', function(e) {
    e.preventDefault();
    var id_Governorat = $(this).data('id');
    $('#modalEditGovernorat').modal('show');
    $.ajax({
        type: 'GET',
        url: '{{ url("admin/deliveryTypes/edit") }}/' + id_Governorat,
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
                $('#id_Governorat').val(id_Governorat);
                $('#title_en').val(response.data.title_en);
                $('#title_ar').val(response.data.title_ar);
                $('#time_from').val(response.data.time_from);
                $('#time_to').val(response.data.time_to);
                if(response.data.sat == 1){
                    $('#sat').attr('checked' , 'checked');
                }else{
                    $('#sat').removeAttr('checked');
                }
                if(response.data.sun == 1){
                    $('#sun').attr('checked' , 'checked');
                }else{
                    $('#sun').removeAttr('checked');
                }
                if(response.data.mon == 1){
                    $('#mon').attr('checked' , 'checked');
                }else{
                    $('#mon').removeAttr('checked');
                }
                if(response.data.tue == 1){
                    $('#tue').attr('checked' , 'checked');
                }else{
                    $('#tue').removeAttr('checked');
                }
                if(response.data.wed == 1){
                    $('#wed').attr('checked' , 'checked');
                }else{
                    $('#wed').removeAttr('checked');
                }
                if(response.data.thu == 1){
                    $('#thu').attr('checked' , 'checked');
                }else{
                    $('#thu').removeAttr('checked');
                }
                if(response.data.fri == 1){
                    $('#fri').attr('checked' , 'checked');
                }else{
                    $('#fri').removeAttr('checked');
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
        time_from: $('#time_from').val(),
        time_to: $('#time_to').val(),
        sat: $('#sat').val(),
        sun: $('#sun').val(),
        mon: $('#mon').val(),
        tue: $('#tue').val(),
        wed: $('#wed').val(),
        thu: $('#thu').val(),
        fri: $('#fri').val(),
    };
    // let formdata = new FormData($('#formeditadmin')[0]);
    var id_Governorat = $('#id_Governorat').val();
    console.log(data);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '{{ url("admin/deliveryTypes/update") }}/' + id_Governorat,
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
                $('#modalEditGovernorat').modal('hide');
                table.ajax.reload();
            }
        }
    });
});
$(document).on('click', '#DeleteGovernorat', function(e) {
    e.preventDefault();
    var id_Governorat = $(this).data('id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url: '{{ url("admin/countries/delete") }}/' + id_Governorat,
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