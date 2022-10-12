<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('customer/group_add') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <!-- <button><i class='bx bx-x'></i></button> -->
                            Listing of recurring billing errors that needs to be fix.
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Date">Date</td>
                            <td data-name="Name">Name</td>                                                                        
                            <td data-name="Error">Error</td>
                            <td data-name="Error Type">Error Type</td>
                            <td class="table-icon"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($billingErrors)) :
                        ?>
                            <?php foreach($billingErrors as $b){ ?>
                                <?php if( $b->error_date != '' ){ ?>
                                <tr>
                                    <td><?= $b->error_date != '' ? date("m/d/Y", strtotime($b->error_date)) : '---'; ?></td>
                                    <td><?= $b->first_name . ' ' . $b->last_name; ?></td>
                                    <td><?= $b->error_message; ?></td>
                                    <td><?= $b->error_type; ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item btn-fix-cc-error" data-id="<?= $b->bill_id; ?>" href="javascript:void(0);"><i class="fa fa-pencil"></i> Fix</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?= base_url("customer/subscription/" . $b->fk_prof_id); ?>"><i class="fa fa-eye"></i> View Subscription</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            <?php } ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="5">
                                    <div class="nsm-empty">
                                        <span>No errors found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>

                <div class="modal fade nsm-modal fade" id="modal-edit-cc-details" aria-labelledby="modal-edit-cc-details-label" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title" id="new_feed_modal_label">Update Credit Card Details</span>
                                <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <form id="frm-update-credit-card-details" method="post">
                              <input type="hidden" name="bid" id="bid" value="">
                              <div class="modal-body">
                                  <div class="row">
                                      <div class="col-md-12">                          
                                          <div class="card-body body-card-details" style="padding: 10px;"></div>
                                      </div>
                                  </div>
                              </div>
                              <div class="modal-footer">
                                  <button class="nsm-button" type="button" data-bs-dismiss="modal">Close</button>
                                  <button class="nsm-button primary btn-update-cc-details" type="submit">Update</button>
                              </div>
                            </form>                
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();

        $(".btn-fix-cc-error").click(function(){
            var billing_id = $(this).attr("data-id");
            var url = base_url + 'customer/_load_billing_credit_card_details';

            $("#bid").val(billing_id);
            $(".body-card-details").html('<span class="spinner-border spinner-border-sm m-0"></span>');

            setTimeout(function () {
                $.ajax({
                   type: "POST",
                   url: url,
                   data: {billing_id:billing_id},
                   success: function(o)
                   {
                      $(".body-card-details").html(o);
                   }
                });
            }, 1000);

            $("#modal-edit-cc-details").modal('show');
        });

        $("#frm-update-credit-card-details").submit(function(e){
            e.preventDefault();
            var url = base_url + 'customer/_update_billing_credit_card_details';
            $(".btn-update-cc-details").html('<span class="spinner-border spinner-border-sm m-0"></span>');

            setTimeout(function () {
                $.ajax({
                   type: "POST",
                   url: url,
                   dataType: "json",
                   data: $("#frm-update-credit-card-details").serialize(),
                   success: function(o)
                   {                    
                        if( o.is_success == 1 ){
                          $("#modal-edit-cc-details").modal('hide'); 
                          
                          Swal.fire({
                              title: 'Update Successful!',
                              text: "Your billing credit card info was successfully updated.",
                              icon: 'success',
                              showCancelButton: false,
                              confirmButtonColor: '#32243d',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'Ok'
                          }).then((result) => {
                              if (result.value) {
                                  location.reload();
                              }
                          });

                        }else{
                          Swal.fire({
                            icon: 'error',
                            title: 'Cannot update billing',
                            text: o.msg
                          });
                        }

                        $(".btn-update-cc-details").html('Update');
                    }
                });
            }, 1000);
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>