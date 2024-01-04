<div class="modal fade nsm-modal fade" id="quick_add_job_type" tabindex="-1" aria-labelledby="quick_add_job_type_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frm-quick-add-job-type">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="quick_add_job_type_modal_label">Quick Add : Job Type</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="form-group">
                    <label class="">Job Type Name</label> <span class="form-required">*</span>
                    <input type="text" name="job_type_name" value="" class="form-control" required="" autocomplete="off" />
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="quick_add_job_tag" tabindex="-1" aria-labelledby="quick_add_job_tag_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frm-quick-add-job-tag">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="quick_add_job_tag_modal_label">Quick Add : Job Tag</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="form-group">
                    <label class="">Job Tag Name</label> <span class="form-required">*</span>
                    <input type="text" name="job_tag_name" value="" class="form-control" required="" autocomplete="off" />
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="quick_add_lead_source" tabindex="-1" aria-labelledby="quick_add_lead_source_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frm-quick-add-lead-source">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="quick_add_lead_source_modal_label">Quick Add : Lead Source</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="form-group">
                    <label class="">Lead Source Name</label> <span class="form-required">*</span>
                    <input type="text" name="lead_source_name" value="" class="form-control" required="" autocomplete="off" />
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="quick_add_tax_rate" tabindex="-1" aria-labelledby="quick_add_tax_rate_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frm-quick-add-tax-rate">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" id="new_tax_rate_modal_label">Quick Add : Tax Rate</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <input type="text" placeholder="Name" name="tax_name" class="nsm-field form-control mb-2" required />
                            <input type="number" placeholder="Percentage" name="tax_rate" min="0" step="any" class="nsm-field form-control" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
$(function(){
    $('#frm-quick-add-job-type').on('submit', function(e){
        let _this = $(this);
        e.preventDefault();

        var formData = new FormData(this);
        var url = "<?php echo base_url('job/_quick_add_job_type'); ?>";
        _this.find("button[type=submit]").html("Saving");
        _this.find("button[type=submit]").prop("disabled", true);

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            dataType: 'json',
            success: function(result) {
                if( result.is_success == 1 ){
                    $('#quick_add_job_type').modal('hide');                    
                    var o = $("<option/>", {value: result.job_type.id, text: result.job_type.name});
                    o.attr('data-image', result.job_type.icon_marker);
                    $('#job_type').append(o);
                    $('#job_type option[value="' + result.job_type.id + '"]').prop('selected',true);
                    $('#job_type').trigger('change'); 

                    Swal.fire({
                        text: "Job type was created successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: result.msg
                    });
                }
                
                _this.trigger("reset");

                _this.find("button[type=submit]").html("Save");
                _this.find("button[type=submit]").prop("disabled", false);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $('#frm-quick-add-job-tag').on('submit', function(e){
        let _this = $(this);
        e.preventDefault();

        var formData = new FormData(this);
        var url = "<?php echo base_url('job/_quick_add_job_tag'); ?>";
        _this.find("button[type=submit]").html("Saving");
        _this.find("button[type=submit]").prop("disabled", true);

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            dataType: 'json',
            success: function(result) {
                if( result.is_success == 1 ){
                    $('#quick_add_job_tag').modal('hide');                    
                    var o = $("<option/>", {value: result.job_tag.id, text: result.job_tag.name});
                    o.attr('data-image', result.job_tag.marker_icon);
                    $('#job_tag').append(o);
                    $('#job_tag option[value="' + result.job_tag.id + '"]').prop('selected',true);
                    $('#job_tag').trigger('change'); 

                    Swal.fire({
                        text: "Job tag was created successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: result.msg
                    });
                }
                
                _this.trigger("reset");

                _this.find("button[type=submit]").html("Save");
                _this.find("button[type=submit]").prop("disabled", false);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $('#frm-quick-add-lead-source').on('submit', function(e){
        let _this = $(this);
        e.preventDefault();

        var formData = new FormData(this);
        var url = "<?php echo base_url('job/_quick_add_lead_source'); ?>";
        _this.find("button[type=submit]").html("Saving");
        _this.find("button[type=submit]").prop("disabled", true);

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            dataType: 'json',
            success: function(result) {
                if( result.is_success == 1 ){
                    $('#quick_add_lead_source').modal('hide');                    
                    var o = $("<option/>", {value: result.lead_source.id, text: result.lead_source.name});
                    $('#lead_source').append(o);
                    $('#lead_source option[value="' + result.lead_source.id + '"]').prop('selected',true);
                    $('#lead_source').trigger('change'); 

                    Swal.fire({
                        text: "Lead source was created successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: result.msg
                    });
                }
                
                _this.trigger("reset");

                _this.find("button[type=submit]").html("Save");
                _this.find("button[type=submit]").prop("disabled", false);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $('#frm-quick-add-tax-rate').on('submit', function(e){
        let _this = $(this);
        e.preventDefault();

        var formData = new FormData(this);
        var url = "<?php echo base_url('job/_quick_add_tax_rate'); ?>";
        _this.find("button[type=submit]").html("Saving");
        _this.find("button[type=submit]").prop("disabled", true);

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            dataType: 'json',
            success: function(result) {
                if( result.is_success == 1 ){
                    $('#quick_add_tax_rate').modal('hide');                    
                    var o = $("<option/>", {value: result.tax_rate.rate, text: result.tax_rate.name});
                    $('#tax_rate').append(o);
                    $('#tax_rate option[value="' + result.tax_rate.rate + '"]').prop('selected',true);
                    $('#tax_rate').trigger('change'); 

                    Swal.fire({
                        text: "Tax rate was created successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: result.msg
                    });
                }
                
                _this.trigger("reset");

                _this.find("button[type=submit]").html("Save");
                _this.find("button[type=submit]").prop("disabled", false);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});
</script>