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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tên công ty</label>
                                        <input type="text" class="form-control" name="name" placeholder="Tên công ty" value="{{Arr::get($filters, 'name')}}" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{Arr::get($filters, 'phone')}}" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    @include('crm::config.market', [
                                        'val' => Arr::get($filters, 'market_id'),
                                        'list' => $markets,
                                        'emptyOption' => true
                                    ])
                                </div>
                                <div class="col-md-3">
                                    @include('crm::config.customer_kind', [
                                        'val' => Arr::get($filters, 'kind_id'),
                                        'list' => $kinds,
                                        'emptyOption' => true
                                    ])
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    @include('crm::config.channel', [
                                        'val' => Arr::get($filters, 'channel_id'),
                                        'list' => $channels,
                                        'emptyOption' => true
                                    ])
                                </div>
                                <div class="col-md-3">
                                    @include('crm::config.relation', [
                                        'val' => Arr::get($filters, 'relation_id'),
                                        'list' => $relations,
                                        'emptyOption' => true
                                    ])
                                </div>
                                <div class="col-md-3">
                                    @include('crm::config.customer_type', [
                                        'val' => Arr::get($filters, 'type_id'),
                                        'list' => $types,
                                        'emptyOption' => true
                                    ])
                                </div>
                                <div class="col-md-3">
                                    @include('crm::config.customer_group', [
                                        'val' => Arr::get($filters, 'group_id'),
                                        'list' => $groups,
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
                        <table class="table" id="customer-datatable">
                            <thead class="bg-info text-white">
                            <tr>
                                <th>#</th>
                                <th>Mã</th>
                                <th>Tên</th>
                                <th>Thị trường</th>
                                <th>Loại KH</th>
                                <th>Kiểu KH</th>
                                <th>Nhóm KH</th>
                                <th>Mối quan hệ</th>
                                <th>Nhân viên</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="border border-info">
                            @foreach($lists as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->code}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    @include('crm::components.td_color', ['data' => $item->market])
                                </td>
                                <td>{{ optional($item->kind)->name}}</td>
                                <td>{{ optional($item->type)->name}}</td>
                                <td>{{ optional($item->group)->name}}</td>
                                <td>
                                    @include('crm::components.td_color', ['data' => $item->relation])
                                </td>
                                <td>{{ optional($item->employee)->name}}</td>
                                <td>
                                    <a href="{{route('crm.customers.show', $item->id)}}"><i class="fas fa-eye" style="color: deepskyblue"></i></a>
                                    <a href="{{route('crm.customers.edit', $item->id)}}"><i class="fas fa-edit" style="color: green"></i></a>
                                    <a href="javascript:void(0)" class="delete-item" data-href="{{route('crm.customers.destroy', $item->id)}}"><i class="fas fa-trash" style="color: red"></i></a>
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
            $('#customer-datatable').DataTable( {
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