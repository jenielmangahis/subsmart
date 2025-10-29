<?php include viewPath('v2/includes/header'); ?>
<style>
.btn-photo-delete-row{
    margin-bottom:0px !important;
}
.img-gallery{
    height:200px;
}
.row-actions-container{
    position: absolute;
    top: 10px;
    right: 6px;
}
.row-actions-container button{
    border:#6a4a86 !important;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('photo_gallery') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/files_vault_tab'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            One of the best way for prospect to process information is with visual data.  Start sharing your success photos to others to grow your business.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter primary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-list-ul'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id=""><?= count($photoGallery); ?></h2>
                                    <span>Total Photos</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 grid-mb text-end">
                        <input type="hidden" id="customer-deal-modal-name" value="" />   
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>
                        <button type="button" class="nsm-button primary" id="btn-add-photo"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Photo</button>
                    </div>
                </div>   
                <div class="row mt-2 mb-2">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_photos" name="search" placeholder="Search" value="">
                        </div>
                    </div> 
                </div>
                <div class="row" id="deal-forecast">
                    <form id="frm-with-selected">
                        <?php if (!empty($photoGallery)) {?>
                            <div class="row">
                                <?php foreach($photoGallery as $gallery){ ?>
                                    <div class="col-12 col-md-3 photo-gallery-container">
                                        <div class="card">
                                            <a data-caption="<?= $gallery->caption != '' ? $gallery->caption : 'Gallery Image'; ?>" data-fancybox data-src="<?= base_url("uploads/photo_gallery/" . $gallery->company_id . "/" . $gallery->image);?>" href="javascript:void(0);">
                                                <img class="card-img-top img-gallery" src="<?= base_url("uploads/photo_gallery/" . $gallery->company_id . "/" . $gallery->image); ?>">      
                                            </a>
                                            <div class="row-actions-container">
                                                <button type="button" class="nsm-button primary btn-edit-caption float-end" data-id="<?= $gallery->id; ?>" data-caption="<?= $gallery->caption; ?>"><i class='bx bx-edit'></i></button>
                                                <button type="button" class="nsm-button primary btn-delete-photo float-end" data-id="<?= $gallery->id; ?>" data-caption="<?= $gallery->caption; ?>"><i class='bx bx-trash'></i></button>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $gallery->caption != '' ? $gallery->caption : 'Gallery Image'; ?></h5>
                                            </div>
                                        </div>                                        
                                    </div>
                                <?php } ?>
                            </div>
                        <?php }else{ ?>
                            <div class="page-empty-container" style="text-align:center; margin-top:50px;">
                                <h5 class="page-empty-header">You haven't uploaded any photos.</h5>
                                <p class="text-ter margin-bottom">Upload photos and send them to your customers.</p>
                            </div>
                        <?php } ?>
                    </form>
                </div>  
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/photo_gallery/modals'); ?>
<?php include viewPath('v2/pages/photo_gallery/js/list'); ?>
<?php include viewPath('v2/includes/footer'); ?>