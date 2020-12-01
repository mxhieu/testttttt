<div class="card-body">
    <div class="col-md-12">
        <a href="javascript:void(0)" data-toggle="modal"
           data-target="#sale-modal-delivery" class="btn hidden-sm-down btn-success mb-3"><i class="mdi mdi-plus-circle"></i> Thêm</a>
    </div>
    <div class="table-responsive m-t-40">
    <div class="col-md-12">
        <table class="table" id="crm-sale-delivery-table" data-datatable="{{route('crm.deliveries.datatable', $data->id)}}">
            <thead class="bg-info text-white">
            <tr>
                <th>#</th>
                <th>Sản Phẩm</th>
                <th>Trạng Thái</th>
                <th>Địa chỉ</th>
                <th>Ngày</th>
                <th>Ghi chú</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody class="border border-info">

            </tbody>
        </table>
    </div>
    </div>
</div>

<div id="sale-modal-delivery" class="modal fade in" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Thêm mới</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <from class="form-horizontal form-delivery">
                    <div class="form-group">
                        <ul class="list-group col-md-12">
                            @foreach($detailDeliveries as $item)
                            <li class="list-group-item">
                                <div class="checkbox checkbox-success" style="display: inline-block">
                                    <input id="checkbox{{optional($item->product)->id}}" type="checkbox" name="product" data-value="{{optional($item->product)->id}}">
                                    <label for="checkbox{{optional($item->product)->id}}">{{optional($item->product)->name}}</label>
                                </div>
                                <div style="float: right">
                                    <input type="number" class="form-control input-max" value="{{$item->quantity}}" max="{{$item->available}}">
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12">Địa chỉ</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control"
                                   placeholder="Địa chỉ" name="address"> </div>
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
                            <label>Ngày giao hàng</label>
                            <input type="date" class="form-control" name="date" value="" />
                        </div>
                    </div>
                </from>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info waves-effect btn-save-delivery" data-route="{{route('crm.deliveries.store')}}">Save</button>
                <button type="button" class="btn btn-default waves-effect"
                        data-dismiss="modal">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>