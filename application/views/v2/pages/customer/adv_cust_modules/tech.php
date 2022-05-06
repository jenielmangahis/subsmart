<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Tech</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12 col-md-9">
                    <div class="row g-2">
                        <div class="col-12 col-md-6">
                            <label class="content-title">Arrival Time</label>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->tech_arrive_time; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Departure Time</label>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->tech_depart_time; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Tech Assign</label>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->technician; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Date Given</label>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->save_date; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">CustomField1</label>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo $office_info->office_custom_field1; }; ?>
                            </span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="content-title">Link</label>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <span class="content-subtitle">
                                <?php if(isset($office_info)){ echo string_max_length($office_info->url,20); }; ?>
                            </span>
                        </div>
                    </div>
                </div>
                <?php if(isset($profile_info)): ?>
                <div class="col-12 col-md-3">
                    <div class="col-12">
                        <img class="w-100" src="<?php echo base_url()."assets/img/customer/qr/".$profile_info->prof_id.".png"?>">
                    </div>
                </div>
                <?php endif; ?>
                <div class="col-12">
                    <button role="button" class="nsm-button primary w-100 ms-0 mt-3" id="sendQr">
                        <i class='bx bx-fw bx-qr'></i> Send QR
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $("#sendQr").click(function () {
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>/customer/send_qr",
            data: { custId: "<?= $profile_info->prof_id; ?>"}, // serializes the form's elements.
            success: function (data){
                alert('QR Sent!');
            }
        });
    });
});
</script>