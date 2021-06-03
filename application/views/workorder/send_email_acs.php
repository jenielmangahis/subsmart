<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Work Order</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        @media (max-width: 550px) {
            a{
                min-width: 80% !important;
            }
        }
        body
        {
            color: black;
        }

        .container {
            width: 100%;
        }
        .flex {
            display: flex;
        }
        .sameRow {
            /* border: 2px solid black; */
            height: 40px;
            width: 100%;
        }
        .normal {
            height: 40px;
            border: 2px solid red;
        }

        table { 
            width: 750px; 
            border-collapse: collapse; 
            margin:50px auto;
            }

        /* Zebra striping */
        tr:nth-of-type(odd) { 
            background: #eee; 
            }

        th { 
            background: #3498db; 
            color: white; 
            font-weight: bold; 
            }

        td, th { 
            padding: 10px; 
            border: 1px solid #ccc; 
            text-align: left; 
            font-size: 18px;
            }

        /* 
        Max width before this PARTICULAR table gets nasty
        This query will take effect for any screen smaller than 760px
        and also iPads specifically.
        */
        @media 
        only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px)  {

            table { 
                width: 100%; 
            }

            /* Force table to not be like tables anymore */
            table, thead, tbody, th, td, tr { 
                display: block; 
            }
            
            /* Hide table headers (but not display: none;, for accessibility) */
            thead tr { 
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            
            tr { border: 1px solid #ccc; }
            
            td { 
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee; 
                position: relative;
                padding-left: 50%; 
            }

            td:before { 
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 6px;
                left: 6px;
                width: 45%; 
                padding-right: 10px; 
                white-space: nowrap;
                /* Label the data */
                content: attr(data-column);

                color: #000;
                font-weight: bold;
            }

        }
    </style>
</head>
<body style="font-family: Gill Sans, sans-serif; font-size: 16px;" >
<div style="box-shadow:0 2px 8px 0 rgba(0,0,0,.2);background-color: #fff;border: 1px solid #d4d7dc;-webkit-transition: all .3s ease;position:relative;top:20px;width: 95%;margin: 0 auto;">
    <div>
        <div>
            <div>
                <div style="padding: 20px;">
                    <div style="padding: 10px;">
                        <div>
                            <h2>Work Order</h2>
                        </div>
                        <div class="">
                            <div style="margin-top: 50px;">
                                <div style="margin-top: 20px;">
                                    <span>This workorder agreement (the "agreement") is made as of 05-07-2021, by and between ADI Smart Home, (the "Company") and the ("Customer") as the address shown below (the "Premise/Service</span>
                                </div>
                            </div>
                            <div class="container">
                                    <div class="flex">
                                        <div class="sameRow"></div>
                                        <div class="sameRow" style="margin-left: 50%;">
                                            <h3>WORK ORDER <br> # <?php echo $workorder; ?></h3><br> 
                                        </div>
                                    </div>
                            </div>
                            <br><br>
                                <hr/>
                            <div class="container">
                                <div class="flex">
                                        <div class="sameRow"></div>
                                        <div class="sameRow" style="margin-left: 50%;">
                                            Job Tags: <?php echo $tags; ?> <br>
                                            Date: <?php echo date("Y-m-d"); ?> <br>
                                            Type: <?php echo $job_type; ?> <br>
                                            Priority: <?php echo $priority; ?> <br>
                                            Password: <?php echo $password; ?> <br>
                                            Security Number: <?php echo $security_number; ?> <br>
                                            Custom Field: <?php echo $security_number; ?> <br>
                                            Source: <?php echo $source_name; ?> <br>
                                        </div>
                                </div>
                            </div>
                            <div class="">
                                <img src='<?=base_url()?>uploads/sample_logo.png'>
                            </div>
                        </div>
                        <br><br><br><br><br><br>
                        <b>FROM:</b>
                        <hr>
                            <div class="container">
                                <?php echo $company; ?><br>
                                License: <?php echo $business_address; ?><br>
                                <?php echo $business_address; ?><br>
                                Phone: <?php echo $phone_number; ?><br>
                            </div>
                            <br>
                            <b>CUSTOMER:</b>
                            <hr>
                            <div class="container">
                                <?php echo $acs_name; ?><br>
                                <?php echo $job_location; ?><br><br>
                                <?php echo $job_location2; ?><br>
                                Email: <?php echo $email; ?><br>
                                Phone: <?php echo $phone; ?><br>
                                Mobile: <?php echo $mobile; ?><br>
                            </div>
                            <br>
                            <b>ADDITIONAL CONTACTS:</b>
                            <hr>
                            <div class="container">
                            <!-- text -->
                            </div>
                            <br>
                            <b>TERMS & CONDITIONS</b>
                            <hr>
                            <div class="container">
                                <!-- <p>2. Install of the system. Company agrees to schedule and install an
                                alarm system and/or devices in connection with a Monitoring
                                Agreement which customer will receive at the time of installation.
                                Customer hereby agrees to buy the system/devices described below
                                and incorporated herein for all purposes by this reference (the
                                “System /Services”), in accordance with the terms and conditions set
                                forth. IF CUSTOMER FAIL TO FULLFILL THE MONITORING
                                AGREEMENT, Customer agrees to pay the consultation fee, the cost
                                of the system and recovering fees.</p>

                                <p>3. Customer agrees to have system maintained for an initial term of
                                60 months at the above monthly rate in exchange for a reduced cost
                                of the system. Upon the execution of this agreement shall
                                automatically start the billing process. Customer understands that
                                the monthly payments must be paid through “Direct Billing” through
                                their banking institution or credit card. Customers acknowledge that
                                they authorize Company to obtain a Security System. Residential
                                Clients: CUSTOMER HAS THE RIGHT TO CANCEL THIS
                                TRANSACTION at any time prior to midnight on the 3rd business day
                                after the above date of this work order in writing. Customer agrees
                                that no verbal method is valid, and must be submitted only in writing.
                                The date on this agreement is the agreed upon date for both the
                                Company and the Customer</p>

                                <p>4. Client verifies that they are owners of the property listed above. In
                                the event the system has to be removed, Client agrees and
                                understands that there will be an additional $299.00 restocking/
                                removal fee and early termination fees will apply.</p>
                                
                                <p>5. Client understands that this is a new Monitoring Agreement
                                through our central station. Alarm.com or .net is not affiliated nor has
                                any bearing on the current monitoring services currently or previously
                                initiated by Client with other alarm companies. By signing this work
                                order, Client agrees and understands that they have read the above
                                requirements and would like to take advantage of our services. Client
                                understand that is a binding agreement for both party.</p>

                                <p>6. Customer agrees that the system is preprogramed for each
                                specific location. accordance with the terms and conditions set
                                forth. IF CUSTOMER FAIL TO FULLFILL THE MONITORING
                                AGREEMENT, Customer agrees to pay the consultation fee, the cost
                                of the system and recovering fees. Customer agrees that this is a
                                customized order. By signing this workorder, customer agrees that
                                customized order can not be cancelled after three day of this signed
                                document.</p> -->
                                <?php echo $terms_and_conditions; ?>
                            </div>
                            <br>
                            <b>JOB DETAILS:</b>
                            <hr>
                            <div class="container">
                                <table class="table">
                                    <thead>
                                        <th>Items</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Tax</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
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
                                    <tbody>
                                </table>
                            </div>
                            <br>
                            <b>TERMS OF USE</b>
                            <hr>
                            <div class="container">
                                <!-- <p>You may CANCEL this transaction, within THREE BUSINESS DAYS
                                    from the above date. If You cancel, You must make available to US in
                                    substantially as good condition as when received, any goods
                                    delivered to You under this contract or sale, You may, if You wish,
                                    comply with Our instructions regarding the return shipment of the
                                    goods at Your expense and risk. To cancel this transaction, mail
                                    deliver a signed and postmarket, dated copy of this Notice of
                                    Cancellation or any other written notice to ADI Smart Home., 6866
                                    Pine Forest Road, Suite B, Pensacola, FL 32526. NOT LATER THAN
                                    MIDNIGHT OF 05-12-2021</p> -->
                                    <?php echo $terms_of_use; ?>
                            </div>
                            <br>
                            <b>JOB DESCRIPTION</b>
                            <hr>
                            <div class="container">
                                <!-- <p>You may CANCEL this transaction, within THREE BUSINESS DAYS
                                    from the above date. If You cancel, You must make available to US in
                                    substantially as good condition as when received, any goods
                                    delivered to You under this contract or sale, You may, if You wish,
                                    comply with Our instructions regarding the return shipment of the
                                    goods at Your expense and risk. To cancel this transaction, mail
                                    deliver a signed and postmarket, dated copy of this Notice of
                                    Cancellation or any other written notice to ADI Smart Home., 6866
                                    Pine Forest Road, Suite B, Pensacola, FL 32526. NOT LATER THAN
                                    MIDNIGHT OF 05-12-2021</p> -->
                                    <?php echo $job_description; ?>
                            </div>
                            <br>
                            <b>INSTRUCTIONS</b>
                            <hr>
                            <div class="container">
                                <!-- <p>You may CANCEL this transaction, within THREE BUSINESS DAYS
                                    from the above date. If You cancel, You must make available to US in
                                    substantially as good condition as when received, any goods
                                    delivered to You under this contract or sale, You may, if You wish,
                                    comply with Our instructions regarding the return shipment of the
                                    goods at Your expense and risk. To cancel this transaction, mail
                                    deliver a signed and postmarket, dated copy of this Notice of
                                    Cancellation or any other written notice to ADI Smart Home., 6866
                                    Pine Forest Road, Suite B, Pensacola, FL 32526. NOT LATER THAN
                                    MIDNIGHT OF 05-12-2021</p> -->
                                    <?php echo $instructions; ?>
                            </div>
                            <br>
                            <b>ACCEPTED PAYMENT METHODS</b>
                            <hr>
                            <div class="container">
                                <!-- <p>You may CANCEL this transaction, within THREE BUSINESS DAYS
                                    from the above date. If You cancel, You must make available to US in
                                    substantially as good condition as when received, any goods
                                    delivered to You under this contract or sale, You may, if You wish,
                                    comply with Our instructions regarding the return shipment of the
                                    goods at Your expense and risk. To cancel this transaction, mail
                                    deliver a signed and postmarket, dated copy of this Notice of
                                    Cancellation or any other written notice to ADI Smart Home., 6866
                                    Pine Forest Road, Suite B, Pensacola, FL 32526. NOT LATER THAN
                                    MIDNIGHT OF 05-12-2021</p> -->
                            </div>
                            <br>
                            <b>PAYMENT DETAILS</b>
                            <hr>
                            <div class="container">
                                <!-- <p>You may CANCEL this transaction, within THREE BUSINESS DAYS
                                    from the above date. If You cancel, You must make available to US in
                                    substantially as good condition as when received, any goods
                                    delivered to You under this contract or sale, You may, if You wish,
                                    comply with Our instructions regarding the return shipment of the
                                    goods at Your expense and risk. To cancel this transaction, mail
                                    deliver a signed and postmarket, dated copy of this Notice of
                                    Cancellation or any other written notice to ADI Smart Home., 6866
                                    Pine Forest Road, Suite B, Pensacola, FL 32526. NOT LATER THAN
                                    MIDNIGHT OF 05-12-2021</p> -->
                            </div>
                            <br>
                            <b>ASSIGNED TO</b>
                            <hr>
                            <div class="container">
                                <!-- <p>You may CANCEL this transaction, within THREE BUSINESS DAYS
                                    from the above date. If You cancel, You must make available to US in
                                    substantially as good condition as when received, any goods
                                    delivered to You under this contract or sale, You may, if You wish,
                                    comply with Our instructions regarding the return shipment of the
                                    goods at Your expense and risk. To cancel this transaction, mail
                                    deliver a signed and postmarket, dated copy of this Notice of
                                    Cancellation or any other written notice to ADI Smart Home., 6866
                                    Pine Forest Road, Suite B, Pensacola, FL 32526. NOT LATER THAN
                                    MIDNIGHT OF 05-12-2021</p> -->
                            </div>
                            <br>
                            <img src="<?=base_url()?><?php echo $company_representative_signature; ?>" class="img1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
