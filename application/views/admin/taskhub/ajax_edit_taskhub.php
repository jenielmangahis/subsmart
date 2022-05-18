<input type="hidden" name="thid" value="<?= $task->task_id; ?>">
<div class="row">                                 
    <div class="col-md-12 mt-3">
        <label for="">Company</label>
        <select name="company_id" id="editCompanyList" class="nsm-field mb-2 form-control d-select2-company" required="">     
            <option value="">Select Company</option>           
            <?php foreach($companies as $c){ ?>
                <option <?= $task->company_id == $c->company_id ? 'selected="selected"' : ''; ?> value="<?= $c->company_id; ?>"><?= $c->business_name; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="edit-company-fields">
        <div class="row">
            <div class="col-6 mt-3">
                <label for="">Customer</label>
                <select name="customer_id" id="" class="nsm-field mb-2 form-control d-select2-customer" required="">     
                    <option value="">Select Customer</option>
                    <?php foreach($companyCustomers as $c){ ?>
                        <option <?= $task->prof_id == $c->prof_id ? 'selected="selected"' : ''; ?> value="<?= $c->prof_id; ?>"><?= $c->first_name.' '.$c->last_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-6 mt-3">
                <label for="">Assigned to</label>
                <select name="user_id" id="" class="nsm-field mb-2 form-control d-select2-user" required="">     
                    <option value="">Select User</option>
                    <?php foreach($companyUsers as $u){ ?>
                        <option <?= $assignedUser->user_id == $u->id ? 'selected="selected"' : ''; ?> value="<?= $u->id; ?>"><?= $u->FName.' '.$c->LName; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 mt-3">
            <label for="">Priority</label>
            <select class="form-control" name="priority" id="priority">
                <?php foreach($optionPriority as $key => $value){ ?>
                    <option <?= $task->priority == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-6 mt-3">
            <label for="">Status</label>
            <select class="form-control" name="status" id="status">
                <?php foreach($taskStatus as $ts){ ?>
                    <option <?= $task->status_id == $ts->status_id ? 'selected="selected"' : ''; ?> value="<?= $ts->status_id; ?>"><?= $ts->status_text; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mt-3">
            <label for="">Subject</label>
            <input type="text" name="subject" value="<?= $task->subject; ?>" id="event-name" class="form-control" required="">
        </div>
        <div class="col-6 mt-3">
            <label for="">Estimated Date of Completion</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="text" class="form-control dt-default" value="<?= date("m/d/Y",strtotime($task->estimated_date_complete)); ?>" name="estimated_date_complete">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 mt-3">
        <label for="">Description</label>
        <textarea class="form-control" name="description" id="edit-task-editor" style="height:100px;"><?= $task->description; ?></textarea>
    </div>                                
</div>

<script>
$(function(){

    CKEDITOR.replace('edit-task-editor',{
        height: '100px',
    });

    $(document).on('change', '#editCompanyList', function(){
        var cid = $(this).val();
        var url = base_url + 'admin/ajax_load_taskhub_company_fields';
        $.ajax({
            type: "POST",
            url: url,
            data: {cid:cid},
            success: function(o)
            {          
                $('.edit-company-fields').html(o);
            }
        });
    });

    $('.d-select2-company').select2({
        placeholder: 'Select Company',
        allowClear: true,
        width: 'resolve'            
    });

    $('.dt-default').datepicker({
        format: 'mm/dd/yyyy',
    });

    $('.d-select2-customer').select2({
        placeholder: 'Select Customer',
        allowClear: true,
        width: 'resolve'            
    });

    $('.d-select2-user').select2({
        placeholder: 'Select User',
        allowClear: true,
        width: 'resolve'            
    });
});
</script>