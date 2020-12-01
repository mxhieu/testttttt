<div class="card-body">
    <!-- <div class="table-responsive"> -->
    <div class="col-md-12">
        <a href="{{route('crm.contacts.create', $data->id)}}" class="btn hidden-sm-down btn-success mb-3"><i class="mdi mdi-plus-circle"></i> Thêm</a>
        <table class="table" id="contact-datatable">
            <thead class="bg-info text-white">
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Phòng ban</th>
                <th>Vị trí</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="border border-info">
            @foreach($contacts as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{ optional($item->department)->name}}</td>
                    <td>{{ optional($item->position)->name}}</td>
                    <td>
                        <a href="{{route('crm.contacts.edit', $item->id)}}"><i class="fas fa-edit" style="color: green"></i></a>
                        <a href="javascript:void(0)"><i data-href="{{route('crm.contacts.destroy', $item->id)}}" class="fas fa-trash delete-item" style="color: red"></i></a>
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
            $('#contact-datatable').DataTable();
        } );
    </script>
@endpush