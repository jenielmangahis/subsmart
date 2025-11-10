<div class="nsm-card primary" style="<?= $status_cancelled_hide_section; ?>" id="add-advance-custom-fields">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class='bx bx-fw bx-customize'></i> Custom Fields</span>
        </div>
    </div>
    <div class="nsm-card-content" id="custom_field" data-section="custom_field"><hr>
        <a href="javascript:void;" id="add_field" class="nsm-button btn-small pull-right"><span class="fa fa-plus"></span> Add Field</a>
        <br style="clear:both;" />
        <?php if(isset($profile_info)):  ?>
            <?php $custom_fields = json_decode($profile_info->custom_fields); ?>
            <?php if(!empty($custom_fields)): ?>
            <?php foreach ($custom_fields as $field): ?>
                <div class="row form_line">
                    <div class="col-md-5">
                        Name
                        <input type="text" class="form-control" name="custom_name[]" value="<?= $field->name; ?>" />
                    </div>
                    <div class="col-md-5">
                        Value
                        <input type="text" class="form-control" name="custom_value[]" value="<?= $field->value; ?>" />
                    </div>
                    <div class="col-md-2">
                        <button style="margin-top: 24px; font-size:12px;" type="button" class="nsm-button primary items_remove_btn remove_item_row"><i class='bx bx-trash'></i></button>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>
        <?php else: ?>
            <div class="row form_line">
                <div class="col-md-5">
                    Name
                    <input type="text" class="form-control" name="custom_name[]" value="" />
                </div>
                <div class="col-md-5">
                    Value
                    <input type="text" class="form-control" name="custom_value[]" value="" />
                </div>
                <div class="col-md-2">
                    <button style="margin-top: 24px; font-size:12px;" type="button" class="nsm-button primary items_remove_btn remove_item_row"><i class='bx bx-trash'></i></button>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>
<div class="nsm-card primary">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span><i class='bx bx-fw bx-edit-alt'></i> Notes</span>
        </div>
    </div>
    <div class="nsm-card-content"><hr>
            <textarea type="text" class="form-control" name="notes" id="notes" rows="5"><?= isset($profile_info) ? $profile_info->notes : ''; ?></textarea>
    </div>
</div>
<?php if(isset($customer_notes)) :?>
    <div class="nsm-card primary">
        <div class="nsm-card-header">
            <div class="nsm-card-title">
                <span><i class="bx bx-fw bx-user"></i>Existing Notes</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="customer-notes-list">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tbody>
                    <?php foreach ($customer_notes as $note) : ?>
                        <?php if( trim($note->note) != '' ){ ?>
                        <tr>
                            <td style="width: 880px; text-align: left; vertical-align: top; color: #ffffff; padding:5px;background-color: #6a4a86;border: 1px; border-style: solid; border-color: #6a4a86;">
                                <i class='bx bxs-calendar-event'></i> <?= date("m/d/Y h:i A",strtotime($note->datetime)); ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left; border: 1px; padding:5px">
                                <?= $note->note; ?>
                            </td>
                        </tr>
                        <?php } ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>