<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>

<style>
.cell-active{
    background-color: #5bc0de;
}
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.cell-inactive{
    background-color: #d9534f;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
.p-20 {
  padding-top: 30px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
.card-help {
    padding-left: 45px;
    padding-top: 10px;
}
.text-ter {
    color: #888888;
}
.card-type.visa {
    background-position: 0 0;
}
.card-type {
    display: inline-block;
    width: 30px;
    height: 20px;
    background: url(<?= base_url("/assets/img/credit_cards.png"); ?>) no-repeat 0 0;
    background-size: cover;
    vertical-align: middle;
    margin-right: 10px;
}
.card-type.americanexpress {
    background-position: -83px 0;
}
.expired{
  color:red;
}
.card-type.discover {
    background-position: -125px 0;
}
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/job_tabs_v2'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/job_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Create great check list for employees or subcontractor to follow a series of item listings to meet all of your company’s requirements, expectations or reminders. This can be attached to estimate, workorder, invoices. A powerful addition to your forms.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>
                    <div class="col-12 grid-mb text-end">
                        <?php if(checkRoleCanAccessModule('job-settings', 'write')){ ?>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('job_checklists/add_new');?>'">
                                <i class='bx bx-fw bx-plus'></i> Add New
                            </button>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-3">
                        <table class="nsm-table">
                            <thead>
                                <tr>
                                    <td data-name="Name">Name</td>
                                    <td style="width: 10%;" data-name="Created">Date Created</td>
                                    <td style="width: 3%;" data-name="Manage"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($jobChecklists as $j){ ?>
                                <tr>
                                    <td class="fw-bold nsm-text-primary"><?= $j->checklist_name; ?></td>
                                    <td><?= date("m/d/Y H:i:s", strtotime($j->date_created)); ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <?php if(checkRoleCanAccessModule('job-settings', 'write')){ ?>
                                                <li>
                                                    <a class="dropdown-item edit-item" href="<?php echo base_url('job_checklists/edit_checklist/' . $j->id) ?>">Edit</a>
                                                </li>
                                                <?php } ?>
                                                <?php if(checkRoleCanAccessModule('job-settings', 'delete')){ ?>
                                                <li>
                                                    <a class="dropdown-item delete-item delete-job-checklist" href="javascript:void(0);" data-id="<?= $j->id; ?>" data-name="<?= $j->checklist_name; ?>">Delete</a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function(){
    $(".nsm-table").nsmPagination();
    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));        
    }, 1000));

    $(document).on("click", ".delete-job-checklist", function() {
        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');

        Swal.fire({
            title: 'Delete Checklist',
            html: `Are you sure you want to delete this system package type <b>${name}</b>?`,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + "job_checklists/_delete_checklist",
                    data: {id: id},
                    dataType:"json",
                    success: function(result) {
                        if (result.is_success) {
                            Swal.fire({
                                title: 'Checklist',
                                text: "Data deleted successfully!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                //if (result.value) {
                                    location.reload();
                                //}
                            });
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: result.msg
                            });
                        }
                    },
                });
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>

