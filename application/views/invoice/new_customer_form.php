<form id="frm_new_customer" name="modal-form" style="display: block;">
    <div class="validation-error" style="display: none;"></div>

    <?php if (!empty($customer)) { ?>
        <input type="hidden" name="customer_id" value="<?php echo (!empty($customer)) ? $customer->id : '' ?>">
    <?php } ?>

    <?php if (!empty($action)) { ?>
        <input type="hidden" name="action_type" value="<?php echo (!empty($action)) ? $action : '' ?>">
    <?php } ?>

    <?php if (isset($data_index)) { ?>
        <input type="hidden" name="data_index" value="<?php echo (isset($data_index)) ? $data_index : '' ?>">
    <?php } ?>
    <style>
.modal { z-index: 1001 !important;} 
.modal-backdrop {z-index: 1000 !important;}
.pac-container {z-index: 1055 !important;}
</style>

    <div class="card-body pb-0">
        <div class="row">
            <div class="col-md-12 margin-bottom-ter no-padding">
                <div class="form-group" id="customer_type_group">
                    <label for="">Customer Type</label><br/>
                    <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                        <input type="radio" name="customer_type" value="Residential"
                                checked="checked" id="customer_type"
                                onchange="toggle_advance_options()">
                        <label for="customer_type"><span>Residential</span></label>
                    </div>
                    <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                        <input type="radio" name="customer_type" value="Commercial" id="Commercial"
                                onchange="toggle_advance_options()">
                        <label for="Commercial"><span>Commercial</span></label>
                    </div>
                    <div class="checkbox checkbox-sec margin-right my-0">
                        <input type="radio" name="customer_type" value="Advance" id="advance"
                                onchange="toggle_advance_options()">
                        <label for="advance"><span>Other</span></label>
                    </div>
                </div>
                
            <div class="col-md-6 pr-0 form-group" style="display:none;margin-left:-15px;" id="business_name_area">
                <label for="business_name">Business Name</label>
                <input type="text" class="form-control" name="business_name" id="business_name"
                        required placeholder="Enter Name"
                        onChange="jQuery('#business_name').text(jQuery(this).val());"/>
            </div>

            </div>
            
            <!-- <div class="col-md-6 pl-0 pr-0 form-group">
                <label for="contact_name">Contact Name</label>
                <input type="text" class="form-control" name="contact_name" id="contact_name"
                        required placeholder="Enter Name" autofocus
                        onChange="jQuery('#customer_name').text(jQuery(this).val());"/>
            </div> -->
            <div class="col-md-6 pl-0 pr-0 form-group">
                <label for="contact_name">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name"
                        required placeholder="Enter First Name" required/>
            </div>
            <div class="col-md-6 pr-0 form-group">
                <label for="contact_name">Middle Name</label>
                <input type="text" class="form-control" name="middle_name" id="middle_name"
                        required placeholder="Enter Middle Name" required/>
            </div>
            <div class="col-md-6 pl-0 pr-0 form-group">
                <label for="contact_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name"
                        required placeholder="Enter Last Name" required/>
            </div>
            <div class="col-md-6 pr-0 form-group">
                <label for="contact_email">Contact Email</label>
                <input type="email" class="form-control" name="contact_email" id="contact_email"
                        placeholder="Enter Email" required/>
            </div>
            <div class="col-md-6 pl-0 pr-0 form-group">
                <label for="contact_mobile">Mobile</label>
                <input type="text" class="form-control" name="contact_mobile" id="contact_mobile"
                        placeholder="(555) 555-5555" required/>
            </div>
            <div class="col-md-6 pr-0 form-group">
                <label for="contact_phone">Phone</label>
                <input type="text" class="form-control" name="contact_phone" id="contact_phone"
                        placeholder="(555) 555-5555"/>
            </div>
        </div>

        <div class="row">
            <div class="col-auto pl-0 form-group">
                <label for="">Preferred notification method</label><br/>
                <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                    <input type="checkbox" name="notify_by_email" value="1" checked
                            id="notify_by_email">
                    <label for="notify_by_email"><span>Notify By Email</span></label>
                </div>
                <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                    <input type="checkbox" name="notify_by_sms" value="1" id="notify_by_sms" checked>
                    <label for="notify_by_sms"><span>Notify By SMS/Text</span></label>
                </div>
            </div>
        </div>
        <div class="row">
            <a class="link-modal-open" href="javascript:void(0)" id="hide_more_info" style="display:none;">
            <span class="fa fa-minus fa-margin-right"></span>Add More Info</a>
            <a class="link-modal-open" href="javascript:void(0)" id="show_more_info">
            <span class="fa fa-plus fa-margin-right"></span>Add More Info</a>
        </div>
        <div id="customer_additional_info" style="display: none;">
            <div class="row pt-3">
                <div class="col-md-6 pl-0 pr-0 form-group">
                    <label for="street_address">Street Address</label>
                    <!-- <input type="text" class="form-control" name="street_address" id="street_address"/> -->
                    <!-- <input id="ship-address" name="street_address"  class="form-control" placeholder="Enter your address"
                  onFocus="geolocate()" type="text"></input> -->
                  <input id="ship-address" name="street_address"  class="form-control" placeholder="Enter your address" type="text"></input>
                  <!-- <input id="ship-address" name="ship-address" required autocomplete="off" /> -->
                  <!-- <input id="address2" name="address2" />
                  <input id="locality" name="locality" required />
                  <input id="state" name="state" required /> -->
                  <!-- <input id="postcode" name="postcode" required /> -->
                  <input type="hidden" id="country" name="country" required />
                  
                </div>
                <div class="col-md-6 pr-0 form-group">
                    <label for="suite_unit">Suite/Unit</label>
                    <input type="text" class="form-control" name="suite_unit" id="suite_unit" placeholder="Enter Name"/>
                </div>

                <div class="col-md-4 pl-0 pr-0 form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" name="city" id="locality" placeholder="Enter Name" />
                </div>
                <div class="col-md-4 pr-0 form-group">
                    <label for="zip">Zip/Postal Code</label>
                    <input type="text" id="postcode" name="postcode" class="form-control" />
                </div>
                <div class="col-md-4 pr-0 form-group">
                    <label for="state">State/Province</label>
                    <select name="state" id="state" class="form-control">
                        <option value="" selected="selected">- select -</option>
                        <?php foreach (get_config_item('states') as $key => $state) { ?>
                            <option value="<?php echo $key ?>"><?php echo $state; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row" id="advance_customer_view" style="display: none">

                <div class="row p-3">
                    <div class="col-md-12">
                        <h3>Account Information</h3>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="monitoring_id">Monitoring ID</label>
                        <input type="text" class="form-control" name="additional[monitoring_id]"
                                id="monitoring_id" placeholder="Monitoring ID"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="signal_confirmation_number">Signals Confirmation Number</label>
                        <input type="text" class="form-control"
                                name="additional[signal_confirmation_number]"
                                id="signal_confirmation_number"
                                placeholder="Enter Signals Confirmation Number"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="monitoring_confirmation">Monitoring Confirmation</label>
                        <input type="text" class="form-control"
                                name="additional[monitoring_confirmation]" id="monitoring_confirmation"
                                placeholder="Enter Monitoring Confirmation"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="customer_language">Language</label>
                        <select id="customer_language" name="additional[customer_language]"
                                class="form-control" placeholder="Select Language" disabled>
                            <option value="0">- none -</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="abort_code">Abort Code</label>
                        <input type="text" class="form-control" name="additional[abort_code]"
                                id="abort_code" placeholder="Enter Abort Code"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-md-6 form-group">
                        <label for="sales_rep">Sales Representative</label>
                        <input type="text" class="form-control" name="additional[sales_rep]"
                                id="sales_rep" placeholder="Enter Sales Representative"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="sales_rep_phone">Representative Phone Number</label>
                        <input type="text" class="form-control" name="additional[sales_rep_phone]"
                                id="sales_rep_phone" placeholder="Enter Phone Number"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="technician">Technician</label>
                        <input type="text" class="form-control" name="additional[technician]"
                                id="technician" placeholder="Enter Technician"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="technician_phone">Technician Phone Number</label>
                        <input type="text" class="form-control" name="additional[technician_phone]"
                                id="technician_phone" placeholder="Enter Technician Phone Number"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-md-4 form-group">
                        <label for="install_date">Install Date</label>
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" name="additional[install_date]"
                                    id="install_date" disabled>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <div data-calendar="time-end-container">
                            <label for="technician_arrival_time">Technician Arrival Time</label>
                            <div class="form-group">
                                <div class='input-group date timepicker'>
                                    <input type='text' name="additional[technician_arrival_time]"
                                            class="form-control" id="technician_arrival_time" disabled/>
                                </div>
                            </div>
                            <span class="validation-error-field" data-formerrors-for-name="time_end"
                                    data-formerrors-message="true" style="display: none;"></span>
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <div data-calendar="time-end-container">
                            <label for="technician_departure_time">Technician Departure Time</label>
                            <div class="form-group">
                                <div class='input-group date timepicker'>
                                    <input type='text' name="additional[technician_departure_time]"
                                            class="form-control" id="technician_departure_time"
                                            disabled/>
                                </div>
                            </div>
                            <span class="validation-error-field" data-formerrors-for-name="time_end"
                                    data-formerrors-message="true" style="display: none;"></span>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="panel_type">Panel Type</label>
                        <input type="text" class="form-control" name="additional[panel_type]"
                                id="panel_type" placeholder="Enter Panel Type"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="system_type">System Type</label>
                        <input type="text" class="form-control" name="additional[system_type]"
                                id="system_type" placeholder="Enter System Type"
                                onChange="jQuery('#customer_name').text(jQuery(this).val());" disabled/>
                    </div>
                </div>


                <div class="row p-3">
                    <div class="col-md-12">
                        <h3>Credit Card Information</h3>
                    </div>
                    <div class=" col-md-12">
                        Credit Card Type:
                        <div class="checkbox checkbox-sec card-types margin-right mr-4">
                            <input type="radio" name="card[radio_credit_card]" value="Visa"
                                    checked="checked" id="radio_credit_card" disabled>
                            <label for="radio_credit_card"><span>Visa</span></label>
                        </div>
                        <div class="checkbox checkbox-sec margin-right mr-4">
                            <input type="radio" name="card[radio_credit_card]" value="Amex"
                                    id="radio_credit_cardAmex" disabled>
                            <label for="radio_credit_cardAmex"><span>Amex</span></label>
                        </div>
                        <div class="checkbox checkbox-sec margin-right mr-4">
                            <input type="radio" name="card[radio_credit_card]" value="Mastercard"
                                    id="radio_credit_cardMastercard" disabled>
                            <label for="radio_credit_cardMastercard"><span>Mastercard</span></label>
                        </div>
                        <div class="checkbox checkbox-sec margin-right mr-4">
                            <input type="radio" name="card[radio_credit_card]" value="Discover"
                                    id="radio_credit_cardMasterDiscover" disabled>
                            <label for="radio_credit_cardMasterDiscover"><span>Discover</span></label>
                        </div>

                    </div>
                    <div class=" col-md-12">
                        <div class="row" style="border:none; margin-bottom:20px; padding-bottom:0px;">
                            <div class=" col-md-6">
                                <label for="card_no">Card Number</label>
                                <input type="text" class="form-control card-number required"
                                        name="card[card_no]" id="card_no" placeholder="" required
                                        disabled/>
                            </div>
                            <div class="col-md-2">
                                <label class='form-label'>Expiration Month</label>
                                <input class='form-control card-expiry-month required'
                                        name="card[exp_month]" maxlength="256" placeholder='MM' size='2'
                                        min="1" max="12" value="" type='number' required disabled/>
                            </div>
                            <div class=" col-md-2">
                                <label for="exp_date">Expiration year</label>
                                <input type="text" class="form-control card-expiry-year required"
                                        name="card[exp_date]" id="exp_date" min="<?php echo date('Y') ?>"
                                        max="<?php echo date(Y) + 50 ?>" placeholder="" required
                                        disabled/>
                            </div>
                            <div class=" col-md-2">
                                <label for="cvv">CVV#</label>
                                <input type="text" class="form-control card-cvc required"
                                        name="card[cvv]" id="cvv" placeholder="" required disabled/>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</form>
             
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMWhWMHlxQzuolWb2RrfUeb0JyhhPO9c&libraries=places" async defer></script>
<script>
function initialize() {
          var input = document.getElementById('street_address');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('city2').value = place.name;
                document.getElementById('cityLat').value = place.geometry.location.lat();
                document.getElementById('cityLng').value = place.geometry.location.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
</script> -->

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMWhWMHlxQzuolWb2RrfUeb0JyhhPO9c&libraries=places&callback=initAutocomplete" async defer>
    </script>
    <script>
    var placeSearch, autocomplete;
    var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
  };

  function initAutocomplete() {
   autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
        {types: ['geocode']});
   autocomplete.addListener('place_changed', fillInAddress);
  }

  function fillInAddress() {
    var place = autocomplete.getPlace();

    for (var component in componentForm) {
      document.getElementById(component).value = '';
      document.getElementById(component).disabled = false;
    }

    for (var i = 0; i < place.address_components.length; i++) {
      var addressType = place.address_components[i].types[0];
      if (componentForm[addressType]) {
        var val = place.address_components[i][componentForm[addressType]];
        document.getElementById(addressType).value = val;
      }
    }
  }

  function geolocate() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
      });
    }
  }
</script> -->

<script>
      // This sample uses the Places Autocomplete widget to:
      // 1. Help the user select a place
      // 2. Retrieve the address components associated with that place
      // 3. Populate the form fields with those address components.
      // This sample requires the Places library, Maps JavaScript API.
      // Include the libraries=places parameter when you first load the API.
      // For example: <script
      // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      let autocomplete;
      let address1Field;
      let address2Field;
      let postalField;

      function initAutocomplete() {
        address1Field = document.querySelector("#ship-address");
        address2Field = document.querySelector("#address2");
        postalField = document.querySelector("#postcode");
        // Create the autocomplete object, restricting the search predictions to
        // addresses in the US and Canada.
        autocomplete = new google.maps.places.Autocomplete(address1Field, {
          componentRestrictions: { country: ["us", "ca"] },
          fields: ["address_components", "geometry"],
          types: ["address"],
        });
        address1Field.focus();
        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener("place_changed", fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        const place = autocomplete.getPlace();
        let address1 = "";
        let postcode = "";

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        // place.address_components are google.maps.GeocoderAddressComponent objects
        // which are documented at http://goo.gle/3l5i5Mr
        for (const component of place.address_components) {
          const componentType = component.types[0];

          switch (componentType) {
            case "street_number": {
              address1 = `${component.long_name} ${address1}`;
              break;
            }

            case "route": {
              address1 += component.short_name;
              break;
            }

            case "postal_code": {
              postcode = `${component.long_name}${postcode}`;
              break;
            }

            case "postal_code_suffix": {
              postcode = `${postcode}-${component.long_name}`;
              break;
            }
            case "locality":
              document.querySelector("#locality").value = component.long_name;
              break;

            case "administrative_area_level_1": {
              document.querySelector("#state").value = component.short_name;
              break;
            }
            case "country":
              document.querySelector("#country").value = component.long_name;
              break;
          }
        }
        address1Field.value = address1;
        postalField.value = postcode;
        // After filling the form with address components from the Autocomplete
        // prediction, set cursor focus on the second address line to encourage
        // entry of subpremise information such as apartment, unit, or floor number.
        address2Field.focus();
      }
    </script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMWhWMHlxQzuolWb2RrfUeb0JyhhPO9c&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script>
