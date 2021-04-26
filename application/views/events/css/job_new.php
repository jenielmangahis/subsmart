<style type="text/css">
    .wrapper *{
        font-size: 14px;
    }
    #map {
        height: 210px;
        width: 100%;
        padding: 0;
    }

    .left-sidebar-main .card {
        padding: 0px;
    }
    .left-sidebar-main .card .page-title {
        display: flex;
        align-items: center;
    }
    .left-sidebar-main .card .page-title svg {
        margin-right: 0;
    }
    .form-group-icon {
        position: relative;
    }
    .form-group-icon i {
        position: absolute;
        left: 10px;
        top: 16px;
        color: #222222;
    }
    .form-group-icon input {
        padding: 15px 35px;
    }
    .btn-primary.text-link {
        padding: 6px 8px;
        background: none;
        color: #45a73c;
    }
    .btn-primary.text-link:hover {
        background-color: #45a73c;
        color: #fff;
    }
    .table-custom table th,
    .table-custom table td {
        border: none;
    }
    .table-custom table {
        border: none;
    }
    .table-custom table td a i {
        color: #45a73c;
        padding-left: 0px;
    }
    .table-custom table td.d-flex {
        padding-top: 23px;
    }
    .table-custom table td a {
        padding-left: 11px;
    }
    .table-hover tbody tr:hover, .table-striped tbody tr:nth-of-type(odd), .thead-default th {
        background-color: #fff;
    }
    .upload input[type=file]:before {
        width: 100%;
        height: 60px;
        font-size: 16px;
        line-height: 32px;
        content: 'Upload Existing Estimate';
        display: inline-block;
        background: #45a73c;
        padding: 5px 10px;
        text-align: center;
        color: #fff;
        border-radius: 0px;
    }
    .upload.workorder input[type=file]:before {
        content: 'Upload Workorder';
    }
    .upload.invoice input[type=file]:before {
        content: 'Upload Invoice';
    }
    .upload input[type=file] {
        cursor: pointer;
        width: 100%;
        height: 44px;
        overflow: hidden;
    }
    .card-body .edit-icon {
        position: absolute;
        right: 20px;
        top: 25px;
    }
    .card-body .edit-icon button{
        padding: 0px;
        border: none;
        background: none;
    }
    .label-width label {
        width: 125px;
    }
    #new_customer .modal-lg {
        max-width: 100%;
    }
    .contact-info h3{
        color: rgba(0, 0, 0, 0.87);
        font-size: 16px;
        font-weight: 500;
        font-family: "Roboto", "Helvetica", "Arial", sans-serif;
        line-height: 1.5em;
        display: flex;
        align-items: center;
    }
    .contact-info svg {
        margin-right:15px;
    }
    .address-proof {
        width: 100%;
    }
    .address-proof iframe {
        width:100%;
        max-height: 250px;
    }
    .modal-footer-detail {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        display: block;
        border: 0;
        border-top: 1px solid rgba(0,0,0,.1);
        width: 100%;
    }
    .card-header .btn:after {
        content: '-';
        font-size: 50px;
        position: absolute;
        top: -5px;
        right: 18px;
    }

    .card-header .btn.collapsed:after {
        content: '+';
        font-size: 34px;
        position: absolute;
        top: 7px;
        /* left: 0px; */
        right: 20px;
    }
    .card-header .btn, .card-header .btn:hover, .card-header .btn:focus, .card-header .btn.focus {
        color: #000;
        text-decoration: none;
        border-bottom: 1px solid #e5e5e5;
        box-shadow: none;
        padding: 0;
        width: 100%;
    }
    .card-header .btn:hover{

    }
    .card-header {
        border: none;
        padding: 0px;
        background: none;
    }
    .accordion .card-body {
        padding-left: 0px;
        padding-right: 0px;
        padding-bottom: 0px;
    }
    .accordion .card-body .form-group {
        margin-bottom: 0px !important;
    }
    .accordion .card-body {
        padding-bottom: 16px;
    }
    .left-sidebar-main .accordion .card {
        border: none !important;
    }
    .left-sidebar-main .card .accordion .page-title {
        display: flex;
        align-items: center;
        border-bottom: 1px solid #e9ecef !important;
        margin: 0px;
        padding: 10px 0px;
    }
    .label-width .form-control {
        width: 42%;
    }
    .left-sidebar-main .card.table-custom .modal {
        padding-right: 0px !important;
    }
    .block-btn-main .btn-full {
        padding: 12px 8px;
    }
    .block-btn-main .btn-full .btn {
        width: 100%;
    }

    .file-upload-drag {
        display: block;
        position: relative;
        width: 60%;
    }
    .file-upload-drag .drop {
        width: 100%;
        height: 100%;
        border: 4px dashed #45a73c;
        border-spacing: 25px;
        overflow: hidden;
        text-align: center;
        -webkit-transition: all 0.5s ease-out;
        -moz-transition: all 0.5s ease-out;
        transition: all 0.5s ease-out;
        -ms-transition: all 0.5s ease-out;
        -o-transition: all 0.5s ease-out;
        margin: auto;
        /* position: absolute; */
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        display: table;
        text-align: center;
        border-radius: 24px;
        -webkit-border-radius: 24px;
        -moz-border-radius: 24px;
        -ms-border-radius: 24px;
        -o-border-radius: 24px;
        color: #000;
    }
    .file-upload-drag .drop .cont {
        width: 100%;
        height: 100px;
        color: #fff;
        -webkit-transition: all 0.5s ease-out;
        -moz-transition: all 0.5s ease-out;
        transition: all 0.5s ease-out;
        margin: auto;
        /* position: absolute; */
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        display: table-cell;
        vertical-align: middle;
        text-align: center;
    }
    .file-upload-drag .drop .cont p {
        font-size: 20px;
        line-height: 20px;
        margin: 15px 0px;
        color: #000;
        font-weight: bold;
    }
    .file-upload-drag .drop input[type=file] {
        width: 100%;
        height: 100%;
        cursor: pointer;
        background: transparent;
        opacity: 0;
        margin: auto;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
    }
    .file-upload-drag .drop .cont p.or-text {
        color: #e0e0e0;
        font-size: 16px;
    }
    .color-box-custom {
        padding: 20px 0px;
    }
    .color-box-custom ul {
        margin: 0px;
        padding: 0px;
        list-style: none;
    }
    .color-box-custom ul li {
        display: inline-block;
    }
    .color-box-custom ul li span {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #000;
        display: block;
    }
    .color-box-custom ul li span.bg-1 {
        background-color: #4baf51;
    }
    .color-box-custom ul li span.bg-2 {
        background-color: #d86566;
    }
    .color-box-custom ul li span.bg-3 {
        background-color: #e57399;
    }
    .color-box-custom ul li span.bg-4 {
        background-color: #b273b3;
    }
    .color-box-custom ul li span.bg-5 {
        background-color: #8b63d7;
    }
    .color-box-custom ul li span.bg-6 {
        background-color: #678cda;
    }
    .color-box-custom ul li span.bg-7 {
        background-color: #59bdb3;
    }
    .color-box-custom ul li span.bg-8 {
        background-color: #64ae89;
    }
    .color-box-custom ul li span.bg-9 {
        background-color: #f1a740;
    }

    #customer_info td, #customer_info th{
        border-top: 0 !important;
    }
    #customer_info>tbody>tr>td{
        padding: 3px 8px !important;
    }
    .card-body {
        padding: 1.25rem 1.25rem 0 1.25rem !important;
    }
    .customer_right_icon{
        float: right;
        font-size: 22px;
    }
    .add_new_customer{
        color :#32243d;
    }
    .btn-circle {
        width: 40px;
        height: 40px;
        text-align: center;
        padding: 5px 7px 0 7px;
        font-size: 16px;
        line-height: 1.428571429;
        border-radius: 20px;
    }
    .calendar_button{
        color: #ffffff;
        font-size: 20px;
        padding-top: 3px;
    }

</style>