<table class="nsm-table">
    <thead>
        <?php foreach($preview_headers as $value){ ?>
            <td data-name="<?= $value; ?>" style="text-align:left;"><?= $value['name']; ?></td>
        <?php } ?>
    </thead>
    <tbody>
        <?php $inc = 1; ?>
        <?php foreach( $preview_data as $value_key => $value ){ ?>
            <tr>
                <?php $value_key_data = array(); ?>
                <?php foreach($preview_headers as $header){ ?>
                    <td class="fw-bold nsm-text-primary" style="text-align:left;">
                        <?php 
                            if( $header['setting_header'] == 'Phone (M)' || $header['setting_header'] == 'Phone (H)' ){
                                echo formatPhoneNumber($value[$header['name']]);
                                $value_key_data = formatPhoneNumber($value[$header['name']]);
                            }else{
                                echo $value[$header['name']];
                                $value_key_data = $value[$header['name']];
                            }   
                        ?>
                        <input type="hidden" name="customerData[<?php echo $inc; ?>][<?php echo $header['setting_header']; ?>]" value="<?php echo $value_key_data; ?>" />
                    </td>
                <?php } ?>
            </tr>
        <?php $inc++; ?>
        <?php } ?>
    </tbody>
</table>