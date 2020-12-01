<div class="card-body">
    <div class="col-md-12">
        <a href="javascript:void(0)" data-toggle="modal"
           data-target="#sale-modal-payment" class="btn hidden-sm-down btn-success mb-3"><i class="mdi mdi-plus-circle"></i> Thêm</a>
    </div>
    <div class="table-responsive m-t-40">
    <div class="col-md-12">
        <table class="table" id="crm-sale-payment-table" data-datatable="{{route('crm.payments.datatable', $data->id)}}">
            <thead class="bg-info text-white">
            <tr>
                <th>#</th>
                <th>Hình thức</th>
                <th>Trạng Thái</th>
                <th>Giá tiền</th>
                <th>Ngày</th>
                <th>Thông tin chuyển khoản</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody class="border border-info">

            </tbody>
        </table>
    </div>
    </div>
</div>

<div id="sale-modal-payment" class="modal fade in" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Thêm mới</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <from class="form-horizontal form-payment">
                    <div class="form-group">
                        <label class="col-md-12">Số tiền</label>
                        <div class="col-md-12">
                            <input type="number" class="form-control"
                                   placeholder="Số tiền" name="money" data-paid="{{$data->payments->sum('money')}}" data-amount="{{$data->final_money}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            @include('crm::components.dropdown', [
                                'list' => $paymentTypes,
                                'val' => 0,
                                'name' => 'payment_type_id',
                                'label' => 'Phương thức thanh toán'
                            ])
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Thông tin chuyển khoản</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12">Ghi chú</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control"
                                   placeholder="Ghi chú" name="note"> </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            @include('crm::components.dropdown', [
                                'list' => $statuses,
                                'val' => 0,
                                'name' => 'status_id',
                                'label' => 'Trạng thái'
                            ])
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Ngày thanh toán</label>
                            <input type="date" class="form-control" name="date" value="" />
                        </div>
                    </div>
                </from>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info waves-effect btn-save-payment" data-route="{{route('crm.payments.store')}}">Save</button>
                <button type="button" class="btn btn-default waves-effect"
                        data-dismiss="modal">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>