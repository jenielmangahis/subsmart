<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row" style="padding-bottom: 20px;">
                    <div class="col-md-12 banking-tab-container">
                        <a href="<?php echo url('/accounting/link_bank')?>" class="banking-tab" style="text-decoration: none">Banking</a>
                        <a href="<?php echo url('/accounting/rules')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="rules")?:'-active';?>">Rules</a>
                        <a href="<?php echo url('/accounting/receipts')?>" class="banking-tab">Receipts</a>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6"><h2>Rules</h2></div>
                            <div class="col-md-6" style="text-align: right">
                                <a href="" style="font-size: 14px;line-height: 40px;">Learn more about bank rules.</a>
                                <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createRules"  style="border-radius: 36px 0 0 36px">New rule</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#" class="dropdown-item disabled">Export rules</a></li>
                                        <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#importRules">Import rules</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
<!--                        DataTables-->
                        <table id="rules_table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Priority</th>
                                <th>Rule Name</th>
                                <th>Conditions</th>
                                <th>Settings</th>
                                <th>Auto-ad</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Test</td>
                                <td>Test</td>
                                <td>Test</td>
                                <td></td>
                                <td>Test</td>
                                <td></td>
                                <td><a href="">Test</a></td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row"></div>
            <!-- end row -->
    </div>
        <!-- end container-fluid -->
<!--    Modal for creating rules-->
    <div class="modal-right-side">
        <div class="modal right fade" id="createRules" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myModalLabel2" >Create rules</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="">
                    <div class="modal-body">
                        <div class="subheader">Rules only apply to unreviewed transactions.</div>
                            <div class="form-group">
                                <label for="">What do you want to call this rule? *</label>
                                <input type="text" class="form-control" placeholder="Name this rule">
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="">Apply this to transactions that are</label>
                                </div>
                                <div class="tab-select">
                                    <select name="" id="" class="form-control">
                                        <option value="" selected>Money in</option>
                                        <option value="">Money out</option>
                                    </select>
                                </div>
                                <span style="margin-right: 5px;margin-left: 5px;">in</span>
                                <div class="tab-select">
                                    <div class="selectBox" onclick="showCheckboxes()">
                                        <select name="" id="" class="form-control">
                                            <option value="">No bank account selected</option>
                                        </select>
                                        <div class="overSelect"></div>
                                    </div>
                                    <div id="checkboxes">
                                        <label for="one">
                                            <input type="checkbox" id="one" /> First checkbox</label>
                                        <label for="two">
                                            <input type="checkbox" id="two" /> Second checkbox</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" style="position: relative;display: inline-block;">and include the following:</label>
                                <select name="" id="" class="form-control inline-select">
                                    <option value="" selected>All</option>
                                    <option value="">Any</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div id="addCondition">
                                    <div class="tab-select">
                                        <select name="" id="" class="form-control">
                                            <option value="" selected>Description</option>
                                            <option value="">Bank test</option>
                                            <option value="">Amount</option>
                                        </select>
                                    </div>
                                    <div class="tab-select">
                                        <select name="" id="" class="form-control" style="max-width: 140px">
                                            <option value="" selected>Contain</option>
                                            <option value="">Doesn't contain</option>
                                            <option value="">Is exactly</option>
                                        </select>
                                    </div>
                                    <div class="tab-select" style="max-width: 140px">
                                        <input type="text" class="form-control" placeholder="Enter Text">
                                    </div>
                                </div>
                                <div style="margin-top: 15px;">
                                    <a href="#" ><i class="fa fa-plus"></i> Add a condition</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Then assign</label>
                                <div class="action-section">
                                    <span class="action-label">Transaction type</span>
                                    <select name="" id="" class="form-control">
                                        <option value="" selected>Expenses</option>
                                        <option value="">Transfer</option>
                                        <option value="">Check</option>
                                    </select>
                                </div>
                                <div class="action-section">
                                    <span class="action-label">Category</span>
                                    <input type="text" class="form-control" placeholder="Select category">
                                    <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                        <button class="btn btn-default dp-btn" type="button" data-toggle="dropdown" style="margin-left: -10px;">
                                            <span class="fa fa-caret-down"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right dp-menu-container">
                                            <li><a href="#">File Upload</a></li>
                                            <li><a href="#">Order Checks</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="action-section">
                                    <span class="action-label">Payee</span>
                                    <input type="text" class="form-control" placeholder="(Recommended)">
                                    <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                        <button class="btn btn-default dp-btn" type="button" data-toggle="dropdown" style="margin-left: -10px;">
                                            <span class="fa fa-caret-down"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right dp-menu-container">
                                            <li>
                                                <a href="#">Advertising</a>
                                            </li>
                                            <li><a href="#">Bad Debts</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div style="margin-top: 15px;">
                                    <a href="#" ><i class="fa fa-plus"></i> Assign more</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Automatically confirm transactions this rule applies to</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="autoAddswitch">
                                    <label class="custom-control-label" for="autoAddswitch">Auto-add</label>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default">Cancel</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!--    end of modal-->
    <div class="full-screen-modal">
        <!--Modal for file upload-->
        <div id="importRules" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Import rules</h4>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="progressSection">

                        </div>
                        <div class="uploadList">
                            <div class="step-title">Upload list of rules</div>
                            <div class="sub-title">Please select the rules list you exported from your other company.</div>
                            <div class="instruction">Select the file to upload</div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">No file selected</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer-importRules">
                        <button class="btn btn-default" style="float: left;">Cancel</button>
                        <button class="btn btn-success" style="float: right;">Next</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
<!--    end of modal-->
	<?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
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
        });
    } );
</script>
