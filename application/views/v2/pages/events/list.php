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
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            This is where you will create, view, and edit your events and all event-related records, go to the Events work area where you can create a new event and—working from this single event record—add most of the other types of records and information that you need to plan, publish, promote, and analyze it. Like many of our sales items the event record provides a customizable business process workflow that helps guide you through each step of the process.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter by <?= $filter_status != '' ? ucfirst($filter_status) : 'All' ; ?></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?= base_url('events'); ?>">All</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('events?status=draft'); ?>">Draft</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('events?status=scheduled'); ?>">Scheduled</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('events?status=started'); ?>">Started</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('events?status=finished'); ?>">Finished</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('events/new_event') ?>'">
                                <i class='bx bx-fw bx-calendar-event'></i> New Event
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Job Number">Job Number</td>
                            <td data-name="Date">Date</td>
                            <td data-name="Employee">Employee</td>
                            <td data-name="Amount">Amount</td>
                            <td data-name="Event Type">Event Type</td>
                            <td data-name="Event Tag">Event Tag</td>
                            <td data-name="Event Type">Status</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($events)) :
                        ?>
                            <?php
                            foreach ($events as $event) :
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-calendar-event'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?= $event->event_number; ?></td>
                                    <td><?php echo date_format(date_create($event->date_created), "m/d/Y"); ?></td>
                                    <td><?= $event->FName . ' ' . $event->LName; ?></td>
                                    <td>$<?= number_format((float)$event->amount, 2, '.', ','); ?></td>
                                    <td><?= $event->event_type; ?></td>
                                    <td><?= $event->event_tag; ?></td>
                                    <td><?= ucfirst($event->status); ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?= base_url('events/event_preview/') . $event->id; ?>">Preview</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="<?= base_url('events/new_event/') . $event->id; ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $event->id; ?>">Delete</a>
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
                                <td colspan="8">
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

        $(document).on("click", ".delete-item", function(event) {
            var ID = $(this).data("id");
            Swal.fire({
                title: 'Continue to REMOVE this Event?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('events/delete_event') ?>",
                        data: {
                            job_id: ID
                        }, // serializes the form's elements.
                        success: function(data) {
                            if (data === "1") {
                                window.location.reload();
                            } else {
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