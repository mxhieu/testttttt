<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <a href="" class="btn btn-success">Contact</a>
                <a href="" class="btn btn-success">Activity</a>
                <a href="" class="btn btn-success">Contract</a>
                <a href="" class="btn btn-success">Payment</a>
                <a href="" class="btn btn-success">Delivery</a>
            </div>
            <div class="card-body">
                <div class="card">
                    <ul class="nav nav-tabs profile-tab" role="tablist">
                        <li class="nav-item"> <a class="nav-link border-right" data-toggle="tab" href="#add" role="tab">Thêm mới</a> </li>
                        <li class="nav-item"> <a class="nav-link border-right active" data-toggle="tab" href="#list" role="tab">Danh sách</a> </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="add" role="tabpanel">
                            <div class="card-body">
                                <form action="#">
                                    <div class="form-group row">
                                        <div class="col-8">
                                            <label class="control-label">Loại khách hàng</label>
                                            <input type="text" id="firstName" class="form-control" placeholder="John doe">
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
                                    <table class="table">
                                        <thead class="bg-info text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Mã</th>
                                            <th>Loại khách hàng</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="border border-info">
                                        <tr>
                                            <td>1</td>
                                            <td>NL</td>
                                            <td>Nguyên liệu</td>
                                            <td>
                                                <a href=""><i class="fas fa-edit" style="color: green"></i></a>
                                                <a href=""><i class="fas fa-trash" style="color: red"></i></a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>