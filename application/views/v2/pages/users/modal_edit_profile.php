<div class="row gy-3">
    <div class="col-12 col-md-8">
        <div class="row gy-3">
            <div class="col-12 col-md-12">
                <label class="content-subtitle fw-bold d-block mb-2">Employee Number</label>
                <input type="text" placeholder="Enter Employee Number" name="emp_number" id="emp_number" class="nsm-field form-control" value="<?= $user->employee_number ? $user->employee_number : '-'; ?>"/>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold d-block mb-2">First Name</label>
                <input type="text" placeholder="Enter First Name" name="firstname" id="firstname" class="nsm-field form-control" value="<?= $user->FName; ?>"/>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold d-block mb-2">Last Name</label>
                <input type="text" placeholder="Enter Last Name" name="lastname" id="lastname" class="nsm-field form-control" value="<?= $user->LName; ?>"/>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold d-block mb-2">Mobile Number</label>
                <input type="text" placeholder="Enter Mobile Number" name="mobile_number" id="mobile_number" class="nsm-field form-control" value="<?= $user->mobile; ?>"/>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold d-block mb-2">Phone Number</label>
                <input type="text" placeholder="Enter Phone Number" name="phone_number" id="phone_number" class="nsm-field form-control" value="<?= $user->phone; ?>"/>
            </div>
            <div class="col-12">
                <label class="content-subtitle fw-bold d-block mb-2">Address</label>
                <input type="text" name="address" id="address" class="nsm-field form-control" value="<?= $user->address; ?>"/>
            </div>
            <div class="col-12 col-md-5">
                <label class="content-subtitle fw-bold d-block mb-2">City</label>
                <input type="text" name="city" id="city" class="nsm-field form-control" value="<?= $user->city; ?>"/>
            </div>
            <div class="col-12 col-md-5">
                <label class="content-subtitle fw-bold d-block mb-2">State</label>
                <input type="text" name="state" id="state" class="nsm-field form-control" value="<?= $user->state; ?>"/>
            </div>
            <div class="col-12 col-md-2">
                <label class="content-subtitle fw-bold d-block mb-2">Zip Code</label>
                <input type="text" name="postal_code" id="postal_code" class="nsm-field form-control" value="<?= $user->postal_code; ?>"/>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="nsm-img-upload circle m-auto">
        <?php if( $user->profile_img != '' ){ ?>
            <div class="nsm-img-upload circle m-auto" style="background-image:url('<?= userProfile($user->id); ?>')">
        <?php }else{ ?>
            <div class="nsm-img-upload circle m-auto">
        <?php } ?>
            <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
            <input type="file" name="user_photo" class="nsm-upload" accept="image/*">
        </div>
    </div>    
</div>