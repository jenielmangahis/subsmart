<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('events/new_event') ?>'">
        <i class='bx bx-user-plus'></i>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/event_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-alert warning">
                            <button><i class='bx bx-x'></i></button>
                            Event types can be separated into seminars, conference, trade show, work shop, corporate, private, or charity. Event types can also be track for categories where an invoice will not be submit like estimates, tasks, demos and reminders. With our Crm you can choose, create or delete the appropriate classification for your business model.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('events/add_new_event_tag'); ?>'">
                                <i class='bx bx-fw bx-book'></i> New Event Type
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Event Type Name">Event Type Name</td>
                            <td data-name="Manage"></td>
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
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $type->id; ?>">Delete</a>
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
        </div>
    </div>
</div>


<script type="text/javascript">
    $(".nsm-table").nsmPagination();

    $(document).ready(function() {
        $(document).on('click', '.delete-item', function() {
            var eid = $(this).data("id");
            Swal.fire({
                title: 'Delete selected Event Type?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: base_url + "/event_types/delete",
                        data: {
                            eid: eid
                        }, // serializes the form's elements.
                        success: function(data) {
                            /*Swal.fire(
                              'Deleted!',
                              'Your file has been deleted.',
                              'success'
                            );*/
                            window.location.reload();
                        }
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>