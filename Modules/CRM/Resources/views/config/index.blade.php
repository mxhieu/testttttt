@extends('layouts.master')
@section('content')
    @include('crm::menu')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="card">
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link border-right active" data-toggle="tab" href="#list" role="tab">Danh sách</a> </li>
                    <li class="nav-item"> <a id="tab-form" class="nav-link border-right" data-toggle="tab" href="#add" role="tab">{{isset($data) ? 'Chỉnh sửa' : 'Thêm mới'}}</a> </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="add" role="tabpanel">
                        <div class="card-body">
                            <form action="{{ isset($data) ? route('crm.config.update', ['id' => $data->id, 'resource' => $resource]) : route('crm.config.store', $resource)}}" method="post">
                                @csrf()
                                @isset($data)
                                    @method('put')
                                @endisset
                                <div class="form-group row">
                                    <div class="col-4">
                                        <label class="control-label">Tên</label>
                                        <input type="text" required name="name" class="form-control" placeholder="Nhập tên" value="{{isset($data) ? $data->name : ''}}">
                                    </div>
                                    @if($isColor)
                                        <div class="col-4">
                                        <label class="control-label">Màu</label>
                                        <input type="color" name="color" class="form-control" placeholder="Màu" value="{{isset($data) ? $data->color : ''}}">
                                        </div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Lưu</button>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane active" id="list" role="tabpanel">
                        <div class="card-body">
                            <div class="col-md-12">
                                <table class="table" id="crm-config-datatable">
                                    <thead class="bg-info text-white">
                                    <tr>
                                        <th>#</th>
                                        <th>Mã</th>
                                        <th>Tên</th>
                                        @if($isColor)
                                            <th>Màu</th>
                                        @endif
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="border border-info">
                                    @foreach($lists as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->code}}</td>
                                        <td>{{$item->name}}</td>
                                        @if($isColor)
                                            <td>
                                                <button class="btn" style="width: 100%; background-color: {{$item->color ? $item->color : 'transparent'}}"></button>
                                            </td>
                                        @endif
                                        <td>
                                            <a href="{{route('crm.config.edit', ['id' => $item->id, 'resource' => $resource])}}"><i class="fas fa-edit" style="color: green"></i></a>
                                            <a href="javascript:void(0)" data-href="{{route('crm.config.destroy', ['id' => $item->id, 'resource' => $resource])}}" class="delete-item"><i class="fas fa-trash" style="color: red"></i></a>
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
        </div>
        <footer class="footer"> © 2019</footer>
    </div>
@include('crm::components.modal_delete')
@endsection
@push('script')
    <script>
        $('#crm-config-datatable').DataTable();
        @isset($data)
            $('#tab-form').trigger('click');
        @endisset
    </script>
    <script src="{{ mix('js/crm.js') }}"></script>
@endpush