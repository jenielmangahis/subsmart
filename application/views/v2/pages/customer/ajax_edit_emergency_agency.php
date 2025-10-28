<div class="row">
    <div class="col-12 col-md-3">
        <div class="form-group mb-3">
            <label>Agency</label>
            <input type="text" class="form-control" name="agency_code" value="<?= $emergencyAgency->agency; ?>" placeholder="">
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group mb-3">
            <label>Agency Phone</label>
            <input type="text" class="form-control agency_phone_number" maxlength="12" name="agency_phone" value="<?= $emergencyAgency->agency_phone; ?>" placeholder="xxx-xxx-xxxx">
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group mb-3">
            <label>Agency Name</label>
            <input type="text" class="form-control" name="agency_name" value="<?= $emergencyAgency->agency_name; ?>" placeholder="">
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group mb-3">
            <label>Permit Number</label>
            <input type="text" class="form-control" name="permit_number" value="<?= $emergencyAgency->permit_number; ?>" placeholder="">
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group mb-3">
            <label>Permit Exp</label>
            <input type="date" class="form-control" name="permit_exp" value="<?= date("Y-m-d",strtotime($emergencyAgency->permit_exp)); ?>" placeholder="">
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group mb-3">
            <label>Effective Date</label>
            <input type="date" class="form-control" name="effective_date" value="<?= date("Y-m-d",strtotime($emergencyAgency->effective_date)); ?>" placeholder="">
        </div>
    </div>
</div>
<script>
$(function(){
    $('.agency_phone_number').keydown(function(e) {
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