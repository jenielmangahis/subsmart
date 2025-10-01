<div class="row">
	<div class="col-6">
		<label>Upgrade Plan</label>
		<div class="col-auto">
			<div class="input-group">
				<div class="input-group-text"><i class='bx bxs-user-account'></i></div>
				<input type="text" class="form-control" value="<?= $plan->plan_name; ?>" disabled="">
			</div>
		</div>
	</div>
	<div class="col-6">
		<label>Total Amount</label>
		<div class="col-auto">
			<div class="input-group">
				<div class="input-group-text"><i class='bx bx-dollar-circle'></i></div>
				<input type="text" class="form-control" value="<?= number_format($total_cost, 2) . ' / ' . ucfirst($subscription_type); ?>" disabled="">
			</div>
		</div>
	</div>
	<div class="col-6"></div>
	<div class="col-12 col-md-12 mt-2">
		<input type='hidden' name='stripeToken' id='stripe-token-id'>                       
		<br>
		<div id="upgrade-plan-payment-element"></div>
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
        paymentElement.mount('#upgrade-plan-payment-element');

		const paymentForm = document.querySelector('#upgrade-plan-payment-form');
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
				$('#upgrade-plan-payment-intent-id').val(payment_intent_id);
				process_upgrade_plan_payment();
			}
		});

		function process_upgrade_plan_payment(){
			var url = base_url + 'mycrm/_process_upgrade_plan_payment';
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                data: $("#frm-upgrade-subscription").serialize(),
                success: function(o)
                { 
                    $('#upgrade-plan-payment-intent-id').val('');
                    if( o.is_success == 1 ){                        
                        Swal.fire({
                            title: 'Plan Upgrade',
                            text: "Your plan was successfully upgraded",
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
                            title: 'Cannot upgrade plan',
                            text: o.message
                        });
                    }
                },
                beforeSend: function() {
					$('#upgrade_plan_modal').modal('hide');
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