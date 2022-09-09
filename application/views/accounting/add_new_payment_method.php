<!-- Modal -->
<div class="modal fade" id="add_new_payment_method" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog"  id="modal-dialog2" role="document" style="width:500px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align:left;">New Payment Method</h5>
        <button name="button" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url()?>accounting/savepaymethod" method="post">
          Name <br>
          <input type="text" name="new_pay_method" class="form-control"><br>
          <input type="submit" value="Save" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        <button name="button" type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>