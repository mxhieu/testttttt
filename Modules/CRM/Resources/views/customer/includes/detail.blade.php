<div class="card-body">
    <!-- <div class="table-responsive"> -->
    <div class="col-md-12">
        <div class="card card-body">
            <div class="row">
                <div class="col-md-4 col-lg-3 text-center">
                    <a href="javascript:void(0)"><img src="{{$data->logo}}" alt="{{$data->name}}" class="img-responsive"></a>
                </div>
                <div class="col-md-8 col-lg-9">
                    <h4 class="mb-0">{{$data->name}} - {{$data->code}}</h4>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Website:</strong> {{$data->website}}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{$data->email}}</li>
                        <li class="list-group-item"><strong>Phone:</strong> {{$data->phone}}</li>
                        <li class="list-group-item"><strong>Mã số thuế:</strong> {{$data->tax_id}}</li>
                        <li class="list-group-item"><strong>Ngày:</strong> {{$data->find_at}}</li>
                        <li class="list-group-item"><strong>Thị trường:</strong> {{optional($data->market)->name}}</li>
                        <li class="list-group-item"><strong>Loại khách hàng:</strong> {{optional($data->kind)->name}}</li>
                        <li class="list-group-item"><strong>Kiểu khách hàng:</strong> {{optional($data->type)->name}}</li>
                        <li class="list-group-item"><strong>Nhóm khách hàng:</strong> {{optional($data->group)->name}}</li>
                        <li class="list-group-item"><strong>Kênh:</strong> {{optional($data->channel)->name}}</li>
                        <li class="list-group-item"><strong>Mối quan hệ:</strong> {{optional($data->relation)->name}}</li>
                        <li class="list-group-item"><strong>Nhân viên phụ trách:</strong> {{optional($data->employee)->name}}</li>
                        <li class="list-group-item"><strong>Mô tả:</strong> {{$data->description}}</li>
                        <li class="list-group-item"><strong>Ngày tạo khách hàng:</strong> {{$data->created_at}}</li>
                        <li class="list-group-item"><strong>Người tạo:</strong> {{$data->created_id}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>