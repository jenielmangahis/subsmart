<?php include viewPath('v2/includes/header'); ?>
<style>
#alarm-api-customers .badge{
    display:block;
}
.badge-danger {
    color: #fff;
    background-color: #dc3545;
}
.info-list-existing-customer{
    list-style: none;
    margin-top: 13px;
}
.info-list-existing-customer li{
    font-weight:bold;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="">
        <i class='bx bx-user-plus'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/alarm_api_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/alarm_api_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Alarm API customer list.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search form-group">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="CUSTOM_TYPE_SEARCHBAR" placeholder="Search">
                        </div>
                    </div>
                    <div class="col-6 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" id="with-selected-import" href="javascript:void(0);">Import Customer</a></li>                          
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" id="btn-import-to-customer">
                                <i class='bx bx-fw bx-plus'></i> Import Alarm Customer
                            </button>
                        </div>
                    </div>
                </div>

                <form id="frm-with-selected">
                <table id="alarm-api-customers" class="nsm-table">
                    <thead>
                        <tr>
                            <td class="Row Select" style="width:3%;">
                                <input class="form-check-input table-select" type="checkbox" id="chk-select-all">
                            </td>
                            <td class="table-icon"></td>
                            <td data-name="Customer Name">Name</td>
                            <td data-name="Customer Email">Email</td>
                            <td data-name="Customer Phone">Phone Number</td>
                            <td data-name="Is Linked" style="width:5%;">Is Imported</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if( !empty($alarmCustomers) ){ ?>
                            <?php foreach($alarmCustomers as $customer){ ?>
                                <tr>
                                    <td>
                                        <input class="form-check-input chk-row-select table-select" name="alarmCustomer[]" type="checkbox" value="<?= $customer->customerId; ?>">
                                    </td>
                                    <td><div class="table-row-icon"><i class='bx bx-briefcase'></i></div></td>
                                    <td><?= $customer->firstName . ' ' . $customer->lastName ?></td>
                                    <td><?= $customer->email; ?></td>
                                    <td><?= $customer->phoneNumber; ?></td>
                                    <td>
                                        <?php if( $customer->is_linked == 1 ){ ?>
                                            <span class="badge badge-primary">Yes</span>
                                        <?php }else{ ?>
                                            <span class="badge badge-danger">No</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item row-view" href="javascript:void(0);" data-id="<?= $customer->customerId; ?>">View</a></li>
                                                <li><a class="dropdown-item row-system-check" href="javascript:void(0);" data-id="<?= $customer->customerId; ?>">System Check</a></li>
                                                <?php if( $customer->is_linked == 1 ){ ?>
                                                    <li><a class="dropdown-item" target="_new" href="<?= base_url('customer/module/'.$customer->linked_customer); ?>">View Linked Customer</a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
                </form>

                <div class="modal fade nsm-modal fade" id="modal-view-alarm-customer-info" data-source="" tabindex="-1" aria-labelledby="modal-quick-view-upcoming-schedule-label" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">        
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title">View Customer</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <div class="modal-body" id="alarm-customer-info-container"></div>                                    
                        </div>        
                    </div>
                </div>

                <div class="modal fade nsm-modal fade" id="modal-view-alarm-customer-system-check" data-source="" tabindex="-1" aria-labelledby="modal-quick-view-upcoming-schedule-label" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">        
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title">System Check</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <div class="modal-body" id="alarm-customer-system-check-container"></div>                                    
                        </div>        
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function(){
    $('.row-view').on('click', function(){
        var customer_id = $(this).attr('data-id');
        
        $('#modal-view-alarm-customer-info').modal('show');
        showLoader($("#alarm-customer-info-container")); 

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: base_url + 'alarm_api/_view_customer',
             data: {customer_id:customer_id},
             success: function(o)
             {          
                $("#alarm-customer-info-container").html(o);
             }
          });
        }, 500);
    });

    $('#btn-import-to-customer').on('click', function(){
        Swal.fire({
            title: 'Import Customer',
            html: `Do you wish to proceed to import Alarm customers to your customer list? `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Proceed',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url + "alarm_api/_import_customers",
                    dataType:"json",
                    success: function(response) {
                        if( response.is_success == 1 ){
                            Swal.fire({
                                title: 'Import Completed',
                                html: response.msg,
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                location.reload();
                            });
                        }else{
                            Swal.fire({
                                title: 'Error',
                                text: result.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            });
                        }
                    },
                    beforeSend: function(){
                        Swal.fire({
                            icon: "info",
                            title: "Importing Customer",
                            html: "Please wait while the process is running...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    }
                });
            }
        });
    });

    $('#chk-select-all').on('change', function(){
        if( $(this).is(':checked') ){
            $('.chk-row-select').prop('checked', true);
        }else{
            $('.chk-row-select').prop('checked', false);
        }
    }); 

    $('#with-selected-import').on('click', function(){
        if( $("#alarm-api-customers .chk-row-select:checked").length > 0 ){
            Swal.fire({
                title: 'Import Customer',
                html: `Do you wish to proceed to import selected Alarm customers to your customer list? `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Proceed',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: base_url + "alarm_api/_import_selected_customers",
                        data: $('#frm-with-selected').serialize(),
                        dataType:"json",
                        success: function(response) {
                            if( response.is_success == 1 ){
                                Swal.fire({
                                    title: 'Import Completed',
                                    html: 'Data was successfully created',
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    location.reload();
                                });
                            }else{
                                Swal.fire({
                                    title: 'Error',
                                    text: result.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }
                        },
                        beforeSend: function(){
                            Swal.fire({
                                icon: "info",
                                title: "Importing Customer",
                                html: "Please wait while the process is running...",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });
                        }
                    });
                }
            });
        }else{
            Swal.fire({
                title: 'Error',
                text: 'Please select customer to import',
                icon: 'error',
                showCancelButton: false,
                confirmButtonText: 'Okay'
            });
        }
    });

    $('.row-system-check').on('click', function(){
        var customer_id = $(this).attr('data-id');
        
        $('#modal-view-alarm-customer-system-check').modal('show');
        showLoader($("#alarm-customer-system-check-container")); 

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: base_url + 'alarm_api/_customer_system_check',
             data: {customer_id:customer_id},
             success: function(o)
             {          
                $("#alarm-customer-system-check-container").html(o);
             }
          });
        }, 500);
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>