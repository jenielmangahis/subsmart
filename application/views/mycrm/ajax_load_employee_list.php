<div class="modal-employee-list-message"></div>
<div class="row">
    <div class="col-md-12" style="margin-bottom:50px;">You have <b><span class="modal-total-employees"><?= $total_users; ?></span></b> active employee - manage your organization employees.</div>
</div>
<?php $count = 1; foreach($users as $u){ ?>
    <div class="row margin-bottom-sec">
        <div class="col-md-5"><?= $count; ?>. <?= $u->FName . ' ' . $u->LName; ?></div>
        <div class="col-md-5"><?= $u->email; ?></div>
        <div class="col-md-2 text-right">
            <a class="btn btn-primary btn-sm btn-delete-employee" data-id="<?= $u->id; ?>" href="javascript:void(0);"><i class="fa fa-trash"></i></a>
        </div>
    </div>
<?php $count++;} ?>
