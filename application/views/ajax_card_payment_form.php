<div class="row">
	<div class="col-12 col-md-12">
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
				let url = base_url + 'registration/_process_card_payment';
				let payment_intent_id = response.paymentIntent.id;
				$('#payment-method').val('stripe');
				$('#payment-intent-id').val(payment_intent_id);
				stripe_activate_registration();
			}
		});

		function stripe_activate_registration(){
			$(".payment-method-container").hide();
			var url = base_url + 'registration/_create_registration';
			$.ajax({
				type: "POST",
				url: url,
				dataType: "json",
				data: $("#subscribe-form-payment").serialize(),
				success: function(o)
				{	
					$('.trial-register-btn').html('Register');
					$('#payment-intent-id').val('');
					if( o.is_success ){
						Swal.fire({
							title: 'Registration Completed!',
							html: '<center>You can now login to your account</center>',
							icon: 'success',
							showCancelButton: false,
							confirmButtonColor: '#32243d',
							cancelButtonColor: '#d33',
							timer: 2500,
							confirmButtonText: 'Login'
						}).then((result) => {
							//if (result.value) {
								window.location.href= base_url + 'login';
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
					$('#modal-credit-card-form').modal('hide');
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