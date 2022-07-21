<style>
.image-data {
    display: flex;
    flex-direction: column;
    align-items: center;
}
.image-data img {
    --size: 120px;
    width: var(--size);
    height: var(--size);
    object-fit: cover;
}
</style>
<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header');

echo put_header_assets();
include viewPath('includes/v2/notifications');
?>

<div class="row page-content g-0">
    <div class="nsm-page-nav mb-3">
        <ul>
            <li>
                <a class="nsm-page-link" href="<?php echo base_url('vault_v2/mylibrary') ?>">
                    <span>My Library</span>
                </a>
            </li>
            <li>
                <a class="nsm-page-link" href="<?php echo base_url('vault_v2') ?>">

                    <span>Shared Library</span>
                </a>
            </li>
            <li>
                <a class="nsm-page-link" href="<?php echo base_url('vault_v2/businessformtemplates') ?>">

                    <span>Business Form Templates</span>
                </a>
            </li>
            <li  class="active">
                <a class="nsm-page-link" href="<?php echo base_url('vault_v2/beforeafter') ?>">

                    <span>Photos Gallery</span>
                </a>
            </li>

            <!-- Do not remove the last li -->
            <li><label></label></li>
        </ul>
    </div>

    <div>
        <div class="nsm-callout primary">
            <button><i class="bx bx-x"></i></button>
            One of the best way for prospect to process information is with visual data.  Before and after photos serve as proof that the product (or service) works.  Start sharing your success photos to others to grow your business.
        </div>

        <div class="d-flex justify-content-end">
            <a class="nsm-button primary m-0" id="newJobBtn" href="<?php echo url('Before_after_v2/addPhoto') ?>">
                <span class="fa fa-plus"></span> Add Photos
            </a>
        </div>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                <?php if (!empty($photos)) {?>
                <table class="nsm-table dataTable no-footer" style="width:100%;" id="beforeAfterListTable">
                    <thead>
                        <tr>
                            <th scope="col"><strong>Pic</strong></th>
                            <th scope="col"><strong>Date Added</strong></th>
                            <th scope="col"><strong>Customer</strong></th>
                            <th scope="col"><strong></strong></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $group = array();?>
                        <?php foreach ($photos as $photo): ?>
                        <?php array_push($group, $photo->group_number);?>
                        <tr>
                            <td>
                                <div class="d-flex" style="gap: 1rem;">
                                    <div class="image-data">
                                        <img src="<?=base_url() . "uploads/beforeandafter/" . $photo->before_image;?>">
                                        <strong>Before</strong>
                                    </div>
                                    <div class="image-data">
                                        <img src="<?=base_url() . "uploads/beforeandafter/" . $photo->after_image;?>">
                                        <strong>After</strong>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo date_format(date_create($photo->created_at), "d-M-Y H:m"); ?></td>
                            <td><?php echo $photo->first_name . ' ' . $photo->last_name; ?></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item"  href="<?=base_url('Before_after_v2/edit/' . $photo->id);?>">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item btn-delete-photo" data-id="<?=$photo->id;?>" href="#">Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
                <?php } else {?>
                    <div class="page-empty-container" style="text-align:center; margin-top:50px;">
                        <h5 class="page-empty-header">You haven't uploaded any photos.</h5>
                        <p class="text-ter margin-bottom">Upload and manage Before and After photos and send them to your customers.</p>
                    </div>
                <?php }?>
            </div>


        </div>
    </div>

    <div class="modal fade nsm-modal" id="modalDeleteImage" tabindex="-1" role="dialog" aria-labelledby="modalDeleteImageTitle" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Image</h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <?php echo form_open_multipart('Before_after_v2/delete_image', ['class' => 'form-validate m-0', 'autocomplete' => 'off']); ?>
                <?php echo form_input(array('name' => 'bai', 'type' => 'hidden', 'value' => '', 'id' => 'bai')); ?>
                    <div class="modal-body">
                        <p>Delete selected before and after image?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="nsm-button primary">Yes, delete image</button>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer');?>
<script>
$(function(){
    $(document).on('click', '.btn-delete-photo', function(){
        var bai = $(this).attr('data-id');
        $('#bai').val(bai);
        $('#modalDeleteImage').modal('show');
    });
});
</script>
