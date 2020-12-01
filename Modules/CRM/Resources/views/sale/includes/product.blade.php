<style>
    .hidden{display: none}
</style>
<div class="card-body">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Sản Phẩm</label>
                    <select class="form-control custom-select" id="select-product">
                        @foreach($products as $product)
                        <option 
                            id="option{{$product->id}}" 
                            data-money-min="{{optional($product->money)->min}}" 
                            data-money-max="{{optional($product->money)->max}}" 
                            data-money-unit="{{optional(optional($product->money)->moneyUnit)->name}}"
                            data-name="{{$product->name}}" 
                            value="{{$product->id}}" 
                            data-quantity-min="{{optional($product->quantity)->min}}" 
                            data-quantity-max="{{optional($product->quantity)->max}}" 
                            data-available="{{$product->available}}" 
                            data-quantity-unit="{{optional(optional($product->quantity)->quantityUnit)->name}}">
                            {{$product->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button class="btn hidden-sm-down btn-success mb-3" id="add-product"><i class="mdi mdi-plus-circle"></i> Thêm</button>
    </div>
    <div class="table-responsive m-t-40">
    <div class="col-md-12">
        <table class="table" id="crm-sale-detail" data-sale-id="{{$data->id}}">
            <thead class="bg-info text-white">
            <tr>
                <th>No</th>
                <th>Tên SP</th>
                <th>Giá nhỏ nhất</th>
                <th>Giá cao nhất</th>
                <th>Giá thực</th>
                <th>Số lượng</th>
                <th>Thành tiền lớn nhất</th>
                <th>Thành tiền nhỏ nhất</th>
                <th>Thành tiền thực</th>
                <th>Xoá</th>
                <th class="hidden">Load</th>
            </tr>
            </thead>
            <tbody class="border border-info" id="tbody-product">
                <tr class="hidden item-product add-item-product">
                    <td class="stt">1</td>
                    <td class="product-name"></td>
                    <td class="product-min"></td>
                    <td class="product-max"></td>
                    <td class="product-real">
                        <div class="input-group">
                            <input type="number" class="form-control amount-real" value="1" max="" min="">
                            <div class="input-group-append">
                                <span class="input-group-text product-real-unit"></span>
                            </div>
                        </div>
                    </td>
                    <td class="product-quantity">
                        <div class="input-group">
                            <input type="number" class="form-control input-max" value="1" max="" min="">
                            <div class="input-group-append">
                                <span class="input-group-text product-quantity-unit"></span>
                            </div>
                        </div>
                    </td>
                    <td class="product-total-max"></td>
                    <td class="product-total-min"></td>
                    <td class="product-total-real" data-real="0"></td>
                    <td class="product-remove"><button>x</button></td>
                    <td class="product-load hidden"><button class="btn btn-primary"><i class="mdi mdi-autorenew"></i></button></td>
                </tr>
            @foreach($details as $key => $detail)
                <tr 
                class="item-product" 
                data-product-id="{{$detail->product_id}}" 
                data-money-min="{{$detail->money_min}}" 
                data-money-max="{{$detail->money_max}}" 
                data-money-real="{{$detail->money_real}}" 
                data-quantity="{{$detail->quantity}}" 
                data-total-money-min="{{$detail->total_money_min}}" 
                data-total-money-max="{{$detail->total_money_max}}" 
                data-total-money-real="{{$detail->total_money_real}}">
                    <td class="stt">{{$key + 1}}</td>
                    <td class="product-name">{{ optional($detail->product)->name}}</td>
                    <td class="product-min">{{$detail->money_min}}</td>
                    <td class="product-max">{{$detail->money_max}}</td>
                    <td class="product-real">
                        <div class="input-group">
                            <input 
                            type="number" 
                            class="form-control amount-real" 
                            value="{{$detail->money_real}}"
                            max="{{optional(optional($detail->product)->money)->max}}" 
                            min="{{optional(optional($detail->product)->money)->min}}"
                            >
                            <div class="input-group-append">
                                <span class="input-group-text product-real-unit">
                                    {{optional(optional(optional($detail->product)->money)->moneyUnit)->name}}
                                </span>
                            </div>
                        </div>
                    </td>
                    <td class="product-quantity">
                        <div class="input-group">
                            <input 
                            type="number" 
                            class="form-control input-max" 
                            value="{{$detail->quantity}}" 
                            max="{{optional(optional($detail->product)->quantity)->max}}" 
                            min="{{optional(optional($detail->product)->quantity)->min}}"
                            available="{{optional($detail->product)->available}}" 
                            >
                            <div class="input-group-append">
                                <span class="input-group-text product-quantity-unit">
                                    {{optional(optional(optional($detail->product)->quantity)->quantityUnit)->name}}
                                </span>
                            </div>
                        </div>
                    </td>
                    <td class="product-total-max">{{$detail->total_money_max}}</td>
                    <td class="product-total-min">{{$detail->total_money_min}}</td>
                    <td class="product-total-real" data-real="{{$detail->total_money_real}}">{{$detail->total_money_real}}</td>

                    @if( !in_array($detail->product_id, $productInDeliveries) )
                    <td class="product-remove"><button>x</button></td>
                    @endif
                    <td class="hidden product-load"><button class="btn btn-primary"><i class="mdi mdi-autorenew"></i></button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <div class="col-md-5 offset-7">
        <style>
            .form-group-rmb{ margin-bottom: unset; }
        </style>
    <ul class="list-group">
        <li class="list-group-item">
            <strong>Tổng tiền: </strong>
            <span style="float: right" class="total-money" data-total-money="{{$data->total_money}}">{{$data->total_money}}</span>
        </li>
        <li class="list-group-item">
            <strong>Được tăng: </strong>
            <div style="float: right">
                <div class="form-group form-group-rmb">
                    <input type="number" name="money_up" class="form-control money-up" value="{{$data->money_up}}">
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <strong>Được giảm: </strong>
            <div style="float: right">
                <div class="form-group form-group-rmb">
                    <input type="number" name="money_down" class="form-control money-down" value="{{$data->money_down}}">
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <strong>VAT (%): </strong>
            <div style="float: right">
                <div class="input-group">
                    <input type="number" class="form-control vat" value="{{$data->vat ?? 0}}">
                    <div class="input-group-append">
                        <span class="input-group-text product-real-unit">%</span>
                    </div>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <strong>Chiết khấu (%): </strong>
            <div style="float: right">
                <div class="input-group">
                    <input type="number" class="form-control discount" value="{{$data->discount ?? 0}}">
                    <div class="input-group-append">
                        <span class="input-group-text product-real-unit">%</span>
                    </div>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <strong>Giá bán: </strong>
            <span style="float: right" class="final-money">{{$data->final_money}}</span>
        </li>
    </ul>
        <br>
        <div style="float: right">
            <button class="btn hidden-sm-down btn-success mb-3 btn-save-detail" data-route="{{route('crm.sales.store.detail')}}">Thêm</button>
        </div>
    </div>
</div>
@push('script')
    <script src="{{ mix('js/crm.js') }}"></script>
@endpush