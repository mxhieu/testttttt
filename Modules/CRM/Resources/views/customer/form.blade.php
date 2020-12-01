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
                            <h4 class="mb-0 text-white">Khách Hàng</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ isset($data) ? route('crm.customers.update', $data->id) : route('crm.customers.store')}}" method="post">
                                @isset($data)
                                    @method('PUT')
                                @endisset
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                @include('component.util.lfmImage', [
                                                    'name' => 'logo',
                                                    'label' => __('Logo'),
                                                    'value' => isset($data) ? $data->logo : ''
                                                ])
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Tên công ty</label>
                                                        <input type="text" required class="form-control" name="name" placeholder="Tên công ty" value="{{ old('name', isset($data) ? $data->name : '') }}" />
                                                        <span class="error">{{$errors->first('name')}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Mã số thuế</label>
                                                        <input type="text" class="form-control" name="tax_id" required placeholder="Mã số thuế" value="{{ old('tax_id', isset($data) ? $data->tax_id : '') }}" />
                                                        <span class="error">{{$errors->first('tax_id')}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Địa chỉ</label>
                                                        <input type="text" class="form-control" name="address" required placeholder="Địa chỉ" value="{{ old('address', isset($data) ? $data->address : '') }}" />
                                                        <span class="error">{{$errors->first('address')}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    @include('crm::config.market', [
                                                        'val' => isset($data) ? $data->market_id : 0,
                                                        'list' => $markets
                                                    ])
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email', isset($data) ? $data->email : '') }}" required />
                                                        <span class="error">{{$errors->first('email')}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Phone</label>
                                                        <input type="text" required class="form-control" name="phone" placeholder="Phone" value="{{ old('phone', isset($data) ? $data->phone : '') }}" />
                                                        <span class="error">{{$errors->first('phone')}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Website</label>
                                                        <input type="text" class="form-control" name="website" placeholder="website" value="{{ old('website', isset($data) ? $data->website : '') }}" />
                                                        <span class="error">{{$errors->first('website')}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Ngày</label>
                                                        <input type="date" class="form-control" name="find_at" value="{{ old('find_at', isset($data) ? $data->find_at : '') }}" />
                                                        <span class="error">{{$errors->first('find_at')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mt-0 mb-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            @include('crm::config.customer_kind', [
                                                'val' => isset($data) ? $data->kind_id : 0,
                                                'list' => $kinds
                                            ])
                                        </div>

                                        <div class="col-md-4">
                                            @include('crm::config.customer_type', [
                                                'val' => isset($data) ? $data->type_id : 0,
                                                'list' => $types
                                            ])
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            @include('crm::config.customer_group', [
                                                'val' => isset($data) ? $data->group_id : 0,
                                                'list' => $groups
                                            ])
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            @include('crm::config.channel', [
                                                'val' => isset($data) ? $data->channel_id : 0,
                                                'list' => $channels
                                            ])
                                        </div>

                                        <div class="col-md-4">
                                            @include('crm::config.relation', [
                                                'val' => isset($data) ? $data->relation_id : 0,
                                                'list' => $relations
                                            ])
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            @include('crm::config.employee', [
                                                'val' => isset($data) ? $data->employee_id : 0,
                                                'list' => $employees
                                            ])
                                        </div>
                                        <!--/span-->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">Mô tả</label>
                                            <textarea class="form-control" name="description">{{ old('description', isset($data) ? $data->description : '') }}</textarea>
                                            <span class="error">{{$errors->first('description')}}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ isset($data) ? 'Cập nhật' : 'Thêm' }}</button>
                                    <a href="{{route('crm.customers.index')}}" class="btn btn-inverse">Huỷ</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection