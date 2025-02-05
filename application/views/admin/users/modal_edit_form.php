<style>
.section-title {
    background-color: #666666;
    color: #ffffff !important;
    padding: 10px;
    margin-bottom: 10px;
}
.select2-container--open {
    z-index: 9999999
}
.list-roles{
    list-style: none;
    padding: 0px;
    margin: 0px;
}
.list-roles li{
    margin: 10px;
    background-color: #bfbfbf;
    padding: 10px;
    display: inline-block;
    width: 46%;
}
.list-roles .role-description{
    margin-left: 17px;    
    font-size: 15px;
}
.list-roles .role-name{
    font-weight: bold;
    font-size: 18px;
}
</style>
<input type="hidden" name="user_id" value="<?= $user->id; ?>" id="editUserID">
<div class="section-title">Basic Details</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="">First Name</label>
            <input type="text" name="firstname" class="nsm-field mb-2 form-control" value="<?= $user->FName; ?>" placeholder="Enter First Name">
        </div>
        <div class="col-md-6">
            <label for="">Last Name</label>
            <input type="text" name="lastname" class="nsm-field mb-2 form-control" value="<?= $user->LName; ?>" placeholder="Enter Last Name">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="">Employee Number</label>
            <input type="text" name="emp_number" class="nsm-field mb-2 form-control" id="emp_number" value="<?= $user->employee_number ? $user->employee_number : '-'; ?>" placeholder="Enter Employee Number">
        </div>
        <div class="col-md-6">
            <label for="" style="display: block">Company</label>
            <select name="company_id" id="companyList" class="nsm-field mb-2 form-control edit-company">                
                <?php foreach($companies as $c){ ?>
                    <option value="<?= $c->company_id; ?>" <?= $c->company_id == $user->company_id ? 'selected="selected"' : ''; ?>><?= $c->business_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<div class="section-title mt-2">Other Details</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="">Address</label>
            <textarea name="address" class="nsm-field mb-2 form-control" style="height: 153px;"><?= $user->address; ?></textarea>            
        </div>
        <div class="col-md-6">
            <label for="">City</label>
            <input type="text" name="city" value="<?= $user->city; ?>" class="nsm-field mb-2 form-control">            
            <label for="">State</label>
            <input type="text" name="state" value="<?= $user->state; ?>" class="nsm-field mb-2 form-control">
            <label for="">Zip Code</label>
            <input type="text" name="postal_code" value="<?= $user->postal_code; ?>" class="nsm-field mb-2 form-control">
        </div>
    </div>
</div>
<div class="form-group mt-3">
    <div class="row">
        <div class="col-md-6">
            <label for="">Title</label>
            <select name="role" id="employeeRole" class="nsm-field mb-2 form-control edit-select2-role">
                <option value="">Select Title</option>
                <?php foreach($roles as $r){ ?>
                    <option value="<?= $r->id; ?>" <?= $r->id == $user->role ? 'selected="selected"' : ''; ?>><?= $r->title; ?></option>
                <?php } ?>
            </select>
        </div>
        <!-- <div class="col-md-6">
            <label for="">Payscale</label>
            <select name="empPayscale" id="empPayscale" class="nsm-field mb-2 form-control select2-payscale">
                <option value="">Select payscale</option>
                <?php foreach($payscale as $p){ ?>
                    <option value="<?= $p->id; ?>" <?= $user->payscale_id == $p->id ? 'selected="selected"' : ''; ?>><?= $p->payscale_name; ?></option>
                <?php } ?>
            </select>
        </div> -->
        <div class="col-md-6">
            <label for="">Status</label>
            <select name="status" id="" class="nsm-field mb-2 form-control">
                <option value="1" <?= $user->status == 1 ? 'selected="selected"' : ''; ?>>Active</option>
                <option value="0" <?= $user->status == 0 ? 'selected="selected"' : ''; ?>>Inactive</option>
            </select>
        </div>
    </div>
</div>
<div class="form-group mt-3">
    <div class="row ">        
        <div class="col-md-6"> 
            <div class="input-switch" style="display:inline-block;width: 117px; text-align: center;">
                <label for="">App Access</label><br>
                <?php 
                    $is_checked = '';
                    if( $user->has_app_access == 1 ){
                        $is_checked = 'checked="checked"';
                    }                    
                ?>
                <input type="checkbox" name="app_access" class="edit-js-switch" <?= $is_checked; ?> />
            </div>
            <div class="input-switch" style="display:inline-block;width: 117px; text-align: center;">
                 <?php 
                    $is_checked = '';
                    if( $user->has_web_access == 1 ){
                        $is_checked = 'checked="checked"';
                    }                    
                ?>
                <label for="">Web Access</label><br>
                <input type="checkbox" name="web_access" class="edit-js-switch" <?= $is_checked; ?> />
            </div>
        </div>
    </div>    
</div>
<div class="section-title mt-3">Access Rights</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-12">
            <label>Rights and Permissions</label>
            <div class="help help-sm help-block">Select employee role</div>
            <ul class="list-roles">
                <?php foreach($rolesList as $key => $role){ ?>
                <li>
                    <div class="checkbox checkbox-sec margin-right">
                        <input type="radio" <?= $user->user_type == $key ? 'checked="checked"' : ''; ?> name="user_type" value="<?= $key; ?>" id="role_<?= $key; ?>">
                        <label for="role_<?= $key; ?>" class="role-name"><span><?= $role['name']; ?></span></label>
                    </div>
                    <div class="role-description">
                        <?= $role['description']; ?>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>        
    </div>
</div>
<script>
$(function(){
    var elems = Array.prototype.slice.call(document.querySelectorAll('.edit-js-switch'));
    elems.forEach(function(html) {
        var switchery = new Switchery(html, {
            size: 'small'
        });
    });

    $('.edit-select2-role').select2({
        placeholder: 'Select Title',
        allowClear: true,
        width: 'resolve'            
    });

    $('.edit-company').select2({
        placeholder: 'Select Company',
        allowClear: true,
        width: 'resolve'            
    });

    $('.select2-payscale').select2({
        placeholder: 'Select Payscale',
        allowClear: true,
        width: 'resolve'
    });
});
</script>