<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include viewPath('v2/includes/header'); ?>
<style>
.row-header{
    background-color: #32243d;
    color: #ffffff;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 5px !important;
  padding-left: 39px !important;
  margin-top: 55px !important;
}
.hide{
    display: none;
}
.tbl-coupons .badge{
    display: block;
    width: 100%;
}
.nsm-table .danger{
    background-color:#d9a1a0;
    color:#ffffff;    
}
.nsm-badge{
    font-size:11px;
}
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/upgrades_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/online_booking_subtabs'); ?>
    </div>    
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Manage discount coupons
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-3">
                        <div class="nsm-counter h-100" role="button" onclick="location.href='<?php echo base_url('more/addon/booking/coupons/coupon_tab/active'); ?>'">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                    <i class="bx bx-check-circle"></i>
                                </div>
                                <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                    <span>Total Active Coupons</span>
                                    <h2><?= $total_active; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="nsm-counter success h-100" role="button" onclick="location.href='<?php echo base_url('more/addon/booking/coupons/coupon_tab/closed'); ?>'">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                    <i class="bx bx-check-circle"></i>
                                </div>
                                <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                    <span>Total Closed Coupons</span>
                                    <h2><?= $total_closed; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search" value="">
                        </div>
                    </div>   
                    <div class="col-6 grid-mb text-end">
                        <?php if(checkRoleCanAccessModule('online-booking', 'write')){ ?>
                            <div class="nsm-page-buttons page-button-container">
                                <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#modalAddCoupon">
                                    <i class='bx bx-fw bx-plus'></i> Add New
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                        <table class="nsm-table" id="coupons">
                            <thead>
                                <tr>
                                    <td class="table-icon"></td>
                                    <td data-name="Coupon Name" style="width:60%;">Name</td>
                                    <td data-name="Coupon Code">Code</td>
                                    <td data-name="Validity">Validity</td>
                                    <td data-name="Discount">Discount</td>
                                    <td data-name="Status">Status</td>   
                                    <td data-name="Manage"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach( $coupons as $c ){ ?>
                                    <tr>
                                        <td>
                                            <div class="table-row-icon"><i class='bx bxs-coupon'></i></div>
                                        </td>
                                        <td class="fw-bold nsm-text-primary"><?php echo $c->coupon_name; ?></td>
                                        <td><?php echo $c->coupon_code; ?></td>
                                        <td><?php echo date("m/d/Y", strtotime($c->date_valid_from)) . ' to ' . date("m/d/Y", strtotime($c->date_valid_to)) ?></td>
                                        <?php $discount_type = ""; ?>
                                        <?php $discount_type = $c->discount_from_total_type == 1 ? '%' : '$'; ?>
                                        <td><?php echo number_format($c->discount_from_total,2,'.',',') . " " . $discount_type; ?></td>
                                        <td>
                                            <?php if( $c->status == 1 ){ ?>
                                                <?php 
                                                    $date = date("Y-m-d");
                                                    $is_expired = 0;
                                                    if( $date > $c->date_valid_to ){
                                                        $is_expired = 1;
                                                    }
                                                ?>
                                                <?php if( $is_expired == 1 ){ ?>    
                                                    <span class="nsm-badge danger">Expired</span>
                                                <?php }else{ ?>
                                                    <span class="nsm-badge success">Active</span>
                                                <?php } ?>
                                                
                                            <?php }else{ ?>
                                                <span class="nsm-badge secondary">Closed</span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <?php if(checkRoleCanAccessModule('online-booking', 'write')){ ?>
                                                    <li role="presentation">
                                                        <a class="dropdown-item coupon__edit margin-right-sec" data-id="<?php echo $c->id; ?>" href="javascript:void(0);">Edit</a>
                                                    </li>
                                                    <?php } ?>
                                                    <?php if(checkRoleCanAccessModule('online-booking', 'delete')){ ?>
                                                    <li role="presentation">
                                                        <a class="dropdown-item coupon__delete" data-id="<?php echo $c->id; ?>" data-name="<?php echo $c->coupon_name; ?>" href="javascript:void(0);"><span class="fa fa-trash-o icon"></span> Delete</a>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/online_booking/booking_modals'); ?> 
<?php //include viewPath('includes/footer_booking'); ?>
<script>
$(function(){
    var base_url = "<?php echo base_url(); ?>";

    $(".nsm-table").nsmPagination();

    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));        
    }, 1000));

    $("#edit_coupon_valid_from").datepicker();
    $("#edit_coupon_valid_to").datepicker();

    $(".coupon-discount-type").change(function(){
        var type = $(this).val();
        if( type == 1 ){
            $("#discount_percent_cnt").removeClass("hide");
            $("#discount_amount_cnt").addClass("hide");
        }else{
            $("#discount_percent_cnt").addClass("hide");
            $("#discount_amount_cnt").removeClass("hide");
        }
    });

    $('#coupon-code').keyup(onlyAllowAlphanumeric);    

    function onlyAllowAlphanumeric() {
        this.value = this.value.replace(/[^a-zA-Z0-9 _]/g, '');
    }

    $(".coupon__edit").click(function(){
        $("#modalEditCoupon").modal('show');
        var cid = $(this).attr("data-id");

        $.ajax({
            type: "POST",
            url: base_url + '/booking/_edit_coupon',
            data: {cid:cid},
            success: function(o)
            {
                $(".modal-edit-coupon").html(o);
            },
            beforeSend: function(){
                $(".modal-edit-coupon").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#frm-booking-coupon').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "booking/_create_coupon",
            dataType: 'json',
            data: $('#frm-booking-coupon').serialize(),
            success: function(data) {    
                $('#btn-save-coupon').html('Save');                   
                if (data.is_success) {
                    $('#modalAddCoupon').modal('hide');
                    Swal.fire({
                        title: 'Booking Coupons',
                        text: "New booking coupon has been added successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.reload();
                        //}
                    });                    
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#btn-save-coupon').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });

    });

    $('#frm-edit-booking-coupon').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "booking/_update_coupon",
            dataType: 'json',
            data: $('#frm-edit-booking-coupon').serialize(),
            success: function(data) {    
                $('#btn-update-coupon').html('Save');                   
                if (data.is_success) {
                    $('#modalEditCoupon').modal('hide');
                    Swal.fire({
                        title: 'Booking Coupons',
                        text: "Booking coupon has been updated successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.reload();
                        //}
                    });                    
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#btn-update-coupon').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });

    });

    $('.coupon__delete').on('click', function(){
        var coupon_name = $(this).attr('data-name');
        var coupon_id   = $(this).attr('data-id');

        Swal.fire({
            title: 'Delete Coupon',
            html: `Proceed with deleting coupon <b>${coupon_name}</b>?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url + "booking/_delete_booking_coupon",
                    data: {coupon_id:coupon_id},
                    dataType:'json',
                    success: function(result) {
                        if( result.is_success == 1 ) {
                            Swal.fire({
                            icon: 'success',
                            title: 'Delete Coupon',
                            text: 'Coupon was successfully deleted.',
                            }).then((result) => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: result.msg,
                            });
                        }
                    }
                });
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>
