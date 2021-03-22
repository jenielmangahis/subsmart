<style>
    .jobsRow:hover{
        background: #e8e8fa;
    }
</style>  
<div  class="<?= $class ?>"  id="widget_<?= $id ?>">
    <div  style="width: 300px; border: 1px solid #58c04e; background: #58c04e; color:white;  border-radius: 10px; text-align: center;padding: 5px;position: relative;margin: 0 auto;top: 21px;z-index: 1000;">
        <i class="fa fa-tasks" aria-hidden="true"></i> TaskHub
    </div>
    <div class="card" style="border: 2px solid #30233d; margin-top:0; border-radius: 40px; padding:5px;">
        <div style="border: 5px solid #30233d; margin-top:0; border-radius: 40px; box-shadow: 1px 0px 15px 5px rgb(48, 35, 61);">
            <div class="card-body mt-2" style="padding:5px 10px; height: 363px; overflow: hidden">
                <div id="taskHubBody" style="<?= $height; ?> overflow-y: scroll">
                    <?php
                    //$this->wizardlib->getStreetView('1001 East Madison Drive PENSACOLA, FL 32505');
                    ?>
                    <div class="col-lg-12 text-center mt-5">
                        <h5 class="mt-5">TaskHub here</h5>
                    </div>
                </div>
                <div class="text-center">
                    <a class="text-info" href="#">See All Task</a>
                </div>
            </div>
        </div>

    </div>
</div>

