<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/attachments_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Adding relevant information to a record is always bound to come in handy. You can attach new files to an entity's record, which will serve the purpose of having every related information in one place.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Find by Name">
                        </div> -->
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <input type="hidden" class="nsm-field form-control" id="selected_ids">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Batch Actions
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="export-attachments">Export</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="create-invoice">Create invoice</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="create-expense">Create expense</a></li>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#upload-attachments-modal">
                                <i class='bx bx-fw bx-list-plus'></i> Add Attachments
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_attachments_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="col_size" class="form-check-input">
                                    <label for="col_size" class="form-check-label">Size</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="col_uploaded" class="form-check-input">
                                    <label for="col_uploaded" class="form-check-label">Uploaded</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="col_note" class="form-check-input">
                                    <label for="col_note" class="form-check-label">Note</label>
                                </div>
                                <p class="m-0">Rows</p>
                                <div class="dropdown d-inline-block">
                                    <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                        <span>
                                            50
                                        </span> <i class='bx bx-fw bx-chevron-down'></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" id="table-rows">
                                        <li><a class="dropdown-item active" href="javascript:void(0);">50</a></li>
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
                <table class="nsm-table" id="attachments-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Thumbnail">THUMBNAIL</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="Name">NAME</td>
                            <td data-name="Size">SIZE</td>
                            <td data-name="Uploaded">UPLOADED</td>
                            <td data-name="Links">LINKS</td>
                            <td data-name="Note">NOTE</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($attachments) > 0) : ?>
						<?php foreach($attachments as $attachment) : ?>
                        <tr data-file="<?=$attachment['thumbnail']?>" data-extension="<?=$attachment['extension']?>">
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$attachment['id']?>">
                                </div>
                            </td>
                            <td>
                                <?php if($attachment['type'] === 'Image') : ?>
                                <div class="table-row-icon img" style="background-image: url('<?=base_url("uploads/accounting/attachments/".$attachment['thumbnail']."")?>')"></div>
                                <?php else : ?>
                                No preview available
                                <?php endif; ?>
                            </td>
                            <td><?=$attachment['type']?></td>
                            <td class="fw-bold nsm-text-primary nsm-link default"><?=$attachment['name']?></td>
                            <td><?=$attachment['size']?></td>
                            <td><?=$attachment['upload_date']?></td>
                            <td>
                                <?php if(count($attachment['links']) > 0) : ?>
                                <?php foreach($attachment['links'] as $link) : ?>
                                <?=$link['text']?>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </td>
                            <td><?=$attachment['notes']?></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="<?=in_array($attachment['type'], ['Image', 'Pdf']) ? '/uploads/accounting/attachments/'.$attachment['thumbnail'] : '/accounting/attachments/download?filename='.$attachment['thumbnail']?>" target="__blank">Download</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item edit-attachment" href="#">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item delete-attachment" href="#">Delete</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item create-invoice" href="#">Create invoice</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item create-expense" href="#">Create expense</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
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
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>