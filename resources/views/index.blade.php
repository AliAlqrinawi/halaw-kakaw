@extends('layouts.master')
@section('css')

<link rel="stylesheet" href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" />

<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/morris.js/morris.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet">

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">
                {{trans('dashboard.Wellcome') . " " . Auth::user()->name}} !</h2>
            {{--						  <p class="mg-b-0">Sales monitoring dashboard template.</p>--}}
        </div>
    </div>

</div>
<!-- /breadcrumb -->
@endsection
@section('content')
<!-- row -->

<div class="row row-sm">
    <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-primary-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-24 text-white">{{trans('dashboard.Custmer')}}</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\AppUser::count() }}</h4>
                            <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                        </div>

                    </div>
                </div>
            </div>
            <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-danger-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-24 text-white">{{trans('dashboard.Orders')}}</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Order::count() }}</h4>
                            <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                        </div>

                    </div>
                </div>
            </div>
            <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-success-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-24 text-white">{{trans('dashboard.total_bills')}}</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Order::sum('total_cost') }}</h4>
                            <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                        </div>

                    </div>
                </div>
            </div>
            <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
        </div>
    </div>
</div>
<div class="row row-sm">
    <div class="col-lg-12 col-md-12">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    {{trans('home.chart')}}
                </div>
                <p class="mg-b-20">{{trans('home.number_chart')}}</p>
                <div id="echart1" class="ht-300"></div>
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

<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal Chartjs js -->
<script src="{{URL::asset('assets/js/chart.chartjs.js')}}"></script>

<script src="{{URL::asset('assets/plugins/moment/min/moment.min.js')}}"></script>
<!--Internal  Date picker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  Fullcalendar js -->
<script src="{{URL::asset('assets/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<!-- Internal Select2.full.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<!--Internal App calendar js -->
<script src="{{URL::asset('assets/js/app-calendar-events.js')}}"></script>
<script src="{{URL::asset('assets/js/app-calendar.js')}}"></script>
<script>

$(function(e) {
    'use strict'
    /*----Echart2----*/
    var chartdata = [{
        name: 'TEST',
        type: 'bar',
        barMaxWidth: 20,
        data: [0,1,5,25,30,40,100]

    },  {
        name: 'TEST1',
        type: 'bar',
        barMaxWidth: 20,
        data: [3,50,20,25,50,20,80]
    
    }];
    var chart = document.getElementById('echart1');
    var barChart = echarts.init(chart);
    var option = {
        valueAxis: {
            axisLine: {
                lineStyle: {
                    color: 'rgba(171, 167, 167,0.2)'
                }
            },
            splitArea: {
                show: true,
                areaStyle: {
                    color: ['rgba(171, 167, 167,0.2)']
                }
            },
            splitLine: {
                lineStyle: {
                    color: ['rgba(171, 167, 167,0.2)']
                }
            }
        },
        grid: {
            top: '6',
            right: '0',
            bottom: '17',
            left: '25',
        },
        xAxis: {
            data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3],
            axisLine: {
                lineStyle: {
                    color: 'rgba(171, 167, 167,0.2)'
                }
            },
            splitLine: {
                lineStyle: {
                    color: 'rgba(171, 167, 167,0.2)'
                }
            },
            axisLabel: {
                fontSize: 10,
                color: '#5f6d7a'
            }
        },
        tooltip: {
            trigger: 'axis',
            position: ['35%', '32%'],
        },
        yAxis: {
            splitLine: {
                lineStyle: {
                    color: 'rgba(171, 167, 167,0.2)'
                }
            },
            axisLine: {
                lineStyle: {
                    color: 'rgba(171, 167, 167,0.2)'
                }
            },
            axisLabel: {
                fontSize: 10,
                color: '#5f6d7a'
            }
        },
        series: chartdata,
        color: ['#285cf7', '#f7557a' ]
    };
    barChart.setOption(option);





    /*----BarChartEchart----*/
    var echartBar = echarts.init(document.getElementById('index'), {
        color: ['#285cf7', '#f7557a'],
        categoryAxis: {
            axisLine: {
                lineStyle: {
                    color: '#888180'
                }
            },
            splitLine: {
                lineStyle: {
                    color: ['rgba(171, 167, 167,0.2)']
                }
            }
        },
        grid: {
            x: 40,
            y: 20,
            x2: 40,
            y2: 20
        },
        valueAxis: {
            axisLine: {
                lineStyle: {
                    color: '#888180'
                }
            },
            splitArea: {
                show: true,
                areaStyle: {
                    color: ['rgba(255,255,255,0.1)']
                }
            },
            splitLine: {
                lineStyle: {
                    color: ['rgba(171, 167, 167,0.2)']
                }
            }
        },
    });
    echartBar.setOption({
        tooltip: {
            trigger: 'axis',
            position: ['35%', '32%'],
        },
        legend: {
            data: ['New Account', 'Expansion Account']
        },
        toolbox: {
            show: false
        },
        calculable: false,
        xAxis: [{
            type: 'category',
            data: ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            axisLine: {
                lineStyle: {
                    color: 'rgba(171, 167, 167,0.2)'
                }
            },
            axisLabel: {
                fontSize: 10,
                color: '#5f6d7a'
            }
        }],
        yAxis: [{
            type: 'value',
            splitLine: {
                lineStyle: {
                    color: 'rgba(171, 167, 167,0.2)'
                }
            },
            axisLine: {
                lineStyle: {
                    color: 'rgba(171, 167, 167,0.2)'
                }
            },
            axisLabel: {
                fontSize: 10,
                color: '#5f6d7a'
            }
        }],
        series: [{
            name: 'View Price',
            type: 'bar',
            data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3],
            markPoint: {
                data: [{
                    type: 'max',
                    name: ''
                }, {
                    type: 'min',
                    name: ''
                }]
            },
            markLine: {
                data: [{
                    type: 'average',
                    name: ''
                }]
            }
        }, {
            name: ' Purchased Price',
            type: 'bar',
            
            data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3],
            markPoint: {
                data: [{
                    name: 'Purchased Price',
                    value: 182.2,
                    xAxis: 7,
                    // yAxis: 183,
                }, {
                    name: 'Purchased Price',
                    value: 2.3,
                    xAxis: 11,
                    // yAxis: 3
                }]
            },
            markLine: {
                data: [{
                    type: 'average',
                    name: ''
                }]
            }
        }]
    });
});

</script>
 
@endsection