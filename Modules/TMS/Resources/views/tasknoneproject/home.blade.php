@extends('layouts.master')
@section('content')
    @include('tms::menu')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row m-t-40">
                                <div class="col-md-6 col-lg-3 col-xlg-3">
                                    <div class="card">
                                        <div class="box bg-info text-center">
                                        <h1 class="font-light text-white">{{count($allTask)}}</h1>
                                            <h6 class="text-white">Tổng task</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3 col-xlg-3">
                                    <div class="card">
                                        <div class="box bg-warning text-center">
                                            <h1 class="font-light text-white">{{count($taskOfDay)}}</h1>
                                            <h6 class="text-white">Task trong ngày</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3 col-xlg-3">
                                    <div class="card">
                                        <div class="box bg-success text-center">
                                            <h1 class="font-light text-white">{{count($taskInProcessing)}}</h1>
                                            <h6 class="text-white">Task đang làm</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3 col-xlg-3">
                                    <div class="card">
                                        <div class="box bg-danger text-center">
                                            <h1 class="font-light text-white">{{count($taskDelay)}}</h1>
                                            <h6 class="text-white">Task delay</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Task Bắt Đầu Trong Tuần</h4>
                                    <div id="bar-chart" style="width:100%; height:400px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-right">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-secondary">Today</button>
                                            <button type="button" class="btn btn-secondary">Week</button>
                                            <button type="button" class="btn btn-secondary">Month</button>
                                        </div>
                                    </div>
                                    <h4 class="card-title">Members Activity</h4>
                                    <h6 class="card-subtitle">what members preformance / weekly status</h6>
                                    <div class="table-responsive mt-5">
                                        <table class="table table-hover v-middle">
                                            <thead>
                                                <tr>
                                                    <th style="width: 60px;"> Member </th>
                                                    <th> Name </th>
                                                    <th> Earnings </th>
                                                    <th> Posts </th>
                                                    <th> Reviews </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img class="img-circle" src="../assets/images/users/1.jpg" alt="user" width="50">
                                                    </td>
                                                    <td>
                                                        <a href="javascript:;">Govinda</a>
                                                    </td>
                                                    <td> $325 </td>
                                                    <td> 45 </td>
                                                    <td>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star-half-full text-warning"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img class="img-circle" src="../assets/images/users/2.jpg" alt="user" width="50">
                                                    </td>
                                                    <td>
                                                        <a href="javascript:;">Genelia</a>
                                                    </td>
                                                    <td> $225 </td>
                                                    <td> 35 </td>
                                                    <td>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star-half-full text-warning"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img class="img-circle" src="../assets/images/users/3.jpg" alt="user" width="50">
                                                    </td>
                                                    <td>
                                                        <a href="javascript:;">Hrithik</a>
                                                    </td>
                                                    <td> $185 </td>
                                                    <td> 28 </td>
                                                    <td>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star-half-full text-warning"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img class="img-circle" src="../assets/images/users/4.jpg" alt="user" width="50">
                                                    </td>
                                                    <td>
                                                        <a href="javascript:;">Salman</a>
                                                    </td>
                                                    <td> $125 </td>
                                                    <td> 25 </td>
                                                    <td>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star-half-full text-warning"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img class="img-circle" src="../assets/images/users/2.jpg" alt="user" width="50">
                                                    </td>
                                                    <td>
                                                        <a href="javascript:;">Genelia</a>
                                                    </td>
                                                    <td> $225 </td>
                                                    <td> 35 </td>
                                                    <td>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star text-warning"></i>
                                                        <i class="fa fa-star-half-full text-warning"></i>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="text-center">
                                            <button class="btn btn-success">Check more</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
@endsection
@push('style')
@endpush
@push('script')
<script src="{{asset('assets/plugins/echarts/echarts-all.js')}}"></script>
<script src="{{Module::asset('TMS:js/home.js')}}"></script>
@endpush