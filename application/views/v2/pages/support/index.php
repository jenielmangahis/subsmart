<?php include viewPath('v2/includes/header'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/my_crm_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <!-- <button><i class='bx bx-x'></i></button> -->
                            Send email to our support so that we may assist you.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-4">
                    <div class="col-12 col-md-6 order-1 order-md-0">
                        <div class="m-auto w-50">
                            <form method="POST" id="support_form">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <input type="hidden" name="ns_input" id="ns-input" value="">
                                        <label class="content-subtitle fw-bold mb-2 d-block">First Name</label>
                                        <input type="text" placeholder="First Name" name="first_name" id="first_name" class="nsm-field form-control" required value="<?php echo $user->FName; ?>" />
                                    </div>
                                    <div class="col-12">
                                        <label class="content-subtitle fw-bold mb-2 d-block">Last Name</label>
                                        <input type="text" placeholder="Last Name" name="last_name" id="last_name" class="nsm-field form-control" required value="<?php echo $user->LName; ?>" />
                                    </div>
                                    <div class="col-12">
                                        <label class="content-subtitle fw-bold mb-2 d-block">Email</label>
                                        <input type="email" placeholder="Email Address" name="email" id="email" class="nsm-field form-control" required value="<?php echo $user->email; ?>" />
                                    </div>
                                    <div class="col-12">
                                        <label class="content-subtitle fw-bold mb-2 d-block">Subject</label>
                                        <input type="text" placeholder="Subject" name="subject" id="subject" class="nsm-field form-control" required />
                                    </div>
                                    <div class="col-12">
                                        <label class="content-subtitle fw-bold mb-2 d-block">Message</label>
                                        <textarea name="message" id="message" cols="30" rows="10" placeholder="Message" class="nsm-field form-control" required></textarea>
                                    </div>
                                    <div class="col-12 text-end">
                                        <button type="submit" class="nsm-button primary" name="btn_send">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="nsm-img m-auto nsm-xl" style="background-image: url('<?php echo $url->assets ?>img/support.png');"></div>
                        <h3 class="fw-bold text-center">Our support team are here to help you.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#support_form").on("submit", function(e) {
            e.preventDefault();

            let _this = $(this);
            let url = "<?php echo base_url('support/_send_email'); ?>";

            Swal.fire({
                title: "Are all entries correct?",
                text: "Your concern will be sent to our support team",
                icon: 'question',
                confirmButtonText: 'Confirm',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $(".nsm-button[type=submit]").prop("disabled", true).html("Sending...");

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: _this.serialize(),
                        dataType: "json",
                        success: function(result) {
                            if (result.is_sent == 1) {
                                Swal.fire({
                                    title: 'Your concern was successfully sent!',
                                    text: "Our support team will contact you soon via your email.",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });

                                _this[0].reset();
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: "Cannot send email.",
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }

                            $(".nsm-button[type=submit]").prop("disabled", false).html("Send");
                        }
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>