<style>
.menu-row-container{
    background-color:#6a4a86;
    color:#ffffff;
    padding:10px;
    margin:5px;
}
.menu-row-container label{
    font-size:17px;
}
.menu-row-container .form-check-input{
    position: relative;
    top: 3px;
}
</style>
<div class="row" id="menu-sort">

<?php if( $companyMenus ){ ?>
    <?php foreach($companyMenus as $menu){ ?>
        <div class="col-md-12 col-12 list-group-item">
            <div class="menu-row-container">
                <div class="row">
                    <div class="col-md-1 col-1"><i class='bx bx-grid-vertical' style="position:relative;top:3px;font-size:21px;"></i></div>
                    <div class="col-md-8 col-8">
                        <div class="form-check">                        
                            <input name="customizeMenu[]" type="hidden" value="<?= $menu->menu_name; ?>" class="form-check-input">
                            <input name="customizeMenuIsEnabled[]" type="hidden" value="<?= $menu->is_enabled; ?>" class="form-check-input is-enabled" />
                            <input class="form-check-input menu-enabled" type="checkbox" value="" id="chkAccordion1Child<?= $menu->id; ?>" <?= $menu->is_enabled == 1 ? 'checked=""' : '';; ?>>
                            <label for="chkAccordion1Child<?= $key; ?>"><?= $menu->menu_name; ?></label>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    <?php } ?>
<?php }else{ ?>
    <?php foreach($menus as $key => $menu_name){ ?>
        <div class="col-md-12 col-12 list-group-item">
            <div class="menu-row-container">
                <div class="row">
                    <div class="col-md-1 col-1"><i class='bx bx-grid-vertical' style="position:relative;top:3px;font-size:21px;"></i></div>
                    <div class="col-md-8 col-8">
                        <div class="form-check">                        
                            <input name="customizeMenu[]" type="hidden" value="<?= $menu_name; ?>" class="form-check-input">
                            <input name="customizeMenuIsEnabled[]" type="hidden" value="1" class="form-check-input is-enabled" />
                            <input class="form-check-input menu-enabled" type="checkbox" value="" id="chkAccordion1Child<?= $key; ?>" checked="">
                            <label for="chkAccordion1Child<?= $key; ?>"><?= $menu_name; ?></label>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    <?php } ?>
<?php } ?>

</div>
<script>
$(function(){
    $('div#menu-sort').sortable({
        itemSelector: '.list-group-item',
        containerSelector: '#menu-sort'
    });

    $('.menu-enabled').on('change', function(){
        if ($(this).is(':checked')) {
           $(this).closest('.form-check').find('.is-enabled').val(1);
        }else{
            $(this).closest('.form-check').find('.is-enabled').val(0);
        }
    });
});
</script>
