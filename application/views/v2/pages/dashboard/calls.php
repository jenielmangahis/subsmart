<?php include viewPath('v2/includes/header'); ?>
<style>
    #customercontact_table_wrapper .dataTables_length,
    #customercontact_table_wrapper .dataTables_filter {
        display: none;
    }

    #customercontact_table > tbody {
        font-size: unset;
    }

    #customercontact_table > tbody > tr > td {
        vertical-align: middle;
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
                        <div class="nsm-callout primary">Call a Customer. Log in to the RingCentral floating widget first before using the call feature.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <input id="customercontact_table_search" class="form-control mt-0 mb-2 w-25" type="text" placeholder="Search...">
                        <table id="customercontact_table" class="table table-hover w-100 mb-3">
                            <thead>
                                <tr>
                                    <th class="noWidth"></th>
                                    <th>Customer</th>
                                    <th>Type</th>
                                    <th>Phone No.</th>
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
    var BASE_URL = window.origin;
    $.getScript('https://ringcentral.github.io/ringcentral-embeddable-voice/adapter.js').done(function() {
        setTimeout(() => {
            if ($('header[class="Adapter_header Adapter_minimized"]').length === 1) {
                $('.Adapter_minimizeIcon').click();
            }
        }, 1500);
    });

    $(document).on('click', '.call-customer', function () {
        if ($('header[class="Adapter_header Adapter_minimized"]').length === 1) {
            $('.Adapter_minimizeIcon').click();
        }
    });

    $(document).ready(function() {
        // DataTable Configuration ===============
        const customercontact_table = $('#customercontact_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": BASE_URL + "/Calls/showCustomerContacts",
                "type": "POST",
            },
            "language": {
                "infoFiltered": "",
            },
            // "order": [[0, 'desc'] ],
        });

        $('#customercontact_table_search').keyup(function() {
            customercontact_table.search($(this).val()).draw();
        });

        $('#customercontact_table').removeClass('dataTable');
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>