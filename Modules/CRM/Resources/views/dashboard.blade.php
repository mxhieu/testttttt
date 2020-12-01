@extends('layouts.master')
@section('content')
    @include('crm::menu')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-12 text-center"><span class="display-7">{{$totalCustomer}}</span>
                                        <h6>Tổng số khách hàng</h6></div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Thống kê theo loại hình kinh doanh</h4>
                            <div id="doughnut-chart-kind-customer" style="width:100%; height:400px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Thống kê theo kênh tìm kiếm</h4>
                            <div id="bar-chart-channel-customer" style="width:100%; height:400px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-12 text-center"><span class="display-7">{{$totalSale}}</span>
                                        <h6>Tổng số phiếu bán hàng</h6></div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6 offset-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tỉ lệ loại phiếu bán hàng</h4>
                                <div id="doughnut-chart-kind-sale" style="width:100%; height:400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Thống kê doanh thu</h4>
                            <div id="bar-chart-revenue" style="width:100%; height:400px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Thống kê nợ</h4>
                            <div id="bar-chart-debt" style="width:100%; height:400px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Thống kê danh sách khách hàng mới trong tháng</h4>
                            <div class="table-responsive m-t-40">
                                <div class="col-md-12">
                                    <table class="table" id="crm-customer-new-datatable">
                                        <thead class="bg-info text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Mã</th>
                                            <th>Tên</th>
                                            <th>Loại</th>
                                            <th>Kiểu</th>
                                            <th>Nhóm</th>
                                        </tr>
                                        </thead>
                                        <tbody class="border border-info">
                                        @foreach($customerInMonth as $cu)
                                            <tr>
                                                <td>{{$cu->id}}</td>
                                                <td>{{$cu->code}}</td>
                                                <td>{{$cu->name}}</td>
                                                <td>{{ optional($cu->kind)->name}}</td>
                                                <td>{{ optional($cu->group)->name}}</td>
                                                <td>{{ optional($cu->type)->name}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Thống kê sự kiện trong tháng</h4>
                            <div class="table-responsive m-t-40">
                                <div class="col-md-12">
                                    <table class="table" id="crm-customer-new-datatable">
                                        <thead class="bg-info text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>KH</th>
                                            <th>Mã</th>
                                            <th>Tên</th>
                                            <th>Trạng thái</th>
                                            <th>Loại</th>
                                            <th>Kiểu</th>
                                            <th>Nhóm</th>
                                            <th>Hoàn thành</th>
                                        </tr>
                                        </thead>
                                        <tbody class="border border-info">
                                            @foreach($activityInMonth as $ac)
                                                <tr>
                                                    <td>{{$ac->id}}</td>
                                                    <td>{{ optional($ac->customer)->name}}</td>
                                                    <td>{{$ac->code}}</td>
                                                    <td>{{$ac->name}}</td>
                                                    <td>
                                                        @include('crm::components.td_color', ['data' => $ac->status])
                                                    </td>
                                                    <td>{{ optional($ac->kind)->name}}</td>
                                                    <td>{{ optional($ac->type)->name}}</td>
                                                    <td>{{ optional($ac->group)->name}}</td>
                                                    <td>{{$ac->complete . ' %'}}</td>
                                                </tr>
                                             @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer"> © 2019</footer>
    </div>
@endsection

@push('style')
@endpush
@push('script')
    <script src="{{asset('assets/plugins/echarts/echarts-all.js')}}"></script>
    <script>
// new chart
var barChartChannelCustomer = echarts.init(document.getElementById('bar-chart-channel-customer'));

// specify chart configuration item and data
option = {
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['Channel']
    },
    toolbox: {
        show : true,
        feature : {
            
            magicType : {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    color: ["#55ce63"],
    calculable : true,
    xAxis : [
        {
            type : 'category',
            data : @json($channelLabels)
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:'Channel',
            type:'bar',
            data:@json($channelCustomer),
            markPoint : {
                data : [
                    {type : 'max', name: 'Max'},
                    {type : 'min', name: 'Min'}
                ]
            },
            markLine : {
                data : [
                    {type : 'average', name: 'Average'}
                ]
            }
        }
    ]
};
                    

// use configuration item and data specified to show chart
        barChartChannelCustomer.setOption(option, true), $(function() {
            function resize() {
                setTimeout(function() {
                    barChartChannelCustomer.resize()
                }, 100)
            }
            $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
        });

        //------------------------------------------------------------------------------------------
// new chart
var barChartRevenue = echarts.init(document.getElementById('bar-chart-revenue'));

// specify chart configuration item and data
option = {
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['Month']
    },
    toolbox: {
        show : true,
        feature : {

            magicType : {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    color: ["#336666"],
    calculable : true,
    xAxis : [
        {
            type : 'category',
            data : @json($revenuesMonth)
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:'Month',
            type:'bar',
            data:@json($revenuesAmount),
            markPoint : {
                data : [
                    {type : 'max', name: 'Max'},
                    {type : 'min', name: 'Min'}
                ]
            },
            markLine : {
                data : [
                    {type : 'average', name: 'Average'}
                ]
            }
        }
    ]
};


// use configuration item and data specified to show chart
barChartRevenue.setOption(option, true), $(function() {
    function resize() {
        setTimeout(function() {
            barChartRevenue.resize()
        }, 100)
    }
    $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
});

// --------------------------------------------------------------------------------------------
// new chart
var barChartDebt = echarts.init(document.getElementById('bar-chart-debt'));

// specify chart configuration item and data
option = {
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['Month']
    },
    toolbox: {
        show : true,
        feature : {

            magicType : {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    color: ["#CC99FF"],
    calculable : true,
    xAxis : [
        {
            type : 'category',
            data : @json($debtsMonth)
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:'Month',
            type:'bar',
            data:@json($debtsAmount),
            markPoint : {
                data : [
                    {type : 'max', name: 'Max'},
                    {type : 'min', name: 'Min'}
                ]
            },
            markLine : {
                data : [
                    {type : 'average', name: 'Average'}
                ]
            }
        }
    ]
};


// use configuration item and data specified to show chart
barChartDebt.setOption(option, true), $(function() {
    function resize() {
        setTimeout(function() {
            barChartDebt.resize()
        }, 100)
    }
    $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
});


        // Loai hinh kinh doanh
var doughnutChartKindCustomer = echarts.init(document.getElementById('doughnut-chart-kind-customer'));

// specify chart configuration item and data

option = {
    tooltip : {
        trigger: 'item'
    },
    legend: {
        orient : 'vertical',
        x : 'left',
        data:@json($kindLabels)
    },
    toolbox: {
        show : true,
        feature : {
            dataView : {show: true, readOnly: false},
            magicType : {
                show: true, 
                type: ['pie', 'funnel'],
                option: {
                    funnel: {
                        x: '25%',
                        width: '50%',
                        funnelAlign: 'center',
                        max: 1548
                    }
                }
            },
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    color: @json($kindColors),
    calculable : true,
    series : [
        {
            name:'Source',
            type:'pie',
            radius : ['50%', '90%'],
            itemStyle : {
                normal : {
                    label : {
                        show : false
                    },
                    labelLine : {
                        show : false
                    }
                },
                emphasis : {
                    label : {
                        show : true,
                        position : 'center',
                        textStyle : {
                            fontSize : '30',
                            fontWeight : 'bold'
                        }
                    }
                }
            },
            data:@json($kindCustomer)
        }
    ]
};
                                    
                    

// use configuration item and data specified to show chart
        doughnutChartKindCustomer.setOption(option, true), $(function() {
            function resize() {
                setTimeout(function() {
                    doughnutChartKindCustomer.resize()
                }, 100)
            }
            $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
        });



        // ti le phieu ban hang
        var doughnutChartKindSale = echarts.init(document.getElementById('doughnut-chart-kind-sale'));

        // specify chart configuration item and data

        option = {
            tooltip : {
                trigger: 'item'
            },
            legend: {
                orient : 'vertical',
                x : 'left',
                data:@json($kindSaleLabels)
            },
            toolbox: {
                show : true,
                feature : {
                    dataView : {show: true, readOnly: false},
                    magicType : {
                        show: true,
                        type: ['pie', 'funnel'],
                        option: {
                            funnel: {
                                x: '25%',
                                width: '50%',
                                funnelAlign: 'center',
                                max: 1548
                            }
                        }
                    },
                    restore : {show: true},
                    saveAsImage : {show: true}
                }
            },
            color: @json($kindSaleColors),
            calculable : true,
            series : [
                {
                    name:'Source',
                    type:'pie',
                    radius : ['50%', '90%'],
                    itemStyle : {
                        normal : {
                            label : {
                                show : false
                            },
                            labelLine : {
                                show : false
                            }
                        },
                        emphasis : {
                            label : {
                                show : true,
                                position : 'center',
                                textStyle : {
                                    fontSize : '30',
                                    fontWeight : 'bold'
                                }
                            }
                        }
                    },
                    data:@json($kindSaleData)
                }
            ]
        };



        // use configuration item and data specified to show chart
        doughnutChartKindSale.setOption(option, true), $(function() {
            function resize() {
                setTimeout(function() {
                    doughnutChartKindSale.resize()
                }, 100)
            }
            $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
        });
    </script>
@endpush