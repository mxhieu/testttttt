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
                            <h4 class="mb-0 text-white">Hoạt động</h4>
                        </div>
                        <div class="card-body">
                            <form  action="{{ isset($data) ? route('crm.activities.update', $data->id) : route('crm.activities.store', $customer)}}" method="post">
                                @csrf
                                @isset($data)
                                    @method('PUT')
                                @endisset
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tên</label>
                                                <input type="text" class="form-control" name="name"  placeholder="Tên" value="{{ old('name', isset($data) ? $data->name : '') }}" required/>
                                                <span class="error">{{$errors->first('name')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Nhận xét</label>
                                            <textarea class="form-control" name="remark">{{ old('remark', isset($data) ? $data->remark : '') }}</textarea>
                                            <span class="error">{{$errors->first('remark')}}</span>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    @include('crm::config.activity_kind', [
                                                        'val' => isset($data) ? $data->kind_id : 0,
                                                        'list' => $kinds
                                                    ])
                                                </div>
                                                <div class="col-md-3">
                                                    @include('crm::config.activity_type', [
                                                        'val' => isset($data) ? $data->type_id : 0,
                                                        'list' => $types
                                                    ])
                                                </div>
                                                <div class="col-md-3">
                                                    @include('crm::config.activity_group', [
                                                        'val' => isset($data) ? $data->group_id : 0,
                                                        'list' => $groups
                                                    ])
                                                </div>
                                                <div class="col-md-3">
                                                    @include('crm::config.status', [
                                                        'val' => isset($data) ? $data->status_id : 0,
                                                        'list' => $statues
                                                    ])
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Bắt đầu</label>
                                                        <input type="date" class="form-control" name="start_at" value="{{ old('start_at', isset($data) ? $data->start_at : '') }}" />
                                                        <span class="error">{{$errors->first('start_at')}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Kết thúc</label>
                                                        <input type="date" class="form-control" name="end_at" value="{{ old('end_at', isset($data) ? $data->end_at : '') }}" />
                                                        <span class="error">{{$errors->first('end_at')}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Hoàn thành</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" value="{{ old('complete', isset($data) ? $data->complete : '') }}" name="complete" placeholder="Hoàn thành" required>
                                                        <div class="input-group-append">
                                <span class="input-group-text product-real-unit">%</span>
                                                        </div>
                                                        <span class="error">{{$errors->first('complete')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ isset($data) ? 'Cập nhật' : 'Thêm' }}</button>
                                    <a href="{{route('crm.activities.index')}}" class="btn btn-inverse">Huỷ</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection