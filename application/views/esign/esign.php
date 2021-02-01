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
				<div class="container-fluid" style="font-size:14px;">

						<div class="row">
								<div class="col">
										<h1 class="m-0">Signature</h1>
										<p>This is your signature, update any time.</p>
								</div>
								<div class="col-auto">
										<!-- <div class="h1-spacer">
												<a class="btn btn-primary btn-md" href="#">
														<span class="fa fa-plus"></span> New Signature
												</a>
										</div> -->
								</div>
						</div> 
						<div class="row">
							<div class="col-md-12">
								<div class="signature-holder">
									<div class="signature-body">
											<?php if ( empty( $users_sign->esignImage ) ){ ?>
												<img src="<?=url("");?>uploads/signatures/demo.png" class="img-responsive">
											<?php }else{ ?>
												<img src="<?=$users->esignImage?>" class="img-responsive">
											<?php } ?>
									</div>
							</div>
							<div class="signature-btn-holder">
								<a class="btn btn-primary btn-block"  data-toggle="modal" data-target="#updateSignature" data-target="#createFolder" data-backdrop="static" data-keyboard="false"> Update Signature</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end container-fluid -->
</div>


<div class="modal fade" id="updateSignature" role="dialog">
	<div class="close-modal" data-dismiss="modal">&times;</div>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Update Signature </h4>
			</div>
			<div class="modal-body">
				<div id="signature" style='border:none;'>
					<canvas id="signature-pad" class="signature-pad" width="430px" height="230px"></canvas>
				</div>
				<textarea style="display: none;" name="data[output]" id='output'></textarea>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="click" class="btn btn-primary save-signature">Save Signature</button>
			</div>
		</div>
	</div>
</div>

<!-- Signature MODAL -->
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>

<script type="text/javascript">

	$(document).ready(function() {
		var signaturePad = new SignaturePad(document.getElementById('signature-pad'));
 		$('#click').click(function(){
			var data = signaturePad.toDataURL('image/png');
			$('#output').val(data);

			var url = 'esign/saveSign';
			$.ajax({
                url: url,
                type: "POST",
                data:{base64: data}
			}).done(function(e){
			   location.reload();
			});
		})
	}) 
</script>

