<div class="row">
    <div class="col-12">
        <h4>Review and Submit</h4>
        <div class="row py-3">
            <div class="col-12 col-md-2 d-flex align-items-center">
                <div class="payroll-total">
                    <h1 class="m-0"><span id="total-payroll-cost"><?=str_replace('$-', '-$', '$'.$total['total_payroll_cost'])?></span></h1>
                    <p class="m-0">TOTAL PAYROLL COST</p>
                </div>
            </div>
            <div class="col-12 col-md-2 d-flex">
                <div class="align-self-center">
                    <div class="d-flex align-items-center mb-3">
                        <div class="net-pay-color graph-color" style="border-color: #0b62a4; background: #0b62a4"></div>
                        <div class="net-pay ms-2">
                            <h4 class="m-0"><span id="total-net-pay"><?=str_replace('$-', '-$', '$'.$total['total_net_pay'])?></span></h4>
                            <p class="m-0">NET PAY</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="employee-color graph-color" style="border-color: #3980b5; background: #3980b5"></div>
                        <div class="employee ms-2">
                            <h4 class="m-0"><span id="total-employee-tax"><?=str_replace('$-', '-$', '$'.$total['total_taxes'])?></span></h4>
                            <p class="m-0">EMPLOYEE</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="employer-color graph-color" style="border-color: #679dc6; background: #679dc6"></div>
                        <div class="employer ms-2">
                            <h4 class="m-0"><span id="total-employer-tax"><?=str_replace('$-', '-$', '$'.$total['total_employer_tax'])?></span></h4>
                            <p class="m-0">EMPLOYER</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <canvas id="bonusPayrollChart"></canvas>
            </div>
            <div class="col-12 col-md-4 d-flex align-items-center pr-0">
                <div class="divider me-3"></div>

                <div class="row w-100">
                    <div class="col-2 p-0">
                        <h2 class="text-center"><?=count($employees)?></h2>
                    </div>
                    <div class="col-10 p-0 d-flex align-items-center">
                        <div class="message">
                            <p class="m-0">Direct deposits for <?=str_replace('$-', '-$', '$'.$total['total_net_pay'])?></p>
                            <p class="m-0">Deposit these amount by <?=$payDate?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 pay-date-period mb-3">
                <span class="float-end"><b>Pay date:</b> <?=$payDate?></span>
                <span class="float-end me-5"><b>Pay period:</b> <?=$payPeriod?></span>
            </div>
            <div class="col-12">
                <table class="nsm-table" id="payroll-summary-table">
                    <thead>
                        <tr>
                            <td>EMPLOYEE</td>
                            <td>PAY METHOD</td>
                            <td>TOTAL PAY</td>
                            <td>EMPLOYEE TAXES</td>
                            <td>NET PAY</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($employees as $employee) :?>
                            <tr>
                                <td><?=$employee['name']?></td>
                                <td><?=$employee['pay_method']?></td>
                                <td><?=$employee['total_pay']?></td>
                                <td><?=$employee['employee_tax']?></td>
                                <td><?=$employee['net_pay']?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>TOTAL</td>
                            <td></td>
                            <td><?=str_replace('$-', '-$', '$'.$total['total_pay'])?></td>
                            <td><?=str_replace('$-', '-$', '$'.$total['total_taxes'])?></td>
                            <td><?=str_replace('$-', '-$', '$'.$total['total_net_pay'])?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>