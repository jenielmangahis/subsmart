<div class="modal fade nsm-modal" id="print_vendors_modal" tabindex="-1" aria-labelledby="print_vendors_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_vendors_modal_label">Print Vendors List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Vendor">VENDOR/COMPANY</td>
                            <td data-name="Address">ADDRESS</td>
                            <td data-name="Phone">PHONE</td>
                            <td data-name="Email">EMAIL</td>
                            <td class="table-icon text-center" data-name="Attachments">
                                <i class='bx bx-paperclip'></i>
                            </td>
                            <td data-name="Open Balance">OPEN BALANCE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($vendors) > 0) : ?>
                        <?php foreach($vendors as $vendor) : ?>
                        <tr>
                            <td><?=$vendor->display_name?><?=$vendor->status === '0' ? ' (deleted)' : ''?></td>
                            <td></td>
                            <td><?=$vendor->phone?></td>
                            <td><?=$vendor->email?></td>
                            <td><?=count($this->accounting_attachments_model->get_attachments('Vendor', $vendor->id)) > 0 ? count($this->accounting_attachments_model->get_attachments('Vendor', $vendor->id)) : ''?></td>
                            <td>
                                <?php
                                    $balance = '$'.number_format(floatval($vendor->opening_balance), 2, '.', ',');
                                    echo str_replace('$-', '-$', $balance);
                                ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="8">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_print_vendors">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_preview_vendors_modal" tabindex="-1" aria-labelledby="print_preview_vendors_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_vendors_modal_label">Print vendors List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="vendors_table_print">
                    <thead>
                        <tr>
                            <td data-name="Vendor">VENDOR/COMPANY</td>
                            <td data-name="Address">ADDRESS</td>
                            <td data-name="Phone">PHONE</td>
                            <td data-name="Email">EMAIL</td>
                            <td class="table-icon text-center" data-name="Attachments">
                                <i class='bx bx-paperclip'></i>
                            </td>
                            <td data-name="Open Balance">OPEN BALANCE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($vendors) > 0) : ?>
                        <?php foreach($vendors as $vendor) : ?>
                        <tr>
                            <td><?=$vendor->display_name?><?=$vendor->status === '0' ? ' (deleted)' : ''?></td>
                            <td></td>
                            <td><?=$vendor->phone?></td>
                            <td><?=$vendor->email?></td>
                            <td><?=count($this->accounting_attachments_model->get_attachments('Vendor', $vendor->id)) > 0 ? count($this->accounting_attachments_model->get_attachments('Vendor', $vendor->id)) : ''?></td>
                            <td>
                                <?php
                                    $balance = '$'.number_format(floatval($vendor->opening_balance), 2, '.', ',');
                                    echo str_replace('$-', '-$', $balance);
                                ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="8">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="import-vendors-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Import Vendors</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            A great process to import all your vendors.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="progress-wrapper" style="padding-bottom: 100px;">
                            <div id="progress-bar-container">
                                <ul>
                                    <li class="step step1 active">
                                        <div class="step-inner">Step 1</div>
                                    </li>
                                    <li class="step step2">
                                        <div class="step-inner">Step 2</div>
                                    </li>
                                    <li class="step step3">
                                        <div class="step-inner">Step 3</div>
                                    </li>
                                </ul>

                                <div id="line">
                                    <div id="line-progress"></div>
                                </div>

                                <div id="progress-content-section">
                                    <div class="section-content step1 active">
                                        <h2>Step 1</h2>
                                        <p>Industry Type Select and CSV Upload</p>

                                        <form id="import_vendor" enctype="multipart/form-data" style="text-align: center;">
                                            <input id="file-upload" name="file" type="file" accept=".csv"/>
                                            <input  name="file2" value="1" type="hidden"/>
                                            <br><br>
                                        </form>
                                    </div>

                                    <div class="section-content step2">
                                        <h2>Step 2</h2>
                                        <p>Map Headings</p>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-3 d-flex align-vendors-center">
                                                <b >Name</b>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector0" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-3 d-flex align-vendors-center">
                                                <b >Company</b>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector1" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-3 d-flex align-vendors-center">
                                                <b >Email</b>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector2" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-3 d-flex align-vendors-center">
                                                <b >Phone</b>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector3" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-3 d-flex align-vendors-center">
                                                <b >Mobile</b>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector4" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-3 d-flex align-vendors-center">
                                                <b >Fax</b>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector5" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-3 d-flex align-vendors-center">
                                                <b >Website</b>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector6" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-3 d-flex align-vendors-center">
                                                <b >Street</b>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector7" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-3 d-flex align-vendors-center">
                                                <b >City</b>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector8" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-3 d-flex align-vendors-center">
                                                <b >Province/Region/State</b>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector9" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-3 d-flex align-vendors-center">
                                                <b >ZIP Code</b>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector10" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-3 d-flex align-vendors-center">
                                                <b >Country</b>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector11" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-3 d-flex align-vendors-center">
                                                <b >Opening Balance</b>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector12" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-3 d-flex align-vendors-center">
                                                <b >Opening Balance Date</b>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector13" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-3 d-flex align-vendors-center">
                                                <b >Tax ID No.</b>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector14" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="result"></div>
                                        <br>
                                        <!-- <button type="button" class="btn btn-primary btn-sm step step01" ><span class="fa fa-arrow-left"></span> Back</button>
                                        <button type="button" class="btn btn-primary btn-sm step step03" ><span class="fa fa-arrow-right"></span> Next</button> -->
                                    </div>
                                    <div class="section-content step3">
                                        <h2>Step 3</h2>
                                        <p>Vendors Preview </p>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table tbl" style="height: 100px;overflow-y: auto; overflow-x: hidden;border-collapse: collapse; ">
                                                    <thead>
                                                        <tr id='tableHeader'>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="imported_vendors"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="button" class="nsm-button primary step02" id="nextBtn1" disabled>Next</button>
            </div>
        </div>
    </div>
</div>

<div id="overlay">
    <div>
        <img src="<?=base_url()?>/assets/img/uploading.gif" class="" style="width: 80px;" alt="" />
        <center><p>Processing...</p></center>
    </div>
</div>