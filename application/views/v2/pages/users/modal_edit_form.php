<div class="row gy-3 mb-4">
    <div class="col-12">
        <label class="custom-header">Employee Details</label>
        <input type="hidden" name="user_id" value="<?= $user->id; ?>" id="">
    </div>
</div>
<div class="row gy-3 mb-3">
    <div class="col-12 col-md-8">
        <div class="row gy-3 mb-4">                                
            <div class="col-12">
                <label class="content-subtitle fw-bold d-block mb-2">Employee Number</label>
                <input type="text" name="emp_number" class="nsm-field form-control" id="emp_number" value="<?= $user->employee_number; ?>" required />
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold d-block mb-2">First Name</label>
                <input type="text" name="firstname" class="nsm-field form-control" value="<?= $user->FName; ?>" required />
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold d-block mb-2">Last Name</label>
                <input type="text" name="lastname" class="nsm-field form-control" value="<?= $user->LName; ?>" required />
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold d-block mb-2">Mobile Number</label>
                <!-- <input type="text" name="mobile" class="nsm-field form-control" value="" /> -->
                <input type="text" class="form-control edit_phone_number" maxlength="12" value="<?= $user->mobile; ?>" placeholder="xxx-xxx-xxxx" name="mobile" id="mobile" />
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold d-block mb-2">Phone Number</label>
                <!-- <input type="text" name="phone" class="nsm-field form-control" value="" /> -->
                <input type="text" class="form-control edit_phone_number" maxlength="12" value="<?= $user->phone; ?>" placeholder="xxx-xxx-xxxx" name="phone" id="phone" />
            </div>   
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold d-block mb-2">User Type</label>
                <select class="nsm-field form-select" name="user_type" id="employee_role" required>
                    <option value="">Select User Type</option>
                    <?php foreach( $userTypes as $key => $value ){ ?>
                        <option value="<?= $key; ?>" <?= $user->user_type == $key ? 'selected="selected"' : ''; ?>><?= $value['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold d-block mb-2">Job Title</label>
                <select class="nsm-field form-select" name="role" id="role" required>
                    <option value="" selected="selected" disabled>Select Job Title</option>
                    <?php foreach($roles as $role){ ?>
                        <option value="<?= $role->id; ?>" <?= $role->id == $user->role ? 'selected="selected"' : ''; ?>><?= $role->title; ?></option>
                    <?php } ?>
                </select>
            </div>  
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold d-block mb-2">Status</label>
                <select class="nsm-field form-select" name="status" required>
                    <option value="" selected="selected" disabled>Select Status</option>
                    <option value="1" <?= $user->status == 1 ? 'selected="selected"' : ''; ?>>Active</option>
                    <option value="0" <?= $user->status == 0 ? 'selected="selected"' : ''; ?>>Inactive</option>
                </select>
            </div>                                 
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="col-12">
            <label class="content-title">Profile Picture</label>
        </div>
        <div class="col-12">
            <div class="nsm-img-upload">
                <span class="nsm-upload-label disable-select">Drop or click image to upload</span>
                <input type="file" name="userfile" class="nsm-upload" accept="image/*">
            </div>
        </div>
    </div>                            
</div>   
<div class="row gy-3 mb-4">                                                                                    
    <div class="col-12">
        <label class="content-subtitle fw-bold d-block mb-2">Address</label>
        <input type="text" class="nsm-field form-control" name="address" value="<?= $user->address; ?>" required>
    </div>
    <div class="col-12 col-md-5">
        <label class="content-subtitle fw-bold d-block mb-2">City</label>
        <input type="text" class="nsm-field form-control" name="city" value="<?= $user->city; ?>" required>
    </div>
    <div class="col-12 col-md-5">
        <label class="content-subtitle fw-bold d-block mb-2">State</label>
        <input type="text" class="nsm-field form-control" name="state" value="<?= $user->state; ?>" required>
    </div>
    <div class="col-12 col-md-2">
        <label class="content-subtitle fw-bold d-block mb-2">Zip Code</label>
        <input type="text" class="nsm-field form-control" name="postal_code" value="<?= $user->postal_code; ?>" required>
    </div>     
</div>  
<?php
    $is_app_checked = '';
    if ($user->has_app_access == 1) {
        $is_app_checked = 'checked="checked"';
    }

    $is_web_checked = '';
    if ($user->has_web_access == 1) {
        $is_web_checked = 'checked="checked"';
    }
?>
<div class="row gy-3 mb-4">
    <div class="col-12 col-md-6">
        <div class="form-check form-switch nsm-switch d-inline-block me-3">
            <input class="form-check-input" type="checkbox" id="edit_app_access" name="app_access" <?= $is_app_checked; ?>>
            <label class="form-check-label" for="edit_app_access">App Access</label>
        </div>
        <div class="form-check form-switch nsm-switch d-inline-block">
            <input class="form-check-input" type="checkbox" id="edit_web_access" name="web_access" <?= $is_web_checked; ?>>
            <label class="form-check-label" for="edit_web_access">Web Access</label>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('#edit_employee_modal .form-select').select2({
            dropdownParent: $("#edit_employee_modal")
        });
    });
    $('.edit_phone_number').keydown(function(e) {
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
</script>