@php
    use Illuminate\Support\Arr;
@endphp
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tên</label>
                                        <input type="text" class="form-control" name="name" placeholder="Tên" value="{{Arr::get($filters, 'name')}}" />
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    @include('crm::components.dropdown', [
                                        'list' => $groups,
                                        'name' => 'group_id',
                                        'val' => Arr::get($filters, 'group_id'),
                                        'label' => 'Nhóm',
                                        'emptyOption' => true
                                    ])
                                </div>
                                <div class="col-md-3">
                                    @include('crm::components.dropdown', [
                                        'list' => $types,
                                        'name' => 'type_id',
                                        'val' => Arr::get($filters, 'type_id'),
                                        'label' => 'Loại',
                                        'emptyOption' => true
                                    ])
                                </div>
                                <div class="col-md-3">
                                    @include('crm::components.dropdown', [
                                        'list' => $kinds,
                                        'name' => 'kind_id',
                                        'val' => Arr::get($filters, 'kind_id'),
                                        'label' => 'Kiểu',
                                        'emptyOption' => true
                                    ])
                                </div>
                                <div class="col-md-3">
                                    @include('crm::components.dropdown', [
                                        'list' => $colors,
                                        'name' => 'color_id',
                                        'val' => Arr::get($filters, 'color_id'),
                                        'label' => 'Màu',
                                        'emptyOption' => true
                                    ])
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
                        <table class="table" id="crm-product-datatable">
                            <thead class="bg-info text-white">
                            <tr>
                                <th>#</th>
                                <th>Mã</th>
                                <th>Tên</th>
                                <th>Đã bán</th>
                                <th>Tổng số</th>
                                <th>SL nhỏ nhất</th>
                                <th>SL lớn nhất</th>
                                <th>Tiền nhỏ nhất</th>
                                <th>Tiền lớn nhất</th>
                                <th>Action</th>
                                <th>Loại</th>
                                <th>Kiểu</th>
                                <th>Nhóm</th>
                            </tr>
                            </thead>
                            <tbody class="border border-info">
                            @foreach($lists as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->code}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->sold }}</td>
                                    <td>{{ $item->totalQuantity }}</td>
                                    <td>{{ optional($item->quantity)->min }}</td>
                                    <td>{{ optional($item->quantity)->max }}</td>
                                    <td>{{ optional($item->money)->min }}</td>
                                    <td>{{ optional($item->money)->max }}</td>
                                    <td>
                                        <a href="{{route('crm.products.show', $item->id)}}"><i class="fas fa-eye" style="color: deepskyblue"></i></a>
                                        <a href="{{route('crm.products.edit', $item->id)}}"><i class="fas fa-edit" style="color: green"></i></a>
                                        <a href="javascript:void(0)" class="delete-item" data-href="{{route('crm.products.destroy', $item->id)}}"><i class="fas fa-trash" style="color: red"></i></a>
                                    </td>
                                    <td>{{ optional($item->kind)->name}}</td>
                                    <td>{{ optional($item->type)->name}}</td>
                                    <td>{{ optional($item->group)->name}}</td>
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

@push('style')
<link rel="stylesheet" type="text/css"
        href="{{asset('assets/plugins/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
@endpush


@push('script')
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js">
    </script>
    <script src="{{asset('assets/plugins/datatables.net-bs4/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#crm-product-datatable').DataTable( {
                responsive: true,
                dom: 'Bfrtip',
                columnDefs: [
            { width: '20%', targets: 2 }
        ],
        fixedColumns: true,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
            $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
        } );
    </script>
    <script src="{{ mix('js/crm.js') }}"></script>
@endpush