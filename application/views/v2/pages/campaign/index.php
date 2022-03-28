<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/campaign/campaign_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" data-bs-toggle="modal" data-bs-target="#campaign_360_modal">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Be one step ahead of your competition. Narrow your target audience and connect with your new potential customers.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-2">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field form-control datepicker mb-2" placeholder="Search address, city or state">
                        </div>
                    </div>
                    <div class="col-12 col-md-10 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#campaign_360_modal">
                                <i class='bx bx-fw bx-chat'></i> Create Campaign Blast
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row g-3 align-items-start">
                    <div class="col-12 col-md-9">
                        <div class="nsm-map" style="height: 650px;">
                            <iframe style="width: 100% !important;" width="850" height="650" id="gmap_canvas" src="https://maps.google.com/maps?q=6866%20Pine%20Forest%20Road%20&t=k&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title">
                                            <span>Your selects</span>
                                        </div>
                                        <label class="nsm-subtitle">Consumer</label>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div class="row g-1">
                                            <div class="col-12">
                                                <label class="content-title">You want</label>
                                            </div>
                                            <div class="col-12">
                                                <div class="row align-items-center">
                                                    <div class="col-12 col-md-9">
                                                        <input type="text" placeholder="Lead Count" class="nsm-field form-control mb-1" value="25">
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <label class="content-subtitle">Leads</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="button" data-action="save" class="nsm-button primary">
                                                    Search Leads
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-content">
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="w-100">
                                                    <tbody>
                                                        <tr>
                                                            <td><span class="margin-right-sec">Leads found:</span></td>
                                                            <td class="text-end"><span id="finder-qtycount">0</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="margin-right-sec">Postcards to send:</span></td>
                                                            <td class="text-end"><span id="finder-qtydesired">0</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="margin-right-sec">Price per card:</span></td>
                                                            <td class="text-end"><span id="finder-price-item">$1.10</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="weight-medium">Total Price:</span></td>
                                                            <td class="text-end"><span id="finder-price-total">$0.00</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <button type="button" data-action="save" class="nsm-button">
                                                    Continue
                                                </button>
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
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
<?php include viewPath('v2/includes/footer'); ?>