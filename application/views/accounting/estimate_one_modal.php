<div class="modal fade" id="newJobModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Estimate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <p class="text-lg margin-bottom">
          What type of estimate you want to create
        </p>
        <center>
          <div class="margin-bottom text-center" style="width:60%;">
            <div class="help help-sm">Create a regular estimate with items</div>
            <a class="btn btn-primary add-modal__btn-success" data-estimate-type="standard" style="background-color: #2ab363 !important"
              href="<?php echo base_url('accounting/addNewEstimate') ?>"><span
                class="fa fa-file-text-o"></span> Standard Estimate</a>
          </div>
          <div class="margin-bottom" style="width:60%;">
            <div class="help help-sm">Customers can select all <br>or only certain options</div>
            <a class="btn btn-primary add-modal__btn-success" style="background-color: #2ab363 !important"  data-estimate-type="options" 
              href="<?php echo base_url('accounting/addNewEstimateOptions?type=2') ?>"><span
                class="fa fa-list-ul fa-margin-right"></span> Options Estimate</a>
          </div>
          <div class="margin-bottom" style="width:60%;">
            <div class="help help-sm">Customers can select both Bundle Packages to obtain an overall discount</div>
            <a class="btn btn-primary add-modal__btn-success" style="background-color: #2ab363 !important" data-estimate-type="bundle" 
              href="<?php echo base_url('accounting/addNewEstimateBundle?type=3') ?>"><span
                class="fa fa-cubes"></span> Bundle Estimate</a>
          </div>
        </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


       
<!-- Estimate change status modal -->
<!-- The Modal -->
<div class="modal fade" id="estchangestatus" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update estimate status <span id="est_number_status"></span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <p>Status</p>
                <select class="form-control est_status" name="est_status">
                    <!-- <option value="Draft">Draft</option> -->
                    <option value="Submitted">Submitted</option>
                    <option value="Accepted">Accepted</option>
                    <option value="Invoiced">Invoiced</option>
                    <option value="Lost">Lost</option>
                    <option value="Declined By Customer">Declined By Customer</option>
                </select>

                <input type="hidden" class="estID" name="estID">
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <a href="#" type="submit" class="btn btn-success update_est_status">OK</a>
            </div>
        
        </div>
    </div>
</div>

<!-- Estimate send customer -->
<!-- The Modal -->
<div class="modal fade" id="sendESTemail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Send email for <span id="est_number_email"></span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <p><b>To</b></p>
                <input type="text" class="form-control custEmail" name="custEmail">

                <p><b>Subject</b></p>
                <input type="text" class="form-control custsubject" name="custsubject" value="Estimate [Estimate No.] from <?php echo $clients->business_name; ?>">

                <p><b>Message</b></p>
                <textarea class="form-control custmessage" name="custmessage" style="height:200px;"></textarea>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <a href="#" type="submit" class="btn btn-success send_est">Send</a>
            </div>
        
        </div>
    </div>
</div>