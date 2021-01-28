<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/notifications'); ?>
    <?php include viewPath('includes/sidebars/customer'); ?>
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Add Ticket</h1>
                    </div>
                </div>
                <!-- end row -->
            <iframe src="<?= base_url('/fb/view/93')?>" frameborder="0" class="workorder-container w-100 vh-100"></iframe>
                <!-- end container-fluid -->
            </div>
            <!-- end container-fluid -->
        </div>
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/timepicker/"></script>
<script>
    $(document).ready(function () {
        $('.form-validate').validate();

        //repeater content
        $(document).on('click', '.repeater-content-block .repeat-action', function (e) {

            const index = $(this).prev().find('.repeater-wrap > tr').length;

            const zn = (index <= 0) ? 1 : index + 1;

            let row = '<tr>';
            row += '<td><label class="mr-4"><input type="checkbox" name="zone_info[' + index + '][existing]" value="' + eval(index + 1) + '" id="zone_info_existing_' + index + '"></label></td>';
            row += '<td>' + zn + '</td>';
            row += '<td><label class="mr-4"><input type="checkbox" name="zone_info[' + index + '][repeat_issue]" value="' + eval(index + 1) + '" id="zone_info_repeat_issue_' + index + '"></label></td>';
            row += '<td><input type="text" name="zone_info[' + index + '][repeat_issue]" class="form-control"></td>';
            row += '<td><button type="button" class="btn btn-danger btn-close"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
            row += '</tr>';

            $(this).prev().find('.repeater-wrap').append(row);
        });

        $(document).on('click', '.repeater-content-block .repeater-wrap tr .btn-close', function (e) {

            console.log("x");
            $(this).parent().parent().remove();
        });

        // plan type change
        $(document).on('change', '#plan_type', function (e) {

            // alert($(this).val());
            getplanItems($(this).val());
        });


        // signature for Technician
        $('#smoothed').signaturePad({drawOnly: true, drawBezierCurves: true, lineTop: 200});
        $("#company_representative_approval_signature").on("click touchstart", function () {
            var canvas = document.getElementById("company_representative_approval_signature");
            var dataURL = canvas.toDataURL("image/png");
            $("#saveCompanySignatureDB").val(dataURL);
        });

        // signature for Technician
        $('#smoothed2').signaturePad({drawOnly: true, drawBezierCurves: true, lineTop: 200});
        $("#primary_account_holder_signature").on("click touchstart", function () {
            var canvas = document.getElementById("primary_account_holder_signature");
            var dataURL = canvas.toDataURL("image/png");
            $("#savePrimaryAccountSignatureDB").val(dataURL);
        });

        // signature for Technician
        $('#smoothed3').signaturePad({drawOnly: true, drawBezierCurves: true, lineTop: 200});
        $("#secondary_account_holder_signature").on("click touchstart", function () {
            var canvas = document.getElementById("secondary_account_holder_signature");
            var dataURL = canvas.toDataURL("image/png");
            $("#saveSecondaryAccountSignatureDB").val(dataURL);
        });


        // $('#time_scheduled, #arrival_time').datetimepicker({
        //     format: 'LT'
        // });

        $('#time_scheduled, #arrival_time').timepicker({'scrollDefault': 'now'});


        $('#ticket_date, #card_exp_date').datetimepicker({
            format: 'L'
        });
    });
</script>