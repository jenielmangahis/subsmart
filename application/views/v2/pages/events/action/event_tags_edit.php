<?php include viewPath('v2/includes/header'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<style>
.list-icon{
  list-style: none;
  height: 400px;
  overflow: auto;
  padding: 6px;
}
.list-icon li{
  display: inline-block;
  width: auto;
  text-align: center;
  height:100px;
  margin: 3px;
}
.icon-image{
  height: 50px;
  width: 50px;
}
.list-icon a img {
    transition: all 0.3s linear;
}
.list-icon a:hover img {
    transform: scale(1.5);
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/events_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/event_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">Edit event tags</div>
                    </div>
                </div>
                <form id="EVENT_TAG_EDIT_FORM" method="POST" accept="multipart">
                    <input type="hidden" name="default_icon_id" id="default-icon-id" value="">
                    <input type="hidden" name="tid" value="<?= $eventTag->id; ?>">
                    <div class="row">
                        <div class="col-5">
                            <div class="nsm-card primary">
                                <div class="nsm-card-header">
                                    <div class="nsm-card-title">
                                        <span>Edit Event Tag</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="nsm-card-content">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-12">
                                            <label class="content-subtitle fw-bold d-block mb-2">Event Tag Name</label>
                                            <input type="text" name="event_tag_name" value="<?= $eventTag->name; ?>"  class="nsm-field form-control" required="" autocomplete="off" />
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <label class="content-subtitle fw-bold d-block mb-2">Icon / Marker</label>
                                            <?php 
                                                if( $eventTag->marker_icon != '' ){
                                                  if( $eventTag->is_marker_icon_default_list == 1 ){
                                                    $image_url = base_url('uploads/icons/'. $eventTag->marker_icon);
                                                  }else{
                                                    $image_url = base_url('uploads/event_tags/' . $eventTag->company_id . '/' . $eventTag->marker_icon);
                                                  }
                                                }else{
                                                  $image_url = base_url('uploads/event_tags/no_file.png');
                                                }
                                                ?>
                                            <img src="<?= $image_url; ?>" class="marker-icon" />
                                            <input type="file" name="image" value=""  class="nsm-field form-control" id="input-upload-image" style="width: 20%;display: inline-block;" autocomplete="off" />
                                            <input type="text" name="default-icon-name" disabled="" value="<?= $eventTag->marker_icon; ?>" class="form-control" style="width: 20%;display: inline-block;" id="icon-pick-name"><br />
                                            <div class="form-check" style="margin-top: 10px;">
                                                <?php 
                                                    $is_list = "";
                                                    if( $eventTag->is_marker_icon_default_list == 1 ){
                                                      $is_list = 'checked="checked"';
                                                    }
                                                    ?>
                                                <input class="form-check-input" <?= $is_list; ?> type="checkbox" name="is_default_icon" value="1" id="iconList">
                                                <label class="form-check-label" for="iconList">
                                                Pick from list
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5 mt-3 text-end">
                            <button type="button" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('events/event_tags') ?>'">Go Back to Event Tags List</button>
                            <button type="submit" name="btn_save" class="nsm-button primary">Save</button>
                        </div>
                    </div>
                </form>
                <div class="modal fade nsm-modal fade" id="modalIconList" tabindex="-1" aria-labelledby="modalIconListLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <input type="hidden" name="pid" id="priority_id" value="">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title">Icon List</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <ul class="list-icon">
                                            <?php foreach($icons as $i){ ?>
                                            <li>
                                                <a href="javascript:void(0);" data-name="<?= $i->image; ?>" data-id="<?= $i->id; ?>" class="a-icon hvr-float-shadow hvr-icon-bounce">
                                                <img src="<?= base_url('uploads/icons/' . $i->image); ?>" class="icon-image hvr-icon">
                                                </a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$("#EVENT_TAG_EDIT_FORM").submit(function(event) {
    event.preventDefault();
    if (!$('#input-upload-image').val() && !$('#iconList').is(':checked')) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Please specify event tag icon/marker image!',
        });
    } else {        
        $.ajax({
            url: base_url + 'events/_update_event_tag',
            type: "post",
            data: new FormData(this),
            dataType:'json',
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data){
                Swal.fire({
                    icon: 'success',
                    //title: 'Success',
                    text: 'Event Tag was updated successfully!',
                }).then((result) => {
                    // if (result.isConfirmed) {
                    location.href = base_url + "events/event_tags";                    
                    // }
                });
            }
        });
    }
});

$(function(){
  <?php if( $eventTag->is_marker_icon_default_list == 1 ){ ?>
    $("#input-upload-image").hide();
  <?php }else{ ?>
    $("#icon-pick-name").hide();
  <?php } ?>
  
$(".a-icon").click(function() {
    var icon_name = $(this).attr("data-name");
    var icon_id = $(this).attr("data-id");

    $("#input-upload-image").hide();
    $("#icon-pick-name").show();
    $("#icon-pick-name").val(icon_name);
    $("#modalIconList").modal('hide');
    $("#default-icon-id").val(icon_id);
});

$("#iconList").change(function() {
if ($(this).is(':checked')) {
    $("#modalIconList").modal('show');
} else {
    $("#input-upload-image").show();
    $("#icon-pick-name").hide();
    $("#default-icon-id").val("");
}
});
});
</script>
<?php include viewPath('v2/includes/footer'); ?>