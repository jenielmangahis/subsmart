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
    label>input {
      visibility: initial !important;
      position: initial !important; 
    }
</style>
<div class="wrapper library" role="wrapper">
		<div>
		<!-- wrapper__section -->
			<div class="card">
				<div class="container">
                        <!-- Main Selection -->

                <h1 class="library__title">Library</h1>
                <div class="alert alert-warning mt-2" role="alert">
                    <span style="color:black;">
                        Library is used to interact with the with our eSign Tools.  These ready made templates include placeholders for quick delivery.  Choose from these various industry types of letters and save time.
                    </span>
                </div>

            <div class="row mb-5 library__row">
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
            <table id="esign-table" class="display">
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

        function redirectOnDoubleClickToTitle(event){
            window.open($(event).attr("redirectUrl"), "_self")
        }

        $(document).ready(function() {
            var selected = "0";

            $( ".librarySelect" ).change(function() {
                selected = $('.librarySelect').find(":selected").val();
                reloadDataTable();
            });

            let table = $('#esign-table').DataTable({
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
             
 
            $('#esign-table tbody').on( 'click', 'i.fa-trash', function () {
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

