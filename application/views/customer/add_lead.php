<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>
<?php include viewPath('customer/css/import_customer_css'); ?>

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
                            To create new lead go to Lead TAB and Select new. Enter all the Lead information as shown below.
                                    Enter Address information.  Enter Additional Information and Description
                                    and Finally click Save Button.  All required fields must have information.
                        </div>
                    </div>
                </div>


            <form method="post" id="new_lead_form">
                <div class="row">
                    <div class="col-lg-5 mb-3">
                        <div class="nsm-card primary" style="height: auto;">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span class="d-block">
                                        <div class="right-text">
                                            <span class="page-title " style="font-weight: bold;font-size: 18px;">General Information</span>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <hr>
                            <div class="nsm-card-body">
                                <div class="row">
                                    <div class="col-md-5 mb-3">
                                        <span>Lead Type</span>
                                        <select class="form-select" id="fk_lead_id" name="fk_lead_id">
                                            <?php
                                                echo "<option value hidden>Select Type</option>";
                                                foreach ($lead_types as $lt) {
                                                    echo "<option value='$lt->lead_id'>$lt->lead_name</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-7 mb-3" >
                                        <span>Sales Representative</span>
                                        <select class="form-select" id="fk_sr_id" name="fk_sr_id">
                                            <?php
                                                foreach ($users as $user) {
                                                    echo "<option value='$user->id'>$user->FName $user->LName</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <span>Sales Area</span>
                                        <select class="form-select" id="fk_sa_id" name="fk_sa_id">
                                            <?php
                                                foreach ($sales_area as $sales_areas) {
                                                    echo "<option value='$sales_areas->sa_id'>$sales_areas->sa_name</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <span>Assigned To</span>
                                        <select class="form-select" id="fk_assign_id" name="fk_assign_id">
                                            <?php
                                                foreach ($users as $user) {
                                                    echo "<option value='$user->id'>$user->FName $user->LName</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 mb-3">
                        <div class="nsm-card primary" style="height: auto;">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span class="d-block">
                                        <div class="right-text">
                                            <span class="page-title " style="font-weight: bold;font-size: 18px;">Contact Information</span>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <hr>
                            <div class="nsm-card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <span>Firstname</span>
                                        <input class="form-control" type="text" name="firstname" id="firstname" value="<?php if(isset($leads_data)){ echo $leads_data->firstname; } ?>" required>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <span>Middle Initial</span>
                                        <input class="form-control" type="text" maxlength="1" oninput="$(this).val($(this).val().toUpperCase())" name="middle_initial" id="middle_initial" value="<?php if(isset($leads_data)){ echo $leads_data->middle_initial; } ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <span>Lastname</span>
                                        <input class="form-control" type="text" name="lastname" id="lastname" value="<?php if(isset($leads_data)){ echo $leads_data->lastname; } ?>"  required>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <span>Suffix</span>
                                        <select class="form-select" id="suffix" name="suffix">
                                            <?php
                                                for ($suffix = 0;$suffix < 14;$suffix++) {
                                                    if ($leads_data->suffix == suffix_name($suffix)) {
                                                        echo "<option selected value='".suffix_name($suffix)."'>".suffix_name($suffix)."</option>";
                                                    } else {
                                                        echo "<option value='".suffix_name($suffix)."'>".suffix_name($suffix)."</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <span>Birthdate</span>
                                        <input class="form-control" type="date" name="date_of_birth" id="date_of_birt" value="<?php if(isset($leads_data)){ echo $leads_data->date_of_birth; } ?>">
                                    </div>
                                    <div class="col-md-9 mb-3">
                                        <span>Address</span>
                                        <input class="form-control" type="text" name="address" id="customer_address" value="<?php if(isset($leads_data)){ echo $leads_data->address; } ?>" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <span>State</span>
                                        <input class="form-control" type="text" name="state" id="state" value="<?php if(isset($leads_data)){ echo $leads_data->state; } ?>" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <span>City</span>
                                        <input class="form-control" type="text" name="city" id="city" value="<?php if(isset($leads_data)){ echo $leads_data->city; } ?>" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <span>Country</span>
                                        <input class="form-control" type="text" name="country" id="country" value="<?php if(isset($leads_data)){ echo $leads_data->country; } ?>" required>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <span>Zip</span>
                                        <input class="form-control" type="text" name="zip" id="zip" value="<?php if(isset($leads_data)){ echo $leads_data->zip; } ?>" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <span>Home/Panel Phone</span>
                                        <input class="form-control phone_number" type="text" name="phone_home" id="phone_home" maxlength="12" placeholder="xxx-xxx-xxxx" value="<?php if(isset($leads_data)){ echo $leads_data->phone_home; } ?>">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <span>Cell Phone</span>
                                        <input class="form-control phone_number" type="text" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_cell" id="phone_cell" value="<?php if(isset($leads_data)){ echo $leads_data->phone_cell; } ?>" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <span>Email Address</span>
                                        <input class="form-control" type="email" name="email_add" id="email_add" value="<?php if(isset($leads_data)){ echo $leads_data->email_add; } ?>">
                                    </div>
                                    <div class="col-md-9 mb-3">
                                        <span>Social Security Number</span>
                                        <input class="form-control" type="text" maxlength="11" placeholder="xxx-xx-xxxx" class="form-control" name="sss_num" id="sss_num" value="<?php echo $leads_data->sss_num; ?>">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <span>Status</span>
                                        <select class="form-select" id="status" name="status">
                                            <option <?php if(isset($leads_data)){ if($leads_data->status == 'New'){echo "selected";} } ?> value="New">New</option>
                                            <option <?php if(isset($leads_data)){ if($leads_data->status == 'Contacted'){echo "selected";} } ?> value="Contacted">Contacted</option>
                                            <option <?php if(isset($leads_data)){ if($leads_data->status == 'Follow Up'){echo "selected";} } ?> value="Follow Up">Follow Up</option>
                                            <option <?php if(isset($leads_data)){ if($leads_data->status == 'Assigned'){echo "selected";} } ?> value="Assigned">Assigned</option>
                                            <option <?php if(isset($leads_data)){ if($leads_data->status == 'Converted'){echo "selected";} } ?> value="Converted">Converted</option>
                                            <option <?php if(isset($leads_data)){ if($leads_data->status == 'Closed'){echo "selected";} } ?> value="Closed">Closed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div class="nsm-card primary" style="height: auto;">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span class="d-block">
                                        <div class="right-text">
                                            <span class="page-title " style="font-weight: bold;font-size: 18px;">New Credit Report</span>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <hr>
                            <div class="nsm-card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <select class="form-select" id="credit_report" name="credit_report">
                                            <option value="TrunsUnion">TransUnion</option>
                                            <option value="Experian">Experian</option>
                                            <option value="Equifax">Equifax</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="nsm-button primary" type="submit">Run Credit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div class="nsm-card primary" style="height: auto;">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span class="d-block">
                                        <div class="right-text">
                                            <span class="page-title " style="font-weight: bold;font-size: 18px;">Report History</span>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <hr>
                            <div class="nsm-card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <input value="No History" type="text" class="form-control" name="report_history" disabled id="report_history"/>
                                    </div>
                                    <div class="col-md-12">
                                        <?php
                                            if(isset($leads_data)){
                                        ?>
                                            <input value="<?=  $leads_data->leads_id; ?>" type="hidden" class="form-control" name="leads_id" />
                                        <?php
                                            }
                                        ?>
                                        <button type="button" name="convert_customer" class="nsm-button primary btn-convert-customer"><span class="fa fa-exchange"></span>Convert to Customer</button>
                                            <div class="form-group float-end">
                                                <button type="submit" class="nsm-button primary"><i class='bx bxs-paper-plane'></i> Save</button>
                                                <a href="<?php echo base_url('customer/leads'); ?>"><button type="button" class="nsm-button primary"><i class='bx bx-window-close'></i> Cancel</button></a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

                <!-- end form -->
            </div>
        </div>
    </div>
</div>


<?php include viewPath('v2/includes/footer'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initMap&libraries=places&v=weekly&sensor=false"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<script >
    $("#new_lead_form").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        $.ajax({
            type: "POST",
            url: "<?= base_url()?>customer/save_new_lead",
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                console.log(data);
                 if(data === "Saved"){
                    sucess_add('Good Job!','Successfully Added!','success');
                 }else{
                    sucess_add('Sorry!', data.msg,'error');
                }
            }
        });
    });

    $(document).on('click', '.btn-convert-customer', function(){
        var form = $('#new_lead_form');
        $.ajax({
            type: "POST",
            url: "<?= base_url()?>customer/convert_to_customer",
            dataType:'json',
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                if( data.is_success == 1 ){
                    sucess_add('Good Job!','Successfully Added to Customer!','success');
                }else{
                    sucess_add('Sorry!','Something Goes Wrong!','error');
                }
            }
        });
    });

    function sucess_add($title,information,icon){
        Swal.fire({
            title: $title,
            text: information,
            icon: icon,
            showCancelButton: false,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value) {
                window.location.href='<?= base_url(); ?>customer/leads';
            }
        });
    }

    var autocomplete;
    function initMap() {
        var input = document.getElementById('address');
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
                    $('#zip').val(component.long_name);
                    break;
                }
                case "country": {
                    $('#country').val(component.long_name);
                    break;
                }
                case "route": {
                    $('#address').val(street +' '+ component.long_name);
                    break;
                }
                case "locality": {
                    $('#city').val(component.long_name);
                    break;
                }
                case "administrative_area_level_1": {
                    $('#state').val(component.short_name);
                    break;
                }
            }
        }
        console.log(place);
    }
    
    var date = new Date();
    date.setFullYear(date.getFullYear() - 10);
    date.setMonth(0);
    date.setDate(1);


    $('#date_of_birth').datepicker({
          //format: 'yyyy-mm-dd',
        autoclose: true,
    }).datepicker("setDate", date);

    $(function () {
        $('#sss_num').keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            $text = $(this);
            if (key !== 8 && key !== 9) {
                if ($text.val().length === 3) {
                    $text.val($text.val() + '-');
                }
                if ($text.val().length === 6) {
                    $text.val($text.val() + '-');
                }
            }
            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
        });

        $('.phone_number').keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            $text = $(this);
            if (key !== 8 && key !== 9) {
                if ($text.val().length === 3) {
                    $text.val($text.val() + '-');
                }
                if ($text.val().length === 7) {
                    $text.val($text.val() + '-');
                }
            }
            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
        });
    });
</script>

<style>
    .btn-primary.disabled, .btn-primary:disabled {
        color: #000 !important;
        background-color: #ccc !important;
        border-color: #ccc !important;
    }
</style>
