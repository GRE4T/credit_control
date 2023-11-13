@extends('layouts.master')
@section('page-css')

    <link rel="stylesheet" href="{{asset('assets/styles/vendor/apexcharts.css')}}">
@endsection
@section('main-content')
    <div class="separator-breadcrumb"></div>
    <div class="row">
        <!-- ICON BG -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Add-User"></i>
                    <div class="w-100">
                        <p class="text-muted mt-2 mb-0">Recuados</p>
                        <p class="text-primary text-24 line-height-1 mb-2">${{ $payments }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Financial"></i>
                    <div class="w-100">
                        <p class="text-muted mt-2 mb-0">Facturas</p>
                        <p class="text-primary text-24 line-height-1 mb-2">${{ $invoices }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Checkout-Basket"></i>
                    <div class="w-100">
                        <p class="text-muted mt-2 mb-0">Pagos realizados</p>
                        <p class="text-primary text-24 line-height-1 mb-2">${{ $paymentsMade }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Money-2"></i>
                    <div class="w-100">
                        <p class="text-muted mt-2 mb-0">Pagos recibidos</p>
                        <p class="text-primary text-24 line-height-1 mb-2">${{ $paymentsReceived }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title">Recaudos del mes</div>
                    <div id="echart_1" style="height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title m-0 p-3">Recaudos por convenio</h2>
                    <div id="echart_2" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-js')
    <script src="{{asset('assets/js/vendor/echarts.min.js')}}"></script>
    <script src="{{asset('assets/js/es5/echart.options.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/js/es5/apexBarChart.script.min.js')}}"></script>
@endsection
@section('bottom-js')
    <script type="text/javascript">
        'use strict';

        $(document).ready(() => {
            axios.get('/api/home/graph-payments')
                .then(response => {
                    let element = $('#echart_1')[0];
                    if(element)
                        renderGraphs1(element, response.data.data);

                });

            axios.get('api/home/graph-payments-by-agreement')
                .then(response => {
                    let element = $('#echart_2')[0];
                    if(element)
                        renderGraph2(element, response.data.data);

                });
        });

        function renderGraphs1(element, data) {
            let echartBar = echarts.init(element);
            if (echartBar) {
                echartBar.setOption({
                    legend: {
                        borderRadius: 0,
                        orient: 'horizontal',
                        x: 'right',
                        data: ['Recaudos']
                    },
                    grid: {
                        left: '8px',
                        right: '8px',
                        bottom: '0',
                        containLabel: true
                    },
                    tooltip: {
                        show: true,
                        backgroundColor: 'rgba(0, 0, 0, .8)'
                    },
                    xAxis: [{
                        type: 'category',
                        data: data.labels,
                        axisTick: {
                            alignWithLabel: true
                        },
                        splitLine: {
                            show: false
                        },
                        axisLine: {
                            show: true
                        }
                    }],
                    yAxis: [{
                        type: 'value',
                        axisLabel: {
                            formatter: '${value}'
                        },
                        axisLine: {
                            show: false
                        },
                        splitLine: {
                            show: true,
                            interval: 'auto'
                        }
                    }

                    ],
                    series: [{
                        name: 'Recaudos',
                        data: data.values,
                        label: {show: false, color: '#0168c1'},
                        type: 'bar',
                        barGap: 0,
                        color: '#146CC9',
                        smooth: true,
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowOffsetY: -2,
                                shadowColor: 'rgba(0, 0, 0, 0.3)'
                            }
                        }
                    }]
                });
            }
        }

        function renderGraph2(element, data) {
            let options = {
                chart: {
                    height: 350,
                    type: 'bar',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        endingShape: 'rounded',
                    }
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: 'Total recaudos',
                    data: data.values
                }],
                xaxis: {
                    categories: data.labels
                }
            }

            let chart = new ApexCharts(
                element,
                options
            );
            chart.render();

        }


    </script>

@endsection
