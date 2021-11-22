<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid" style="padding:3%;">

            <h3>Gross annual Salary calculation</h3>
            <a href="<?php echo url('/accounting/reports') ?>" style="color: blue;"> << Back to Reports</a>

            <div class="row" style="padding:3%;">
                <div class="col-md-12">

                    <span><h6>Employee Name: John Doe</h6><span>
                    <span><h6>Role: Web Developer</h6><span>
                    <span><h6>Start Date: 03/06/18</h6><span>
                    <span><h6>Location: New York, NY, USA</h6><span>
                    <br><br>
                        <!-- <div class="col-md-1">

                        </div>
                        <div class="col-md-1">

                        </div>
                        <div class="col-md-1">

                        </div> -->
                    <!-- </div> -->

                    <table class="table">
                        <thead style="background-color:#EEEEEE;font-weight:bold;">
                            <th><b>ROLE</b></th>
                            <th><b>AMOUNT</b></th>
                            <th><b>EXPERIENCE</b></th>
                            <th><b>COEFF.</b></th>
                            <th><b>SENIORITY</b></th>
                            <th><b>AMOUNT</b></th>
                            <th><b>GROSS SALARY</b></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control">
                                        <option>Web Developer</option>
                                        <option>Accountant</option>
                                        <option>Marketing</option>
                                        <option>Product</option>
                                        <option>HR</option>
                                        <option>Support</option>
                                        <option>QA Tester</option>
                                    </select>
                                </td>
                                <td><span>$30,000.00</span></td>
                                <td>
                                    <select class="form-control">
                                        <option>Tier A</option>
                                        <option>Tier B</option>
                                        <option>Tier C</option>
                                        <option>Tier D</option>
                                        <option>Tier E</option>
                                        <option>Tier F</option>
                                    </select>
                                </td>
                                <td style="width:180px;">
                                    <input type="text"  class="form-control" value="X 1,00" readonly>
                                    <!-- <select class="form-control" readonly>
                                        <option>X 1,00</option>
                                        <option>X 1,10</option>
                                        <option>X 1,20</option>
                                        <option>X 1,30</option>
                                        <option>X 1,40</option>
                                        <option>X 1,50</option>
                                    </select> -->
                                </td>
                                <td>
                                    <select class="form-control">
                                        <option>Tier A</option>
                                        <option>Tier B</option>
                                        <option>Tier C</option>
                                        <option>Tier D</option>
                                        <option>Tier E</option>
                                        <option>Tier F</option>
                                    </select>
                                </td>
                                <td style="width:180px;"><input type="text"  class="form-control" value="1,000" readonly></td>
                                <td><span>$31,000.00</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <br>
                    <div style="float:right;">
                        <a href="#" class="btn btn-danger">Save Changes</a>
                    </div>

                </div>
            </div>

        </div>
            <!-- end row -->
    </div>
        <!-- end container-fluid -->

	<?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    //dropdown checkbox
    var expanded = false;
    function showCheckboxes() {
        var checkboxes = document.getElementById("checkboxes");
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
    }
    //DataTables JS
    $(document).ready(function() {
        $('#rules_table').DataTable({
            "paging":false,
            "language": {
                "emptyTable": "<h5>Use rules to save time</h5> <span>Make rules for your frequently occurring transactions and tell nSmartrac exactly what should happen when conditions are met. <a href='#' data-toggle=\"modal\" data-target=\"#createRules\" style='color: #0b97c4'>Create a rule</a></span>"
            }
        });
    } );
</script>
