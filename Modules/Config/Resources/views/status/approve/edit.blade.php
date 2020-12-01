@extends('layouts.master')
@section('content')
    @include('config::menu')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('config.approve.update', $approveInfo->id)}}" method="post" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="row col-6">
                            <div class="form-group col-12">
                                <label class="control-label">Trạng thái duyệt</label>
                                <input type="text" id="firstName" name="name" value="{{$approveInfo->name}}" class="form-control" placeholder="Trạng thái abc...">
                            </div>
                            <div class="form-group col-12">
                                <label class="control-label">Key(unique)</label>
                                <input type="text" id="key" name="key" value="{{$approveInfo->key}}" class="form-control" placeholder="success...">
                            </div>
                            <div class="form-group col-12">
                                <label class="control-label">Màu</label>
                                <input type="color" id="color" name="color" value="{{$approveInfo->color}}" class="form-control" placeholder="#abc234...">
                            </div>
                            <div class="form-group col-12">
                                <label class="control-label">Ghi chú</label>
                                <textarea class="form-control" name="remark" id="" cols="30" placeholder="Trạng thái là..." rows="10">{{$approveInfo->remark}}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Lưu</button>
                    </form>
                </div>
            </div>
        </div>
        <footer class="footer"> © 2019</footer>
    </div>
@endsection