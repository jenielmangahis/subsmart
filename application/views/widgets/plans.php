<div class="<?= $class ?>"   id="widget_<?= $id ?>">
    <div  style="width: 300px; border: 1px solid #58c04e; background: #58c04e; color:white;  border-radius: 10px; text-align: center;padding: 5px;position: relative;margin: 0 auto;top: 21px;z-index: 1000;">
        <i class="fa fa-wrench " aria-hidden="true"></i> Recurring service plans
        
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
        <div style="border: 5px solid #30233d; margin-top:0; border-radius: 40px; box-shadow: 1px 0px 15px 5px rgb(48, 35, 61);">
            <div class="card-body mt-2" style="padding:5px 10px; height: 363px; overflow: hidden">
                <div class="row" style="height:<?= $rawHeight - 160; ?>px; overflow:scroll">
                    <div class="col-lg-6 text-center">
                        <h2>0</h2>
                        <p>Active Service Plans</p>
                    </div>
                    <div class="col-lg-6 text-center">
                        <h2>0</h2>
                        <p>Agreements to expire in 30 days</p>
                    </div>
                    <hr />
                </div>
                <div class="justify-content-center text-center mt-5">
                    <button onclick="document.location = '<?= base_url() ?>'" class="btn btn-primary mt-2">Setup a Plan</button>
                </div>
            </div>
        </div>

    </div>
</div>

