<h4>Review and Submit</h4>
<div class="row py-3">
    <div class="col-md-3 d-flex align-items-center">
        <div class="payroll-total">
            <h1 class="m-0">$<span id="total-payroll-cost"><?php echo $total['total_payroll_cost']?></span></h1>
            <p class="m-0">TOTAL PAYROLL COST</p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="d-flex align-items-center mb-3">
            <div class="net-pay-color graph-color" style="border-color: #0b62a4; background: #0b62a4"></div>
            <div class="net-pay ml-2">
                <h4 class="m-0">$<span id="total-net-pay"><?php echo $total['total_net_pay']?></span></h4>
                <p class="m-0">NET PAY</p>
            </div>
        </div>
        <div class="d-flex align-items-center mb-3">
            <div class="employee-color graph-color" style="border-color: #3980b5; background: #3980b5"></div>
            <div class="employee ml-2">
                <h4 class="m-0">$<span id="total-employee-tax"><?php echo $total['total_taxes']?></span></h4>
                <p class="m-0">EMPLOYEE</p>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <div class="employer-color graph-color" style="border-color: #679dc6; background: #679dc6"></div>
            <div class="employer ml-2">
                <h4 class="m-0">$<span id="total-employer-tax"><?php echo $total['total_employer_tax']?></span></h4>
                <p class="m-0">EMPLOYER</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div id="payrollChart"></div>
    </div>
    <div class="col-md-4 d-flex align-items-center pr-0">
        <div class="divider mr-3"></div>

        <div class="row w-100">
            <div class="col-2 p-0">
                <h2 class="text-center"><?php echo count($employees); ?></h2>
            </div>
            <div class="col-10 p-0 d-flex align-items-center">
                <div class="message">
                    <p class="m-0">Paper checks for $<?php echo $total['total_net_pay']?></p>
                    <p class="m-0">Deliver these paychecks by <?php echo $payDate?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row bg-white" style="margin: 0 -30px; padding: 30px">
    <div class="col-12 p-0 w-100 pay-date-period mb-3">
        <span class="float-right"><b>Pay date:</b> <?php echo $payDate?></span>
        <span class="float-right mr-5"><b>Pay period:</b> <?php echo $payPeriod?></span>
    </div>
    <div class="col-12 p-0">
        <div class="payroll-summary-table">
            <table class="table table-bordered table-hover" id="payroll-summary-table">
                <thead>
                    <th>EMPLOYEE</th>
                    <th>PAY METHOD</th>
                    <th>TOTAL HOURS</th>
                    <th>TOTAL PAY</th>
                    <th>EMPLOYEE TAXES</th>
                    <th>NET PAY</th>
                </thead>
                <tbody>
                    <?php foreach($employees as $employee) :?>
                        <tr>
                            <td><?php echo $employee['name']?></td>
                            <td><?php echo $employee['pay_method']?></td>
                            <td><?php echo $employee['employee_hours']?></td>
                            <td><?php echo $employee['total_pay']?></td>
                            <td><?php echo $employee['employee_tax']?></td>
                            <td><?php echo $employee['net_pay']?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td>TOTAL</td>
                        <td></td>
                        <td><?php echo $total['total_hours']?></td>
                        <td>$<?php echo $total['total_pay']?></td>
                        <td>$<?php echo $total['total_taxes']?></td>
                        <td>$<?php echo $total['total_net_pay']?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>