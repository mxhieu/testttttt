@extends('layouts.master')
@section('content')
    @include('config::menu')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="card">
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link border-right" data-toggle="tab" href="#add" role="tab">Thêm mới</a> </li>
                    <li class="nav-item"> <a class="nav-link border-right active" data-toggle="tab" href="#list" role="tab">Danh sách</a> </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="add" role="tabpanel">
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            @include('component.util.lfmImage', [
                                                'name' => 'avartar',
                                                'label' => __('avartar'),
                                                'value' => !empty($EmployeeInfo) ? $EmployeeInfo->avartar : ''
                                            ])
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="form-group col-md-6 @if($errors->has('name'))has_error @endif">
                                                <label for="name">Họ tên</label>
                                                <input value="@if(!empty($EmployeeInfo)){{$EmployeeInfo->name}}@elseif(!empty(old('name'))){{old('name')}}@endif" type="text" id="name" name="name" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6 @if($errors->has('name'))has_error @endif">
                                                <label for="email">Email</label>
                                                <input value="@if(!empty($EmployeeInfo)){{$EmployeeInfo->email}}@elseif(!empty(old('email'))){{old('email')}}@endif" type="email" id="email" name="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 @if($errors->has('department_id'))has_error @endif">
                                                <label for="department_id">Phòng ban</label>
                                                <select id="department_id" name="department_id" class="form-control">
                                                    <option value="">--Chọn phòng ban--</option>
                                                    @foreach($departmentList as $key => $row)
                                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 @if($errors->has('position_id'))has_error @endif">
                                                <label for="position_id" for="name">Chức vụ</label>
                                                <select id="position_id" name="position_id" class="form-control">
                                                    <option value="">--Chọn chức vụ--</option>
                                                    @foreach($positionList as $key => $row)
                                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12 padding-unset">
                                        @if(!empty($EmployeeInfo))
                                        <button class="btn btn-info">Update</button>
                                        @else
                                        <button class="btn btn-success">Lưu</button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane active" id="list" role="tabpanel">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div id="result-alert"></div>
                                <table class="table" id="employee-table">
                                    <thead class="bg-info text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Tên Nhân viên</th>
                                            <th>Email</th>
                                            <th>Chức vụ</th>
                                            <th>Group</th>
                                            <th>Trạng thái</th>
                                            <th>Tùy chỉnh</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer"> © 2019</footer>
    </div>
@endsection
@push('script')
<script>
    $(function() {
        $('#employee-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{!! route('config.employee.data') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'position.name', name: 'position' },
                { data: 'department.name', name: 'department' },
                { data: 'name', name: 'name' },
                { data: 'action', name: 'action' },
            ]
        });
    });
</script>
@endpush