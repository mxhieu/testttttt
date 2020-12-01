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
            <div class="card">
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link border-right active" data-toggle="tab" href="#detail" role="tab">Chi tiết</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border-right" data-toggle="tab" href="#contact" role="tab">Liên hệ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border-right" data-toggle="tab" href="#activity" role="tab">Hoạt động</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border-right" data-toggle="tab" href="#contract" role="tab">Hợp đồng</a>
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
                        @include('crm::customer.includes.detail')
                    </div>
                    <div class="tab-pane" id="contact" role="tabpanel">
                        @include('crm::customer.includes.contact', [
                            'contacts' => $data->contacts
                        ])
                    </div>
                    <div class="tab-pane" id="activity" role="tabpanel">
                        @include('crm::customer.includes.activity', [
                            'activities' => $data->activities
                        ])
                    </div>
                    <div class="tab-pane" id="contract" role="tabpanel">
                        @include('crm::customer.includes.contract', [
                            'contracts' => $data->contracts
                        ])
                    </div>
                    <div class="tab-pane" id="payment" role="tabpanel">
                        @include('crm::customer.includes.payment', [
                            'payments' => $data->payments
                        ])
                    </div>
                    <div class="tab-pane" id="delivery" role="tabpanel">
                        @include('crm::customer.includes.delivery', [
                            'deliveries' => $data->deliveries
                        ])
                    </div>
                    <div class="tab-pane" id="feedback" role="tabpanel">
                        @include('crm::customer.includes.feedback', [
                            'feedbacks' => $data->feedbacks
                        ])
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

    @include('crm::customer.includes.modal_delete')
@endsection