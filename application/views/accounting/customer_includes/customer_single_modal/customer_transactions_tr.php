<tr>
    <td>
        <div class="form-check">
            <div class="checkbox checkbox-sec margin-right">
                <input type="checkbox" name="single_customer_transaction_check_box[]"
                    id="transaction_<?=$customer_id?>_<?=$invoice_id?>_<?=$invoice_payment_id?>_<?=$sales_receipt_id?>"
                    class="customer_checkbox"
                    data-row-type="<?=$type?>"
                    data-invoice-id="<?=$invoice_id?>"
                    data-row-status="<?=$status?>">
                <label
                    for="transaction_<?=$customer_id?>_<?=$invoice_id?>_<?=$invoice_payment_id?>_<?=$sales_receipt_id?>"><span></span></label>
            </div>
        </div>
    </td>
    <td>
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
    <td data-column="method">
        <?=$method?>
    </td>
    <td data-column="source">
        <?=$source?>
    </td>
    <td data-column="memo">
        <?=$memo?>
    </td>
    <td data-column="duedate">
        <?=date("m/d/Y", strtotime($duedate))?>
    </td>
    <td data-column="aging">
        <?=$aging?>
    </td>
    <td data-column="balance">
        $<?=number_format(($balance), 2)?>
    </td>
    <td>
        $<?=number_format(($total), 2)?>
    </td>
    <td data-column="last-delivered">
        <?=$last_deliverd?>
    </td>
    <td data-column="email">
        <?=$email?>
    </td>
    <td data-column="attachment">
        <?=$attachment?>
    </td>
    <td data-column="status">
        <?=$status?>
    </td>
    <td data-column="ponumber">
        <?=$ponumber?>
    </td>
    <td data-column="sales-rep">
        <?=$sales_rep?>
    </td>
    <td>
        <?php if ($type=="Invoice" && $status=="Paid") {
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
                <li>
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