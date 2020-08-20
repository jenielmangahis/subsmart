<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_wizard'); ?>
<link rel="stylesheet" href="https://twitter.github.io/typeahead.js/css/examples.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $url->assets ?>wizard/listing/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url->assets ?>wizard/listing/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $url->assets ?>wizard/listing/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $url->assets ?>wizard/listing/css/responsive.css" />
<style type="text/css">
.tt-suggestion
{
	margin: 0 !important;
}
.wizard-app-block .form-group {
    margin: 0 250px 30px !important;
}
.wizard-app-block .form-group {
    margin: 0 250px 30px !important;
}
.app-img {
    margin: 0 -14px !important;
}
.app-listing-box ul li {
    width: 17% !important;
}
</style>
<div class="row">
	<div class="col-md-2">
		<div class="wrapper" role="wrapper">
			<?php include viewPath('includes/sidebars/upgrades'); ?>
		</div>
	</div>
	<div class="col-md-10">
		<!-- Wizard -->
		<section class="form-wraper " style="margin-top:105px">
        <div class="container-fluid">
            <div class="form-titlebar">
                <h1>Work Space</h1>
                <a href="#" data-toggle="modal" data-target="#updateSignature_add"  data-backdrop="static" class="btn-add"><i class="fa fa-plus"></i> Create New Wizard</a>
            </div>

            <div class="table-block">
                <table class="table table-bordered table-hover dt-responsive">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th style="width:5%">Modified</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($wizards_workspace as $key => $value)  { ?>
                            <tr>
                                <td><?php echo $value->name ; ?>
                                    <div class="quick-act">
                                        <ul>
                                            <li><a href="#" onClick='clickOnEdit("<?php echo $value->id ; ?>","<?php echo $value->name ; ?>")'><i class="fa fa-pencil"></i> Edit</a></li>
                                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                                            <li><a href="<?php echo base_url('wizard/delete_listing_wizard/'.$value->id); ?>"><i class="fa fa-trash-o"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td style="width:5%"><?php echo date("m/d/Y", strtotime($value->created_at)) ; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <center>
                    <a href="<?php echo base_url('wizard'); ?>">Click to show Wizard</a>
                </center>
            </div>
        </div>
    </section>
		<!-- End Wizard -->
	</div>
</div>

<div id="updateSignature_add" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <?php echo form_open_multipart('wizard/save_listing_wizard', [ 'id' => 'filevaultform', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Workspace</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 form-group">
						<label for="name">Name</label>
                        <input type="hidden" class="form-control" name="id" id="id" required/>
						<!-- <input type="text" class="form-control" name="name" id="name" required placeholder="Enter Name" autofocus value="" /> -->
                        <input class="form-control" type="text" name="name" list="exampleList">
                        <datalist id="exampleList">
                            <option value="Credit Repair Industry Template">  
                            <option value="Real Estate Industry Flow Templates">

                            <option value="Construction Industry Flow Templates">
                            <option value="Universal Flow Templates">
                            <option value="Financial Industry Flow Templates">
                            <option value="Security Alarm Industry Flow Templates">
                            <option value="Residential Flow Templates">
                            <option value="Commercial Flow Templates">
                        </datalist>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <!--  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div> -->
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
<?php include viewPath('includes/footer_wizard'); ?>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
 <script src="https://twitter.github.io/typeahead.js/js/handlebars.js"></script>
 <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
 
<script>

</script>

<!-- <script type="text/javascript" src="<?php echo $url->assets ?>wizard/listing/js/jquery.min.js"></script>  -->
<script type="text/javascript" src="<?php echo $url->assets ?>wizard/listing/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>
<script type="text/javascript">
$('table').DataTable();


    function clickOnEdit(id,name) {
        $('#updateSignature_add input[name="id"]').val(id);
        $('#updateSignature_add input[name="name"]').val(name);
        $('#updateSignature_add').modal('show');
    }
</script>
<style>
    #DataTables_Table_0_wrapper .row {
        width:100%;
    }

</style>
