<?php include viewPath('v2/includes/header'); ?>
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
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/event_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">Create your own event tags</div>
                    </div>
                </div>
                <form id="EVENT_TAG_ADD_FORM" method="POST" accept="multipart">
                    <input type="hidden" name="default_icon_id" id="default-icon-id" value="">
                    <div class="row">
                        <div class="col-12">
                            <div class="nsm-card primary">
                                <div class="nsm-card-header">
                                    <div class="nsm-card-title">
                                        <span>Add Event Tag</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="nsm-card-content">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-12">
                                            <label class="content-subtitle fw-bold d-block mb-2">Event Tag Name</label>
                                            <input type="text" name="event_tag_name" value=""  class="nsm-field form-control" required="" autocomplete="off" />
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <label class="content-subtitle fw-bold d-block mb-2">Icon / Marker</label>
                                            <input type="file" name="image" value=""  class="nsm-field form-control" id="input-upload-image" style="width: 20%;display: inline-block;" autocomplete="off" />
                                            <input type="text" name="default-icon-name" disabled="" value="" class="form-control" style="width: 20%;display: inline-block;" id="icon-pick-name"><br />
                                            <div class="form-check" style="margin-top: 10px;">
                                                <input class="form-check-input" type="checkbox" name="is_default_icon" value="1" id="iconList">
                                                <label class="form-check-label" for="iconList">
                                                Pick from list
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3 text-end">
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
$("#EVENT_TAG_ADD_FORM").submit(function (event) {
    event.preventDefault();
    if (!$('#input-upload-image').val() && !$('#iconList').is(':checked')) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Please specify job type icon/marker image!',
        });
    } else {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Event tag was added successfully!',
        }).then((result) => {
            // if (result.isConfirmed) {
            window.location.href = base_url + "/events/event_tags";
            // }
        });
        $.ajax({
            url: base_url + '/events/save_event_tag',
            type: "post",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            //   success: function(data){
            // }
        });
    }
});


$(function () {
    $("#icon-pick-name").hide();
    $(".a-icon").click(function () {
        var icon_name = $(this).attr("data-name");
        var icon_id = $(this).attr("data-id");

        $("#input-upload-image").hide();
        $("#icon-pick-name").show();
        $("#icon-pick-name").val(icon_name);
        $("#modalIconList").modal('hide');
        $("#default-icon-id").val(icon_id);
    });

    $("#iconList").change(function () {
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