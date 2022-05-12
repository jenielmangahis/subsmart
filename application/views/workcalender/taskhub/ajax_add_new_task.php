<style>
.select2-container--open {
    z-index: 9999999
}
.select2-container{
    width: 100% !important; 
}
.badge{
    display: block;
    width: 100%;
    padding: 5px;
}
</style>
<div class="row">
    <div class="col-6 mt-3 company-select">
        <label for="">Customer</label>
        <select name="customer_id" id="" class="nsm-field mb-2 form-control d-select2-customer" required="">     
            <option value="">Select Customer</option>
            <?php foreach($companyCustomers as $c){ ?>
                <option value="<?= $c->prof_id; ?>"><?= $c->first_name.' '.$c->last_name; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-6 mt-3 company-select">
        <label for="">Assigned to</label>
        <select name="user_id" id="" class="nsm-field mb-2 form-control d-select2-user" required="">     
            <option value="">Select User</option>
            <?php foreach($companyUsers as $u){ ?>
                <option value="<?= $u->id; ?>"><?= $u->FName.' '.$c->LName; ?></option>
            <?php } ?>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-6 mt-3">
        <label for="">Estimated Date of Completion</label>
        <div class="input-group date" data-provide="datepicker">
            <input type="text" class="form-control dt-default" name="estimated_date_complete">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
    </div>
    <div class="col-6 mt-3">
        <label for="">Status</label>
        <select class="form-control" name="status" id="status">
            <?php foreach($taskStatus as $ts){ ?>
                <option value="<?= $ts->status_id; ?>"><?= $ts->status_text; ?></option>
            <?php } ?>
        </select>
    </div>
</div>
<div class="col-md-12 mt-3">
    <label for="">Subject</label>
    <input type="text" name="subject" id="event-name" class="form-control" required="">
</div>
<div class="col-md-12 mt-3">
    <label for="">Description</label>
    <textarea class="form-control" name="description" id="task-editor" style="height:100px;"></textarea>
</div>   
<script>
$(function(){
    CKEDITOR.replace('task-editor',{
        height: '100px',
    });

    $('.d-select2-customer').select2({
        placeholder: 'Select Customer',
        allowClear: true,
        dropdownParent: $('#modalAddTaskHub'),
        width: 'resolve'            
    });

    $('.d-select2-user').select2({
        placeholder: 'Select User',
        allowClear: true,
        dropdownParent: $('#modalAddTaskHub'),
        width: 'resolve'            
    });
});
</script>