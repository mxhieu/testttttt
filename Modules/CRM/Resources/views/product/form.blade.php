@extends('layouts.master')
@section('content')
    @include('crm::menu')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline-info">
                        <div class="card-header">
                            <h4 class="mb-0 text-white">Sản Phẩm</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ isset($data) ? route('crm.products.update', $data->id) : route('crm.products.store')}}" method="post">
                                @isset($data)
                                    @method('PUT')
                                @endisset
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                @include('component.util.lfmImage', [
                                                    'name' => 'images',
                                                    'label' => 'Ảnh',
                                                    'value' => isset($data) ? $data->images : ''
                                                ])
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Tên sản phẩm</label>
                                                        <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm" value="{{old('name', isset($data) ? $data->name : '')}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Mã sản phẩm</label>
                                                        <input type="text" class="form-control" name="code" placeholder="Mã sản phẩm" value="{{old('name', isset($data) ? $data->code : '')}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    @include('crm::components.dropdown', [
                                                        'list' => $types,
                                                        'name' => 'type_id',
                                                        'val' => isset($data) ? $data->type_id : 0,
                                                        'label' => 'Kiểu'
                                                    ])
                                                </div>
                                                <div class="col-md-4">
                                                        @include('crm::components.dropdown', [
                                                        'list' => $kinds,
                                                        'name' => 'kind_id',
                                                        'val' => isset($data) ? $data->kind_id : 0,
                                                        'label' => 'Loại'
                                                    ])
                                                </div>
                                                <div class="col-md-4">
                                                    @include('crm::components.dropdown', [
                                                        'list' => $groups,
                                                        'name' => 'group_id',
                                                        'val' => isset($data) ? $data->group_id : 0,
                                                        'label' => 'Nhóm'
                                                    ])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mt-0 mb-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label>Kích thước</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="number" class="form-control" name="nature[width]" placeholder="Rộng" value="{{old('name', isset($data) ? $data->nature->width : '')}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="number" class="form-control" name="nature[height]" placeholder="Cao" value="{{old('name', isset($data) ? $data->nature->height : '')}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="number" class="form-control" name="nature[length]" placeholder="Dài" value="{{old('name', isset($data) ? $data->nature->length : '')}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    @include('crm::components.dropdown', [
                                                        'list' => $sizes,
                                                        'name' => 'nature[unit_id]',
                                                        'val' => isset($data) ? $data->unit_id : 0
                                                    ])
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            @include('crm::components.dropdown', [
                                                'list' => $colors,
                                                'name' => 'color_id',
                                                'val' => isset($data) ? $data->color_id : 0,
                                                'label' => 'Màu'
                                            ])
                                        </div>
                                        <div class="col-md-4">
                                            @include('config::config.dropdown_multiable', [
                                                'list' => $qualities,
                                                'name' => 'quality_ids[]',
                                                'val' => isset($data) ? $data->quality->pluck('quality_id')->toArray() : [],
                                                'label' => 'Chất lượng'
                                            ])
                                        </div>
                                    </div>
                                    <hr class="mt-0 mb-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Giá</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="number" class="form-control" name="money[min]" placeholder="Thấp nhất" value="{{old('name', isset($data) ? $data->money->min : '')}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="number" class="form-control" name="money[max]" placeholder="Cao nhất" value="{{old('name', isset($data) ? $data->money->max : '')}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    @include('crm::components.dropdown', [
                                                        'list' => $moneyUnits,
                                                        'name' => 'money[unit_id]',
                                                        'val' => isset($data) ? $data->money->unit_id : 0
                                                    ])
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <label>Số lượng / 1 đơn hàng</label>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="number" class="form-control" name="quantity[min]" placeholder="Thấp nhất" value="{{old('name', isset($data) ? $data->quantity->min : '')}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="number" class="form-control" name="quantity[max]" placeholder="Cao nhất" value="{{old('name', isset($data) ? $data->quantity->max : '')}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    @include('crm::components.dropdown', [
                                                        'list' => $units,
                                                        'name' => 'quantity[unit_id]',
                                                        'val' => isset($data) ? $data->quantity->unit_id : 0
                                                    ])
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <label>Tổng số sản phẩm</label>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="totalQuantity" placeholder="Tổng số sản phẩm" value="{{old('name', isset($data) ? $data->sold : 0)}}" />
                                            </div>

                                        </div>
                                        @isset($data)
                                        <div class="col-md-4">
                                            <label>Sản phẩm đã bán</label>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="number" disabled class="form-control" value="{{$data->sold}}" />
                                            </div>

                                        </div>
                                            @endisset
                                    </div>
                                    <hr class="mt-0 mb-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Mô tả</label>
                                            <textarea class="form-control" name="description">{{old('name', isset($data) ? $data->description : '')}}</textarea>
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
                                <hr class="mt-0 mb-5">
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ isset($data) ? 'Cập nhật' : 'Thêm' }}</button>
                                    <a href="{{route('crm.products.index')}}" class="btn btn-inverse">Huỷ</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{asset('assets/plugins/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
@endpush

@push('style')
    <link href="{{asset('assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endpush