<div id="customer-single-modal">
    <input type="text" name="customer_id" style="display: none;">
    <div class="the-body">
        <div class="row no-margin">
            <div class="col-md-2 no-padding">
                <div class="all-customer-section">
                    <div class="top-section">
                        <div class="row">
                            <div class="col-md-6 no-padding">
                                <div class="back">
                                    <a href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i>
                                        Customers</a>
                                </div>
                            </div>
                            <div class="col-md-6 no-padding">
                                <div class="close-add-btns">
                                    <a href="#">
                                        <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                    </a>
                                    <a href="#">
                                        <span class="">
                                            <svg viewBox="0 0 16 14" id="" xmlns="http://www.w3.org/2000/svg"
                                                transform="scale(1, -1)" width="20px" height="100%">
                                                <path
                                                    d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z">
                                                </path>
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="search-section">
                            <div class="form-group">
                                <input type="text" placeholder="Filter name or open balance..." class="form-control">
                                <span><i class="fa fa-search" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="sort-btn">
                            <button class="btn btn-default sort-display" type="button" data-toggle="dropdown">
                                <span class="sort-display"> Sort by name</span> <span
                                    class="fa fa-caret-down"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right submit-submenu" role="menu">
                                <li data-sort-by="name">
                                    <button type="button" style="background: none;border: none; height: auto;font-size: 13px;padding: 10px;
                                                ">Sort by name</button>
                                </li>
                                <li data-sort-by="open balance">
                                    <button type="button" style="background: none;border: none; height: auto;font-size: 13px;padding: 10px;
                                                ">Sort by open balance</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="customer-list-section">
                        <ul class="customers-list"></ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10 no-padding">
                <div class="single-customer-info-section">
                    <div class="top-section">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="customer-name">
                                    <h2 data-toggle="tooltip" data-placement="bottom" title="pintonlou@gmail.com">
                                        <span class="text">Brannon Nguyen</span>
                                        <label>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom"
                                                title="pintonlou@gmail.com"><i class="fa fa-envelope-o"
                                                    aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-phone" aria-hidden="true"></i></a>
                                        </label>
                                    </h2>
                                </div>
                                <div class="customer-address">
                                    <label>901 Windrock Court, Mobile, AL 36608</label>
                                    <div class="notes">
                                        <a href="#" class="add-notes-btn">Add notes</a>
                                        <textarea name="customer_notes" id="" cols="30" rows="3"
                                            placeholder="Add notes"></textarea>
                                            <div class="saved-indicator"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="btns-section">
                                    <div class="pull-right">
                                        <button class="btn btn-default edit-button px-4" type="button">Edit</button>
                                        <button class="btn btn-success" type="button" data-toggle="dropdown">
                                            New Transaction &nbsp;<span class="fa fa-caret-down"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right new-transactions" role="menu">
                                            <li>
                                                <a href="#" data-customer-id="" class="customer_craete_invoice_btn">Invoice</a>
                                            </li>
                                            <li>
                                                <a href="#" data-customer-id="" class="customer_receive_payment_btn">Payment</a>
                                            </li>
                                            <li>
                                                <a href="#" class="create-estimate-btn" data-toggle="modal" data-target="#newJobModal" data-email-add="">Estimate</a>
                                            </li>
                                            <li>
                                                <a href="#">Payment Link</a>
                                            </li>
                                            <li>
                                                <a href="#" class="created-sales-receipt" data-toggle="modal" data-target="#addsalesreceiptModal" data-email-add="" data-customer-id="">Sales Receipt</a>
                                            </li>
                                            <li>
                                                <a href="#">Credit Memo</a>
                                            </li>
                                            <li>
                                                <a href="#" class="create-charge-btn" data-toggle="modal" data-target="#create_charge_modal" data-customer-id="">Delayed Charge</a>
                                            </li>
                                            <li>
                                                <a href="#" class="time-activity-btn" data-toggle="modal" data-target="#time_activity_modal" data-customer-id="" >Time Activity</a>
                                            </li>
                                            <li>
                                                <a href="#" class="created-statement-btn" data-toggle="modal" data-target="#create_statement_modal" data-customer-id="">Statement</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="monetary-section">
                                    <div class="group">
                                        <div class="monetary-open pull-right">
                                            <div class="amount">$140.00</div>
                                            <div class="label">OPEN</div>
                                        </div>
                                    </div>
                                    <div class="group">
                                        <div class="monetary-overdue pull-right">
                                            <div class="amount">$0.00</div>
                                            <div class="label">OVERDUE</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="body-section">
                        <div class="tabs-section">
                            <ul class="body-tabs">
                                <li class="active">
                                    <div class="labels">Transaction List</div>
                                </li>
                                <li>
                                    <div class="labels">Customer Details</div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-body-content-section transaction-list">
                            <div class="seaction-above-table">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="by-btach-btn">
                                            <div class="batch-actiom-icon-holder">
                                                <img src="<?=base_url("assets/img/trac360/batch_arrow_down.png")?>"
                                                    class="batch-action-icon">
                                            </div>
                                            <button class="btn btn-default" type="button" data-toggle="dropdown">
                                                Batch action <span class="fa fa-caret-down"></span></button>
                                            <ul class="dropdown-menu dropdown-menu-right submit-submenu" role="menu">
                                                <li>
                                                    <a href="#">Print transactions</a>
                                                </li>
                                                <li>
                                                    <a href="#">Print packaging slip</a>
                                                </li>
                                                <li>
                                                    <a href="#">Send transactions</a>
                                                </li>
                                                <li>
                                                    <a href="#">Send reminder</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="filter-btn-section">
                                            <button class="btn btn-default" type="button">
                                                Filter <span class="fa fa-caret-down"></span></button>
                                            <div class="filter"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="print-export-settings-btns pull-right">
                                            <button type="button" class="print-btn">
                                                <i class="fa fa-print" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="export-btn">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                            </button>
                                            <div class="setting-btn-section pull-right">
                                                <button type="button" class="settings-btn">
                                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                                </button>
                                                <div class="settings-options" style="display: none;">
                                                    <div class="achor-holder"><img
                                                            src="<?=base_url("assets/img/accounting/customers/anchor.png")?>"
                                                            alt=""></div>
                                                    <div class="title">
                                                        Columns
                                                    </div>
                                                    <div class="form-check">
                                                        <div class="checkbox checkbox-sec margin-right">
                                                            <input type="checkbox" name="tbl-colum-type"
                                                                id="tbl-colum-type" data-column="type" checked>
                                                            <label for="tbl-colum-type"><span>Type</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check">
                                                        <div class="checkbox checkbox-sec margin-right">
                                                            <input type="checkbox" name="tbl-colum-no" id="tbl-colum-no"
                                                                data-column="no">
                                                            <label for="tbl-colum-no"><span>No.</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check">
                                                        <div class="checkbox checkbox-sec margin-right">
                                                            <input type="checkbox" name="tbl-colum-customer"
                                                                id="tbl-colum-customer" data-column="customer">
                                                            <label
                                                                for="tbl-colum-customer"><span>Customer</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check">
                                                        <div class="checkbox checkbox-sec margin-right">
                                                            <input type="checkbox" name="tbl-colum-method"
                                                                id="tbl-colum-method" data-column="method">
                                                            <label for="tbl-colum-method"><span>Metod</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check">
                                                        <div class="checkbox checkbox-sec margin-right">
                                                            <input type="checkbox" name="tbl-colum-source"
                                                                id="tbl-colum-source" data-column="source">
                                                            <label for="tbl-colum-source"><span>Source</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check">
                                                        <div class="checkbox checkbox-sec margin-right">
                                                            <input type="checkbox" name="tbl-colum-memo"
                                                                id="tbl-colum-memo" data-column="memo">
                                                            <label for="tbl-colum-memo"><span>Memo</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check">
                                                        <div class="checkbox checkbox-sec margin-right">
                                                            <input type="checkbox" name="tbl-colum-duedate"
                                                                id="tbl-colum-duedate" data-column="duedate" checked>
                                                            <label for="tbl-colum-duedate"><span>Due date</span></label>
                                                        </div>
                                                    </div>
                                                    <div class="extra-group" style="display: none;">
                                                        <div class="form-check">
                                                            <div class="checkbox checkbox-sec margin-right">
                                                                <input type="checkbox" name="tbl-colum-aging"
                                                                    id="tbl-colum-aging" data-column="aging" checked>
                                                                <label for="tbl-colum-aging"><span>Aging</span></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-check">
                                                            <div class="checkbox checkbox-sec margin-right">
                                                                <input type="checkbox" name="tbl-colum-balance"
                                                                    id="tbl-colum-balance" data-column="balance"
                                                                    checked>
                                                                <label
                                                                    for="tbl-colum-balance"><span>Balance</span></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-check">
                                                            <div class="checkbox checkbox-sec margin-right">
                                                                <input type="checkbox" name="tbl-colum-last-delivered"
                                                                    id="tbl-colum-last-delivered"
                                                                    data-column="last-delivered" checked>
                                                                <label for="tbl-colum-last-delivered"><span>Last
                                                                        delivered</span></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-check">
                                                            <div class="checkbox checkbox-sec margin-right">
                                                                <input type="checkbox" name="tbl-colum-email"
                                                                    id="tbl-colum-email" data-column="email">
                                                                <label for="tbl-colum-email"><span>Email</span></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-check">
                                                            <div class="checkbox checkbox-sec margin-right">
                                                                <input type="checkbox" name="tbl-colum-attachment"
                                                                    id="tbl-colum-attachment" data-column="attachment"
                                                                    checked>
                                                                <label
                                                                    for="tbl-colum-attachment"><span>Attachement</span></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-check">
                                                            <div class="checkbox checkbox-sec margin-right">
                                                                <input type="checkbox" name="tbl-colum-status"
                                                                    id="tbl-colum-status" data-column="status" checked>
                                                                <label
                                                                    for="tbl-colum-status"><span>Status</span></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-check">
                                                            <div class="checkbox checkbox-sec margin-right">
                                                                <input type="checkbox" name="tbl-colum-ponumber"
                                                                    id="tbl-colum-ponumber" data-column="ponumber">
                                                                <label for="tbl-colum-ponumber"><span>P.O.
                                                                        Number</span></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-check">
                                                            <div class="checkbox checkbox-sec margin-right">
                                                                <input type="checkbox" name="tbl-colum-sales-rep"
                                                                    id="tbl-colum-sales-rep" data-column="sales-rep"
                                                                    checked>
                                                                <label for="tbl-colum-sales-rep"><span>Sales
                                                                        Rep</span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="show-more-less" data-current-show="less">
                                                        <i class="fa fa-chevron-down" aria-hidden="true"></i> Show More
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="transaction-list-table">
                                <table id="single_customer_table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <div class="checkbox checkbox-sec margin-right">
                                                        <input type="checkbox" name="customer_checkbox_all"
                                                            id="customer_checkbox_all" class="customer_checkbox">
                                                        <label for="customer_checkbox_all"><span></span></label>
                                                    </div>
                                                </div>
                                            </th>
                                            <th>Date</th>
                                            <th data-column="type">Type</th>
                                            <th data-column="no">No.</th>
                                            <th data-column="customer">Customer</th>
                                            <th data-column="method">Method</th>
                                            <th data-column="source">Source</th>
                                            <th data-column="memo">Memo</th>
                                            <th data-column="duedate">Due Date</th>
                                            <th data-column="aging">Aging</th>
                                            <th data-column="balance">Balance</th>
                                            <th>TOTAL</th>
                                            <th data-column="last-delivered">Last Delevired</th>
                                            <th data-column="email">Email</th>
                                            <th data-column="attachment"><i class="fa fa-paperclip"
                                                    aria-hidden="true"></i>
                                            </th>
                                            <th data-column="status">Status</th>
                                            <th data-column="ponumber">P.O. Number</th>
                                            <th data-column="sales-rep">SALES REP</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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