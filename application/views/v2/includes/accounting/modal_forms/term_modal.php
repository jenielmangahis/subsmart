<div class="modal fade modal-fluid nsm-modal" id="term-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">New Term</span>
                <button type="button" class="close-term-modal" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
            </div>
            <?php 
                $action = isset($term) ? "/accounting/terms/update/$term->id" : "/accounting/terms/add";
            ?>
            <form id="payment-term-form" action="<?=$action?>" method="post">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="name"><span class="text-danger">*</span>Name</label>
                        <input type="text" name="name" id="name" class="form-control nsm-field mb-2" value="<?=isset($term) ? $term->name : ''?>">

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_term_type" id="payment-term-type-1" value="1" <?=isset($term) && $term->type === "1" || !isset($term) ? 'checked' : ''?>>
                            <label class="form-check-label" for="payment-term-type-1">
                                Due in fixed number of days
                            </label>
                        </div>

                        <div class="row px-4 mb-2">
                            <div class="col-3">
                                <input type="number" class="form-control nsm-field" id="net-due-days" name="net_due_days" value="<?=isset($term) && $term->type === "1" ? $term->net_due_days : ''?>" <?=isset($term) && $term->type === '2' ? 'disabled' : ''?>>
                            </div>
                            <div class="col d-flex align-items-center p-0">
                                <label for="net-due-days">days</label>
                            </div>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_term_type" id="payment-term-type-2" value="2" <?=isset($term) && $term->type === "2" ? 'checked' : ''?>>
                            <label class="form-check-label" for="payment-term-type-2">
                                Due by certain day of the month
                            </label>
                        </div>

                        <div class="row px-4 mb-2">
                            <div class="col-3">
                                <input type="number" class="form-control nsm-field" id="day-of-month-due" name="day_of_month_due" value="<?=isset($term) && $term->type === "2" ? $term->day_of_month_due : ''?>" <?=isset($term) && $term->type === '1' || !isset($term) ? 'disabled' : ''?>>
                            </div>
                            <div class="col d-flex align-items-center p-0">
                                <label for="day-of-month-due">day of month</label>
                            </div>
                        </div>

                        <div class="row px-4 mb-2">
                            <div class="col-12">
                                <p>Due the next month if issued within</p>
                            </div>
                            <div class="col-3">
                                <input type="number" class="form-control nsm-field" id="minimum-days-to-pay" name="minimum_days_to_pay" value="<?=isset($term) && $term->type === "2" ? $term->minimum_days_to_pay : ''?>" <?=isset($term) && $term->type === '1' || !isset($term) ? 'disabled' : ''?>>
                            </div>
                            <div class="col d-flex align-items-center pl-0">
                                <label for="minimum-days-to-pay">days of due date</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button close-term-modal" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button success float-end">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>