<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/tools/api_connectors_modals'); ?>
<?php 
    $currentDateTime = new DateTime(date('M') . ' 1');
    $lastYearDate = $currentDateTime->modify('-1 year')->format('Y-m-d');
?>

<!-- CSS and JS Imports -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.bootstrap5.min.css" integrity="sha512-Ars0BmSwpsUJnWMw+KoUKGKunT7+T8NGK0ORRKj+HT8naZzLSIQoOSIIM3oyaJljgLxFi0xImI5oZkAWEFARSA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Internal CSS Styling -->

<style>
    .d-none-custom {
        display: none;
    }
    .logo {
        position: absolute;
        right: 0px;
        top: 0px;
    }

    .fw-normal-custom {
        font-weight: 500;
    }

    .hrMargin {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .selectize-control.multi .selectize-input>div {
        margin: 0 3px 5px 0;
        padding: 3px 5px;
    }

    .importProgressBar > div {
        height: 20px;
    }

    .importProgressBar > div > div {
        width: 0%;
    }

    input[type="select-one"] {
        height: 28px;
    }
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/tools_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/business_tools_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-md-12 position-relative mb-4">
                        <h1>QuickBooks Accounting</h1>
                        <label for="">Import accounting data from QuickBooks to nsmart.</label>
                        <img class="nsm-card-img-lg float-end logo" src="<?= base_url() ?>/assets/img/api-tools/thumb_quickbooks_payroll.png">
                    </div>
                    <div class="col-lg-12 position-relative mb-3">
                        <div>
                            <?php if ($loginStatus == 1): ?>
                                <strong>QuickBooks Status</strong>
                                <p class="text-success fw-normal-custom mt-1">You are connected</p>
                                <style>.connectDisconnectButton {position: absolute;top: 0px;left: 200px;}</style>
                            <?php else: ?>
                                <p class="fw-normal-custom mt-1">Connect to QuickBooks to import your accounting data.</p>
                            <?php endif; ?>
                        </div>
                        <div class="connectDisconnectButton">
                            <?php if ($loginStatus == 1): ?>
                                <button class="nsm-button small disconnectButton <?php echo ($loginStatus == 1) ? "" : "d-none-custom" ; ?>">Disconnect</button>
                            <?php else: ?>
                                <button class="nsm-button small primary connectButton <?php echo ($loginStatus == 0) ?  "" : "d-none-custom" ; ?>">Connect</button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if ($loginStatus == 1): ?>
                    <div class="col-xl-12">
                        <strong>QuickBooks Account</strong>
                        <p class="text-muted fw-normal-custom mt-1">
                                <span class="companyName"><?php echo $companyQBInfo->CompanyName; ?></span>
                            <br>
                            <span class="companyAddress"><?php echo $companyQBInfo->CompanyAddr->Line1.", ".$companyQBInfo->CompanyAddr->City." ".$companyQBInfo->CompanyAddr->CountrySubDivisionCode.", ".$companyQBInfo->CompanyAddr->PostalCode; ?></span>
                        </p>
                    </div>
                    <div class="col-xl-12 mb-3">
                        <select class="searchCard" multiple="multiple">
                            <!-- <option value="customerCard">Customer</option> -->
                            <option value="vendorCard">Vendor</option>
                            <option value="employeeCard">Employee</option>
                            <option value="itemCard">Item</option>
                            <!-- <option value="invoiceCard">Invoice</option> -->
                            <!-- <option value="paymentCard">Payment</option> -->
                            <!-- <option value="estimateCard">Estimate</option> -->
                        </select>
                    </div>
                    <div class="container-fluid">
                    <div class="row" id="masonryContainer">
                        <!-- <div class="col-xl-2 mb-3 customerCard cardToggle">
                            <div class="card">
                                <div class="card-body">
                                    <form class="quickbooks_import_form">
                                        <h5 class="card-title">Customer</h5>
                                        <span class="card-text text-muted">Consumer of the service or product that your business offers.</span>
                                        <hr class="hrMargin">
                                        <div class="input-group">
                                            <input type="hidden" name="data" value="Customer">
                                            <input class="form-control form-control-sm mb-2 d-none" name="dateFrom" type="date" value="2000-01-01">
                                            <input class="form-control form-control-sm mb-2 d-none" name="dateTo" type="date" value="<?php echo date('Y-m-d')?>">
                                        </div>
                                        <div>&mdash; Result: <span class="fw-normal-custom resultLabel">...</span></div>
                                        <hr class="hrMargin">
                                        <button type="button" class="btn btn-primary fw-bold importButton" disabled>Import</button>
                                        <button type="submit" class="btn btn-secondary fw-bold">Fetch</button>
                                    </form>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-xl-2 mb-3 vendorCard cardToggle">
                            <div class="card">
                                <div class="card-body">
                                    <form class="quickbooks_import_form">
                                        <h5 class="card-title">Vendor</h5>
                                        <span class="card-text text-muted">Represents the seller from whom your company purchases any service or product.</span>
                                        <hr class="hrMargin">
                                        <div class="input-group">
                                            <input type="hidden" name="data" value="Vendor">
                                            <input class="form-control form-control-sm mb-2 d-none" name="dateFrom" type="date" value="2000-01-01">
                                            <input class="form-control form-control-sm mb-2 d-none" name="dateTo" type="date" value="<?php echo date('Y-m-d')?>">
                                        </div>
                                        <div>&mdash; Result: <span class="fw-normal-custom resultLabel">...</span></div>
                                        <hr class="hrMargin">
                                        <button type="button" class="btn btn-primary fw-bold importButton" disabled>Import</button>
                                        <button type="submit" class="btn btn-secondary fw-bold">Fetch</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 mb-3 employeeCard cardToggle">
                            <div class="card">
                                <div class="card-body">
                                    <form class="quickbooks_import_form">
                                        <h5 class="card-title">Employee</h5>
                                        <span class="card-text text-muted">Represents a person working for the company.</span>
                                        <hr class="hrMargin">
                                        <div class="input-group">
                                            <input type="hidden" name="data" value="Employee">
                                            <input class="form-control form-control-sm mb-2 d-none" name="dateFrom" type="date" value="2000-01-01">
                                            <input class="form-control form-control-sm mb-2 d-none" name="dateTo" type="date" value="<?php echo date('Y-m-d')?>">
                                        </div>
                                        <div>&mdash; Result: <span class="fw-normal-custom resultLabel">...</span></div>
                                        <hr class="hrMargin">
                                        <button type="button" class="btn btn-primary fw-bold importButton" disabled>Import</button>
                                        <button type="submit" class="btn btn-secondary fw-bold">Fetch</button>
                                    </form>
                                </div>
                            </div>
                        </div>  
                        <div class="col-xl-2 mb-3 itemCard cardToggle">
                            <div class="card">
                                <div class="card-body">
                                    <form class="quickbooks_import_form">
                                        <h5 class="card-title">Item</h5>
                                        <span class="card-text text-muted">A thing that your company buys, sells, or re-sells, such as products and services.</span>
                                        <hr class="hrMargin">
                                        <div class="input-group">
                                            <input type="hidden" name="data" value="Item">
                                            <input class="form-control form-control-sm mb-2 d-none" name="dateFrom" type="date" value="2000-01-01">
                                            <input class="form-control form-control-sm mb-2 d-none" name="dateTo" type="date" value="<?php echo date('Y-m-d')?>">
                                        </div>
                                        <div>&mdash; Result: <span class="fw-normal-custom resultLabel">...</span></div>
                                        <hr class="hrMargin">
                                        <button type="button" class="btn btn-primary fw-bold importButton" disabled>Import</button>
                                        <button type="submit" class="btn btn-secondary fw-bold">Fetch</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-xl-2 mb-3 invoiceCard cardToggle">
                            <div class="card">
                                <div class="card-body">
                                    <form class="quickbooks_import_form">
                                        <h5 class="card-title">Invoice</h5>
                                        <span class="card-text text-muted">Represents a sales form where the customer pays for a product or service later.</span>
                                        <hr class="hrMargin">
                                        <div class="input-group">
                                            <input type="hidden" name="data" value="Invoice">
                                            <input class="form-control form-control-sm mb-2" name="dateFrom" type="date" value="<?php echo $lastYearDate; ?>">
                                            <input class="form-control form-control-sm mb-2" name="dateTo" type="date" value="<?php echo date('Y-m-d')?>">
                                        </div>
                                        <div>&mdash; Result: <span class="fw-normal-custom resultLabel">...</span></div>
                                        <hr class="hrMargin">
                                        <button type="button" class="btn btn-primary fw-bold importButton" disabled>Import</button>
                                        <button type="submit" class="btn btn-secondary fw-bold">Fetch</button>
                                    </form>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-xl-2 mb-3 paymentCard cardToggle">
                            <div class="card">
                                <div class="card-body">
                                    <form class="quickbooks_import_form">
                                        <h5 class="card-title">Payment</h5>
                                        <span class="card-text text-muted">Records a payment in QuickBooks. The payment can be applied for a particular customer against multiple Invoices and Credit Memos.</span>
                                        <hr class="hrMargin">
                                        <div class="input-group">
                                            <input type="hidden" name="data" value="Payment">
                                            <input class="form-control form-control-sm mb-2" name="dateFrom" type="date" value="<?php echo $lastYearDate; ?>">
                                            <input class="form-control form-control-sm mb-2" name="dateTo" type="date" value="<?php echo date('Y-m-d')?>">
                                        </div>
                                        <div>&mdash; Result: <span class="fw-normal-custom resultLabel">...</span></div>
                                        <hr class="hrMargin">
                                        <button type="button" class="btn btn-primary fw-bold importButton" disabled>Import</button>
                                        <button type="submit" class="btn btn-secondary fw-bold">Fetch</button>
                                    </form>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="col-xl-2 mb-3 estimateCard cardToggle">
                            <div class="card">
                                <div class="card-body">
                                    <form class="quickbooks_import_form">
                                        <h5 class="card-title">Estimate</h5>
                                        <span class="card-text text-muted">Represents a proposal for a financial transaction from a business to a customer for goods or services proposed to be sold, including proposed pricing.</span>
                                        <hr class="hrMargin">
                                        <div class="input-group">
                                            <input type="hidden" name="data" value="Estimate">
                                            <input class="form-control form-control-sm mb-2" name="dateFrom" type="date" value="<?php echo $lastYearDate; ?>">
                                            <input class="form-control form-control-sm mb-2" name="dateTo" type="date" value="<?php echo date('Y-m-d')?>">
                                        </div>
                                        <div>&mdash; Result: <span class="fw-normal-custom resultLabel">...</span></div>
                                        <hr class="hrMargin">
                                        <button type="button" class="btn btn-primary fw-bold importButton" disabled>Import</button>
                                        <button type="submit" class="btn btn-secondary fw-bold">Fetch</button>
                                    </form>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    </div>

                    <div class="modal importModal" data-bs-backdrop="static" aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title content-title" style="font-size: 17px;"><i class="fas fa-file-import text-muted"></i>&nbsp;&nbsp;<span class="modalTitle">Import modal</span></div>
                                <!-- <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i> -->
                            </div>
                            <div class="modal-body">
                                <form class="startImport_form">
                                    <div class="row">
                                        <input class="d-none" name="data" type="text" value="">
                                        <input class="d-none" name="dateFrom" type="date" value="">
                                        <input class="d-none" name="dateTo" type="date" value="">
                                        <div class="col-lg-12 mb-3 alertMsg">
                                            <span class="fw-normal-custom"></span>
                                        </div>
                                        <div class="col-lg-12 mb-3 importProgressBar">
                                            <p class="fw-normal-custom"><span class="currentRecordCount">0</span> out of <span class="maxRecordCount">0</span> records.</p>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped bg-success" role="progressbar">0%</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <span class="text-muted">Please refrain from closing or refreshing the tab and browser once the importing process has started.</span>
                                        </div>
                                    </div>
                                    <hr class="mt-0 g-0">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="float-end">
                                                <button type="button" class="nsm-button border-0" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="nsm-button primary startImport">Proceed</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                    <script>
                        $(document).ready(function () {
                            var masonry = new Masonry(document.getElementById('masonryContainer'), {percentPosition: true,});

                            $(".searchCard").selectize({
                                plugins: ["remove_button", "clear_button"],
                                placeholder: "Search and select specific category ..."
                            }); 

                            $('.searchCard').change(function (e) { 
                            const value = $(this).val();

                            if (value.length > 0) {
                                $('.cardToggle').hide();
                                for (let index = 0; index < value.length; index++) {
                                    $('.' + value[index]).show();
                                    if (value.length >= 6) {
                                        masonry = new Masonry(document.getElementById('masonryContainer'), {percentPosition: true,});
                                    } else {
                                        masonry.destroy();
                                    }
                                }
                                } else {
                                    $('.cardToggle').show();
                                    masonry = new Masonry(document.getElementById('masonryContainer'), {percentPosition: true,});
                                }
                            });
                        
                            function formDisabler(selector, state) {
                                const element = $(selector);
                                const submitButton = element.find('button[type="submit"]');
                                element.find("input, button").prop('disabled', state);

                                if (state) {
                                    element.find('a').hide();
                                    if (!submitButton.data('original-content')) {
                                        submitButton.data('original-content', submitButton.html());
                                    }
                                    submitButton.prop('disabled', true).html('<i class="fas fa-cog fa-spin"></i>&nbsp;Processing');
                                } else {
                                    element.find('a').show();
                                    const originalContent = submitButton.data('original-content');
                                    if (originalContent) {
                                        submitButton.prop('disabled', false).html(originalContent);
                                    }
                                }
                            }

                            var resultCount = 0;
                            $('.quickbooks_import_form').submit(function (e) { 
                                e.preventDefault();
                                const form = $(this);
                                form.find('.resultLabel').text(' ...');
                                $.ajax({
                                    url: "<?php echo base_url('/tools/quickbooks_import/read') ?>",
                                    method: "POST",
                                    data: form.serialize() + "&startPosition=" + 1 + "&maxResults=" + 1,
                                    beforeSend: function() {
                                        formDisabler(form, true);
                                    },
                                    success: function(response) {
                                        formDisabler(form, false);
                                        resultCount = parseInt(response);
                                        if (parseInt(response) > 0) {
                                            form.find('.resultLabel').text(parseInt(response).toLocaleString() + ' records found');
                                            form.find('.importButton').removeAttr('disabled');
                                        } else {
                                            form.find('.resultLabel').text('No record found!');
                                            form.find('.importButton').attr('disabled', 'disabled');
                                        }
                                    },
                                });
                            });
                            
                            $('.importButton').click(function (e) { 
                                const importModal = $('.importModal');
                                const button = $(this);
                                const data = button.closest('form').find('input[name="data"]').val();
                                const dateFrom = button.closest('form').find('input[name="dateFrom"]').val();
                                const dateTo = button.closest('form').find('input[name="dateTo"]').val();
                                const process = 'import';

                                importModal.find('input[name="data"]').val(data);
                                importModal.find('input[name="dateFrom"]').val(dateFrom);
                                importModal.find('input[name="dateTo"]').val(dateTo);

                                importModal.find('.modalTitle').text(data + ' data');
                                importModal.find('.alertMsg > span').html('Are you sure you want to import <strong>' + parseInt(resultCount).toLocaleString() + '</strong> records?'); 
                                importModal.find('.alertMsg').show(); 

                                $('.currentRecordCount').text(0);
                                $('.importProgressBar > div > div').css('width', '0%').text('0%');
                                $('.importProgressBar').hide();
                                $('.importModal').modal('show');
                            });

                            $('.startImport_form').submit(function (e) { 
                                e.preventDefault();
                                const form = $(this);
                                const importModal = $('.importModal');
                                const currentModalTitle = importModal.find('.modal-title').html();
                                importModal.find('.modalTitle').text('Importing...');
                                $('.maxRecordCount').text(parseInt(resultCount).toLocaleString());
                                $('.importProgressBar').show();
                                form.find('.alertMsg').hide();
                                importDataRecursion(form, form.serialize(), 1, resultCount);
                            });

                            function importDataRecursion(form, formData, startPosition, resultCount) {
                                if (resultCount >= 1000) {
                                    $.ajax({
                                        url: "<?php echo base_url('/tools/quickbooks_import/import') ?>",
                                        method: "POST",
                                        data: formData + "&startPosition=" + startPosition + "&maxResults=" + 200,
                                        beforeSend: function() {
                                            formDisabler(form, true);
                                        },
                                        success: function(response) {
                                            if (startPosition + 200 <= resultCount) {
                                                importDataRecursion(form, formData, startPosition + 200, resultCount);
                                                $('.currentRecordCount').text(startPosition + 200 - 1);
                                                var percentage = Math.trunc(((startPosition + 200 - 1) / resultCount) * 100)
                                                $('.importProgressBar > div > div').css('width', percentage + '%').text(percentage  + '%');
                                                $('.modalTitle').text(form.find('input[name="data"]').val());
                                            } else {
                                                formDisabler(form, false);
                                            }
                                        },
                                    });
                                } else {
                                    $.ajax({
                                        url: "<?php echo base_url('/tools/quickbooks_import/import') ?>",
                                        method: "POST",
                                        data: formData + "&startPosition=" + startPosition + "&maxResults=" + resultCount,
                                        beforeSend: function() {
                                            formDisabler(form, true);
                                        },
                                        success: function(response) {
                                            formDisabler(form, false);
                                            $('.currentRecordCount').text(resultCount);
                                            $('.importProgressBar > div > div').css('width', 100 + '%').text(100  + '%');
                                            $('.modalTitle').text(form.find('input[name="data"]').val());
                                            setTimeout(() => {
                                                $('.importModal').modal('hide');
                                                Swal.fire({
                                                    title: "Success!",
                                                    text: "Data was imported successfully.",
                                                    icon: "success"
                                                });
                                            }, 250);
                                        },
                                    });
                                }
                            }
                        });
                    </script>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.connectButton').click(function (e) { 
        $(this).text('Connecting...').attr('class', 'nsm-button small');
        window.location.replace('<?php echo $quickbooks_auth_URL; ?>');
    }); 
    
    $('.disconnectButton').click(function (e) { 
        $(this).text('Disconnecting...').attr('class', 'nsm-button small disconnectButton');
        Swal.fire({   
            title: "Disconnect",
            text: "Do you want to disconnect your quickbooks account?",
            icon: "warning",
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                var url = '<?php echo base_url('tools/_disconnect_quickbook_account') ?>';
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    success: function(data) {     
                        // Swal.fire({
                        //     title: "Success!",
                        //     text: "You quickbooks account was disconnected successfully!",
                        //     icon: "success",
                        //     confirmButtonText: 'Proceed',
                        // }).then((result) => {
                        //     location.reload();
                        // });   
                    },
                });
                Swal.fire({
                            title: "Success!",
                            text: "You quickbooks account was disconnected successfully!",
                            icon: "success",
                            confirmButtonText: 'Proceed',
                        }).then((result) => {
                            location.reload();
                        });   
            } else {
                $('.disconnectButton').text('Disconnect').attr('class', 'nsm-button small disconnectButton');
            }
        });
    });
</script>



<?php 
// $totalData = count($vendorData);

// for ($i = 0; $i < $totalData; $i++) {

    // If Customer's create datetime contains 2023 | Filtering customers that was created on 2023 only
    // if (strpos($vendorData[$i]->MetaData->CreateTime, "2023") !== false) {
    //     echo $vendorData[$i]->GivenName.' '.$vendorData[$i]->FamilyName.'<br>';
    // }
    
    // if ($vendorData[$i]->MetaData->CreateTime == "2023") {
    //     echo $vendorData[$i]->GivenName.' '.$vendorData[$i]->FamilyName.'<br>';
    // }
// }

// echo "<pre>";
// print_r($testData);
// echo "</pre>";
?>
<!-- <?php echo $quickbooks_auth_URL; ?> -->