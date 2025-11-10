<div class="nsm-card primary" style="<?= $status_cancelled_hide_section; ?>" id="add-advance-customer-papers">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class='bx bx-fw bx-file'></i> Customer Papers</span>
        </div>
    </div>
    <div class="nsm-card-content">
        <hr>
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
                        <input <?= $is_checked; ?> class="form-check-input paper-chk mt-0" type="checkbox" value="rep_paper_date" id="chk_rep_paper" />
                    </div>
                    <input value="<?= $rep_paper_date; ?>" type="date" class="form-control nsm-field" name="rep_paper_date" id="rep_paper_date" >
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
                        <input <?= $is_checked; ?> class="form-check-input mt-0 paper-chk" type="checkbox" value="tech_paper_date" id="chk_paper_date" />
                    </div>
                    <input value="<?= $tech_paper_date; ?>" type="date" class="form-control nsm-field" name="tech_paper_date" id="tech_paper_date" >
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
                        <input <?= $is_checked; ?> class="form-check-input mt-0 paper-chk" type="checkbox" value="scanned_date" id="chk_imagine_count" />
                    </div>
                    <input value="<?= $imagine_count; ?>" type="number" min="0" step="any" class="form-control nsm-field" name="imagine_count" id="paper_imagine_count" >
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
                        <input class="form-check-input mt-0 paper-chk" <?= $is_checked; ?> type="checkbox" value="paperwork" id="chk_paper_paperwork">
                    </div>
                    <input value="<?= $paperwork; ?>" type="text" class="form-control nsm-field" name="paperwork" id="paper_paperwork" >
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
                        <input <?= $is_checked; ?> class="form-check-input mt-0 paper-chk" type="checkbox" value="submitted" id="chk_paper_submitted" >
                    </div>
                    <input value="<?= $submitted; ?>" type="text" class="form-control nsm-field" name="submitted" id="paper_submitted" >
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
                        <input <?= $is_checked; ?> class="form-check-input mt-0 paper-chk" type="checkbox" value="funded" id="chk_paper_funded" />
                    </div>
                    <input value="<?= $funded; ?>" type="number" step="any" class="form-control nsm-field" name="funded" id="paper_funded" >
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
                        <input <?= $is_checked; ?> class="form-check-input mt-0 paper-chk" type="checkbox" value="charged_back" id="chk_charged_back" >
                    </div>
                    <input value="<?= $charged_back; ?>" type="number" step="any" class="form-control nsm-field" name="charged_back" id="paper_charged_back" >
                </div>
            </div>
        </div>
    </div>
</div>