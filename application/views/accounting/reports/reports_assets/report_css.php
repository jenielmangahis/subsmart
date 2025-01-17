<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<style>
    small {
        font-size: smaller;
    }

    table {
        width: 100% !important;
    }

    .pdfAttachmentCheckbox,
    .xlsxAttachmentCheckbox,
    .enableDisableBusinessName,
    .enableDisableReportName {
        width: 18px;
        height: 18px;
    }

    .borderRadius0>* {
        border-radius: 0px;
    }

    .pdfAttachment {
        margin-bottom: -1px;
    }

    .modal-body {
        padding-top: 10px;
    }

    .nsm-table td {
        padding: 5px 5px 5px 0px;
    }

    .fw-xnormal {
        font-weight: 500;
    }

    .PLACE_LEFT {
        text-align: left;
    }

    .PLACE_RIGHT {
        text-align: right;
    }

    #sort-by {
        width: 125px;
    }

    .headerInfo {
        position: relative;
    }

    .footerInfo {
        text-align: center;
    }

    .reportTitleInfo {
        text-align: center;
    }

    #businessLogo {
        height: auto;
        width: 85px;
        position: absolute;
        left: 20px;
    }

    .d-none-custom {
        display: none;
    }

    table.dataTable>thead>tr>th {
        border-bottom: 1px solid lightgray !important;
        padding-left: 10px;
    }

    .cke_notification,
    .cke_notification_warning {
        display: none;
    }

    .collapse-row:hover {
        cursor: pointer;
    }

    table.dataTable thead th, table.dataTable thead td {
        padding: 10px 10px !important;
    }

    /* table.dataTable > tbody {
        font-size: 14px;
    } */
    .nsm-table thead tr:not(.nsm-row-collapse) td:not(.show), .nsm-table tbody tr:not(.nsm-row-collapse) td:not(.show) {
        display: table-cell !important;
    }
    .dataTables_wrapper{
        overflow-x:auto !important;
    }
</style>