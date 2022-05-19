<div class="<?= $class ?>"  data-id="<?= $id ?>" id="widget_<?= $id ?>">
    <div class="wid_header">
        <i class="fa fa-money-bill-wave" aria-hidden="true"></i> Sales
        
        <div class="float-right">
            <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                    &nbsp;<span class="fa fa-ellipsis-v"></span></span>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" class="dropdown-item" onclick="removeWidget('<?= $id ?>')">Close</a></li>
                    <li><a href="#" class="dropdown-item" onclick="addToMain('<?= $id ?>',<?php echo ($isMain?'1':'0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain?'Remove From Main':'Add to Main') ?></a></li>
                    <li><a href="#" class="dropdown-item">Move</a></li>
                    <li><a href="#" class="dropdown-item">Last 30 Days</a></li>
                    <li><a href="#" class="dropdown-item">This month</a></li>
                    <li><a href="#" class="dropdown-item">This quarter</a></li>
                    <li><a href="#" class="dropdown-item">This year</a></li>
                    <li><a href="#" class="dropdown-item">Last month</a></li>
                    <li><a href="#" class="dropdown-item">Last quarter</a></li>
                    <li><a href="#" class="dropdown-item">Last year</a></li>
                </ul>
            </div>
        </div>
<!--        <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
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
                <div class="row" id="salesBody" style="<?= $height; ?> overflow-y: scroll; padding:20px;">
                    <div class="moduleContent">
                        <div class="subContainer salesValues">
                            <div class="paid moneySection">
                                <div class="fancyMoney">$4</div>
                                <div class="fancyText dataSelection">Last 30 Days</div>
                            </div>
                            <div id="sales-line-chart" style="height: 200px"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<script type="text/javascript">

    $(function () {
        "use strict";
        // LINE CHART
        var data = [
            {"date": "Jun 14 - Jun 20", "sales": "0"},
            {"date": "Jun 21 - Jun 27", "sales": "0"},
            {"date": "Jun 28 - Jul 4", "sales": "0"},
            {"date": "Jul 5 - Jul 11", "sales": "4"},
            {"date": "Jul 12 - Jul 13", "sales": "0"}
        ];

        Morris.Line({
            element: 'sales-line-chart',
            data: data,
            resize: true,
            xkey: ['date'],
            ykeys: ['sales'],
            ymax: 12,
            labels: ['Sales'],
            preUnits: '$',
            parseTime: false
        });

    });
</script>