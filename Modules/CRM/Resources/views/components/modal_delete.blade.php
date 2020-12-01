<div id="modal-delete-item" class="modal fade in" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Bạn có muốn xoá ?</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xác nhận</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>