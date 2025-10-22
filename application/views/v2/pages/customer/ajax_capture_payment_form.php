<div class="row">
	<div class="col-6">
		<label>Processing Fee</label>
		<div class="col-auto">
			<div class="input-group">
				<div class="input-group-text"><i class='bx bx-dollar-circle'></i></div>
				<input type="text" class="form-control" value="<?= number_format($processing_fee, 2); ?>" disabled="">
			</div>
		</div>
	</div>
	<div class="col-6">
		<label>Payment Amount</label>
		<div class="col-auto">
			<div class="input-group">
				<div class="input-group-text"><i class='bx bx-dollar-circle'></i></div>
				<input type="text" class="form-control" value="<?= number_format($payment_amount, 2); ?>" disabled="">
			</div>
		</div>
	</div>
	<div class="col-12 mt-2">
		<label>Total Amount</label>
		<div class="col-auto">
			<div class="input-group">
				<div class="input-group-text"><i class='bx bx-dollar-circle'></i></div>
				<input type="text" class="form-control" value="<?= number_format($total_cost, 2); ?>" disabled="">
			</div>
		</div>
	</div>
	<div class="col-6"></div>
	<div class="col-12 col-md-12 mt-2">		
		<input type='hidden' name='stripeToken' id='stripe-token-id'>                       
		<br>
		<form id='payment-form' method='post' action="">   
			<div id="payment-element"></div>
			<button id='pay-btn' class="btn btn-primary mt-3" type="submit" style="margin-top: 20px; width: 100%;padding: 11px;font-size:18px;font-weight:bold;">PAY</button>		
			<div class="mt-2" id="paypal-button-container"></div>
		</form>
	</div>
</div>
<script>
    $(function(){
		var total_cost = <?= $total_cost; ?>;
        var stripe = Stripe('<?= STRIPE_PUBLISH_KEY; ?>');
        var appearance = { /* appearance */ };
        var options = { layout: 'accordion', /* options */ };
        var elements = stripe.elements({ clientSecret:'<?= $stripe_client_secret; ?>'});
        var paymentElement = elements.create('payment', options);
        paymentElement.mount('#payment-element');

		var paymentForm = document.querySelector('#payment-form');
		paymentForm.addEventListener('submit', async (e) => {
			// Avoid a full page POST request.
			e.preventDefault();

			// Disable the form from submitting twice.
			paymentForm.querySelector('button').disabled = true;

			// Confirm the card payment that was created server side:
			const response = await stripe.confirmPayment({
			elements,
			confirmParams: {
				//return_url: "{{ route('process-subscription-payment', encrypt($invoice_id)) }}"
			},
			redirect: 'if_required'
			});
			if(response.error) {
			Swal.fire({
				icon: 'error',
				title: 'Error',
				text: response.error.message,
				showConfirmButton: false, // Hides the "OK" button
				//timer: 1500,
			}).then(function() {

			});           

			// Re-enable the form so the customer can resubmit.
			paymentForm.querySelector('button').disabled = false;
			return;
			}else{
				//let payment_intent_id = response.paymentIntent.id;
				//$('#payment-method').val('stripe');
				//$('#payment-intent-id').val(payment_intent_id);
				//process_license_payment();
			}
		});

		function process_license_payment(){
			var url = base_url + 'mycrm/_process_license_payment';
			$.ajax({
				type: "POST",
				url: url,
				dataType: "json",
				data: $("#frm-buy-license").serialize(),
				success: function(o)
				{	
					$('#payment-intent-id').val('');
					if( o.is_success ){
						Swal.fire({
                            title: 'Plan License',
                            text: "Your plan license was successfully updated",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
                            //}
                        });
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Registration Error',
							html: '<center>' + o.msg + '</center>'
						});
					}
					
				},
				beforeSend: function() {
					$('#modal-buy-license').modal('hide');
					Swal.fire({
                        icon: "info",
                        title: "Processing",
                        html: "Please wait while the payment is being process...",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
				},
			});
		}

		paypal.Buttons({
			style: {
				layout: 'horizontal',
				tagline: false,
				//height:25,
				color:'blue'
			},
			// Set up the transaction
			createOrder: function(data, actions) {
				return actions.order.create({
					payer: {
						name: {
						given_name: 'bryann' + " " + 'revina'
						},
						email_address: 'bryann.revina@gmail.com',
					},
					purchase_units: [{
						amount: {
							value: 500
						}
					}],
					application_context: {
						shipping_preference: 'NO_SHIPPING'
					}
				});
			},
			// Finalize the transaction
			onApprove: function(data, actions) {
				return actions.order.capture().then(function(details) {
					// Show a success message to the buyer
					//console.log('paypal',details);				
					
				});
			}
		}).render('#paypal-button-container');
    });
</script>