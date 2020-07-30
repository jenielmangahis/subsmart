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
                        <div>
                            <a href="<?php echo site_url()?>accounting/rules" style="color: #0b97c4"><i class="fa fa-arrow-left"></i>&nbsp;Back to rules</a>
                        </div>
                        <div class="edit-rules-container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Rule name</label>
                                        <input type="text" class="form-control" placeholder="Name this rule">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Apply this to transactions that are</label>
                                        <select name="" id="" class="form-inline">
                                            <option>Money out</option>
                                            <option>Money in</option>
                                        </select>
                                        <span style="margin-right: 8px;">in</span>
                                        <select name="" id="" class="form-inline">
                                            <option>All bank accounts</option>
                                            <option>Corporate Account (XXX XXX 5850)</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <span>and include the following</span>
                                        <select name="" id="" class="form-inline">
                                            <option>Any</option>
                                            <option>All</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="addCondition-container">
                                            <?php foreach ($conditions as $condition): ?>
                                            <div id="addCondition">
                                                    <select name="description[]" id="conDescription" class="form-inline checkSelect">
                                                        <option selected><?php echo $condition->description; ?></option>
                                                        <option>Description</option>
                                                        <option>Bank text</option>
                                                        <option>Amount</option>
                                                    </select>
                                                    <select name="contain[]" id="" class="form-inline checkSelect">
                                                        <option selected><?php echo $condition->contain; ?></option>
                                                        <option>Contain</option>
                                                        <option>Doesn't contain</option>
                                                        <option>Is exactly</option>
                                                    </select>
                                                    <input type="text" name="comment[]" class="form-inline" value="<?php echo $condition->comment;?>" placeholder="Enter Text">
                                                <div class="tab-select" id="deleteCondition" style="display: none;">
                                                    <a href="#" id="btnDeleteCondition"><i class="fa fa-trash fa-lg"></i></a>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div style="margin-top: 15px;">
                                            <a href="#" id="btnAddCondition" style="color: #0b62a4;"><i class="fa fa-plus"></i> Add a condition</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Then assign</label>
                                        <div class="action-section">
                                            <span class="action-label">Transaction type</span>
                                            <select name="trans_type" id="" class="form-inline" style="min-width: 220px">
                                                <option selected>Expenses</option>
                                                <option>Transfer</option>
                                                <option>Check</option>
                                            </select>
                                        </div>
                                        <div class="action-section" >
                                            <div id="categoryDefault">
                                                <span class="action-label" style="margin-right: 70px">Category</span>
                                                <div style="width: 220px;display: inline-block;">
                                                    <select name="category[]" id="mainCategory" class="form-control select2-rules-category">
                                                        <option></option>
                                                        <option disabled>&plus; Add new</option>
                                                        <option>Advertising</option>
                                                        <option>Bad Debts</option>
                                                        <option>Bank Charges</option>
                                                    </select>
                                                </div>
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
                                                        <input type="text" name="percentage[]" value="<?php echo $categories[0]->percentage;?>" class="form-control" style="width: 205px">
                                                    </div>
                                                    <div class="split-content">
                                                        <span class="split-category-text">Category</span>
                                                        <div style="width: 220px;display: inline-block;">
                                                            <select name="category[]" id="" class="form-control select2-rules-category">
                                                                <option selected><?php echo $categories[0]->category;?></option>
                                                                <option disabled>&plus; Add new</option>
                                                                <option>Advertising</option>
                                                                <option>Bad Debts</option>
                                                                <option>Bank Charges</option>
                                                            </select>
                                                        </div>
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
                                                        <input type="text" name="percentage[]" class="form-control" value="<?php echo $categories[1]->percentage;?>" style="width: 205px">
                                                    </div>
                                                    <div class="split-content">
                                                        <span class="split-category-text">Category</span>
                                                        <div style="width: 220px;display: inline-block;">
                                                            <select name="category[]" id="" class="form-control select2-rules-category">
                                                                <option selected><?php echo $categories[1]->category;?></option>
                                                                <option></option>
                                                                <option>Advertising</option>
                                                                <option>Bad Debts</option>
                                                                <option>Bank Charges</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <hr id="border-category">
                                                </div>
                                                <?php if (sizeof($categories) > 2): ?>
                                                <?php for ($x = 2;$x < sizeof($categories);$x++){ ?>
                                                        <?php $index = 2;?>
                                                <div class="add-split-section">
                                                    <div class="split-header" style="margin-bottom: 12px;font-weight: bold">
                                                        Split detail #<span class="splitNum"><?php echo $index + 1;?></span>
                                                        <a href="#" id="deleteSplitLine" style="float: right;right: 0;position: absolute;"><i class="fa fa-trash fa-lg"></i></a>
                                                    </div>
                                                    <div class="split-content">
                                                        <span class="split-category-text" >Percentage</span>
                                                        <input type="text" name="percentage[]" class="form-control" value="<?php echo $categories[$index]->percentage;?>" style="width: 205px">
                                                    </div>
                                                    <div class="split-content">
                                                        <span class="split-category-text">Category</span>
                                                        <div style="width: 220px;display: inline-block;">
                                                            <select name="category[]" id="" class="form-control select2-rules-category">
                                                                <option><?php echo $categories[$index]->category;?></option>
                                                                <option>Advertising</option>
                                                                <option>Bad Debts</option>
                                                                <option>Bank Charges</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <hr id="border-category">
                                                </div>
                                                        <?php $index++;?>
                                                <?php } ?>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                        <div style="margin-left: 10px;margin-bottom: 10px;">
                                            <a href="#" id="btnAddLine"  style="color: #0b97c4;display: none;">Add a line</a>
                                        </div>
                                        <div class="action-section">
                                            <span class="action-label">Payee</span>
                                            <div style="width: 220px;display: inline-block;">
                                                <select name="payee" id="" class="form-control select2-rules-payee">
                                                    <option></option>
                                                    <option>Abacus Accounting</option>
                                                    <option>Absolute Power</option>
                                                    <option>ADSC</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="action-section" id="assignMore" style="display: none;">
                                            <span class="action-label">Add memo</span>
                                            <textarea name="memo" id="" cols="30" rows="5" placeholder="Enter Text" style="resize: none;"></textarea>
                                        </div>
                                        <div style="margin-top: 15px;">
                                            <a href="#" id="btnAssignMore" style="color: #0b62a4;"><i class="fa fa-plus"></i> Assign more</a>
                                        </div>
                                        <div style="margin-top: 15px;">
                                            <a href="#" style="display: none;color: #0b62a4;" id="btnClear"><i class="fa fa-trash"></i> Clear</a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Automatically confirm transactions this rule applies to</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="auto" class="custom-control-input" value="1" id="autoAddswitch" checked>
                                            <label class="custom-control-label" for="autoAddswitch">Auto-add</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row"></div>
        <!-- end row -->
    </div>
    <!-- end container-fluid -->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    //check and remove if the select option has a redundant item
    var usedNames = {};
    $(".checkSelect > option").each(function () {
        if (usedNames[this.value]) {
            $(this).remove();
        } else {
            usedNames[this.value] = this.text;
        }
    });
</script>
