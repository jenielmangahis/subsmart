<style>
.customer-info-heading{
	background-color: #6a4a86;
    color: #ffffff;
    font-size: 15px;
    padding: 10px;
}
</style>
<!-- New Customer Modal -->
<div class="modal fade nsm-modal" id="quick-add-customer" role="dialog" data-bs-backdrop="static" aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header mb-0">
                <span id="newcustomerLabel" class="modal-title content-title"><i class='bx bx-fw bxs-user-plus' ></i> Add New Customer</span>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
            </div>
            <form id="frm-quick-add-customer">
                <input type="hidden" id="target-id-dropdown" />
                <input type="hidden" id="origin-modal-id" />
                <div class="modal-body">                     
                    <div class="row">  
                        <div class="col-md-12">
                            <div class="nsm-card primary" style="overflow-y:auto;max-height:600px;">                                
                                <div class="form-check" style="float:right;">
                                    <input class="form-check-input" type="checkbox" value="1" name="customer_add_billing_information" id="chk-show-billing">
                                    <label class="form-check-label" for="chk-show-billing">
                                        Show Billing Information
                                    </label>
                                </div>
                                <div style="clear:both;" class="mb-2"></div>
                                <div class="add-basic-information-container"></div>                                
                                <div class="add-billing-information-container"></div>
                            </div>
                        </div>                        
                    </div>                    
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="nsm-button primary" id="btn-quick-add-customer">Save</button>
                                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(function(){
    $("#frm-quick-add-customer").submit(function(e) {
        e.preventDefault();
        
        $.ajax({
            type: "POST",
            url: base_url + "customer/_quick_save",
            data: $(this).serialize(),
            dataType:"json",
            success: function(result)
            {
                if(result.is_success){
                    var target_dropdown = $('#target-id-dropdown').val();
                    if( target_dropdown != '' ){
                        $('#quick-add-customer').modal('hide'); 
                        var o = $("<option/>", {value: result.customer_id, text: result.customer_name});
                        $(`#${target_dropdown}`).append(o);
                        $(`#${target_dropdown} option[value="${result.customer_id}"]`).prop('selected',true);
                        $(`#${target_dropdown}`).trigger('change'); 
                    }
                }else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.msg,
                    });
                }
                $('#btn-quick-add-customer').html('Save');
            },
            beforeSend: function() {
                $('#btn-quick-add-customer').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#chk-show-billing').on('change', function(){
        if( $(this).is(':checked') ){
            $.ajax({
                type: "POST",
                url: base_url + 'customer/_customer_add_billing_information',
                success: function(o) {
                    $('.add-billing-information-container').html(o);
                }, beforeSend: function() {
                    $(".add-billing-information-container").html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        }else{
            $(".add-billing-information-container").html('');
        }   
    });

    $('#quick-add-customer').on('hidden.bs.modal', function () {
        var origin_modal_id = $('#origin-modal-id').val();
        if( origin_modal_id != '' ){
            $(`#${origin_modal_id}`).modal('show');
        }
        $(".add-basic-information-container").html('');
        $(".add-billing-information-container").html('');
        $(".add-basic-information-container").html('Save');
    });

    $('#quick-add-customer').on('shown.bs.modal', function (e) {
        var origin_modal_id = $('#origin-modal-id').val();        
        $('#frm-quick-add-customer')[0].reset();
        
        if( origin_modal_id != '' ){            
            $(`#${origin_modal_id}`).modal('hide');
        }

        $.ajax({
            type: "POST",
            url: base_url + 'customer/_customer_add_basic_information',
            success: function(o) {
                $('.add-basic-information-container').html(o);
            }, beforeSend: function() {
                $(".add-basic-information-container").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });
});
</script>