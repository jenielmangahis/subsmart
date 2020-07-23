<?php
   defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
   <?php include viewPath('includes/sidebars/upgrades'); ?>
   <div wrapper__section>
      <div class="container-fluid">
         <div class="page-title-box">
            <div class="row align-items-center">
               <div class="col-sm-6">
                  <h1 class="page-title">Wizard</h1>
                  <ol class="breadcrumb">
                     <!-- <li class="breadcrumb-item active">Manage Files</li> -->
                  </ol>
               </div>
               <div class="col-sm-12">
               <div class="row d-none d-lg-flex">
				<div class="col-md-12">
					<div class="card" style="background:#eaeaea">
						<div class="card-body">
							<h4 class="mt-0 header-title mb-1">Credit Wizard <small>Copy Billpad</small></h4>
                     <p class="mb-4">This is an ideal stating point for every client. You can accomplish all 3 very quiuckly.</p>

                     <?php foreach($wizards as $key => $value) { ?>
                        <div class="qUickStart">
                           <span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;"><?php echo $key+1;  ?></span>
                           <div class="qUickStartde">
                              <h4><a href="#"><?php echo $value->title;  ?></a></h4>
                              <span><?php echo $value->description;  ?></span>
							  
                           </div>
						   <a class=""   data-toggle="modal" data-target="#updateSignature_<?php echo $value->id; ?>" data-target="#createFolder" data-backdrop="static" data-keyboard="false" style="padding: 8px; font-size: 21px;"><i class="fa fa-pencil"></i></a>
                        </div>

						<div class="modal fade" id="updateSignature_<?php echo $value->id; ?>" role="dialog">
							<div class="close-modal" data-dismiss="modal">&times;</div>
							<div class="modal-dialog">
								<?php echo form_open_multipart('wizard/save/'.$value->id, [ 'id' => 'filevaultform', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Update Wizard </h4>
										</div>
										<div class="modal-body">
											<div class="col-md-12 form-group">
												<label for="title">Name</label>
												<input type="text" class="form-control" name="title" id="title" required placeholder="Enter Name" autofocus value="<?php echo $value->title; ?>" />
											</div>
											<div class="col-md-12 form-group">
												<label for="description">Description<small></small></label>
												<textarea class="form-control" name="description" id="description" required placeholder="Upload File"><?php echo $value->description; ?></textarea>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											<button type="submit" id="click" class="btn btn-primary save-signature">Update</button>
										</div>
									</div>
								<?php echo form_close(); ?>
							</div>
						</div>
                     <?php } ?>

					<center>
						<a href="#" data-toggle="modal" data-target="#updateSignature_add" data-target="#createFolder" data-backdrop="static" data-keyboard="false" style="padding: 8px; font-size: 21px;"><i class="fa fa-plus"></i> Create a letter for a client ( with no dispute items )</a>
					</center>

                     <br><br>
                     <div style="background:white;border-radius:5px;padding:15px;">
                     Tip : standard or Free Annual Reports Credit DO NOT include "scores" Credit "scores" must be purchased directly from the credit bureaus or services. We also provide links for purchasing credit scores on this web page. Please do not contact on about your credit credit reports. We have no affliation with the credit bureaus and we cannot give legal advice about your personal credit.
                     </div>
						</div>
					</div>
				</div>
                </div>
            </div>
               </div>
            </div>
         </div>
         <style>
				.qUickStart{
					background: #fcfcfc;
					background: -moz-linear-gradient(top,  #fcfcfc 0%, #eaeaea 100%);
					background: -webkit-linear-gradient(top,  #fcfcfc 0%,#eaeaea 100%);
					background: linear-gradient(to bottom,  #fcfcfc 0%,#eaeaea 100%);
					filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfcfc', endColorstr='#eaeaea',GradientType=0 );
					display: flex;
					align-items: center;
					padding: 16px;
					border-radius: 4px;
					border: 1px solid #ddd;
					margin-bottom:15px;
					
				}
				.qUickStart:last-child{
					margin-bottom:0px;
				}
				.qUickStart .icon{
					background:#2d1a3e !important;
					flex: 0 0 70px;
					height: 70px;
					border-radius: 100%;
					display: inline-flex;
					align-items: center;
					justify-content: center;
					font-size: 25px;
					color:#fff;
					margin-right: 10px;
				}
				.qUickStart .qUickStartde h4{
					font-size: 16px;
					
					text-transform: uppercase;
					font-weight: 700;
					margin: 0;
					margin-bottom: 0px;
					margin-bottom: 6px;
				}
				.qUickStart .qUickStartde span{
					opacity: 0.6;
				}
				.qUickStart .qUickStartde {
					width:92% !important;
				}
			</style>          
      
         <!-- end row -->           
      </div>
   </div>
   <!-- end container-fluid -->
</div>

<div class="modal fade" id="updateSignature_add" role="dialog">
	<div class="close-modal" data-dismiss="modal">&times;</div>
	<div class="modal-dialog">
		<?php echo form_open_multipart('wizard/save/0', [ 'id' => 'filevaultform', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add Wizard </h4>
				</div>
				<div class="modal-body">
					<div class="col-md-12 form-group">
						<label for="title">Name</label>
						<input type="text" class="form-control" name="title" id="title" required placeholder="Enter Name" autofocus value="" />
					</div>
					<div class="col-md-12 form-group">
						<label for="description">Description<small></small></label>
						<textarea class="form-control" name="description" id="description" required placeholder="Upload File"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" id="click" class="btn btn-primary save-signature">Update</button>
				</div>
			</div>
		<?php echo form_close(); ?>
	</div>
</div>

<!-- page wrapper end -->

<?php include viewPath('includes/footer'); ?>
<script>
   $(document).ready( function () {

    } );
</script>
<script type="text/javascript">

</script>