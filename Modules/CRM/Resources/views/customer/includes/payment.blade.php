<div class="card-body">
    <!-- <div class="table-responsive"> -->
    <div class="col-md-12">
        <table class="table" id="payments-datatable">
            <thead class="bg-info text-white">
                <tr>
                    <th>#</th>
                    <th>Hình thức</th>
                    <th>Trạng Thái</th>
                    <th>Giá tiền</th>
                    <th>Ngày</th>
                    <th>Thông tin chuyển khoản</th>
                    <th>Trạng Thái</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody class="border border-info">
                @foreach($payments as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{ optional($item->paymentType)->name}}</td>
                        <td>{{ optional($item->status)->name}}</td>
                        <td>{{ $item->money }}</td>
                        <td>{{ $item->date}}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            @include('crm::components.td_color', ['data' => $item->status])
                        </td>
                        <td>
                            <a target="_blank" href="{{route('crm.payments.edit', $item->id)}}"><i class="fas fa-edit" style="color: green"></i></a>
                            <a href="javascript:void(0)" class="delete-item" data-href="{{route('crm.payments.destroy', $item->id)}}"><i class="fas fa-trash" style="color: red"></i></a>
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
            $('#payments-datatable').DataTable();
        } );
    </script>
@endpush