<style>
button#dropdown-edit {
    width: 100px;
}
label>input {
  visibility: initial !important;
  position: initial !important; 
}
.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 54% !important;
    right: 9px !important;
}
.customer-name{
    display: block;
    font-size: 13px;
    color: #2ab363;
}
.dropdown-menu .divider {
    height: 1px;
    margin: 9px 0;
    overflow: hidden;
    background-color: #e5e5e5;
}
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  margin-bottom: 0px !important;
  padding-top: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding: 0px 25px !important;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 5px !important;
  padding-left: 5px !important;
  margin-top: 55px !important;
}
.subtle-txt {
    color: rgba(42, 49, 66, 0.7);
}
svg#svg-sprite-menu-close {
    position: relative;
    bottom: 180px !important;
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
</style>
<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>
<!-- page wrapper start -->
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/upgrades_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/online_booking_subtabs'); ?>
    </div>
</div>
<style>
    .hid-deskx {
        display: none !important;
    }


    @media only screen and (max-width: 600px) {
        .hid-desk {
            display: none !important;
        }

        .hid-deskx {
            display: block !important;
        }
    }
</style>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    $('.table-to-list').DataTable({
        "ordering": false
    });

    $(document).ready(function () {
        /*$(".btn-send-customer").click(function(e){
            var cnid = $(this).attr("data-id");
            $("#cnid").val(cnid);
            $("#modalSendEmail").modal('show');
        });*/

        $(".delete-credit-note").click(function(e){
            var eid = $(this).attr("data-id");
            $("#eid").val(eid);
            $("#modalDeleteCreditNote").modal('show');
        });

        $(".close-credit-note").click(function(e){
            var eid = $(this).attr("data-id");
            var credit_note_number = $(this).attr("data-name");
            $("#ceid").val(eid);
            $(".close-credit-note-number").text(credit_note_number);
            $("#modalCloseCreditNote").modal('show');
        });

        $(".clone-credit-note").click(function(e){
            var eid = $(this).attr("data-id");
            var credit_note_number = $(this).attr("data-name");
            $("#cloneid").val(eid);
            $(".clone-credit-note-number").text(credit_note_number);
            $("#modalCloneCreditNote").modal('show');
        });
    });
</script>
