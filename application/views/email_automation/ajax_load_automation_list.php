<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<div class="row">
    <div class="col-xl-12 col-md-12">
        <table id="dataTableAutomation">
            <thead>
                <tr>
                    <th>Automation Name</th>
                    <th>Event</th>
                    <th>Details</th>
                    <th>Texts</th>           
                    <th>Active</th>
                    <th></th>            
                </tr>
            </thead>
            <tbody>
                <?php foreach($emailAutomation as $s){ ?>
                    <tr>
                        <td><?= $s->name; ?></td>
                        <td><?= $optionRuleEvent[$s->rule_event]; ?></td>
                        <td><?= $optionRuleNotifyAt[$s->rule_notify_at]; ?></td>
                        <td>0 - <a href="javascript:void(0)" style="color:#259e57;">view log</a></td>
                        <td>
                            <?php 
                                $is_active = '';
                                if( $s->is_active == 1 ){ 
                                    $is_active = 'checked';
                                }
                            ?>
                            <input type="checkbox" class="automation-toggle" <?= $is_active; ?> data-toggle="toggle" data-id="<?= $s->id; ?>" data-size="small">
                        </td>
                        <td>
                            <div class="dropdown dropdown-btn">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                    <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">                            
                                    <li role="presentation">
                                        <a role="menuitem" tabindex="-1" href="<?php echo base_url('sms_automation/edit_automation/' . $s->id) ?>"><span class="fa fa-pencil icon"></span> Edit</a>
                                    </li> 
                                    <li role="presentation">
                                        <a role="menuitem" class="delete-email-automation" data-name="<?= $s->name; ?>" data-id="<?= $s->id; ?>" href="javascript:void(0);"><span class="fa fa-trash-o icon"></span> Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>