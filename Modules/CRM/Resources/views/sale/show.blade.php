@extends('layouts.master')
@section('content')
    @include('crm::menu')
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="card" id="container-sale-id" data-sale-id="{{$data->id}}" data-customer_id="{{$data->customer_id}}">
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link border-right active" data-toggle="tab" href="#detail" role="tab">Chi tiết</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border-right" data-toggle="tab" href="#payment" role="tab">Thanh toán</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border-right" data-toggle="tab" href="#delivery" role="tab">Giao hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border-right" data-toggle="tab" href="#feedback" role="tab">Phản hồi</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="detail" role="tabpanel">
                        @include('crm::sale.includes.detail')
                    </div>
                    <div class="tab-pane" id="payment" role="tabpanel">
                        @include('crm::sale.includes.payment')
                    </div>
                    <div class="tab-pane" id="delivery" role="tabpanel">
                        @include('crm::sale.includes.delivery')
                    </div>
                    <div class="tab-pane" id="feedback" role="tabpanel">
                        @include('crm::sale.includes.feedback')
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer"> © 2019</footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    @include('crm::sale.includes.delete_modal')
@endsection
@push('script')
    <script src="{{asset('assets/plugins/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
@endpush

@push('style')
    <link href="{{asset('assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endpush