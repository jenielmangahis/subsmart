<?php include viewPath('v2/includes/header'); ?>
<style>
    #scheduledcall_table_wrapper .dataTables_length,
    #scheduledcall_table_wrapper .dataTables_filter {
        display: none;
    }

    #scheduledcall_table > tbody {
        font-size: unset;
    }

    .table > :not(:last-child) > :last-child > * {
        border-bottom: 1px solid #dee2e6;
    }

    .noWidth {
        width: 0% !important;
    }
    
    .dotsOption {
        text-decoration: none;
        color: gray;
    }
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/call_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">List of scheduled calls made by users seeking assistance with the system.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <input id="scheduledcall_table_search" class="form-control mt-0 mb-2 w-25" type="text" placeholder="Search...">
                        <table id="scheduledcall_table" class="table table-hover w-100 mb-3">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Notes</th>
                                    <th>Status</th>
                                    <th class="noWidth"></th>
                                </tr>
                            </thead>
                            <tbody><tr></tr></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // DataTable Configuration ===============
        const scheduledcall_table = $('#scheduledcall_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": BASE_URL + "/TechSupportSidebar/viewSchedule",
                "type": "POST",
            },
            "language": {
                "infoFiltered": "",
            },
            // "order": [[0, 'desc'] ],
        });

        $('#scheduledcall_table_search').keyup(function() {
            scheduledcall_table.search($(this).val()).draw();
        });

        $('#scheduledcall_table').removeClass('dataTable');
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>