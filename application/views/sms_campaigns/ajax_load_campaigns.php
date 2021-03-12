<div class="row">
    <div class="col-xl-12 col-md-12">
        <table id="dataTableCampaign">
            <thead>
                <tr>
                    <th>Campaign</th>
                    <th>Send To</th>
                    <th>Sent on</th>
                    <th>Status</th>           
                    <th></th>            
                </tr>
            </thead>
            <tbody>
                <?php foreach($smsBlast as $sb){ ?>
                    <tr>
                        <td><?= $sb->campaign_name; ?></td>
                        <td>
                            <?php 
                            if( $sb->sending_type == 0 ){
                                echo "-";
                            }else{
                                echo $sendToOptions[$sb->sending_type];
                            }
                            ?>    
                        </td>
                        <td>
                            <?php 
                                if( $sb->date_sent == '0000-00-00' ){
                                    echo '-';
                                }else{
                                    echo date("Y-m-d",strtotime($sb->date_sent));
                                }
                            ?>
                        </td>
                        <td><?= $statusOptions[$sb->status]; ?></td>
                        <td>
                            <div class="dropdown dropdown-btn">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                    <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">                            
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" href="<?php echo base_url('credit_notes/view/' . $sb->id) ?>"><span class="fa fa-file-text-o icon"></span> View</a>
                                    </li>      
                                    <?php if($sb->status != 3){ ?>      
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" href="<?php echo base_url('sms_campaigns/edit_campaign/' . $sb->id) ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                    </li>                
                                    <?php } ?>
                                    <!-- <li role="presentation">
                                        <a role="menuitem" class="clone-sms-campaign" href="javascript:void(0);" data-name="<?= $sb->campaign_name; ?>" data-id="<?= $sb->id; ?>">
                                        <span class="fa fa-files-o icon"></span>  Clone</a>
                                    </li> -->
                                    <li role="separator" class="divider"></li>
                                    <?php if($sb->status != 3){ ?>
                                    <li role="separator" class="divider"></li>
                                    <!-- <li role="presentation">
                                        <a role="menuitem" class="close-sms-campaign" data-name="<?= $sb->campaign_name; ?>" data-id="<?= $sb->id; ?>" href="javascript:void(0);" data-id="<?= $sb->id; ?>"><span class="fa fa-trash-o icon"></span> Close</a>
                                    </li> -->
                                    <?php } ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>