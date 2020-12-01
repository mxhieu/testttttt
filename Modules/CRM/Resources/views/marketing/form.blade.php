@extends('layouts.master')
@section('content')
    @include('crm::menu')
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline-info">
                        <div class="card-header">
                            <h4 class="mb-0 text-white">Marketing</h4>
                        </div>
                        <div class="card-body">
                            <form  action="{{ isset($data) ? route('crm.marketing.update', $data->id) : route('crm.marketing.store')}}" method="post">
                                @if($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                @endif
                                @csrf
                                @isset($data)
                                    @method('PUT')
                                @endisset
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tên</label>
                                                <input type="text" class="form-control" name="name"  placeholder="Tên" value="{{isset($data) ? $data->name : ''}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Nhận xét</label>
                                            <textarea class="form-control" name="remark">{{isset($data) ? $data->remark : ''}}</textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Bắt đầu</label>
                                                        <input type="date" class="form-control" name="start_at" value="{{isset($data) ? $data->start_at : ''}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Kết thúc</label>
                                                        <input type="date" class="form-control" name="end_at" value="{{isset($data) ? $data->end_at : ''}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    @include('crm::components.dropdown', [
                                                        'list' => $employeesGroup,
                                                        'val' => isset($data) ? $data->user_group_id : 0,
                                                        'name' => 'user_group_id',
                                                        'label' => 'Nhóm nhân viên'
                                                ])

                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Phụ trách</label>
                                                        <select class="form-control custom-select" name="in_charge_id" required>
                                                            @foreach($employee as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    @include('crm::config.marketing_kind', [
                                                        'val' => isset($data) ? $data->kind_id : 0,
                                                        'list' => $kinds
                                                    ])
                                                </div>
                                                <div class="col-md-3">
                                                    @include('crm::config.marketing_type', [
                                                        'val' => isset($data) ? $data->type_id : 0,
                                                        'list' => $types
                                                    ])
                                                </div>
                                                <div class="col-md-3">
                                                    @include('crm::config.marketing_group', [
                                                        'val' => isset($data) ? $data->group_id : 0,
                                                        'list' => $groups
                                                    ])
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="controls">
                                                @include('component.util.lfmFile', [
                                                     'name' => 'files',
                                                     'label' => 'Chọn file',
                                                     'value' => isset($data) ? $data->files : ''
                                                 ])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ isset($data) ? 'Cập nhật' : 'Thêm' }}</button>
                                    <button type="button" class="btn btn-inverse">Huỷ</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection