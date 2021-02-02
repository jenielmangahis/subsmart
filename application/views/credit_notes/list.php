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
.customer-name{
    display: block;
    font-size: 13px;
    color: #2ab363;
}
</style>
<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/notifications'); ?>
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="card">
            <div class="container-fluid" style="font-size:14px;">
                <div class="row">
                    <div class="col">
                        <h2 class="m-0" style="font-size:30px;">Credit Notes</h2>
                        <p style="margin-top: 20px;margin-bottom: 30px; font-size: 16px;">Listing all credit notes.</p>
                    </div>
                    <div class="col-auto">
                        <div class="h1-spacer">                             
                            <a class="btn btn-primary btn-md" href="<?php echo url('credit_notes/add_new') ?>">
                                <span class="fa fa-plus"></span> New Credit Note
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tabs">
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
                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                               href="<?php echo base_url('credit_notes/view/' . $c->id) ?>"><span
                                                                    class="fa fa-file-text-o icon"></span> View</a></li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1"
                                                                               href="<?php echo base_url('credit_notes/edit/' . $c->id) ?>"><span
                                                                    class="fa fa-pencil-square-o icon"></span> Edit</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a role="menuitem" href="<?php echo base_url('credit_notes/send_customer/' . $c->id) ?>" class="btn-send-customer" data-id="<?= $c->id; ?>">
                                                        <span class="fa fa-envelope-open-o icon"></span>  Send to Customer</a></li>
                                                    <li role="presentation">
                                                        <a role="menuitem" href="<?php echo base_url('credit_notes/view_pdf/' . $c->id) ?>" class="btn-send-customer">
                                                        <span class="fa fa-envelope-open-o icon"></span>  View PDF</a></li>
                                                    <li role="presentation">
                                                        <a role="menuitem" class="delete-credit-note" href="javascript:void(0);" data-id="<?= $c->id; ?>"><span class="fa fa-trash-o icon"></span> Delete</a>
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
    <div class="modal fade bd-example-modal-md" id="modelDeleteCreditNote" tabindex="-1" role="dialog" aria-labelledby="modelDeleteCreditNoteTitle" aria-hidden="true">
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
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    $('#dataTable1').DataTable({

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
            $("#modelDeleteCreditNote").modal('show');
        });
    });
</script>
