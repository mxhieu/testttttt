@extends('layouts.master')
@section('content')
    @include('tms::menu')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <ul class="nav nav-tabs profile-tab" role="tablist">
                            <li class="nav-item"> <a class="nav-link border-right" data-toggle="tab" href="#add" role="tab">Thêm mới</a> </li>
                            <li class="nav-item"> <a class="nav-link border-right active" data-toggle="tab" href="#list" role="tab">Tất cả</a> </li>
                            <li class="nav-item"> <a class="nav-link border-right" data-toggle="tab" href="#today" role="tab">Trong ngày</a> </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="add" role="tabpanel">
                                <div class="card-body">
                                    <form action="#" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-lg-9">
                                                <div class="card card-outline-info">
                                                    <div class="card-header">
                                                        <h4 class="mb-0 text-white">Công việc</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="#">
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Tên</label>
                                                                            <input name="name" type="text" class="form-control" name="end" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Trạng thái</label>
                                                                            <select id="status_id" name="status_id" class="form-control custom-select">
                                                                                <option value="">--Chọn Trạng thái--</option>
                                                                                @foreach($statusList as $row)
                                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Giai đoạn</label>
                                                                            <select id="task_phrase_id" name="task_phrase_id" class="form-control custom-select">
                                                                                <option value="">--Chọn giai đoạn--</option>
                                                                                @foreach($taskPhraseList as $row)
                                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Phòng ban</label>
                                                                            <select id="department_id" name="department_id" class="form-control custom-select">
                                                                                <option value="">--Chọn phòng ban--</option>
                                                                                @foreach($departmentList as $row)
                                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Phụ Trách</label>
                                                                            <select id="employee_id" name="employee_id" class="form-control custom-select">
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Time</label>
                                                                            <div class='input-group mb-3'>
                                                                                <input type="text" name="datetimes" class="form-control"/>
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text">
                                                                                        <span class="ti-calendar"></span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Danh mục công việc</label>
                                                                            <select name="task_category_id" class="form-control custom-select">
                                                                                <option value="">--Chọn danh mục task--</option>
                                                                                @foreach($taskCategoryList as $row)
                                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Loại</label>
                                                                            <select name="task_type_id" class="form-control custom-select">
                                                                                <option value="">--Chọn loại task--</option>
                                                                                @foreach($taskTypetList as $row)
                                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Nhóm</label>
                                                                            <select name="task_group_id" class="form-control custom-select">
                                                                                <option value="">--Chọn nhóm task--</option>
                                                                                @foreach($taskGrouptList as $row)
                                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Ưu tiên</label>
                                                                            <select name="task_priority_id" class="form-control custom-select">
                                                                                <option value="">--Chọn độ ưu tiên--</option>
                                                                                @foreach($taskPriorityList as $row)
                                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <textarea name="content" class="form-control" placeholder="Nội dung"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Đính kèm</label>
                                                                            <div class="controls">
                                                                                <input type="file" name="file" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <textarea name="content" placeholder="Ghi chú" class="form-control">Ghi chú</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-actions">
                                                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                                                <button type="button" class="btn btn-inverse">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="card card-outline-danger">
                                                    <div class="card-header">
                                                        <h4 class="mb-0 text-white">Người xem</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-body">
                                                            @foreach($groupEmployee as $key => $group)
                                                            <h4><input id="check_all{{$key}}" type="checkbox"> <strong>{{$group->name}}</strong></h4>
                                                            <div class="checkbox checkbox-danger">
                                                                @foreach($group->groupDetail as $detail)
                                                                <input value="{{$detail->employee->id}}" name="user_follow[]" id="employee{{$detail->employee->id}}" type="checkbox">
                                                                <label for="employee{{$detail->employee->id}}"> {{$detail->employee->name}} </label>
                                                                @endforeach
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane active" id="list" role="tabpanel">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <select class="form-control custom-select">
                                                        <option>Phòng Ban</option>
                                                        <option value="">--Chọn phòng ban--</option>
                                                        @foreach($departmentList as $row)
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <select class="form-control custom-select">
                                                        <option>Nhóm</option>
                                                        @foreach($taskGrouptList as $row)
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <select class="form-control custom-select">
                                                        <option>Loại</option>
                                                        @foreach($taskTypetList as $row)
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <select class="form-control custom-select">
                                                        <option>Ưu tiên</option>
                                                        @foreach($taskPriorityList as $row)
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <select class="form-control custom-select">
                                                        <option>Trạng Thái</option>
                                                        <option>ádf</option>
                                                        <option>ádf</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success btn-block"></i>GO</button>
                                                </div>
                                            </div>
                                        </div>
                                    <a href="{{route('tms.tasknoneproject.kanban')}}" class="float-right btn btn-sm btn-rounded btn-warning">Kanban board</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="taskproject-table" class="display nowrap table table-hover table-striped table-bordered" data-paging="true" cellspacing="0" width="100%">
                                            <thead class="bg-info text-white">
                                                <tr>
                                                    <th>Tên</th>
                                                    <th>Tiến độ</th>
                                                    <th>Phòng ban</th>
                                                    <th>Phụ trách</th>
                                                    <th>Loại</th>
                                                    <th>Ưu Tiên</th>
                                                    <th>TT</th>
                                                    <th>BĐ</th>
                                                    <th>KT</th>
                                                    <th class="text-nowrap">Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="today" role="tabpanel">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <select class="form-control custom-select">
                                                        <option>Phòng Ban</option>
                                                        <option>Art</option>
                                                        <option>Logistic</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <select class="form-control custom-select">
                                                        <option>Nhóm</option>
                                                        <option>ádf</option>
                                                        <option>ádf</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <select class="form-control custom-select">
                                                        <option>Loại</option>
                                                        <option>ádf</option>
                                                        <option>ádf</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <select class="form-control custom-select">
                                                        <option>Ưu tiên</option>
                                                        <option>ádf</option>
                                                        <option>sdf</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <select class="form-control custom-select">
                                                        <option>Trạng Thái</option>
                                                        <option>ádf</option>
                                                        <option>ádf</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success btn-block"></i>GO</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="tms_personal_non_prj_kanban.html" class="float-right btn btn-sm btn-rounded btn-warning">Kanban board</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example234" class="display nowrap table table-hover table-striped table-bordered" data-paging="true" cellspacing="0" width="100%">
                                            <thead class="bg-info text-white">
                                                <tr>
                                                    <th>Tên</th>
                                                    <th>Tiến độ</th>
                                                    <th>Phòng ban</th>
                                                    <th>Nhóm</th>
                                                    <th>Loại</th>
                                                    <th>Ưu Tiên</th>
                                                    <th>TT</th>
                                                    <th>BĐ</th>
                                                    <th>KT</th>
                                                    <th class="text-nowrap">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a href="tms_detail.html">Lunar probe project</a></td>
                                                    <td>
                                                        <div class="progress progress-xs margin-vertical-10 ">
                                                            <div class="progress-bar bg-danger" style="width: 35% ;height:6px;"></div>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><span class="label label-danger">Open</span> </td>
                                                    <td>May 15, 2015</td>
                                                    <td>May 15, 2015</td>
                                                    <td>
                                                        <a href="#" data-toggle="tooltip" data-original-title="Edit"> <i class="fas fa-pencil-alt text-warning"></i></a>
                                                        <a href="#" data-toggle="tooltip" data-original-title="Close"> <i class="fas fa-window-close text-danger"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-sidebar">
                <div class="slimscrollright">
                    <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span>
                    </div>
                    <div class="r-panel-body">
                        <ul id="themecolors" class="mt-3">
                            <li><b>With Light sidebar</b></li>
                            <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                            <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                            <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                            <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme working">4</a></li>
                            <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                            <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                            <li class="d-block mt-4"><b>With Dark sidebar</b></li>
                            <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                            <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a>
                            </li>
                            <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                            <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a>
                            </li>
                            <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                            <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
@endsection
@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}" />
@endpush
@push('script')
<script type="text/javascript" src="{{asset('assets/plugins/daterangepicker/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>

<script>
    $(function() {
        $('#taskproject-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{!! route('tms.tasknoneproject.data') !!}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'progress', name: 'progress' },
                { data: 'department.name', name: 'department' },
                { data: 'assign_user.name', name: 'assign_user' },
                { data: 'task_type.name', name: 'task_type' },
                { data: 'task_priority.name', name: 'task_priority' },
                { data: 'status.name', name: 'status.name' },
                { data: 'start_at', name: 'start_at' },
                { data: 'end_at', name: 'end_at' },
                { data: 'action', name: 'action' },
            ]
        });

        $('input[name="datetimes"]').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'DD/MM/YYYY HH:mm:ss'
            }
        });
    });
    $('#department_id').on('change', function(e){
        e.preventDefault()
        let departmentId = $(this).val();
        let employee = $('#employee_id')
        employee.html('')
        if(departmentId){
            ajaxHandler(BASE_URL + '/api/v1/get-employee-by-department/'+ departmentId +'', 'GET').then(data => {
                handleParentTrigger(data.data, employee)
            })
            .catch(error => alert('Error:', error));
        }
    })

    function handleParentTrigger(data, children){
        optionTag = data.map((val, index) => {
            return '<option value="'+ val.id +'">'+ val.name +'</option>'
        })
        children.append(optionTag)
    }

    
</script>
@endpush