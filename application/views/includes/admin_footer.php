<!-- Footer -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">Copyright © 2020 nSmartrac. All rights reserved.</div>
        </div>
    </div>
</footer><!-- End Footer -->
<!-- jQuery  -->

<script
    src="<?php echo $url; ?>plugins/jquery-initialize/jquery.initialize.min.js">
</script>
<script src="<?php echo $url; ?>dashboard/js/bootstrap.bundle.min.js">
</script>
<script src="<?php echo $url; ?>dashboard/js/jquery.slimscroll.js">
</script>
<script src="<?php echo $url; ?>dashboard/js/waves.min.js"></script>
<!--Chartist Chart-->
<!-- <script src="../plugins/chartist/js/chartist.min.js"></script>
<script src="../plugins/chartist/js/chartist-plugin-tooltip.min.js"></script>
<script src="../plugins/peity-chart/jquery.peity.min.js"></script> -->
<!-- App js<script src="<?php echo $url; ?>dashboard/pages/dashboard.js">
</script> -->
<!--Morris js Chart-->
<script src="<?php echo $url; ?>plugins/morris.js/morris.min.js">
</script>


<script src="<?php echo $url; ?>dashboard/js/app.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> -->

<script
    src="<?php echo $url; ?>plugins/datatables.net/export/dataTables.buttons.min.js">
</script>
<script
    src="<?php echo $url; ?>plugins/datatables.net/export/buttons.bootstrap.min.js">
</script>
<script
    src="<?php echo $url; ?>plugins/datatables.net/export/jszip.min.js">
</script>
<script
    src="<?php echo $url; ?>plugins/datatables.net/export/pdfmake.min.js">
</script>
<script
    src="<?php echo $url; ?>plugins/datatables.net/export/vfs_fonts.js">
</script>
<script
    src="<?php echo $url; ?>plugins/datatables.net/export/buttons.html5.min.js">
</script>
<!-- Validate  -->
<script src="<?php echo $url; ?>plugins/switchery/switchery.min.js">
</script>
<script src="<?php echo $url; ?>plugins/jquery.validate.min.js"></script>
<script
    src="<?php echo $url; ?>plugins/select2/dist/js/select2.full.min.js">
</script>
<script
    src="<?php echo $url; ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script
    src="<?php echo $url; ?>plugins/bootstrap-treeview/bootstrap-treeview.js">
</script>
<!-- Include calender js files -->
<!-- <script src="<?php //echo base_url()?>calender/assets/js/calendar.js">
</script> -->
<!-- dynamic assets goes  -->
<script type="text/javascript">
    window.base_url = <?php echo json_encode(base_url()); ?> ;
    var nav_badges = '';
</script>
<script src="<?php echo $url; ?>js/timesheet/clock.js"></script>
<script src="<?php echo $url; ?>js/icons/icon.navbar.js"></script>
<script src="<?php echo $url; ?>plugins/sweetalert/sweetalert2@10.js">
</script>
<?php echo put_footer_assets(); ?>


<!-- <script src="<?php //echo $url->assets?>jSignature-master/libs/jquery.js">
</script>
<script
    src="<?php //echo $url->assets?>jSignature-master/libs/jSignature.min.js">
</script>
<script
    src="<?php //echo $url->assets?>jSignature-master/libs/modernizr.js">
</script> -->
<script
    src="<?php echo $url; ?>signature_pad-master/js/signature_pad.js">
</script>
<script src="<?php echo $url; ?>js/jquery.signaturepad.js"></script>
<!-- <script src="<?php echo $url; ?>js/sign_new.js"></script>
<script src="<?php echo $url; ?>js/sign2.js"></script> -->
<script src="<?php echo $url; ?>js/sidebar_badges.js"></script>
<script src="<?php echo $url; ?>js/custom.js"></script>
<script type="text/javascript"
    src="<?php echo $url; ?>ckeditor/ckeditor.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery('#smoothed').signaturePad({
            drawOnly: true,
            drawBezierCurves: true,
            lineTop: 200
        });
    });
</script>

<style>
    .suggestions {
        padding: 0px;
        list-style: none;
        position: absolute;
        z-index: 66666;
        background: #fff;
        width: 325px;
    }

    .suggestions li {
        padding: 10px 8px;
        border-bottom: 1px solid;
        cursor: pointer;
    }

    .mdc-top-app-bar-fixed-adjust {
        position: fixed;
        bottom: 0;
        width: 100%;
        z-index: 99;
        display: flex;
        justify-content: space-evenly;
    }

    .mdc-top-app-bar-fixed-adjust .mdc-bottom-navigation__list {
        height: 100%;
        display: flex;
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .mdc-top-app-bar-fixed-adjust .mdc-bottom-navigation__list .mdc-bottom-navigation__list-item {
        display: flex;
        flex-direction: column;
        text-align: center;
    }
</style>
<!-- taxes page -->
<script src="<?php echo $url; ?>dashboard/js/custom.js"></script>
</body>

</html>