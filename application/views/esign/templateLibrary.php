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
    .favorite {
        color : yellow;
    }
    .notFavorite {
        color : black;
    }
</style>
<div class="wrapper" role="wrapper">
		<div>
		<!-- wrapper__section -->
			<div class="card">
				<div class="container-fluid">
                        <!-- Main Selection -->
            <div class="row mb-5">
                <a href="<?=base_url('esign/createTemplate')?>" class="btn btn-info">Add New Letter</a>            
                <div style="display: flex;">
                    <select class="librarySelect" name="" id="">
                        <option value="0">All</option>
                        <?php
                            foreach($libraries as $library){
                        ?>
                            <option value="<?=$library['pk_esignLibraryMaster']?>"><?=$library['libraryName']?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
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
        function changeFavorite(event){
            console.log('Bar Function callled');
            let clickedObj = $(event).children();
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
        }
        
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

        $(document).ready(function() {
            var selected = "0";

            $( ".librarySelect" ).change(function() {
                selected = $('.librarySelect').find(":selected").val();
                reloadDataTable();
            });

            let table = $('#myTable').DataTable({
                columnDefs: [
                  { orderable: false, targets: -1 },
                  { orderable: false, targets: -2 }
                ],
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url('esign/dtGetLibrary'); ?>?libraryId="+selected,
                    "type": "POST"
                }
            });
             
 
            $('#myTable tbody').on( 'click', 'i.fa-trash', function () {
                console.log('Delete');   
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
                        reloadDataTable()
                    } catch (error) {
                        alert('Something Went Wrong Please Try Again');
                        location.reload();
                    }
                });
            }
            function reloadDataTable(){
                table.ajax.url( "<?php echo base_url('esign/dtGetLibrary'); ?>/"+selected);
                table.ajax.reload();
            }
        });

    </script>

