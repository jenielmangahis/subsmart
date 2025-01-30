<style>
.badge-primary{
    background-color: #007bff;
}
.badge{
    display: inline-block;
    padding: 0.25em 0.4em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25rem;
    margin-top: 9px;
}
</style>
<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class="bx bx-fw bx-building"></i>Customer Property</span>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="row g-1 mb-5">
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Inventory</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $customerProperty && $customerProperty->inventory != '' ? $customerProperty->inventory : '---'; ?></label>
            </div>

            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Plan Type</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $customerProperty && $customerProperty->plan_type != '' ? $customerProperty->plan_type : '---'; ?></label>
            </div>

            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Deductible</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $customerProperty && $customerProperty->deductible != '' ? $customerProperty->deductible : '---'; ?> </label>
            </div>

            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Revenue</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $customerProperty && $customerProperty->revenue > 0 ? $customerProperty->revenue : '0.00'; ?></label>
            </div>

            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Territory</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $customerProperty && $customerProperty->territory != '' ? $customerProperty->territory : '---'; ?></label>
            </div>

            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Property Tax</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $customerProperty && $customerProperty->property_tax > 0 ? $customerProperty->property_tax : '0.00'; ?></label>
            </div>

            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Add On</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $customerProperty && $customerProperty->add_on != '' ? $customerProperty->add_on : '---'; ?></label>
            </div>

            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">AC Type</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $customerProperty && $customerProperty->ac_type != '' ? $customerProperty->ac_type : '---'; ?></label>
            </div>

            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Late Fee Collected</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $customerProperty && $customerProperty->late_fee_collected > 0 ? $customerProperty->late_fee_collected : '0.00'; ?></label>
            </div>

            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Alarm System</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $customerProperty && $customerProperty->alarm_system != '' ? $customerProperty->alarm_system : '---'; ?></label>
            </div>

            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Key Code</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $customerProperty && $customerProperty->key_code != '' ? $customerProperty->key_code : '---'; ?></label>
            </div>

            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Source</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $customerProperty && $customerProperty->source != '' ? $customerProperty->source : '---'; ?></label>
            </div>

            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Ownership</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $customerProperty && $customerProperty->ownership != '' ? $customerProperty->ownership : '---'; ?></label>
            </div>
        </div>
    </div>
</div>