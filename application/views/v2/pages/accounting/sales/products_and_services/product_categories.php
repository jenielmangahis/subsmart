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
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Manage product categories.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col-12 col-md-4"></div> -->

                    <div class="col-12 col-md-4 grid-mb">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Find product categories" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                    </div>                     

                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">

                            <div class="dropdown d-inline-block">
                                <input type="hidden" class="nsm-field form-control" id="selected_ids">
                                <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                    <span id="num-checked"></span> With Selected <i class='bx bx-fw bx-chevron-down'></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                    <li><a class="dropdown-item dropdown-item-delete disabled" href="javascript:void(0);" id="btn-delete-product-categories">Delete</a></li>
                                </ul>
                            </div>

                            <div class="btn-group nsm-main-buttons">
                                <button type="button" class="btn btn-nsm" id="new-category-button"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Category</button>
                                <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class=""><i class='bx bx-chevron-down' ></i></span>
                                </button>
                                <ul class="dropdown-menu">                                         
                                    <li><a class="dropdown-item export-items" href="javascript:void(0);">Export</a></li>  
                                </ul>
                            </div>
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
                                        <input class="form-check-input select-one table-select check-input-product-category" name="catid[]" type="checkbox" value="<?=$category->item_categories_id?>">
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
                                                <a class="dropdown-item edit-category" href="javascript:void(0);">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item remove-category" data-name="<?=$category->name?>" href="javascript:void(0);">Delete</a>
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
                                                    <a class="dropdown-item remove-category" data-name="<?=$childCategory->name?>" href="#">Remove</a>
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
        tableSearch($(this));
    }, 1000));

    /*$("#search_field").on("input", debounce(function() {
        let _form = $(this).closest("form");
        _form.submit();
    }, 1000));*/
});    
</script>
<?php include viewPath('v2/includes/footer'); ?>