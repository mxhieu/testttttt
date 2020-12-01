<div class="card-body">
    <!-- <div class="table-responsive"> -->
    <div class="col-md-12">
        <a href="{{route('crm.activities.create', $data->id)}}" class="btn hidden-sm-down btn-success mb-3"><i class="mdi mdi-plus-circle"></i> Thêm</a>
        <table class="table" id="activities-datatable">
            <thead class="bg-info text-white">
            <tr>
                <th>#</th>
                <th>Mã</th>
                <th>Tên</th>
                <th>Loại</th>
                <th>Kiểu</th>
                <th>Nhóm</th>
                <th>Hoàn thành</th>
                <th>Trạng Thái</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="border border-info">
            @foreach($activities as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->code}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{ optional($item->kind)->name}}</td>
                    <td>{{ optional($item->type)->name}}</td>
                    <td>{{ optional($item->group)->name}}</td>
                    <td>{{ $item->complete . ' %'}}</td>
                    <td>
                        @include('crm::components.td_color', ['data' => $item->status])
                    </td>
                    <td>
                        <a href="{{route('crm.activities.edit', $item->id)}}"><i class="fas fa-edit" style="color: green"></i></a>
                        <a href="javascript:void(0)" class="delete-item" data-href="{{route('crm.activities.destroy', $item->id)}}"><i class="fas fa-trash" style="color: red"></i></a>
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
            $('#activities-datatable').DataTable();
        } );
    </script>
@endpush