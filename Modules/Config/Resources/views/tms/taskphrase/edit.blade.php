@extends('layouts.master')
@section('content')
    @include('config::menu')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('config.taskphrase.update', $taskPhraseInfo->id)}}" method="post" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="row col-6">
                            <div class="form-group col-12">
                                <label class="control-label">Loại công việc</label>
                                <input type="text" id="firstName" name="name" value="{{$taskPhraseInfo->name}}" class="form-control" placeholder="Công việc abc...">
                            </div>
                            <div class="form-group col-12">
                                <label class="control-label">Ghi chú</label>
                                <textarea class="form-control" name="remark" id="" cols="30" placeholder="Công việc bao gồm..." rows="10">{{$taskPhraseInfo->remark}}</textarea>
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