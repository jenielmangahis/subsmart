<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style type="text/css">
.loader
{
    display: none !important;
}
.upload-btn-wrapper,.ubw
{
    height: 150px !important;
}
.Checkhide,.Recurrhide
{
    display: none;
}
</style>
    <!-- Add Check -->
    <div id="overlay-check-tx" class=""></div>
    <div id="side-menu-check-tx" class="main-side-nav">
        <div style="background-color: #f4f5f8">
            <div class="side-title">
                <h4 id="memo_sc_nm"></h4>
                <a href="<?php echo url('/accounting/banking')?>" id="close-menu-check-tx" class="menuCloseButton" ><span id="side-menu-close-text">
                <i class="fa fa-times"></i></span></a>
            </div>
            <div style="margin-left: 20px;">
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-3">
                        <select name="check_payee_popup" id="check_payee_popup" class="form-control fa">
                            <option value="" disabled="" selected>Payee</option>
                            <?php
                            foreach($this->AccountingVendors_model->select() as $ro)
                            {
                            ?>
                            <option value="<?=$ro->id?>"><?php echo $ro->f_name." ".$ro->l_name?></option>
                            <?php
                            }
                            ?>
                            <option value="fa fa-plus">&#xf067; Add new</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control fa" name="check_account_popup" id="check_account_popup">
                            <?php
                               $i=1;
                               foreach($this->chart_of_accounts_model->select() as $row)
                               {
                                ?>
                                <option <?php if($this->reconcile_model->checkexist($row->id) != $row->id): echo "disabled"; ?>
                                <?php endif ?> value="<?=$row->id?>"><?=$row->name?></option>
                              <?php
                              $i++;
                              }
                               ?>
                               <option value="fa fa-plus">&#xf067; Add new</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <h6>Balance: $0.00</h6>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <h6 id="checkamount">Amount:$0.00</h6>
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-2">
                        <label>Mailing Address:</label>
                        <textarea name="check_mailing_add" id="check_mailing_add" rows="4"></textarea>
                    </div>
                    <div class="col-md-2">
                        <label>Payment date:</label>
                        <div class="col-xs-10 date_picker">
                            <input type="text" name="check_date_popup" id="check_date_popup" class="form-control" value=""/>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2">
                        <label>Check no.</label>
                        <input type="text" name="check_checkno" id="check_checkno" value="" class="form-control"/>
                        </br>
                        </br> 
                        <input type="checkbox" name="check_print_check" class="form-control">Print Later
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <label>Permit no.</label>
                        <input type="text" name="check_permitno" value="" class="form-control" />
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-left: 20px">
            <section class="table-wrapper">
                <div class="container">
                    <table class="table" id="participantCheckTable">
                        <thead>
                            <tr>
                               <th></th>
                               <th>#</th>
                               <th>Category</th>
                               <th>Description</th>
                               <th>Amount</th>
                               <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr onclick="trClickCheckMain()" style="display: none;">
                                <td><i class="fa fa-th"></i></td>
                                <td>1</td>
                                <td>
                                    <select name='check_expense_account' id='check_expense_account' class='' style="display: none;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="check_expense_account"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="check_descp" name="check_descp" value="" placeholder="What did you paid for?">
                                    <div class="check_descp"></div>
                                </td>
                                <td>
                                     <input type="hidden" id="check_service_charge" name="check_service_charge" value="">
                                    <div class="check_service_charge"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_check"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <tr onclick="trClickCheck(2)">
                                <td><i class="fa fa-th"></i></td>
                                <td>1</td>
                                <td>
                                    <select name='check_expense_account_2' id='check_expense_account_2' class='' style="display: none;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="check_expense_account_2"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="check_descp_2" name="check_descp_2" value="" placeholder="What did you paid for?">
                                    <div class="check_descp_2"></div>
                                </td>
                                <td>
                                     <input type="hidden" id="check_service_charge_2" name="check_service_charge_2" value="">
                                    <div class="check_service_charge_2"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_check"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <tr class="pr participantCheckRow Checkhide">
                                <td><i class="fa fa-th"></i></td>
                                <td>0</td>
                                <td>
                                    <select name='check_expense_account_' id='check_expense_account_' class='' style="display: none;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="check_expense_account_"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="check_descp_" name="check_descp_" value="" placeholder="What did you paid for?">
                                    <div class="check_descp_"></div>
                                </td>
                                <td>
                                     <input type="hidden" id="check_service_charge_" name="check_service_charge_" value="">
                                    <div class="check_service_charge_"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_check"><i class="fa fa-trash"></i></a></td>
                            </tr>

                        </tbody>
                    </table>

                    <div class="btn-group">
                        <a href="javascript:void(0);" class="btn-add-bx add_check">Add Lines</a>
                        <a href="javascript:void(0);" class="btn-add-bx clear_check">Clear All Lines</a>
                    </div>
                    <div class="btn-group hidemecheck" style="display: none;">
                        <a href="javascript:void(0);" class="btn-add-bx"  onclick="rightclickCheck()">Save<i class="fa fa-check"></i></a>
                        <a href="javascript:void(0);" class="btn-add-bx"  onclick="crossClickCheck()">Cancel<i class="fa fa-close"></i>
                    </div>
                </div>
            </section>

            <div class="row" style="margin-bottom:20px">
                <div class="col-md-4">
                    <label>Memo</label>
                    </br>
                    <textarea name="check_memo_sc" id="check_memo_sc" rows="4"></textarea>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-2">
                    <h6 id="checktotal">Total : $0.00</h6>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-4">
                    <label><i class="fa fa-paperclip"></i>Attachment</label>
                    </br>
                    <iframe name="hiddenFramecheck" width="0" height="0" border="0" style="display: none;"></iframe>
                    <form action="<?php echo url('accounting/check/do_upload') ?>" class="uploadmy" method="post" name="checkForm" enctype="multipart/form-data" target="hiddenFramecheck">
                    <div class="file-upload-block">
                        <div class="upload-btn-wrapper">
                            <button class="btn ubw">
                                <i class="fa fa-cloud-upload"></i>
                                <h6>Drag and drop files here or <span>browse to upload</span></h6>
                            </button>
                            <input type="file" name="userfile_check" />
                            <input type="hidden" name="subfix" value="check">
                        </div>
                    </div>
                    </br>
                    <button type="submit" class="form-control">Upload</button>
                    </form>
                    </br>
                    <a href="#" onclick="showData()">Show existing</a>
                </div>
            </div>
        </div>
     
        <div class="save-act" style="position: unset !important;">
            <button type="button" class="btn-cmn" onclick="closeCheck()">Cancel</button>
            <a href="#" style="margin-left: 30%" onclick="openPrintNav()">Print check</a>
            <a href="#" style="margin-left: 10%" onclick="openRecurr()">Make recurring</a>
            <button type="button" class="savebtn" onclick="save_check()" >Save and close</button>
        </div>
    </div>
    <!-- End Add Check -->

    <!-- Make recurring -->
    <div id="overlay-recurr-tx" class=""></div>
    <div id="side-menu-recurr-tx" class="main-side-nav">
        <div style="background-color: #f4f5f8">
            <div class="side-title">
                <a id="close-menu-recurr-tx" class="menuCloseButton" onclick="closeRecurr()"><span id="side-menu-close-text">
                <i class="fa fa-times"></i></span></a>
            </div>
            <div style="margin-left: 20px;">
                <div class="row" style="margin-bottom:20px">
                    <h2>Recurring Check</h2>
                </div>
            </div>
            <div style="margin-left: 20px;">
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-2">
                        <label>Template name</label>
                        <input type="text" name="template_name" id="template_name" class="form-control" required="required">
                    </div>
                    <div class="col-md-2">
                        <label>Type</label>
                        <select name="type_scheduled" id="type_scheduled" class="form-control">
                            <option value="scheduled">Scheduled</option>
                            <option value="reminder">Reminder</option>
                            <option value="unscheduled">Unscheduled</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div id="sched_">Create<input type="number" name="create_days" id="create_days" class="form-control">days in advance</div>
                        <div id="remine_" style="display: none;">Remind<input type="number" name="remine_days" id="remine_days" class="form-control">days before the transaction date</div>
                        <div id="unsched_" style="display: none;">Unscheduled transactions don’t have timetables; you use them as needed from the Recurring Transactions list.</div>
                    </div>
                </div>
            </div>
            <div style="margin-left: 20px;" id="sched_section">
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-1">
                        <label>Interval</label>
                        <select name="interval" id="interval" class="form-control" style="width: 120% !important;">
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly" selected>Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>
                    <div class="col-md-6" style="display: flex;">
                        <div id="daily" style="display: none;">every<input type="number" name="daily_days" id="daily_days" class="form-control" style="width: 15% !important;display: inline;">day(s)</div>
                        <div id="weekly" style="display: none;">
                            every<input type="number" name="daily_weeks" id="daily_weeks" class="form-control" style="width: 10% !important;display: inline;">week(s) on
                            <select name="weekly_option" id="weekly_option" class="form-control" style="width: 30% !important;">
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="saturday">Saturday</option>
                                <option value="sunday">Sunday</option>
                            </select>
                        </div>
                        <div id="monthly">
                            on
                            <select name="monthlymain_option" id="monthlymain_option" class="form-control" style="width: 15% !important;">
                                <option value="day">day</option>
                                <option value="first">first</option>
                                <option value="second">second</option>
                                <option value="third">third</option>
                                <option value="fourth">fourth</option>
                                <option value="last">last</option>
                            </select>
                            <select name="monthlyday_option" id="monthlyday_option" class="form-control" style="width: 12% !important;">
                                <option value="1st">1st</option>
                                <option value="2nd">2nd</option>
                                <option value="3rd">3rd</option>
                                <option value="4th">4th</option>
                                <option value="5th">5th</option>
                                <option value="6th">6th</option>
                                <option value="7th">7th</option>
                                <option value="8th">8th</option>
                                <option value="9th">9th</option>
                                <option value="10th">10th</option>
                                <option value="11th">11th</option>
                                <option value="12th">12th</option>
                                <option value="13th">13th</option>
                                <option value="14th">14th</option>
                                <option value="15th">15th</option>
                                <option value="16th">16th</option>
                                <option value="17th">17th</op1tion>
                                <option value="18th">18th</option>
                                <option value="19th">19th</option>
                                <option value="20th">20th</option>
                                <option value="21th">21th</option>
                                <option value="22th">22th</option>
                                <option value="23th">23th</option>
                                <option value="24th">24th</option>
                                <option value="25th">25th</option>
                                <option value="26th">26th</option>
                                <option value="27th">27th</option>
                                <option value="28th">28th</option>
                                <option value="last">Last</option>
                            </select>
                            <select name="monthlyweek_option" id="monthlyweek_option" class="form-control" style="display: none;width: 20% !important;">
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="saturday">Saturday</option>
                                <option value="sunday">Sunday</option>
                            </select>
                            of every<input type="number" name="monthly_days" id="monthly_days" size="1" class="form-control" style="width: 8% !important;display: inline;">month(s)
                        </div>
                        <div id="yearly" style="display: none;">
                            every
                            <select name="yearlymonth_option" id="yearlymonth_option" class="form-control">
                                <option value="january">January</option>
                                <option value="february">February</option>
                                <option value="march">March</option>
                                <option value="april">April</option>
                                <option value="may">May</option>
                                <option value="june">June</option>
                                <option value="july">July</option>
                                <option value="august">August</option>
                                <option value="september">September</option>
                                <option value="october">October</option>
                                <option value="november">November</option>
                                <option value="december">December</option>
                            </select>
                            <select name="yearlyday_option" id="yearlyday_option" class="form-control">
                                <option value="1st">1st</option>
                                <option value="2nd">2nd</option>
                                <option value="3rd">3rd</option>
                                <option value="4th">4th</option>
                                <option value="5th">5th</option>
                                <option value="6th">6th</option>
                                <option value="7th">7th</option>
                                <option value="8th">8th</option>
                                <option value="9th">9th</option>
                                <option value="10th">10th</option>
                                <option value="11th">11th</option>
                                <option value="12th">12th</option>
                                <option value="13th">13th</option>
                                <option value="14th">14th</option>
                                <option value="15th">15th</option>
                                <option value="16th">16th</option>
                                <option value="17th">17th</op1tion>
                                <option value="18th">18th</option>
                                <option value="19th">19th</option>
                                <option value="20th">20th</option>
                                <option value="21th">21th</option>
                                <option value="22th">22th</option>
                                <option value="23th">23th</option>
                                <option value="24th">24th</option>
                                <option value="25th">25th</option>
                                <option value="26th">26th</option>
                                <option value="27th">27th</option>
                                <option value="28th">28th</option>
                                <option value="last">Last</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" style="display: flex;">
                        <label>StartDate</label>
                        <div class="col-xs-10 date_picker">
                            <input type="text" name="recurr_start_date" id="recurr_start_date" class="form-control" style="width: 103%!important;">
                        </div>
                        <select class="form-control" name="recurr_select" id="recurr_select" style="width: 35%!important">
                            <option value="none">None</option>
                            <option value="by">By</option>
                            <option value="after">After</option>
                        </select>
                        <div id="recurr_by" style="display: none;">
                            <div class="col-xs-10 date_picker">
                                <input type="text" name="recurr_end_date" id="recurr_end_date" class="form-control">
                            </div>
                        </div>
                        <div id="recurr_after" style="display: none;"><input type="text" name="recurr_after_occurrences" id="recurr_after_occurrences" class="form-control" maxlength="3"></div>
                    </div>
                </div>
            </div>
            <div style="margin-left: 20px;">
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-3">
                        <select name="recurr_payee_popup" id="recurr_payee_popup" class="form-control fa">
                            <option value="" disabled="" selected>Payee</option>
                            <?php
                            foreach($this->AccountingVendors_model->select() as $ro)
                            {
                            ?>
                            <option value="<?=$ro->id?>"><?php echo $ro->f_name." ".$ro->l_name?></option>
                            <?php
                            }
                            ?>
                            <option value="fa fa-plus">&#xf067; Add new</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control fa" name="recurr_account_popup" id="recurr_account_popup">
                            <?php
                               $i=1;
                               foreach($this->chart_of_accounts_model->select() as $row)
                               {
                                ?>
                                <option <?php if($this->reconcile_model->checkexist($row->id) != $row->id): echo "disabled"; ?>
                                <?php endif ?>value="<?=$row->id?>"><?=$row->name?></option>
                              <?php
                              $i++;
                              }
                               ?>
                            <option value="fa fa-plus">&#xf067; Add new</option>
                        </select>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-2">
                        <label>Mailing Address:</label>
                        <textarea name="recurr_mailing_add" id="recurr_mailing_add" class="form-control" rows="4"><?=$rows[0]->mailing_address?></textarea>
                    </div>
                    <div class="col-md-2">
                        <label>Payment date:</label>
                        <div class="col-xs-10 date_picker">
                            <input type="text" name="recurr_date_popup" id="recurr_date_popup" class="form-control" value="<?=$rows[0]->first_date?>"/>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2">
                        <label>Check no.</label>
                        <input type="text" name="recurr_checkno" id="recurr_checkno" class="form-control" value="<?=$rows[0]->checkno?>"/>
                        </br>
                        </br>
                        <input type="checkbox" class="form-control" name="recurr_print_check">Print Later
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                        <label>Permit no.</label>
                        <input type="text" name="recurr_permitno" id="recurr_permitno" class="form-control" value=""/>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-left: 20px">
            <section class="table-wrapper">
                <div class="container">
                    <table class="table" id="participantRecurrTable">
                        <thead>
                            <tr>
                               <th></th>
                               <th>#</th>
                               <th>Category</th>
                               <th>Description</th>
                               <th>Amount</th>
                               <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr onclick="trClickRecurrMain()">
                                <td><i class="fa fa-th"></i></td>
                                <td>1</td>
                                <td>
                                    <select name='recurr_expense_account' id='recurr_expense_account' class='' style="display: none;">
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="recurr_expense_account"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="recurr_descp" name="recurr_descp" value="" placeholder="What did you paid for?">
                                    <div class="recurr_descp"></div>
                                </td>
                                <td>
                                     <input type="hidden" id="recurr_service_charge" name="recurr_service_charge" value="">
                                    <div class="recurr_service_charge"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_recurr"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php 
                            $recurrservicechargecount =0;
                            if(!empty($this->reconcile_model->select_recurr_service($rows[0]->id,$rows[0]->chart_of_accounts_id)))
                            {
                            $recurrrowcount =2;
                            foreach($this->reconcile_model->select_recurr_service($rows[0]->id,$rows[0]->chart_of_accounts_id) as $recurrrowtab)
                            {
                                $recurrservicechargecount+=$recurrrowtab->service_charge_sub;
                            ?>
                            <tr onclick="trClickRecurr(<?=$recurrrowcount?>)">
                                <td data-id="<?=$recurrrowtab->id?>"><i class="fa fa-th"></i></td>
                                <td><?=$recurrrowcount?></td>
                                <td>
                                    <select name='recurr_expense_account_<?=$recurrrowcount?>' id='recurr_expense_account_<?=$recurrrowcount?>' data-id='<?=$recurrrowtab->id?>' class='up_row' style="display: none;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option <?php if($recurrrowtab->expense_account_sub == $rw->sub_acc_name){ echo "selected"; } ?> value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="recurr_expense_account_<?=$recurrrowcount?>"><?=$recurrrowtab->expense_account_sub?></div>
                                </td>
                                <td>
                                    <input type="hidden" id="recurr_descp_<?=$recurrrowcount?>" name="recurr_descp_<?=$recurrrowcount?>" value="<?=$recurrrowtab->descp_sc_sub?>" placeholder="What did you paid for?" value="<?=$recurrrowtab->descp_sc_sub?>">
                                    <div class="recurr_descp_<?=$recurrrowcount?>"><?=$recurrrowtab->descp_sc_sub?></div>
                                </td>
                                <td>
                                     <input type="hidden" id="recurr_service_charge_<?=$recurrrowcount?>" name="recurr_service_charge_<?=$recurrrowcount?>" value="<?=number_format($recurrrowtab->service_charge_sub,2)?>">
                                    <div class="recurr_service_charge_<?=$recurrrowcount?>"><?=number_format($recurrrowtab->service_charge_sub,2)?></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_recurr"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php $recurrrowcount++; }}else{ ?>
                            <tr onclick="trClickRecurr(2)">
                                <td><i class="fa fa-th"></i></td>
                                <td>2</td>
                                <td>
                                    <select name='recurr_expense_account_2' id='recurr_expense_account_2' class='' style="display: none;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="recurr_expense_account_2"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="recurr_descp_2" name="recurr_descp_2" value="" placeholder="What did you paid for?">
                                    <div class="recurr_descp_2"></div>
                                </td>
                                <td>
                                     <input type="hidden" id="recurr_service_charge_2" name="recurr_service_charge_2" value="">
                                    <div class="recurr_service_charge_2"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_recurr"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php } ?>
                            <input type="hidden" name="recurrservicechargecount" id="recurrservicechargecount" value="<?=$recurrservicechargecount?>">
                            <tr class="pr participantRecurrRow Recurrhide">
                                <td><i class="fa fa-th"></i></td>
                                <td>0</td>
                                <td>
                                    <select name='recurr_expense_account_' id='recurr_expense_account_' class='' style="display: none;">
                                        <option value=""></option>
                                        <?php
                                        foreach ($this->account_sub_account_model->get() as $rw)
                                        {
                                            ?>
                                           <option value="<?=$rw->sub_acc_name?>"><?=$rw->sub_acc_name?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <div class="recurr_expense_account_"></div>
                                </td>
                                <td>
                                    <input type="hidden" id="recurr_descp_" name="recurr_descp_" value="" placeholder="What did you paid for?">
                                    <div class="recurr_descp_"></div>
                                </td>
                                <td>
                                     <input type="hidden" id="recurr_service_charge_" name="recurr_service_charge_" value="">
                                    <div class="recurr_service_charge_"></div>
                                </td>
                                <td><a href="javascript:void(0);" class="remove_recurr"><i class="fa fa-trash"></i></a></td>
                            </tr>

                        </tbody>
                    </table>

                    <div class="btn-group">
                        <a href="javascript:void(0);" class="btn-add-bx add_recurr">Add Lines</a>
                        <a href="javascript:void(0);" class="btn-add-bx clear_recurr">Clear All Lines</a>
                    </div>
                    <div class="btn-group hidemerecurr" style="display: none;">
                        <a href="javascript:void(0);" class="btn-add-bx"  onclick="rightclickRecurr()">Save<i class="fa fa-check"></i></a>
                        <a href="javascript:void(0);" class="btn-add-bx"  onclick="crossClickRecurr()">Cancel<i class="fa fa-close"></i>
                    </div>
                </div>
            </section>

            <div class="row" style="margin-bottom:20px">
                <div class="col-md-4">
                    <label>Memo</label>
                    </br>
                    <textarea name="recurr_memo_sc" id="recurr_memo_sc" rows="4"></textarea>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-2">
                    <h6 id="recurrtotal">Total : $0.00</h6>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-4">
                    <label><i class="fa fa-paperclip"></i>Attachment</label>
                    </br>
                    <iframe name="hiddenFramerecurr" width="0" height="0" border="0" style="display: none;"></iframe>
                    <form action="<?php echo url('accounting/check/do_upload/') ?>" class="uploadmy" method="post" name="recurrForm" enctype="multipart/form-data" target="hiddenFramerecurr">
                    <div class="file-upload-block">
                        <div class="upload-btn-wrapper">
                            <button class="btn ubw">
                                <i class="fa fa-cloud-upload"></i>
                                <h6>Drag and drop files here or <span>browse to upload</span></h6>
                            </button>
                            <input type="file" name="userfile_recurr" />
                            <input type="hidden" name="subfix" value="recurr">
                        </div>
                    </div>
                    </br>
                    <button type="submit" class="form-control">Upload</button>
                    </form>
                    </br>
                    <a href="#" onclick="showData()">Show existing</a>
                </div>
            </div>
        </div>
     
        <div class="save-act" style="position: unset !important;">
            <button type="button" class="btn-cmn" onclick="closeRecurr()">Cancel</button>
            <button type="button" class="btn-cmn" onclick="openRecurr()" style="margin-left: 5% ">Revert</button>
            <button type="button" class="savebtn" onclick="save_recurr()">Save template</button>
        </div>
    </div>
    <!-- End Make recurring -->

    <!-- Make account -->
    <div id="overlay-account-tx" class=""></div>
    <div id="side-menu-account-tx" class="main-side-nav" style="display: none;">
        <?php echo form_open_multipart('accounting/chart_of_accounts/add', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-5">New Chart of account</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Account</h3>
                                </div>
                                <div class="col-md-4 form-group">
                                     <label for="account_type">Account Type</label>
                                    <select name="account_type" id="account_type" class="form-control " required>
                                        <option value="">Select Account Type</option>
                                        <?php foreach ($this->account_model->get() as $row): ?>
                                            <option value="<?php echo $row->id ?>"><?php echo $row->account_name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                 <div class="col-md-4 form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" required
                                           placeholder="Enter Name"
                                           autofocus/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="detail_type">Detail Type</label>
                                    <select name="detail_type" id="detail_type" class="form-control " onchange="showOptions(this)" required>
                                        <?php foreach ($this->account_detail_model->get() as $row_detail): ?>
                                            <option value="<?php echo $row_detail->acc_detail_id ?>" ><?php echo $row_detail->acc_detail_name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="description">Description</label>
                                    <textarea type="text" class="form-control" name="description" id="description"
                                              placeholder="Enter Description" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                          Use <b>Rents held in trust</b> to track deposits and rent held on behalf of the property owners. <br><br>
                                          <p>Typically only property managers use this type of account.</p>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="checkbox" name="sub_account" class="js-switch" id="check_sub" onchange="check()"/>
                                    <label for="formClient-Status">Is sub account</label>
                                    <select name="sub_account_type" id="sub_account_type" class="form-control " required disabled="disabled">
                                          <?php foreach ($this->account_sub_account_model->get() as $row_sub): ?>
                                            <option value="<?php echo $row_sub->sub_acc_id ?>" ><?php echo $row_sub->sub_acc_name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <br>
                                    <label for="choose_time">When do you want to start tracking your finances from this account in Nsmartrac?</label>
                                    <span></span>
                                    <select name="choose_time" id="choose_time" class="form-control " required onchange="showdiv()">
                                            <option selected="selected" disabled="disabled">Choose one</option>
                                            <option value="Beginning of this year">Beginning of this year</option>
                                            <option value="Beginning of this month">Beginning of this month</option>
                                            <option value="Today">Today</option>
                                            <option value="Other" onclick="hidediv()">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group"></div>
                                <div class="col-md-4 form-group hide-div" style="display: none;">
                                     <label for="balance">Balance</label>
                                    <input type="text" class="form-control" name="balance" id="balance" required
                                           placeholder="Enter Balance"
                                           autofocus/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group"></div>
                                <div class="col-md-4 form-group hide-date" style="display: none;">
                                     <label for="time_date">Date</label>
                                     <div class="col-xs-10 date_picker">
                                        <input type="text" class="form-control" name="time_date" id="time_date"
                                           placeholder="Enter Date" onchange="showdiv2()" autofocus/>
                                     </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="submit"  name="save" class="btn btn-flat btn-primary">Submit</button>
                                </div>
                                <div class="col-md-4 form-group">
                                    <a href="#" class="btn btn-flat btn-primary" onclick="closeAddaccount()">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>
    </div>
    
    <!-- End Make account -->

    <!-- Add payee -->
    <div id="overlay-payee-tx" class=""></div>
    <div id="side-menu-payee-tx" class="main-side-nav">
        <div>
            <div class="side-title">
                <h4>New Name</h4>
                <a id="close-menu-payee-tx" class="menuCloseButton" onclick="closePayee()"><span id="side-menu-close-text">
                <i class="fa fa-times"></i></span></a>
            </div>
            <div style="margin-left: 20px;">
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" name="paypop_name" id="paypop_name" class="form-control">
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-6">
                        <label>Type</label>
                        <select name="paypop_type" id="paypop_type" class="form-control">
                            <option value="vendor">Vendor</option>
                            <option value="customer">Customer</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-6">
                        <a href="#" onclick="opendetails()"><i class="fa fa-plus"></i>Details</a>
                    </div>
                    <div class="col-md-6 save-act">
                        <button type="submit" class="savebtn">Save</button>
                    </div>
                </div>
                <hr>
                <div class="row" style="margin-bottom:20px">
                    <div class="col-md-12">
                        <p><a href="#" data-toggle="collapse" data-target="#gmailExample" aria-expanded="false" aria-controls="gmailExample">
                            <i class="fa fa-chevron-down"></i>Got a gmail account?
                        </a></p>
                        <div class="gmail" id="gmailExample">
                            <div class="card card-body">
                                <button type="button" class="savebtn">Connect your gmail account</button>
                                <p>After you connect, your contacts will appear in a holding list.You can then choose which ones to add to nSmartrac.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add payee -->

    <!-- Add Vendor -->
    <div id="overlay-vendor-tx" class=""></div>
    <div id="side-menu-vendor-tx" class="main-side-nav">
        <div class="side-title">
            <h4>Vendor Information</h4>
            <a id="close-menu-vendor-tx" class="menuCloseButton" onclick="closeVendor()"><span id="side-menu-close-text">
            <i class="fa fa-times"></i></span></a>
        </div>
        <div style="margin-left: 20px;">
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-2">
                    <label>Title</label><br>
                    <input type="text" name="ven_title" id="ven_title" class="form-control">
                </div>
                <div class="col-md-1">
                    <label>First Name</label><br>
                    <input type="text" name="ven_firstname" id="ven_firstname" class="form-control">
                </div>
                <div class="col-md-1">
                    <label>Middle Name</label><br>
                    <input type="text" name="ven_midname" id="ven_midname" class="form-control">
                </div>
                <div class="col-md-1">
                    <label>Last Name</label><br>
                    <input type="text" name="ven_lastname" id="ven_lastname" class="form-control">
                </div>
                <div class="col-md-1">
                    <label>Suffix</label><br>
                    <input type="text" name="ven_suffix" id="ven_suffix" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Email</label><br>
                    <input type="text" name="ven_email" id="ven_email" class="form-control">
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <label>Company</label><br>
                    <input type="text" name="ven_company" id="ven_company" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>Phone</label><br>
                    <input type="text" name="ven_phone" id="ven_phone" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>Mobile</label><br>
                    <input type="text" name="ven_mobile" id="ven_mobile" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>Fax</label><br>
                    <input type="text" name="ven_fax" id="ven_fax" class="form-control">
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <label>Display name as</label><br>
                    <input type="text" name="ven_disname" id="ven_disname" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Other</label><br>
                    <input type="text" name="ven_other" id="ven_other" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Website</label><br>
                    <input type="text" name="ven_website" id="ven_website" class="form-control">
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <label>Print on check as</label>
                    <input type="checkbox" name="ven_print" id="ven_print">Use display name<br>
                    <input type="text" name="ven_printtext" id="ven_printtext" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Billing rate (/hr)</label><br>
                    <input type="text" name="ven_billing" id="ven_billing" class="form-control">
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <label>Address<a href="#">map</a></label><br>
                    <textarea name="ven_address" id="ven_address" class="form-control"></textarea>
                </div>
                <div class="col-md-6">
                    <label>Terms</label><br>
                    <select name="ven_term" id="ven_term" class="form-control fa">
                        <option></option>
                        <option value="fa fa-plus">&#xf067; Add new</option>
                    </select>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-3">
                    <label>City</label><br>
                    <input type="text" name="ven_city" id="ven_city" class="form-control" placeholder="city">
                </div>
                <div class="col-md-3">
                    <label>State</label><br>
                    <input type="text" name="ven_state" id="ven_state" class="form-control" placeholder="state">
                </div>
                <div class="col-md-3">
                    <label>Opening Balance</label>
                    <input type="text" name="ven_bal" id="ven_bal" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>as of</label>
                    <div class="col-xs-1 date_picker">
                        <input type="text" name="ven_date" id="ven_date" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-3">
                    <label>Zip code</label><br>
                    <input type="text" name="ven_zip" id="ven_zip" class="form-control" placeholder="zipcode">
                </div>
                <div class="col-md-3">
                    <label>Country</label><br>
                    <input type="text" name="ven_country" id="ven_country" class="form-control" placeholder="country">
                </div>
                <div class="col-md-6">
                    <label>Account no.</label><br>
                    <input type="text" name="ven_acc" id="ven_acc" class="form-control" placeholder="Appears in the memo of all payment">
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <label>Notes</label><br>
                    <textarea name="ven_notes" id="ven_notes" class="form-control"></textarea>
                </div>
                <div class="col-md-6">
                    <label>Business ID No.</label><br>
                    <input type="text" name="ven_bid" id="ven_bid" class="form-control">
                    <input type="checkbox" name="ven_bid_check" id="ven_bid_check" class="form-control">Track payments for 1099
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <label>Attachment</label>
                    </br>
                    <iframe name="hiddenFramevendor" width="0" height="0" border="0" style="display: none;"></iframe>
                    <form action="<?php echo url('accounting/check/do_upload') ?>" class="uploadmy" method="post" name="vendorForm" enctype="multipart/form-data" target="hiddenFramevendor">
                    <div class="file-upload-block">
                        <div class="upload-btn-wrapper">
                            <button class="btn ubw">
                                <i class="fa fa-cloud-upload"></i>
                                <h6>Drag and drop files here or <span>browse to upload</span></h6>
                            </button>
                            <input type="file" name="userfile_vendor" />
                            <input type="hidden" name="subfix" value="vendor">
                        </div>
                    </div>
                    </br>
                    <button type="submit" class="form-control">Upload</button>
                    </form>
                    </br>
                </div>
                <div class="col-md-6">
                    <label>Default expense account</label><br>
                    <select name="ven_expenseacc" id="ven_expenseacc" class="form-control fa">
                        <?php
                           $i=1;
                           foreach($this->chart_of_accounts_model->select() as $row)
                           {
                            ?>
                            <option <?php if($this->reconcile_model->checkexist($row->id) != $row->id): echo "disabled"; ?>
                            <?php endif ?>value="<?=$row->id?>"><?=$row->name?></option>
                          <?php
                          $i++;
                          }
                        ?>
                        <option value="fa fa-plus">&#xf067; Add new</option>
                    </select>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <h4>Get custom fields with Advanced</h4>
                    <p>Custom fields let you add more detailed info about your customers and transactions.</p>
                    <p>Sort, track, and report info that's important to you.</p>
                </div>
            </div>
            <hr>
            <div class="save-act" style="position: unset !important;">
            <button type="button" class="btn-cmn" onclick="closeVendor()">Cancel</button>
            <button type="button" class="btn-cmn" style="margin-left: 30%">Make In-active</button>
            <button type="submit" class="savebtn">Save</button>
        </div>
        </div>
    </div>
    <!-- End Add Vendor -->

    <!-- Add Customer -->
    <div id="overlay-customer-tx" class=""></div>
    <div id="side-menu-customer-tx" class="main-side-nav">
        <div class="side-title">
            <h4>Customer Information</h4>
            <a id="close-menu-customer-tx" class="menuCloseButton" onclick="closeCustomer()"><span id="side-menu-close-text">
            <i class="fa fa-times"></i></span></a>
        </div>
        <div style="margin-left: 20px;">
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-2">
                    <label>Title</label><br>
                    <input type="text" name="cus_title" id="cus_title" class="form-control">
                </div>
                <div class="col-md-1">
                    <label>First Name</label><br>
                    <input type="text" name="cus_firstname" id="cus_firstname" class="form-control">
                </div>
                <div class="col-md-1">
                    <label>Middle Name</label><br>
                    <input type="text" name="cus_midname" id="cus_midname" class="form-control">
                </div>
                <div class="col-md-1">
                    <label>Last Name</label><br>
                    <input type="text" name="cus_lastname" id="cus_lastname" class="form-control">
                </div>
                <div class="col-md-1">
                    <label>Suffix</label><br>
                    <input type="text" name="cus_suffix" id="cus_suffix" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Email</label><br>
                    <input type="text" name="cus_email" id="cus_email" class="form-control">
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <label>Company</label><br>
                    <input type="text" name="cus_company" id="cus_company" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>Phone</label><br>
                    <input type="text" name="cus_phone" id="cus_phone" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>Mobile</label><br>
                    <input type="text" name="cus_mobile" id="cus_mobile" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>Fax</label><br>
                    <input type="text" name="cus_fax" id="cus_fax" class="form-control">
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <label>Display name as</label><br>
                    <input type="text" name="cus_disname" id="cus_disname" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Other</label><br>
                    <input type="text" name="cus_other" id="cus_other" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Website</label><br>
                    <input type="text" name="cus_website" id="cus_website" class="form-control">
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-6">
                    <label>Print on check as</label>
                    <input type="checkbox" name="cus_print" id="cus_print">Use display name<br>
                    <input type="text" name="cus_printtext" id="cus_printtext" class="form-control">
                </div>
                <div class="col-md-3">
                    <input type="checkbox" name="cus_sub_check" id="cus_sub_check" class="form-control">Is sub-customer<br>
                    <select class="form-control" name="cus_subcus" id="cus_subcus">
                        <option value=""></option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="cus_billthis" id="cus_billthis">
                        <option value="bill_customer">Bill this with customer</option>
                        <option value="bill_parent">Bill this with parent</option>
                    </select>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px;margin-left: 20px">
                <div class="container">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#nav_address">Address</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#nav_note">Notes</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#nav_tax">Tax info</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#nav_paybill">Payment & Billing</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#nav_language">Language</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#nav_attachment">Attachments</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#nav_custom">Custom fields</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#nav_additional">Additional Info.</a>
                    </li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div id="nav_address" class="container tab-pane active"><br>
                      <h3>Address</h3>
                      <div class="row">
                          <div class="col-md-6">
                            <label>Billing Address<a href="#">map</a></label><br>
                            <textarea name="cus_bill_address" id="cus_bill_address" class="form-control"></textarea>
                           </div>
                           <div class="col-md-6">
                            <label>Shipping Address<a href="#">map</a></label><br>
                            <textarea name="cus_ship_address" id="cus_ship_address" class="form-control"></textarea>
                           </div>
                      </div>
                      <div class="row">
                          <div class="col-md-3">
                                <label>City</label><br>
                                <input type="text" name="cus_bill_city" id="cus_bill_city" class="form-control" placeholder="city">
                            </div>
                            <div class="col-md-3">
                                <label>State</label><br>
                                <input type="text" name="cus_bill_state" id="cus_bill_state" class="form-control" placeholder="state">
                            </div>
                            <div class="col-md-3">
                                <label>City</label><br>
                                <input type="text" name="cus_ship_city" id="cus_ship_city" class="form-control" placeholder="city">
                            </div>
                            <div class="col-md-3">
                                <label>State</label><br>
                                <input type="text" name="cus_ship_state" id="cus_ship_state" class="form-control" placeholder="state">
                            </div>
                      </div>
                      <div class="row">
                          <div class="col-md-3">
                                <label>Zip code</label><br>
                                <input type="text" name="cus_bill_zip" id="cus_bill_zip" class="form-control" placeholder="zipcode">
                            </div>
                            <div class="col-md-3">
                                <label>Country</label><br>
                                <input type="text" name="cus_bill_country" id="cus_bill_country" class="form-control" placeholder="country">
                            </div>
                            <div class="col-md-3">
                                <label>Zip code</label><br>
                                <input type="text" name="cus_ship_zip" id="cus_ship_zip" class="form-control" placeholder="zipcode">
                            </div>
                            <div class="col-md-3">
                                <label>Country</label><br>
                                <input type="text" name="cus_ship_country" id="cus_ship_country" class="form-control" placeholder="country">
                            </div>
                      </div>
                    </div>
                    <div id="nav_note" class="container tab-pane fade"><br>
                      <h3>Notes</h3>
                      <div class="row" style="margin-bottom:20px">
                            <div class="col-md-12">
                                <label>Notes</label><br>
                                <textarea name="cus_notes" id="cus_notes" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="nav_tax" class="container tab-pane fade"><br>
                      <div class="row">
                          <div class="col-md-3">
                              <input type="checkbox" name="check_tax" id="check_tax" class="form-control">This customer is tax exempt
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-3">
                              <label>Reason for exemption*</label><br>
                              <select class="form-control" name="select_tax" id="select_tax">
                                  <option value=""></option>
                              </select>
                          </div>
                          <div class="col-md-3">
                              <label>Exemption Detail</label><br>
                              <input type="text" name="detail_tax" id="detail_tax" class="form-control">
                          </div>
                      </div>
                    </div>
                    <div id="nav_paybill" class="container tab-pane fade"><br>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Prefer payment method</label><br>
                                <select class="form-control fa" name="cus_pay_method" id="cus_pay_method">
                                    <option value=""></option>
                                    <option value="fa fa-plus">&#xf067; Add new</option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Terms</label><br>
                                <select name="cus_term" id="cus_term" class="form-control fa">
                                    <option></option>
                                    <option value="fa fa-plus">&#xf067; Add new</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Preferred delivery method</label><br>
                                    <select class="form-control" name="cus_deli_method" id="cus_deli_method">
                                        <option value="printlater">Print later</option>
                                        <option value="savelater">Save later</option>
                                        <option value="none">None</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Opening Balance</label>
                                    <input type="text" name="cus_bal" id="cus_bal" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label>as of</label>
                                    <div class="col-xs-1 date_picker">
                                        <input type="text" name="cus_date" id="cus_date" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="nav_language" class="container tab-pane fade"><br>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Send invoices to this customer in</label><br>
                                <select class="form-control" name="cus_language" id="cus_language">
                                        <option value="eng">English</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="nav_attachment" class="container tab-pane fade"><br>
                        <div class="col-md-6">
                            <label>Attachment</label>
                            </br>
                            <iframe name="hiddenFramecus" width="0" height="0" border="0" style="display: none;"></iframe>
                            <form action="<?php echo url('accounting/check/do_upload') ?>" class="uploadmy" method="post" name="cusForm" enctype="multipart/form-data" target="hiddenFramecus">
                            <div class="file-upload-block">
                                <div class="upload-btn-wrapper">
                                    <button class="btn ubw">
                                        <i class="fa fa-cloud-upload"></i>
                                        <h6>Drag and drop files here or <span>browse to upload</span></h6>
                                    </button>
                                    <input type="file" name="userfile_cus" />
                                    <input type="hidden" name="subfix" value="cus">
                                </div>
                            </div>
                            </br>
                            <button type="submit" class="form-control">Upload</button>
                            </form>
                            </br>
                        </div>
                    </div>
                    <div id="nav_custom" class="container tab-pane fade"><br>
                        <div class="col-md-6">
                            <h4>Get custom fields with Advanced</h4>
                            <p>Custom fields let you add more detailed info about your customers and transactions.</p>
                            <p>Sort, track, and report info that's important to you.</p>
                        </div>
                    </div>
                    <div id="nav_additional" class="container tab-pane fade"><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Customer Type</label><br>
                                <select class="form-control" name="cus_custype" id="cus_custype">
                                </select>
                            </div>
                        </div>
                    </div>
                  </div>

                </div>
            </div>
            <hr>
            <div class="save-act" style="position: unset !important;">
            <button type="button" class="btn-cmn" onclick="closeCustomer()">Cancel</button>
            <button type="submit" class="savebtn">Save</button>
        </div>
        </div>
    </div>
    <!-- End Add Customer -->


    <!-- Add Agency Sidebar -->
    <div id="overlay" class=""></div>
    <div id="side-menu" class="main-side-nav">
        <div class="side-title">
            <h4>Add to Bank Deposit</h4>
            <a id="close-menu" class="menuCloseButton" onclick="closeSideNav()"><span id="side-menu-close-text">
            <i class="fa fa-times"></i></span></a>
        </div>
        <div class="mainMenu nav">
            <div class="existing-listing">
                <div class="inner-like">
                    <!-- <div class="dropdown">
                        <button class="btn-exisitng dropdown-toggle" type="button" data-toggle="dropdown">Unliked
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="#">All</a></li>
                            <li><a href="#">Unliked</a></li>
                        </ul>
                    </div> -->
                </div>

                <div id="ajax_upload_data"></div>
            </div>
        </div>
    </div>
    <!-- End Add Agency Sidebar -->

    <!-- Preview Popup -->
    <div id="overlay-preview-tx" class=""></div>
    <div id="side-menu-preview-tx" class="main-side-nav">
        <div class="side-title">
            <a id="close-menu-preview-tx" class="menuCloseButton" onclick="closePreview()"><span id="side-menu-close-text">
            <i class="fa fa-times"></i></span></a>
        </div>
        
        <div class="mainMenu nav">
            <img src="" name="previewImage" class="img-responsive" id="previewImage">
        </div>
    </div>
    <!-- End Preview Popup -->

    <!-- Print popup -->
    <div id="overlay-print-tx" class=""></div>
    <div id="side-menu-print-tx" class="main-side-nav" style="background-color: #f4f5f8">
        <div class="side-title print_disnone">
            <h4>Print Checks</h4>
            <a id="close-menu-print-tx" class="menuCloseButton" onclick="closePrintNav()"><span id="side-menu-close-text">
            <i class="fa fa-times"></i></span></a>
        </div>
        <div style="margin-left: 20px;">
            <div class="row print_disnone">
                <div class="col-md-3">
                    <select class="form-control" id="account_printpopup" disabled>
                        <?php
                           $i=1;
                           foreach($this->chart_of_accounts_model->select() as $row)
                           {
                            ?>
                            <option <?php if($this->reconcile_model->checkexist($row->id) != $row->id): echo "disabled"; ?>
                            <?php endif ?> value="<?=$row->id?>"><?=$row->name?></option>
                          <?php
                          $i++;
                          }
                           ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <h6>Balance:0.00</h6>
                </div>
                <div class="col-md-4">
                    <h6 id="check_count">1 Checks selected</h6><div id="check_amount">$0.00</div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <button type="button" class="form-control" onclick="addnewCheck()">Add checks</button>
                </div>
            </div>
            <div class="row print_disnone">
                <div class="col-md-2">
                    <!-- <button type="button" class="form-control">Remove from list</button> -->
                </div>
                <div class="col-md-2">
                   <!--  <select name="sort_print" class="form-control">
                        <option>Sort by Payee</option>
                        <option>Sort by Order created</option>
                        <option>Sort by Date/ Payee</option>
                        <option selected>Sort by Date/ Order created</option>
                    </select> -->
                </div>
                <div class="col-md-2">
                    <!-- <select name="showall_print" class="form-control">
                        <option>Show all checks</option>
                        <option>Show regular checks</option>
                        <option>Show bill payment checks</option>
                    </select> -->
                </div>
                <div class="col-md-2">
                    <label>Starting check no.</label>
                    <input type="text" name="starting_check_no" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>On first page print</label>
                    <select name="checks_print" class="form-control">
                        <option>1 checks</option>
                        <option>2 checks</option>
                        <option>3 checks</option>
                    </select>
                </div>
                 <div class="col-md-2">
                    <i class="fa fa-print" onclick="window.print()"></i>
                    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cog"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        Columns<br/>
                        <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_date_print()" name="chk_date_print" id="chk_date_print"> Date</p>
                        <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_type_print()" name="chk_type_print" id="chk_type_print"> Type</p>
                        <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_payee_print()" name="chk_payee_print" id="chk_payee_print"> Payee Type</p>
                        <p class="p-padding"><input type="checkbox" checked="checked" onchange="col_amount_print()" name="chk_amount_print" id="chk_amount_print"> Amount</p>
                        <br/>
                    </div>
                </div>
            </div>
            <div class="row print_disnone">
                <section class="table-wrapper">
                    <div class="container">
                        <table class="table" id="print_table">
                            <thead>
                                <tr>
                                   <th></th>
                                   <th class="date_print">Date</th>
                                   <th class="type_print">Type</th>
                                   <th class="payee_print">Payee</th>
                                   <th class="amount_print">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox" checked name="print_service_charge_checkbox" id="print_service_charge_checkbox" onclick="Changecheck()"></td>
                                    <td class="date_print"></td>
                                    <td class="type_print">Check</td>
                                    <td class="payee_print"></td>
                                    <td class="amount_print">
                                        $<div id="print_service_charge">0.00</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
            <div style="display: none;" class="print_disshow">
                <?php
                function AmountInWords(float $amount)
                {
                   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
                   // Check if there is any number after decimal
                   $amt_hundred = null;
                   $count_length = strlen($num);
                   $x = 0;
                   $string = array();
                   $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
                     3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
                     7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
                     10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
                     13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
                     16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
                     19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
                     40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
                     70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
                    $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
                    while( $x < $count_length ) {
                      $get_divider = ($x == 2) ? 10 : 100;
                      $amount = floor($num % $get_divider);
                      $num = floor($num / $get_divider);
                      $x += $get_divider == 10 ? 1 : 2;
                      if ($amount) {
                       $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
                       $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
                       $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
                       '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
                       '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
                        }
                   else $string[] = null;
                   }
                   $implode_to_Rupees = implode('', array_reverse($string));
                   $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
                   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
                   return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
                }
                ?>
                <p>
                    <?=$rows[0]->first_date?><br>
                    **<?=number_format($rows[0]->service_charge,2)?><br>
                    <?php echo AmountInWords(number_format($rows[0]->service_charge,2));?> <br>*********************************************************************************************
                    Service Charge edit
                </p>
            </div>
        </div>
    

        <div class="save-act print_disnone" style="position: unset !important;">
            <button type="button" class="btn-cmn" onclick="closePrintNav()">Cancel</button>
            <button type="button" class="savebtn" onclick="window.print()">Preview and print</button>
        </div>
    </div>
    <!-- End Print popup -->

<?php include viewPath('includes/footer_accounting'); ?>
<script type="text/javascript">
addCheck();
$(document).ready(function() {
        addCheck();
 });
function addCheck()
{
    jQuery("#side-menu-check-tx").addClass("open-side-nav");
    jQuery("#side-menu-check-tx").css("width","100%");
    jQuery("#side-menu-check-tx").css("overflow-y","auto");
    jQuery("#side-menu-check-tx").css("overflow-x","hidden");
    jQuery("#overlay-check-tx").addClass("overlay");
}
function closeCheck() 
{
    jQuery("#side-menu-check-tx").removeClass("open-side-nav");
    jQuery("#side-menu-check-tx").css("width","0%");
    jQuery("#overlay-check-tx").removeClass("overlay");
}
</script>
<script type="text/javascript">
     /* Variables */
    var p = 1;
    var row_check = $(".participantCheckRow");

    function addRowCheck() {
      row_check.clone(true, true).removeClass('Checkhide table-line').appendTo("#participantCheckTable");
      var index_check =$('#participantCheckTable tr').length -1;
      var final_index_check = index_check-1;
      $('#participantCheckTable tr:eq('+index_check+')').attr("onclick","trClickCheck("+final_index_check+")");
      $('#participantCheckTable tr:eq('+index_check+') td:eq(1)').text(index_check-2);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(2)').find('select').attr("id","check_expense_account_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(2)').find('select').attr("name","check_expense_account_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(2)').find('div').attr("class","check_expense_account_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(3)').find('input').attr("id","check_descp_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(3)').find('input').attr("name","check_descp_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(3)').find('div').attr("class","check_descp_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(4)').find('input').attr("id","check_service_charge_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(4)').find('input').attr("name","check_service_charge_"+final_index_check);
      $('#participantCheckTable tr:eq('+index_check+') td:eq(4)').find('div').attr("class","check_service_charge_"+final_index_check);
    }

    function removeRowCheck(buttoncheck) {
        console.log(buttoncheck.closest("tr").text());
      buttoncheck.closest("tr").remove();
      var totcheck = $('#checktotal').text().substr(9)-buttoncheck.closest("tr").find('td:eq(4)').text().trim();
      $('#checktotal').text('Total : $'+totcheck.toFixed(2));
      $('#checkamount').text('Amount : $'+totcheck.toFixed(2));
      if(buttoncheck.closest("tr").find('td:eq(2)').find('select').hasClass("up_row"))
        {
            var id_to_remove =buttoncheck.closest("tr").find('td:eq(0)').attr("data-id");
            remove_func_check(id_to_remove);
        }
    }
    /* Doc ready */
    $(".add_check").on('click', function () {
      if($("#participantCheckTable tr").length < 17) {
        addRowCheck();
        var i = Number(p)+1;
        $("#participants").val(i);
      }
      $(this).closest("tr").appendTo("#participantCheckTable");
      if ($("#participantCheckTable tr").length === 3) {
        $(".remove_check").hide();
      } else {
        $(".remove_check").show();
      }
    });
    $(".remove_check").on('click', function () {
      if($("#participantCheckTable tr").length === 3) {
        //alert("Can't remove row.");
        $(".remove_check").hide();
      } else if($("#participantCheckTable tr").length - 1 ==3) {
        $(".remove_check").hide();
        removeRowCheck($(this));
        var i = Number(p)-1;
        $("#participants").val(i);
      } else {
        removeRowCheck($(this));
        var i = Number(p)-1;
        $("#participants").val(i);
      }
    });
    $("#participants").change(function () {
      var i = 0;
      p = $("#participants").val();
      var rowCount = $("#participantCheckTable tr").length - 2;
      if(p > rowCount) {
        for(i=rowCount; i<p; i+=1){
          addRowCheck();
        }
        $("#participantCheckTable #addButtonRow").appendTo("#participantCheckTable");
      } else if(p < rowCount) {
      }
    });
    $(".clear_check").on('click', function () {
      if($("#participantCheckTable tr").length - 1 >3) {
        x = 1;
        $('#participantCheckTable > tbody  > tr').each(function() {
            if(x >3)
            {
                $(this).remove();
                var totcheck_clear = $('#checktotal').text().substr(9)-$(this).closest("tr").find('td:eq(4)').text().trim();
                $('#checktotal').text('Total : $'+totcheck_clear.toFixed(2));
                $('#checkamount').text('Amount : $'+totcheck_clear.toFixed(2));
            }
            x = x+1;
        });
      }
    });


    function trClickCheckMain()
    {
        if($('#check_expense_account').css("display")== 'none')
        {
            $('.check_expense_account').css('display','none');
            $('#check_expense_account').show();
            $('.hidemecheck').show();
        }
        if($('#check_service_charge').attr("type")== 'hidden')
        {
            $('.check_service_charge').css('display','none');
            $('#check_service_charge').removeAttr('type','hidden');
            $('#check_service_charge').attr('type','number');
            $('.hidemecheck').show();
        }
        if($('#check_descp').attr("type")== 'hidden')
        {
            $('.check_descp').css('display','none');
            $('#check_descp').removeAttr('type','hidden');
            $('.hidemecheck').show();
        }
    }

    function trClickCheck(index_check)
    {
        if($('#check_expense_account_'+index_check).css("display")== 'none')
        {
            $('.check_expense_account_'+index_check).css('display','none');
            $('#check_expense_account_'+index_check).show();
            $('.hidemecheck').show();
        }
        if($('#check_service_charge_'+index_check).attr("type")== 'hidden')
        {
            $('.check_service_charge_'+index_check).css('display','none');
            $('#check_service_charge_'+index_check).removeAttr('type','hidden');
            $('#check_service_charge_'+index_check).attr('type','number');
            $('.hidemecheck').show();
        }
        if($('#check_descp_'+index_check).attr("type")== 'hidden')
        {
            $('.check_descp_'+index_check).css('display','none');
            $('#check_descp_'+index_check).removeAttr('type','hidden');
            $('.hidemecheck').show();
        }
    }
    function rightclickCheck()
    {
        length_check =$('#participantCheckTable tr').length -2;
        $('.check_expense_account').show();
        $('.check_expense_account').text($('#check_expense_account').val());
        $('#check_expense_account').css('display','none');
        $('.check_service_charge').show();
        $('.check_service_charge').text($('#check_service_charge').val());
        $('#check_service_charge').attr('type','hidden');
        $('.check_descp').show();
        $('.check_descp').text($('#check_descp').val());
        $('#check_descp').attr('type','hidden');
        $('.hidemecheck').hide();

        for(var i = 2 ; i <= length_check ; i++)
        {
            $('.check_expense_account_'+i).show();
            $('.check_expense_account_'+i).text($('#check_expense_account_'+i).val());
            $('#check_expense_account_'+i).css('display','none');
            $('.check_service_charge_'+i).show();
            $('.check_service_charge_'+i).text($('#check_service_charge_'+i).val());
            $('#check_service_charge_'+i).attr('type','hidden');
            $('.check_descp_'+i).show();
            $('.check_descp_'+i).text($('#check_descp_'+i).val());
            $('#check_descp_'+i).attr('type','hidden');
        }

        var total_check = 0;
       // total_check += parseInt($('.check_service_charge').text());
        for(var i = 2 ; i <= length_check ; i++)
        {
            if($('.check_service_charge_'+i).text() != '')
            {total_check += parseInt($('.check_service_charge_'+i).text());}
        }
        $('#checktotal').text('Total : $'+total_check.toFixed(2));
        $('#checkamount').text('Amount : $'+total_check.toFixed(2));
    }
    function crossClickCheck()
    {
        length_check =$('#participantCheckTable tr').length -2;
        $('.check_expense_account').show();
        $('#check_expense_account').css('display','none');
        $('.check_service_charge').show();
        $('#check_service_charge').attr('type','hidden');
        $('.check_descp').show();
        $('#check_descp').attr('type','hidden');
        $('.hidemecheck').hide();
        for(var i = 2 ; i <= length_check ; i++)
        {
            $('.check_expense_account_'+i).show();
            $('#check_expense_account_'+i).css('display','none');
            $('.check_service_charge_'+i).show();
            $('#check_service_charge_'+i).attr('type','hidden');
            $('.check_descp_'+i).show();
            $('#check_descp_'+i).attr('type','hidden');
        }
    }
</script>
<script type="text/javascript">
    $('#check_account_popup').on('change', function (e) {
          if($('#check_account_popup').val() == 'fa fa-plus')
          {
           openAddAccount();
          } 
      });
    $('#check_payee_popup').on('change', function (e) {
          if($('#check_payee_popup').val() == 'fa fa-plus')
          {
           openPayee();
          } 
      });
    $('#ven_term').on('change', function (e) {
          if($('#ven_term').val() == 'fa fa-plus')
          {
           openTerm();
          } 
      });
    $('#ven_expenseacc').on('change', function (e) {
          if($('#ven_expenseacc').val() == 'fa fa-plus')
          {
           openAddAccount();
          } 
      });
    function opendetails()
    {
        if($('#paypop_type').val() == 'vendor')
        {
            openVendor();
        }
        else if($('#paypop_type').val() == 'customer')
        {
            openCustomer();
        }
        else
        {
            closeVendor();
            closeCustomer();
        }
    }
    function openAddAccount()
    {
        jQuery("#side-menu-account-tx").show();
        jQuery("#side-menu-account-tx").addClass("open-side-nav");
        jQuery("#side-menu-account-tx").css("width","50%");
        jQuery("#side-menu-account-tx").css("overflow-y","auto");
        jQuery("#side-menu-account-tx").css("overflow-x","hidden");
        jQuery("#overlay-account-tx").addClass("overlay");
    }
    function closeAddaccount() 
    {
        jQuery("#side-menu-account-tx").removeClass("open-side-nav");
        jQuery("#side-menu-account-tx").css("width","0%");
        jQuery("#overlay-account-tx").removeClass("overlay");
    }
    function openPayee()
    {
        jQuery("#side-menu-payee-tx").show();
        jQuery("#side-menu-payee-tx").addClass("open-side-nav");
        jQuery("#side-menu-payee-tx").css("width","30%");
        jQuery("#side-menu-payee-tx").css("overflow-y","auto");
        jQuery("#side-menu-payee-tx").css("overflow-x","hidden");
        jQuery("#overlay-payee-tx").addClass("overlay");
    }
    function closePayee() 
    {
        jQuery("#side-menu-payee-tx").removeClass("open-side-nav");
        jQuery("#side-menu-payee-tx").css("width","0%");
        jQuery("#overlay-payee-tx").removeClass("overlay");
    }
    function openVendor()
    {
        jQuery("#side-menu-vendor-tx").show();
        jQuery("#side-menu-vendor-tx").addClass("open-side-nav");
        jQuery("#side-menu-vendor-tx").css("width","60%");
        jQuery("#side-menu-vendor-tx").css("overflow-y","auto");
        jQuery("#side-menu-vendor-tx").css("overflow-x","hidden");
        jQuery("#overlay-vendor-tx").addClass("overlay");
    }
    function closeVendor() 
    {
        jQuery("#side-menu-vendor-tx").removeClass("open-side-nav");
        jQuery("#side-menu-vendor-tx").css("width","0%");
        jQuery("#overlay-vendor-tx").removeClass("overlay");
    }
    function openCustomer()
    {
        jQuery("#side-menu-customer-tx").show();
        jQuery("#side-menu-customer-tx").addClass("open-side-nav");
        jQuery("#side-menu-customer-tx").css("width","80%");
        jQuery("#side-menu-customer-tx").css("overflow-y","auto");
        jQuery("#side-menu-customer-tx").css("overflow-x","hidden");
        jQuery("#overlay-customer-tx").addClass("overlay");
    }
    function closeCustomer() 
    {
        jQuery("#side-menu-customer-tx").removeClass("open-side-nav");
        jQuery("#side-menu-customer-tx").css("width","0%");
        jQuery("#overlay-customer-tx").removeClass("overlay");
    }
    function openTerm()
    {
        jQuery("#side-menu-term-tx").show();
        jQuery("#side-menu-term-tx").addClass("open-side-nav");
        jQuery("#side-menu-term-tx").css("width","30%");
        jQuery("#side-menu-term-tx").css("overflow-y","auto");
        jQuery("#side-menu-term-tx").css("overflow-x","hidden");
        jQuery("#overlay-term-tx").addClass("overlay");
    }
    function closeTerm() 
    {
        jQuery("#side-menu-term-tx").removeClass("open-side-nav");
        jQuery("#side-menu-term-tx").css("width","0%");
        jQuery("#overlay-term-tx").removeClass("overlay");
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $('.form-validate').validate();

        //Initialize Select2 Elements

        $('.select2').select2()

        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function (html) {
            var switchery = new Switchery(html, {size: 'small'});
        });

    })
    $('#account_type').on('change', function() {
      var account_id = this.value;
      if(account_id!='')
      {
        $.ajax({
            url:"<?php echo url('accounting/chart_of_accounts/fetch_acc_detail') ?>",
            method: "POST",
            data: {account_id:account_id},
            success:function(data)
            {
                $("#detail_type").html(data);
            }
        })
      }
    });
       
    function showOptions(s) {
        var option_text = document.getElementById(s[s.selectedIndex].id).innerHTML;
        $('#name').val(option_text);
    }

    function check() {
      var x = document.getElementById("check_sub").checked;
      if(x == true)
      {
        $('#sub_account_type').removeAttr('disabled','disabled');
      }
      else
      {
        $('#sub_account_type').attr('disabled','disabled');
      }
    }

    function showdiv() {
        $('.hide-div').css('display','block');
        if($('#choose_time').find(":selected").text()=='Other')
        {
            $('.hide-div').css('display','none');
            $('.hide-date').css('display','block');
        }
        else
        {
            $('.hide-date').css('display','none');
        }
    }
    function showdiv2() {
        if($('.day').hasClass('active'))
        {
            $('.hide-div').css('display','block');
        }
        else
        {
            $('.hide-div').css('display','none');
        }
    }
    $(function(){
        $('.date_picker input').datepicker({
           format: "dd.mm.yyyy",
           todayBtn: "linked",
           language: "de"
        });
    });
</script>
<script type="text/javascript">
    function save_check(id,chart_of_accounts_id)
    {
      var reconcile_id = id;
      var chart_of_accounts_id = chart_of_accounts_id;
      var check_payee_popup = $('#check_payee_popup').val();
      var check_account_popup = $('#check_account_popup').val();
      var mailing_address = $('#check_mailing_add').val();
      var date_popup = $('#check_date_popup').val();
      var checkno = $('#check_checkno').val();
      var permitno = $('#check_permitno').val();
      var memo_sc = $('#check_memo_sc').val();
      var descp_sc = $('.check_descp').text();
      var expense_account=$('.check_expense_account').text();
      //var service_charge=$('.check_service_charge').text();
      var service_charge=$('#checktotal').text().substr(9);

      var tablelength = $('#participantCheckTable tr').length -2;

      $.ajax({
            url:"<?php echo url('accounting/reconcile/check/save') ?>",
            method: "POST",
            data: {reconcile_id:reconcile_id,chart_of_accounts_id:chart_of_accounts_id,check_payee_popup:check_payee_popup,check_account_popup:check_account_popup,mailing_address:mailing_address,date_popup:date_popup,checkno:checkno,permitno:permitno,memo_sc:memo_sc},
            success:function(data)
            {
                var mainid = data;
                for(var i = 2 ; i <= tablelength ; i++)
                {

                    var expense_account_sub = $('.check_expense_account_'+i).text();
                    var service_charge_sub = $('.check_service_charge_'+i).text();
                    var descp_sc_sub = $('.check_descp_'+i).text();

                  if(expense_account_sub!='' || descp_sc_sub!='' || service_charge_sub!='')
                  {
                    if(service_charge_sub!='')
                    {
                        
                        $.ajax({
                            url:"<?php echo url('accounting/reconcile/addcheck/servicecharge') ?>",
                            method: "POST",
                            data: {mainid:mainid,reconcile_id:reconcile_id,chart_of_accounts_id:chart_of_accounts_id,expense_account_sub:expense_account_sub,service_charge_sub:service_charge_sub,descp_sc_sub:descp_sc_sub},
                            success:function(data)
                            {
                            }
                        })
                    }
                  }
                }
                sweetAlert(
                                'Saved!',
                                'New check has been saved.',
                                'success'
                            );
                closeCheck();
            }
        })
        
    }
    function remove_func_check(id)
    {
        var id = id;
        if(id!='')
        {
            $.ajax({
                    url:"<?php echo url('accounting/reconcile/servicecharge/remove_sc_check') ?>",
                    method: "POST",
                    data: {id:id},
                    success:function(data)
                    {
                        sweetAlert(
                                            'Deleted!',
                                            'Item has been deleted.',
                                            'success'
                                        );
                    }
                })
        }

    }
</script>
<script type="text/javascript">
function openSideNav() {
     
    jQuery("#side-menu").addClass("open-side-nav");
    jQuery("#overlay").addClass("overlay");
}
function closeSideNav() {
   
    jQuery("#side-menu").removeClass("open-side-nav");
    jQuery("#overlay").removeClass("overlay");
}
</script>
<script type="text/javascript">
function showData() {
    jQuery("#side-menu").addClass("open-side-nav");
    jQuery("#overlay").addClass("overlay");
    $.ajax({
        url:"<?php echo url('accounting/check/view/showData') ?>",
        method: "POST",
        success:function(data)
        {
            $('#ajax_upload_data').html(data);
        }
    })
}
</script>
<script type="text/javascript">
    function show_preview(id)
    {
        var image=$('#previewid_'+id).data('image');
        $("#previewImage").attr('src','<?php echo base_url()?>uploads/'+image);
        openPreview();
    }
    function openPreview() {
     
    jQuery("#side-menu-preview-tx").addClass("open-side-nav");
    jQuery("#side-menu-preview-tx").css("width","100%");
    jQuery("#side-menu-preview-tx").css("overflow-y","auto");
    jQuery("#side-menu-preview-tx").css("overflow-x","hidden");
    jQuery("#overlay-preview-tx").addClass("overlay");
    }

    function closePreview() {
       
        jQuery("#side-menu-preview-tx").removeClass("open-side-nav");
        jQuery("#side-menu-preview-tx").css("width","0%");
        jQuery("#overlay-preview-tx").removeClass("overlay");
    }

    $( ".uploadmy" ).submit(function(e) {
        e.preventDefault();
        this.submit();
        setTimeout(function () { 
                    sweetAlert(
                            'Uploaded!',
                            'File has been uploaded.',
                            'success'
                        );
                    showData();
                }, 100); 
    });
</script>
<script type="text/javascript">
function openRecurr()
{
    jQuery("#side-menu-recurr-tx").addClass("open-side-nav");
    jQuery("#side-menu-recurr-tx").css("width","100%");
    jQuery("#side-menu-recurr-tx").css("overflow-y","auto");
    jQuery("#side-menu-recurr-tx").css("overflow-x","hidden");
    jQuery("#overlay-recurr-tx").addClass("overlay");
}
function closeRecurr() 
{
    jQuery("#side-menu-recurr-tx").removeClass("open-side-nav");
    jQuery("#side-menu-recurr-tx").css("width","0%");
    jQuery("#overlay-recurr-tx").removeClass("overlay");
}
</script>
<script type="text/javascript">
     $('#interval').on('change', function (e) {
          if($('#interval').val() == 'daily')
          {
            $('#daily').show();
            $('#weekly').hide();
            $('#monthly').hide();
            $('#yearly').hide();
          }
          else if($('#interval').val() == 'weekly')
          {
            $('#daily').hide();
            $('#weekly').show();
            $('#monthly').hide();
            $('#yearly').hide();
          }
          else if($('#interval').val() == 'monthly')
          {
            $('#daily').hide();
            $('#weekly').hide();
            $('#monthly').show();
            $('#yearly').hide();
          }
          else if($('#interval').val() == 'yearly')
          {
            $('#daily').hide();
            $('#weekly').hide();
            $('#monthly').hide();
            $('#yearly').show();
          }
        });

    $('#type_scheduled').on('change', function (e) {
          if($('#type_scheduled').val() == 'scheduled')
          {
            $('#sched_').show();
            $('#unsched_').hide();
            $('#remine_').hide();
            $('#sched_section').show();
          }
          else if($('#type_scheduled').val() == 'unscheduled')
          {
            $('#sched_').hide();
            $('#unsched_').show();
            $('#remine_').hide();
            $('#sched_section').hide();
          }
          else if($('#type_scheduled').val() == 'reminder')
          {
            $('#sched_').hide();
            $('#unsched_').hide();
            $('#remine_').show();
            $('#sched_section').show();
          }
        });
</script>
<script type="text/javascript">
    $('#recurr_select').on('change', function (e) {
          if($('#recurr_select').val() == 'none')
          {
            $('#recurr_by').hide();
            $('#recurr_after').hide();
          }
          else if($('#recurr_select').val() == 'by')
          {
            $('#recurr_by').show();
            $('#recurr_after').hide();
          }
          else if($('#recurr_select').val() == 'after')
          {
            $('#recurr_by').hide();
            $('#recurr_after').show();
          }
        });

    $('#recurr_account_popup').on('change', function (e) {
          if($('#recurr_account_popup').val() == 'fa fa-plus')
          {
           openAddAccount();
          } 
      });
    $('#recurr_payee_popup').on('change', function (e) {
          if($('#recurr_payee_popup').val() == 'fa fa-plus')
          {
           openPayee();
          } 
      });
</script>
<script type="text/javascript">
    /* Variables */
    var p = 1;
    var row_recurr = $(".participantRecurrRow");

    function addRowRecurr() {
      row_recurr.clone(true, true).removeClass('Recurrhide table-line').appendTo("#participantRecurrTable");
      var index_recurr =$('#participantRecurrTable tr').length -1;
      var final_index_recurr = index_recurr-1;
      $('#participantRecurrTable tr:eq('+index_recurr+')').attr("onclick","trClickRecurr("+final_index_recurr+")");
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(1)').text(index_recurr-1);
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(2)').find('select').attr("id","recurr_expense_account_"+final_index_recurr);
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(2)').find('select').attr("name","recurr_expense_account_"+final_index_recurr);
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(2)').find('div').attr("class","recurr_expense_account_"+final_index_recurr);
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(3)').find('input').attr("id","recurr_descp_"+final_index_recurr);
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(3)').find('input').attr("name","recurr_descp_"+final_index_recurr);
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(3)').find('div').attr("class","recurr_descp_"+final_index_recurr);
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(4)').find('input').attr("id","recurr_service_charge_"+final_index_recurr);
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(4)').find('input').attr("name","recurr_service_charge_"+final_index_recurr);
      $('#participantRecurrTable tr:eq('+index_recurr+') td:eq(4)').find('div').attr("class","recurr_service_charge_"+final_index_recurr);
    }

    function removeRowRecurr(buttonrecurr) {
        console.log(buttonrecurr.closest("tr").text());
      buttonrecurr.closest("tr").remove();
      var totrecurr = $('#recurrtotal').text().substr(9)-buttonrecurr.closest("tr").find('td:eq(4)').text().trim();
      //var totrecurr = $('#recurrtotal').text().substr(9);
      $('#recurrtotal').text('Total : $'+totrecurr);
      if(buttonrecurr.closest("tr").find('td:eq(2)').find('select').hasClass("up_row"))
        {
            var id_to_remove =buttonrecurr.closest("tr").find('td:eq(0)').attr("data-id");
            remove_func_recurr(id_to_remove);
        }
    }
    /* Doc ready */
    $(".add_recurr").on('click', function () {
      if($("#participantRecurrTable tr").length < 17) {
        addRowRecurr();
        var i = Number(p)+1;
        $("#participants").val(i);
      }
      $(this).closest("tr").appendTo("#participantRecurrTable");
      if ($("#participantRecurrTable tr").length === 3) {
        $(".remove_recurr").hide();
      } else {
        $(".remove_recurr").show();
      }
    });
    $(".remove_recurr").on('click', function () {
      if($("#participantRecurrTable tr").length === 3) {
        //alert("Can't remove row.");
        $(".remove_recurr").hide();
      } else if($("#participantRecurrTable tr").length - 1 ==3) {
        $(".remove_recurr").hide();
        removeRowRecurr($(this));
        var i = Number(p)-1;
        $("#participants").val(i);
      } else {
        removeRowRecurr($(this));
        var i = Number(p)-1;
        $("#participants").val(i);
      }
    });
    $("#participants").change(function () {
      var i = 0;
      p = $("#participants").val();
      var rowCount = $("#participantRecurrTable tr").length - 2;
      if(p > rowCount) {
        for(i=rowCount; i<p; i+=1){
          addRowRecurr();
        }
        $("#participantRecurrTable #addButtonRow").appendTo("#participantRecurrTable");
      } else if(p < rowCount) {
      }
    });
    $(".clear_recurr").on('click', function () {
      if($("#participantRecurrTable tr").length - 1 >3) {
        x = 1;
        $('#participantRecurrTable > tbody  > tr').each(function() {
            if(x >3)
            {
                $(this).remove();
                var totrecurr_clear = $('#recurrtotal').text().substr(9)-$(this).closest("tr").find('td:eq(4)').text().trim();
                $('#recurrtotal').text('Total : $'+totrecurr_clear.toFixed(2));
            }
            x = x+1;
        });
      }
    });
</script>
<script type="text/javascript">
    function trClickRecurrMain()
    {
        if($('#recurr_expense_account').css("display")== 'none')
        {
            $('.recurr_expense_account').css('display','none');
            $('#recurr_expense_account').show();
            $('.hidemerecurr').show();
        }
        if($('#recurr_service_charge').attr("type")== 'hidden')
        {
            $('.recurr_service_charge').css('display','none');
            $('#recurr_service_charge').removeAttr('type','hidden');
            $('#recurr_service_charge').attr('type','number');
            $('.hidemerecurr').show();
        }
        if($('#recurr_descp').attr("type")== 'hidden')
        {
            $('.recurr_descp').css('display','none');
            $('#recurr_descp').removeAttr('type','hidden');
            $('.hidemerecurr').show();
        }
    }

    function trClickRecurr(index_recurr)
    {
        if($('#recurr_expense_account_'+index_recurr).css("display")== 'none')
        {
            $('.recurr_expense_account_'+index_recurr).css('display','none');
            $('#recurr_expense_account_'+index_recurr).show();
            $('.hidemerecurr').show();
        }
        if($('#recurr_service_charge_'+index_recurr).attr("type")== 'hidden')
        {
            $('.recurr_service_charge_'+index_recurr).css('display','none');
            $('#recurr_service_charge_'+index_recurr).removeAttr('type','hidden');
            $('#recurr_service_charge_'+index_recurr).attr('type','number');
            $('.hidemerecurr').show();
        }
        if($('#recurr_descp_'+index_recurr).attr("type")== 'hidden')
        {
            $('.recurr_descp_'+index_recurr).css('display','none');
            $('#recurr_descp_'+index_recurr).removeAttr('type','hidden');
            $('.hidemerecurr').show();
        }
    }
    function rightclickRecurr()
    {
        length_recurr =$('#participantRecurrTable tr').length -2;
        $('.recurr_expense_account').show();
        $('.recurr_expense_account').text($('#recurr_expense_account').val());
        $('#recurr_expense_account').css('display','none');
        $('.recurr_service_charge').show();
        $('.recurr_service_charge').text($('#recurr_service_charge').val());
        $('#recurr_service_charge').attr('type','hidden');
        $('.recurr_descp').show();
        $('.recurr_descp').text($('#recurr_descp').val());
        $('#recurr_descp').attr('type','hidden');
        $('.hidemerecurr').hide();

        for(var i = 2 ; i <= length_recurr ; i++)
        {
            $('.recurr_expense_account_'+i).show();
            $('.recurr_expense_account_'+i).text($('#recurr_expense_account_'+i).val());
            $('#recurr_expense_account_'+i).css('display','none');
            $('.recurr_service_charge_'+i).show();
            $('.recurr_service_charge_'+i).text($('#recurr_service_charge_'+i).val());
            $('#recurr_service_charge_'+i).attr('type','hidden');
            $('.recurr_descp_'+i).show();
            $('.recurr_descp_'+i).text($('#recurr_descp_'+i).val());
            $('#recurr_descp_'+i).attr('type','hidden');
        }

        var total_recurr = 0;
        total_recurr += parseInt($('.recurr_service_charge').text());
        for(var i = 2 ; i <= length_recurr ; i++)
        {
            if($('.recurr_service_charge_'+i).text() != '')
            {total_recurr += parseInt($('.recurr_service_charge_'+i).text());}
        }
        $('#recurrtotal').text('Total : $'+total_recurr.toFixed(2));
    }
    function crossClickRecurr()
    {
        length_recurr =$('#participantRecurrTable tr').length -2;
        $('.recurr_expense_account').show();
        $('#recurr_expense_account').css('display','none');
        $('.recurr_service_charge').show();
        $('#recurr_service_charge').attr('type','hidden');
        $('.recurr_descp').show();
        $('#recurr_descp').attr('type','hidden');
        $('.hidemerecurr').hide();
        for(var i = 2 ; i <= length_recurr ; i++)
        {
            $('.recurr_expense_account_'+i).show();
            $('#recurr_expense_account_'+i).css('display','none');
            $('.recurr_service_charge_'+i).show();
            $('#recurr_service_charge_'+i).attr('type','hidden');
            $('.recurr_descp_'+i).show();
            $('#recurr_descp_'+i).attr('type','hidden');
        }
    }
</script>
<script type="text/javascript">
function openPrintNav()
{
    jQuery("#side-menu-print-tx").addClass("open-side-nav");
    jQuery("#side-menu-print-tx").css("width","100%");
    jQuery("#side-menu-print-tx").css("overflow-y","auto");
    jQuery("#side-menu-print-tx").css("overflow-x","hidden");
    jQuery("#overlay-print-tx").addClass("overlay");
}
function closePrintNav() 
{
   
    jQuery("#side-menu-print-tx").removeClass("open-side-nav");
    jQuery("#side-menu-print-tx").css("width","0%");
    jQuery("#overlay-print-tx").removeClass("overlay");
}
</script>
<script type="text/javascript">
    function col_date_print()
    {
        if($('#chk_date_print').attr('checked'))
        {
            $('#chk_date_print').removeAttr('checked');
            $('.date_print').css('display','none');

        }
        else
        {
            $('#chk_date_print').attr('checked',"checked");
            $('.date_print').css('display','');
        }
    }
    function col_type_print()
    {
        if($('#chk_type_print').attr('checked'))
        {
            $('#chk_type_print').removeAttr('checked');
            $('.type_print').css('display','none');

        }
        else
        {
            $('#chk_type_print').attr('checked',"checked");
            $('.type_print').css('display','');
        }
    }
    function col_payee_print()
    {
        if($('#chk_payee_print').attr('checked'))
        {
            $('#chk_payee_print').removeAttr('checked');
            $('.payee_print').css('display','none');

        }
        else
        {
            $('#chk_payee_print').attr('checked',"checked");
            $('.payee_print').css('display','');
        }
    }
    function col_amount_print()
    {
        if($('#chk_amount_print').attr('checked'))
        {
            $('#chk_amount_print').removeAttr('checked');
            $('.amount_print').css('display','none');

        }
        else
        {
            $('#chk_amount_print').attr('checked',"checked");
            $('.amount_print').css('display','');
        }
    }
</script>
<script type="text/javascript">
    $('#print_table').DataTable();
</script>
<script type="text/javascript">
function addnewCheck()
{
    closePrintNav();
    closeCheck();
    addCheck();
}
</script>