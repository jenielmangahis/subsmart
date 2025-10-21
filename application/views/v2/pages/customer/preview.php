<?php include viewPath('v2/includes/header'); ?>
<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo base_url('customer'); ?>'">
                                <i class='bx bx-fw bx-search-alt'></i> Find Customer
                            </button>
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo base_url('customer/module/' . $this->uri->segment(3)); ?>'">
                                <i class='bx bx-fw bx-tachometer'></i> Customer Dashboard
                            </button>
                            <button type="button" class="nsm-button" onclick="location.href='<?php echo base_url('customer/add_advance/' . $this->uri->segment(3)); ?>'">
                                <i class='bx bx-fw bx-user'></i> Edit Customer
                            </button>
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-chart'></i> Credit Report
                            </button>
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-file-blank'></i> Scanned Documents
                            </button>
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-box'></i> Inventory Details
                            </button>
                            <button type="button" class="nsm-button" onclick="location.href='<?= base_url('customer/billing/' . $this->uri->segment(3)); ?>'">
                                <i class='bx bx-fw bx-receipt'></i> Bill Customer
                            </button>
                            <button type="button" class="nsm-button primary" id="printDivPreview">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div id="DivIdToPrint">
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-12">
                        <div class="nsm-card">
                            <div class="nsm-card-content">
                                <div class="row g-2">
                                    <div class="col-12 col-md-2">
                                        <label class="content-title d-inline-block">Account Number: <?= !empty($alarm_info->monitor_id) ? $alarm_info->monitor_id : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="content-title d-inline-block">Online: <?= !empty($alarm_info->online) ? $alarm_info->online : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="content-title d-inline-block">In Service: <?= !empty($alarm_info->in_service) ? $alarm_info->in_service : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="content-title d-inline-block">Status: <?= !empty($profile_info->status) ? $profile_info->status : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="content-title d-inline-block">Equipment: <?= !empty($alarm_info->equipment) ? $alarm_info->equipment : '---'; ?></label>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="content-title d-inline-block">Collections: <?= !empty($alarm_info->collections) ? $alarm_info->collections : '---'; ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="nsm-card">
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-12 col-md">
                                        <label class="content-subtitle fw-bold mb-2">
                                            <field-custom-name readonly default="Work Order" form="papers"></field-custom-name>
                                        </label>
                                        <div class="input-group">
                                            <?php 
                                                $is_checked = '';
                                                $rep_paper_date = '';
                                                if( isset($papers->rep_paper_date) && $papers->rep_paper_date !== '' ){
                                                    $rep_paper_date = date("Y-m-d", strtotime($papers->rep_paper_date));
                                                    $is_checked = 'checked="checked"'; 
                                                }else{
                                                    if( $woSubmittedLatest ){
                                                        $rep_paper_date = date("Y-m-d", strtotime($woSubmittedLatest->date_issued));
                                                        $is_checked = 'checked="checked"';
                                                    }
                                                }
                                            
                                            ?>
                                            <div class="input-group-text">
                                                <input <?= $is_checked; ?> class="form-check-input mt-0" type="checkbox" value="rep_paper_date" id="rep_paper" disabled>
                                            </div>
                                            <input value="<?= $rep_paper_date; ?>" type="text" class="form-control nsm-field" name="rep_paper_date" id="rep_paper_date" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="content-subtitle fw-bold mb-2">
                                            <field-custom-name readonly default="Job Finished" form="papers"></field-custom-name>
                                        </label>
                                        <div class="input-group">
                                            <?php 
                                                $is_checked = '';
                                                $tech_paper_date = '';
                                                if( isset($papers->tech_paper_date) && $papers->tech_paper_date !== '' ){
                                                    $tech_paper_date = date("Y-m-d", strtotime($papers->rep_paper_date));
                                                    $is_checked = 'checked="checked"'; 
                                                }else{
                                                    if( $jobFinishedLatest ){
                                                        if( strtotime($jobFinishedLatest->finished_date) > 0 ){
                                                            $tech_paper_date = date("Y-m-d", strtotime($jobFinishedLatest->finished_date));
                                                        }else{
                                                            $tech_paper_date = date("Y-m-d", strtotime($jobFinishedLatest->end_date));
                                                        }
                                                        $is_checked = 'checked="checked"';
                                                    }
                                                }
                                            
                                            ?>
                                            <div class="input-group-text">
                                                <input <?= $is_checked; ?> class="form-check-input mt-0" type="checkbox" value="tech_paper_date" disabled>
                                            </div>
                                            <input value="<?= $tech_paper_date; ?>" type="text" class="form-control nsm-field" name="tech_paper_date" id="tech_paper_date" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="content-subtitle fw-bold mb-2">
                                            <field-custom-name readonly default="Imagine Count" form="papers"></field-custom-name>
                                        </label>
                                        <div class="input-group">
                                            <?php 
                                                $is_checked = '';
                                                $imagine_count = '0';
                                                if( isset($papers->imagine_count) && $papers->imagine_count > 0 ){
                                                    $imagine_count = $papers->imagine_count;
                                                    $is_checked = 'checked="checked"';
                                                }   
                                            ?>
                                            <div class="input-group-text">
                                                <input <?= $is_checked; ?> class="form-check-input mt-0" type="checkbox" value="scanned_date" disabled>
                                            </div>
                                            <input value="<?= $imagine_count; ?>" type="text" class="form-control nsm-field" name="scanned_date" id="scanned_date" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="content-subtitle fw-bold mb-2">
                                            <field-custom-name readonly default="Completed eSign Uploaded" form="papers"></field-custom-name>
                                        </label>
                                        <div class="input-group">
                                            <?php 
                                                $is_checked = '';
                                                $paperwork = '';
                                                if( isset($papers->paperwork) && $papers->paperwork != '' ){
                                                    $paperwork = $papers->paperwork;
                                                    $is_checked = 'checked="checked"';
                                                }else{
                                                    if( $recentDocfile ){
                                                        $paperwork = $recentDocfile->docusign_envelope_id;
                                                        $is_checked = 'checked="checked"';
                                                    }
                                                }
                                            ?>
                                            <div class="input-group-text">
                                                <input <?= $is_checked; ?> class="form-check-input mt-0" type="checkbox" value="scanned_date">
                                            </div>
                                            <input value="<?= $paperwork; ?>" type="text" class="form-control nsm-field" name="paperwork" id="paperwork" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="content-subtitle fw-bold mb-2">
                                            <field-custom-name readonly default="Payment Image" form="papers"></field-custom-name>
                                        </label>
                                        <div class="input-group">
                                            <?php 
                                                $is_checked = '';
                                                $submitted = '';
                                                if( isset($papers->submitted) && $papers->submitted != '' ){
                                                    $submitted = $papers->submitted;
                                                    $is_checked = 'checked="checked"';
                                                }   
                                            ?>
                                            <div class="input-group-text">
                                                <input <?= $is_checked; ?> class="form-check-input mt-0" type="checkbox" value="submitted" disabled>
                                            </div>
                                            <input value="<?= $submitted; ?>" type="text" class="form-control nsm-field" name="submitted" id="submitted" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="content-subtitle fw-bold mb-2">
                                            <field-custom-name readonly default="Funded" form="papers"></field-custom-name>
                                        </label>
                                        <div class="input-group">
                                            <?php 
                                                $is_checked = '';
                                                $funded = '0';
                                                if( isset($papers->funded) && $papers->funded != '' ){
                                                    $funded = $papers->submitted;
                                                    $is_checked = 'checked="checked"';
                                                }   
                                            ?>
                                            <div class="input-group-text">
                                                <input <?= $is_checked; ?> class="form-check-input mt-0" type="checkbox" value="funded" disabled>
                                            </div>
                                            <input value="<?= $funded; ?>" type="text" class="form-control nsm-field" name="funded" id="funded" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md">
                                        <label class="content-subtitle fw-bold mb-2">
                                            <field-custom-name readonly default="Charged Back" form="papers"></field-custom-name>
                                        </label>
                                        <div class="input-group">
                                            <?php 
                                                $is_checked = '';
                                                $charged_back = '0';
                                                if( isset($papers->charged_back) && $papers->charged_back != '' ){
                                                    $charged_back = $papers->charged_back;
                                                    $is_checked = 'checked="checked"';
                                                }   
                                            ?>
                                            <div class="input-group-text">
                                                <input <?= $is_checked; ?> class="form-check-input mt-0" type="checkbox" value="charged_back" disabled>
                                            </div>
                                            <input value="<?= $charged_back; ?>" type="text" class="form-control nsm-field" name="charged_back" id="charged_back" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row cards-container" data-masonry='{"percentPosition": true }'>
                    <div class="col-12 col-md-4 mb-2">
                        <?php include viewPath('v2/pages/customer/advance_customer_forms/preview_customer_info'); ?>
                    </div>                    
                    <div class="col-12 col-md-4 mb-2">
                        <?php include viewPath('v2/pages/customer/advance_customer_forms/preview_funding_info'); ?>
                    </div>
                     <div class="col-12 col-md-4 mb-2">
                       <?php include viewPath('v2/pages/customer/advance_customer_forms/preview_alarm_info'); ?>
                    </div>
                    <?php if( logged('industry_type') != 'Alarm Industry' ){ ?>
                    <div class="col-12 col-md-4 mb-2">
                        <?php include viewPath('v2/pages/customer/advance_customer_forms/preview_billing_info'); ?>                        
                    </div>
                    <?php } ?>
                    <div class="col-12 col-md-4 mb-2">
                        <?php include viewPath('v2/pages/customer/advance_customer_forms/preview_office_info'); ?>                        
                    </div>
                    <?php if( logged('industry_type') != 'Alarm Industry' ){ ?>
                    <div class="col-12 col-md-4 mb-2">
                        <?php include viewPath('v2/pages/customer/advance_customer_forms/preview_notes_info'); ?>
                    </div>
                    <?php } ?>
                </div>
                <!-- end of div to print  -->
                </div>
                <!-- end of div to print  -->
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url('assets/js/v2/masonry.pkgd.min.js');?>"></script>
<script src="<?=base_url('assets/js/customer/components/FieldCustomName.js');?>"></script>
<script src="<?= base_url("assets/js/printThis.js") ?>"></script> 

<script type="text/javascript">
    $(document).ready(function() {
        $("#copyLink").on("click", function(){
            var copyText = document.getElementById("sharableLink");
            copyText.select();
            document.execCommand("copy");
        });

        $("#printDivPreview").on("click", function(){
            $("#DivIdToPrint").printThis({
                debug: false,              // show the iframe for debugging
                importCSS: true,           //import page CSS
                importStyle: true,//thrown in for extra measure
                printContainer: true,      // grab outer container as well as the contents of the selector
                loadCSS: "<?= base_url("assets/css/v2/bootstrap.min.css") ?>", // path to additional css file
                loadCSS: "<?= base_url("assets/css/v2/main.css") ?>",
                pageTitle: "",             // add title to print page
                removeInline: false        // remove all inline styles from print elements
            });
        });

    });
</script>
<?php include viewPath('v2/includes/footer'); ?>