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
                <?php foreach($emailBlast as $eb){ ?>
                    <tr>
                        <td><?= $eb->campaign_name; ?></td>
                        <td>
                            <?php 
                            if( $eb->sending_type == 0 ){
                                echo "-";
                            }else{
                                echo $sendToOptions[$eb->sending_type];
                            }
                            ?>    
                        </td>
                        <td>
                            <?php 
                                if( $eb->date_sent == '0000-00-00' ){
                                    echo '-';
                                }else{
                                    echo date("Y-m-d",strtotime($eb->date_sent));
                                }
                            ?>
                        </td>
                        <td><?= $statusOptions[$eb->status]; ?></td>
                        <td>
                            <div class="dropdown dropdown-btn">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                    <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">                            
                                    <!-- <li role="presentation">
                                        <a role="menuitem" tabindex="-1" href="<?php echo base_url('email_campaigns/view/' . $eb->id) ?>"><span class="fa fa-file-text-o icon"></span> View</a>
                                    </li>  -->     
                                    <?php if($eb->status != 3){ ?>      
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" href="<?php echo base_url('email_campaigns/edit_campaign/' . $eb->id) ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                    </li>                
                                    <?php } ?>
                                    <li role="presentation">
                                        <a role="menuitem" class="clone-email-campaign" href="javascript:void(0);" data-name="<?= $eb->campaign_name; ?>" data-id="<?= $eb->id; ?>">
                                        <span class="fa fa-files-o icon"></span>  Clone</a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <?php if($eb->status != 3){ ?>
                                    <li role="separator" class="divider"></li>
                                    <li role="presentation">
                                        <a role="menuitem" class="close-email-campaign" data-name="<?= $eb->campaign_name; ?>" data-id="<?= $eb->id; ?>" href="javascript:void(0);" data-id="<?= $eb->id; ?>"><span class="fa fa-trash-o icon"></span> Close</a>
                                    </li>
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