<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/product_categories_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/sales'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/products_and_services_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <!-- <div class="col-12 col-md-4"></div> -->

                    <div class="col-12 col-md-4 grid-mb">
                        <form action="<?php echo base_url('accounting/product-categories') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Find product categories" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
                    </div>                     

                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">

                            <div class="dropdown d-inline-block">
                                <input type="hidden" class="nsm-field form-control" id="selected_ids">
                                <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                    <span>
                                        Batch Actions
                                    </span> <i class='bx bx-fw bx-chevron-down'></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                    <li><a class="dropdown-item dropdown-item-delete disabled" href="javascript:void(0);" id="btn-delete-product-categories"><i class='bx bx-fw bx-trash'></i> Delete</a></li>
                                </ul>
                            </div>

                            <button type="button" class="nsm-button" id="new-category-button">
                                <i class='bx bx-fw bx-list-plus'></i> New category
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Rows</p>
                                <div class="dropdown d-inline-block">
                                    <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                        <span>
                                            10
                                        </span> <i class='bx bx-fw bx-chevron-down'></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" id="table-rows">
                                        <li><a class="dropdown-item active" href="javascript:void(0);">10</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">50</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">75</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">100</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">150</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">300</a></li>
                                    </ul>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <form id="frm-prod-categories" method="POST">
                    <table class="nsm-table" id="categories-table">
                        <thead>
                            <tr>
                                <td class="table-icon text-center">
                                    <input class="form-check-input table-select select-all-product-category check-input-all-product-category" id="check-input-all-product-category" type="checkbox">
                                </td>                            
                                <td data-name="Name">NAME</td>
                                <td data-name="Manage"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($categories) > 0) : ?>
                            <?php foreach($categories as $category) : ?>
                            <tr data-id="<?=$category->item_categories_id?>">
                                <td>
                                    <div class="table-row-icon table-checkbox">
                                        <input class="form-check-input select-one table-select check-input-product-category" id="check-input-product-category" name="catid[]" type="checkbox" value="<?=$category->item_categories_id?>">
                                    </div>
                                </td>                        
                                <td class="fw-bold nsm-text-primary nsm-link default" style="cursor: context-menu !important;"><?=$category->name?></td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item edit-category" href="#">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item remove-category" href="#">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <?php foreach($category->child_categories as $childCategory) : ?>
                                <tr data-id="<?=$childCategory->item_categories_id?>">
                                    <td>
                                        <div class="table-row-icon table-checkbox">
                                            <input class="form-check-input select-one table-select check-input-product-category" id="check-input-product-category" name="catid[]" type="checkbox" value="<?=$childCategory->item_categories_id?>">
                                        </div>
                                    </td>                                
                                    <td class="fw-bold nsm-text-primary nsm-link default" style="cursor: context-menu !important;">
                                        &nbsp;&nbsp;
                                        <span class="badge badge-primary badge-pill">Subcategory</span> 
                                        <?=$childCategory->name?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item edit-category" href="#">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item remove-category" href="#">Remove</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                            <?php else : ?>
                            <tr>
                                <td colspan="14">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $("#search_field").on("input", debounce(function() {
        let _form = $(this).closest("form");
        _form.submit();
    }, 1000));  
});    
</script>
<?php include viewPath('v2/includes/footer'); ?>