<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Assign</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12">
                    <div class="d-flex align-items-center mb-3">
                        <?php
                        $image = userProfilePicture(null);
                        if (is_null($image)) {
                        ?>
                            <div class="nsm-profile me-3">
                                <span>TF</span>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="nsm-profile me-3" style="background-image: url('https://app.creditrepaircloud.com/uploads/61803_cmpny/contacts/1_photo_team_1579652503.png');"></div>
                        <?php
                        }
                        ?>
                        <div class="row w-100">
                            <div class="col-12 col-md-6">
                                <span class="content-title">Tommy Fico</span>
                                <span class="content-subtitle d-block">FICO HEROES</span>
                            </div>
                            <div class="col-12 col-md-6 text-end">
                                <span class="nsm-badge primary">ADMIN</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <button class="nsm-button w-100 ms-0" onclick="location.href='mailto:support@nsmatrac.com'">
                        <i class='bx bx-fw bx-edit'></i> Send Welcome Email
                    </button>
                </div>
                <div class="col-12 col-md-6">
                    <a href="#" target="_blank">
                        <button class="nsm-button primary w-100 ms-0">
                            <i class='bx bx-fw bx-eraser'></i> Visit Website
                        </button>
                    </a>
                </div>
                <div class="col-12">
                    <button class="nsm-button w-100 ms-0 ">
                        <i class='bx bx-fw bx-history'></i> Send Reset Password
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $(document).on('click', '.sendResetPass', function sendResetPass(){
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>/customer/send_welcome_email",
            data: { email_address: '<?= $profile_info->email; ?>'}, // serializes the form's elements.
            success: function (data){
                alert('Password Reset Sent!');
            }
        });
    });
});
</script>