<?php include viewPath('v2/includes/header'); ?>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/marketing_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">Add a new deal to promote your business.</div>
                    </div>
                </div>
                <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'create_deals_steals', 'autocomplete' => 'off']); ?>
                <input type="hidden" name="default_icon_id" id="default-icon-id" value="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class='bx bxs-badge-dollar'></i></div>
                                        </div>
                                        <h4 class="step-title">Create Deal</h4>
                                    </div>
                                    <div class="step">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class='bx bxs-user-circle' ></i></div>
                                        </div>
                                        <h4 class="step-title">Select Customers</h4>
                                    </div>
                                    <div class="step">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class='bx bxs-envelope'></i></div>
                                        </div>
                                        <h4 class="step-title">Build Email</h4>
                                    </div>
                                    <div class="step">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class='bx bx-search-alt-2'></i></div>
                                        </div>
                                        <h4 class="step-title">Preview</h4>
                                    </div>
                                    <div class="step <?= $jobs_data->status == 'Invoiced' ? 'completed' : '' ?>">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class='bx bx-credit-card'></i></div>
                                        </div>
                                        <h4 class="step-title">Purchase</h4>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <label for=""><b>Title</b> <span class="bx bx-fw bx-help-circle" id="popover-help-title"></span></label>
                                <input type="text" class="form-control" name="title" placeholder="e.g. Up to 40 % off House Cleaning" id="" required placeholder="" autofocus/>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label for=""><b>Image</b> <span class="bx bx-fw bx-help-circle" id="popover-image"></span></label>                          
                                <input type="file" class="form-control" name="image" required placeholder="" autofocus/>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label for=""><b>Description</b> <span class="bx bx-fw bx-help-circle" id="popover-description"></span></label>
                                <textarea name="description" cols="40" rows="3" class="form-control" required autocomplete="off" placeholder="e.g. Grab our special cleaning deal and book a service now!  Spots get filled fast! Get them while they're HOT."></textarea>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label for=""><b>Terms & Conditions</b> <span class="bx bx-fw bx-help-circle" id="popover-terms-conditions"></span></label>
                                <textarea name="terms" cols="40" rows="3" class="form-control" autocomplete="off" placeholder="e.g. Applies only for basic House Cleaning service."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-3">
                                <label><b>Deal Price</b> <span class="bx bx-fw bx-help-circle" id="popover-deal-price"></span></label></label>     
                                <div class="input-group">
                                    <div class="input-group-text">$</div>
                                    <input type="number" step="any" name="price_deal" value="0.00" id="price-deal" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label><b>Original Price</b> <span class="bx bx-fw bx-help-circle" id="popover-original-price"></span></label>
                                <div class="input-group">
                                    <div class="input-group-text">$</div>
                                    <input type="number" step="any" name="price_original" value="0.00" id="price-original" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-12 mt-5">
                                <label><b>Discount you offer: &nbsp; $<span id="discount-fixed">0.00</span></b></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-3 text-end">
                        <button type="button" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('promote/deals') ?>'">Go Back to Deals List</button>
                        <button type="submit" name="btn_save" class="nsm-button primary btn-deals-save-draft">Continue »</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    
    $('#popover-help-title').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Set your deal title, use the discount to be more convincing';
        }
    });

    $('#popover-terms-condition').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Mention your terms, restrictions, fine print or other notes, that apply to the deal';
        }
    });

    $('#popover-image').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Add photo to spotlight features of this deal';
        }
    });

    $('#popover-deal-price').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'The final price customers will pay';
        }
    });

    $('#popover-original-price').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'The full price without any discounts.';
        }
    });

    $('#popover-description').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Describe how users will benefit when they buy the deal';
        }
    });

    $(document).on('propertychange change keyup paste input', '#price-deal', function(){
      compute_discount();
    });

    $(document).on('propertychange change keyup paste input', '#price-original', function(){
      compute_discount();
    });

    function compute_discount(){
      var price_deal     = $("#price-deal").val();
      var price_original = $("#price-original").val();
      var discount_fix   = price_original -  price_deal;
      $("#discount-fixed").html(discount_fix.toFixed(2));
    }

    $("#create_deals_steals").submit(function(e){
        e.preventDefault();
        var url = base_url + 'promote/_save_deals_steals';
        var form     = $('#create_deals_steals')[0];
        var formData = new FormData(form);
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            success: function(o)
            {
                $('.btn-deals-save-draft').prop("disabled", false);
                $(".btn-deals-save-draft").html('Continue »');
                if( o.is_success ){
                    location.href = base_url + "promote/add_send_to";
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: o.err_msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function(){
                $('.btn-deals-save-draft').html('<span class="bx bx-loader bx-spin"></span>');
                $('.btn-deals-save-draft').prop("disabled", true);
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>