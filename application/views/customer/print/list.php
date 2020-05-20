<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Home</title>
    <meta content="Admin Dashboard" name="description">
    <meta content="Themesbrand" name="author">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Chartist Chart CSS -->
     
    <link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">     
    <link href="<?php echo $url->assets ?>dashboard/css/style.css" rel="stylesheet" type="text/css">
     <!-- DataTables --> 
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/switchery/switchery.min.css">
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/select2/dist/css/select2.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  
    
</head>

<body>
    <!-- Navigation Bar-->
    <div class="doc-print">
        <div class="btn-print__cnt"><a class="btn-print" onclick="window.print();" href="#">Print</a></div>
        <div><h6 class="print-schedule-title">
            Customers
        </h6></div>
        <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">

                        <?php if (!empty($customers)) { ?>
                            <table class="table table-hover table-to-list" data-id="work_orders">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                                </thead>

                                <tbody>

                                <?php foreach ($customers as $customer) { ?>
                                    <tr>
                                        <td><?php echo $customer->contact_name; ?></td>
                                        <td><?php echo $customer->contact_email; ?></td>
                                        <td>
                                            <?php if (is_serialized($customer->phone)) { ?>
                                                <?php echo unserialize($customer->phone)['number'] ?>
                                                (<?php echo unserialize($customer->phone)['type'] ?>)
                                            <?php } else { ?>
                                                <?php echo $customer->phone; ?>
                                            <?php } ?>  
                                        </td>
                                        
                                    </tr>
                                <?php } ?>

                                </tbody>

                            </table>
                        <?php } ?>
                    </div>
                </div>
    </div>
   
</body>
<!-- jQuery  -->
<script src="<?php echo $url->assets ?>dashboard/js/jquery.min.js"></script>
<script src="<?php echo $url->assets ?>js/custom.js"></script>
<script src="<?php echo $url->assets ?>dashboard/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $url->assets ?>dashboard/js/jquery.slimscroll.js"></script>
<script src="<?php echo $url->assets ?>dashboard/js/waves.min.js"></script>
<!--Chartist Chart-->
<!-- <script src="../plugins/chartist/js/chartist.min.js"></script>
<script src="../plugins/chartist/js/chartist-plugin-tooltip.min.js"></script>
<script src="../plugins/peity-chart/jquery.peity.min.js"></script> -->
<!-- App js<script src="<?php echo $url->assets ?>dashboard/pages/dashboard.js"></script> -->
<script src="<?php echo $url->assets ?>dashboard/js/app.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script src="<?php echo $url->assets ?>plugins/datatables.net/export/dataTables.buttons.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/datatables.net/export/buttons.bootstrap.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/datatables.net/export/jszip.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/datatables.net/export/pdfmake.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/datatables.net/export/vfs_fonts.js"></script>
<script src="<?php echo $url->assets ?>plugins/datatables.net/export/buttons.html5.min.js"></script>
<!-- Validate  -->
<script src="<?php echo $url->assets ?>plugins/switchery/switchery.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/jquery.validate.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<!-- Include calender js files -->
<!-- <script src="<?php echo base_url() ?>calender/assets/js/calendar.js"></script> -->


<script type="text/javascript">
    window.base_url = <?php echo json_encode(base_url()); ?>;
</script>

<!-- dynamic assets goes  -->
<?php echo put_footer_assets(); ?>

<style>
 
    .doc-print {
        margin-left: 3em;
        margin-right: 3em;
    }
    .btn-print__cnt {
    text-align: right;
    padding-top: 5px;
    padding-right: 10px;
}
.doc-print {
    margin-left: 1em;
    margin-right: 1em;
}
.btn-print__cnt {
    text-align: right; 
    padding-top: 5px;
    padding-right: 10px;      
}
@media print {
    .btn-print__cnt {
        display: none;
    }
}
.print-schedule-title {
    text-align: center;
    padding-top: 30px;
}
.print-schedule-title {
        display: block;
    }
@media print {
    .print-schedule-title {
        display: block;
    }
}
#myTabContent { margin-top: 42px; }
.fc-content { text-align: left; padding: 3px; }
</style>
</html>