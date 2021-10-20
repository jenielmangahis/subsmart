<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="submitModalForm(event, this)" id="modal-form">
    <div id="journalEntryModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Journal Entry #<?=$journal_no?></h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row journal-entry-details">
                                        <div class="col-md-6">
                                            <div class="form-group w-50">
                                                <label for="journalDate">Journal Date</label>
                                                <input type="text" class="form-control date" name="journal_date" id="journalDate" value="<?=$journal_date?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="journalNo">Journal No</label>
                                                <input type="number" name="journal_no" id="journalNo" class="form-control" min="<?=$journal_no?>" value="<?=$journal_no?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
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
                                                                    <select name="journal_entry_accounts[]" class="form-control"></select>
                                                                </td>
                                                                <td><input type="number" name="debits[]" class="form-control text-right" step="0.01"></td>
                                                                <td><input type="number" name="credits[]" class="form-control text-right" step="0.01"></td>
                                                                <td><input type="text" name="descriptions[]" class="form-control"></td>
                                                                <td>
                                                                    <select name="names[]" class="form-control"></select>
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
                                                <div class="table-footer">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="button" class="btn btn-outline-secondary border" data-target="#journal-table" onclick="addTableLines(event)">Add lines</button>
                                                            <button type="button" class="btn btn-outline-secondary border" data-target="#journal-table" onclick="clearTableLines(event)">Clear all lines</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <div class="form-group w-25">
                                                <label for="memo">Memo</label>
                                                <textarea name="memo" id="memo" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="attachments">
                                                <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                <span>Maximum size: 20MB</span>
                                                <div id="journal-entry-attachments" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                                    <div class="dz-message" style="margin: 20px;border">
                                                        <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                        <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                <button type="button" class="btn btn-success" id="save-and-new">
                                    Save and new
                                </button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" id="save-and-close">Save and close</a>
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