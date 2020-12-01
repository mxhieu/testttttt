@extends('layouts.master')
@section('content')
    @include('crm::menu')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline-info">
                        <div class="card-header">
                            <h4 class="mb-0 text-white">Liên hệ</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ isset($data) ? route('crm.contacts.update', $data->id) : route('crm.contacts.store', $customer)}}" method="post">
                                @isset($data)
                                    @method('PUT')
                                @endisset
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Tên</label>
                                                <input type="text" required class="form-control" name="name" placeholder="Tên" value="{{ old('name', isset($data) ? $data->name : '') }}" />
                                                <span class="error">{{$errors->first('name')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email', isset($data) ? $data->email : '') }}" />
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
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    @include('crm::config.position', [
                                                        'val' => isset($data) ? $data->position_id : 0
                                                    ])
                                                </div>
                                                <div class="col-md-4">
                                                    @include('crm::config.department', [
                                                        'val' => isset($data) ? $data->department_id : 0
                                                    ])
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Mô tả</label>
                                                        <textarea class="form-control" name="description">{{ old('description', isset($data) ? $data->description : '')}}</textarea>
                                                        <span class="error">{{$errors->first('description')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ isset($data) ? 'Cập nhật' : 'Thêm' }}</button>
                                    <a href="{{route('crm.contacts.index')}}" class="btn btn-inverse">Huỷ</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection