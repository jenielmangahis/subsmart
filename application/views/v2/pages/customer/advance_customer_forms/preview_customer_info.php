<div class="nsm-card primary">
    <div class="nsm-card-content">
        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span><i class="bx bx-fw bx-user"></i>Customer Profile</span>
                    <hr />
                </div>
            </div>
        </div>
        <div class="row g-1 mb-5">
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Customer Type</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= !empty($profile_info->customer_type) ? $profile_info->customer_type : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Sales Area</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">
                    <?php $salesArea = '---';
                    foreach ($sales_area as $sa) : ?>
                        <?php if (isset($profile_info) && $profile_info->fk_sa_id != 0) {
                            if ($profile_info->fk_sa_id == $sa->sa_id) {
                                $salesArea = $sa->sa_name;
                            }
                        } ?>
                    <?php endforeach ?>
                    <?= $salesArea ?>
                </label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Business Name</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->business_name) ? $profile_info->business_name : '---'; ?></label>
            </div>
            <?php if($companyId == 1): ?>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Industry Type</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= $industryType ? $industryType->name : 'Not Specified'; ?></label>
            </div>
            <?php endif; ?>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">First Name</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->first_name) ? $profile_info->first_name : 'n/a'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Middle Initial</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->middle_name) ? strtoupper($profile_info->middle_name) : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Last Name</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->last_name) ? $profile_info->last_name : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Name Prefix</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->prefix) ? $profile_info->prefix : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Suffix</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->suffix) ? $profile_info->suffix : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Address</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->mail_add) ? $profile_info->mail_add : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Country</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->country) ? $profile_info->country : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">City</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->city) ? $profile_info->city : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">State</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->state) ? $profile_info->state : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Zip Code</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->zip_code) ? $profile_info->zip_code : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Cross Street</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->cross_street) ? $profile_info->cross_street : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">County</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->county) ? $profile_info->county : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Subdivision</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->subdivision) ? $profile_info->subdivision : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Social Security No.</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle">
                    <?php 
                        if (logged("user_type") == 1){
                            $ssn = $profile_info->ssn;
                        }else{
                            $ssn = maskString($profile_info->ssn);
                        }

                        echo $ssn;
                    ?>
                </label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Date Of Birth</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?php echo ($profile_info->date_of_birth) ? date_format(date_create($profile_info->date_of_birth), "M d, Y") : "&mdash;"; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Email</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->email) ? $profile_info->email : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Phone (H)</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->phone_h) ? formatPhoneNumber($profile_info->phone_h) : '---'; ?></label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle fw-bold">Phone (M)</label>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-subtitle"><?= isset($profile_info) && !empty($profile_info->phone_m) ? formatPhoneNumber($profile_info->phone_m) : '---'; ?></label>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span><i class="bx bx-fw bx-user"></i>Emergency Contacts</span>
                    <hr />
                </div>
            </div>
        </div>
        <div class="row g-1 mb-5">
            <?php if (!empty($contacts)) : ?>
                <?php foreach ($contacts as $key => $contact): ?>
                    <?php if (!empty(trim($contact->first_name))): ?>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold"><?= $key + 1; ?>. Contact Name</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle"><?= $contact->first_name . ' ' . $contact->last_name; ?></label>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold" style="margin-left:15px;">Contact Phone</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle"><?= empty($contact->phone) ? '---' : formatPhoneNumber($contact->phone); ?></label>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle fw-bold" style="margin-left:15px;">Relationship</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-subtitle"><?= empty($contact->relation) ? '---' : $contact->relation; ?></label>
                        </div>
                        <hr />
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-12">
                    <label class="content-subtitle">No emergency contacts found.</label>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>