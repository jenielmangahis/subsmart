<style>
.deals-image{
    width: 99px;    
    display: inline-block;
}
.deals-description{
    display: inline-block;
    vertical-align: top;
    margin-left: 12px;
    font-size: 16px;
}
</style>
<div class="row">
    <div class="col-xl-12 col-md-12">
        <table id="dataTableDealsSteals">
            <thead>
                <tr>
                    <th>Deal</th>
                    <th style="text-align: center;">Views</th>
                    <th style="text-align: center;">Bookings</th>
                    <th style="text-align: center;">Valid</th>           
                    <th style="text-align: center;">Status</th>
                    <th></th>    
                </tr>
            </thead>
            <tbody>
                <?php foreach($dealsSteals as $ds){ ?>
                    <tr>
                        <td>
                            <div class="deals-image">
                                    <img src="<?= base_url("uploads/deals_steals/" . $ds->company_id . "/" . $ds->photos); ?>" style="width: 100%;">
                            </div>
                            <div class="deals-description">
                                <?= $ds->title; ?><br/>
                                <span style="color:#2ab363;">$<?= number_format($ds->deal_price,2); ?></span>
                            </div>
                        </td>
                        <td align="center">0</td>
                        <td align="center">0</td>
                        <td align="center"></td>
                        <td align="center"><?= $statusOptions[$ds->status]; ?></td>
                        <td>
                            <div class="dropdown dropdown-btn">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                    <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit"> 
                                    <?php if($ds->status != 3){ ?>      
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" href="<?php echo base_url('promote/edit_deals/' . $ds->id) ?>"><span class="fa fa-pencil-square-o icon"></span> Edit</a>
                                    </li> 
                                    <li role="presentation">
                                        <a role="menuitem" class="close-deal" data-name="<?= $ds->title; ?>" data-id="<?= $ds->id; ?>" href="javascript:void(0);"><span class="fa fa-trash-o icon"></span> Close Deal</a>
                                    </li> 
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" class="delete-deals" href="javascript:void(0);" data-name="<?= $ds->title; ?>" data-id="<?= $ds->id; ?>"><span class="fa fa-trash icon"></span> Delete</a>
                                    </li>                  
                                    <?php } ?>
                                    <?php if($ds->status == $status_ended){ ?>      
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" class="delete-deals" href="javascript:void(0);" data-name="<?= $ds->title; ?>" data-id="<?= $ds->id; ?>"><span class="fa fa-trash icon"></span> Delete</a>
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