<div class="card-body">
    <!-- <div class="table-responsive"> -->
    <div class="col-md-12">
        <a href="{{route('crm.sales.create')}}" class="btn hidden-sm-down btn-success mb-3"><i class="mdi mdi-plus-circle"></i> Thêm</a>
        <table class="table" id="contracts-datatable">
            <thead class="bg-info text-white">
                <tr>
                    <th>#</th>
                    <th>Mã</th>
                    <th>Tên</th>
                    <th>Khác hàng</th>
                    <th>Bắt đầu</th>
                    <th>Kết thúc</th>
                    <th>Trạng Thái</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="border border-info">
                @foreach($contracts as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->code}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{ optional($item->customer)->name}}</td>
                        <td>{{ $item->start_at}}</td>
                        <td>{{ $item->end_at}}</td>
                        <td>
                            @include('crm::components.td_color', ['data' => $item->status])
                        </td>
                        <td>
                            <a target="_blank" href="{{route('crm.sales.show', $item->id)}}"><i class="fas fa-eye" style="color: deepskyblue"></i></a>
                            <a target="_blank" href="{{route('crm.sales.edit', $item->id)}}"><i class="fas fa-edit" style="color: green"></i></a>
                            <a href="javascript:void(0)" class="delete-item" data-href="{{route('crm.sales.destroy', $item->id)}}"><i class="fas fa-trash" style="color: red"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
        </table>
    </div>
</div>
@push('script')
    <script>
        $(document).ready(function() {
            $('#contracts-datatable').DataTable();
        } );
    </script>
@endpush