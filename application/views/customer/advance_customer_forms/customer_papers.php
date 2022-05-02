<div class="col-md-12">
    <table cellpadding="0" cellspacing="0">
        <tbody>
        <tr>
            <td  class="table_head_customer">
                <b>Rep Paper</b>
            </td>
            <td class="table_head_customer">
                <b>Tech Paper</b>
            </td>
            <td class="table_head_customer" >
                <b>Scanned</b>
            </td>
            <td class="table_head_customer">
                <b>Paperwork</b>
            </td>
            <td class="table_head_customer" >
                <b>Submitted</b>
            </td>
            <td class="table_head_customer" >
                <b>Rep Paid</b>
            </td>
            <td class="table_head_customer">
                <b>Tech Paid</b>
            </td>
            <td class="table_head_customer" >
                <b>Funded</b>
            </td>
            <td class="table_head_customer" >
                <b>Charged Back</b>
            </td>
        </tr>
        <tr>
            <td align="center" class="table_body_customer">
                <div class="row">
                    <div class="col-md-2 header_checkbox" >
                        <input <?= isset($papers->rep_paper_date) ? "checked" : "" ?> data-type="header_date_checkbox" type="checkbox" class="form-controls date_checkbox" value="rep_paper_date"  id="rep_paper" >
                    </div>
                    <div class="col-md-8">
                        <input value="<?= isset($papers->rep_paper_date) ? $papers->rep_paper_date : "" ?>" data-type="header_date_input" type="text" class="mini-input date_picker" name="rep_paper_date" id="rep_paper_date" <?= isset($papers->rep_paper_date) ? "" : "disabled" ?>/>
                    </div>
                </div>
            </td>
            <td align="center" class="table_body_customer">
                <div class="row">
                    <div class="col-md-2 header_checkbox" >
                        <input <?= isset($papers->tech_paper_date) ? "checked" : "" ?> data-type="header_date_checkbox" type="checkbox" name="rep_paper" class="form-controls date_checkbox" value="tech_paper_date">
                    </div>
                    <div class="col-md-8">
                        <input value="<?= isset($papers->tech_paper_date) ? $papers->tech_paper_date : "" ?>" data-type="header_date_input" type="text" class="mini-input date_picker" name="tech_paper_date" id="tech_paper_date" <?= isset($papers->tech_paper_date) ? "" : "disabled" ?>/>
                    </div>
                </div>
            </td>
            <td align="center" class="table_body_customer">
                <div class="row">
                    <div class="col-md-2 header_checkbox" >
                        <input <?= isset($papers->scanned_date) ? "checked" : "" ?> data-type="header_date_checkbox" type="checkbox" name="rep_paper" class="form-controls date_checkbox" value="scanned_date">
                    </div>
                    <div class="col-md-8">
                        <input value="<?= isset($papers->scanned_date) ? $papers->scanned_date : "" ?>" data-type="header_date_input" type="text" class="mini-input date_picker" name="scanned_date" id="scanned_date" <?= isset($papers->scanned_date) ? "" : "disabled" ?>/>
                    </div>
                </div>
            </td>
            <td align="center" class="table_body_customer">
                <select data-value="<?= isset($papers->paperwork) ? $papers->paperwork : "" ?>" id="paperwork" name="paperwork" data-customer-source="dropdown" class="input_selects" >
                    <option  value=""></option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
                    <option value="Pending Kept">Pending Kept</option>
                    <option value="Pending Sent">Pending Sent</option>
                    <option value="None">None</option>
                </select>
            </td>
            <td align="center" class="table_body_customer">
                <div class="row">
                    <div class="col-md-2 header_checkbox">
                        <input <?= isset($papers->submitted) ? "checked" : "" ?> data-type="header_date_checkbox" type="checkbox" name="rep_paper" class="form-controls date_checkbox" value="submitted">
                    </div>
                    <div class="col-md-8">
                        <input value="<?= isset($papers->submitted) ? $papers->submitted : "" ?>" data-type="header_date_input" type="text" class="mini-input date_picker" name="submitted" id="submitted" <?= isset($papers->submitted) ? "" : "disabled" ?>/>
                    </div>
                </div>
            </td>
            <td align="center" class="table_body_customer">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" step="0.01" class="form-control input_select" id="rep_paid" name="rep_paid" min="0">
                </div>
            </td>
            <td align="center" class="table_body_customer">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="number" class="form-control input_select" id="tech_paid" name="tech_paid" min="0" >
                </div>
            </td>
            <td align="center" class="table_body_customer">
                <div class="row">
                    <div class="col-md-2 header_checkbox">
                        <input <?= isset($papers->funded) ? "checked" : "" ?> data-type="header_date_checkbox" type="checkbox" name="rep_paper" class="form-controls date_checkbox" value="funded">
                    </div>
                    <div class="col-md-8">
                        <input value="<?= isset($papers->funded) ? $papers->funded : "" ?>" data-type="header_date_input" type="text" class="mini-input date_picker" name="funded" id="funded" <?= isset($papers->funded) ? "" : "disabled" ?>/>
                    </div>
                </div>
            </td>
            <td align="center" class="table_body_customer">
                <div class="row">
                    <div class="col-md-2 header_checkbox" >
                        <input <?= isset($papers->charged_back) ? "checked" : "" ?> data-type="header_date_checkbox" type="checkbox" name="rep_paper" class="form-controls date_checkbox" value="charged_back">
                    </div>
                    <div class="col-md-8">
                        <input value="<?= isset($papers->charged_back) ? $papers->charged_back : "" ?>" data-type="header_date_input" type="text" class="mini-input date_picker" name="charged_back" id="charged_back" <?= isset($papers->charged_back) ? "" : "disabled" ?>/>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>