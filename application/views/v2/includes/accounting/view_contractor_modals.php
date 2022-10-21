<div class="modal fade nsm-modal" id="edit-contractor-modal" tabindex="-1" role="dialog" aria-labelledby="edit-contractor-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="/accounting/contractors/<?=$contractor->id?>/update-details" method="post" class="form-validate" novalidate="novalidate">
                <div class="modal-header">
                    <span class="modal-title content-title" id="edit-contractor-modal-label">Edit Contractor</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label for="">Contractor type <span class="text-danger">*</span></label>
                            <?php foreach($contractorTypes as $type) : ?>
                            <div class="form-check">
                                <input type="radio" name="contractor_type" id="contractor-<?=strtolower($type->name)?>" class="form-check-input" value="<?=$type->id?>" <?=$contractor->contractor_type_id === $type->id ? 'checked' : ''?>>
                                <label for="contractor-<?=strtolower($type->name)?>" class="form-check-label"><?="$type->name - $type->description"?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php if($contractor->contractor_type_id !== null && $contractor->contractor_type_id !== "") : ?>
                        <?php if($contractor->contractor_type_id === "1") : ?>
                        <div class="col-12 col-md-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control nsm-field" value="<?=$contractor->title?>">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="first_name">First <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="first_name" class="form-control nsm-field" value="<?=$contractor->f_name?>">
                        </div>
                        <div class="col-12 col-md-3">
                            <label for="middle_name">Middle</label>
                            <input type="text" name="middle_name" id="middle_name" class="form-control nsm-field" value="<?=$contractor->m_name?>">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="last_name">Last <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" id="last_name" class="form-control nsm-field" value="<?=$contractor->l_name?>">
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="suffix">Suffix</label>
                            <input type="text" name="suffix" id="suffix" class="form-control nsm-field" value="<?=$contractor->suffix?>">
                        </div>
                        <div class="col-12">
                            <label for="display_name">Display name <span class="text-danger">*</span></label>
                            <input type="text" name="display_name" id="display_name" class="form-control nsm-field" value="<?=$contractor->display_name?>" required>
                        </div>
                        <div class="col-12">
                            <label for="social_sec_num">Social Security number <span class="text-danger">*</span></label>
                            <input type="text" name="social_sec_num" id="social_sec_num" class="form-control nsm-field" value="<?=$contractor->tax_id?>">
                        </div>
                        <?php else : ?>
                        <div class="col-12">
                            <label for="business_name">Business name <span class="text-danger">*</span></label>
                            <input type="text" name="business_name" id="business_name" class="form-control nsm-field" value="<?=$contractor->company?>">
                        </div>
                        <div class="col-12">
                            <label for="display_name">Display name <span class="text-danger">*</span></label>
                            <input type="text" name="display_name" id="display_name" class="form-control nsm-field" value="<?=$contractor->display_name?>" required>
                        </div>
                        <div class="col-12">
                            <label for="emp_id_num">Employer Identification Number <span class="text-danger">*</span></label>
                            <input type="text" name="emp_id_num" id="emp_id_num" class="form-control nsm-field" value="<?=$contractor->tax_id?>">
                        </div>
                        <?php endif; ?>
                        <div class="col-12">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control nsm-field" value="<?=$contractor->email?>" disabled>
                        </div>
                        <div class="col-12">
                            <label for="address">Address <span class="text-danger">*</span></label>
                            <textarea name="address" id="address" class="form-control nsm-field" required><?=$contractor->street?></textarea>
                        </div>
                        <div class="col-12 col-md-5">
                            <label for="city">City <span class="text-danger">*</span></label>
                            <input type="text" name="city" id="city" class="form-control nsm-field" required value="<?=$contractor->city?>">
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="state">State <span class="text-danger">*</span></label>
                            <select name="state" id="state" class="form-select nsm-field" required>
                                <option value="AK" <?=$contractor->contractor_type_id !== null && $contractor->state === "AK" ? "selected" : ""?>>AK</option>
                                <option value="AL" <?=$contractor->contractor_type_id !== null && $contractor->state === "AL" ? "selected" : ""?>>AL</option>
                                <option value="AR" <?=$contractor->contractor_type_id !== null && $contractor->state === "AR" ? "selected" : ""?>>AR</option>
                                <option value="AZ" <?=$contractor->contractor_type_id !== null && $contractor->state === "AZ" ? "selected" : ""?>>AZ</option>
                                <option value="CA" <?=$contractor->contractor_type_id !== null && $contractor->state === "CA" ? "selected" : ""?>>CA</option>
                                <option value="CO" <?=$contractor->contractor_type_id !== null && $contractor->state === "CO" ? "selected" : ""?>>CO</option>
                                <option value="CT" <?=$contractor->contractor_type_id !== null && $contractor->state === "CT" ? "selected" : ""?>>CT</option>
                                <option value="DC" <?=$contractor->contractor_type_id !== null && $contractor->state === "DC" ? "selected" : ""?>>DC</option>
                                <option value="DE" <?=$contractor->contractor_type_id !== null && $contractor->state === "DE" ? "selected" : ""?>>DE</option>
                                <option value="FL" <?=$contractor->contractor_type_id !== null && $contractor->state === "FL" ? "selected" : ""?>>FL</option>
                                <option value="GA" <?=$contractor->contractor_type_id !== null && $contractor->state === "GA" ? "selected" : ""?>>GA</option>
                                <option value="HI" <?=$contractor->contractor_type_id !== null && $contractor->state === "HI" ? "selected" : ""?>>HI</option>
                                <option value="IA" <?=$contractor->contractor_type_id !== null && $contractor->state === "IA" ? "selected" : ""?>>IA</option>
                                <option value="ID" <?=$contractor->contractor_type_id !== null && $contractor->state === "ID" ? "selected" : ""?>>ID</option>
                                <option value="IL" <?=$contractor->contractor_type_id !== null && $contractor->state === "IL" ? "selected" : ""?>>IL</option>
                                <option value="IN" <?=$contractor->contractor_type_id !== null && $contractor->state === "IN" ? "selected" : ""?>>IN</option>
                                <option value="KS" <?=$contractor->contractor_type_id !== null && $contractor->state === "KS" ? "selected" : ""?>>KS</option>
                                <option value="KY" <?=$contractor->contractor_type_id !== null && $contractor->state === "KY" ? "selected" : ""?>>KY</option>
                                <option value="LA" <?=$contractor->contractor_type_id !== null && $contractor->state === "LA" ? "selected" : ""?>>LA</option>
                                <option value="MA" <?=$contractor->contractor_type_id !== null && $contractor->state === "MA" ? "selected" : ""?>>MA</option>
                                <option value="MD" <?=$contractor->contractor_type_id !== null && $contractor->state === "MD" ? "selected" : ""?>>MD</option>
                                <option value="ME" <?=$contractor->contractor_type_id !== null && $contractor->state === "ME" ? "selected" : ""?>>ME</option>
                                <option value="MI" <?=$contractor->contractor_type_id !== null && $contractor->state === "MI" ? "selected" : ""?>>MI</option>
                                <option value="MN" <?=$contractor->contractor_type_id !== null && $contractor->state === "MN" ? "selected" : ""?>>MN</option>
                                <option value="MO" <?=$contractor->contractor_type_id !== null && $contractor->state === "MO" ? "selected" : ""?>>MO</option>
                                <option value="MS" <?=$contractor->contractor_type_id !== null && $contractor->state === "MS" ? "selected" : ""?>>MS</option>
                                <option value="MT" <?=$contractor->contractor_type_id !== null && $contractor->state === "MT" ? "selected" : ""?>>MT</option>
                                <option value="NC" <?=$contractor->contractor_type_id !== null && $contractor->state === "NC" ? "selected" : ""?>>NC</option>
                                <option value="ND" <?=$contractor->contractor_type_id !== null && $contractor->state === "ND" ? "selected" : ""?>>ND</option>
                                <option value="NE" <?=$contractor->contractor_type_id !== null && $contractor->state === "NE" ? "selected" : ""?>>NE</option>
                                <option value="NH" <?=$contractor->contractor_type_id !== null && $contractor->state === "NH" ? "selected" : ""?>>NH</option>
                                <option value="NJ" <?=$contractor->contractor_type_id !== null && $contractor->state === "NJ" ? "selected" : ""?>>NJ</option>
                                <option value="NM" <?=$contractor->contractor_type_id !== null && $contractor->state === "NM" ? "selected" : ""?>>NM</option>
                                <option value="NV" <?=$contractor->contractor_type_id !== null && $contractor->state === "NV" ? "selected" : ""?>>NV</option>
                                <option value="NY" <?=$contractor->contractor_type_id !== null && $contractor->state === "NY" ? "selected" : ""?>>NY</option>
                                <option value="OH" <?=$contractor->contractor_type_id !== null && $contractor->state === "OH" ? "selected" : ""?>>OH</option>
                                <option value="OK" <?=$contractor->contractor_type_id !== null && $contractor->state === "OK" ? "selected" : ""?>>OK</option>
                                <option value="OR" <?=$contractor->contractor_type_id !== null && $contractor->state === "OR" ? "selected" : ""?>>OR</option>
                                <option value="PA" <?=$contractor->contractor_type_id !== null && $contractor->state === "PA" ? "selected" : ""?>>PA</option>
                                <option value="RI" <?=$contractor->contractor_type_id !== null && $contractor->state === "RI" ? "selected" : ""?>>RI</option>
                                <option value="SC" <?=$contractor->contractor_type_id !== null && $contractor->state === "SC" ? "selected" : ""?>>SC</option>
                                <option value="SD" <?=$contractor->contractor_type_id !== null && $contractor->state === "SD" ? "selected" : ""?>>SD</option>
                                <option value="TN" <?=$contractor->contractor_type_id !== null && $contractor->state === "TN" ? "selected" : ""?>>TN</option>
                                <option value="TX" <?=$contractor->contractor_type_id !== null && $contractor->state === "TX" ? "selected" : ""?>>TX</option>
                                <option value="UT" <?=$contractor->contractor_type_id !== null && $contractor->state === "UT" ? "selected" : ""?>>UT</option>
                                <option value="VA" <?=$contractor->contractor_type_id !== null && $contractor->state === "VA" ? "selected" : ""?>>VA</option>
                                <option value="VT" <?=$contractor->contractor_type_id !== null && $contractor->state === "VT" ? "selected" : ""?>>VT</option>
                                <option value="WA" <?=$contractor->contractor_type_id !== null && $contractor->state === "WA" ? "selected" : ""?>>WA</option>
                                <option value="WI" <?=$contractor->contractor_type_id !== null && $contractor->state === "WI" ? "selected" : ""?>>WI</option>
                                <option value="WV" <?=$contractor->contractor_type_id !== null && $contractor->state === "WV" ? "selected" : ""?>>WV</option>
                                <option value="WY" <?=$contractor->contractor_type_id !== null && $contractor->state === "WY" ? "selected" : ""?>>WY</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-5">
                            <label for="zip_code">ZIP code <span class="text-danger">*</span></label>
                            <input type="text" name="zip_code" id="zip_code" class="form-control nsm-field" required value="<?=$contractor->zip?>">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- end modal-body -->
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-12 col-md-6">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <button type="submit" name="save" class="nsm-button success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>