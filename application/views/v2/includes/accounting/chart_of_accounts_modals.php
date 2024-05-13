<div class="modal fade nsm-modal" id="print_accounts_modal" tabindex="-1" aria-labelledby="print_accounts_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_accounts_modal_label">Print Accounts List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table" id="accounts-table-modal">
                    <thead>
                        <tr>
                            <td data-name="Name">Name</td>
                            <td data-name="Type">Type</td>
                            <td data-name="Detail Type">Detail Type</td>
                            <td data-name="Balance">Balance</td>
                            <td data-name="Bank Balance">Bank Balance</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($accounts)) :
                        ?>
                            <?php
                            foreach ($accounts as $account) :
                            ?>
                                <tr>
                                    <td class="nsm-text-primary">
                                        <label class="nsm-link default d-block fw-bold"><?=$account['name']?></label>
                                    </td>
                                    <td><?=$account['type']?></td>
                                    <td><?=$account['detail_type']?></td>
                                    <td><?=$account['nsmartrac_balance']?></td>
                                    <td><?=$account['bank_balance']?></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="5">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_print_accounts">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_preview_accounts_modal" tabindex="-1" aria-labelledby="print_preview_accounts_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_accounts_modal_label">Print Accounts List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="accounts_table_print">
                    <thead>
                        <tr>
                            <td data-name="Name">Name</td>
                            <td data-name="Type">Type</td>
                            <td data-name="Detail Type">Detail Type</td>
                            <td data-name="Balance">Balance</td>
                            <td data-name="Bank Balance">Bank Balance</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($accounts)) :
                        ?>
                            <?php
                            foreach ($accounts as $account) :
                            ?>
                                <tr>
                                    <td class="nsm-text-primary">
                                        <label class="nsm-link default d-block fw-bold"><?=$account['name']?></label>
                                    </td>
                                    <td><?=$account['type']?></td>
                                    <td><?=$account['detail_type']?></td>
                                    <td><?=$account['nsmartrac_balance']?></td>
                                    <td><?=$account['bank_balance']?></td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="5">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="import-accounts-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Import Accounts</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            A great process to import all your accounts.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="progress-wrapper" style="padding-bottom: 100px;">
                            <div id="progress-bar-container">
                                <ul>
                                    <li class="step step1 active" style="pointer-events: none !important;">
                                        <div class="step-inner">Step 1</div>
                                    </li>
                                    <li class="step step2" style="pointer-events: none !important;">
                                        <div class="step-inner">Step 2</div>
                                    </li>
                                    <li class="step step3" style="pointer-events: none !important;">
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

                                        <form id="import_account" enctype="multipart/form-data" style="text-align: center;">
                                            <input id="file-upload" name="file" type="file" accept=".csv"/>
                                            <input  name="file2" value="1" type="hidden"/>
                                            <br><br>
                                            <!-- <button type="button" id="nextBtn1" class="btn btn-primary btn-sm step step02" disabled ><span class="fa fa-arrow-right"></span> Next</button> -->
                                        </form>
                                    </div>

                                    <div class="section-content step2">
                                        <h2>Step 2</h2>
                                        <p>Map Headings</p>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                                <b >Account Name</b> <span class='mapping-line'>-----------------</span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector0" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                                <b >Detail Type</b> <span class='mapping-line'>-----------------</span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector1" onclick="test()">
                                                    <option value="">Select Heading</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row grid-mb">
                                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                                <b >Type</b> <span class='mapping-line'>-----------------</span>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select name="headers[]" class="form-select nsm-field headersSelector" id="headersSelector2" onclick="test()">
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
                                        <p>Accounts Preview </p>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table tbl" style="height: 100px;overflow-y: auto; overflow-x: hidden;border-collapse: collapse; ">
                                                    <thead>
                                                        <tr id='tableHeader'>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="imported_accounts"></tbody>
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