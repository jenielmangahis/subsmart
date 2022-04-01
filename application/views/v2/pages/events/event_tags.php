<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('events/add_new_event_tag') ?>'">
        <i class='bx bx-tag'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/event_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            While categories are broader designations that are typically assigned one per event, tags are short but specific, and each event can be assigned as many tags as you'd like. It's a great way to use keywords or other important phrases to help you locate events that are most relevant to your interests.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('events/add_new_event_tag'); ?>'">
                                <i class='bx bx-fw bx-tag'></i> New Event Tag
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Name">Name</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($event_tags)) :
                        ?>
                            <?php
                            foreach ($event_tags as $tag) :
                            ?>
                                <tr>
                                    <td>
                                        <?php
                                        if ($tag->marker_icon != '') :
                                            if ($tag->is_marker_icon_default_list == 1) :
                                                $marker = base_url("uploads/icons/" . $tag->marker_icon);
                                            else :
                                                $marker = base_url("uploads/event_tags/" . $tag->company_id . "/" . $tag->marker_icon);
                                            endif;
                                        else :
                                            $marker = base_url("uploads/event_tags/default_no_image.jpg");
                                        endif;
                                        ?>
                                        <div class="table-row-icon img" style="background-image: url('<?php echo $marker ?>')"></div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?= $tag->name; ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?= base_url("events/edit_event_tags/" . $tag->id); ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $tag->id; ?>">Delete</a>
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
                </table>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
        
        $(document).on( "click", ".delete-item", function( event ) {
            var ID = $(this).data("id");
            Swal.fire({
                title: 'Delete selected event tag?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url(); ?>/events/delete_tag",
                        data: {tag_id : ID}, // serializes the form's elements.
                        success: function(data)
                        {
                            if(data === "1"){
                                window.location.reload();
                            }else{
                                alert(data);
                            }
                        }
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>