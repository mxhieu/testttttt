@php
    $customer = $data->customer;
    $details = $data->details;
@endphp
@extends('layouts.master')
@section('content')
    @include('crm::menu')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive m-t-40">
                        <div class="col-md-12">
                            <div class="card card-body printableArea">
                                <h3><b>INVOICE</b> <span class="float-right">#{{$data->code}}</span></h3>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="float-left">
                                            <address>
                                                <h3> &nbsp;<b class="text-danger">{{$company->name}}</b></h3>
                                                <p class="text-muted ml-1">{{$company->address}}</p>
                                            </address>
                                        </div>
                                        <div class="float-right text-right">
                                            <address>
                                                <h3>To,</h3>
                                                <h4 class="font-bold">{{$customer->name}}</h4>
                                                <p class="text-muted ml-4">{{$customer->address}}</p>
                                                <p class="mt-4"><b>Invoice Date :</b> <i class="fa fa-calendar"></i> {{$data->start_at}}</p>
                                                <p><b>Due Date :</b> <i class="fa fa-calendar"></i> {{$data->end_at}}</p>
                                            </address>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive mt-5" style="clear: both;">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Sản phẩm</th>
                                                    <th class="text-right">Số lượng</th>
                                                    <th class="text-right">Giá</th>
                                                    <th class="text-right">Tổng tiền</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($details as $stt => $detail)
                                                <tr>
                                                    <td class="text-center"> {{$stt + 1}}</td>
                                                    <td>{{$detail->product->name}}</td>
                                                    <td class="text-right">{{$detail->quantity . ' ' . optional(optional($detail->product->quantity)->quantityUnit)->name}}</td>
                                                    <td class="text-right"> {{$detail->money_real . ' ' . optional(optional($detail->product->money)->moneyUnit)->name}} </td>
                                                    <td class="text-right"> {{$detail->total_money_real}} </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <hr class="mt-0 mb-5">
                                    <div class="col-md-12">
                                        <span>{{$data->description}}</span>
                                    </div>
                                    <div class="col-md-4 offset-md-8">
                                        <div class="mt-4">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <strong>Tổng tiền: </strong>
                                                    <span style="float: right">{{$data->total_money}}</span>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Được tăng: </strong>
                                                    <div style="float: right">
                                                        <span>{{$data->money_up}}</span>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Được giảm: </strong>
                                                    <div style="float: right">
                                                        <span>{{$data->money_down}}</span>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>VAT (%): </strong>
                                                    <div style="float: right">
                                                        <span>{{$data->vat ?? 0}} %</span>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Chiết khấu (%): </strong>
                                                    <div style="float: right">
                                                        <span>{{$data->discount ?? 0}} % </span>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Giá bán: </strong>
                                                    <span style="float: right">{{$data->final_money}}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                        <div class="text-right">
                                            <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                                        </div>
                                    </div>
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
@push('script')
    <script src="{{asset('assets/theme/js/jquery.PrintArea.js')}}" type="text/JavaScript"></script>
    <script>
        $(document).ready(function() {
            $("#print").click(function() {
                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $("div.printableArea").printArea(options);
            });
        });
    </script>
    <script src="{{ mix('js/crm.js') }}"></script>
@endpush