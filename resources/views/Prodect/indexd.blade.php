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
            <h4 class="content-title mb-0 my-auto">{{ trans('clothes.Home') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> /
                {{ trans('clothes.page_title') }}</span>
        </div>

    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<div id="error_message"></div>
<!-- <div class="modal" id="modalAddCategory">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ trans('clothes.page_title') }}</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="formcategory" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('clothes.Title_E') }} :</label>
                            <input type="text" class="form-control" name="title_en" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('clothes.Title_A') }} :</label>
                            <input type="text" class="form-control" name="title_ar" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('clothes.Description_E') }} :</label>
                            <textarea class="form-control" name="nota_en" rows="3" required></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('clothes.Description_A') }} :</label>
                            <textarea class="form-control" name="nota_ar" rows="3" required></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('clothes.Price') }} :</label>
                            <input type="number" class="form-control" name="price" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('clothes.Quntaty') }} :</label>
                            <input type="number" class="form-control" name="quntaty" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('clothes.Image') }} :</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label"> {{ trans('clothes.cat') }} :</label>
                            <select name="cat_id" class="form-control">
                                @foreach($cat as $c)
                                @if(App::getLocale() == 'en')
                                <option value="{{ $c->id }}">{{ $c->title_en }}</option>
                                @else
                                <option value="{{ $c->id }}">{{ $c->title_ar }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label"> {{ trans('clothes.Status') }} :</label>
                            <select name="status" class="form-control">
                                <option value="1">{{ trans('category.Active') }}</option>
                                <option value="0">{{ trans('category.iActive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success AddCategory" id="AddCategory">{{ trans('category.Save') }}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('category.Close') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->
<!-- End Basic modal -->
<!-- <div class="modal" id="modalEditCategory">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ trans('clothes.page_title') }}</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="formeditadmin" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="id_prodect">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('clothes.Title_E') }} :</label>
                            <input type="text" class="form-control" id="title_en" name="title_en" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('clothes.Title_A') }} :</label>
                            <input type="text" class="form-control" id="title_ar" name="title_ar" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('clothes.Description_E') }} :</label>
                            <textarea class="form-control" id="nota_en" name="nota_en" rows="3" required></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('clothes.Description_A') }} :</label>
                            <textarea class="form-control" id="nota_ar" name="nota_ar" rows="3" required></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('clothes.Price') }} :</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('clothes.Quntaty') }} :</label>
                            <input type="number" class="form-control" id="quntaty" name="quntaty" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">{{ trans('clothes.Image') }} :</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label"> {{ trans('clothes.cat') }} :</label>
                            <select name="cat_id" class="form-control">
                                @foreach($cat as $c)
                                <option value="{{ $c->id }}" id="cat_id">{{ $c->title_en }}</option>
                                @endforeach
                            </select>
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
</div> -->

<!-- <div class="row row-sm">
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
                                <option value="1">{{ trans('category.Active') }}</option>
                                <option value="0">{{ trans('category.iActive') }}</option>
                            </select>
                        </div>
                    </div>
                </form>
                <button type="submit" class="btn btn-primary" id="s">{{ trans('orders.Sarech') }}</button>
            </div>
        </div>
    </div>
</div> -->
<!-- End Basic modal -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="row row-xs wd-xl-80p">
                    <div class="col-sm-6 col-md-3 mg-t-10">
                        <!-- <button class="btn btn-info-gradient btn-block" id="ShowModalAddCategory">
                            <a href="#" style="font-weight: bold; color: beige;">{{ trans('clothes.Add') }}</a>
                        </button> -->
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive hoverable-table">
                @can('productList-view')
                    <table class="table table-hover" id="get_Prodects" style=" text-align: center;">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">{{ trans('clothes.Image') }}</th>
                                <th class="border-bottom-0">{{ trans('clothes.cat') }}</th>
                                <th class="border-bottom-0">{{ trans('clothes.Prodect') }}</th>
                                <th class="border-bottom-0">{{ trans('clothes.Price') }}</th>
                                <th class="border-bottom-0">{{ trans('clothes.Quntaty') }}</th>
                                <th class="border-bottom-0">{{ trans('clothes.Status') }}</th>
                                <th class="border-bottom-0">
                                @canany([ 'productList-update' , 'productList-delete' ])    
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
<!-- <button class="modal-effect btn btn-sm btn-info" id="ShowModalEditCategory" data-id="${data.id}"><i class="las la-pen"></i></button> -->
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
var i = 1;
var table = $('#get_Prodects').DataTable({
    // processing: true,
    ajax: '{{ url("admin/clothes/gettt") }}',
    columns: [
        {
            'data': null,
            render: function(data, row, type) {
                return i++;
            },
            'className':'text-center text-lg text-medium'
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
            'data': 'categories.title_ar',
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
            'data': 'price',
            'className': 'text-center text-lg text-medium'
        },
        {
            'data': 'quntaty',
            'className': 'text-center text-lg text-medium'
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
                @can('productList-update')
                <form action="{{ url('admin/add100/clothes') }}/${data.id}" method="post" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-warning btn-sm"><i class="las la-plus"></i> 100</button>
                </form>
                <form action="{{ url('admin/minas100/clothes') }}/${data.id}" method="post" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-purple btn-sm"><i class="las la-s">-</i> 100</button>
                </form>
                @endcan
                @can('productList-delete')
                <button class="modal-effect btn btn-sm btn-danger" id="DeleteCategory" data-id="${data.id}"><i class="las la-trash"></i></button>
                @endcan
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
        enctype: "multipart/form-data",
        url: '{{ route("add_prodect") }}',
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
    var id_prodect = $(this).data('id');
    $('#modalEditCategory').modal('show');
    $.ajax({
        type: 'GET',
        url: '{{ url("admin/clothes/edit") }}/' + id_prodect,
        data: "",
        success: function(response) {
            console.log(response);
            if (response.status == 404) {
                console.log('error');
                $('#error_message').html("");
                $('#error_message').addClass("alert alert-danger");
                $('#error_message').text(response.message);
            } else {
                $('#id_prodect').val(id_prodect);
                $('#title_en').val(response.data.title_en);
                $('#title_ar').val(response.data.title_ar);
                $('#nota_en').val(response.data.nota_en);
                $('#nota_ar').val(response.data.nota_ar);
                $('#price').val(response.data.price);
                $('#quntaty').val(response.data.quntaty);
                // if(response.data.cat_id == $('#cat_id').value){
                //     $('#cat_id').attr('selected' , 'selected');
                // }
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
        nota_en: $('#nota_en').val(),
        nota_ar: $('#nota_ar').val(),
        price: $('#price').val(),
        quntaty: $('#quntaty').val(),
        image: $('#image').val(),
        status: $('#status').val(),
    };
    // let formdata = new FormData($('#formeditadmin')[0]);
    var id_prodect = $('#id_prodect').val();
    console.log(data);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '{{ url("admin/clothes/update/") }}/' + id_prodect,
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
    var id_prodect = $(this).data('id');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'DELETE',
        url: '{{ url("admin/clothes/delete") }}/' + id_prodect,
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
        url: '{{ route("prodect.status") }}',
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
        url: '{{ route("prodect.status") }}',
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