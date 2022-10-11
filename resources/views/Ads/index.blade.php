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
                Ads</span>
        </div>

    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<div id="error_message"></div>
<div class="modal" id="modalAddAds">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Ads</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="formAds" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Ads url :</label>
                            <input type="text" class="form-control" name="url" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Ads lauout title :</label>
                            <input type="text" class="form-control" name="lauout_title" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Ads layout :</label>
                            <input type="number" class="form-control" name="layout" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Ads days :</label>
                            <input type="number" class="form-control" name="days" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Ads cost :</label>
                            <input type="number" class="form-control" name="cost" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Ads Image :</label>
                            <input type="file" class="form-control" name="image" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label"> Ads Category :</label>
                            <select name="cat_id" class="form-control">
                                @foreach($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->title_en }}</option>
                                @endforeach
                                </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label"> Ads prodect :</label>
                            <select name="product_id" class="form-control">
                                @foreach($prodect as $prodect)
                                    <option value="{{ $prodect->id }}">{{ $prodect->title_en }}</option>
                                @endforeach
                                </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label"> Ads Status :</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success AddAds" id="AddAds">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->
<div class="modal" id="modalEditAds">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Ads</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="formeditadmin" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="id_Ads">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Ads url :</label>
                            <input type="text" class="form-control" name="url" id="url" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Ads lauout title :</label>
                            <input type="text" class="form-control" name="lauout_title" id="lauout_title" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Ads layout :</label>
                            <input type="number" class="form-control" name="layout" id="layout" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Ads days :</label>
                            <input type="number" class="form-control" name="days" id="days" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Ads cost :</label>
                            <input type="number" class="form-control" name="cost" id="cost" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Ads Image :</label>
                            <input type="file" class="form-control" name="image" id="image" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label"> Ads Category :</label>
                            <select name="cat_id" id="cat_id" class="form-control">
                                @foreach($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->title_en }}</option>
                                @endforeach
                                </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label"> Ads prodect :</label>
                            <select name="product_id" id="product_id" class="form-control">
                                @foreach($prodec as $prodect)
                                    <option value="{{ $prodect->id }}">{{ $prodect->title_en  }}</option>
                                @endforeach
                                </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label"> Ads Status :</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select>
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
                        <button class="btn btn-info-gradient btn-block" id="ShowModalAddAds">
                            <a href="#" style="font-weight: bold; color: beige;">Add Ads</a>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive hoverable-table">
                    <table class="table table-hover" id="get_Ads" style=" text-align: center;">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">Url</th>
                                <th class="border-bottom-0">Place of Ads</th>
                                <th class="border-bottom-0">number of days</th>
                                <th class="border-bottom-0">Today's cost</th>
                                <th class="border-bottom-0">status</th>
                                <th class="border-bottom-0">Created_at</th>
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
    var table = $('#get_Ads').DataTable({
        // processing: true,
        ajax: '{!! route("get_ads") !!}',
        columns: [
            {
                'data': 'id',
                'className': 'text-center text-lg text-medium'
            },
            {
                'data': 'url',
                'className': 'text-center text-lg text-medium'
            },
            {
                'data': 'lauout_title',
                'className': 'text-center text-lg text-medium'
            },
            {
                'data': 'days',
                'className': 'text-center text-lg text-medium'
            },
            {
                'data': 'cost',
                'className': 'text-center text-lg text-medium'
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
                'data': 'created_at',
                'className': 'text-center text-lg text-medium'
            },
            {
                'data': null,
                render: function(data, row, type) {
                    return `<button class="modal-effect btn btn-sm btn-info" id="ShowModalEditAds" data-id="${data.id}"><i class="las la-pen"></i></button>
                                <button class="modal-effect btn btn-sm btn-danger" id="DeleteAds" data-id="${data.id}"><i class="las la-trash"></i></button>`;
                },
                orderable: false,
                searchable: false
            },
        ],
    });
    //  view modal Ads
    $(document).on('click', '#ShowModalAddAds', function(e) {
        e.preventDefault();
        $('#modalAddAds').modal('show');
    });
    // // Ads admin
    $(document).on('click', '.AddAds', function(e) {
        e.preventDefault();
        let formdata = new FormData($('#formAds')[0]);
        // console.log(formdata);
        // console.log("formdata");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '{{ route("add_ads") }}',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(response) {
                // console.log("Done");
                $('#AddAds').text('Saving');
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-info");
                $('#error_message').text(response.message);
                $('#modalAddAds').modal('hide');
                $('#formAds')[0].reset();
                table.ajax.reload();
            }
        });
    });
    // // view modification data
    $(document).on('click', '#ShowModalEditAds', function(e) {
        e.preventDefault();
        var id_Ads = $(this).data('id');
        $('#modalEditAds').modal('show');
        $.ajax({
            type: 'GET',
            url: '{{ url("admin/ads/edit") }}/' + id_Ads,
            data: "",
            success: function(response) {
                console.log(response);
                if (response.status == 404) {
                    console.log('error');
                    $('#error_message').html("");
                    $('#error_message').addClass("alert alert-danger");
                    $('#error_message').text(response.message);
                } else {
                    $('#id_Ads').val(id_Ads);
                    $('#url').val(response.data.url);
                    $('#layout').val(response.data.layout);
                    $('#lauout_title').val(response.data.lauout_title);
                    $('#days').val(response.data.days);
                    $('#cost').val(response.data.cost);
                    $('#image').val(response.data.image);
                }
            }
        });
    });
    $(document).on('click', '#EditClient', function(e) {
        e.preventDefault();
        var data = {
            url: $('#url').val(),
            layout: $('#layout').val(),
            lauout_title: $('#lauout_title').val(),
            days: $('#days').val(),
            cost: $('#cost').val(),
            image: $('#image').val(),
            status: $('#status').val(),
            cat_id : $('#cat_id ').val(),
            product_id  : $('#product_id  ').val(),
        };
        // let formdata = new FormData($('#formeditadmin')[0]);
        var id_Ads = $('#id_Ads').val();
        console.log(data);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '{{ url("admin/ads/update") }}/' + id_Ads,
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
                    $('#modalEditAds').modal('hide');
                    table.ajax.reload();
                }
            }
        });
    });
    $(document).on('click', '#DeleteAds', function(e) {
        e.preventDefault();
        var id_Ads = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'DELETE',
            url: '{{ url("admin/ads/delete") }}/' + id_Ads,
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