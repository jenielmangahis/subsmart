<div class="card">
    <div class="card-body hid-desk" style="padding-bottom:0px;">
        <div class="col-lg-12">
            <div> <b>Credit Wizard</b> (<?= isset($profile_info) ?  $profile_info->first_name.' '.$profile_info->last_name : '';  ?>) </div>
            <br>
            <div class="float-right">
                    <select class="input_select" name="library_category" id="library_category"  style="display: inline-block;">
                        <option value="0">All</option>
                        <?php
                        foreach($library_categories as $library){
                            ?>
                            <option value="<?=$library->pk_esignLibraryMaster ?>"><?=$library->libraryName?></option>
                            <?php
                        }
                        ?>
                    </select>
                <a style="display: inline-block;" class="btn btn-primary btn-md " href="<?= base_url('esign/templateLibrary'); ?> "> <span class="fa fa-plus"></span> Add New</a>

            </div>
            <br>
            <br>
            <table class="table table-hover" id="dispute_table">
                <thead>
                    <tr>
                        <th>Letter Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($library_templates as $lt) : ?>
                        <tr>
                            <td><?= $lt->title; ?></td>
                            <td><?= $lt->category_id; ?></td>
                            <td><?= $lt->isActive==1 ? 'Active' : 'In Active'; ?></td>
                            <td>
                                <a href="<?= isset($profile_info) ? url('/customer/index/tab3/'.$profile_info->prof_id).'/mt3-cdl'.'/'.$lt->esignLibraryTemplateId : '#'; ?>" style="text-decoration:none;display:inline-block;" title="Create Letter">
                                    <img src="/assets/img/customer/actions/ac_edit.png" width="16px" height="16px" border="0" title="Create Letter">
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <div class="float-left d-md-block">
                <div class="dropdown">
                    <a class="btn btn-primary btn-md" href="<?= isset($profile_info)? url('/customer/index/tab3/'.$profile_info->prof_id).'/mt3' : '#'; ?>">
                        <span class="fa fa-arrow-left"></span> Back</a>
                </div>
            </div>
            <br>
            <div class="tips">
                <b>Wizard 3</b> is where you generate all dispute letters for clients. It auto-merges client/credit data into a letter in seconds.
                All new clients start with a Round 1 Dispute. Next "Add New Items" manually or "Add Saved/Pending Items."
                For editing or updating dispute items already saved, use the Dispute Items Page.
            </div>
            <div class="tips">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td width="5%" valign="top">
                                <img src="https://app.creditrepaircloud.com/application/images/light_bulb.png" alt=" ">
                            </td>
                            <td width="95%" align="left" valign="top" class="normaltext1">
                                <strong>Tip: We recommend never sending more than 5 dispute items per month to each credit bureau </strong>
                                (unless it's Identity Theft and you are including a police report), otherwise the bureaus may mark your disputes as
                                "frivolous and irrelevant" and reject them. Most credit repair firms dispute 2-5 items per bureau per month.
                                When sending a Round 1 letter to credit bureaus, always include a copy of client's photo ID and utility bill.
                                There is no need to send photo ID and utility bill with later rounds of letters. This wizard is an awesome tool.
                                To learn to use it, watch the 2 Quick Videos above.
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
</style>