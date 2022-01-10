<input type="hidden" name="user_id" value="<?= $user->id; ?>" id="editUserID">
<div class="section-title">Profile Details</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="">Employee Number</label>
            <input type="text" name="emp_number" class="form-control" id="emp_number" value="<?= $user->employee_number ? $user->employee_number : '-'; ?>" placeholder="Enter Employee Number">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="">First Name</label>
            <input type="text" name="firstname" class="form-control" value="<?= $user->FName; ?>" placeholder="Enter First Name">
        </div>
        <div class="col-md-6">
            <label for="">Last Name</label>
            <input type="text" name="lastname" class="form-control" value="<?= $user->LName; ?>" placeholder="Enter Last Name">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="">Mobile Number</label>
            <input type="text" name="mobile_number" class="form-control" value="<?= $user->mobile; ?>" placeholder="Enter Mobile Number">
        </div>
        <div class="col-md-6">
            <label for="">Phone Number</label>
            <input type="text" name="phone_number" class="form-control" value="<?= $user->phone; ?>" placeholder="Enter Phone Number">
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-12">
            <label for="">Address</label>
            <input type="text" name="address" value="<?= $user->address; ?>" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="">State</label>
            <input type="text" name="state" value="<?= $user->state; ?>" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="">Zip Code</label>
            <input type="text" name="postal_code" value="<?= $user->postal_code; ?>" class="form-control">
        </div>
    </div>
</div>
<script>
$(function(){
    
});
</script>