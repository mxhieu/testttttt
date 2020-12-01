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
                                <div class="col-md-6">
                                    @include('crm::components.dropdown', [
                                        'list' => $customers,
                                        'name' => 'customer_id',
                                        'val' => Arr::get($filters, 'customer_id'),
                                        'label' => 'Khách hàng',
                                        'emptyOption' => true
                                    ])
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nội dung</label>
                                        <input type="text" class="form-control" name="content" placeholder="Nội dung" value="{{Arr::get($filters, 'content')}}" />
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
                        <table class="table" id="feedbacks-datatable">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Khách hàng</th>
                                    <th>Ngày</th>
                                    <th>Nội dung</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody class="border border-info">
                                @foreach($lists as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{ optional($item->customer)->name}}</td>
                                        <td>{{ $item->date}}</td>
                                        <td>{{ $item->content }}</td>
                                        <td>
                                            <a target="_blank" href="{{route('crm.feedback.edit', $item->id)}}"><i class="fas fa-edit" style="color: green"></i></a>
                                            <a href="javascript:void(0)" class="delete-item" data-href="{{route('crm.feedback.destroy', $item->id)}}"><i class="fas fa-trash" style="color: red"></i></a>
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
            $('#feedbacks-datatable').DataTable( {
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