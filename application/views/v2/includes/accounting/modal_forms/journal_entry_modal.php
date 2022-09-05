<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<?php if(!isset($journal_entry)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/journal/<?=$journal_entry->id?>">
<?php endif; ?>
    <div id="journalEntryModal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row w-100">
                        <div class="col-6 d-flex align-items-center">
                            <div class="dropdown mr-1">
                                <a href="javascript:void(0);" class="h4 recent-transactions-button" data-bs-toggle="dropdown">
                                    <i class="bx bx-fw bx-history"></i>
                                </a>
                                <div class="dropdown-menu p-3" style="width: 500px">
                                    <h5 class="dropdown-header">Recent Journal Entries</h5>
                                    <table class="nsm-table cursor-pointer recent-transactions-table" id="recent-journal-entries">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <span class="modal-title content-title">
                                Journal Entry <span>#<?=$journal_no?></span>
                            </span>
                        </div>
                    </div>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="row journal-entry-details">
                                <div class="col-12 col-md-3 grid-mb">
                                    <label for="journalDate">Journal Date</label>
                                    <div class="nsm-field-group calendar">
                                        <input type="text" class="form-control nsm-field date" name="journal_date" id="journalDate" value="<?=$journal_date?>"/>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 grid-mb">
                                    <label for="journalNo">Journal No</label>
                                    <input type="number" name="journal_no" id="journalNo" class="form-control nsm-field" min="<?=$journal_no?>" value="<?=$journal_no?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <?php if($is_copy) : ?>
                                    <div class="col-12">
                                        <div class="nsm-callout primary">
                                            <button><i class='bx bx-x'></i></button>
                                            <h6 class="mt-0">This is a copy</h6>
                                            <span>This is a copy of a journal entry. Revise as needed and save the journal entry.</span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 grid-mb">
                                    <table class="nsm-table clickable" id="journal-table">
                                        <thead>
                                            <tr>
                                                <td data-name="Num">#</td>
                                                <td data-name="Account">ACCOUNT</td>
                                                <td data-name="Debits">DEBITS</td>
                                                <td data-name="Credits">CREDITS</td>
                                                <td data-name="Description">DESCRIPTION</td>
                                                <td data-name="Name">NAME</td>
                                                <td data-name="Manage"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <select name="journal_entry_accounts[]" class="form-control nsm-field"></select>
                                                </td>
                                                <td><input type="number" name="debits[]" class="form-control nsm-field text-end" step="0.01"></td>
                                                <td><input type="number" name="credits[]" class="form-control nsm-field text-end" step="0.01"></td>
                                                <td><input type="text" name="descriptions[]" class="form-control nsm-field"></td>
                                                <td>
                                                    <select name="names[]" class="form-control nsm-field"></select>
                                                </td>
                                                <td>
                                                    <button type="button" class="nsm-button delete-row">
                                                        <i class='bx bx-fw bx-trash'></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php $count = 1; ?>
                                            <?php if(isset($entries) && count($entries) > 0) : ?>
                                            <?php foreach($entries as $entry) : ?>
                                                <tr>
                                                    <td><?=$count?></td>
                                                    <td>
                                                        <select name="journal_entry_accounts[]" class="form-control nsm-field">
                                                            <option value="<?=$entry->account_id?>"><?=$entry->account->name?></option>
                                                        </select>
                                                    </td>
                                                    <td><input type="number" name="debits[]" class="form-control nsm-field text-end" step="0.01" value="<?=$entry->debit !== "0" ? number_format(floatval($entry->debit), 2, '.', ',') : ""?>"></td>
                                                    <td><input type="number" name="credits[]" class="form-control nsm-field text-end" step="0.01" value="<?=$entry->credit !== "0" ? number_format(floatval($entry->credit), 2, '.', ',') : ""?>"></td>
                                                    <td><input type="text" name="descriptions[]" class="form-control nsm-field" value="<?=$entry->description?>"></td>
                                                    <td>
                                                        <select name="names[]" class="form-control nsm-field">
                                                            <?php if(!is_null($entry->name_id)) : ?>
                                                            <option value="<?=$entry->name_key.'-'.$entry->name_id?>"><?=$entry->name?></option>
                                                            <?php endif; ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="nsm-button delete-row">
                                                            <i class='bx bx-fw bx-trash'></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php $count++; ?>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                            <?php do {?>
                                            <tr>
                                                <td><?=$count?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <button type="button" class="nsm-button delete-row">
                                                        <i class='bx bx-fw bx-trash'></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php $count++; } while ($count <= 8) ?>
                                            <tr>
                                                <td>2</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <button type="button" class="nsm-button delete-row">
                                                        <i class='bx bx-fw bx-trash'></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td class="text-end">Total</td>
                                                <td class="text-end">0.00</td>
                                                <td class="text-end">0.00</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">
                                                    <div class="nsm-page-buttons page-buttons-container">
                                                        <button type="button" class="nsm-button" onclick="addTableLines(event)" data-target="#journal-table">
                                                            Add lines
                                                        </button>
                                                        <button type="button" class="nsm-button" onclick="clearTableLines(event)" data-target="#journal-table">
                                                            Clear all lines
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <label for="memo">Memo</label>
                                            <textarea name="memo" id="memo" class="nsm-field form-control mb-2"><?=isset($journal_entry) ? str_replace("<br />", "", $journal_entry->memo) : ''?></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="attachments">
                                                <label for="attachment" style="margin-right: 15px"><i class="bx bx-fw bx-paperclip"></i>&nbsp;Attachment</label> 
                                                <span>Maximum size: 20MB</span>
                                                <div id="journal-entry-attachments" class="dropzone d-flex justify-content-center align-items-center" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                                    <div class="dz-message" style="margin: 20px;border">
                                                        <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                        <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="#" id="show-existing-attachments" class="text-decoration-none">Show existing</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-md-4 <?=!isset($journal_entry) ? 'd-flex' : ''?>">
                            <?php if(!isset($journal_entry)) : ?>
                            <a href="#" class="text-dark text-decoration-none m-auto" onclick="makeRecurring('journal_entry')">Make Recurring</a>
                            <?php else : ?>
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-dark text-decoration-none">Reverse</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span><a href="#" class="text-dark text-decoration-none" onclick="makeRecurring('journal_entry')">Make Recurring</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="#" class="text-dark text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" id="copy-journal-entry">Copy</a>
                                                <a class="dropdown-item" href="#" id="delete-journal-entry">Delete</a>
                                                <a class="dropdown-item" href="#">Transaction journal</a>
                                                <a class="dropdown-item" href="#">Audit history</a>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group float-end" role="group">
                                <button type="button" class="nsm-button success" onclick="saveAndNewForm(event)">
                                    Save and new
                                </button>
                                <div class="btn-group" role="group">
                                    <button type="button" class="nsm-button success dropdown-toggle" style="margin-left: 0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-fw bx-chevron-up text-white"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" onclick="saveAndCloseForm(event)">Save and close</a>
                                    </div>
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