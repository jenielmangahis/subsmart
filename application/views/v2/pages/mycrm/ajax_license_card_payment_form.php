<div class="row">
	<div class="col-6">
		<label>Total License</label>
		<div class="col-auto">
			<div class="input-group">
				<div class="input-group-text"><i class='bx bxs-user-account'></i></div>
				<input type="text" class="form-control" value="<?= number_format($num_license, 2); ?>" disabled="">
			</div>
		</div>
	</div>
	<div class="col-6">
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
		<div id="payment-element"></div>
		<button id='pay-btn' class="btn btn-primary mt-3" type="submit" style="margin-top: 20px; width: 100%;padding: 7px;">PAY</button>
	</div>
</div>
<script>
    $(function(){
        const stripe = Stripe('<?= STRIPE_PUBLISH_KEY; ?>');
        const appearance = { /* appearance */ };
        const options = { layout: 'accordion', /* options */ };
        const elements = stripe.elements({ clientSecret:'<?= $stripe_client_secret; ?>'});
        const paymentElement = elements.create('payment', options);
        paymentElement.mount('#payment-element');

		const paymentForm = document.querySelector('#payment-form');
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
				let payment_intent_id = response.paymentIntent.id;
				//$('#payment-method').val('stripe');
				$('#payment-intent-id').val(payment_intent_id);
				process_license_payment();
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
    });
</script>