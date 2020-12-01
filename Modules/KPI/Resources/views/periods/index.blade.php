@extends('layouts.master')
@section('content')
    @include('kpi::menu')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="card">
                <button class="btn btn-success" data-toggle="modal" data-target="#myModal">Tạo kỳ</button>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <h4 class="card-title">Kỳ đánh giá 1</h4>
                            </div>
                            <table class="table no-border">
                                <tr>
                                    <td>Tác giả</td>
                                    <td class="font-medium">Nguyễn Văn A</td>
                                </tr>
                                <tr>
                                    <td>Bắt đầu - Kết thúc</td>
                                    <td class="font-medium">12/11/2020 - 12/5/2021</td>
                                </tr>
                                <tr>
                                    <td>Đối tượng</td>
                                    <td class="font-medium">Nhóm A, Nhóm B, Nhóm C</td>
                                </tr>
                                <tr>
                                    <td>Trạng thái</td>
                                    <td class="font-medium">Ontime</td>
                                </tr>
                            </table>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <h4 class="card-title">Kỳ đánh giá 2</h4>
                            </div>
                            <table class="table no-border">
                                <tr>
                                    <td>Tác giả</td>
                                    <td class="font-medium">Nguyễn Văn A</td>
                                </tr>
                                <tr>
                                    <td>Bắt đầu - Kết thúc</td>
                                    <td class="font-medium">12/11/2020 - 12/5/2021</td>
                                </tr>
                                <tr>
                                    <td>Đối tượng</td>
                                    <td class="font-medium">Nhóm A, Nhóm B, Nhóm C</td>
                                </tr>
                                <tr>
                                    <td>Trạng thái</td>
                                    <td class="font-medium">Ontime</td>
                                </tr>
                            </table>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <h4 class="card-title">Kỳ đánh giá 3</h4>
                            </div>
                            <table class="table no-border">
                                <tr>
                                    <td>Tác giả</td>
                                    <td class="font-medium">Nguyễn Văn A</td>
                                </tr>
                                <tr>
                                    <td>Bắt đầu - Kết thúc</td>
                                    <td class="font-medium">12/11/2020 - 12/5/2021</td>
                                </tr>
                                <tr>
                                    <td>Đối tượng</td>
                                    <td class="font-medium">Nhóm A, Nhóm B, Nhóm C</td>
                                </tr>
                                <tr>
                                    <td>Trạng thái</td>
                                    <td class="font-medium">Ontime</td>
                                </tr>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <footer class="footer"> © 2019</footer>
    </div>

    <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Thêm hạng mục</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-8">
                        <label class="control-label">Tên</label>
                        <input type="text" id="firstName" name="name" class="form-control" placeholder="Công việc abc...">
                    </div>
                    <div class="form-group col-4">
                        <label class="control-label">Thời gian</label>
                        <input type="text" id="firstName" name="name" class="form-control" placeholder="Công việc abc...">
                    </div>
                    <div class="form-group col-6">
                        <label>Nhóm</label>
                        <select id="group_id" name="group_id" class="form-control custom-select">
                            <option value="">--Chọn nhóm--</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <div class="form-group">
                            <label>Phụ Trách</label>
                            <select id="employee_id" name="employee_id" class="form-control custom-select">
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label class="control-label">Chú thích</label>
                        <textarea name="remark" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Thêm</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

@endsection
@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}" />
@endpush
@push('script')
<script>
    <script type="text/javascript" src="{{asset('assets/plugins/daterangepicker/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
    $(function() {
        $('#status-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{!! route('config.status.data') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'key', name: 'key' },
                { data: 'span-color', name: 'span-color' },
                { data: 'action', name: 'action' },
            ]
        });
    });


</script>
@endpush