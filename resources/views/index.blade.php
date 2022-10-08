@extends('layouts.master')
@section('css')

<link rel="stylesheet" href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}"  />

<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/morris.js/morris.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet">

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{trans('dashboard.Welcome')}}!</h2>
            {{--						  <p class="mg-b-0">Sales monitoring dashboard template.</p>--}}
        </div>
    </div>

</div>
<!-- /breadcrumb -->
@endsection
@section('content')
<!-- row -->

<div class="row row-sm">
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-primary-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-24 text-white">{{trans('Services')}}</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Service::count() }}</h4>
                            <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                        </div>

                    </div>
                </div>
            </div>
            <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-danger-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-24 text-white">{{trans('My Categores')}}</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{ App\Models\CategoryOfWorkers::count() }}</h4>
                            <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                        </div>

                    </div>
                </div>
            </div>
            <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-success-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-24 text-white">{{trans('My Works')}}</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Work::count() }}</h4>
                            <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                        </div>

                    </div>
                </div>
            </div>
            <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-warning-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-24 text-white">{{trans('Clients')}}</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\client::count() }}</h4>
                            <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                        </div>
                        {{--										<span class="float-right my-auto mr-auto">--}}
                        {{--											<i class="fas fa-arrow-circle-down text-white"></i>--}}
                        {{--											<span class="text-white op-7"> -152.3</span>--}}
                        {{--										</span>--}}
                    </div>
                </div>
            </div>
            <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <!-- Shopping Cart-->
                <div class="product-details table-responsive text-nowrap">
                    <h3 class="text-center">{{ trans('clients') }}</h3>
                    <table class="table table-bordered table-hover mb-0 text-nowrap col-sm-12" id="get_client">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">{{ trans('Name') }}</th>
                                <th class="text-center">{{ trans('Email') }}</th>
                                <th class="text-center">{{ trans('Description') }}</th>
                                <th class="text-center">{{ trans('Image') }}</th>
                                <th class="text-center">{{ trans('Created') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Container closed -->
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
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>

<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal  Morris js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/morris.js/morris.min.js')}}"></script>
<!--Internal Chart Morris js -->
<script src="{{URL::asset('assets/js/chart.morris.js')}}"></script>


<script src="{{URL::asset('assets/plugins/moment/min/moment.min.js')}}"></script>
<!--Internal  Date picker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  Fullcalendar js -->
<script src="{{URL::asset('assets/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<!-- Internal Select2.full.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<!--Internal App calendar js -->
{{--    <script src="{{URL::asset('assets/js/app-calendar-events.js')}}"></script>--}}
<script src="{{URL::asset('assets/js/app-calendar.js')}}"></script>

<script>
    var table = $('#get_client').DataTable({
        // processing: true,
        ajax: '{!! route('get_client') !!}',
        columns: [
            {'data': 'id' ,
                'className': 'text-center text-lg text-medium'},
            {'data': 'name' ,
                'className': 'text-center text-lg text-medium'},
            {'data': 'email' ,
                'className': 'text-center text-lg text-medium'},
            {'data': 'description' ,
                'className': 'text-center text-lg text-medium'},
            {'data': 'image' ,
                'className': 'text-center text-lg text-medium' ,
                render:function (data, row, type){
                    if(data){
                        return `<img src="{{ request()->getSchemeAndHttpHost().'/uploads/' }}${data}" class="h-40 w-60">`
                    }else {
                        return `<img src="{{ asset('admin/images/favicon.png') }}" class="h-60 w-60">`
                    }
                        }
            },
            {
                'data': 'created_at' ,
                'className': 'text-center text-lg text-medium' ,
                render: function (data) {
                    if (data == null) return "";
                    var date = new Date(data);
                    var month = date.getMonth() + 1;
                    return date.getDate() + "/"  + (month.toString().length > 1 ? month : "0" + month) + "/"  + date.getFullYear();
                }},
        ],
    });
    $('.table-responsive').addClass('col-12');
</script>
{{--<script>--}}
{{--$(function() {--}}
{{--    'use strict';--}}

{{--    {--}}
{{--        {--}}

{{--            var morrisData2 =--}}
{{--        }--}}
{{--    } {--}}
{{--        {--}}
{{--            {--}}
{{--                {--}}
{{--                    $stats--}}
{{--                }--}}
{{--            };--}}

{{--        }--}}
{{--    }--}}
{{--    //     alert(morrisData2);--}}

{{--    new Morris.Bar({--}}
{{--        element: 'morrisBar2',--}}
{{--        data: morrisData2,--}}
{{--        xkey: 'date',--}}
{{--        ykeys: ['value'],--}}
{{--        labels: ['التوقعات', 'المباريات', 'الفائزين'],--}}
{{--        barColors: ['#6d6ef3', '#285cf7', '#f7557a'],--}}
{{--        gridTextSize: 11,--}}
{{--        hideHover: 'auto',--}}
{{--        resize: true--}}
{{--    });--}}




{{--});--}}
{{--</script>--}}
<script>
$('#modaldemo9').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var services_name = button.data('services_name')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #services_name').val(services_name);
})
</script>

<script>
$('#exampleModal2', function(event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')

    console.log(id)

});

// sample calendar events data
'use strict'
var curYear = moment().format('YYYY');
var curMonth = moment().format('MM');





// Birthday Events Source
var azBirthdayEvents = {
    id: 2,
    backgroundColor: '#3bb001',
    borderColor: '#3bb001',
    textColor: '#fff',
    events: [

    ]
};
var azHolidayEvents = {
    id: 3,
    backgroundColor: '#f10075',
    borderColor: '#f10075',
    textColor: '#fff',
    events: [

    ]
};
var azOtherEvents = {
    id: 4,
    backgroundColor: '#ffb52b',
    borderColor: '#ffb52b',
    textColor: '#fff',
    events: [

    ]
};
</script>

@endsection

{{--                        @foreach(App\Models\client::get() as $client)--}}
{{--                        <tbody>--}}
{{--                            <tr>--}}
{{--                                <td class="text-center text-lg text-medium">{{ $client->id }}</td>--}}
{{--                                <td class="text-center text-lg text-medium">{{ $client->name }}</td>--}}
{{--                                <td class="text-center text-lg text-medium">{{ $client->email }}</td>--}}
{{--                                <td class="text-center text-lg text-medium">{{ $client->description }}</td>--}}
{{--                                <td>--}}
{{--                                    <div class="media">--}}
{{--                                        <div class="card-aside-img">--}}
{{--                                            <img src="{{asset('uploads/'.$client->image)}}" alt="img"--}}
{{--                                                class="h-60 w-60">--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <div class="card-item-desc mt-0">--}}
{{--                                                <h6 class="font-weight-semibold mt-0 text-uppercase"></h6>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td class="text-center text-lg text-medium">{{ $client->created_at }}</td>--}}
{{--                            </tr>--}}
{{--                        </tbody>--}}
{{--                        @endforeach--}}
