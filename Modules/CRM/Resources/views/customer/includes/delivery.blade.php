<div class="card-body">
    <!-- <div class="table-responsive"> -->
    <div class="col-md-12">
        <table class="table" id="deliveries-datatable">
            <thead class="bg-info text-white">
                <tr>
                    <th>#</th>
                    <th>Trạng Thái</th>
                    <th>Địa chỉ</th>
                    <th>Ngày</th>
                    <th>Ghi chú</th>
                    <th>Trạng Thái</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody class="border border-info">
                @foreach($deliveries as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{ optional($item->status)->name}}</td>
                        <td>{{  $item->address }}</td>
                        <td>{{ $item->date}}</td>
                        <td>{{ $item->note }}</td>
                        <td>
                            @include('crm::components.td_color', ['data' => $item->status])
                        </td>
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
@push('script')
    <script>
        $(document).ready(function() {
            $('#deliveries-datatable').DataTable();
        } );
    </script>
@endpush