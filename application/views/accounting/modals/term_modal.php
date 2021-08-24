<div class="modal fade" id="term-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered m-auto w-25" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Term</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php 
                $action = isset($term) ? "/accounting/terms/update/$term->id" : "/accounting/terms/add";
            ?>
            <form id="payment-term-form" action="<?=$action?>" method="post">
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card p-0 m-0">
                            <div class="card-body" style="max-height: 650px;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" class="form-control" value="<?=isset($term) ? $term->name : ''?>">
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="payment_term_type" id="payment-term-type-1" value="1" <?=isset($term) && $term->type === "1" || !isset($term) ? 'checked' : ''?>>
                                            <label class="form-check-label" for="payment-term-type-1">
                                                Due in fixed number of days
                                            </label>
                                        </div>
                                        <div class="form-group row m-0">
                                            <div class="col-sm-3">
                                                <input type="number" class="form-control" id="net-due-days" name="net_due_days" value="<?=isset($term) && $term->type === "1" ? $term->net_due_days : ''?>" <?=isset($term) && $term->type === '2' ? 'disabled' : ''?>>
                                            </div>
                                            <div class="col-sm-9 d-flex align-items-center pl-0">
                                                <label for="net-due-days">days</label>
                                            </div>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="payment_term_type" id="payment-term-type-2" value="2" <?=isset($term) && $term->type === "2" ? 'checked' : ''?>>
                                            <label class="form-check-label" for="payment-term-type-2">
                                                Due by certain day of the month
                                            </label>
                                        </div>
                                        <div class="form-group row m-0">
                                            <div class="col-sm-3">
                                                <input type="number" class="form-control" id="day-of-month-due" name="day_of_month_due" value="<?=isset($term) && $term->type === "2" ? $term->day_of_month_due : ''?>" <?=isset($term) && $term->type === '1' || !isset($term) ? 'disabled' : ''?>>
                                            </div>
                                            <div class="col-sm-9 d-flex align-items-center pl-0">
                                                <label for="day-of-month-due">day of month</label>
                                            </div>
                                        </div>
                                        <div class="form-group row m-0">
                                            <div class="col-sm-12">
                                                <p>Due the next month if issued within</p>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" class="form-control" id="minimum-days-to-pay" name="minimum_days_to_pay" value="<?=isset($term) && $term->type === "2" ? $term->minimum_days_to_pay : ''?>" <?=isset($term) && $term->type === '1' || !isset($term) ? 'disabled' : ''?>>
                                            </div>
                                            <div class="col-sm-9 d-flex align-items-center pl-0">
                                                <label for="minimum-days-to-pay">days of due date</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-sm-6">
                    <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Close</button>
                </div>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-success btn-rounded border float-right">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>