<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>nSmarTrac - Customer Estimate Review</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <div>
      <div style="font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: center" align="center" id="emb-email-header">
        <img style="border: 0;-ms-interpolation-mode: bicubic;display: block;Margin-left: auto;Margin-right: auto;" src="https://nsmartrac.com/assets/frontend/images/logo.png" alt="">
      </div>
      <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">
        Hey <?php echo $customer;?>,
      </p>
      <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"> 
        We are from nSmarTrac and we just send you the Job Estimate. Please check items below and click this link below to verify the estimation. Thank you!
      </p>
      <p>
        <a href="https://nsmartrac.com/job/verify-estimate/A2234324sdfa34fdfdr3434">Verify Now!!!</a>
      </p>
      <div>
        <?php if (!empty($items)) : ?>
        <table cellspacing="0" cellpadding="10" border="1" style="width:100%;">
          <thead>
            <tr>
              <th>Item</th>
              <th>Type</th>
              <th>Quantity</th>
              <th>Cost</th>
              <th>Total Cost</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($items as $item) : ?>
            <tr>
              <td><?php echo $item['title']; ?></td>
              <td><?php echo $item['type']; ?></td>
              <td><?php echo $item['qty']; ?></td>
              <td>$<?php echo number_format(floatval($item['price']), 2); ?></td>
              <td><?php echo number_format(floatval($item['price'])*floatval($item['qty']), 2); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php endif;?>
      </div>
      <div style="font-size: 11px;font-family: sans-serif;text-align: center;margin-top: 100px;" align="center" id="emb-email-footer">
        <p>6866 Pine Forest Road <br>
        Florida Headquarters <br>
        Pensacola, FL 32526</p>
        <p>(844) 406-7286 <br>
        support@nsmartrac.com</p>
      </div>
    </div>
  </body>
</html>