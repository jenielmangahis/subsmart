<style>
html { margin: 26px 50px;}
</style>
<div style="font-family:'Times New Roman', Times, serif;">
    <p style="font-weight:bold; text-align:center;font-size:14px;margin-bottom:30px;">IN THE COUNTY COURT, IN AND FOR ESCAMBIA, COUNTY, FLORIDA <br /> SMALL CLAIMS DIVISION</p>
    <table style="width: 100%; margin-bottom: 10px;">
        <tbody>
            <tr>
                <td>
                    <div style="display:block;border-bottom:1px solid;width:200px;font-size:12px;"><?= $post['plaintiff_name']; ?></div>
                    <span style="margin-top:2px;display:block;font-size:12px;">Name</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div style="display:block;border-bottom:1px solid;width:200px;font-size:12px;"><?= $post['plaintiff_adress']; ?></div>
                    <span style="margin-top:2px;display:block;font-size:12px;">Street Address</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div style="display:block;border-bottom:1px solid;width:200px;font-size:12px;"><?= $post['plaintiff_city_state_zip']; ?></div>
                    <span style="margin-top:2px;display:block;font-size:12px;">City, State, Zip</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div style="display:block;border-bottom:1px solid;width:200px;font-size:12px;"><?= $post['plaintiff_phone']; ?></div>
                    <span style="margin-top:2px;display:block;font-size:12px;">Phone</span>
                </td>
            </tr>
            
        </tbody>
    </table>
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <td style="width:50%;"><span style="display-inline-block;margin-left:10px;"><b>Plaintiff</b></span><br />vs.</td>
            <td style="width:50%;">
                CASE NO. : 
                <div style="display:inline-block;border-bottom:1px solid;width:200px;font-size:12px;"><?= $post['soc_case_number']; ?></div><br />
                Division: <?= $post['soc_division']; ?>
            </td>
        </tr>
    </table>
    <table style="width: 100%; margin-top: 20px;">
        <tbody>
            <tr>
                <td>
                    <div style="display:block;border-bottom:1px solid;width:200px;font-size:12px;"><?= $post['defendant_name']; ?></div>
                    <span style="margin-top:2px;display:block;font-size:12px;">Name</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div style="display:block;border-bottom:1px solid;width:200px;font-size:12px;"><?= $post['defendant_adress']; ?></div>
                    <span style="margin-top:2px;display:block;font-size:12px;">Street Address</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div style="display:block;border-bottom:1px solid;width:200px;font-size:12px;"><?= $post['defendant_city_state_zip']; ?></div>
                    <span style="margin-top:2px;display:block;font-size:12px;">City, State, Zip</span><br />
                    <span style="font-weight:bold;display:block;margin-left:20px;">Defendant</span>
                </td>
            </tr>
        </tbody>
    </table>
    <div style="text-align:center;font-weight:bold;font-size:18px;display:block;margin:21px 0px;">STATEMENT OF CLAIM</div>
    <div style="text-align:left;font-size:18px;display:block;margin-left:22px;">Plaintiff, sues defendant, and alleges:</div>
    <div style="margin-left:20px;display:block;font-size:14px;">
        <p style="line-height: 1.6;">WHEREOF, plaintiff demands judgement for damages in the amount of $<span style="display:inline-block;width:150px;border-bottom:1px solid;line-height:11px;padding-left:6px;"><?= number_format($post['soc_damage_amount'],2,".",","); ?></span> and <br />$<span style="display:inline-block;width:150px;border-bottom:1px solid;line-height:11px;padding-left:6px;"><?= number_format($post['soc_court_costs'],2,".",""); ?></span> Court costs plus Sheriff's fees of $<span style="display:inline-block;width:150px;border-bottom:1px solid;line-height:11px;padding-left:6px;"><?= number_format($post['soc_sheriff_fees'],2,".",""); ?></span> against defendant.</p>
    </div>
    <table style="width: 100%; margin-top:20px; margin-bottom: 10px;font-size:14px;">
        <tr>
            <td style="width:50%;"></td>
            <td style="width:50%;">
                <span style="display:block;width:300px;border-bottom:1px solid;"><?= $post['soc_plaintiff_agent']; ?></span>
                Plaintiff (or agent)
            </td>
        </tr>
    </table>
    <div style="text-align:left;font-size:14px;display:block;margin:21px 0px;">STATE OF FLORIDA <br />COUNTY OF ESCAMBIA</div>
    <div style="margin-left:20px;display:block;font-size:14px;">
        <p style="line-height: 1.6;">Before the undersigned authority this day personally appeared PLAINTIFF being first duly sworn on oath, says the foregoing is just and true statement of the amount owing by Defendant to Plaintiff, exclusive of all set-offs and just grounds of defense.<br />Sworn to and subscribed to before this <span style="display:inline-block;width:120px;border-bottom:1px solid;line-height:11px;padding-left:6px;"><?= date("jS"); ?></span> day of <span style="display:inline-block;width:180px;border-bottom:1px solid;line-height:11px;padding-left:6px;"><?= date("F"); ?></span>, <?= date("Y"); ?></p>
    </div>
    <table style="width: 100%; margin-top:20px; margin-bottom: 45px;font-size:14px;">
        <tr>
            <td style="width:50%;"></td>
            <td style="width:50%;">
                <span style="display:block;width:300px;border-bottom:1px solid;"><?= $post['soc_deputy_clerk']; ?></span>
                Notary Public   -   Deputy Clerk <br /><br />
                My Commission expires <span style="display:inline-block;width:130px;border-bottom:1px solid;"><?= $post['commission_expires']; ?></span>
            </td>
        </tr>
    </table>
    <p style="font-weight:bold; text-align:center;font-size:14px;">NOTICE: THIS DOCUMENT REQUIRES AN OFFICIAL COURT SUMMONS WITH SIGNATURE AND THE OFFICIAL COURT SEAL AFFIXED THERETO.</p>
</div>