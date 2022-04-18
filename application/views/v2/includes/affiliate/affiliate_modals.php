<div class="modal fade nsm-modal fade" id="advance_search_modal" tabindex="-1" aria-labelledby="advance_search_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart('affiliate/index', ['method' => 'GET', 'id' => 'affiliate-adv-search', 'class' => 'form-validate', 'autocomplete' => 'off']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="advance_search_modal_label">Advance Search</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row gx-2">
                    <div class="col-12">
                        <input type="text" placeholder="Affiliate Name" name="affiliate_name" class="nsm-field form-control mb-2" />
                    </div>
                    <div class="col-12">
                        <input type="email" placeholder="Email Address" name="affiliate_email" class="nsm-field form-control mb-2" />
                    </div>
                    <div class="col-12">
                        <input type="text" placeholder="Company" name="affiliate_company" class="nsm-field form-control mb-2" />
                    </div>
                    <div class="col-12">
                        <select class="nsm-field form-select" name="affiliate_status">
                            <option value="" selected="selected">Status</option>
                            <option value="all">All</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary">Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="print_affiliate_modal" tabindex="-1" aria-labelledby="print_affiliate_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_affiliate_modal_label">Print Affiliate Partners</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Affiliate Name">Affiliate Name</td>
                            <td data-name="Company">Company</td>
                            <td data-name="Email">Email</td>
                            <td data-name="Phone">Phone</td>
                            <td data-name="Added">Added</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Portal Access">Portal Access</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($affiliates)) :
                        ?>
                            <?php
                            foreach ($affiliates as $affiliate) :
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-group'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?php echo $affiliate->first_name . ' ' . $affiliate->last_name; ?></td>
                                    <td><?php echo $affiliate->company; ?></td>
                                    <td><?php echo $affiliate->email; ?></td>
                                    <td><?php echo $affiliate->phone; ?></td>
                                    <td><?php echo $affiliate->date_created; ?></td>
                                    <td>
                                        <?php
                                        if ($affiliate->status == 'Active') :
                                            $badge = 'success';
                                            $status = 'Active';
                                        else :
                                            $badge = '';
                                            $status = 'Inactive';
                                        endif;
                                        ?>
                                        <span class="nsm-badge <?= $badge ?>"><?php echo $status; ?></span>
                                    </td>
                                    <td>
                                        <?php if ($affiliate->portal_access == 1) : ?>
                                            <span class="nsm-badge success">Yes</span>
                                        <?php else : ?>
                                            <span class="nsm-badge">No</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="8">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_print_affiliates">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="print_affiliate_view_modal" tabindex="-1" aria-labelledby="print_affiliate_view_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_affiliate_view_modal_label">Print Affiliate Partners</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="affiliates_table_print">
                    <thead>
                        <tr>
                            <td data-name="Affiliate Name"><b>Affiliate Name</b></td>
                            <td data-name="Company"><b>Company</b></td>
                            <td data-name="Email"><b>Email</b></td>
                            <td data-name="Phone"><b>Phone</b></td>
                            <td data-name="Added"><b>Added</b></td>
                            <td data-name="Status"><b>Status</b></td>
                            <td data-name="Portal Access"><b>Portal Access</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($affiliates)) :
                        ?>
                            <?php
                            foreach ($affiliates as $affiliate) :
                            ?>
                                <tr>
                                    <td class="fw-bold nsm-text-primary"><?php echo $affiliate->first_name . ' ' . $affiliate->last_name; ?></td>
                                    <td><?php echo $affiliate->company; ?></td>
                                    <td><?php echo $affiliate->email; ?></td>
                                    <td><?php echo $affiliate->phone; ?></td>
                                    <td><?php echo $affiliate->date_created; ?></td>
                                    <td>
                                        <?php
                                        if ($affiliate->status == 'Active') :
                                            $badge = 'success';
                                            $status = 'Active';
                                        else :
                                            $badge = '';
                                            $status = 'Inactive';
                                        endif;
                                        ?>
                                        <span class="nsm-badge <?= $badge ?>"><?php echo $status; ?></span>
                                    </td>
                                    <td>
                                        <?php if ($affiliate->portal_access == 1) : ?>
                                            <span class="nsm-badge success">Yes</span>
                                        <?php else : ?>
                                            <span class="nsm-badge">No</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="8">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>