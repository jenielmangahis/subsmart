<div class="<?= $class ?>"  data-id="<?= $id ?>" id="widget_<?= $id ?>">
    <div  class="wid_header">
        <i class="fa fa-bars" aria-hidden="true"></i> Sales Leaderboard
        
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
    </div>

    <div class="card" style="border: 2px solid #30233d; margin-top:0; border-radius: 40px; padding:5px;">
        <div style="border: 5px solid #30233d; margin-top:0; border-radius: 40px; box-shadow: 1px 0 15px 5px rgb(48, 35, 61);">
            <div class="card-body mt-2" style="padding:5px 10px; height: 363px; overflow: hidden">
                <div class="row" id="salesLeaderboardBody" style="<?= $height; ?> overflow-y: scroll; padding:10px;">
               
                    <div class="col-md-12 col-sm-12">
                        <div class="insl-bx">
                            <h5>Top Techs</h5>
                            <ul id="sales_leaderboard">
                                <li><strong>1.</strong> Tommy Nguyen -  <span>1</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a class="text-info" href="#">View All</a>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    
</script>