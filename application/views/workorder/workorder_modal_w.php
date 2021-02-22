<div class="modal fade" id="workordermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Work Order</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
              <p class="text-lg margin-bottom">
                  What type of Work Order you want to create
              </p><center>
              <div class="margin-bottom text-center" style="width:60%;">
                  <div class="help help-sm">Create new work Order</div>
                  <a class="btn btn-primary add-modal__btn-success" style="background-color: #2ab363 !important" href="<?php echo base_url('workorder/NewworkOrder') ?>"><span class="fa fa-file-text-o"></span> New Work Order</a>
              </div>
              <div class="margin-bottom" style="width:60%;">
                  <div class="help help-sm">Existing Work Order</div>
                  <a class="btn btn-primary add-modal__btn-success" style="background-color: #2ab363 !important" href="<?php echo base_url('workorder/NewworkOrder?type=2') ?>"><span class="fa fa-list-ul fa-margin-right"></span> Existing </a>
              </div></center>
        </div>
    </div>
</div>