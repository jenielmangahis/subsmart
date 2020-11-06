<?php if ($minitab=='mt4-2'): ?>
<div class="card">
    <div class="card-body hid-desk" style="padding-bottom:0px;">
        <form id="form_creditor_furnisher">
            <div class="col-lg-12">
                <div> <b>Add New Item</b> (<?= isset($profile_info) ?  $profile_info->first_name.' '.$profile_info->last_name : '';  ?>) </div>
                <br><br>

                <div class="col-md-12 form-line">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">Select credit bureau(s):</label><span class="required"> *</span>
                        </div>
                        <div class="col-md-8">
                            <input type="checkbox" class="bureau_checkbox" name="di_bureau_id[]" value="1" id="bu1">
                            <label for="portal_status1">
                                <img alt="" src="/assets/img/customer/images/equifax.png" class="" style="height:16px;width: 63px;vertical-align:middle;">
                            </label>

                            <input type="checkbox" class="bureau_checkbox" name="di_bureau_id[]" value="2" id="bu2" >
                            <label for="portal_status1">
                                <img alt="" src="/assets/img/customer/images/experian.png" class="" style="height:16px;width: 63px;vertical-align:middle;">
                            </label>

                            <input type="checkbox" class="bureau_checkbox" name="di_bureau_id[]" value="3" id="bu3" >
                            <label for="portal_status1">
                                <img alt="" src="/assets/img/customer/images/trans_union.png" class="" style="height:16px;width: 63px;vertical-align:middle;">
                            </label>

                        </div>
                    </div>
                </div>
                <div class="col-md-12 form-line">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">Creditor/furnisher:</label>
                        </div>
                        <div class="col-md-2">
                            <select id="furnish_id" name="furnish_id"  class="form-control">
                                <option value="">Select Furnishers</option>
                                <?php foreach ($furnishers as $furnish): ?>
                                    <option <?php if(isset($profile_info)){ if($furnish->furn_id == ""){ echo 'selected'; } } ?> value="<?= $furnish->furn_id; ?>"><?= $furnish->furn_name; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding-top: 5px;">
                           <a class="dispute_link" id="add_furnishers" href="javascript:void(0);">Add creditor/furnisher</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 form-line">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">Account number:</label>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="save_date" id="" value="" />
                        </div>
                        <div class="col-md-2" style="padding-top: 5px;">
                            <a class="dispute_link" href="#">Different for each bureau </a> (Optional)
                        </div>
                    </div>
                </div>
                <div class="col-md-12 form-line">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">Reason:</label> <span class="required"> *</span>
                        </div>
                        <div class="col-md-6">
                            <select id="language" name="language"  class="form-control" required>
                                <option value="">Choose a reason for your dispute</option>
                                <?php foreach ($reasons as $reason): ?>
                                    <option <?php if(isset($profile_info)){ if($reason->reason_id == ""){ echo 'selected'; } } ?> value="<?= $reason->reason_id; ?>"><?= $reason->reason; ?></option>
                                <?php endforeach ?>
                            </select>
                            <small>(if you can't find an appropriate reason. choose "other information i would like to changed")</small>
                        </div>
                        <div class="col-md-2" style="padding-top: 5px;">
                            <a class="dispute_link" id="add_reasons" href="javascript:void(0);">Manage reasons</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 form-line">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">Instruction:</label>
                        </div>
                        <div class="col-md-6">
                            <select name="explanation_cmb" id="explanation_cmb" class="form-control">
                                <option value="">Choose instructions</option>
                                <option value="Please correct/update this inaccurate information on my credit report.">Please correct/update this inaccurate information on my credit report.</option>
                                <option value="Please remove this inaccurate information from my credit report.">Please remove this inaccurate information from my credit report.</option>
                                <option value="Please remove it from my credit report.">Please remove it from my credit report.</option>
                                <option value="This is not mine. I am a victim of ID Theft and I have included a police report. Please investigate and remove from my credit report.">This is not mine. I am a victim of ID Theft and I have included a police report. Please investigate and remove from my credit report.</option>
                                <option value="Please supply information on how you have verified this item.">Please supply information on how you have verified this item.</option>
                                <option value="This is not mine.">This is not mine.</option>
                                <option value="My parent has the same name as me.">My parent has the same name as me.</option>
                                <option value="Please investigate and delete from my credit report.">Please investigate and delete from my credit report.</option>
                                <option value="Please ensure that all information is accurate">Please ensure that all information is accurate</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding-top: 5px;">
                            <a class="dispute_link" href="#">Add new instruction
                            </a>
                        </div>
                    </div>
                </div>
                <input type="hidden" class="form-control" name="fk_prof_id" id="fk_prof_id" value="<?= isset($profile_info) ? $profile_info->prof_id : '' ?>" />
                <br> <br>
                <div class="col-md-12 form-line">
                    <div class="row">
                        <div class="col-md-12">
                            <a id="more_detail_furnisher" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"  data-toggle="collapse" style="color:#1E5DA9;">+More detail</a>(Optional)
                            <br><br>
                            <div class="collapse" id="collapseExample">
                                <div > <b><span>Choose mode:</span></b>
                                    <input type="radio" class="" name="extypeselection" id="extypeselection_sforall" onclick="handleClick(this);" value="same">
                                    <label for="extypeselection_sforall"><b>Same for all bureaus</b></label>
                                    &nbsp;&nbsp;
                                    <input type="radio" class=""  name="extypeselection" id="extypeselection_dforeach" onclick="handleClick(this);" value="diff">
                                    <label for="extypeselection_dforeach"><b>Different for each bureau</b></label>
                                </div>
                                <div class="card" id="different_details" style="display: none;">
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4" id="equifax_details" style="display: none;">
                                                    <center><img alt="" src="/assets/img/customer/images/equifax.png" class="fieldset-img-1 mode_images"></center>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="item_details">
                                                                <table width="100%" cellpadding="0" cellspacing="3">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="left" width="100%">Status: </td>
                                                                            <td align="right" >
                                                                                <select name="status_bureaus[]" id="status_bureaus_1" class="form-control" style="width:200px">
                                                                                    <option value="">Select</option>
                                                                                    <option value="1">Positive</option>
                                                                                    <option value="2">Negative</option>
                                                                                    <option value="3">Repaired</option>
                                                                                    <option value="4">Deleted</option>
                                                                                    <option value="5">In Dispute</option>
                                                                                    <option value="6">Verified</option>
                                                                                    <option value="7">Updated</option>
                                                                                    <option value="8">Unspecified</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left" width="100%">Account Name: </td>
                                                                            <td align="right" width="20%">
                                                                                <input type="text" class="form-control" name="subject" id="subject" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left" width="100%">Date Reported: </td>
                                                                            <td align="right">
                                                                                <input type="text" class="form-control" name="subject" id="subject" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left">Last Activity: </td>
                                                                            <td align="right">
                                                                                <input type="text" class="form-control" name="subject" id="subject" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left">Amount: </td>
                                                                            <td align="right">
                                                                                <input type="text" class="form-control" name="subject" id="subject" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left">Plaintiff: </td>
                                                                            <td align="right">
                                                                                <input type="text" class="form-control" name="subject" id="subject" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left">ECOA: </td>
                                                                            <td align="right">
                                                                                <input type="text" class="form-control" name="subject" id="subject" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left">Date Filed: </td>
                                                                            <td align="right">
                                                                                <input type="text" class="form-control" name="subject" id="subject" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left">Account Type: </td>
                                                                            <td align="right">
                                                                                <input type="text" class="form-control" name="subject" id="subject" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left">Account Status: </td>
                                                                            <td align="right">
                                                                                <input type="text" class="form-control" name="subject" id="subject" />
                                                                            </td>
                                                                        </tr><tr>
                                                                            <td align="left">Monthly Payment: </td>
                                                                            <td align="right">
                                                                                <input type="text" class="form-control" name="subject" id="subject" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left">Date Opened: </td>
                                                                            <td align="right">
                                                                                <input type="text" class="form-control" name="subject" id="subject" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left">Balance: </td>
                                                                            <td align="right">
                                                                                <input type="text" class="form-control" name="subject" id="subject" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left">Term: </td>
                                                                            <td align="right">
                                                                                <input type="text" class="form-control" name="subject" id="subject" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left">High Balance: </td>
                                                                            <td align="right">
                                                                                <input type="text" class="form-control" name="subject" id="subject" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left">Limit: </td>
                                                                            <td align="right">
                                                                                <input type="text" class="form-control" name="subject" id="subject" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left">Past Due: </td>
                                                                            <td align="right">
                                                                                <input type="text" class="form-control" name="subject" id="subject" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left">Payment Status: </td>
                                                                            <td align="right">
                                                                                <input type="text" class="form-control" name="subject" id="subject" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left">Comment: </td>
                                                                            <td align="right">
                                                                                <input type="text" class="form-control" name="subject" id="subject" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left" width="100%">Address: </td>
                                                                            <td align="left">
                                                                                <textarea class="form-control" name="address_bureau[]" style="height: 50px !important;" id="address_1"></textarea>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left">Internal Note: </td>
                                                                            <td align="left">
                                                                                <textarea class="form-control" name="address_bureau[]" style="height: 50px !important;" id="address_1"></textarea>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4" id="experian_details" style="display: none;">
                                                    <center><img alt="" src="/assets/img/customer/images/experian.png" class="fieldset-img-1 mode_images"></center>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="item_details">
                                                                <table width="100%" cellpadding="0" cellspacing="3">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td align="left" width="100%">Status: </td>
                                                                        <td align="right" >
                                                                            <select name="status_bureaus[]" id="status_bureaus_1" class="form-control" style="width:200px">
                                                                                <option value="">Select</option>
                                                                                <option value="1">Positive</option>
                                                                                <option value="2">Negative</option>
                                                                                <option value="3">Repaired</option>
                                                                                <option value="4">Deleted</option>
                                                                                <option value="5">In Dispute</option>
                                                                                <option value="6">Verified</option>
                                                                                <option value="7">Updated</option>
                                                                                <option value="8">Unspecified</option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left" width="100%">Account Name: </td>
                                                                        <td align="right" width="20%">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left" width="100%">Date Reported: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Last Activity: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Amount: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Plaintiff: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">ECOA: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Date Filed: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Account Type: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Account Status: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr><tr>
                                                                        <td align="left">Monthly Payment: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Date Opened: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Balance: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Term: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">High Balance: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Limit: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Past Due: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Payment Status: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Comment: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left" width="100%">Address: </td>
                                                                        <td align="left">
                                                                            <textarea class="form-control" name="address_bureau[]" style="height: 50px !important;" id="address_1"></textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Internal Note: </td>
                                                                        <td align="left">
                                                                            <textarea class="form-control" name="address_bureau[]" style="height: 50px !important;" id="address_1"></textarea>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4" id="transunion_details" style="display: none;">
                                                    <center><img alt="" src="/assets/img/customer/images/trans_union.png" class="fieldset-img-1 mode_images"></center>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="item_details">
                                                                <table width="100%" cellpadding="0" cellspacing="3">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td align="left" width="100%">Status: </td>
                                                                        <td align="right" >
                                                                            <select name="status_bureaus[]" id="status_bureaus_1" class="form-control" style="width:200px">
                                                                                <option value="">Select</option>
                                                                                <option value="1">Positive</option>
                                                                                <option value="2">Negative</option>
                                                                                <option value="3">Repaired</option>
                                                                                <option value="4">Deleted</option>
                                                                                <option value="5">In Dispute</option>
                                                                                <option value="6">Verified</option>
                                                                                <option value="7">Updated</option>
                                                                                <option value="8">Unspecified</option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left" width="100%">Account Name: </td>
                                                                        <td align="right" width="20%">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left" width="100%">Date Reported: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Last Activity: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Amount: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Plaintiff: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">ECOA: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Date Filed: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Account Type: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Account Status: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr><tr>
                                                                        <td align="left">Monthly Payment: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Date Opened: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Balance: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Term: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">High Balance: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Limit: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Past Due: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Payment Status: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Comment: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left" width="100%">Address: </td>
                                                                        <td align="left">
                                                                            <textarea class="form-control" name="address_bureau[]" style="height: 50px !important;" id="address_1"></textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Internal Note: </td>
                                                                        <td align="left">
                                                                            <textarea class="form-control" name="address_bureau[]" style="height: 50px !important;" id="address_1"></textarea>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card" id="same_all_details" style="display: none;">
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <center>
                                                        <img alt="" style="display: none;" id="equifax_details_same" src="/assets/img/customer/images/equifax.png" class="fieldset-img-1 mode_images">
                                                        <img alt="" style="display: none;" id="experian_details_same" src="/assets/img/customer/images/experian.png" class="fieldset-img-1 mode_images">
                                                        <img alt="" style="display: none;" id="transunion_details_same" src="/assets/img/customer/images/trans_union.png" class="fieldset-img-1 mode_images">
                                                    </center>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="item_details">
                                                                <table width="100%" cellpadding="0" cellspacing="3">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td align="left" width="100%">Status: </td>
                                                                        <td align="right" >
                                                                            <select name="status_bureaus[]" id="status_bureaus_1" class="form-control" style="width:200px">
                                                                                <option value="">Select</option>
                                                                                <option value="1">Positive</option>
                                                                                <option value="2">Negative</option>
                                                                                <option value="3">Repaired</option>
                                                                                <option value="4">Deleted</option>
                                                                                <option value="5">In Dispute</option>
                                                                                <option value="6">Verified</option>
                                                                                <option value="7">Updated</option>
                                                                                <option value="8">Unspecified</option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left" width="100%">Account Name: </td>
                                                                        <td align="right" width="20%">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left" width="100%">Date Reported: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Last Activity: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Amount: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Plaintiff: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">ECOA: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Date Filed: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Account Type: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Account Status: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr><tr>
                                                                        <td align="left">Monthly Payment: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Date Opened: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Balance: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Term: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">High Balance: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Limit: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Past Due: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Payment Status: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Comment: </td>
                                                                        <td align="right">
                                                                            <input type="text" class="form-control" name="subject" id="subject" />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left" width="100%">Address: </td>
                                                                        <td align="left">
                                                                            <textarea class="form-control" name="address_bureau[]" style="height: 50px !important;" id="address_1"></textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Internal Note: </td>
                                                                        <td align="left">
                                                                            <textarea class="form-control" name="address_bureau[]" style="height: 50px !important;" id="address_1"></textarea>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br> <br>
                <div class="col-md-12">
                    <div class="row">
                        <a href="<?= isset($profile_info)? url('/customer/index/tab3/'.$profile_info->prof_id).'/mt4' : '#'; ?>">
                            <button type="button" class="btn btn-primary btn-md "><span class="fa fa-remove"></span> Cancel </button> &nbsp;
                        </a>
                        <button type="submit" class="btn btn-primary btn-md" name="" id="" ><span class="fa fa-paper-plane-o"></span> Save </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php else: ?>
    <div class="card">
        <div class="card-body hid-desk" style="padding-bottom:0px;">
            <div class="col-lg-12">
                <div> <b>All Dispute Items</b> (<?= isset($profile_info) ?  $profile_info->first_name.' '.$profile_info->last_name : '';  ?>) </div>

                <div class="float-right d-md-block">
                    <div class="dropdown">
                        <a class="btn btn-primary btn-md" href="<?= isset($profile_info)? url('/customer/index/tab3/'.$profile_info->prof_id).'/mt4-2' : '#'; ?>"><span class="fa fa-plus"></span> Add New Item</a>
                    </div>
                </div>
                <br> <br>
                <table class="table table-hover" id="dispute_table">
                    <thead>
                    <tr>
                        <th >Date</th>
                        <th>Creditor/Furnisher</th>
                        <th>Account #:</th>
                        <th>Reason</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php //foreach ($profiles as $customer) : ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="" style="text-decoration:none;display:inline-block;" title="Edit Customer">
                                <img src="/assets/img/customer/actions/ac_edit.png" width="16px" height="16px" border="0" title="Edit Customer">
                            </a>
                            <a href="javascript:void(0);" id="" class="delete_lead" style="text-decoration:none;display:inline-block;" title="Edit Customer">
                                <img src="/assets/img/customer/actions/cross.png" width="16px" height="16px" border="0" title="Delete Lead">
                            </a>
                        </td>
                    </tr>
                    <?php //endforeach; ?>
                    </tbody>
                </table>
                <div class="tips">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td width="5%" valign="top"><img src="https://app.creditrepaircloud.com/application/images/light_bulb.png" alt=" "></td>
                            <td width="95%" align="left" valign="top" class="normaltext1">
                                Above are all credit report items you've saved or imported for this client. View this page in List View or Report View.
                                To create a dispute letter for any of these items, run Wizard 3 and choose "Add Saved Item." When you save a dispute letter in Wizard 3,
                                status of the item automatically changes to "In Dispute."
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <style>
        .tips {
            background-color: #f9f9f9;
            margin: 20px auto;
            padding: 10px;
        }
        .qUickStart{
            /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#fcfcfc+0,eaeaea+100 */
            background: #fcfcfc; /* Old browsers */
            background: -moz-linear-gradient(top,  #fcfcfc 0%, #eaeaea 100%); /* FF3.6-15 */
            background: -webkit-linear-gradient(top,  #fcfcfc 0%,#eaeaea 100%); /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom,  #fcfcfc 0%,#eaeaea 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfcfc', endColorstr='#eaeaea',GradientType=0 ); /* IE6-9 */
            display: flex;
            align-items: center;
            padding: 16px;
            border-radius: 4px;
            border: 1px solid #ddd;
            margin-bottom:15px;
        }
        .qUickStart:last-child{
            margin-bottom:0px;
        }
        .qUickStart .icon{
            background:#2d1a3e !important;
            flex: 0 0 70px;
            height: 70px;
            border-radius: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            color:#fff;
            margin-right: 10px;
        }
        .qUickStart .qUickStartde h4{
            font-size: 16px;
            text-transform: uppercase;
            font-weight: 700;
            margin: 0;
            margin-bottom: 0px;
            margin-bottom: 6px;
        }
        .qUickStart .qUickStartde span{
            opacity: 0.6;
        }
    </style>
<?php endif; ?>

<style>
    .item_details tr {
        line-height: 33.5px;
    }
    .mode_images{
        border: #ddd solid 1px;
        padding: 5px;
        background-color: #FFFFFF;
        display: inline-block;
    }
</style>

