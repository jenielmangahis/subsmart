<div class="<?= $class ?>"  data-id="<?= $id ?>"  id="widget_<?= $id ?>">
    <div  class="wid_header">
        <i class="fa fa-envelope" aria-hidden="true"></i> Messages
        
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
                <div style="<?= $height; ?> overflow-y: scroll" id="messagesBody">
                    <div class="col-lg-12" id="msgs_body">
                        <div class="progress" style="height:40px;"><div class="progress-bar progress-bar-striped bg-warning active" role="progressbar" style="width: 100%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">System is fetching data</div></div>
                    </div>
                </div>
                <div class="text-center">
                    <a class="text-info" href="<?= base_url('ring_central') ?>">SEE ALL MESSAGES</a>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="viewSMSLogs" tabindex="-1" role="dialog" aria-labelledby="addWidgets" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header text-center align-content-center pb-0">
                <div class="float-left col-lg-12 no-padding text-center pointer">
                    <img class="img-sm rounded-circle" style="width:43px; margin:0 auto;" width="43" src="<?= base_url('uploads/users/default.png'); ?>" alt="profile">
                    <p id="smsLogName" class="mb-1"></p>
                </div>
            </div>
            <div class="modal-body text-center p-2" id="personalMsgsBody" style="height:350px; overflow-y: scroll;">
                Fetching...
            </div>
            <div class="modal-footer">
                <div class="form-group input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button">SEND</i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

