<?php
defined('BASEPATH') or exit('No direct script access allowed');
add_css(array(
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
));
?>

<?php include viewPath('includes/header'); ?>
<?php include viewPath('customer/css/add_advance_css'); ?>
    <div class="wrapper" role="wrapper">
        <?php include viewPath('includes/sidebars/customer'); ?>
        <!-- page wrapper start -->
        <div wrapper__section>
            <div class="container-fluid p-40">

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
                            <button class="btn btn-primary btn-md" onclick="print_data_sheet()">
                                <span class="fa fa-print "></span> Print</button>
                        </div>

                    </div>
                  </div>
              </div>
                <form id="customer_form">
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

                        <!-- Lead Type Modal -->
                        <div class="modal fade" id="modal_assign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Assign</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="modal_form_assign">
                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Assign Name</label><br/>
                                                    <select id="fk_user_id" name="fk_user_id" data-customer-source="dropdown" class="form-control searchable-dropdown" required>
                                                        <option value="">Select</option>
                                                        <?php foreach ($employees as $employee): ?>
                                                            <option value="<?= $employee->id; ?>"><?= $employee->FName.' '.$employee->LName; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <input type="hidden" class="form-control" name="fk_prof_id" id="fk_prof_id" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

            <?php
            // JS to add only Customer module
            add_footer_js(array(
                'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
                'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
            ));
            ?>
<?php include viewPath('includes/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" integrity="sha512-2xXe2z/uA+2SyT/sTSt9Uq4jDKsT0lV4evd3eoE/oxKih8DSAsOF6LUb+ncafMJPAimWAXdu9W+yMXGrCVOzQA==" crossorigin="anonymous"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initMap&libraries=places&v=weekly&sensor=false"></script>

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
