@extends('layouts.master')
@section('content')
    @include('crm::menu')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline-info">
                        <div class="card-header">
                            <h4 class="mb-0 text-white">Phiếu bán hàng</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ isset($data) ? route('crm.sales.update', $data->id) : route('crm.sales.store')}}" method="post">
                                @isset($data)
                                    @method('PUT')
                                @endisset
                                @csrf
                                <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Tên Phiếu</label>
                                                    <input type="text" class="form-control" name="name" placeholder="Tên Phiếu" value="{{isset($data) ? $data->name : ''}}" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                @include('crm::components.dropdown', [
                                                    'list' => $customers,
                                                    'val' => isset($data) ? $data->customer_id : 0,
                                                    'name' => 'customer_id',
                                                    'label' => 'Khách hàng'
                                                ])
                                            </div>
                                        </div>

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
                                                @include('crm::config.status',[
                                                    'list' => $statuses,
                                                    'val' => isset($data) ? $data->status_id : 0
                                                ])
                                            </div>
                                            <div class="col-md-3">
                                                @include('crm::config.sale_kind', [
                                                    'val' => isset($data) ? $data->kind_id : 0,
                                                    'list' => $kinds
                                                ])
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Mô tả</label>
                                                <textarea class="form-control" name="description">{{isset($data) ? $data->description : ''}}</textarea>
                                            </div>
                                        </div>
                                </div>
                                <hr class="mt-0 mb-5">
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ isset($data) ? 'Cập nhật' : 'Thêm' }}</button>
                                    <a href="{{route('crm.sales.index')}}" class="btn btn-inverse">Huỷ</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection