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
.select2-container{
    width: 100% !important; 
}
</style>
<div class="section-title">Basic Details</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="">First Name</label>
            <input type="text" name="firstname" class="nsm-field mb-2 form-control" value="" placeholder="Enter First Name" required="">
        </div>
        <div class="col-md-6">
            <label for="">Last Name</label>
            <input type="text" name="lastname" class="nsm-field mb-2 form-control" value="" placeholder="Enter Last Name" required="">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="">Employee Number</label>
            <input type="text" name="emp_number" class="nsm-field mb-2 form-control" id="emp_number" value="" placeholder="Enter Employee Number" required="">
        </div>
        <div class="col-md-6">
            <label for="" style="display: block">Company</label>
            <select name="company_id" id="companyList" class="nsm-field mb-2 form-control add-company" required="">     
                <option value="">Select Company</option>           
                <?php foreach($companies as $c){ ?>
                    <option value="<?= $c->company_id; ?>"><?= $c->business_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<div class="section-title mt-2">Login Details</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="">Email</label>
            <input type="email" name="user_email" class="nsm-field mb-2 form-control" value="" required="">         
        </div>
        <div class="col-md-6">
            <label for="">Password</label>
            <input type="password" name="user_password" value="" class="nsm-field mb-2 form-control" required="">   
        </div>
    </div>
</div>
<div class="section-title mt-2">Other Details</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="">Address</label>
            <textarea name="address" class="nsm-field mb-2 form-control" style="height: 153px;" required=""><?= $user->address; ?></textarea>            
        </div>
        <div class="col-md-6">
            <label for="">City</label>
            <input type="text" name="city" value="" class="nsm-field mb-2 form-control" required="">            
            <label for="">State</label>
            <input type="text" name="state" value="" class="nsm-field mb-2 form-control" required="">
            <label for="">Zip Code</label>
            <input type="text" name="postal_code" value="" class="nsm-field mb-2 form-control" required="">
        </div>
    </div>
</div>
<div class="form-group mt-3">
    <div class="row">
        <div class="col-md-6">
            <label for="">Title</label>
            <select name="role" id="employeeRole" class="nsm-field mb-2 form-control add-select2-role" required="">
                <option value="">Select Title</option>
                <?php foreach($roles as $r){ ?>
                    <option value="<?= $r->id; ?>"><?= $r->title; ?></option>
                <?php } ?>
            </select>
        </div>
        <!-- <div class="col-md-6">
            <label for="">Payscale</label>
            <select name="empPayscale" id="empPayscale" class="nsm-field mb-2 form-control add-payscale" required="">
                <option value="">Select payscale</option>
                <?php foreach($payscale as $p){ ?>
                    <option value="<?= $p->id; ?>"><?= $p->payscale_name; ?></option>
                <?php } ?>
            </select>
        </div> -->
        <div class="col-md-6">
            <label for="">Status</label>
            <select name="status" id="" class="nsm-field mb-2 form-control">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
    </div>
</div>
<div class="form-group mt-3">
    <div class="row ">        
        <div class="col-md-6"> 
            <div class="input-switch" style="display:inline-block;width: 117px; text-align: center;">
                <label for="">App Access</label><br>
                <input type="checkbox" name="app_access" class="add-js-switch" />
            </div>
            <div class="input-switch" style="display:inline-block;width: 117px; text-align: center;">
                <label for="">Web Access</label><br>
                <input type="checkbox" name="web_access" class="add-js-switch" />
            </div>
        </div>
    </div>    
</div>
<div class="section-title mt-3">Access Rights and Permissions</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-12">
            <div class="help help-sm help-block">Select employee role</div>
            <ul class="list-roles">
                <?php foreach($rolesList as $key => $role){ ?>
                <li>
                    <div class="checkbox checkbox-sec margin-right">
                        <input type="radio" name="user_type" value="<?= $key; ?>" id="role_<?= $key; ?>">
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
    var elems = Array.prototype.slice.call(document.querySelectorAll('.add-js-switch'));
    elems.forEach(function(html) {
        var switchery = new Switchery(html, {
            size: 'small'
        });
    });

    $('.add-select2-role').select2({
        placeholder: 'Select Title',
        allowClear: true,
        width: 'resolve'            
    });

    $('.add-company').select2({
        placeholder: 'Select Company',
        allowClear: true,
        width: 'resolve'            
    });

    $('.add-payscale').select2({
        placeholder: 'Select Payscale',
        allowClear: true,
        width: 'resolve'
    });
});
</script>