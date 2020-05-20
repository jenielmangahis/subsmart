<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper">
   <div class="container-fluid">
      <div class="page-title-box">
         <div class="row align-items-center">
            <div class="col-sm-6">
               <h1 class="page-title">Files</h1>
               <ol class="breadcrumb">
                  <li class="breadcrumb-item active">Manage Files&emsp;<?php echo $path; ?></li>
               </ol>
            </div>
            <div class="col-sm-6">
               <div class="float-right d-none d-md-block">
                  <div class="dropdown">
                     <?php //if (hasPermissions('users_add')): ?>
                     <a href="<?php echo url('vault/add') ?>" class="btn btn-primary" aria-expanded="false">
                     <i class="mdi mdi-settings mr-2"></i> Add New Files
                     </a> 
					 
                     <?php //endif ?>
                  </div>
               </div>
               <div class="float-right d-none d-md-block" style="margin-right: 10px">
                  <div class="dropdown">
                     <?php //if (hasPermissions('users_add')): ?>
                     <button type="button" class="btn btn-primary" id="btn-folder-manager">
                     <i class="mdi mdi-settings mr-2"></i> Select Folder
                     </button> 
                
                     <?php //endif ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
                    
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <table id="dataTable1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>File</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($files as $row): ?>
                     <tr>
                        <td width="60"><?php echo $row->id ?></td>
                        <td>
                           <?php echo $row->title ?>
                        </td>
                        <td>
                           <a href="<?php echo url('uploads/files/'.$row->fullfile); ?>" download><?php echo $row->fullfile ?></a>
                        </td>
                        <td>
                           <?php //if (hasPermissions('permissions_edit')): ?>
                           <a href="<?php echo url('vault/edit/'.$row->id) ?>" class="btn btn-sm btn-default" title="Edit File" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                           <?php //endif ?>
                           <?php //if (hasPermissions('permissions_delete')): ?>
                           <a href="<?php echo url('vault/delete/'.$row->id) ?>" class="btn btn-sm btn-default" onclick='return confirm("Do you really want to delete this File ? \nIt may cause errors where it is currently being used !!")' title="Delete File" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                           <?php //endif ?>
                        </td>
                     </tr>
                     <?php endforeach ?>
                  </tbody>
               </table>
               </div>
            </div>
            <!-- end card -->
         </div>
      </div>
      <!-- end row -->           
   </div>
   <!-- end container-fluid -->
</div>
<div><input type="hidden" id="current_selected_folder_id" value=<?php echo $folder_id; ?>></div>
<!-- page wrapper end -->

<?php echo $folder_manager; ?>
<?php include viewPath('includes/footer'); ?>
<script>
   $(document).ready( function () {
        $('#dataTable1').DataTable();

        $('#btn-select-folder-manager').click(function(){
            if(!jQuery.isEmptyObject(selected_folder)){
               window.location.href = base_url + 'vault/' + selected_folder.id;
            } else {
               window.location.href = base_url + 'vault';   
            }
         });
    } );
</script>