<style>
    .jobsRow:hover{
        background: #e8e8fa;
    }
</style>

<div class="<?= $class ?>"  data-id="<?= $id ?>" id="widget_<?= $id ?>">
    <div  class="wid_header">
        <i class="fa fa-calendar" aria-hidden="true"></i> Open Estimates
        
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
                <div style="height:<?= $rawHeight-30; ?>px; overflow-y: scroll; padding:5px 15px;">
                    <div class="mb-2 col-lg-12 float-left">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th class="col-lg-2"></th>
                                <th class="text-left">Estimate #</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Last Update</th>
                            </tr>
                            <?php
                            $jobCounter = 0;
                            if ($job) {
                                foreach ($job as $jb) :
                                    ?>
                                    <tr style="cursor:pointer;">
                                        <td>    
                                            <img src="<?= base_url() ?>uploads/users/default.png" alt="user" class="rounded-circle nav-user-img vertical-center">
                                        </td>
                                        <td>
                                            <b style="font-weight:700; margin:0;"><?php echo strtoupper('EST-00001'); ?></b>
                                            <p style="color: #9d9e9d; "><?php echo ucwords(strtolower($jb->job_location)); ?></p>
                                        </td>
                                        <td class="text-center">
                                            <h6 style="margin:0;"><?php echo strtoupper('$1,000'); ?></h6>
                                        </td>
                                        <td class="text-center">
                                            <h6 style="margin:0;"><?php echo strtoupper('Submitted'); ?></h6>
                                        </td>
                                        <td class="text-center">
                                            <p style="margin:0;"><?php echo strtoupper('02/12/2021'); ?></p>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <div class="text-center">
                    <a class="text-info" href="<?= base_url() ?>job">SEE ALL ESTIMATES</a>
                </div>
            </div>
        </div>

    </div>
</div>
