<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Product</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="cart_add.php">
                <input type="hidden" class="userid" name="id">
                <div class="form-group">
                    <label for="product" class="col-sm-3 control-label">Product</label>

                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="product" id="product" required>
                        <option value="" selected>- Select -</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantity" class="col-sm-3 control-label">Quantity</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="quantity" name="quantity" value="1" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>




