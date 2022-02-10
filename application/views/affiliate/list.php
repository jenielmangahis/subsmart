<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
label>input {
  visibility: initial !important;
  position: initial !important; 
}
.form-group {
    margin-bottom: 10px !important;
}
.badge-info{
    background-color: #38a4f8 !important;
}
.badge-danger{
    background-color: #ec4561 !important;
}
.badge-custom{
    padding: 10px !important;
    display: block !important;  
    font-size: 13px !important;  
}
.badge-success{
    background-color: #02a499 !important;
}
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/affiliate'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card p-20">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h3 class="page-title">Affiliate Partners</h3>
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <?php //if (hasPermissions('WORKORDER_MASTER')): ?>
                                                <!-- <a href="<?php echo url('affiliate/add') ?>" class="btn btn-primary" aria-expanded="false">
									<i class="mdi mdi-settings mr-2"></i> New inquiry
								</a>    -->
                                            <a class="btn btn-primary btn-md" href="<?php echo url('affiliate/add') ?>"><span class="fa fa-plus"></span> Add New ffiliate</a>
                                            <a class="btn btn-primary btn-md btn-affiliate-adv-search" href="javascript:void(0);"><i class="fa fa-search"></i> Advance Search</a>
                                            <?php //endif ?>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="alert alert-warning mt-4 mb-4" role="alert">
                            <span style="color:black;">Affiliates partners are other professionals who refer new leads/clients to you. They are often Mortgage Brokers, Realtors, Auto Dealers, whose business depends upon having clients with good credit. Visit Affiliate Payments to set commission options and record payments for your affiliates. To see an overview of revenue from affiliates on your Affiliates Stats Dashboard. </span>
                        </div>
                        <div class="col-sm-12 text-right-sm justify-content-end" style="margin-bottom: 20px;">
                            <div class="row">
                                <div class="col">
                                <form action="<?php echo base_url('affiliate/importAffiliates'); ?>" method="post" id="affiliateImportForm" enctype="multipart/form-data">
                                    <input type="file" name="file" id="importAffiliateFile" style="display:none;"/>
                                    <a class="btn btn-default btn-md margin-left-sec" id="importAffiliateBtn" href="javascript:void(0)"><span
                                            class="fa fa-upload"></span> &nbsp; Import CSV</a>
                                    <a class="btn btn-default btn-md margin-left-sec" href="javascript:void(0)" id="exportAffiliates"><span
                                            class="fa fa-download"></span> &nbsp; Export CSV</a>
                                    <a class="btn btn-default btn-md margin-left-sec" id="printAffiliate" data-toggle="modal" data-target="#modalPrintAffiliate" href="javascript:void(0)"><span
                                            class="fa fa-print"></span> &nbsp; Print</a>
                                </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                    <table class="table table-hover table-to-list" id="affiliateListTbl" data-id="work_orders">
                                        <thead>
                                        <tr class="text-center">
                                            <th>Affiliate Name</th>
                                            <th>Company</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Added</th>
                                            <th style="width:13%;">Status</th>
                                            <th style="width:13%;">Has Portal Access</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                            <?php foreach($affiliates as $affiliate) : ?>
                                            <tr class="">
                                                <td><?php echo $affiliate->first_name . ' ' . $affiliate->last_name; ?></td>
                                                <td><?php echo $affiliate->company; ?></td>
                                                <td><?php echo $affiliate->email; ?></td>
                                                <td><?php echo $affiliate->phone; ?></td>
                                                <td><?php echo $affiliate->date_created; ?></td>
                                                <td>
                                                    <?php 
                                                        if( $affiliate->status == 'active' ){
                                                            echo '<span class="badge badge-success badge-custom">Active</span>';
                                                        }else{
                                                            echo '<span class="badge badge-danger badge-custom">Inactive</span>';
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if( $affiliate->portal_access == 1 ){
                                                            echo '<span class="badge badge-info badge-custom">Yes</span>';
                                                        }else{
                                                            echo '<span class="badge badge-danger badge-custom">No</span>';
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="dropdown dropdown-btn text-center">
                                                        <button class="btn btn-default" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                            <span class="btn-label">Manage <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('affiliate/edit?id='.$affiliate->id); ?>" class="editItemBtn" data-id="<?php echo $affiliate->id; ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a></li>
                                                            <li role="separator" class="divider"></li>
                                                            <li role="presentation">
                                                                <a role="menuitem" tabindex="-1" href="javascript:void(0);" class="btn-delete-affiliate" data-id="<?php echo $affiliate->id; ?>" data-name="<?php echo $affiliate->first_name . ' ' . $affiliate->last_name; ?>">
                                                                    <span class="fa fa-trash-o icon"></span> Delete
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <tbody>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                    <!-- Modal Delete Affiliate -->
                    <div class="modal fade bd-example-modal-sm" id="modalDeleteAffiliate" tabindex="-1" role="dialog" aria-labelledby="modalDeleteAffiliateTitle" aria-hidden="true">
                      <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete Affiliate</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <?php echo form_open_multipart('affiliate/delete', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                          <?php echo form_input(array('name' => 'aid', 'type' => 'hidden', 'value' => '', 'id' => 'aid'));?>
                          <div class="modal-body">        
                              <p>Delete affiliate <span class="affiliate-name"></span>?</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger">Yes</button>
                          </div>
                          <?php echo form_close(); ?>
                        </div>
                      </div>
                    </div>

                </div>
            </div>
            <!-- end row -->

            <!-- Modal Advance Search -->
            <div class="modal fade bd-example-modal-sm" id="modalAdvanceSearch" tabindex="-1" role="dialog" aria-labelledby="modalAdvanceSearchTitle" aria-hidden="true">
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-search"></i> Advance Search</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <?php echo form_open_multipart('affiliate/index', ['method' => 'GET', 'id' => 'affiliate-adv-search', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                    <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">                    
                            <div class="form-group">
                              <label for="country-name">Affiliate Name</label>
                              <input type="text" class="form-control" id="" name="affiliate_name" placeholder="">
                            </div>
                            <div class="form-group">
                              <label for="country-iso">Email</label>
                              <input type="email" class="form-control" id="" name="affiliate_email" placeholder="">
                            </div>
                            <div class="form-group">
                              <label for="country-iso">Company</label>
                              <input type="text" class="form-control" id="" name="affiliate_company" placeholder="">
                            </div>
                            <div class="form-group">
                              <label for="country-iso">Status</label>
                                <select class="form-control" name="affiliate_status">
                                    <option value="all">All</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                          </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
              </div>
            </div>

            <!-- Modal Service Address -->
            <div class="modal fade" id="modalPrintAffiliate" tabindex="-1" role="dialog" aria-labelledby="addLocationLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header" style="background-color:blue;">
                        <h5 class="modal-title" id="addLocationLabel" style="color:white;">Print Affiliate Partners</h5>
                        <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">  
                        <table class="table table-hover table-bordered table-striped" style="width:100%;" id="printAffiliateTable">
                            <thead>
                                <tr>
                                    <th scope="col"><strong>Affiliate Name</strong></th>
                                    <th scope="col"><strong>Company</strong></th>
                                    <th scope="col"><strong>Client Reffered</strong></th>
                                    <th scope="col"><strong>Email</strong></th>
                                    <th scope="col"><strong>Phone</strong></th>
                                    <th scope="col"><strong>Status</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($affiliates)) : ?>
                                <?php foreach($affiliates as $emp) : ?>
                                    <tr>
                                        <td class="pl-3"><?php echo $emp->first_name . ' ' . $emp->last_name; ?></td>
                                        <td class="pl-3"><?php echo $emp->company; ?></td>                                
                                        <td class="pl-3"><?php echo 0; ?></td>                                
                                        <td class="pl-3"><?php echo $emp->email; ?></td>                                
                                        <td class="pl-3"><?php echo $emp->phone; ?></td>                                
                                        <td class="pl-3"><?php echo $emp->status; ?></td>                                
                                    </tr>
                                <?php endforeach; ?>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                        <button type="button" class="btn btn-primary" id="printAffiliateBtn">Print</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container-fluid -->
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

        columnDefs: [{
            orderable: true,
            className: 'select-checkbox',
            targets: 0,
            checkboxes: {
                selectRow: true
            }
        }],
        select: {
            'style': 'multi'
        },
        order: [[1, 'asc']],
    });

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchery = new Switchery(html, {size: 'small'});
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

    $(document).on('click', '.btn-delete-affiliate', function(){
        var aid = $(this).attr('data-id');
        var affiliate_name = $(this).attr('data-name');

        $('.affiliate-name').html('<b>'+affiliate_name+'</b>');
        $('#aid').val(aid);
        $('#modalDeleteAffiliate').modal('show');
    });

    $(document).on('click', '.btn-affiliate-adv-search', function(){
        $('#modalAdvanceSearch').modal('show');
    });

</script>
