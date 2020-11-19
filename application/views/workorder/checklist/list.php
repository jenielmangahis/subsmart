<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/workorder'); ?>
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="card"> 
            <div class="container-fluid" style="font-size:14px;">
                <div class="row">
                    <div class="col">
                        <h1 class="m-0">Checklists</h1>
                    </div>
                    <div class="col-auto">
                        <div class="h1-spacer">
                            <a class="btn btn-primary btn-md" href="<?php echo base_url('/workorder/add_checklist') ?>">
                                <span class="fa fa-plus"></span> &nbsp; Add Checklist
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">

                        <?php if (!empty($checklists)) { ?>
                            <table class="table table-hover table-to-list" data-id="work_orders">
                                <thead>
                                <tr>
                                    <th>Checklist Name</th>
                                    <th style="width: 10%;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($checklists as $ch) { ?>
                                    <tr>
                                        <td><?= $ch->checklist_name; ?></td>
                                        <td>
                                            <?php $eid = hashids_encrypt($ch->id, '', 15); ?>
                                            <a class="btn btn-info btn-sm" href="<?php echo base_url('/workorder/edit_checklist/' . $ch->id); ?>"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger btn-sm" href="<?php echo base_url('/workorder/edit_checklist/' . $ch->id); ?>"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>

                            </table>
                        <?php } else { ?>
                            <div class="page-empty-container">
                                <h5 class="page-empty-header">You haven't yet added your checklist</h5>
                                <p class="text-ter margin-bottom">Manage your checklist.</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page wrapper end -->
    <?php include viewPath('includes/footer'); ?>
</div>