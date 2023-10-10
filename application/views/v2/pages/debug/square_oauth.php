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
                            Square Demo.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <a href="https://connect.squareupsandbox.com/oauth2/authorize?client_id=sandbox-sq0idb-_QITXE8-SXhp_NdfL99Vdw&scope=MERCHANT_PROFILE_READ&redirect_uri=http://127.0.0.1/ci/nsmart_v2/tools/square/oauth_redirect&session=false" class="nsm-button primary">Connect Square</a>
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
  //key: '8a630fc17e537b72fe56911d4a11cb',
  token: '<?= $plaidToken['token']; ?>',
  product: ['auth','transactions'],
  selectAccount: true,
  onSuccess: function(public_token, metadata) {
    console.log('public_token: ' + public_token);
    console.log('metadata: ' + JSON.stringify(metadata));
    $('.plaid-info-container').html('Loading data');

    $('#public-token').val(public_token);
    $('#account-id').val(metadata.account.id);
    //var url = base_url + 'debug/plaidAuth';
    //var url = base_url + 'debug/plaidIdentityGet';
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

    // Send the public_token and account ID to your app server.
    /*var $form = $('<form>', {
      'action': '//httpbin.org/post',
      'method': 'POST'
    }).append($('<input>', {
      'name': 'public_token',
      'value': public_token,
      'type': 'hidden'
    })).append($('<input>', {
      'name': 'account_id',
      'value': metadata.account.id,
      'type': 'hidden'
    }));
    $(document.body).append($form);
    $form.submit();*/
  },
});

// Trigger the Link UI
$("#linkButton").click(function() {
  linkHandler.open();
});
</script>