<!-- Add -->
<div class="modal fade" id="profile">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Admin Profile</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="profile_update.php?return=<?php echo basename($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
          		  <div class="form-group">
                  	<label for="email" class="col-sm-3 control-label">Email</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="email" name="email" value="<?php echo $admin['email']; ?>"title="Your email address should be in the format: name@example.com" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9"> 
                      <input type="password" class="form-control" id="password" name="password" value="<?php echo $admin['password']; ?>"pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="firstname" class="col-sm-3 control-label">Firstname</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $admin['firstname']; ?>">
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="lastname" class="col-sm-3 control-label">Lastname</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $admin['lastname']; ?>">
                  	</div>
                </div>
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo:</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo">
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="curr_password" class="col-sm-3 control-label">Current Password:</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="curr_password" name="curr_password" placeholder="input current password to save changes" required>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="save"><i class="fa fa-check-square-o"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Transaction History -->
<div class="modal fade" id="transaction">
    <div class="modal-dialog" style="color:black !important;">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Transaction Full Details</b></h4>
            </div>
            <div class="modal-body">
              <p>
                Date: <span id="date"></span>
                <span class="pull-right">Transaction#: <span id="transid"></span></span> 
                <input type="hidden" id="sales_id" />
              </p>
              <p>
                Delivery Details: <span id="date"></span>
                <span class="pull-right"><span id="ship_name"></span></span> <br>
                <span class="pull-right"><span id="ship_num"></span></span> <br>
                <span class="pull-right" style="text-align: right;" ><span id="ship_address"></span></span> 
              </p>
              <table class="table table-bordered">
                <thead>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Subtotal</th>
                </thead>
                <tbody id="detail">
                  <tr>
                    <td colspan="3" align="right"><b>Total</b></td>
                    <td><span id="total"></span></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-right" style="margin-left:10px;" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>