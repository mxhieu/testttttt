<div class="card-body">
    <!-- <div class="table-responsive"> -->
    <div class="col-md-12">
        <table class="table" id="feedbacks-datatable">
            <thead class="bg-info text-white">
                <tr>
                    <th>#</th>
                    <th>Ngày</th>
                    <th>Nội dung</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody class="border border-info">
                @foreach($feedbacks as $item)
                    <tr>
                        <td>{{$item->id}}</td>
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
@push('script')
    <script>
        $(document).ready(function() {
            $('#feedbacks-datatable').DataTable();
        } );
    </script>
@endpush