<div class="modal fade" id="newJobModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <div class="margin-bottom">
            <div class="help help-sm">Create a regular estimate with items</div>
            <a class="btn btn-primary add-modal__btn-primary" href="<?php echo base_url('accounting/addNewEstimate') ?>"><span class="fa fa-file-text-o"></span> Standard Estimate</a>
        </div>
        <div class="margin-bottom">
            <div class="help help-sm">Customers can select all or only certain options</div>
            <a class="btn btn-primary add-modal__btn-primary" href="<?php echo base_url('accounting/addNewEstimateOptions?type=2') ?>"><span class="fa fa-list-ul fa-margin-right"></span> Options Estimate</a>
        </div>
        <div>
            <div class="help help-sm">Customers can select only one package</div>
            <a class="btn btn-primary add-modal__btn-primary" href="<?php echo base_url('accounting/addNewEstimateBundle?type=3') ?>"><span class="fa fa-cubes"></span> Packages Estimate</a>
        </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>