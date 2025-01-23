<table class="nsm-table">
    <thead>
        <?php foreach($preview_headers as $value){ ?>
            <td data-name="<?= $value; ?>" style="text-align:left;"><?= $value['name']; ?></td>
        <?php } ?>
    </thead>
    <tbody>
        <?php foreach( $preview_data as $value ){ ?>
            <tr>
                <?php foreach($preview_headers as $header){ ?>
                    <td class="fw-bold nsm-text-primary" style="text-align:left;">
                        <?php 
                            if( $header['setting_header'] == 'Phone (M)' || $header['setting_header'] == 'Phone (H)' ){
                                echo formatPhoneNumber($value[$header['name']]);
                            }else{
                                echo $value[$header['name']];
                            }   
                        ?>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>