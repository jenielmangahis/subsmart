<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/tools/api_connectors_modals'); ?>
<link rel="stylesheet" href="<?= base_url("assets/css/daterange/daterangepicker.css") ?>">

<!-- CSS and JS Imports -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.1/apexcharts.min.css" integrity="sha512-qc0GepkUB5ugt8LevOF/K2h2lLGIloDBcWX8yawu/5V8FXSxZLn3NVMZskeEyOhlc6RxKiEj6QpSrlAoL1D3TA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.1/apexcharts.min.js" integrity="sha512-mDe5mwqn4f61Fafj3rll7+89g6qu7/1fURxsWbbEkTmOuMebO9jf1C3Esw95oDfBLUycDza2uxAiPa4gdw/hfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        <label for="">Import accounting data.</label>
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
                    <div class="col-lg-12">
                        <?php if ($loginStatus == 1): ?>
                            <strong>QuickBooks Account</strong>
                            <p class="text-muted fw-normal-custom mt-1">
                                <span class="companyName"><?php echo $companyQBInfo->CompanyName; ?></span>
                                <br>
                                <span class="companyAddress"><?php echo $companyQBInfo->CompanyAddr->Line1.", ".$companyQBInfo->CompanyAddr->City." ".$companyQBInfo->CompanyAddr->CountrySubDivisionCode.", ".$companyQBInfo->CompanyAddr->PostalCode; ?></span>
                            </p>
                            <hr>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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

echo "<pre>";
print_r($vendorData);
echo "</pre>";
?>
<!-- <?php echo $quickbooks_auth_URL; ?> -->

<script>
    $('.connectButton').click(function (e) { 
        $(this).text('Connecting...').attr('class', 'nsm-button small');
        window.location.replace('<?php echo $quickbooks_auth_URL; ?>');
    }); 

    $('.disconnectButton').click(function (e) { 
        $(this).text('Disconnecting...').attr('class', 'nsm-button small');
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
                        Swal.fire({
                            title: "Success!",
                            text: "You quickbooks account was disconnected successfully!",
                            icon: "success",
                            confirmButtonText: 'Proceed',
                        }).then((result) => {
                            location.reload();
                        });   
                    },
                });
            } else {
                $('.disconnectButton').text('Disconnect').attr('class', 'nsm-button small disconnectButton');
            }
        });
    });
</script>