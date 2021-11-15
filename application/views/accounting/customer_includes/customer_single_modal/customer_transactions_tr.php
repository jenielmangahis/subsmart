<tr>
    <td>
        <div class="form-check">
            <div class="checkbox checkbox-sec margin-right">
                <input type="checkbox" name="single_customer_transaction_check_box[]"
                    id="transaction_<?=$customer_id?>_<?=$invoice_id?>_<?=$invoice_payment_id?>_<?=$sales_receipt_id?>_<?=$deposit_id?>_<?=$estimate_id?>_<?=$credit_memo_id?>_<?=$statement_id?>_<?=$recurring_id?>"
                    class="customer_checkbox"
                    data-row-type="<?=$type?>"
                    data-invoice-id="<?=$invoice_id?>"
                    data-row-status="<?=$status?>"
                    data-invoice-number="<?=$no?>">
                <label
                    for="transaction_<?=$customer_id?>_<?=$invoice_id?>_<?=$invoice_payment_id?>_<?=$sales_receipt_id?>_<?=$deposit_id?>_<?=$estimate_id?>_<?=$credit_memo_id?>_<?=$statement_id?>_<?=$recurring_id?>"><span></span></label>
            </div>
        </div>
    </td>
    <td data-column="date">
        <?=date("m/d/Y", strtotime($date))?>
    </td>
    <td data-column="type">
        <?=$type?>
    </td>
    <td data-column="no">
        <?=$no?>
    </td>
    <td data-column="customer">
        <?=$customer?>
    </td>
    <td data-column="start-date">
        <?=$start_date?>
    </td>
    <td data-column="end-date">
        <?=$end_date?>
    </td>
    <td data-column="statement-type">
        <?=$statement_type?>
    </td>
    <td data-column="method">
        <?=$method?>
    </td>
    <td data-column="expiration-date">
        <?=$expiration_date?>
    </td>
    <td data-column="source">
        <?=$source?>
    </td>
    <td data-column="memo">
        <?=$memo?>
    </td>
    <td data-column="duedate">
        <?php if ($duedate!="") {
    echo date("m/d/Y", strtotime($duedate));
}?>
    </td>
    <td data-column="aging">
        <?=$aging?>
    </td>
    <td data-column="balance">
        <?php
        if ($balance!="") {
            echo "$ ".number_format(($balance), 2);
        }
        ?>
    </td>
    <td data-column="total">
        <?php
        if ($total!="") {
            echo "$ ".number_format(($total), 2);
        }
        ?>
    </td>
    <td data-column="last-delivered">
        <?=$last_deliverd?>
    </td>
    <td data-column="email">
        <?=$email?>
    </td>
    <td data-column="accepted-by">
        <?=$accepted_by?>
    </td>
    <td data-column="accepted-date">
        <?=$accepted_date?>
    </td>
    <td data-column="attachment">
        <?=$attachment?>
    </td>
    <td data-column="status">
        <?php if ($type == "Deposit" && $status==1) {
            echo "Success";
        } elseif ($type == "Credit memo" && $status==1) {
            echo "Active";
        } else {
            echo $status;
        }?>
    </td>
    <td data-column="ponumber">
        <?=$ponumber?>
    </td>
    <?php
    if ($filtered_type == "Recurring templates") {
        ?>
    <td data-column="txn-type">
        <?=$txn_type?>
    </td>
    <td data-column="interval">
        <?=$interval?>
    </td>
    <td data-column="prev-date">
    <?php
        if ($prev_date!="") {
            echo date("m/d/Y", strtotime($prev_date));
        }
    ?>
    </td>
    <td data-column="next-date">
        <?php
        if($next_date!=""){
            echo date("m/d/Y", strtotime($next_date));
        }
        ?>
    </td>
    <td data-column="amount">
        <?php 
        if ($amount!="") {
            echo "$ ".number_format(($amount), 2);
        }
        ?>
    </td>
    <?php
    }
    ?>
    <td data-column="sales-rep">
        <?=$sales_rep?>
    </td>
    <td data-column="action">

        <?php
        if ($type == "Deposit") {
            ?>
        <a href="javascript:void(0)" class="print-deposit-btn"
            data-invoice-no="<?=$no?>"
            data-invoice-id="<?=$invoice_id?>">Print</a>
        <?php
        } elseif ($type == "Estimate") {
            ?>
        <a href="javascript:void(0)" class="print-estimate-btn"
            data-invoice-no="<?=$no?>"
            data-invoice-id="<?=$invoice_id?>">Print</a>
        <?php
        } elseif ($type == "Credit memo") {
            ?>
        <a href="javascript:void(0)" class="print-credit-memo-btn"
            data-invoice-no="<?=$no?>"
            data-invoice-id="<?=$invoice_id?>">Print</a>
        <?php
        } elseif ($type == "Transaction Statement") {
            ?>
        <a href="javascript:void(0)" class="print-statement-btn"
            type="<?=ucwords(str_replace(" ", "_", $type))?>"
            data-statement-id="<?=$statement_id?>">Print</a>
        <?php
        } elseif ($type=="Invoice" && $status=="Paid") {
            ?>
        <div class="dropdown dropdown-btn text-right">
            <a href="javascript:void(0)" class="print-invoice-btn"
                data-invoice-no="<?=$no?>"
                data-invoice-id="<?=$invoice_id?>">Print</a>
            <a type="button" data-toggle="dropdown">
                <span class="btn-label"><i class="fa fa-caret-down fa-sm"></i></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right customer-dropdown-menu" role="menu"
                aria-labelledby="dropdown-edit">
                <li class="send-invoice-btn" data-invoice-id="<?=$invoice_id?>">
                    <a role="menuitem" tabindex="-1" href="javascript:void(0)">
                        Send
                    </a>
                </li>
                <li class="share-invoice-link-btn"
                    data-invoice-id="<?=$invoice_id?>">
                    <a role="menuitem" tabindex="-1" href="javascript:void(0)">
                        Share invoice link
                    </a>
                </li>
                <li>
                    <a role="menuitem" tabindex="-1" href="javascript:void(0)" class="print-invoice-packaging-slip-btn"
                        data-invoice-no="<?=$no?>"
                        data-invoice-id="<?=$invoice_id?>">
                        Print packaging slip
                    </a>
                </li>
                <li>
                    <a role="menuitem" tabindex="-1"
                        href="<?=base_url("invoice/genview/".$invoice_id)?>">
                        View/edit
                    </a>
                </li>
                <li class="copy-invoice-btn"
                    data-invoice-id="<?=$invoice_id?>">
                    <a role="menuitem" tabindex="-1" href="javascript:void(0)">
                        Copy
                    </a>
                </li>
                <li class="delete-invoice-btn"
                    data-invoice-id="<?=$invoice_id?>">
                    <a role="menuitem" tabindex="-1" href="javascript:void(0)">
                        Delete
                    </a>
                </li>
                <li class="void-invoice-btn"
                    data-invoice-id="<?=$invoice_id?>">
                    <a role="menuitem" tabindex="-1" href="javascript:void(0)">
                        Void
                    </a>
                </li>

            </ul>
        </div>
        <?php
        } elseif ($type=="Invoice" && ($status=="Open" || $status=="Overdue")) {
            ?>
        <div class="dropdown dropdown-btn text-right">
            <a href="" class="first-option customer_receive_payment_btn"
                data-customer-id="<?=$customer_id?>">Receive payment
            </a>
            <a type="button" id="dropdown-button-icon" data-toggle="dropdown">
                <span class="btn-label"><i class="fa fa-caret-down fa-sm"></i></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right customer-dropdown-menu" role="menu"
                aria-labelledby="dropdown-edit">
                <li class="print-invoice-btn"
                    data-invoice-no="<?=$no?>"
                    data-invoice-id="<?=$invoice_id?>">
                    <a role="menuitem" tabindex="-1" href="javascript:void(0)">
                        Print
                    </a>
                </li>
                <li>
                    <a role="menuitem" tabindex="-1" href="javascript:void(0)">
                        Send
                    </a>
                </li>
                <li>
                    <a role="menuitem" tabindex="-1" href="javascript:void(0)" class="send-reminder-btn"
                        data-invoice-number="<?=$no?>"
                        data-action-from="single-customer-view-modal"
                        data-customer-id="<?=$customer_id?>">
                        Send reminder
                    </a>
                </li>
                <li class="share-invoice-link-btn"
                    data-invoice-id="<?=$invoice_id?>">
                    <a role="menuitem" tabindex="-1" href="javascript:void(0)">
                        Share invoice link
                    </a>
                </li>
                <li class="print-invoice-packaging-slip-btn"
                    data-invoice-no="<?=$no?>"
                    data-invoice-id="<?=$invoice_id?>">
                    <a role="menuitem" tabindex="-1" href="javascript:void(0)">
                        Print package slip
                    </a>
                </li>
                <li>
                    <a role="menuitem" tabindex="-1"
                        href="<?=base_url("invoice/genview/".$invoice_id)?>">
                        View/Edit
                    </a>
                </li>
                <li class="copy-invoice-btn"
                    data-invoice-id="<?=$invoice_id?>">
                    <a role="menuitem" tabindex="-1" href="javascript:void(0)">
                        Copy
                    </a>
                </li>
                <li class="delete-invoice-btn"
                    data-invoice-id="<?=$invoice_id?>">
                    <a role="menuitem" tabindex="-1" href="javascript:void(0)">
                        Delete
                    </a>
                </li>
                <li class="void-invoice-btn"
                    data-invoice-id="<?=$invoice_id?>">
                    <a role="menuitem" tabindex="-1" href="javascript:void(0)">
                        Void
                    </a>
                </li>
            </ul>
        </div>
        <?php
        } ?>
    </td>
</tr>