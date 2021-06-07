<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Work Order</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css">
    <style>
        /* body
        {
            margin:5px;
        } */
    </style>
</head>
<body style="font-family: Gill Sans, sans-serif; font-size: 16px;" >
    <div style="box-shadow:0 2px 8px 0 rgba(0,0,0,.2);background-color: #fff;border: 1px solid #d4d7dc;-webkit-transition: all .3s ease;position:relative;top:20px;width: 95%;margin: 0 auto; padding:5%;">
        <div style="text-align: justify; text-justify: inter-word;">
            This workorder agreement (the "agreement") is made as of 05-07-2021, by and between ADI Smart Home, (the "Company") and the ("Customer") as the address shown below (the "Premise/Service")
        </div>

        <div class="" style="float: right;">
            <h3>WORK ORDER <br> # <?php echo $workorder; ?></h3>
            <br>
            Job Tags: <?php echo $tags; ?> <br>
            Date Issued: <?php echo $wDate = $date_issued; ?> <br>
            Priority: <?php echo $priority; ?> <br>
            Password: <?php echo $password; ?> <br>
            Security Number: <?php echo $security_number; ?> <br>
            <!-- Custom Field: <?php //echo $security_number; ?> <br> -->
            Source: <?php echo $source_name; ?> <br>
            Contacts: <br>
				&emsp;  <?php echo $first_verification_name ?> <br> 
                &emsp;  <?php echo $first_number ?> <br>
                &emsp;  <?php echo $first_relation ?><br><br>

				&emsp;  <?php echo $second_verification_name ?> <br> 
                &emsp;  <?php echo $second_number ?> <br> 
                &emsp;  <?php echo $second_relation ?><br><br>

				&emsp;  <?php echo $third_verification_name ?> <br> 
                &emsp;  <?php echo $third_number ?> <br> 
                &emsp;  <?php echo $third_relation ?>
        </div>


        <div style="padding: 10%;">
            <img src="<?php //echo" $company_representative_signature"; ?>">
        </div>

        <div style="margin-top:10%">

            <div>
                <b>FROM:</b><br>
                <!-- <hr style="width: 50% !important; align:left !important;"> -->
                <?php echo $company; ?><br>
                License: <?php echo $business_address; ?><br>
                <?php echo $business_address; ?><br>
                Phone: <?php echo $phone_number; ?><br><br>
            </div>

            <div>
                <b>CUSTOMER:</b><br>
                <!-- <hr style="width: 50% !important; align:left !important;"> -->
                <?php echo $acs_name; ?><br>
                <?php echo $job_location; ?><br>
                <?php echo $job_location2; ?><br>
                Email: <?php echo $email; ?><br>
                Phone: <?php echo $phone; ?><br>
                Mobile: <?php echo $mobile; ?><br><br>
            </div>

            <div>
                <b>ADDITIONAL CONTACTS:</b>
                <hr><br>
            </div>

            <div style="text-align: justify; text-justify: inter-word;">
                <b>TERMS & CONDITIONS:</b>
                <hr>
                <?php echo $terms_and_conditions; ?>
            </div>


            <div class=""><br>
                <b>JOB DETAILS:</b>
                <hr>
                <table class="pure-table">
                    <tr>
                        <th>Items</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Tax</th>
                        <th>Total</th>
                    </tr>
                    <tbody>
                        <tr>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                        </tr>
                        <tr>
                            <td data-column="">Residential Smart QSP </td>
                            <td data-column="">1</td>
                            <td data-column="">$49.99</td>
                            <td data-column="">$0.00</td>
                            <td data-column="">$3.75 </td>
                            <td data-column="">$53.74</td>
                        </tr>
                        <tr>
                            <td data-column=""><b>Grand Total</b></td>
                            <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""></td>
                            <td data-column=""><b>$53.74</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <br><br>
            <div style="text-align: justify; text-justify: inter-word;">
                <b>TERMS OF USE:</b>
                <hr>
                <?php echo $terms_of_use; ?><br><br>
            </div>

            <div style="text-align: justify; text-justify: inter-word;">
                <b>JOB DESCRIPTION:</b>
                <hr>
                <?php echo $job_description; ?><br><br>
            </div>

            <div style="text-align: justify; text-justify: inter-word;">
                <b>INSTRUCTIONS:</b>
                <hr>
                <?php echo $instructions; ?><br><br>
            </div>

            <div style="text-align: justify; text-justify: inter-word;">
                <b>ACCEPTED PAYMENT METHODS:</b>
                <hr>
                <br>
            </div>

            <div style="text-align: justify; text-justify: inter-word;">
                <b>PAYMENT DETAILS:</b>
                <hr>
                <br>
            </div>

            <div style="text-align: justify; text-justify: inter-word;">
                <b>ASSIGNED TO:</b>
                <hr>
                    <img src="<?php echo " $company_representative_signature"; ?>" style="width: 50%;"><br>
                    <?php echo $company_representative_name; ?><br><br>

                    <img src="<?php echo " $primary_account_holder_signature"; ?>" style="width: 50%;"><br>
                    <?php echo $primary_account_holder_name; ?><br><br>
                <br>
            </div>

        </div>

    </div>
</body>
</html>
