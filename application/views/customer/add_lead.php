<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>
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
                <input type="hidden" name="leads_id" value="<?= isset($leads_data) ? $leads_data->leads_id : '0'; ?>" />
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
                                        <select class="form-select" id="fk_lead_type_id" name="fk_lead_type_id" required="">
                                            <?php
                                                echo "<option value hidden>Select Type</option>";
                                                foreach ($lead_types as $lt) {
                                                    if($leads_data->fk_lead_type_id == $lt->lead_id){
                                                        echo "<option selected value='$lt->lead_id'>$lt->lead_name</option>";
                                                    } else {
                                                        echo "<option value='$lt->lead_id'>$lt->lead_name</option>";   
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-7 mb-3" >
                                        <span>Sales Representative</span>
                                        <select class="form-select" id="fk_sr_id" name="fk_sr_id">
                                            <?php
                                                foreach ($users as $user) {
                                                    if($leads_data->fk_sr_id == $user->id){
                                                    echo "<option selected value='$user->id'>$user->FName $user->LName</option>";
                                                    } else{
                                                    echo "<option value='$user->id'>$user->FName $user->LName</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <span>Sales Area</span>
                                        <select class="form-select" id="fk_sa_id" name="fk_sa_id">
                                            <?php
                                                foreach ($sales_area as $sales_areas) {
                                                    if($leads_data->fk_sa_id == $sales_areas->sa_id){
                                                    echo "<option selected value='$sales_areas->sa_id'>$sales_areas->sa_name</option>";
                                                    } else{
                                                    echo "<option value='$sales_areas->sa_id'>$sales_areas->sa_name</option>"; 
                                                    }
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
                                        <span>Middlename</span>
                                        <input class="form-control" type="text" name="middlename" id="middlename" value="<?php if(isset($leads_data)){ echo $leads_data->middle_name; } ?>">
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
                                    <div class="col-md-3 mb-3">
                                        <span>Email Address</span>
                                        <input class="form-control" type="email" name="email_add" id="email_add" value="<?php if(isset($leads_data)){ echo $leads_data->email_add; } ?>">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <span>Mobile Number</span>
                                        <input class="form-control phone_number" type="text" maxlength="12" placeholder="xxx-xxx-xxxx" name="phone_cell" id="phone_cell" value="<?php if(isset($leads_data)){ echo $leads_data->phone_cell; } ?>" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <span>Home Phone Number</span>
                                        <input class="form-control phone_number" type="text" name="phone_home" id="phone_home" maxlength="12" placeholder="xxx-xxx-xxxx" value="<?php if(isset($leads_data)){ echo $leads_data->phone_home; } ?>">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <span>Address</span>
                                        <input class="form-control" type="text" name="address" id="customer_address" value="<?php if(isset($leads_data)){ echo $leads_data->address; } ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <span>Country</span>
                                        <input class="form-control" type="text" name="country" id="country" value="<?php if(isset($leads_data)){ echo $leads_data->country; } ?>" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <span>State</span>
                                        <input class="form-control" type="text" name="state" id="state" value="<?php if(isset($leads_data)){ echo $leads_data->state; } ?>" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <span>City</span>
                                        <input class="form-control" type="text" name="city" id="city" value="<?php if(isset($leads_data)){ echo $leads_data->city; } ?>" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <span>County</span>
                                        <input class="form-control" type="text" name="county" id="county" value="<?php if(isset($leads_data)){ echo $leads_data->county; } ?>" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <span>Zip</span>
                                        <input class="form-control" type="text" name="zip" id="zip" value="<?php if(isset($leads_data)){ echo $leads_data->zip; } ?>" required>
                                    </div>                                    
                                    <div class="col-md-3 mb-3">
                                        <span>Social Security Number</span>
                                        <input class="form-control" type="text" maxlength="11" placeholder="xxx-xx-xxxx" class="form-control" name="sss_num" id="sss_num" value="<?php echo $leads_data->sss_num; ?>">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <span>Status</span>
                                        <select class="form-select" id="status" name="status">
                                            <option <?php if(isset($leads_data)){ if($leads_data->status == 'New'){echo "selected";} } ?> value="New">New</option>
                                            <option <?php if(isset($leads_data)){ if($leads_data->status == 'Contacted'){echo "selected";} } ?> value="Contacted">Contacted</option>
                                            <option <?php if(isset($leads_data)){ if($leads_data->status == 'Follow Up'){echo "selected";} } ?> value="Follow Up">Follow Up</option>                                            
                                            <option <?php if(isset($leads_data)){ if($leads_data->status == 'Converted'){echo "selected";} } ?> value="Converted">Converted</option>
                                            <option <?php if(isset($leads_data)){ if($leads_data->status == 'Closed'){echo "selected";} } ?> value="Closed">Closed</option>
                                        </select>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12">                                        
                                        <div class="form-group float-end">
                                            <button type="button" name="convert_customer" class="nsm-button primary btn-convert-customer" style="display:none;"><span class="fa fa-exchange"></span>Convert to Customer</button>
                                            <button type="submit" class="nsm-button primary">Save</button>
                                            <button type="button" class="nsm-button primary" id="btn-cancel">Cancel</button>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script>
    $('#btn-cancel').on('click', function(){
        location.href = base_url + 'customer/leads';
    });

    $("#new_lead_form").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        $.ajax({
            type: "POST",
            url: base_url + "customer/save_new_lead",
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                console.log(data);
                 if(data === "Saved"){
                    sucess_add('','Lead data has been saved successfully.','success');
                 }else{
                    sucess_add('Sorry!', data.msg,'error');
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
            //if (result.value) {
                window.location.href='<?= base_url(); ?>customer/leads';
            //}
        });
    }

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
                    sucess_adds('Good Job!','Successfully Added to Customer!','success', data.last_id);
                }else{
                    sucess_adds('Sorry!','Something Goes Wrong!','error');
                }
            }
        });
    });

    function sucess_adds($title,information,icon, prof_id){
        Swal.fire({
            title: $title,
            text: information,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#32243d',
            confirmButtonText: 'Back to Leads',
            cancelButtonText: 'Go to Edit Customer'
        }).then((result) => {
            if (result.isConfirmed && result.value) {
                window.location.href='<?= base_url(); ?>customer/leads';
            } else if (result.dismiss === Swal.DismissReason.cancel){
                window.location.href = '<?= base_url("customer/add_advance/"); ?>' + prof_id;  
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
