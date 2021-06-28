<?php
defined('BASEPATH') or exit('No direct script access allowed');
add_css(array(
    'assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
));
?>

<?php include viewPath('includes/header'); ?>
<?php include viewPath('customer/css/add_advance_css'); ?>
    <div class="wrapper" role="wrapper">
        <div id="overlay">
            <div>
                <img src="<?=base_url()?>/assets/img/uploading.gif" class="" style="width: 80px;" alt="" />
                <center><p>Processing...</p></center></div>
        </div>
        <?php include viewPath('includes/sidebars/customer'); ?>
        <!-- page wrapper start -->
        <div wrapper__section>
            <div class="container-fluid p-40">
                <form id="customer_form">
                  <div class="card">
                    <div class="row pl-0 pr-0">
                        <div class="col-md-12 pl-0 pr-0">
                            <div class="col-md-12 pr-3" style="padding-left: 15px;">
                                <h3 class="page-title mt-0">New Advance Customer</h3>
                                <div class="pl-3 pr-3 mt-1 row">
                                  <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                      <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                                          This powerful module widget will help you gather and customized each field information you like to gather from each customer.  Each fields can be group into categories to smoothly log the entries of each customer.
                                      </span>
                                  </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                        <div class="row ">
                            <?php include viewPath('customer/advance_customer_forms/customer_papers'); ?>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <?php include viewPath('customer/advance_customer_forms/customer_profile'); ?>
                        </div>
                        <div class="col-md-4">
                            <?php include viewPath('customer/advance_customer_forms/customer_office_info'); ?>
                        </div>
                        <div class="col-md-4">
                            <?php include viewPath('customer/advance_customer_forms/customer_alarm_info'); ?>
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" value="<?php if(isset($profile_info)){ echo $profile_info->prof_id; } ?>" class="form-control" name="prof_id" id="prof_id" />
                        </div>
                     </div>
                </form>
            </div>
        <!-- end container-fluid -->
            <?php
            // JS to add only Customer module
            add_footer_js(array(
                'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
                'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
                'assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
            ));
            ?>
    <?php include viewPath('includes/footer'); ?>
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
</script>
<?php include viewPath('customer/js/add_advance_js'); ?>
