<?php
function convergeSendSale($data)
{
    include APPPATH.'libraries/Converge/src/Converge.php';

    $is_success = false;
    $msg = '';
    $ssl_txn_id = '';

    $exp_year = date('m/d/'.$data['exp_year']);
    $exp_date = $data['exp_month'].date('y', strtotime($exp_year));
    $converge = new \wwwroth\Converge\Converge([
        'merchant_id' => CONVERGE_MERCHANTID,
        'user_id' => CONVERGE_MERCHANTUSERID,
        'pin' => CONVERGE_MERCHANTPIN,
        'demo' => false,
    ]);
    $createSale = $converge->request('ccsale', [
        'ssl_card_number' => $data['card_number'],
        'ssl_exp_date' => $exp_date,
        'ssl_cvv2cvc2' => $data['card_cvc'],
        'ssl_amount' => $data['amount'],
        'ssl_avs_address' => $data['address'],
        'ssl_avs_zip' => $data['zip'],
    ]);

    if ($createSale['success'] == 1) {
        $is_success = true;
        $msg = '';
        if( $createSale['ssl_txn_id'] ){
            $ssl_txn_id = $createSale['ssl_txn_id'];
        }elseif( $createSale['id'] ){
            $ssl_txn_id = $createSale['id'];
        }
        
    } else {
        $is_success = false;
        $msg = $createSale['errorMessage'];
    }

    $return = ['is_success' => $is_success, 'msg' => $msg, 'ssl_txn_id' => $ssl_txn_id];

    return $return;
}