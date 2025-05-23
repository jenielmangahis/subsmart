<?php include viewPath('v2/includes/header'); ?>
<link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Plaid Demo.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <?php if($token){ ?>
                        <form method="POST" id="frm-plaid">
                            <input type="hidden" name="public_token" id="public-token" value="">
                            <input type="hidden" name="account_id" id="account-id" value="">

                        </form>
                        <button id="linkButton">Open Plaid Link</button>
                        <div class="row">
                            <div class="plaid-info-container"></div>
                        </div>
                        <?php }else{ ?>
                            <div>Invalid PLAID account</div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>

<script>
var linkHandler = Plaid.create({
  env: '<?= PLAID_API_ENV ?>',
  clientName: '<?= $client_name; ?>',
  token: '<?= $token; ?>',
  product: ['auth','transactions','balance'],
  receivedRedirectUri : window.location.href,
  selectAccount: true,
  onSuccess: function(public_token, metadata) {
    console.log('public_token: ' + public_token);
    console.log('metadata: ' + JSON.stringify(metadata));
    $('.plaid-info-container').html('Loading data');

    $('#public-token').val(public_token);
    $('#account-id').val(metadata.account.id);
    var url = base_url + 'debug/plaidInfoView';
    var token = public_token;
    var account_id = metadata.account.id;
    $.ajax({
        type: "POST",
        url: url,
        data: {token:token,account_id:account_id},
        success: function(result) {
            $('.plaid-info-container').html(result);
            //alert(result.form.public_token)
            //console.log(result);
        }
    }); 
  },
});
linkHandler.open();

// Trigger the Link UI
$("#linkButton").click(function() {
  linkHandler.open();
});
</script>