@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Create</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                roles</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row opened -->
<div class="row">
    @include('roles.model-from')
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row row-xs wd-xl-80p">
                    @can('role-create')
                    <div class="col-sm-6 col-md-3 mg-t-10">
                        <button class="btn btn-info-gradient btn-block ShowModel" id="ShowModalAddCategory">
                            <a href="#" style="font-weight: bold; color: beige;">roles</a>
                        </button>
                    </div>
                    @endcan
                </div>
                <!-- <h3>roles
                    <button class="btn btn-primary float-right ShowModel">Add
                        roles</button>
                </h3> -->
            </div>
            <div class="card-body">
                <div class="table-responsive hoverable-table">
                @can('role-view')
                    <table class="table table-hover" id="get_roles">
                        <div class="alert alert-success message" style="display:none"></div>
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">Permission Name</th>
                                <th class="border-bottom-0">User Name</th>
                                <th class="border-bottom-0 s">Permissions</th>
                                <th class="border-bottom-0">Count</th>
                                <th class="border-bottom-0">Created</th>
                                <th class="border-bottom-0">
                                    @canany([ 'role-update' , 'role-delete' ])
                                    Processes
                                    @endcanany
                                </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
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
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
<script>
$(document).ready(function() {
    var table = $('#get_roles').DataTable({
        processing: false,
        ajax: '{!! url("admin/get_roles") !!}',
        columns: [{
                'data': 'id',
                'className': 'text-center text-lg text-medium'
            },
            {
                'data': 'name',
                'className': 'text-center text-lg text-medium'
            },
            {
                'data': 'users[0].name',
                'className': 'text-center text-lg text-medium'
            },
            {
                'data': 'permissions',
                'className': 'text-center text-lg text-medium',
            },
            {
                'data': 'users_count',
                'className': 'text-center text-lg text-medium'
            },
            {
                'data': 'created_at',
                'className': 'text-center text-lg text-medium',
                render: function(data) {
                    if (data == null) return "";
                    var date = new Date(data);
                    var month = date.getMonth() + 1;
                    return date.getDate() + "/" + (month.toString().length > 1 ? month : "0" +
                        month) + "/" + date.getFullYear();
                }
            },
            {
                'data': null,
                render: function(data, row, type) {
                    return `
                    @can('role-update')
                    <a class="modal-effect btn btn-sm btn-info ShowEditeModel" data-id="${data.id}" data-user="${data.users[0].id}" href="#"><i class="las la-pen"></i></a>
                    @endcan
                    @can('role-update')
                    <button class="modal-effect btn btn-sm btn-danger DeleteRole" data-id="${data.id}" data-user="${data.users[0].id}"><i class="las la-trash"></i></button>
                    @endcan
                    `;

                },
                orderable: false,
                searchable: false
            },
        ],
    });

    $('#get_roles').addClass('col-sm-12');
    const points = new Array();
    var b;
    $('.main-toggle').click(function() {
        points.push($(this).data('v'));
    });
    $('input:radio[name="rdio"]').click(
        function() {
            if ($(this).is(':checked') && $(this).val() == 'Admin') {
                $('.A').css("background-color", "#D8D8D8");
                $('.D').removeAttr('style');
                $('.B').removeAttr('style');
                $('.C').removeAttr('style');
            } else if ($(this).is(':checked') && $(this).val() == 'Employee') {
                $('.B').css("background-color", "#D8D8D8");
                $('.A').removeAttr('style');
                $('.D').removeAttr('style');
                $('.C').removeAttr('style');
            } else if ($(this).is(':checked') && $(this).val() == 'Worker') {
                $('.C').css("background-color", "#D8D8D8");
                $('.A').removeAttr('style');
                $('.B').removeAttr('style');
                $('.D').removeAttr('style');
            } else if ($(this).is(':checked') && $(this).val() == 'Customer') {
                $('.D').css("background-color", "#D8D8D8");
                $('.A').removeAttr('style');
                $('.B').removeAttr('style');
                $('.C').removeAttr('style');
            }
            if ($(this).is(':checked')) {
                b = $(this).val();
                // console.log($(this).val());
            }
        });
    $(document).on('click', '.ShowModel', function(e) {
        e.preventDefault();
        $('#CreateRolesModal').modal('show');
        $('.CreateRolesBut').click(function(e) {
            e.preventDefault();
            var data = {
                name: b,
                permissions: points,
                user_name: $('#user_name').val(),
                email: $('#email').val(),
                password: $('#password').val()
            };
            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: 'roles',
                data: data,
                success: function(response) {
                    $('#CreateRolesModal').modal('hide');
                    table.ajax.reload();
                }
            });
        });
    });
    $(document).on('click', '.ShowEditeModel', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var user_id = $(this).data('user');

        $('#EditeRolesModal').modal('show');
        $.ajax({
            type: 'GET',
            url: 'http://127.0.0.1:8000/admin/show/' + id + "/" + user_id,
            data: "",
            success: function(response) {
                // console.log(response);
                if (response.status == 404) {
                    console.log('error');
                    $('#error_message').html("");
                    $('#error_message').addClass("alert alert-danger");
                    $('#error_message').text(response.message);
                } else {
                    function r(f = []) {
                        for (var i = 0; i < f.length; i++) {
                            if (f[i] == $('.' + f[i]).data('v')) {
                                $('.' + f[i] + "").removeClass('on');
                            } else {
                                $('.' + f[i]).removeClass('on');
                            }
                        }
                    }
                    var Permissions = ['role-view', 'role-create', 'role-update',
                        'role-delete'
                    ];
                    var Members = ['member-view', 'member-create', 'member-update',
                        'member-delete'
                    ];
                    var Settings = ['setting-view', 'setting-create', 'setting-update',
                        'setting-delete'
                    ];
                    var categories = ['categories-view', 'categories-create',
                        'categories-update', 'categories-delete'
                    ];
                    var ads = ['ads-view', 'ads-create', 'ads-update', 'ads-delete'];
                    var product = ['product-view', 'product-create', 'product-update',
                        'product-delete'
                    ];
                    var Customers = ['customer-view', 'customer-create', 'customer-update',
                        'customer-delete'
                    ];
                    var order = ['order-view', 'order-create', 'order-update',
                        'order-delete'
                    ];
                    var contact = ['contact-view', 'contact-create', 'contact-update',
                        'contact-delete'
                    ];
                    var productList = ['productList-view', 'productList-create',
                        'productList-update', 'productList-delete'
                    ];
                    var paymentMethod = ['paymentMethod-view', 'paymentMethod-create',
                        'paymentMethod-update', 'paymentMethod-delete'
                    ];
                    var deliveryMethods = ['deliveryMethods-view', 'deliveryMethods-create',
                        'deliveryMethods-update', 'deliveryMethods-delete'
                    ];
                    var Reports = ['report-view', 'report-create', 'report-update',
                        'report-delete'
                    ];
                    var discountCodes = ['discountCodes-view', 'discountCodes-create',
                        'discountCodes-update', 'discountCodes-delete'
                    ];
                    var workTime = ['workTime-view', 'workTime-create', 'workTime-update',
                        'workTime-delete'
                    ];
                    var deliveryHour = ['deliveryHour-view', 'deliveryHour-create',
                        'deliveryHour-update', 'deliveryHour-delete'
                    ];
                    var region = ['region-view', 'region-create', 'region-update',
                        'region-delete'
                    ];
                    r(Permissions);
                    r(Members);
                    r(Settings);
                    r(categories);
                    r(ads);
                    r(product);
                    r(Customers);
                    r(order);
                    r(contact);
                    r(productList);
                    r(paymentMethod);
                    r(deliveryMethods);
                    r(Reports);
                    r(discountCodes);
                    r(workTime);
                    r(deliveryHour);
                    r(region);
                    $('#edit_user_name').val(response.user.name);
                    $('#edit_email').val(response.user.email);
                    $('#edit_password').val(response.user.password);
                    if ($('input:radio[name="rdio"]').val() == response.data.name) {
                        $('.A').css("background-color", "#D8D8D8");
                        $('.A').attr('checked', 'checked');
                    }
                    for (var i = 0; i < response.data.permissions.length; i++) {
                        // console.log(response.data.permissions[i]);
                        if (response.data.permissions[i] == $('.' + response.data
                                .permissions[i]).data('v')) {
                            $('.' + response.data.permissions[i] + "").addClass('on');
                        } else {
                            $('.' + response.data.permissions[i]).addClass('on');
                        }
                    }
                }
            }
        });
        $('.ERolesBut').click(function(e) {
            e.preventDefault();
            var data = {
                name: $(".At:checked").val(),
                permissions: points,
                user_name: $('#edit_user_name').val(),
                email: $('#edit_email').val(),
                password: $('#edit_password').val()
            };
            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '{{ url("admin/update/r") }}/' + id + "/" + user_id,
                data: data,
                success: function(response) {
                    $('#CreateRolesModal').modal('hide');
                    table.ajax.reload();
                }
            });
        });
    });

    $(document).on('click', '.DeleteRole', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var admin_id = $(this).data('user');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'DELETE',
            url: '{{ url("admin/destroy") }}/' + id + "/" + admin_id,
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
});
</script>
@endsection