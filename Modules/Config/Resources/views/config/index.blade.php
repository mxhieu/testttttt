@extends('layouts.master')
@section('content')
    @include('config::menu')
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="card">
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link border-right active" data-toggle="tab" href="#list" role="tab">Danh sách</a> </li>
                    <li class="nav-item"> <a class="nav-link border-right" id="tab-form" data-toggle="tab" href="#add" role="tab">{{isset($data) ? 'Chỉnh sửa' : 'Thêm mới'}}</a> </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="add" role="tabpanel">
                        <div class="card-body">
                            <form action="{{ isset($data) ? route('config.update', ['id' => $data->id, 'resource' => $resource]) : route('config.store', $resource)}}" method="post">
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
                            <div class="table-responsive">
                            <div class="col-md-12">
                                <table class="table" id="config-datatable">
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
                                                <button class="btn" style="width: 100%;background-color: {{$item->color ? $item->color : 'transparent'}}"></button>
                                            </td>
                                        @endif
                                        <td>
                                            <a href="{{route('config.edit', ['id' => $item->id, 'resource' => $resource])}}"><i class="fas fa-edit" style="color: green"></i></a>
                                            <a href="javascript:void(0)" data-href="{{route('config.destroy', ['id' => $item->id, 'resource' => $resource])}}" class="delete-item"><i class="fas fa-trash" style="color: red"></i></a>
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
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer"> © 2019</footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>

    <div id="delete-item" class="modal fade in" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Bạn có muốn xoá ?</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xác nhận</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#config-datatable').DataTable();
            @isset($data)
                $('#tab-form').trigger('click');
            @endisset

            $('.delete-item').off('click').on('click', function () {
                $('#delete-item').find('form').attr('action', $(this).data('href'));
                $('#delete-item').modal('show');
            });
        });
    </script>
@endpush