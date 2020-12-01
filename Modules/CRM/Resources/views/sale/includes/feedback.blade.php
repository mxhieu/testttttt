<div class="card-body">
    <div class="col-md-12">
        <a href="javascript:void(0)" data-toggle="modal"
           data-target="#sale-modal-feedback" class="btn hidden-sm-down btn-success mb-3"><i class="mdi mdi-plus-circle"></i> Thêm</a>
    </div>
    <div class="table-responsive m-t-40">
    <div class="col-md-12">
        <table class="table" id="crm-sale-feedback-table" data-datatable="{{route('crm.feedback.datatable', $data->id)}}">
            <thead class="bg-info text-white">
            <tr>
                <th>#</th>
                <th>Ngày</th>
                <th>Nội dung</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody class="border border-info">

            </tbody>
        </table>
    </div>
    </div>
</div>

<div id="sale-modal-feedback" class="modal fade in" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Thêm mới</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <from class="form-horizontal form-feedback">
                    <div class="form-group">
                        <label class="col-md-12">Nội dung</label>
                        <div class="col-md-12">
                            <textarea class="form-control" name="content"> </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Ngày</label>
                            <input type="date" class="form-control" name="date" value="" />
                        </div>
                    </div>
                </from>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info waves-effect btn-save-feedback" data-route="{{route('crm.feedback.store')}}">Save</button>
                <button type="button" class="btn btn-default waves-effect"
                        data-dismiss="modal">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>