<?php if ($minitab=='mt4-2'): ?>
<div class="card">
    <div class="card-body hid-desk" style="padding-bottom:0px;">
        <div class="col-lg-12">
            <div> <b>Add New Item</b> (<?= isset($profile_info) ?  $profile_info->first_name.' '.$profile_info->last_name : '';  ?>) </div>
            <br><br>

            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-2">
                        <label for="">Select credit bureau(s):</label><span class="required"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="checkbox" name="portal_status" value="1" id="portal_status1" >
                        <label for="portal_status1">
                            <img alt="" src="/assets/img/customer/images/equifax.png" class="" style="height:16px;width: 63px;vertical-align:middle;">
                        </label>

                        <input type="checkbox" name="portal_status" value="1" id="portal_status1" >
                        <label for="portal_status1">
                            <img alt="" src="/assets/img/customer/images/experian.png" class="" style="height:16px;width: 63px;vertical-align:middle;">
                        </label>

                        <input type="checkbox" name="portal_status" value="1" id="portal_status1" >
                        <label for="portal_status1">
                            <img alt="" src="/assets/img/customer/images/trans_union.png" class="" style="height:16px;width: 63px;vertical-align:middle;">
                        </label>

                    </div>
                </div>
            </div>
            <div class="col-md-12 form-line">
                <div class="row">
                    <div class="col-md-2">
                        <label for="">Creditor/furnisher:</label> <span class="required"> *</span>
                    </div>
                    <div class="col-md-2">
                        <select id="language" name="language"  class="form-control">
                            <option value="">Select Furnishers</option>
                            <?php foreach ($furnishers as $furnish): ?>
                                <option <?php if(isset($profile_info)){ if($furnish->furn_id == 1){ echo 'selected'; } } ?> value="<?= $furnish->furn_id; ?>"><?= $furnish->furn_name; ?></option>
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
                        <select id="language" name="language"  class="form-control">
                            <option value="">Choose a reason for your dispute</option>
                            <?php foreach ($reasons as $reason): ?>
                                <option <?php if(isset($profile_info)){ if($reason->reason_id == 1){ echo 'selected'; } } ?> value="<?= $reason->reason_id; ?>"><?= $reason->reason; ?></option>
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
                        <label for="">Instruction:</label> <span class="required"> *</span>
                    </div>
                    <div class="col-md-6">
                        <select id="language" name="language"  class="form-control">
                            <option <?php if(isset($office_info)){ if($office_info->language == ""){ echo 'selected'; } } ?> value="">Select</option>
                            <option <?php if(isset($office_info)){ if($office_info->language == "English"){ echo 'selected'; } } ?> value="English">English</option>
                            <option <?php if(isset($office_info)){ if($office_info->language == "Spanish"){ echo 'selected'; } } ?> value="Spanish">Spanish</option>
                            <option <?php if(isset($office_info)){ if($office_info->language == "Mandarin Chinese"){ echo 'selected'; } } ?> value="Mandarin Chinese">Mandarin Chinese</option>
                            <option <?php if(isset($office_info)){ if($office_info->language == "French"){ echo 'selected'; } } ?> value="French">French</option>
                        </select>
                    </div>
                    <div class="col-md-2" style="padding-top: 5px;">
                        <a class="dispute_link" href="#">Add new instruction
                        </a>
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
    </div>
</div>

<?php endif; ?>

<?php if ($minitab=='mt4' || $minitab==''): ?>
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