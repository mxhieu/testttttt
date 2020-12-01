@extends('layouts.master')
@section('content')
    @include('config::menu')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-outline-info">
                                <div class="card-header">
                                    <h4 class="mb-0 text-white">Thêm nhân sự</h4>
                                </div>
                                <div class="card-body">
                                    <form action="#" method="post" accept="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12 ">
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
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label>Nhân sự</label>
                                                        <select id="employee_id" name="employee_id" class="form-control custom-select"></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label>Vai trò</label>
                                                        <select class="form-control" name="role_id" id="role_id">
                                                            @foreach(config('const')['USER_ROLE'] as $key => $val)
                                                            <option value="{{$key}}">{{$val}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Thêm mới</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card card-outline-success">
                                <div class="card-header">
                                    <h4 class="mb-0 text-white">Danh sách nhóm</h4>
                                </div>
                                <div class="card-body">
                                    <div id="result-alert"></div>
                                    <table class="table" id="groupdetail-table">
                                        <thead class="bg-info text-white">
                                            <tr>
                                                <th>#</th>
                                                <th>Phòng ban</th>
                                                <th>Nhân viên</th>
                                                <th>Vai trò</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
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
        $('#groupdetail-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{!! route('config.groupdetail.data', $groudId) !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'employee.department.name', name: 'department' },
                { data: 'employee.name', name: 'employee' },
                { data: 'role', name: 'role' },
                { data: 'action', name: 'action' }
            ]
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

        $(document).on('change', '.update_role_id', function(e){
            e.preventDefault()
            let url = $(this).attr('data-url')
            let roleId = $(this).val()
            if(url){
                ajaxHandler(url, 'POST', {"role_id": roleId}).then(data => {
                    toast(data.msg, "success")
                })
                .catch(error => toast(data.msg, "error"));
            }
        })

        function handleParentTrigger(data, children){
            optionTag = data.map((val, index) => {
                return '<option value="'+ val.id +'">'+ val.name +'</option>'
            })
            children.append(optionTag)
        }
    });
</script>
@endpush