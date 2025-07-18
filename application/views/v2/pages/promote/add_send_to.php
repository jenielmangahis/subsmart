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
                        <div class="nsm-callout primary">Send to all your customers or only certain ones.</div>
                    </div>
                </div>
                <?php echo form_open_multipart(null, ['class' => 'form-validate', 'id' => 'create_send_to', 'autocomplete' => 'off']); ?>
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
                                    <div class="step completed">
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
                                    <?php if( $dealsSteals && $dealsSteals->status == 0 ){ ?>
                                    <div class="step">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class='bx bx-search-alt-2'></i></div>
                                        </div>
                                        <h4 class="step-title">Preview</h4>
                                    </div>
                                    <div class="step">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class='bx bx-credit-card'></i></div>
                                        </div>
                                        <h4 class="step-title">Payment</h4>
                                    </div>
                                    <?php } ?>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-card">
                            <div class="nsm-card-content">
                                <div class="col-md-12">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="title"><b>Who are you sending to?</b></label>
                                            <div class="mt-2">
                                            <?php if($dealsSteals){ ?>
                                                <div class="radio radio-sec margin-right">
                                                    <input type="radio" name="to_type" value="1" id="to_type_1" <?= $dealsSteals->sending_type == 1 ? 'checked="checked"' : ''; ?> checked="checked">
                                                    <label for="to_type_1">All my customers with phone</label>
                                                </div>
                                                <div class="radio radio-sec margin-right">
                                                    <input type="radio" name="to_type" value="2" id="to_type_3" <?= $dealsSteals->sending_type == 2 ? 'checked="checked"' : ''; ?>>
                                                    <label for="to_type_3">To a customer group</label>
                                                </div>
                                                <div class="radio radio-sec margin-right">
                                                    <input type="radio" name="to_type" value="3" id="to_type_2" <?= $dealsSteals->sending_type == 3 ? 'checked="checked"' : ''; ?>>
                                                    <label for="to_type_2">Only to certain customers</label>
                                                </div>
                                            <?php }else{ ?>
                                                <div class="radio radio-sec margin-right">
                                                    <input type="radio" name="to_type" value="1" id="to_type_1" checked="checked">
                                                    <label for="to_type_1">All my customers with phone</label>
                                                </div>
                                                <div class="radio radio-sec margin-right">
                                                    <input type="radio" name="to_type" value="2" id="to_type_3">
                                                    <label for="to_type_3">To a customer group</label>
                                                </div>
                                                <div class="radio radio-sec margin-right">
                                                    <input type="radio" name="to_type" value="3" id="to_type_2">
                                                    <label for="to_type_2">Only to certain customers</label>
                                                </div>
                                            <?php } ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 sending-option-1 mt-4">
                                        <div class="margin-bottom-ter count-summary">
                                            <span class="customer-count" data-to="customer-count-all"><?= count($customers); ?></span> contacts have a valid phone (excluding unsubscribed).
                                        </div>
                                        <div class="margin-bottom-sec mt-4">
                                            <label><b>Customer Type</b></label>
                                            <div>
                                                <div class="radio radio-sec margin-right">
                                                    <input type="radio" name="optionA[customer_type_service]" value="0" id="customer-type-both" checked="checked">
                                                    <label for="customer-type-both">Both Residential and Commercial</label>
                                                </div>
                                                <div class="radio radio-sec margin-right">
                                                    <input type="radio" name="optionA[customer_type_service]" value="1" id="customer-type-residential">
                                                    <label for="customer-type-residential">Residential customers</label>
                                                </div>
                                                <div class="radio radio-sec margin-right">
                                                    <input type="radio" name="optionA[customer_type_service]" value="2" id="customer-type-commercial">
                                                    <label for="customer-type-commercial">Commercial customers</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-4">
                                            <label><b>Exclude Customer Groups</b> <span class="bx bx-fw bx-help-circle" id="popover-help-exclude-customer-groups"></span></label>                                            
                                            <ul class="group-list">
                                                <?php foreach($customerGroups as $cg){ ?>
                                                    <li>
                                                        <?php
                                                            $is_checked = ''; 
                                                            if($selectedExcludes){
                                                                if( array_key_exists($cg->id, $selectedExcludes) ){
                                                                    $is_checked = 'checked="checked"';
                                                                    echo $cg->id;
                                                                }
                                                            }
                                                        ?>
                                                        <div class="form-check">
                                                            <input class="form-check-input chk-exclude-contact-group" type="checkbox" name="optionA[exclude_customer_group_id][]" value="<?= $cg->id; ?>" id="chk-exclude-customer-group-<?= $cg->id; ?>" <?= $is_checked; ?>>
                                                            <label class="form-check-label" for="chk-exclude-customer-group-<?= $cg->id; ?>"><?= $cg->title; ?></label>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 sending-option-2 customer selected mt-4" style="display: none;margin-bottom:20px ​!important;">
                                        <div class="margin-bottom-ter count-summary">
                                            <?php 
                                                $customer_selected = 0;
                                                if( $selectedCustomers ){
                                                    $customer_selected = count($selectedCustomers);
                                                }
                                            ?>
                                            <span class="contact-selected-count" style="font-weight: bold;"><?= $customer_selected; ?></span> customer selected.
                                        </div>
                                        <div class="margin-bottom-sec">
                                            <div class="row">
                                                <div class="col-12 col-md-6 grid-mb">
                                                    <div class="nsm-field-group search">
                                                        <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search" value="">
                                                    </div>
                                                </div> 
                                            </div>
                                            <table id="tbl-contacts" class="nsm-table">
                                                <thead>
                                                    <tr>
                                                        <td style="width:1%;"></td>
                                                        <td data-name="CustomerName">Name</td>
                                                        <td data-name="CustomerPhone" style="width: 10%;">Phone</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($customers as $c){ ?>
                                                        <?php if($c->email != ''){ ?>
                                                        <tr>
                                                            <td style="width:1%;">
                                                                <div class="form-check">
                                                                    <?php
                                                                        $is_checked = ''; 
                                                                        if($selectedCustomers){
                                                                            if( array_key_exists($c->prof_id, $selectedCustomers) ){
                                                                                $is_checked = 'checked="checked"'; 
                                                                            }
                                                                        }
                                                                    ?>
                                                                    <input class="form-check-input chk-contact" type="checkbox" name="optionB[customer_id][<?= $c->prof_id; ?>]" value="<?= $c->prof_id; ?>" id="chk-customer-<?= $c->prof_id; ?>" <?= $is_checked; ?>>
                                                                    <label class="form-check-label" for="chk-customer-<?= $c->prof_id; ?>"></label>
                                                                </div>
                                                            </td>
                                                            <td class="fw-bold show nsm-text-primary">
                                                                <?= $c->first_name . ' ' . $c->last_name; ?>
                                                            </td class="show nsm-text-primary">
                                                            <td><?= $c->phone_m; ?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 sending-option-3 mt-4" style="display: none;">
                                        <div class="margin-bottom-ter count-summary">
                                            <?php 
                                                $groups_selected = 0;
                                                if( $selectedGroups ){
                                                    $groups_selected = count($selectedGroups);
                                                }
                                            ?>
                                            <span class="contact-group-selected-count" style="font-weight: bold;"><?= $groups_selected; ?></span> customer group selected.
                                        </div>
                                        <div class="margin-bottom-sec">
                                            <ul class="group-list">
                                                <?php foreach($customerGroups as $cg){ ?>
                                                    <li>
                                                        <?php
                                                            $is_checked = ''; 
                                                            if($selectedGroups){
                                                                if( array_key_exists($cg->id, $selectedGroups) ){
                                                                    $is_checked = 'checked="checked"'; 
                                                                }
                                                            }
                                                        ?>
                                                        <div class="form-check">
                                                            <input class="form-check-input chk-contact-group" type="checkbox" <?= $is_checked; ?> name="optionC[customer_group_id][]" value="<?= $cg->id; ?>" id="chk-customer-group-<?= $cg->id; ?>">
                                                            <label class="form-check-label" for="chk-customer-group-<?= $cg->id; ?>"><?= $cg->title; ?></label>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 sending-option-3" style="display: none;">
                                        <div class="margin-bottom-sec">
                                            <label><b>Customer Type</b></label>
                                            <?php if($dealsSteals){ ?>
                                                <div>
                                                    <div class="radio radio-sec margin-right">
                                                        <input type="radio" name="optionC[customer_type_service]" value="0" <?= $dealsSteals->customer_type == 0 ? 'checked="checked"' : ''; ?> id="customer-group-type-both" checked="checked">
                                                        <label for="customer-group-type-both">Both Residential and Commercial</label>
                                                    </div>
                                                    <div class="radio radio-sec margin-right">
                                                        <input type="radio" name="optionC[customer_type_service]" value="1" <?= $dealsSteals->customer_type == 1 ? 'checked="checked"' : ''; ?> id="customer-group-type-residential">
                                                        <label for="customer-group-type-residential">Residential customers</label>
                                                    </div>
                                                    <div class="radio radio-sec margin-right">
                                                        <input type="radio" name="optionC[customer_type_service]" value="2" <?= $dealsSteals->customer_type == 2 ? 'checked="checked"' : ''; ?> id="customer-group-type-commercial">
                                                        <label for="customer-group-type-commercial">Commercial customers</label>
                                                    </div>
                                                </div>
                                            <?php }else{ ?>
                                                <div>
                                                    <div class="radio radio-sec margin-right">
                                                        <input type="radio" name="optionC[customer_type_service]" value="0" id="customer-group-type-both" checked="checked">
                                                        <label for="customer-group-type-both">Both Residential and Commercial</label>
                                                    </div>
                                                    <div class="radio radio-sec margin-right">
                                                        <input type="radio" name="optionC[customer_type_service]" value="1" id="customer-group-type-residential">
                                                        <label for="customer-group-type-residential">Residential customers</label>
                                                    </div>
                                                    <div class="radio radio-sec margin-right">
                                                        <input type="radio" name="optionC[customer_type_service]" value="2" id="customer-group-type-commercial">
                                                        <label for="customer-group-type-commercial">Commercial customers</label>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-3 text-end">
                        <button type="button" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('promote/edit_deals/' . $dealsSteals->id); ?>'">« Back</button>
                        <button type="submit" name="btn_save" class="nsm-button primary btn-save-send-settings">Continue »</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    <?php if( $dealsSteals && $dealsSteals->sending_type == 1 ){ ?>
        $(".sending-option-1").show();
        $(".sending-option-2").hide();
        $(".sending-option-3").hide();
    <?php }elseif( $dealsSteals && $dealsSteals->sending_type == 2 ){ ?>
        $(".sending-option-1").hide();
        $(".sending-option-2").hide();
        $(".sending-option-3").show();
    <?php }elseif( $dealsSteals && $dealsSteals->sending_type == 3 ){ ?>
        $(".sending-option-1").hide();
        $(".sending-option-2").show();
        $(".sending-option-3").hide();
    <?php } ?>

    $(".nsm-table").nsmPagination();
    $("#search_field").on("input", debounce(function() {
        let search = $(this).val();
        if( search == '' ){
            $(".nsm-table").nsmPagination();
        }else{
            tableSearch($(this));        
        }
        
    }, 1000));

    $('#popover-help-exclude-customer-groups').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Optional, select the groups you would like to exclude from campaign';
        }
    });

    $("#to_type_2").change(function(){
        if( $(this).attr('checked', 'checked') ){
            $(".sending-option-1").hide();
            $(".sending-option-2").show();
            $(".sending-option-3").hide();
        }
    });

    $("#to_type_1").change(function(){
        if( $(this).attr('checked', 'checked') ){
            $(".sending-option-1").show();
            $(".sending-option-2").hide();
            $(".sending-option-3").hide();
        }
    });

    $("#to_type_3").change(function(){
        if( $(this).attr('checked', 'checked') ){
            $(".sending-option-1").hide();
            $(".sending-option-2").hide();
            $(".sending-option-3").show();
        }
    });

    $(".chk-contact").change(function(){
        var contact_selected = $(".chk-contact:checked").length;
        $(".contact-selected-count").html(contact_selected);
    });

    $(".chk-contact-group").change(function(){
        var contact_group_selected = $(".chk-contact-group:checked").length;
        $(".contact-group-selected-count").html(contact_group_selected);
    });

    $("#create_send_to").submit(function(e){
        e.preventDefault();
        
        $.ajax({
            type: "POST",
            url: base_url + 'promote/create_send_to',
            dataType: "json",
            data: $("#create_send_to").serialize(),
            success: function(o)
            {
                $('.btn-save-send-settings').prop("disabled", false);
                $(".btn-save-send-settings").html('Continue »');

                if( o.is_success ){
                    //redirect to step3
                    location.href = base_url + "promote/build_email";
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
                $('.btn-save-send-settings').html('<span class="bx bx-loader bx-spin"></span>');
                $('.btn-save-send-settings').prop("disabled", true);
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>