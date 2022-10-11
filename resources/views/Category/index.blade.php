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
<div class="modal" id="modalAddCategory">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Categories</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="formcategory" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Category Title Einglish :</label>
                            <input type="text" class="form-control" name="title_en" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Category Title Arabic :</label>
                            <input type="text" class="form-control" name="title_ar" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Category Description Einglish :</label>
                            <textarea class="form-control" name="description_en" rows="3" required></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Category Description Arabic :</label>
                            <textarea class="form-control" name="description_ar" rows="3" required></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Category Image :</label>
                            <input type="file" class="form-control" name="image" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label"> Category Status :</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success AddCategory" id="AddCategory">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->
<div class="modal" id="modalEditCategory">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Categories</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="formeditadmin" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="id_category">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Category Title Einglish :</label>
                            <input type="text" class="form-control" id="title_en" name="title_en" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Category Title Arabic :</label>
                            <input type="text" class="form-control" id="title_ar" name="title_ar" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Category Description Einglish :</label>
                            <textarea class="form-control" id="description_en" name="description_en" rows="3"
                                required></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Category Description Arabic :</label>
                            <textarea class="form-control" id="description_ar" name="description_ar" rows="3"
                                required></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Category Image :</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label"> Category Status :</label>
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
        ajax: '{!! route("get_categories") !!}',
        columns: [{
                'data': 'id',
                'className': 'text-center text-lg text-medium'
            },
            {
                'data': null,
                'className': 'text-center text-lg text-medium',
                render: function(data, row, type) {
                    if (local == "en") {
                        return `<a href ="{{ url('admin/clothes/') }}/${data.id}">${data.title_en}</a>`;
                    } else {
                        return data.title_ar;
                    }
                },
            },
            {
                'data': null,
                'className': 'text-center text-lg text-medium',
                render: function(data, row, type) {
                    if (local == "en") {
                        return data.description_en;
                    } else {
                        return data.description_ar;
                    }
                },
            },
            {
                'data': null,
                render: function(data, row, type) {
                    if (data.image) {
                        return `<img 
                        src="${data.image}"
                                        style="width: 40px;height: 40px">`;
                    } else {
                        return "No Image";
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
                    return `<button class="modal-effect btn btn-sm btn-info" id="ShowModalEditCategory" data-id="${data.id}"><i class="las la-pen"></i></button>
                                <button class="modal-effect btn btn-sm btn-danger" id="DeleteCategory" data-id="${data.id}"><i class="las la-trash"></i></button>`;
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
</script>
@endsection