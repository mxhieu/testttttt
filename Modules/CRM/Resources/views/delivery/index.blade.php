@extends('layouts.master')
@section('content')
    @include('crm::menu')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="card card-outline-info">
                <div class="card-body">
                    <form action="" class="form-horizontal">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    @include('crm::components.dropdown', [
                                        'list' => $customers,
                                        'name' => 'customer_id',
                                        'val' => Arr::get($filters, 'customer_id'),
                                        'label' => 'Khách hàng',
                                        'emptyOption' => true
                                    ])
                                </div>
                                <div class="col-md-3">
                                    @include('crm::config.status',[
                                        'list' => $statuses,
                                        'val' => Arr::get($filters, 'status_id'),
                                        'emptyOption' => true
                                    ])
                                </div>
                                <div class="col-md-3">
                                    @include('crm::components.dropdown', [
                                         'list' => $products,
                                         'name' => 'product_id',
                                         'val' => Arr::get($filters, 'product_id'),
                                         'label' => 'Sản phẩm',
                                         'emptyOption' => true
                                     ])
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input type="text" class="form-control" name="address" placeholder="Địa chỉ" value="{{Arr::get($filters, 'address')}}" />
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                        </div>
                        <hr>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-success">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6"> </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive m-t-40">
                    <div class="col-md-12">
                        <table class="table" id="deliveries-datatable">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Khách hàng</th>
                                    <th>Sản phẩm</th>
                                    <th>Trạng Thái</th>
                                    <th>Địa chỉ</th>
                                    <th>Ngày</th>
                                    <th>Ghi chú</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody class="border border-info">
                                @foreach($lists as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{ optional($item->customer)->name}}</td>
                                        <td>
                                            <table class="border">
                                                <tr>
                                                    <th>Sản phẩm</th>
                                                    <th>Số lượng</th>
                                                </tr>
                                                @foreach($item->products as $product)
                                                <tr>
                                                    <td>{{optional($product->product)->name}}</td>
                                                    <td>{{$product->quantity}}</td>
                                                </tr>
                                                @endforeach

                                            </table>
                                        </td>
                                        <td>
                                            @include('crm::components.td_color', ['data' => $item->status])
                                        </td>
                                        <td>{{  $item->address }}</td>
                                        <td>{{ $item->date}}</td>
                                        <td>{{ $item->note }}</td>
                                        <td>
                                            <a target="_blank" href="{{route('crm.deliveries.edit', $item->id)}}"><i class="fas fa-edit" style="color: green"></i></a>
                                            <a href="javascript:void(0)" class="delete-item" data-href="{{route('crm.deliveries.destroy', $item->id)}}"><i class="fas fa-trash" style="color: red"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer"> © 2019</footer>
    </div>
    @include('crm::components.modal_delete')
@endsection

@push('script')
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#deliveries-datatable').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
            $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
        } );
    </script>
    <script src="{{ mix('js/crm.js') }}"></script>
@endpush