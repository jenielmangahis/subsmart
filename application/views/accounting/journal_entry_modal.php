<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="modal-form">
    <div id="journalEntryModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Journal Entry #<?php echo $journal_no; ?></h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body pb-0">
                    <div class="row journal-entry-details">
                        <div class="col-md-6">
                            <div class="form-group w-50">
                                <label for="journalDate">Journal Date</label>
                                <input type="text" class="form-control date" name="journal_date" id="journalDate" value="<?php echo date('m/d/Y') ?>"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="journalNo">Journal No</label>
                                <input type="number" name="journal_no" id="journalNo" class="form-control" min="<?php echo $journal_no; ?>" value="<?php echo $journal_no; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row bg-white" style="margin: 0 -30px; padding: 30px">
                        <div class="col-md-12 p-0">
                            <div class="journal-table-container w-100">
                                <div class="journal-table">
                                    <table class="table table-bordered table-hover clickable" id="journal-table">
                                        <thead>
                                            <th></th>
                                            <th>#</th>
                                            <th width="20%">ACCOUNT</th>
                                            <th width="15%">DEBITS</th>
                                            <th width="15%">CREDITS</th>
                                            <th>DESCRIPTION</th>
                                            <th width="20%">NAME</th>
                                            <th width="3%"></th>
                                        </thead>
                                        <tbody class="cursor-pointer">
                                            <tr>
                                                <td></td>
                                                <td>1</td>
                                                <td>
                                                    <select name="accounts[]" class="form-control">
                                                        <option value=""></option>
                                                        <optgroup label="Bank">
                                                            <option value="bank-1">Cash on hand</option>
                                                        </optgroup>
                                                        <optgroup label="Accounts Receivable (A/R)">
                                                            <option value="ar-1">Accounts Receivable (A/R)</option>
                                                        </optgroup>
                                                        <optgroup label="Other Current Assets">
                                                            <option value="ocassets-1">Inventory Asset</option>
                                                        </optgroup>
                                                        <optgroup label="Other Assets">
                                                            <option value="oassets-1">Shareholder Investment</option>
                                                        </optgroup>
                                                        <optgroup label="Accounts Payable (A/P)">
                                                            <option value="ap-1">Accounts Payable (A/P)</option>
                                                        </optgroup>
                                                        <optgroup label="Credit Card">
                                                            <option value="ccard-1">Credit card</option>
                                                        </optgroup>
                                                        <optgroup label="Other Current Liabilities">
                                                            <option value="ocliab-1">Loan Payable</option>
                                                        </optgroup>
                                                        <optgroup label="Long Term Liabilities">
                                                            <option value="ltliab-1">Notes Payable</option>
                                                        </optgroup>
                                                        <optgroup label="Equity">
                                                            <option value="equity-1">Additional Paid In Capital</option>
                                                        </optgroup>
                                                        <optgroup label="Income">
                                                            <option value="income-1">Billable Expense Income</option>
                                                        </optgroup>
                                                        <optgroup label="Cost of Goods Sold">
                                                            <option value="cogs-1">Cost of Goods Sold</option>
                                                        </optgroup>
                                                        <optgroup label="Expenses">
                                                            <option value="expenses-1">Advertising</option>
                                                        </optgroup>
                                                        <optgroup label="Other Income">
                                                            <option value="oincome-1">Interest Earned</option>
                                                        </optgroup>
                                                        <optgroup label="Other Expense">
                                                            <option value="oexpense-1">Miscellaneous</option>
                                                        </optgroup>
                                                    </select>
                                                </td>
                                                <td><input type="number" name="debits[]" class="form-control text-right" step="0.01"></td>
                                                <td><input type="number" name="credits[]" class="form-control text-right" step="0.01"></td>
                                                <td><input type="text" name="descriptions[]" class="form-control"></td>
                                                <td>
                                                    <select name="names[]" class="form-control">
                                                        <option value=""></option>
                                                        <optgroup label="Customers">
                                                            <?php foreach($dropdown['customers'] as $customer):?>
                                                                <option value="customer-<?php echo $customer->prof_id;?>"><?php echo $customer->first_name . ' ' . $customer->last_name;?></option>
                                                            <?php endforeach; ?>
                                                        </optgroup>
                                                        <optgroup label="Vendors">
                                                            <?php foreach($dropdown['vendors'] as $vendor):?>
                                                                <option value="vendor-<?php echo $vendor->id;?>"><?php echo $vendor->f_name . ' ' . $vendor->l_name;?></option>
                                                            <?php endforeach; ?> 
                                                        </optgroup>
                                                        <optgroup label="Employees">
                                                            <?php foreach($dropdown['employees'] as $employee):?>
                                                                <option value="employee-<?php echo $employee->id;?>"><?php echo $employee->FName . ' ' . $employee->LName;?></option>
                                                            <?php endforeach; ?> 
                                                        </optgroup>
                                                    </select>
                                                </td>
                                                <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>2</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>3</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>4</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>5</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>6</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>7</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>8</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><a href="#" class="deleteRow"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="text-right">Total</td>
                                                <td class="text-right">0.00</td>
                                                <td class="text-right">0.00</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="journal-table-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-outline-secondary border" data-target="#journal-table" onclick="addTableLines(event)">Add lines</button>
                                            <button type="button" class="btn btn-outline-secondary border" data-target="#journal-table" onclick="clearTableLines(event)">Clear all lines</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3 p-0">
                            <div class="form-group w-25">
                                <label for="memo">Memo</label>
                                <textarea name="memo" id="memo" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4 p-0">
                            <div class="journal-attachments attachments">
                                <div class="attachments-header">
                                    <button type="button" onclick="document.getElementById('journal-attachments').click();">Attachments</button>
                                    <span>Maximum size: 20MB</span>
                                </div>
                                <div class="attachments-list">
                                    <div class="attachments-container border" onclick="document.getElementById('journal-attachments').click();">
                                        <div class="attachments-container-label">
                                            Drag/Drop files here or click the icon
                                        </div>
                                    </div>
                                </div>
                                <div class="attachments-footer w-100 d-flex">
                                    <span class="m-auto"><a href="#" class="text-info">Show existing</a></span>
                                </div>
                                <input type="file" name="attachments[]" id="journal-attachments" class="hide" multiple="multiple">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-secondary">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Close</button>
                        </div>
                        <div class="col-md-4 d-flex">
                            <a href="#" class="text-white m-auto" onclick="makeRecurring('journal_entry')">Make Recurring</a>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group dropup float-right">
                                <button type="submit" class="btn btn-success">
                                    Save and new
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Save and close</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>