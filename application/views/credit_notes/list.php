<style> 
button#dropdown-edit {
    width: 100px;
}       
.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 54% !important;
    right: 9px !important;
}
</style>
<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/estimate'); ?>
    <?php include viewPath('includes/notifications'); ?>
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="card">
            <div class="container-fluid" style="font-size:14px;">                <
                <div class="row">
                    <div class="col">
                        <h2 class="m-0" style="font-size:30px;">Credit Notes</h2>
                        <p style="margin-top: 20px;margin-bottom: 30px; font-size: 16px;">Listing all credit notes.</p>
                    </div>
                    <div class="col-auto">
                        <div class="h1-spacer">                             
                            <a class="btn btn-primary btn-md btn-mobile" data-toggle="modal" data-target="#newJobModal" href="<?php echo url('credit_notes/add_new') ?>">
                                <span class="fa fa-plus"></span> New Credit Note
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tabs">
                    <ul class="clearfix work__order ul-mobile" id="myTab" role="tablist">
                            <li class="active">
                                <a class="nav-link" id="profile-tab" href="<?php echo base_url('estimate/'); ?>" role="tab" aria-controls="profile" aria-selected="false">All(0)</a>
                            </li>
                        <?php foreach($status as $key => $value){ ?>
                            <li <?php echo ((!empty($tab)) && strtolower($value) === $tab) ? "class='active'" : "" ?>>
                                <a class="nav-link" id="profile-tab" data-toggle="tab<?php echo $key ?>" href="<?php echo base_url('estimate/tab/' . strtolower($value)) ?>" role="tab" aria-controls="profile" aria-selected="false"><?php echo $value ?>(0)</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">

                        <?php if (!empty($estimates)) { ?>
                            <table class="table table-hover table-to-list" data-id="work_orders">
                                <thead>
                                <tr>
                                    <th>Credit Note#</th>
                                    <th>Date Issued</th>
                                    <th>Job & Customer</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        <?php } else { ?>
                            <div class="page-empty-container" style="text-align: center;">
                                <h5 class="page-empty-header">You haven't yet added your credit notes</h5>
                                <p class="text-ter margin-bottom">Manage your credit notes.</p>
                                <a class="btn btn-primary" href="<?php echo base_url('credit_notes/add_new') ?>"><span class="fa fa-plus fa-margin-right"></span> New Credit Note</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Modal Send Email  -->
        <div class="modal fade bd-example-modal-md" id="modalSendEmail" tabindex="-1" role="dialog" aria-labelledby="modalSendEmailTitle" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-envelope-open-o"></i> Send to Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php echo form_open_multipart('estimate/_send_customer', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
              <?php echo form_input(array('name' => 'eid', 'type' => 'hidden', 'value' => '', 'id' => 'eid'));?>
              <div class="modal-body">        
                  <p>Are you sure you want to send the selected estimate to customer?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-info">Yes</button>
              </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>

    <!-- end container-fluid -->
</div>

<!-- CONVERT ESTIMATE MODAL -->
<div class="modal fade" id="modalConvertEstimate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Convert Estimate To Work Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="convert-to-work-order-modal-form">
                    <p>
                        You are going create a new work order based on <b>Estimate# <span
                                    id="estimateCustomNumber"></span></b>.<br>
                        The estimate items (e.g. materials, labour) will be copied to this work order.<br>
                        You can always edit/delete work order items as you need.
                    </p>
                    <!-- <div class="checkbox checkbox-sec">
                      <input type="checkbox" name="copy_attachment" value="1" checked="checked" id="ctwo_copy_attachment">
                      <label for="ctwo_copy_attachment"><span>Copy estimate attachments to work order</span></label>
                    </div> -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" data-link="<?php echo base_url('workorder/add/?estimate_id=' . $estimate->id) ?>"
                        class="btn btn-primary" id="button_convert_estimate">Convert To Work Order
                </button>
            </div>
        </div>
    </div>
</div>
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
            <a class="btn btn-primary add-modal__btn-primary" href="<?php echo base_url('estimate/add') ?>"><span class="fa fa-file-text-o"></span> Standard Estimate</a>
        </div>
        <div class="margin-bottom">
            <div class="help help-sm">Customers can select all or only certain options</div>
            <a class="btn btn-primary add-modal__btn-primary" href="<?php echo base_url('estimate/add?type=2') ?>"><span class="fa fa-list-ul fa-margin-right"></span> Options Estimate</a>
        </div>
        <div>
            <div class="help help-sm">Customers can select only one package</div>
            <a class="btn btn-primary add-modal__btn-primary" href="<?php echo base_url('estimate/add?type=3') ?>"><span class="fa fa-cubes"></span> Packages Estimate</a>
        </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<style>
    .hid-deskx {
        display: none !important;
    }


    @media only screen and (max-width: 600px) {
        .hid-desk {
            display: none !important;
        }

        .hid-deskx {
            display: block !important;
        }
    }
</style>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $('#dataTable1').DataTable({

        "ordering": false
    });

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchery = new Switchery(html, {
            size: 'small'
        });
    });

    window.updateUserStatus = (id, status) => {
        $.get('<?php echo url('company/change_status') ?>/' + id, {
            status: status
        }, (data, status) => {
            if (data == 'done') {
                // code
            } else {
                alert('Unable to change Status ! Try Again');
            }
        })
    }

    $(document).ready(function () {

        $(".btn-send-customer").click(function(e){
            var eid = $(this).attr("data-id");
            $("#eid").val(eid);
            $("#modalSendEmail").modal('show');
        });

        // open service address form
        $('#modalConvertEstimate').on('shown.bs.modal', function (e) {

            var element = $(this);

            var estimate_id = $(e.relatedTarget).attr('data-estimate-id');

            $(this).find('#estimateCustomNumber').html(estimate_id);

        });

        $(document).on('click', '#button_convert_estimate', function (e) {

            e.preventDefault();

            location.href = $(this).attr('data-link');
        });
    });
</script>
