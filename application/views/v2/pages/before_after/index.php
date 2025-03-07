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
.filter-customer{
    width:50%;
}
.filter-customer select{
    display:inline-block;
}
#before-after-filter{
    display:inline-block;
    width:10%;
}
#myTabContent .select2-container {
    width:40% !important;
    line-height:32px;
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
        <?php include viewPath('v2/includes/page_navigations/files_vault_tab'); ?>
    </div>
    <div>
        <div class="nsm-callout primary">
            <button><i class="bx bx-x"></i></button>
            One of the best way for prospect to process information is with visual data.  Before and after photos serve as proof that the product (or service) works.  Start sharing your success photos to others to grow your business.
        </div>

        <div class="d-flex justify-content-end">
            <a class="nsm-button primary m-0" id="newJobBtn" href="<?php echo url('before_after_photos/add_photos') ?>">
                <span class="fa fa-plus"></span> Add Photos
            </a>
        </div>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                <?php if (!empty($photos)) {?>
                
                <div class="mb-2 mt-2 filter-customer">
                    <select id="sel-customer" name="customer_id" class="form-control searchable-dropdown" style="width:40% !important;"></select>                    
                </div>

                <table id="before-after-photos" class="nsm-table mb-3">
                    <thead>
                        <tr>                            
                            <th class="table-icon"></th>                                               
                            <td data-name="Customer" style="width: 70%;">Customer Name</td>
                            <td data-name="BeforePhoto" style="width:8%;">Before</td>
                            <td data-name="AfterPhoto" style="width:8%;">After</td>
                            <td data-name="Customer">Date Created</td>
                            <td data-name="action" style="width: 0%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $group = array();?>
                        <?php foreach ($photos as $photo): ?>
                        <?php array_push($group, $photo->group_number);?>
                        <tr>                   
                            <td>
                                <?php 
                                    $n = ucwords($photo->first_name[0]).ucwords($photo->last_name[0]);
                                    echo "<div class='nsm-profile'><span>".$n.'</span></div>';
                                ?>
                            </td>
                            <td>
                                <?php 
                                    $customer_email = 'Email Not Specified';
                                    if( $photo->email != '' ){
                                        $customer_email = $photo->email;
                                    }
                                    $customer_name = $photo->first_name . ' ' . $photo->last_name;  
                                ?>
                                <label class="nsm-link default d-block fw-bold"><?= $customer_name; ?></label>
                                <label class="nsm-link default content-subtitle fst-italic d-block"><i class="bx bx-envelope"></i> <?= $customer_email; ?></label>
                            </td>
                            <td>
                                <a data-caption="<?= $photo->note ?>" data-fancybox data-src="<?= base_url("uploads/beforeandafter/" . $cid . "/" . $photo->before_image); ?>" href="javascript:void(0);">
                                <div class="d-flex" style="gap: 1rem;">
                                    <div class="image-data">
                                        <img src="<?= base_url("uploads/beforeandafter/" . $cid . "/" . $photo->before_image); ?>">                                        
                                    </div>
                                </div>
                                </a>
                            </td>
                            <td>
                                <a data-caption="<?= $photo->note ?>" data-fancybox data-src="<?= base_url("uploads/beforeandafter/" . $cid . "/" . $photo->after_image);?>" href="javascript:void(0);">
                                <div class="d-flex" style="gap: 1rem;">
                                    <div class="image-data">
                                        <img src="<?= base_url("uploads/beforeandafter/" . $cid . "/" . $photo->after_image);?>">
                                    </div>
                                </div>
                                </a>
                            </td>         
                            <td><?php echo date_format(date_create($photo->created_at), "m/d/Y H:i:s"); ?></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item"  href="<?=base_url('before_after_photos/edit/' . $photo->id);?>">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item btn-delete-photo" data-id="<?=$photo->id;?>" href="javascript:void(0);">Delete</a>
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
    $("#before-after-photos").nsmPagination({itemsPerPage:5});

    $('#sel-customer').select2({
        width: 'resolve',
        ajax: {
            url: '<?= base_url('autocomplete/_company_customer') ?>',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                q: params.term, // search term
                page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;

                return {
                results: data
                // pagination: {
                //   more: (params.page * 30) < data.total_count
                // }
                };
            },
            cache: true
            },
            placeholder: "Filter Customer",
            minimumInputLength: 0,
            templateResult: formatRepoCustomer,
            templateSelection: formatRepoCustomerSelection
    });

    function formatRepoCustomerSelection(repo) {
        if( repo.first_name != null ){
            return repo.first_name + ' ' + repo.last_name;      
        }else{
            return repo.text;
        }
    }

    function formatRepoCustomer(repo) {
        if (repo.loading) {
        return repo.text;
        }

        var $container = $(
        '<div>'+repo.first_name + ' ' + repo.last_name +'<br><small>'+repo.phone_m+' / '+repo.email+'</small></div>'
        );

        return $container;
    }

    $(document).on('click', '.btn-delete-photo', function(){
        var bai = $(this).attr('data-id');
        
        Swal.fire({
            title: 'Delete Photos',
            html: 'Are you sure you want to delete selected data?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url + "before_after_photos/_delete_photos",
                    data: {bai: bai},
                    dataType: 'json', 
                    success: function(data) {
                        if(data.is_success == 1) {
                            Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Photos deleted successfully!',
                            }).then((result) => {
                                window.location.reload();
                            });
                        } else {
                           Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                            });
                        }
                    }
                });
            }
        });

    });
});
</script>
