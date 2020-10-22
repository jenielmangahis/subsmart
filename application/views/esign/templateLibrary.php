<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); 
ini_set('max_input_vars', 30000);
?>
<!-- page wrapper start -->
 <style>
	#signature{
		width: 100%;
		height: auto;
		border: 1px solid black;
	}
</style>
<div class="wrapper" role="wrapper">
		<?php  /* include viewPath('includes/sidebars/signature'); */ ?>
		<?php /* include viewPath('includes/notifications'); */ ?>
		<div >
		<!-- wrapper__section -->
			<?php /* include viewPath('includes/notifications'); */?>
			<div class="card">
				<div class="container-fluid">
                        <!-- Main Selection -->
            <div class="row mb-5">
                <a href="<?=base_url('esign/createTemplate')?>" class="btn btn-info">Add New Letter</a>            
            </div>
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>Favorite</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($templates AS $template){?>
                        <tr>
                            <td><a href="<?=base_url('esign/editTemplate?id='.$template['esignLibraryTemplateId'])?>"><?=$template['title']?></a></td>
                            <td><?=$template['isActive'] ? "Active" : "InActive"?></td>
                            <td><?=$template['categoryName']?></td>
                            <td>
                                <a href="#" class="changeFavorite">
                                    <i id="<?=$template['esignLibraryTemplateId']?>" class="fa fa-star <?=$template['isFavorite'] ? 'favorite' : 'notFavorite'?> "></i>
                                </a>
                            </td>
                            <td>
                                <a href="<?=base_url('esign/editTemplate?id='.$template['esignLibraryTemplateId'])?>"><i class="fa fa-edit"></i></a>
                                <a class="trashColor" href="#"><i id="deleteId-<?=$template['esignLibraryTemplateId']?>" class="fa fa-trash"></i></a>
                                <!-- <a><i class="fa fa-eye"></i></a> -->
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
                </div>
			</div>
		</div>
		<!-- end container-fluid -->
</div>

<!-- Signature MODAL -->
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>

<script>
        $(document).ready(function() {
            let table = $('#myTable').DataTable({
                columnDefs: [
                  { orderable: false, targets: -1 },
                  { orderable: false, targets: -2 }
                ]
            });
            $('.changeFavorite').click(function(){
                let clickedObj = $(this).children();
                let templateId = clickedObj.attr('id');
                if(!clickedObj.hasClass("appling")){
                    clickedObj.addClass("appling");
                    if(clickedObj.hasClass("favorite")){
                        clickedObj.toggleClass('favorite notFavorite');
                        updateFavorite(clickedObj, templateId, 0)
                    }else{
                        // console.log("we are adding favorite : ",clickedObj.attr('id'));
                        clickedObj.toggleClass('notFavorite favorite');
                        updateFavorite(clickedObj, templateId, 1)
                    }
                }
            })
            function updateFavorite(clickedObj, templateId, isFavorite){
                $.get("changeFavoriteStatus/"+templateId+"/"+isFavorite, function(data, status){
                    try {
                        data = JSON.parse(data);
                        if(status != "success" || !data.status){
                            throw "errr";
                        }
                        clickedObj.removeClass("appling");
                    } catch (error) {
                        alert('Something Went Wrong Please Try Again');
                        location.reload();
                    }
                });
            }

            // $('#myTable tbody').on( 'click', 'i.fa-eye', function () {
               
            // });
            $('#myTable tbody').on( 'click', 'i.fa-trash', function () {
               table
                .row( $(this).parents('tr') )
                .remove()
                .draw();
                let id= $(this).prop('id').split('-')[1] || 0;
                deleteLibrary(id);
            });
            function deleteLibrary(templateId){
                $.get("deleteLibrary/"+templateId, function(data, status){
                    try {
                        data = JSON.parse(data);
                        if(status != "success" || !data.status){
                            throw "errr";
                        }
                    } catch (error) {
                        alert('Something Went Wrong Please Try Again');
                        location.reload();
                    }
                });
            }
        });

    </script>

