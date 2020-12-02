<div class="card">
    <div class="card-body hid-desk" style="padding-bottom:0px;">
        <div class="col-lg-12">
            <div> <b>Credit Wizard</b> (<?= isset($profile_info) ?  $profile_info->first_name.' '.$profile_info->last_name : '';  ?>) </div>
            <br>
            <div class="formboxtext">
                This is an ideal starting point for every client. You can accomplish all 3 very quickly.
            </div>
            <a href="#">
                <div class="qUickStart">
                    <span class="icon dispute-icon">1</span>
                        <div class="qUickStartde">
                            <h4>ORDER CREDIT HISTORY REPORTS</h4>
                            <span>
                                Contact the 3 Credit Major Bureaus to obtain up-to-date Credit History Reports.
                                It is important that you view them from all 3 bureaus, as the data may differ.
                            </span>
                        </div>
                </div>
            </a>
            <br>
            <a href="#">
                <div class="qUickStart">
                    <span class="icon dispute-icon">2</span>
                    <div class="qUickStartde">
                        <h4>REVIEW CREDIT HISTORY REPORTS</h4>
                            <span>
                                80% of all credit reports contain errors.  Review the reports and look for errors and inaccurate
                                information that may affect your client's credit score.
                            </span>
                    </div>
                </div>
            </a>
            <br>
            <a href="<?= isset($profile_info)? url('/customer/index/tab3/'.$profile_info->prof_id).'/mt3-cdl' : '#'; ?>">
                <div class="qUickStart">
                    <span class="icon dispute-icon">3</span>
                    <div class="qUickStartde">
                        <h4>CREATE DISPUTE LETTERS</h4>
                        <span>
                            Contact credit bureaus and creditors to request that inaccurate and
                            outdated information be immediately removed from your client's credit history report.
                        </span>
                    </div>
                </div>
            </a>

            <center><a id="more_detail_furnisher" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"  data-toggle="collapse" style="color:#1E5DA9;">
                Create a letter for a client (with no dispute items)
            </a></center>
            <div class="collapse" id="collapseExample">
                <p>This tool is only for creating letters that do not have dispute items. If you require dispute items to be merged into your letter, please click on Dispute Wizard 3</p>
                <div class="col-md-12 form-line">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Choose a letter: </label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="furn_address" id="furn_address" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="tips">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td width="5%" valign="top"><img src="https://app.creditrepaircloud.com/application/images/light_bulb.png" alt=" "></td>
                            <td width="95%" align="left" valign="top" class="normaltext1">
                                <strong>Tip: </strong> Standard or Free Annual Reports Credit DO NOT include "scores". Credit "scores" must be purchased directly from the credit bureaus or services.
                                We also provide links for purchasing credit scores on this web page:
                                <a href="http://www.credit-aid.com/resources.htm" target="_blank">www.credit-aid.com/resources.htm</a>.
                                Please do not contact us about your credit reports. We have no affiliation with the credit bureaus and we cannot give legal advice
                                about your personal credit.              </td>
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

    .dispute-icon{
        background-color: #32243d !important;
        font-weight: bold;
        font-size: 40px;
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
    }
    .qUickStart .qUickStartde span{
        opacity: 0.6;
    }
</style>