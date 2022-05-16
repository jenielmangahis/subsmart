<?php include viewPath('v2/includes/header_admin'); ?>
<style>
.select2-container--open {
    z-index: 9999999
}
.select2-container{
    width: 100% !important; 
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/admin_event_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Listing of all event types.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('admin/event_types') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Event Types" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
                            </div>
                            <button type="submit" class="nsm-button primary" style="margin:0px;">Search</button>
                            <button type="button" class="nsm-button primary btn-reset-list" style="margin:0px;">Reset</a>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary btn-add-new-type" href="javascript:void(0);" style="margin-left: 10px;"><i class='bx bx-fw bx-plus-circle' ></i> New Event Type</a>                            
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Event Type Name">Event Type Name</td>
                            <td data-name="Company Name">Company Name</td>
                            <td data-name="Manage" style="width: 5%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($eventTypes)) :
                        ?>
                            <?php
                            foreach ($eventTypes as $type) :
                            ?>
                                <tr>
                                    <td>
                                        <?php
                                        if ($type->icon_marker != '') :
                                            if ($type->is_marker_icon_default_list == 1) :
                                                $marker = base_url("uploads/icons/" . $type->icon_marker);
                                            else :
                                                $marker = base_url("uploads/event_types/" . $type->company_id . "/" . $type->icon_marker);
                                            endif;
                                        else :
                                            $marker = base_url("uploads/event_types/default_no_image.jpg");
                                        endif;
                                        ?>
                                        <div class="table-row-icon img" style="background-image: url('<?php echo $marker ?>')"></div>
                                    </td>                                    
                                    <td class="fw-bold nsm-text-primary"><?= $type->title; ?></td>
                                    <td><?= $type->business_name; ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo base_url('event_types/edit/' . $type->id); ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-type" href="javascript:void(0);" data-name="<?= $type->title; ?>" data-company="<?= $type->business_name; ?>" data-id="<?= $type->id; ?>">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="3">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <nav class="nsm-table-pagination">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link disabled" href="#">Prev</a></li>
                                        <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link disabled" href="#">Next</a></li>
                                    </ul>
                                </nav>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!--Add New Industry Module modal-->
            <div class="modal fade nsm-modal fade" id="modalAddNewType" tabindex="-1" aria-labelledby="modalAddNewTypeLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Add New Event Type</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-add-new-event-type">
                        <div class="modal-body">
                            <div class="row">                                
                                <div class="col-md-12 mt-3 company-select">
                                    <label for="">Company</label>
                                    <select name="company_id" id="companyList" class="nsm-field mb-2 form-control add-company" required="">     
                                        <option value="">Select Company</option>           
                                        <?php foreach($companies as $c){ ?>
                                            <option value="<?= $c->company_id; ?>"><?= $c->business_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="">Event Type Name</label>
                                    <input type="text" name="event_name" id="event-name" class="form-control" required="">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="">Icon / Marker</label>
                                    <input type="file" name="image_marker" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-add-type">Save</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

            <!--Edit Industry Module modal-->
            <div class="modal fade nsm-modal fade" id="modalEditIndustryModule" tabindex="-1" aria-labelledby="modalEditIndustryModuleLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Edit Industry Module</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-edit-industry-module">
                        <div class="modal-body modal-edit-module-container"></div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-update-module">Save</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $(".nsm-table").nsmPagination();

    $('.add-company').select2({
        placeholder: 'Select Company',
        allowClear: true,
        width: 'resolve'            
    });

    $(document).on('change', '.is-default-marker', function(){
        var selected = $(this).val();
        if( selected == 'company' ){
            $('.company-select').show();
        }else{
            $('.company-select').hide();
        }
    });

    $(document).on('click', '.btn-reset-list', function(){
        location.href = base_url + 'admin/event_types';
    });

    $(document).on('click','.btn-add-new-type',function(){
        $('#modalAddNewType').modal('show');
    });

    $(document).on('submit', '#frm-add-new-event-type', function(e){
        e.preventDefault();
        var url = base_url + 'admin/ajaxSaveEventType';
        $(".btn-add-type").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-add-new-event-type")[0]);   

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {          
                if( o.is_success == 1 ){   
                    $("#modalAddNewType").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Event Type was successfully created.",
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
                    title: 'Error!',
                    html: o.msg
                  });
                } 

                $(".btn-add-module").html('Save');
             }
          });
        }, 800);
    });

    $(document).on('click','.btn-edit-module', function(){
        var mid = $(this).attr('data-id');
        var url = base_url + 'admin/ajax_edit_industry_module';

        $('#modalEditIndustryModule').modal('show');
        $(".modal-edit-module-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {mid:mid},
             success: function(o)
             {          
                $('.modal-edit-module-container').html(o);
             }
          });
        }, 800);
    });

    $(document).on('submit','#frm-edit-industry-module', function(e){
        e.preventDefault();

        var url = base_url + 'admin/ajaxUpdateIndustryModule';
        $(".btn-update-module").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-edit-industry-module")[0]);   

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {          
                if( o.is_success == 1 ){   
                    $("#modalEditIndustryModule").modal("hide");         
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Industry Module was successfully updated.",
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
                    title: 'Error!',
                    html: o.msg
                  });
                } 

                $(".btn-update-module").html('Save');
             }
          });
        }, 800);
    });

    $(document).on("click", ".delete-type", function(e) {
        var eid = $(this).attr("data-id");
        var event_type = $(this).attr('data-name');
        var company_name = $(this).attr('data-company');
        var url = base_url + 'admin/ajaxDeleteEventType';

        Swal.fire({
            title: 'Delete Event Type',
            html: "Are you sure you want to delete event type <b>"+event_type+"</b> from company <b>"+company_name+"</b>?",
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    data: {eid:eid},
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Event Type Data Deleted Successfully!",
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
                            title: 'Error!',
                            html: o.msg
                          });
                        }
                    },
                });
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer_admin'); ?>