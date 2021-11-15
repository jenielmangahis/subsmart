<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/job/job_settings_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
    <ul class="nsm-fab-options">
        <li data-bs-toggle="modal" data-bs-target="#new_tax_rate_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-receipt"></i>
            </div>
            <span class="nsm-fab-label">Add Tax Rate</span>
        </li>
        <li data-bs-toggle="modal" data-bs-target="#job_settings_modal">
            <div class="nsm-fab-icon">
                <i class="bx bx-cog"></i>
            </div>
            <span class="nsm-fab-label">Job Settings</span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/job_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#new_tax_rate_modal">
                                <i class='bx bx-fw bx-receipt'></i> Tax Rate
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#job_settings_modal">
                                <i class='bx bx-fw bx-cog'></i>
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Tax Rate Name">Tax Rate Name</td>
                            <td data-name="Percent">Percent</td>
                            <td data-name="Date Created">Date Created</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($tax_rates)) :
                        ?>
                            <?php
                            foreach ($tax_rates as $rate) :
                            ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?= $rate->name; ?></td>
                                    <td><?= $rate->rate; ?> %</td>
                                    <td><?= date("m-d-Y h:i A",strtotime($rate->date_created)); ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?= $rate->id; ?>">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="5">
                                    <div class="nsm-empty">
                                        <span>You haven't yet added Job Rates yet.</span>
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



<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();

        $(document).on("click", ".delete-item", function( event ) {
            var ID = $(this).attr("data-id");

            Swal.fire({
                title: 'Are you sure to remove this tax rate?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('/job/delete_tax_rate') ?>", 
                        data: {id : ID}, // serializes the form's elements.
                        success: function(data)
                        {
                            if(data === "1"){
                                //window.location.reload();
                                sucess_add('Nice!','Removed Successfully!','taxRate');
                            }else{
                                alert(data);
                            }
                        }
                    });
                }
            });
        });

        $("#form_add_tax").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "<?= base_url('/job/add_tax_rate') ?>",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "1"){
                        sucess_add('Awesome!','Successfully Added!','taxRate');
                        //window.location.reload();
                    }else {
                        console.log(data);
                    }
                }
            });
        });
    });

    function sucess_add($title,information,is_reload){
        Swal.fire({
            title: $title,
            text: information,
            icon: 'success',
            showCancelButton: false,
            confirmButtonText: 'Ok'
        }).then((result) => {
            if(is_reload === 1){
                if (result.value) {
                    window.location.reload();
                }
            }else{
                window.location.href='<?= base_url(); ?>job/settings/'+is_reload;
            }
        });
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>