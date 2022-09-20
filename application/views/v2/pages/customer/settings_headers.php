<?php include viewPath('v2/includes/header'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            A great process of managing interactions with existing as well as past and potential customers is to have one powerful platform that can provide an immediate response to your customer needs.
                            Try our quick action icons to create invoices, scheduling, communicating and more with all your customers.
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="nsm-card">
                            <div class="nsm-card-content">
                                <div class="row g-2">
                                    <div class="col-12">
                                        <div class="nsm-card-title">
                                            <span>Customer List Table Headers</span>
                                        </div>
                                        <label class="nsm-subtitle mb-3">Check the column title to display in customers list.</label>
                                        <form id="customer_headers_form" method="POST">
                                            <div class="row">
                                                <?php foreach ($customer_list_headers as $key => $value) :
                                                    $checked  = '';
                                                    if ($customer_tbl_headers) {
                                                        if (in_array($key, $customer_tbl_headers)) {
                                                            $checked = 'checked="checked"';
                                                        }
                                                    }
                                                ?>
                                                    <div class="col-12 col-md-6">
                                                        <div class="d-block">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="headers[<?= $key; ?>]" id="<?= $key; ?>" <?= $checked; ?>>
                                                                <label class="form-check-label" for="<?= $key; ?>"><?= $value; ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>

                                                <?php if($company_id == 58): ?>
                                                    <div class="col-12 col-md-12"> </div>
                                                    <br><br><br><hr><h3>Solar Fields</h3>
                                                    <?php $solar_fields = solar_info_header(); ?>
                                                    <?php foreach($solar_fields as $solar): ?>
                                                            <?php 
                                                                $checked  = '';
                                                                if (in_array($solar['name'], $customer_tbl_headers)) {
                                                                    $checked = 'checked="checked"';
                                                                }
                                                            ?>
                                                                <div class="col-12 col-md-3">
                                                                    <div class="d-block">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="solarHeader[<?= $solar['name'] ?>]" id="<?= $solar['name'] ?>" <?= $checked; ?>>
                                                                            <label class="form-check-label" for="<?= $solar['name'] ?>"><?= $solar['description'] ?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                        endforeach;
                                                endif;
                                                ?>
                                                
                                                
                                                <?php if($company_id == 31): ?>
                                                    <div class="col-12 col-md-12"> </div>
                                                    <br><br><br><hr><h3>Alarm Fields</h3>
                                                    <?php $alarm_fields = alarm_info_header(); ?>
                                                    <?php foreach($alarm_fields as $alarm): ?>
                                                        <?php 
                                                            $checked  = '';
                                                            if (in_array($alarm['name'], $customer_tbl_headers)) {
                                                                $checked = 'checked="checked"';
                                                            }
                                                        ?>
                                                            <div class="col-12 col-md-3">
                                                                <div class="d-block">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="alarmHeader[<?= $alarm['name'] ?>]" id="<?= $alarm['name'] ?>" <?= $checked; ?>>
                                                                        <label class="form-check-label" for="<?= $alarm['name'] ?>"><?= $alarm['description'] ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        endforeach;
                                                endif;
                                                ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="button" data-action="save" class="nsm-button primary" id="btn_save_headers">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#btn_save_headers").on("click", function() {
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>customer/save_customer_headers",
                dataType: "json",
                data: $("#customer_headers_form").serialize(),
                success: function(result) {
                    Swal.fire({
                    title: 'Update Successful!',
                    text: "Header Settings was successfully updated.",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#32243d',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    /*if(is_reload === 1){
                        if (result.value) {
                            window.location.reload();
                        }
                    }*/
                });
                },error: function() {
                             //Your Error Message   
                     console.log("error received from server");
                }
            });
        });
        function sweetAlert(title,icon,information,is_reload){
            Swal.fire({
                title: title,
                text: information,
                icon: icon,
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if(is_reload === 1){
                    if (result.value) {
                        window.location.reload();
                    }
                }
            });
        }
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>