<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class="bx bx-fw bx-user"></i>New Advance Customer</span>
        </div>
    </div>
    <div class="nsm-card-content">
        <hr>
        <div class="row g-3">
            <div class="col-12 col-md">
                <label class="content-subtitle fw-bold mb-2">
                    <field-custom-name readonly default="Rep Paper" form="papers"></field-custom-name>
                </label>
                <div class="input-group">
                    <div class="input-group-text">
                        <input <?= isset($papers->rep_paper_date) ? "checked" : "" ?> class="form-check-input mt-0" type="checkbox" value="rep_paper_date" id="rep_paper" >
                    </div>
                    <input value="<?= isset($papers->rep_paper_date) ? $papers->rep_paper_date : "" ?>" type="text" class="form-control nsm-field" name="rep_paper_date" id="rep_paper_date" >
                </div>
            </div>
            <div class="col-12 col-md">
                <label class="content-subtitle fw-bold mb-2">
                    <field-custom-name readonly default="Tech Paper" form="papers"></field-custom-name>
                </label>
                <div class="input-group">
                    <div class="input-group-text">
                        <input <?= isset($papers->tech_paper_date) ? "checked" : "" ?> class="form-check-input mt-0" type="checkbox" value="tech_paper_date" >
                    </div>
                    <input value="<?= isset($papers->tech_paper_date) ? $papers->tech_paper_date : "" ?>" type="text" class="form-control nsm-field" name="tech_paper_date" id="tech_paper_date" >
                </div>
            </div>
            <div class="col-12 col-md">
                <label class="content-subtitle fw-bold mb-2">
                    <field-custom-name readonly default="Scanned" form="papers"></field-custom-name>
                </label>
                <div class="input-group">
                    <div class="input-group-text">
                        <input <?= isset($papers->scanned_date) ? "checked" : "" ?> class="form-check-input mt-0" type="checkbox" value="scanned_date" >
                    </div>
                    <input value="<?= isset($papers->scanned_date) ? $papers->scanned_date : "" ?>" type="text" class="form-control nsm-field" name="scanned_date" id="scanned_date" >
                </div>
            </div>
            <div class="col-12 col-md">
                <label class="content-subtitle fw-bold mb-2">
                    <field-custom-name readonly default="Paperwork" form="papers"></field-custom-name>
                </label>
                <div class="input-group">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox" value="scanned_date">
                    </div>
                    <select class="nsm-field form-select" name="paperwork" id="paperwork">
                        <option value="" selected="selected">Select</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                        <option value="Pending Kept">Pending Kept</option>
                        <option value="Pending Sent">Pending Sent</option>
                        <option value="None">None</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md">
                <label class="content-subtitle fw-bold mb-2">
                    <field-custom-name readonly default="Submitted" form="papers"></field-custom-name>
                </label>
                <div class="input-group">
                    <div class="input-group-text">
                        <input <?= isset($papers->submitted) ? "checked" : "" ?> class="form-check-input mt-0" type="checkbox" value="submitted" >
                    </div>
                    <input value="<?= isset($papers->submitted) ? $papers->submitted : "" ?>" type="text" class="form-control nsm-field" name="submitted" id="submitted" >
                </div>
            </div>
            <div class="col-12 col-md">
                <label class="content-subtitle fw-bold mb-2">
                    <field-custom-name readonly default="Rep Paid" form="papers"></field-custom-name>
                </label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" class="form-control nsm-field" name="rep_paid" id="rep_paid"  min="0" step="0.01">
                </div>
            </div>
            <div class="col-12 col-md">
                <label class="content-subtitle fw-bold mb-2">
                    <field-custom-name readonly default="Tech Paid" form="papers"></field-custom-name>
                </label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" class="form-control nsm-field" name="tech_paid" id="tech_paid"  min="0">
                </div>
            </div>
            <div class="col-12 col-md">
                <label class="content-subtitle fw-bold mb-2">
                    <field-custom-name readonly default="Funded" form="papers"></field-custom-name>
                </label>
                <div class="input-group">
                    <div class="input-group-text">
                        <input <?= isset($papers->funded) ? "checked" : "" ?> class="form-check-input mt-0" type="checkbox" value="funded" >
                    </div>
                    <input value="<?= isset($papers->funded) ? $papers->funded : "" ?>" type="text" class="form-control nsm-field" name="funded" id="funded" >
                </div>
            </div>
            <div class="col-12 col-md">
                <label class="content-subtitle fw-bold mb-2">
                    <field-custom-name readonly default="Charged Back" form="papers"></field-custom-name>
                </label>
                <div class="input-group">
                    <div class="input-group-text">
                        <input <?= isset($papers->charged_back) ? "checked" : "" ?> class="form-check-input mt-0" type="checkbox" value="charged_back" >
                    </div>
                    <input value="<?= isset($papers->charged_back) ? $papers->charged_back : "" ?>" type="text" class="form-control nsm-field" name="charged_back" id="charged_back" >
                </div>
            </div>
        </div>
    </div>
</div>