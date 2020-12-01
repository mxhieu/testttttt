
@extends('layouts.master')
@section('content')
    @include('config::menu')
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="card">
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item active"> <a class="nav-link border-right" data-toggle="tab" href="#thongtin" role="tab">Thông tin</a> </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="thongtin" role="tabpanel">
                        <div class="card-body">
                            <form action="" method="post" accept="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                @include('component.util.lfmImage', [
                                                    'name' => 'logo',
                                                    'label' => __('Logo'),
                                                    'value' => !empty($company) ? $company->logo : ''
                                                ])
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input name="name" value="{{!empty($company) ? $company->name : ''}}" class="form-control" type="text" placeholder="Tên Công ty">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-6">
                                                    <input name="tax_code" value="{{!empty($company) ? $company->tax_code : ''}}" class="form-control" type="text" placeholder="MST">
                                                </div>
                                                <div class="col-6">
                                                    <input name="branch" value="{{!empty($company) ? $company->branch : ''}}" class="form-control" type="text" placeholder="Lĩnh Vực">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-12 pt-5">
                                                    <input name="address" value="{{!empty($company) ? $company->address : ''}}" class="form-control" type="text" placeholder="Địa chỉ">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-6">
                                                    <input name="email" value="{{!empty($company) ? $company->email : ''}}" class="form-control" type="text" placeholder="Email">
                                                </div>
                                                <div class="col-6">
                                                    <input name="website" value="{{!empty($company) ? $company->website : ''}}" class="form-control" type="text" placeholder="Website">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Chú thích</label>
                                                <textarea name="remark" class="form-control" rows="5">{{!empty($company) ? $company->remark : ''}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Lưu</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>                        
                </div>
            </div>
        </div>
        <footer class="footer"> © 2019</footer>
    </div>
@endsection