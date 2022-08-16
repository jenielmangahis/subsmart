<div class="modal fade nsm-modal fade" id="print_accounts_modal" tabindex="-1" aria-labelledby="print_view_customer_list_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Print Customer List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body" id="">
            <?php
                if($tblDefault){
            ?>
            <table class="nsm-table" id="">
                <thead>
                    <tr>
                        <td data-name="Customer">CUSTOMER</td>
                        <td data-name="Phone Numbers">PHONE NUMBERS</td>
                        <td data-name="Email">EMAIL</td>
                        <td data-name="Billing Address">BILLING ADDRESS</td>
                        <td data-name="Shipping Address">SHIPPING ADDRESS</td>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($acs_profile as $acsProfile) : ?>
                    <tr>
                        <td><?= $acsProfile->first_name.' '. $acsProfile->last_name ?></td>
                        <td><?= $acsProfile->phone_h ?></td>
                        <td><?= $acsProfile->email ?></td>
                        <td>Test billing address</td>
                        <td>Test shipping address</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php }else{ ?>
            <table class="nsm-table" id="">
                <thead>
                    <tr>
                    <?php foreach($custExp as $cust) : 
                        
                    ?>
                        <td data-name="Customer"><?= custom($cust) ?></td>
                    <?php 
                        $col='';
                        endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($acs_profile as $acsProfile) : ?>
                    <tr>
                        <td><?= $acsProfile->first_name.' '. $acsProfile->last_name ?></td>
                        <td><?= $acsProfile->phone_h ?></td>
                        <td><?= $acsProfile->state ?></td>
                        <td><?= $acsProfile->email ?></td>
                        <td><?= $acsProfile->status ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="btn_print_accounts_modal" onclick="printTbl()">Print</button>
            </div>
        </div>
    </div>
</div>
