<?php include viewPath('v2/includes/accounting_header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('events/new_event') ?>'">
        <i class='bx bx-user-plus'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/accounting'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/reconcile_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Account reconciliation is the process of matching transactions entered into our software against your bank or credit card statements. Simply, match transactions to your bank statement and check them off one by one.
                        </div>
                    </div>
                </div>
                
                <div class="row g-3">
                    <div class="col-6">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <h3>Which account do you want to reconcile?</h3>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="account">Account</label>
                                        <select class="nsm-field form-select" name="account" id="account">
                                            <?php foreach($this->chart_of_accounts_model->select() as $row) : ?>
                                                <option <?=$this->reconcile_model->checkexist($row->id) != $row->id ? "disabled" : ''?> value="<?=$row->id?>"><?=$row->name?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col d-flex align-items-end">
                                        <button type="button" class="nsm-button">
                                            View Statements
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h3>Add the following information</h3>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <label for="beginning-balance">Beginning balance</label>
                                                <p>0.00</p>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="ending-balance">Ending balance *</label>
                                                <input type="text" name="ending_balance" id="ending-balance" class="nsm-field form-control" required>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="ending-date">Ending date *</label>
                                                <div class="nsm-field-group calendar">
                                                    <input type="text" name="ending_date" id="ending-date" class="nsm-field form-control datepicker" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" class="nsm-button primary">
                                            Start reconciling
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>
<script type="text/javascript">
    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        orientation: 'bottom',
        autoclose: true
    });
</script>