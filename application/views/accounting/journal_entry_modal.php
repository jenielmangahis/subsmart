<!-- Modal for bank deposit-->
<div class="full-screen-modal">
    <div id="journalEntryModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Journal Entry</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group w-25">
                                <label for="journalDate">Journal Date</label>
                                <input type="date" name="journal_date" id="journalDate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="journalNo">Journal Date</label>
                                <input type="text" name="journal_no" id="journalNo" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row bg-white" style="margin: 0 -30px; padding: 30px">
                        <div class="col-md-12">
                            <div class="journal-table-container w-100">
                                <div class="journal-table">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <th></th>
                                            <th>#</th>
                                            <th>ACCOUNT</th>
                                            <th>DEBITS</th>
                                            <th>CREDITS</th>
                                            <th>DESCRIPTION</th>
                                            <th>NAME</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td>1</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>2</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>3</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>4</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>5</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>6</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>7</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>8</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="journal-table-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-outline-secondary border">Add lines</button>
                                            <button type="button" class="btn btn-outline-secondary border">Clear all lines</button>
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
                                <input type="file" name="attachments" id="journal-attachments" class="hide" multiple="multiple">
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
                            <a href="#" class="text-white m-auto">Make Recurring</a>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group dropup float-right">
                                <button type="button" class="btn btn-success">
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
</div>