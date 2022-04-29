<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Customizable</span>
            </div>
            <label class="nsm-subtitle d-none">Set the prefix and the next auto-generated number.</label>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12">
                    <table class="nsm-table mb-2">
                        <thead>
                            <tr>
                                <th data-name="Name">Name</th>
                                <th data-name="Value">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $fields = [];
                                if (!empty($profile_info->custom_fields)) {
                                    $fields = json_decode($profile_info->custom_fields, true);
                                    $fields = is_array($fields) ? $fields : [];
                                }
                            ?>
                            <?php if (!empty($fields)) : ?>
                                <?php foreach ($fields as $field) : ?>
                                    <tr>
                                        <td class="fw-bold nsm-text-primary"><?=$field['name'];?></td>
                                        <td><?=$field['value'];?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="2">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php if (isset($profile_info)) : ?>
                    <div class="col-12">
                        <button class="nsm-button primary w-100 ms-0" onclick="location.href='<?= base_url('/customer/add_advance/' . $profile_info->prof_id . '?section=custom_field'); ?>'">
                            <i class='bx bx-fw bx-edit'></i> View/Edit Fields
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>