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
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-12 grid-mb text-end">
          <div class="nsm-page-buttons page-button-container">
              <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('job_checklists/add_new');?>'">
                  <i class='bx bx-fw bx-briefcase'></i> Add New
              </button>
          </div>
      </div>
  </div>
  <div class="row">
  <?php include viewPath('flash'); ?>
    <table class="nsm-table" data-id="coupons">
        <thead>
            <tr>
                <th style="width: 40%;">Name</th>
                <th style="width: 10%;"></th>
            </tr>
        </thead>
        <tbody>
          <?php foreach($jobChecklists as $j){ ?>
            <tr>
                <td><?= $j->checklist_name; ?></td>
                <td class="text-right">
                  <div class="dropdown">
                      <button type="button" id="dropdown-edit" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                          <span class="btn-label">Manage</span><span class="caret-holder"><i class='bx bx-caret-down'></i></span>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end select-filter">
                          <li role="presentation">
                            <a role="menuitem" class="dropdown-item" tabindex="-1" href="<?php echo base_url('job_checklists/edit_checklist/' . $j->id) ?>">
                            <i class='bx bx-edit'></i></span> Edit
                            </a>
                          </li>
                          <li role="presentation">
                              <a role="menuitem" class="dropdown-item delete-job-checklist" href="javascript:void(0);" data-id="<?= $j->id; ?>"><i class='bx bx-trash' ></i> Delete</a>
                          </li>
                      </ul>
                  </div>
              </td>
            </tr>
          <?php } ?>
        </tbody>
    </table>
  </div>
</div>

<?php include viewPath('v2/pages/job_checklists/modals/delete_checklist_modal') ?>

<script type="text/javascript">
$(function(){
    $(".delete-job-checklist").click(function(){

      var cid = $(this).attr('data-id');
      $("#cid").val(cid);
      $("#modalDeleteChecklist").modal('show');
    });
});
function confirm(){
      Swal.fire({
          title: 'Confirm',
          text: 'Your changes have not been saved. Are you sure you want to go back?',
          icon: 'warning',
          showCancelButton: true,
          showDenyButton: true,
          showConfirmButton: false,
          confirmButtonColor: '#32243d',
          confirmButtonText: 'Save',
          denyButtonText: 'Go back without saving'
      }).then((result) => {
          if (result.isConfirmed) {
              console.log('sure');
          } else if (result.isDenied) {
              location.href= '<?= base_url('plans'); ?>';
          }
      });
  }

</script>
<?php include viewPath('v2/includes/footer'); ?>

