<?php
/**
 * Accounting Banking footer script
 *
 * PHP version 7.2.19
 *
 * @package    nSmarTrac
 * @category   Footer Script
 * @author     Welyelf Hisula<welyelfhisula@gmail.com>
 * @copyright  2020 nSmarTrac
 */
?>

<script>
    function nsmartrac_alert(title='Awesome',text,icon='success',redirect=''){
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: false,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value) {
                if(redirect === 'reload'){
                    window.location.reload();
                }else if(redirect !== ''){
                    window.location.href='<?= base_url(); ?>'+redirect;
                }
            }
        });
    }
</script>
