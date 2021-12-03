<style>
button#dropdown-edit {
    width: 100px;
}
label>input {
  visibility: initial !important;
  position: initial !important; 
}
.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 54% !important;
    right: 9px !important;
}
.customer-name{
    display: block;
    font-size: 13px;
    color: #2ab363;
}
.dropdown-menu .divider {
    height: 1px;
    margin: 9px 0;
    overflow: hidden;
    background-color: #e5e5e5;
}
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  margin-bottom: 0px !important;
  padding-top: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding: 0px 25px !important;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 5px !important;
  padding-left: 5px !important;
  margin-top: 55px !important;
}
.subtle-txt {
    color: rgba(42, 49, 66, 0.7);
}
svg#svg-sprite-menu-close {
    position: relative;
    bottom: 180px !important;
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
</style>
<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/notifications'); ?>
    <div wrapper__section class="p-40">
        <div class="card p-20">
            <div class="container-fluid" style="font-size:14px;">
                <div class="row">
                    <div class="col">
                      <h3 class="page-title mt-0">Credit Notes</h3>
                    </div>
                    <div class="col-auto">
                        <div class="h1-spacer">
                            <a class="btn btn-primary btn-md" href="<?php echo url('credit_notes/add_new') ?>">
                                <span class="fa fa-plus"></span> New Credit Note
                            </a>
                            <a class="btn btn-primary btn-md" href="<?php echo url('credit_notes/settings') ?>">
                                <span class="fa fa-gear"></span> Credit Note Settings
                            </a>
                        </div>
                    </div>
                </div>
                <div class="pl-3 pr-3 mt-2 row" style="position: relative;top: 7px;">
                  <div class="col mb-4 left alert alert-warning mt-0 mb-0">
                      <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Give your customer a credit or refund in our Desktop for Windows. From the Customers menu, select Create Credit Notes/Refunds.  From the Customer:  Job drop-down, select your customer.  Enter the items you're giving a credit for, then select Save & Close.</span>
                  </div>
                </div>
                <div class="tabs mt-2">
                    <ul class="clearfix work__order ul-mobile" id="myTab" role="tablist">
                            <li class="<?= $tab == '' ? 'active' : ''; ?>">
                                <a class="nav-link" id="profile-tab" href="<?php echo base_url('credit_notes/'); ?>" role="tab" aria-controls="profile" aria-selected="false">All(<?= $total_all; ?>)</a>
                            </li>
                        <?php foreach($status as $key => $value){ ?>
                            <?php
                                $total = $statusSummary[$key];
                            ?>
                            <li class="<?= $tab == $key ? 'active' : ''; ?>">
                                <a class="nav-link" id="profile-tab" data-toggle="tab<?php echo $key ?>" href="<?php echo base_url('credit_notes/tab/' . strtolower($key)) ?>" role="tab" aria-controls="profile" aria-selected="false"><?php echo $value ?>(<?= $total; ?>)</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">

                        <?php if (!empty($creditNotes)) { ?>
                            <table class="table table-hover table-to-list" data-id="work_orders">
                                <thead>
                                <tr>
                                    <th>Credit Note#</th>
                                    <th>Date Issued</th>
                                    <th>Job & Customer</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th style="width: 5%;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($creditNotes as $c){ ?>
                                        <tr>
                                            <td><?= $c->credit_note_number; ?></td>
                                            <td><?= date("m/d/Y",strtotime($c->date_issued)); ?></td>
                                            <td>
                                                <span class="job-name"><?= $c->job_name ?></span>
                                                <span class="customer-name">Customer : <?= $c->first_name . ' ' . $c->last_name; ?></span>
                                            </td>
                                            <td><?= $status[$c->status]; ?></td>
                                            <td><?= number_format($c->grand_total, 2); ?></td>
                                            <td class="text-right">
                                            <div class="dropdown dropdown-btn">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                    <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                    <li role="presentation">
                                                        <a role="menuitem" href="<?php echo base_url('credit_notes/send/' . $c->id) ?>" class="btn-send-customer" data-id="<?= $c->id; ?>">
                                                        <span class="fa fa-envelope-open-o icon"></span>  Send to Customer</a></li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                               href="<?php echo base_url('credit_notes/view/' . $c->id) ?>"><span
                                                                    class="fa fa-file-text-o icon"></span> View</a></li>
                                                    </li>
                                                    <li role="separator" class="divider"></li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                               href="<?php echo base_url('credit_notes/edit/' . $c->id) ?>"><span
                                                                    class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a role="menuitem" class="clone-credit-note" href="javascript:void(0);" data-name="<?= $c->credit_note_number; ?>" data-id="<?= $c->id; ?>">
                                                        <span class="fa fa-files-o icon"></span>  Clone</a></li>
                                                    <li role="presentation">
                                                        <a role="menuitem" class="close-credit-note" href="javascript:void(0);" data-name="<?= $c->credit_note_number; ?>" data-id="<?= $c->id; ?>"><span class="fa fa-files-o icon"></span> Close</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a role="menuitem" class="delete-credit-note" href="javascript:void(0);" data-id="<?= $c->id; ?>"><span class="fa fa-trash-o icon"></span> Delete</a>
                                                    <li role="separator" class="divider"></li>
                                                    <li role="presentation">
                                                        <a role="menuitem" href="<?php echo base_url('credit_notes/view_pdf/' . $c->id) ?>" class="">
                                                        <span class="fa fa-file-pdf-o icon"></span>  View PDF</a></li>
                                                    <li role="presentation">
                                                        <a role="menuitem" target="_new" href="<?php echo base_url('credit_notes/print/' . $c->id) ?>" class="">
                                                        <span class="fa fa-print icon"></span>  Print</a></li>

                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                        <?php if( $total_all <= 0 ){ ?>
                            <div class="page-empty-container" style="text-align: center;">
                                <h5 class="page-empty-header">You haven't yet added your credit notes</h5>
                                <p class="text-ter margin-bottom">Manage your credit notes.</p>
                                <a class="btn btn-primary" href="<?php echo base_url('credit_notes/add_new') ?>"><span class="fa fa-plus fa-margin-right"></span> New Credit Note</a>
                            </div>
                        <?php }else{ ?>
                          <table class="table table-hover table-to-list" data-id="work_orders">
                                <thead>
                                <tr>
                                    <th>Credit Note#</th>
                                    <th>Date Issued</th>
                                    <th>Job & Customer</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th style="width: 5%;"></th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                          </table>
                        <?php } ?>
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
          <?php echo form_input(array('name' => 'cnid', 'type' => 'hidden', 'value' => '', 'id' => 'cnid'));?>
          <div class="modal-body">
              <p>Are you sure you want to send the selected credit note to customer?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-info">Yes</button>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>

    <!-- Modal Delete Credit Note  -->
    <div class="modal fade bd-example-modal-md" id="modalDeleteCreditNote" tabindex="-1" role="dialog" aria-labelledby="modalDeleteCreditNoteTitle" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php echo form_open_multipart('credit_notes/delete', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
          <?php echo form_input(array('name' => 'eid', 'type' => 'hidden', 'value' => '', 'id' => 'eid'));?>
          <div class="modal-body">
              <p>Are you sure you want to delete selected item?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-danger">Yes</button>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>

    <!-- Modal Close Credit Note  -->
    <div class="modal fade bd-example-modal-md" id="modalCloseCreditNote" tabindex="-1" role="dialog" aria-labelledby="modalCloseCreditNoteTitle" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-ban"></i> Close Credit Note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php echo form_open_multipart('credit_notes/close', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
          <?php echo form_input(array('name' => 'ceid', 'type' => 'hidden', 'value' => '', 'id' => 'ceid'));?>
          <div class="modal-body">
              <p>Are you sure you want to close the <b>Credit Note# <span class="close-credit-note-number"></span></b>?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Close</button>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>

    <!-- Modal Close Credit Note  -->
    <div class="modal fade bd-example-modal-md" id="modalCloneCreditNote" tabindex="-1" role="dialog" aria-labelledby="modalCloneCreditNoteTitle" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-files-o"></i> Clone Credit Note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php echo form_open_multipart('credit_notes/clone', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
          <?php echo form_input(array('name' => 'cloneid', 'type' => 'hidden', 'value' => '', 'id' => 'cloneid'));?>
          <div class="modal-body">
              <p>You are going create a new credit note based on <b>Credit Note #<span class="clone-credit-note-number"></span></b>. Afterwards you can edit the newly created credit note.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Clone</button>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>

    <!-- end container-fluid -->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
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
    $('.table-to-list').DataTable({
        "ordering": false
    });

    $(document).ready(function () {
        /*$(".btn-send-customer").click(function(e){
            var cnid = $(this).attr("data-id");
            $("#cnid").val(cnid);
            $("#modalSendEmail").modal('show');
        });*/

        $(".delete-credit-note").click(function(e){
            var eid = $(this).attr("data-id");
            $("#eid").val(eid);
            $("#modalDeleteCreditNote").modal('show');
        });

        $(".close-credit-note").click(function(e){
            var eid = $(this).attr("data-id");
            var credit_note_number = $(this).attr("data-name");
            $("#ceid").val(eid);
            $(".close-credit-note-number").text(credit_note_number);
            $("#modalCloseCreditNote").modal('show');
        });

        $(".clone-credit-note").click(function(e){
            var eid = $(this).attr("data-id");
            var credit_note_number = $(this).attr("data-name");
            $("#cloneid").val(eid);
            $(".clone-credit-note-number").text(credit_note_number);
            $("#modalCloneCreditNote").modal('show');
        });
    });
</script>
