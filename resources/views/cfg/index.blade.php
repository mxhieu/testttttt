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
            <div class="card">
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link border-right active" data-toggle="tab" href="#list" role="tab">Danh sách</a> </li>
                    <li class="nav-item"> <a class="nav-link border-right" data-toggle="tab" href="#add" role="tab">Thêm mới</a> </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="add" role="tabpanel">
                        <div class="card-body">
                            <form action="{{route('crm.config.store', $resource)}}" method="post">
                                @csrf()
                                <div class="form-group row">
                                    <div class="col-8">
                                        <label class="control-label">Tên</label>
                                        <input type="text" required name="name" class="form-control" placeholder="Nhập tên">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Lưu</button>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane active" id="list" role="tabpanel">
                        <div class="card-body">
                            <!-- <div class="table-responsive"> -->
                            <div class="col-md-12">
                                <table class="table" id="config-datatable">
                                    <thead class="bg-info text-white">
                                    <tr>
                                        <th>#</th>
                                        <th>Mã</th>
                                        <th>Tên</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="border border-info">
                                    @foreach($lists as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>
                                                <a href=""><i class="fas fa-edit" style="color: green"></i></a>
                                                <a href=""><i class="fas fa-trash" style="color: red"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer"> © 2019</footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    @push('script')
        <script>
            $('#config-datatable').DataTable();
        </script>
    @endpush
@endsection