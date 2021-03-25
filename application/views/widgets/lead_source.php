<div class="<?= $class ?>"   id="widget_<?= $id ?>">
    <div  style="width: 300px; border: 1px solid #58c04e; background: #58c04e; color:white;  border-radius: 10px; text-align: center;padding: 5px;position: relative;margin: 0 auto;top: 21px;z-index: 1000;">
        <i class="fa fa-bullhorn" aria-hidden="true"></i> Lead Source
        
        <div class="float-right">
            <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                    &nbsp;<span class="fa fa-ellipsis-v"></span></span>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" class="dropdown-item" onclick="removeWidget('<?= $id ?>')">Close</a></li>
                    <li><a href="#" class="dropdown-item" onclick="addToMain('<?= $id ?>',<?php echo ($isMain?'1':'0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain?'Remove From Main':'Add to Main') ?></a></li>
                    <li><a href="#" class="dropdown-item">Move</a></li>
                    <li><a href="#" class="dropdown-item">Name of Lead Source</a></li>
                    <li><a href="#" class="dropdown-item">Current Number of Jobs From Lead Source</a></li>
                    <li><a href="#" class="dropdown-item">Last month</a></li>
                    <li><a href="#" class="dropdown-item">Last year</a></li>
                </ul>
            </div>
        </div>
        
<!--        <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
            <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                &nbsp;<span class="fa fa-ellipsis-v"></span></span>
            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#" class="dropdown-item">Name of Lead Source</a></li>
                <li><a href="#" class="dropdown-item">Current Number of Jobs From Lead Source</a></li>
                <li><a href="#" class="dropdown-item">Last month</a></li>
                <li><a href="#" class="dropdown-item">Last year</a></li>
            </ul>
        </div>-->
    </div>

    <div class="card" style="border: 2px solid #30233d; margin-top:0; border-radius: 40px; padding:5px;">
        <div style="border: 5px solid #30233d; margin-top:0; border-radius: 40px; box-shadow: 1px 0px 15px 5px rgb(48, 35, 61);">
            <div class="card-body mt-2" style="padding:5px 10px; height: 363px; overflow: hidden">
                <div class="row" id="salesLeaderboardBody" style="<?= $height; ?> overflow-y: scroll">
                    <canvas id="LeadSourceChart"></canvas>
                </div>
                <div class="text-center">
                    <a class="text-info" href="#">View All</a>
                </div>
            </div>
        </div>

    </div>
</div>
