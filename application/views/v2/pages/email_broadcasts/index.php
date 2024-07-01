<?php include viewPath('v2/includes/header'); ?>
<style>
div.tagsinput span.tag{
    background-color:#6a4a86 !important;
    color:#ffffff !important;
}
div.tagsinput input {
 width:auto !important;
}
#btn-select-customer{
    
}
#modal-send-test{
    margin-top:9%;
}
.preview-subject{
    padding: 69px;
    text-align: left;    
}
.preview-text{
    font-size: 12px;
    white-space: nowrap;
    width: 79%;
    overflow: hidden;
    text-overflow: ellipsis;
    display: inline-block;
    position: relative;
    top: 5px;
}
#modal-create-email-broadcast .modal-xl{
    max-width:1500px !important;
}
#btn-send-test-broadcast, #btn-send-broadcast{
    width:163px;
}
.btn-recipient-summary{
    text-decoration:none;
    color:inherit;
}
.badge-draft{
    color: #ffffff;
    background-color: #6c757d;
}
.badge-info{
    color: #ffffff;
    background-color: #17a2b8;
}
.badge-success{
    color: #ffffff;
    /* background-color: #6a4a86; */
    background-color:#28a745;
}
#email-broadcast-list .nsm-badge{
    width:100%;
    display:block;
    border-radius:5px;
    text-align:center;
}
#btn-search-list{
    margin:0px;
}
#btn-search-list i{
    position:relative;
    top:2px;
}
.nsm-field-group::before {
 left:18px !important;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('email_campaigns/add_email_blast') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/marketing_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Send mass emails to your contacts
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-4 grid-mb text-end">
                        <div class="nsm-field-group search form-group" style="display:block;max-width:600px;">
                            <form id="frm-list-search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search-list" value="<?= $search; ?>" placeholder="Search List..." style="width:92%; display:inline-block;" required>                            
                                <button class="nsm-button primary" id="btn-search-list" type="submit"><i class='bx bx-search-alt-2'></i></button>
                            </form>
                        </div>                        
                    </div>
                    <div class="col-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                Filter by Status: <span><?= $filter; ?></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item btn-filter" href="javascript:void(0);" data-status="all">All</a></li>
                                <li><a class="dropdown-item btn-filter" href="javascript:void(0);" data-status="draft">Draft</a></li>                                
                                <li><a class="dropdown-item btn-filter" href="javascript:void(0);" data-status="ongoing">Ongoing</a></li>                                
                                <li><a class="dropdown-item btn-filter" href="javascript:void(0);" data-status="completed">Completed</a></li>                                
                            </ul>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item btn-with-selected" href="javascript:void(0);" data-action="pause">Pause</a></li>
                                <li><a class="dropdown-item btn-with-selected" href="javascript:void(0);" data-action="resume">Resume</a></li>                                
                                <li><a class="dropdown-item btn-with-selected" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <a class="nsm-button primary" id="btn-create-email-broadcast" href="javascript:void(0);"><i class='bx bx-fw bx-envelope'></i> Create Email Broadcast</a>                            
                        </div>
                    </div>
                </div>
                <form id="frm-with-selected">
                <input type="hidden" name="with_selected_action" value="" id="with-selected-action" />
                <table class="nsm-table" id="email-broadcast-list">
                    <thead>
                        <tr>
                            <td><input type="checkbox" class="form-check-input" id="chk-all-row" /></td>
                            <td class="table-icon"></td>
                            <td data-name="BroadcastName" style="width:20%;">Broadcast Name</td>
                            <td data-name="BroadcastSubject" style="width:50%;">Subject</td>
                            <td data-name="BroadcastSendDate" style="width:10%;">Send Date</td>
                            <td data-name="BroadcastStatus" style="width:5%;">Status</td>
                            <td data-name="BroadcastStatus" style="width:10%;">Total Sent</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($emailBroadcasts as $eb){ ?>
                            <tr>
                                <td><input type="checkbox" name="row_selected[]" class="form-check-input chk-row" value="<?= $eb->id; ?>" /></td>
                                <td>
                                    <div class="table-row-icon">
                                        <?php if( $eb->status == 'Completed' ){ ?>
                                            <i class='bx bx-check-circle' ></i>
                                        <?php }elseif( $eb->status == 'Ongoing' ){ ?>
                                            <i class='bx bx-play-circle'></i>
                                        <?php }else{ ?>
                                            <i class='bx bx-pause-circle'></i>
                                        <?php } ?>
                                    </div>
                                </td>
                                <td><b><?= $eb->broadcast_name; ?></b></td>
                                <td>
                                    <b><?= $eb->subject; ?></b>
                                    <?php if( $eb->preview_text != '' ){ ?>
                                        <span class="text-muted preview-text">-<?= $eb->preview_text; ?></span>
                                    <?php } ?>
                                </td>
                                <td><?= date("Y-m-d",strtotime($eb->send_date)); ?></td>
                                <td>
                                    <?php 
                                        if( $eb->status == 'Draft' ){
                                            $class_status = 'badge-draft';
                                        }elseif( $eb->status == 'Ongoing' ){
                                            $class_status = 'badge-info';
                                        }else{
                                            $class_status = 'badge-success';
                                        }
                                    ?>
                                    <span class="nsm-badge <?= $class_status; ?>"><?= $eb->status; ?></span>
                                </td>
                                <td>                                    
                                    <?php $total_recipients = $emailBroadCastSummary[$eb->id]['total_sent'] + $emailBroadCastSummary[$eb->id]['total_not_sent']; ?>
                                    <a class="btn-recipient-summary" href="javascript:void(0);" data-id="<?= $eb->id; ?>" data-name="<?= $eb->broadcast_name; ?>">
                                        <?= $total_recipients; ?>/<?= $emailBroadCastSummary[$eb->id]['total_sent']; ?>
                                    </a>
                                </td>                                
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item btn-preview-broadcast-email" href="javascript:void(0);" data-subject="<?= $eb->subject; ?>" data-id="<?= $eb->id; ?>">Preview</a></li>                                            
                                            <?php if( $eb->status == 'Ongoing' ){ ?>
                                                <li><a class="dropdown-item btn-pause-sending" href="javascript:void(0);" data-broadcast="<?= $eb->broadcast_name; ?>" data-id="<?= $eb->id; ?>">Pause Sending</a></li>
                                            <?php } ?>
                                            <?php if( $eb->status == 'Draft' ){ ?>
                                                <li><a class="dropdown-item btn-edit-email-broadcast" href="javascript:void(0);" data-id="<?= $eb->id; ?>">Edit</a></li>
                                                <li><a class="dropdown-item btn-resume-sending" href="javascript:void(0);" data-broadcast="<?= $eb->broadcast_name; ?>" data-id="<?= $eb->id; ?>">Resume Sending</a></li>
                                            <?php } ?>
                                            <li><a class="dropdown-item btn-delete-broadcast" href="javascript:void(0);" data-broadcast="<?= $eb->broadcast_name; ?>" data-id="<?= $eb->id; ?>">Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-create-email-broadcast" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="frm-create-email-broadcasts" method="post">
                    <input type="hidden" id="ebid" name="ebid" value="" />
                    <div class="modal-header">
                        <span class="modal-title content-title" style="font-size: 17px;"><i class='bx bx-fw bx-envelope'></i> <span id="modal-header-label">Create Email Broadcast</span></span>
                        <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
                    </div>
                    <div class="modal-body">                        
                        <div class="row">
                            <div class="col-4">
                                <div class="col-12 mb-3">
                                    <label class="content-subtitle fw-bold d-block mb-2">Broadcast Name <i id="help-popover-broadcast-name" class='bx bx-fw bx-info-circle ms-2 text-muted' style="margin-top: 0px !important;"></i></label>
                                    <input type="text" name="broadcast_name" id="broadcast-name" class="nsm-field form-control" placeholder="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="content-subtitle fw-bold d-block mb-2">Name <i id="help-popover-sender-name" class='bx bx-fw bx-info-circle ms-2 text-muted' style="margin-top: 0px !important;"></i></label>
                                    <input type="text" name="broadcast_sender_name" id="broadcast-sender-name" class="nsm-field form-control" value="<?= $default_name; ?>" placeholder="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="content-subtitle fw-bold d-block mb-2">Subject <i id="help-popover-broadcast-subject" class='bx bx-fw bx-info-circle ms-2 text-muted' style="margin-top: 0px !important;"></i></label>
                                    <input type="text" name="broadcast_subject" id="broadcast-subject" class="nsm-field form-control" placeholder="" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="content-subtitle fw-bold d-block mb-2">Preview Text <i id="help-popover-broadcast-preview-text" class='bx bx-fw bx-info-circle ms-2 text-muted' style="margin-top: 0px !important;"></i></label>
                                    <input type="text" name="broadcast_preview_text" id="broadcast-preview-text" class="nsm-field form-control" placeholder="">
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label class="content-subtitle fw-bold d-block mb-2">To <i id="help-popover-broadcast-to" class='bx bx-fw bx-info-circle ms-2 text-muted' style="margin-top: 0px !important;"></i></label>
                                        <a class="nsm-link d-flex align-items-center btn-quick-add-job-type" id="btn-select-customer" href="javascript:void(0);">Select Customer</a>
                                    </div>
                                    <input type="email" name="broadcast_to" class="nsm-field form-control" id="email-tags" placeholder="" multiple>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="content-subtitle fw-bold d-block mb-2">Send Date <i id="help-popover-broadcast-send-time" class='bx bx-fw bx-info-circle ms-2 text-muted' style="margin-top: 0px !important;"></i></label>
                                        <input type="date" name="broadcast_send_time" id="broadcast-send-date" class="nsm-field form-control" placeholder="" value="<?= $default_date; ?>" required>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="content-subtitle fw-bold d-block mb-2">Status </label>
                                        <select class="form-control" name="status" id="broadcast-status">
                                            <?php foreach($optionStatus as $status){ ?>
                                                <option value="<?= $status; ?>"><?= $status; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">                                    
                                <div class="col-12 mb-3">
                                    <div class="d-flex justify-content-between">
                                        <label class="content-subtitle fw-bold d-block mb-2">Content</label>
                                        <a class="nsm-link d-flex align-items-center" id="btn-email-template-list" href="javascript:void(0);">Use Template</a>
                                    </div>
                                    <textarea name="broadcast_content" id="ck-broadcast-content" class="form-control"></textarea>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="nsm-button primary" id="btn-send-test-broadcast">Send Test Broadcast</button>
                        <button type="submit" class="nsm-button primary" id="btn-send-broadcast">Create Broadcast</button>
                    </div>                                       
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-send-test" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="frm-test-email-broadcast">
                    <div class="modal-header">
                        <span class="modal-title content-title" style="font-size: 17px;"><i class='bx bx-envelope'></i> Send Test Email</span>
                        <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 mb-3">
                            <label class="content-subtitle fw-bold d-block mb-2">Email <i id="help-popover-test-email" class='bx bx-fw bx-info-circle ms-2 text-muted' style="margin-top: 0px !important;"></i></label>
                            <input type="email" name="test_email_broadcast" id="test_email_broadcast" class="nsm-field form-control" placeholder="" required>
                        </div>
                    </div>  
                    <div class="modal-footer">
                        <button type="submit" class="nsm-button primary" id="btn-send-test-email-broadcast">Send</button>
                    </div>                    
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-customer-select" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <span class="modal-title content-title" style="font-size: 17px;"><i class='bx bxs-user-account' ></i> Select Customer</span>
                        <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
                    </div>
                    <div class="modal-body">                        
                        <div id="customer-list-container"></div>
                    </div>  
                    <div class="modal-footer">
                        <button type="button" class="nsm-button primary" id="btn-add-selected-customer-email">Add Selected</button>
                    </div>                    
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-preview" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <span class="modal-title content-title" style="font-size: 17px;"><i class='bx bx-search-alt-2' ></i> Preview</span>
                        <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
                    </div>
                    <div class="modal-body" style="padding:65px;">
                        <div class="mb-5"><h3 class="preview-subject"></h3></div>
                        <div id="preview-container"></div>
                    </div>                    
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-view-email-template" role="dialog" style="z-index:9999 !important;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <span class="modal-title content-title" style="font-size: 17px;"><i class='bx bx-search-alt-2' ></i> View Email Template</span>
                        <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
                    </div>
                    <div class="modal-body" style="padding:65px;min-height:600px;max-height:800px;overflow-y:auto;overflow-x:hidden;">
                        <div class="mb-5"><h3 class="email-template-subject"></h3></div>
                        <div id="email-template-view-container"></div>
                    </div>                    
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-use-email-template" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <span class="modal-title content-title" style="font-size: 17px;"><i class='bx bx-list-ul' ></i> Use Template</span>
                        <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
                    </div>
                    <div class="modal-body">                        
                        <div id="list-email-template-container"></div>
                    </div>                  
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-recipient-summary" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <span class="modal-title content-title" style="font-size: 17px;"><i class='bx bx-mail-send'></i> <span id="recipient-summary-broadcast-name"></span></span>
                        <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
                    </div>
                    <div class="modal-body">                        
                        <div id="recipient-summary-container"></div>
                    </div>                  
                </form>
            </div>
        </div>
    </div>

</div>

<script src="<?= base_url('assets/js/v2/jquery.tagsinput.js'); ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/css/v2/jquery.tagsinput.css'); ?>">

<script type="text/javascript">
$(function(){    
    $("#email-broadcast-list").nsmPagination({itemsPerPage:10});

    CKEDITOR.replace( 'ck-broadcast-content', {
        toolbarGroups: [
            { name: 'document',    groups: [ 'mode', 'document' ] },            // Displays document group with its two subgroups.
            { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },           // Group's name will be used to create voice label.
            '/',                                                                // Line break - next group will be placed in new line.
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'links' }
        ],
        height: '500px',
    });

    var emailRegex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    $('#email-tags').tagsInput({
        'width':'auto',
        'allowDuplicates': false,
        'interactive':true,
        'defaultText':'Enter email',
        pattern: emailRegex
    });

    $('#help-popover-test-email').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Email that will receive the test email broadcast';
        } 
    });

    $('#help-popover-broadcast-name').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Unique name to identify your email broadcast';
        } 
    }); 

    $('#help-popover-sender-name').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'The contact\'s owner';
        } 
    }); 

    $('#help-popover-broadcast-preview-text').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Use preview text to spark curiosity. Preview text appear in the user\'s inbox before they open the email';
        } 
    }); 

    $('#help-popover-broadcast-subject').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Keep the subject short and to the point';
        } 
    }); 

    $('#help-popover-broadcast-to').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Choose your audience for this email';
        } 
    }); 

    $('#help-popover-broadcast-send-time').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Choose when your email broadcast will be sent or send it right away';
        } 
    }); 

    $('.btn-with-selected').on('click', function(){
        var action = $(this).attr('data-action');

        var total_selected = $('input[name="row_selected[]"]:checked').length;
        if( total_selected > 0 ){
            if( action == 'delete' ){
                var msg = 'Proceed with <b>deleting</b> selected rows?';
                var url = base_url + 'email_broadcasts/_delete_selected';
                $('#with-selected-action').val('delete');
            }else{                
                var msg = `Proceed with changing selected rows status to <b>${action}</b>?`
                var url = base_url + 'email_broadcasts/_update_status_selected';
                $('#with-selected-action').val(action);
            }

            Swal.fire({
                title: 'With Selected Action',
                html: msg,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $('#frm-with-selected').serialize(),
                        dataType:'json',
                        success: function(result) {
                            if( result.is_success == 1 ) {
                                Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: result.msg,
                                }).then((result) => {
                                    window.location.reload();
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
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select row',
            });
        }        
    });

    $('#btn-create-email-broadcast').on('click', function(){
        $('#modal-header-label').html('Create Email Broadcast');
        $('#modal-create-email-broadcast').modal('show'); 
        $('#btn-send-broadcast').html('Create Broadcast')

        $('#ebid').val(0);
        $('#broadcast-name').val('');
        $('#broadcast-sender-name').val('<?= $default_name; ?>');
        $('#broadcast-subject').val('');
        $('#broadcast-preview-text').val('');
        $('#broadcast-send-date').val('<?= $default_date; ?>');
        $('#broadcast-status').val('Draft');               
        $('#email-tags').importTags('');     

        CKEDITOR.instances['ck-broadcast-content'].setData('');
    });

    $('.btn-edit-email-broadcast').on('click', function(){
        var ebid = $(this).attr('data-id');
        $('#email-tags').importTags('');
        $('#btn-send-broadcast').html('Update Broadcast')
        $.ajax({
            url: base_url + 'email_broadcasts/_get_email_broadcast',
            method: 'post', 
            data: {ebid:ebid},           
            dataType:'json',
            success: function (response) {
                if( response.is_valid == 1 ){
                    $('#modal-header-label').html('Edit Email Broadcast');
                    $('#modal-create-email-broadcast').modal('show'); 

                    $('#ebid').val(response.data.ebid);
                    $('#broadcast-name').val(response.data.broadcast_name);
                    $('#broadcast-sender-name').val(response.data.sender_name);
                    $('#broadcast-subject').val(response.data.subject);
                    $('#broadcast-preview-text').val(response.data.preview_text);
                    $('#broadcast-send-date').val(response.data.send_date);
                    $('#broadcast-status').val(response.data.status);                    

                    CKEDITOR.instances['ck-broadcast-content'].setData(response.data.content);

                    if( response.recipients ){
                        $.each(response.recipients, function(index, value){
                            $('#email-tags').addTag(value);
                        });
                    }

                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Cannot find data',
                    });
                }
            },
            beforeSend: function() {
                
            }
        });   
    });

    $('#btn-select-customer').on('click', function(){
        $('#modal-create-email-broadcast').modal('hide'); 
        $.ajax({
            url: base_url + 'email_broadcasts/_customer_list',
            method: 'get',            
            success: function (html) {
                $('#customer-list-container').html(html);
            },
            beforeSend: function() {
                $('#modal-customer-select').modal('show'); 
                $('#customer-list-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });        
    });

    $('#btn-send-test-broadcast').on('click', function(){
        $('#modal-send-test').modal('show');        
    });

    $('.btn-recipient-summary').on('click', function(){
        var ebid = $(this).attr('data-id');
        var ebname = $(this).attr('data-name');

        $('#modal-recipient-summary').modal('show');
        $.ajax({
            url: base_url + 'email_broadcasts/_recipient_summary',
            method: 'post', 
            data: {ebid:ebid},   
            success: function (html) {                
                $('#recipient-summary-container').html(html);
            },
            beforeSend: function() {
                $('#recipient-summary-broadcast-name').html(ebname);
                $('#recipient-summary-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        }); 
    });

    $('#modal-customer-select').on('hidden.bs.modal', function () {
        $('#modal-create-email-broadcast').modal('show');         
    });

    $('#btn-add-selected-customer-email').on('click', function(){
        var uniqCustomer     = [];
        var customerSelected = [];
        $('.chk-customer').each(function () {
            if( this.checked ){
                var customer_email = $(this).val();
                customerSelected.push(customer_email);
            }
        });

        if( customerSelected.length > 0 ){
            var filteredCustomer = customerSelected.filter(obj => !uniqCustomer[obj] && (uniqCustomer[obj] = true));
            filteredCustomer.forEach(function(item) {
                $('#email-tags').addTag(item);
            });
        }

        $('#modal-customer-select').modal('hide');           
    });

    $('#btn-email-template-list').on('click', function(){
        $('#modal-create-email-broadcast').modal('hide'); 
        $.ajax({
            url: base_url + 'email_broadcasts/_email_template_list',
            method: 'get',            
            success: function (html) {
                $('#list-email-template-container').html(html);
            },
            beforeSend: function() {
                $('#modal-use-email-template').modal('show'); 
                $('#list-email-template-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });   
    });

    $('#modal-use-email-template').on('hidden.bs.modal', function () {
        $('#modal-create-email-broadcast').modal('show');         
    });

    $('#chk-all-row').on('change', function(){
        if( $(this).prop('checked') ){
            $('.chk-row').prop('checked',true);
        }else{
            $('.chk-row').prop('checked',false);
        }
    });

    $('.btn-preview-broadcast-email').on('click', function(){
        var ebid = $(this).attr('data-id');
        var subject = 'Subject : ' + $(this).attr('data-subject');

        $('#modal-preview').modal('show');  
        $('.preview-subject').html(subject);
        $.ajax({
            type: "POST",
            url: base_url + "email_broadcasts/_preview",            
            data: {ebid:ebid},
            success: function(html) {    
                $('#preview-container').html(html);                          
            },
            beforeSend: function() {
                $('#preview-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on('click', '.btn-use-template', function(){
        var tid = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: base_url + "settings/_get_email_template",            
            data: {tid:tid},
            dataType:'json',
            success: function(result) {    
                $('#modal-use-email-template').modal('hide');
                $('#broadcast-subject').val(result.subject);
                CKEDITOR.instances['ck-broadcast-content'].setData(result.content);
            },
            beforeSend: function() {
                
            }
        });
    });

    $(document).on('click', '.btn-view-template', function(){
        var tid = $(this).attr('data-id');
        var subject = 'Subject : ' + $(this).attr('data-subject');

        //$('#modal-use-email-template').modal('hide');  
        $('#modal-view-email-template').modal('show');  
        $('.email-template-subject').html(subject);
        $.ajax({
            type: "POST",
            url: base_url + "settings/_preview_email_template",            
            data: {tid:tid},
            success: function(html) {    
                $('#email-template-view-container').html(html);                          
            },
            beforeSend: function() {
                $('#email-template-view-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    // $('#modal-view-email-template').on('hidden.bs.modal', function () {
    //     $('#modal-use-email-template').modal('show');         
    // });

    $('.btn-delete-broadcast').on('click', function(){
        var broadcast_name = $(this).attr('data-broadcast');
        var ebid = $(this).attr('data-id');

        Swal.fire({
            title: 'Delete',
            html: `Proceed with deleting <b>${broadcast_name}</b>?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url + "email_broadcasts/_delete_broadcast",
                    data: {ebid:ebid},
                    dataType:'json',
                    success: function(result) {
                        if( result.is_success == 1 ) {
                            Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Email Broadcast was successfully deleted.',
                            }).then((result) => {
                                window.location.reload();
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

    $('.btn-pause-sending').on('click', function(){
        var broadcast_name = $(this).attr('data-broadcast');
        var ebid = $(this).attr('data-id');

        Swal.fire({
            title: 'Pause Sending',
            html: `This will stop sending email of broadcast <b>${broadcast_name}</b>. <br /><br />Do you wish to proceed?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url + "email_broadcasts/_pause_sending",
                    data: {ebid:ebid},
                    dataType:'json',
                    success: function(result) {
                        if( result.is_success == 1 ) {
                            Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Email Broadcast was successfully updated.',
                            }).then((result) => {
                                window.location.reload();
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

    $('.btn-resume-sending').on('click', function(){
        var broadcast_name = $(this).attr('data-broadcast');
        var ebid = $(this).attr('data-id');

        Swal.fire({
            title: 'Resume Sending',
            html: `This will resume sending email of broadcast <b>${broadcast_name}</b>. <br /><br />Do you wish to proceed?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url + "email_broadcasts/_resume_sending",
                    data: {ebid:ebid},
                    dataType:'json',
                    success: function(result) {
                        if( result.is_success == 1 ) {
                            Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Email Broadcast was successfully updated.',
                            }).then((result) => {
                                window.location.reload();
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

    $('#frm-test-email-broadcast').on('submit',function(e){
        e.preventDefault();

        var test_email_recipient = $('#test_email_broadcast').val();

        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }

        $.ajax({
            type: "POST",
            url: base_url + "email_broadcasts/_send_test_email_broadcast",
            dataType: 'json',
            data: $('#frm-create-email-broadcasts').serialize() + '&test_email_recipient=' + test_email_recipient,
            success: function(data) {    
                $('#btn-send-test-email-broadcast').html('Send');                   
                if (data.is_success) {
                    $('#modal-send-test').modal('hide');
                    Swal.fire({
                        text: "Test Broadcast Email was successfully sent",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            
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
                $('#btn-send-test-email-broadcast').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#frm-create-email-broadcasts').on('submit', function(e){
        e.preventDefault();
        var ebid = $('#ebid').val();

        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }

        if( ebid > 0 ){
            var url = base_url + 'email_broadcasts/_update_email_broadcast';
            var success_msg = 'Email Broadcast was successfully updated';
            var btn_default_text = 'Update Broadcast';
        }else{
            var url = base_url + 'email_broadcasts/_save_email_broadcast';
            var success_msg = 'Email Broadcast was successfully created';
            var btn_default_text = 'Create Broadcast';
        }

        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: $('#frm-create-email-broadcasts').serialize(),
            success: function(data) {    
                $('#btn-send-broadcast').html(btn_default_text);                   
                if (data.is_success) {
                    $('#modal-create-email-broadcast').modal('hide');
                    Swal.fire({
                        text: success_msg,
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
                $('#btn-send-broadcast').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#frm-list-search').on('submit', function(e){
        e.preventDefault();
        var search_query = $('#search-list').val();
        const params = new URLSearchParams({search: search_query});
        const str = params.toString();
        location.href = base_url + `email_broadcasts?${str}`;

    });

    $('.btn-filter').on('click', function(){
        var status = $(this).attr('data-status');
        if( status == 'all' ){
            location.href = base_url + `email_broadcasts`;
        }else{
            location.href = base_url + `email_broadcasts?status=${status}`;
        }
        
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>