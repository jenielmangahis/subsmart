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
    src="<?php echo $url->assets ?>plugins/jquery-initialize/jquery.initialize.min.js">
</script>
<script src="<?php echo $url->assets ?>dashboard/js/bootstrap.bundle.min.js">
</script>
<script src="<?php echo $url->assets ?>dashboard/js/jquery.slimscroll.js">
</script>
<script src="<?php echo $url->assets ?>dashboard/js/waves.min.js"></script>
<!--Chartist Chart-->
<!-- <script src="../plugins/chartist/js/chartist.min.js"></script>
<script src="../plugins/chartist/js/chartist-plugin-tooltip.min.js"></script>
<script src="../plugins/peity-chart/jquery.peity.min.js"></script> -->
<!-- App js<script src="<?php echo $url->assets ?>dashboard/pages/dashboard.js">
</script> -->
<!--Morris js Chart-->
<script src="<?php echo $url->assets ?>plugins/morris.js/morris.min.js">
</script>


<script src="<?php echo $url->assets ?>dashboard/js/app.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> -->

<script
    src="<?php echo $url->assets ?>plugins/datatables.net/export/dataTables.buttons.min.js">
</script>
<script
    src="<?php echo $url->assets ?>plugins/datatables.net/export/buttons.bootstrap.min.js">
</script>
<script
    src="<?php echo $url->assets ?>plugins/datatables.net/export/jszip.min.js">
</script>
<script
    src="<?php echo $url->assets ?>plugins/datatables.net/export/pdfmake.min.js">
</script>
<script
    src="<?php echo $url->assets ?>plugins/datatables.net/export/vfs_fonts.js">
</script>
<script
    src="<?php echo $url->assets ?>plugins/datatables.net/export/buttons.html5.min.js">
</script>
<!-- Validate  -->
<script src="<?php echo $url->assets ?>plugins/switchery/switchery.min.js">
</script>
<script src="<?php echo $url->assets ?>plugins/jquery.validate.min.js"></script>
<script
    src="<?php echo $url->assets ?>plugins/select2/dist/js/select2.full.min.js">
</script>
<script
    src="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script
    src="<?php echo $url->assets ?>plugins/bootstrap-treeview/bootstrap-treeview.js">
</script>
<!-- Include calender js files -->
<!-- <script src="<?php //echo base_url()?>calender/assets/js/calendar.js">
</script> -->
<!-- dynamic assets goes  -->
<script type="text/javascript">
    window.base_url = <?php echo json_encode(base_url()); ?> ;
    var nav_badges = '';
    <?php
        if (isset($module)) {
            if ($module == 'calendar') {
                echo "nav_badges = 'calendar';";
            }
        }

    ?>
</script>
<script src="<?php echo $url->assets;?>js/timesheet/clock.js"></script>
<script src="<?php echo $url->assets;?>js/icons/icon.navbar.js"></script>
<script src="<?php echo $url->assets;?>plugins/sweetalert/sweetalert2@10.js">
</script>

<script>
    jQuery(document).ready(function() {
        $('#items_table_estimate_sales').DataTable();
    });
</script>

<script>
    jQuery(document).ready(function() {
        $('#items_table_newWorkorder').DataTable();
    });
</script>

<script>
    jQuery(document).ready(function() {
        $('#items_table_package').DataTable();
    });
</script>

<script>
    jQuery(document).ready(function() {
        $('#myTable').DataTable();
    });
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
    src="<?php echo $url->assets ?>signature_pad-master/js/signature_pad.js">
</script>
<script src="<?php echo $url->assets ?>js/jquery.signaturepad.js"></script>
<!-- <script src="<?php echo $url->assets ?>js/sign_new.js"></script>
<script src="<?php echo $url->assets ?>js/sign2.js"></script> -->
<script src="<?php echo $url->assets ?>js/sidebar_badges.js"></script>
<script src="<?php echo $url->assets ?>js/custom.js"></script>
<script src="<?php echo $url->assets ?>js/work_order_pdf.js"></script>
<script type="text/javascript"
    src="<?php echo $url->assets?>ckeditor/ckeditor.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery('#smoothed').signaturePad({
            drawOnly: true,
            drawBezierCurves: true,
            lineTop: 200
        });
        jQuery("#CustomerSign").on("click touchstart", function() {
            var canvas = document.getElementById("CustomerSign");
            var dataURL = canvas.toDataURL("image/png");
            jQuery("#saveSignatureDB").val(dataURL);
        });


    });
</script>
<script>
    CKEDITOR.replace('editor1');
</script>
<script>
    CKEDITOR.replace('editor2');
</script>
<script>
    CKEDITOR.replace('editor3');
</script>
<script>
    CKEDITOR.replace('updateheader');
</script>


<script>
    // $(document).ready(function() {

    // 	 $('#start_date_').datepicker({
    // 		 dateFormat: 'mm/dd/yy',
    // 		 minDate: 0,

    // 	 });
    // 	 $("#end_date_").datepicker({
    // 		 dateFormat: 'mm/dd/yy',
    // 		 minDate:  7,

    // 	 });

    // 	 var _dt = new Date();
    // 	 var _dt = _dt.setDate(_dt.getDate());       
    // 	 $("#start_date_").datepicker("setDate","mm/dd/yy", _dt);
    // 	 $("#end_date_").datepicker("setDate", "mm/dd/yy", _dt);		


    //  });
    $(document).ready(function() {
        var now = new Date();

        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);

        var today = now.getFullYear() + "-" + (month) + "-" + (day);


        $('#start_date_').val(today);

    });

    $(document).ready(function() {
        var now = new Date();

        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);

        var today = now.getFullYear() + "-" + (month) + "-" + (day);


        $('#estimate_date_').val(today);

    });


    ;
    (function($, window, document, undefined) {
        $("#start_date_").on("change", function() {
            var date = new Date($("#start_date_").val()),
                days = 7;

            if (!isNaN(date.getTime())) {
                date.setDate(date.getDate() + days);

                $("#end_date_").val(date.toInputFormat());
            } else {
                alert("Invalid Date");
            }
        });

        Date.prototype.toInputFormat = function() {
            var yyyy = this.getFullYear().toString();
            var mm = (this.getMonth() + 1).toString(); // getMonth() is zero-based
            var dd = this.getDate().toString();
            return yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]); // padding
        };
    })(jQuery, this, document);
</script>

<script>
    ;
    (function($, window, document, undefined) {
        $("#estimate_date_").on("change", function() {
            var date = new Date($("#estimate_date_").val()),
                days = 7;

            if (!isNaN(date.getTime())) {
                date.setDate(date.getDate() + days);

                $("#expiry_date_").val(date.toInputFormat());
            } else {
                alert("Invalid Date");
            }
        });

        Date.prototype.toInputFormat = function() {
            var yyyy = this.getFullYear().toString();
            var mm = (this.getMonth() + 1).toString(); // getMonth() is zero-based
            var dd = this.getDate().toString();
            return yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]); // padding
        };
    })(jQuery, this, document);
</script>

<script>
    $(document).ready(function() {
        //     var now = new Date();

        //     var day = ("0" + now.getDate()).slice(-2);
        //     var month = ("0" + (now.getMonth() + 1)).slice(-2);

        //     var today = now.getFullYear()+"-"+(month)+"-"+(day) ;


        //    $('#end_date_').val(today);


        // var days = 7;
        //   var date = new Date(document.getElementById("start_date_").value);
        //   date.setDate(date.getDate() + parseInt(days));
        //   document.getElementById("end_date_").valueAsDate = date;
    });
</script>
<script>
    $(document).ready(function() {
        // var days = 7;
        //   var date = new Date(document.getElementById("estimate_date_").value);
        //   date.setDate(date.getDate() + parseInt(days));
        //   document.getElementById("expiry_date_").valueAsDate = date;
    });
</script>

<script>
    ;
    (function($, window, document, undefined) {
        $("#estimate_date_").on("change", function() {
            var date = new Date($("#estimate_date_").val()),
                days = 7;

            if (!isNaN(date.getTime())) {
                date.setDate(date.getDate() + days);

                $("#expiry_date_").val(date.toInputFormat());
            } else {
                alert("Invalid Date");
            }
        });

        Date.prototype.toInputFormat = function() {
            var yyyy = this.getFullYear().toString();
            var mm = (this.getMonth() + 1).toString(); // getMonth() is zero-based
            var dd = this.getDate().toString();
            return yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]); // padding
        };
    })(jQuery, this, document);
</script>

<script>
    $(document).ready(function() {
        //     var now = new Date();

        //     var day = ("0" + now.getDate()).slice(-2);
        //     var month = ("0" + (now.getMonth() + 1)).slice(-2);

        //     var today = now.getFullYear()+"-"+(month)+"-"+(day) ;


        //    $('#end_date_').val(today);


        var days = 7;
        var date = new Date(document.getElementById("start_date_").value);
        date.setDate(date.getDate() + parseInt(days));
        document.getElementById("end_date_").valueAsDate = date;
    });
</script>
<script>
    $(document).ready(function() {
        var days = 7;
        var date = new Date(document.getElementById("estimate_date_").value);
        date.setDate(date.getDate() + parseInt(days));
        document.getElementById("expiry_date_").valueAsDate = date;
    });
</script>
<script type="text/javascript">
    window.base_url = <?php echo json_encode(base_url()); ?> ;
</script>

<script>
    jQuery(document).ready(function() {
        $('#reportstable').DataTable();
        $('#items_table_estimate').DataTable();
        $('#items_table_estimate_option2').DataTable();
        var elements = document.getElementsByName("amount[]");
        var element_array = Array.prototype.slice.call(elements);

        for (var i = 0; i < element_array.length; i++) {
            element_array[i].addEventListener("keyup", sum_values);
        }

        function sum_values() {
            var sum = 0;
            for (var i = 0; i < element_array.length; i++) {
                sum += parseFloat(element_array[i].value, 10);
            }
            document.getElementsByName("total_amount")[0].value = 100;
        }
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
<script src="<?php echo $url->assets ?>dashboard/js/custom.js"></script>

<!-- global script that can be use all over the site pages -->
<script>
    function notifyUser(title,text,icon,location=null){
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: false,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value) {
                if(location === "reload"){
                    window.location.reload(true);
                }else if(location !== null && location !== ""){
                    window.location.href='<?= base_url(); ?>'+location;
                }
            }
        });
    }
</script>
<!-- taxes page -->
</body>

</html>