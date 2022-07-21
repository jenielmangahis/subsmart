<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('customer/add_lead') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            This powerful module widget will help you gather and customized each field information you like to gather from each customer. 
                            Each fields can be group into categories to smoothly log the entries of each customer.
                        </div>
                    </div>
                </div>
                <form id="customer_form">
                    <div class="row g-3 align-items-start">
                        <div class="col-12 col-md-12">
                            <div class="row ">
                                <?php include viewPath('v2/pages/customer/advance_customer_forms/customer_papers'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <?php include viewPath('v2/pages/customer/advance_customer_forms/customer_profile'); ?>
                        </div>
                        <div class="col-md-4">
                            <?php include viewPath('v2/pages/customer/advance_customer_forms/customer_office_info'); ?>
                        </div>
                        <div class="col-md-4">
                            <?php include viewPath('v2/pages/customer/advance_customer_forms/customer_alarm_info'); ?>
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" value="<?php if(isset($profile_info)){ echo $profile_info->prof_id; } ?>" class="form-control" name="prof_id" id="prof_id" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url("assets/js/v2/printThis.js") ?>"></script>
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

<?php include viewPath('v2/includes/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" integrity="sha512-2xXe2z/uA+2SyT/sTSt9Uq4jDKsT0lV4evd3eoE/oxKih8DSAsOF6LUb+ncafMJPAimWAXdu9W+yMXGrCVOzQA==" crossorigin="anonymous"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initMap&libraries=places&v=weekly&sensor=false"></script>
    <script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
    <script >
    var autocomplete;
        function initMap() {
            var input = document.getElementById('mail_add');
            autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener("place_changed", fillInAddress);

        }
    function fillInAddress(){
        var place = autocomplete.getPlace();
        var street="";
        for (const component of place.address_components) {
            const componentType = component.types[0];
            switch (componentType) {
                case "street_number": {
                    //$('#cross_street').val(component.long_name);
                    street = component.long_name;
                    break;
                }
                case "postal_code": {
                    $('#zip_code').val(component.long_name);
                    $('#billing_zip').val(component.long_name);
                    break;
                }
                case "country": {
                    $('#country').val(component.long_name);
                    break;
                }
                case "route": {
                    $('#mail_add').val(street +' '+ component.long_name);
                    $('#card_address').val(street +' '+ component.long_name);
                    break;
                }
                case "locality": {
                    $('#city').val(component.long_name);
                    $('#billing_city').val(component.long_name);
                    break;
                }
                case "administrative_area_level_1": {
                    $('#state').val(component.short_name);
                    $('#billing_state').val(component.short_name);
                    break;
                }
            }
        }
        console.log(place);
    }

    window.document.addEventListener("DOMContentLoaded", () => {
        const params = new Proxy(new URLSearchParams(window.location.search), {
            get: (searchParams, prop) => searchParams.get(prop),
        });
        const $section = document.querySelector(`[data-section=${params.section}]`);
        if ($section) {
            const $header = document.getElementById("topnav");
            const sectionRect = $section.getBoundingClientRect();
            const headerRect = $header.getBoundingClientRect();
            window.scroll({top: ((sectionRect.top + window.scrollY) - headerRect.height * 2), behavior: "smooth"});
            $section.classList.add("active-section");
        }
    });
</script>
<style>
.active-section {
    transition: background-color 0.3s;
    animation: active-section 0.5s 2;
}
@keyframes active-section {
  0%, 49% { background-color: transparent; }
  50%, 100% { background-color: #e4e4e4; }
}
</style>
<?php include viewPath('v2/pages/customer/js/add_advance_js'); ?>