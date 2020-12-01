@extends('layouts.master')
@section('content')
    @include('event::menu')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <ul class="nav nav-tabs profile-tab" role="tablist">
                            <li class="nav-item"> <a class="nav-link border-right" data-toggle="tab" href="#add" role="tab">Thêm mới</a> </li>
                            <li class="nav-item"> <a class="nav-link border-right active" data-toggle="tab" href="#list" role="tab">Tất cả</a> </li>
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
                                                                    <div class="col-md-9">
                                                                        <div class="form-group">
                                                                            <label>Sự kiện</label>
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
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Nhóm</label>
                                                                            <select id="group_id" name="group_id" class="form-control custom-select">
                                                                                <option value="">--Chọn nhóm--</option>
                                                                                @foreach($groupEmployee as $row)
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
                                                                            <select name="cfg_event_category_id" class="form-control custom-select">
                                                                                <option value="">--Chọn danh mục sự kiện--</option>
                                                                                @foreach($eventCategoryList as $row)
                                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Loại</label>
                                                                            <select name="cfg_event_type_id" class="form-control custom-select">
                                                                                <option value="">--Chọn loại sự kiện--</option>
                                                                                @foreach($eventTypeList as $row)
                                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Nhóm</label>
                                                                            <select name="cfg_event_group_id" class="form-control custom-select">
                                                                                <option value="">--Chọn nhóm sự kiện--</option>
                                                                                @foreach($eventGroupList as $row)
                                                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>Ưu tiên</label>
                                                                            <select name="cfg_event_priority_id" class="form-control custom-select">
                                                                                <option value="">--Chọn độ ưu tiên--</option>
                                                                                @foreach($eventPriorityList as $row)
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
                                                                            @include('component.util.lfmFile', [
                                                                                'name' => 'file',
                                                                                'label' => 'Chọn file',
                                                                                'value' => isset($data) ? $data->files : ''
                                                                            ])
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
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <select class="form-control custom-select">
                                                        <option>Nhóm</option>
                                                        @foreach($eventGroupList as $row)
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <select class="form-control custom-select">
                                                        <option>Loại</option>
                                                        @foreach($eventTypeList as $row)
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <select class="form-control custom-select">
                                                        <option>Ưu tiên</option>
                                                        @foreach($eventPriorityList as $row)
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
                                    <a href="{{route('event.event.calendar')}}" class="float-right btn btn-sm btn-rounded btn-warning">Lịch</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="event-table" class="display nowrap table table-hover table-striped table-bordered" data-paging="true" cellspacing="0" width="100%">
                                            <thead class="bg-info text-white">
                                                <tr>
                                                    <th>Sự kiện</th>
                                                    <th>Nhóm</th>
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
        $('#event-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{!! route('event.event.data') !!}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'group.name', name: 'group' },
                { data: 'assign_user.name', name: 'assignUser' },
                { data: 'event_type.name', name: 'event_type' },
                { data: 'event_priority.name', name: 'event_priority' },
                { data: 'status.name', name: 'status' },
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
    $('#group_id').on('change', function(e){
        e.preventDefault()
        let groudId = $(this).val();
        let employee = $('#employee_id')
        employee.html('')
        if(groudId){
            ajaxHandler(BASE_URL + '/api/v1/get-employee-by-group/'+ groudId +'', 'GET').then(data => {
                handleParentTrigger(data.data.group_detail, employee)
            })
            .catch(error => alert('Error:' + error));
        }
    })

    function handleParentTrigger(data, children){
        optionTag = data.map((val, index) => {
            return '<option value="'+ val.employee.id +'">'+ val.employee.name +'</option>'
        })
        children.append(optionTag)
    }
</script>
@endpush