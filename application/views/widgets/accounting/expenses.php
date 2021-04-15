<div class="<?= $class ?>"  id="widget_<?= $id ?>">
    <div  class="wid_header">
        <i class="fa fa-credit-card" aria-hidden="true"></i> Expenses
        
        <div class="float-right">
            <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                    &nbsp;<span class="fa fa-ellipsis-v"></span></span>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" class="dropdown-item" onclick="removeWidget('<?= $id ?>')">Close</a></li>
                    <li><a href="#" class="dropdown-item" onclick="addToMain('<?= $id ?>',<?php echo ($isMain?'1':'0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain?'Remove From Main':'Add to Main') ?></a></li>
                    <li><a href="#" class="dropdown-item">Move</a></li>
                </ul>
            </div>
        </div>
<!--        <div class="dropdown float-right" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
            <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                Last 30 Days&nbsp;<span class="fa fa-caret-down"></span></span>
            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#" class="dropdown-item">Last 30 Days</a></li>
                <li><a href="#" class="dropdown-item">This month</a></li>
                <li><a href="#" class="dropdown-item">This quarter</a></li>
                <li><a href="#" class="dropdown-item">This year</a></li>
                <li><a href="#" class="dropdown-item">Last month</a></li>
                <li><a href="#" class="dropdown-item">Last quarter</a></li>
                <li><a href="#" class="dropdown-item">Last year</a></li>
            </ul>
        </div>-->
    </div>
    <div class="card" style="border: 2px solid #30233d; margin-top:0; border-radius: 40px; padding:5px;">
        <div style="border: 5px solid #30233d; margin-top:0; border-radius: 40px; box-shadow: 1px 0px 15px 5px rgb(48, 35, 61);">
            <div class="card-body mt-2" style="padding:5px 10px; height: 363px; overflow: hidden">
                <div class="row" id="expensesBody" style="<?= $height; ?> overflow-y: scroll; padding: 40px;">
                    <div class="expenses-money-section">
                        <div class="expenses-money-data">$4,247</div>
                        <div class="expenses-con-data">This month</div>
                    </div>
                    <div class="expenses-donutchart-section">
                        <div class="donut-chart-container">
                            <div id="expensesChart" style="width: 150px;height: 170px; margin-right:5px;"></div>
                            <div id="legendExpenses">
                                <div class="legendList">
                                    <div class="box"></div>
                                    <div class="amount">74%</div>
                                    <div class="name">Commission & fees</div>
                                    <div class="box" style="background: #3980b5;"></div>
                                    <div class="amount">19%</div>
                                    <div class="name">Reimburtment</div>
                                    <div class="box" style="background: #95bbd7;"></div>
                                    <div class="amount">7%</div>
                                    <div class="name">Subcontractors</div>
                                    <div class="box" style="background: #caddeb;"></div>
                                    <div class="amount">2%</div>
                                    <div class="name">Bank Charges</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="<?php echo $url->assets ?>plugins/raphael/raphael.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/morris.js/morris.min.js"></script>
<script>
    $(document).ready(function () {
        // Donut Graph
        var Data = [
            {label: "Commissions & Fees", value: 74},
            {label: "Reimburstment", value: 19},
            {label: "Subcontractors", value: 7},
            {label: "Bank Charges", value: 2}
        ];
        var total = 100;
        var donut_chart = Morris.Donut({
            element: 'expensesChart',
            data: Data,
            resize: true,
            formatter: function (value, data) {
                return Math.floor(value / total * 100) + '%';
            }
        });
    });

</script>

