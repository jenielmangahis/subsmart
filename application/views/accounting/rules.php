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
                                <th><input type="checkbox"></th>
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
                            <?php foreach ($rules as $rule): ?>
                            <tr>
                                <td><input type="checkbox" value="<?php echo $rule->id;?>"></td>
                                <td><?php echo $rule->rules_name;?></td>
                                <td>Test</td>
                                <td>Test</td>
                                <td></td>
                                <td><?php echo ($rule->auto==1)?"Auto":" ";?></td>
                                <td></td>
                                <td><a href="#">Test</a></td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                <?php


                ?>
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
                    <form action="<?php echo site_url()?>accounting/addRules" method="post">
                    <div class="modal-body">
                        <div class="subheader">Rules only apply to unreviewed transactions.</div>
                            <div class="form-group">
                                <label for="">What do you want to call this rule? *</label>
                                <input type="text" name="rules_name" class="form-control" placeholder="Name this rule">
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="">Apply this to transactions that are</label>
                                </div>
                                <div class="tab-select">
                                    <select name="apply" id="" class="form-control">
                                        <option value="in" selected>Money in</option>
                                        <option value="out">Money out</option>
                                    </select>
                                </div>
                                <span style="margin-right: 5px;margin-left: 5px;">in</span>
                                <div class="tab-select">
                                    <div class="selectBox" onclick="showCheckboxes()">
                                        <select name="banks" id="" class="form-control">
                                            <option value="1">All bank accounts</option>
                                            <option value="0">No bank account selected</option>
                                        </select>
                                        <div class="overSelect"></div>
                                    </div>
                                    <div id="checkboxes">
                                        <label for="one">
                                            <input type="checkbox" id="one" checked /> First checkbox</label>
                                        <label for="two">
                                            <input type="checkbox" id="two" checked /> Second checkbox</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" style="position: relative;display: inline-block;">and include the following:</label>
                                <select name="include" id="" class="form-control inline-select">
                                    <option value="all" selected>All</option>
                                    <option value="any">Any</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="addCondition-container">
                                    <div id="addCondition">
                                        <div class="tab-select">
                                            <select name="description[]" id="" class="form-control">
                                                <option selected>Description</option>
                                                <option>Bank text</option>
                                                <option>Amount</option>
                                            </select>
                                        </div>
                                        <div class="tab-select">
                                            <select name="contain[]" id="" class="form-control" style="max-width: 140px">
                                                <option  selected>Contain</option>
                                                <option>Doesn't contain</option>
                                                <option>Is exactly</option>
                                            </select>
                                        </div>
                                        <div class="tab-select" style="max-width: 140px">
                                            <input type="text" name="comment[]" class="form-control" placeholder="Enter Text">
                                        </div>
                                        <div class="tab-select" id="deleteCondition" style="display: none;">
                                            <a href="#" id="btnDeleteCondition"><i class="fa fa-trash fa-lg"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div style="margin-top: 15px;">
                                    <a href="#" id="btnAddCondition"><i class="fa fa-plus"></i> Add a condition</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Then assign</label>
                                <div class="action-section">
                                    <span class="action-label">Transaction type</span>
                                    <select name="trans_type" id="" class="form-control">
                                        <option selected>Expenses</option>
                                        <option>Transfer</option>
                                        <option>Check</option>
                                    </select>
                                </div>
                                <div class="action-section" >
                                    <div id="categoryDefault">
                                        <span class="action-label" style="margin-right: 70px">Category</span>
                                        <input type="text" name="category[]" id="mainCategory" class="text-dropdown" list="categoryListDP" placeholder="Select category">
                                        <datalist id="categoryListDP">
                                            <option>Advertising</option>
                                            <option>Bad Debts</option>
                                            <option>Bank Charges</option>
                                        </datalist>
                                        <span class="action-label" style="margin-left: 5px;"><a href="#" id="btnAddSplit" style="color: #0b62a4;">Add split</a></span>
                                    </div>
                                    <!--Add Split Div-->
                                    <div class="add-split-container">
                                        <div class="add-split-section">
                                            <div class="split-header" style="margin-bottom: 12px;font-weight: bold">
                                                Split detail #<span class="splitNum">1</span>
                                                <a href="#" id="deleteSplitLine" style="float: right;right: 0;position: absolute;"><i class="fa fa-trash fa-lg"></i></a>
                                            </div>
                                            <div class="split-content">
                                                <span class="split-category-text" >Percentage</span>
                                                <input type="text" name="percentage[]" class="form-control" style="width: 205px">
                                            </div>
                                            <div class="split-content">
                                                <span class="split-category-text">Category</span>
                                                <input type="text" name="category[]" class="text-dropdown" list="categoryListDP" style="width: 205px">
                                                    <datalist id="categoryListDP">
                                                        <option>Advertising</option>
                                                        <option>Bad Debts</option>
                                                        <option>Bank Charges</option>
                                                    </datalist>
                                            </div>
                                            <hr id="border-category">
                                        </div>
                                        <div class="add-split-section">
                                            <div class="split-header" style="margin-bottom: 12px;font-weight: bold">
                                                Split detail #<span class="splitNum">2</span>
                                                <a href="#" id="deleteSplitLine" style="float: right;right: 0;position: absolute;"><i class="fa fa-trash fa-lg"></i></a>
                                            </div>
                                            <div class="split-content">
                                                <span class="split-category-text" >Percentage</span>
                                                <input type="text" name="percentage[]" class="form-control" value="0" style="width: 205px">
                                            </div>
                                            <div class="split-content">
                                                <span class="split-category-text">Category</span>
                                                <input type="text" name="category[]" class="text-dropdown" list="categoryListDP" style="width: 205px">
                                                <datalist id="categoryListDP">
                                                    <option>Advertising</option>
                                                    <option>Bad Debts</option>
                                                    <option>Bank Charges</option>
                                                </datalist>
                                            </div>
                                            <hr id="border-category">
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-left: 10px;margin-bottom: 10px;">
                                    <a href="#" id="btnAddLine"  style="color: #0b97c4;display: none;">Add a line</a>
                                </div>
                                <div class="action-section">
                                    <span class="action-label">Payee</span>
                                    <input type="text" name="payee" class="text-dropdown" list="payeeListDP" placeholder="(Recommended)">
                                    <datalist id="payeeListDP">
                                        <option>Advertising</option>
                                        <option>Bad Debts</option>
                                        <option>Bank Charges</option>
                                    </datalist>
                                </div>
                                <div class="action-section" id="assignMore" style="display: none;">
                                    <span class="action-label">Add memo</span>
                                    <textarea name="memo" id="" cols="30" rows="5" placeholder="Enter Text" style="resize: none;"></textarea>
                                </div>
                                <div style="margin-top: 15px;">
                                    <a href="#" id="btnAssignMore"><i class="fa fa-plus"></i> Assign more</a>
                                </div>
                                <div style="margin-top: 15px;">
                                    <a href="#" style="display: none;" id="btnClear"><i class="fa fa-trash"></i> Clear</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Automatically confirm transactions this rule applies to</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="auto" class="custom-control-input" value="1" id="autoAddswitch">
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
    <?php if ($this->session->flashdata('rules_added')){?>
        <div class="alert alert-success alert-dismissible col-md-4" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('rules_added');?>
        </div>
    <?php }elseif ($this->session->flashdata('rules_failed')){?>
        <div class="alert alert-info alert-dismissible col-md-4" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('rules_failed');?>
        </div>
    <?php }?>
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

    //Add Condition
    $(document).ready(function () {
       $('#btnAddCondition').click(function (e) {
           $("#deleteCondition").show();
           $("#addCondition").clone().appendTo($('.addCondition-container'));
           e.preventDefault();
       });

        $(document).on("click","#btnDeleteCondition",function (e) {
            e.preventDefault();
            $("#addCondition").remove();
            var check_count = jQuery("div[id='addCondition']").length;
            if (check_count == 1){
                $("#deleteCondition").hide();
            }
        });

        //Assign More
        $('#btnAssignMore').click(function () {
           $('#assignMore').show();
           $(this).hide();
           $('#btnClear').show();
        });
        $('#btnClear').click(function () {
           $('#assignMore').hide();
           $(this).hide();
           $('#btnAssignMore').show();
        });
        // Add Split
        $('#btnAddSplit').click(function () {
           $('.add-split-container').show();
           $('#categoryDefault').hide();
           $('#btnAddLine').show();
           $('#mainCategory').removeAttr('name');
        });

        $(document).on("click","#btnAddLine",function (e) {
            e.preventDefault();
            $(".add-split-container").append($('.add-split-section').last().clone());
            var num = $('.add-split-section').length;
            $('.splitNum').last().html(num);
        });
        $(document).on("click","#deleteSplitLine",function () {
            var num = $('.add-split-section').length;
            if(num == 2){
                $('.add-split-container').hide();
                $('#categoryDefault').show();
                $('#btnAddLine').hide();
                $('#mainCategory').attr('name','category[]');
            }else{
                $(".add-split-section").last().remove();
            }
        });
    });
</script>
