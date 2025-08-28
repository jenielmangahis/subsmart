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
.badge-info{
    background-color: #38a4f8;
}
.badge{
    padding: 6px;
    display: block;
    font-size: 13px;
}
.badge-warning {
    background-color: #f8b425;
}
.badge-success {
    color: #fff;
    background-color: #28a745;
}
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/online_booking_tabs'); ?>
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
                            Manage inquiries from your online booking form.
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search" value="">
                        </div>                     
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                    <?php include viewPath('flash'); ?>
                        <table class="nsm-table" id="tbl-inquiries-list">
                            <thead>
                                <tr>
                                    <td class="table-icon"></td>
                                    <td data-name="Date" style="width:13%;">Date</td>
                                    <td data-name="Name" style="width:40%;">Name</td>
                                    <td data-name="Phone">Phone</td>
                                    <td data-name="Email">Email</td>
                                    <td data-name="Status" style="width:8%;">Status</td>
                                    <td data-name="Manage"></td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach( $inquiries as $i ){ ?>
                                    <?php 
                                        $status = "";
                                        if($i->status == 1) {
                                            $status = "<span class='badge badge-info'>New</span>";
                                        }elseif($i->status == 2) {
                                            $status = "<span class='badge badge-success'>Contacted</span>";
                                        }elseif($i->status == 3) {
                                            $status = "<span class='badge badge-success'>Follow Up</span>";
                                        }elseif($i->status == 4) {
                                            $status = "<span class='badge badge-success'>Assigned</span>";
                                        }elseif($i->status == 5) {
                                            $status = "<span class='badge badge-warning'>Closed</span>";
                                        }
                                    ?>
                                    <tr>
                                        <td><div class="table-row-icon"><i class='bx bx-calendar' ></i></div></td>
                                        <td class="nsm-text-primary"><?php echo date("m/d/Y", strtotime($i->date_created)); ?></td>
                                        <td class="nsm-text-primary"><?php echo $i->name; ?></td>
                                        <td class="nsm-text-primary"><?php echo $i->phone != '' ? formatPhoneNumber($i->phone) : '---'; ?></td>
                                        <td class="nsm-text-primary"><?php echo $i->email != '' ? $i->email : '---'; ?></td>
                                        <td class="nsm-text-primary"><?php echo $status; ?></td>
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item btn-view-inquiry" data-id="<?php echo $i->id; ?>" href="javascript:void(0);">View</a>
                                                    </li>
                                                    <?php if(checkRoleCanAccessModule('customer-settings', 'write')){ ?>
                                                    <li>
                                                        <a class="dropdown-item btn-edit-info-inquiry" data-id="<?php echo $i->id; ?>" href="javascript:void(0);">Edit</a>
                                                    </li>
                                                    <?php } ?>
                                                    <?php if(checkRoleCanAccessModule('customer-settings', 'delete')){ ?>
                                                    <li>
                                                        <a class="dropdown-item row-delete-inquiry" data-id="<?php echo $i->id; ?>" data-date="<?php echo date("m/d/Y", strtotime($i->date_created)); ?>" data-name="<?php echo $i->name; ?>" href="javascript:void(0);">Delete</a>
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

<?php include viewPath('includes/booking_modals'); ?> 
<?php //include viewPath('includes/footer_booking'); ?>
<script>
$(function(){
    var base_url = "<?php echo base_url(); ?>";
    
    $("#tbl-inquiries-list").nsmPagination({itemsPerPage:10});

    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));        
    }, 1000));

    $(".btn-edit-info-inquiry").click(function(){
        var iid = $(this).attr("data-id");     
        $("#modalViewEditInquiryInfo").modal('show');   
        $.ajax({
            type: "POST",
            url: base_url + '/booking/_inquiry_edit_details',
            data: {iid:iid},
            success: function(o)
            {
                $(".inquiry-edit-info-body").html(o);
            },
            beforeSend: function(){
                $(".inquiry-edit-info-body").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on("click", ".row-delete-inquiry", function() {
        var iid = $(this).attr('data-id');
        var date = $(this).attr('data-date');
        var name = $(this).attr('data-name');

        Swal.fire({
            title: 'Delete Inquiry',
            html: `Are you sure you want to delete inquiry dated <b>${date}</b> by <b>${name}</b>?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + "booking/_delete_inquiry",
                    data: {iid: iid},
                    dataType:"json",
                    success: function(result) {
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Delete Inquiry',
                                text: "Data deleted successfully!",
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
                                icon: 'error',
                                title: 'Error',
                                text: result.msg,
                            });
                        }
                    },
                });
            }
        });
    });

    $(".btn-view-inquiry").click(function(){
        var iid = $(this).attr("data-id");
        $("#modalViewInquiry").modal('show');
        
        $.ajax({
            type: "POST",
            url: base_url + 'booking/_view_inquiry_details',
            data: {iid:iid},
            success: function(o)
            {
                $(".view-inquiry-body").html(o);
            },
            beforeSend: function(){
                $(".view-inquiry-body").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#frm-update-inquiry').on('submit', function(e){
        e.preventDefault();
        var _this = $(this);
        var url = base_url + "booking/_update_inquiry_details";
        _this.find("button[type=submit]").html("Saving");
        _this.find("button[type=submit]").prop("disabled", true);

        $.ajax({
            type: 'POST',
            url: url,
            data: _this.serialize(),
            dataType: 'json',
            success: function(result) {
                if ( result.is_success ) {
                    $('#modalViewEditInquiryInfo').modal('hide');
                    Swal.fire({
                        title: 'Booking Inquiry',
                        text: "Booking inquiry has been updated successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.reload();
                        //}
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: result.msg
                    }); 
                }

                _this.find("button[type=submit]").html("Save");
                _this.find("button[type=submit]").prop("disabled", false);
            },
        });
    });

});
</script>
<?php include viewPath('v2/includes/footer'); ?>