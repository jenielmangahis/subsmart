<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/tags_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/banking'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/tags_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Tags are customizable labels that let you track your money however you want. When you put tags into groups, you get deeper insights into how your business is doing. You'll need groups to get reports for your tags. You can tag transactions such as invoices, expenses and bills.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <form action="<?php echo base_url('accounting/tags') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" name="search" id="search_field" placeholder="Search by tag name" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        
                        <!-- <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-list-plus"></i> New
                                <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#tag-group-modal">Tag group</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#tag-modal">Tag</a></li>
                            </ul>
                            <button type="button" class="nsm-button primary" id="delete-tags-button">
                                <i class='bx bx-fw bx-trash'></i>
                            </button>
                        </div> -->

                        <div class="nsm-page-buttons page-button-container">                 
                            
                            <div class="dropdown d-inline-block">
                                <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                    <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item btn-with-selected" id="delete-tags-button" href="javascript:void(0);">Delete</a></li>                              
                                </ul>
                            </div>                        
           
                            <div class="btn-group nsm-main-buttons" style="margin-bottom: 5px;">
                                <button type="button" class="btn btn-nsm" id="btn-add-employee"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Tags</button>
                                <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class=""><i class='bx bx-chevron-down' ></i></span>
                                </button>
                                <ul class="dropdown-menu">                                                                    
                                    <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#tag-group-modal">Tag group</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#tag-modal">Tag</a></li>                                                                
                                </ul>
                            </div>
                         
                        </div>                        
                    </div>
                </div>
                <table class="nsm-table" id="tags-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Tag and Tag Groups">TAGS AND TAG GROUPS</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($tags) > 0) : ?>
						<?php foreach($tags as $index => $tag) : ?>
                        <?php $bg_group = $tag['type'] === 'group' ? 'text-primary' : ''; ?>
                        <tr data-id="<?=$tag['id']?>" data-type="<?=$tag['type']?>" class="<?= $bg_group; ?>">
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$tag['type']?>_<?=$tag['id']?>">
                                </div>
                            </td>
                            <td class="fw-bold nsm-text-primary nsm-link default" <?=$tag['type'] === 'group' ? 'data-bs-toggle="collapse" data-bs-target=".collapse-'.$index.'"' : ''?>>
                                <?php if($tag['type'] === 'group') : ?>
                                    <span onclick="javascript:toggleGroupTag(<?php echo $tag['id']; ?>);"><i class='bx bx-fw bx-chevron-down'></i> <?=$tag['name']?> (<?=count($tag['tags'])?> tags)</span>
                                <?php else : ?>
                                    <?=$tag['name']?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <!-- <li>
                                            <a class="dropdown-item" href="#">Run Report</a>
                                        </li> -->
                                        <?php if($tag['type'] === 'group') : ?>
                                        <li>
                                            <a class="dropdown-item add-tag" href="#">Add tag</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item btn-edit-tag" data-id="<?= $tag['id']; ?>" data-type="<?= $tag['type']; ?>" data-name="<?= $tag['name']; ?>" href="javascript:void(0);">Edit group</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item delete-group" href="javascript:void(0);">Delete group</a>
                                        </li>
                                        <?php else : ?>
                                        <li>
                                            <a class="dropdown-item btn-edit-tag" data-id="<?= $tag['id']; ?>" data-type="<?= $tag['type']; ?>" data-name="<?= $tag['name']; ?>" href="javascript:void(0);">Edit tag</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item delete-tag" href="javascript:void(0);">Delete tag</a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php if($tag['type'] === 'group') : ?>
                        <?php foreach($tag['tags'] as $groupTag) : ?>
                        <tr class="group-tag-id-<?= $groupTag['group_tag_id']; ?> collapse collapse-<?=$index?>" data-id="<?=$groupTag['id']?>" data-type="group-tag">
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="group-tag_<?=$groupTag['id']?>">
                                </div>
                            </td>
                            <td class="fw-bold nsm-text-primary nsm-link default"><div class="text-secondary" style="margin-left: 30px;">-<?=$groupTag['name']?></div></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);">Run Report</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item btn-edit-tag" href="javascript:void(0);" data-id="<?= $groupTag['id']; ?>" data-type="tag" data-name="<?= $groupTag['name']; ?>">Edit tag</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item delete-tag" href="javascript:void(0);">Delete tag</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <?php endforeach; ?>
						<?php else : ?>
						<tr>
							<td colspan="3">
								<div class="nsm-empty">
									<span>No results found.</span>
								</div>
							</td>
						</tr>
						<?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>

function toggleGroupTag(group_id) {
    $('.group-tag-id-' + group_id).toggle();
}

$(function(){
    $("#tags-table").nsmPagination();  
    
    $('.btn-edit-tag').on('click', function(){
        var tid = $(this).attr('data-id');
        var tag_type = $(this).attr('data-type');
        var tag_name = $(this).attr('data-name');

        $('#edit-tid').val(tid);
        $('#edit-tag-type').val(tag_type);
        $('#edit-tag-name').val(tag_name);
        $('#edit_accounting_tag_modal').modal('show');
    });

    $("#frm-accounting-edit-tag").on("submit", function(e) {
        let _this = $(this);
        e.preventDefault();

        var url = base_url + "accounting/_update_tag";
        _this.find("button[type=submit]").html("Saving");
        _this.find("button[type=submit]").prop("disabled", true);

        $.ajax({
            type: 'POST',
            url: url,
            data: _this.serialize(),
            dataType:'json',
            success: function(result) {
                console.log(result);
                if (result.is_success === 1) {
                    Swal.fire({                        
                        text: "Tags has been updated successfully.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: result.msg
                    });
                }

                $("#edit_accounting_tag_modal").modal('hide');
                _this.trigger("reset");

                _this.find("button[type=submit]").html("Save");
                _this.find("button[type=submit]").prop("disabled", false);
            },
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>