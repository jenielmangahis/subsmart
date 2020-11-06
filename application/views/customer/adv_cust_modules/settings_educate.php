<div class="card">
    <div class="card-body hid-desk" style="padding-bottom:0px;">
        <div class="col-lg-12">
            <div> <b>Finances</b> (<?= isset($profile_info) ?  $profile_info->first_name.' '.$profile_info->last_name : '';  ?>) </div>
            <br>
            <div class="formboxtext">
                Since your client's debt plays a big factor in their credit scores, it is important that they have an understanding of this.
                This area of the program will keep all of that information organized and at your fingertips.
            </div>
            <div class="qUickStart">
                <img src="/assets/img/customer/images/clients_debts.png">
                <div class="qUickStartde">
                    <h4><a href="#">CLIENT'S OUTSTANDING DEBTS</a></h4>
                    <span>
                           Help your client to understand their revolving debt and how it affects their credit scores.
                    </span>
                </div>
            </div>
            <div class="qUickStart">
                <img src="/assets/img/customer/images/clients_expenses.png">
                <div class="qUickStartde">
                    <h4><a href="#">CLIENT'S EXPENSES</a></h4>
                    <span>
                           Help your client to understand their monthly cash flow.
                    </span>
                </div>
            </div>
            <div class="qUickStart">
                <img src="/assets/img/customer/images/calculators.png">
                <div class="qUickStartde">
                    <h4><a id="shortcut_link" href="#<?php //echo url('/workorder/add') ?>">CALCULATORS</a></h4>
                    <span>
                        An assortment of calculators to help your client to reach their goals.
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .tips {
        background-color: #f9f9f9;
        margin: 20px auto;
        padding: 10px;
    }
    .qUickStart{
        /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#fcfcfc+0,eaeaea+100 */
        background: #fcfcfc; /* Old browsers */
        background: -moz-linear-gradient(top,  #fcfcfc 0%, #eaeaea 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  #fcfcfc 0%,#eaeaea 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  #fcfcfc 0%,#eaeaea 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfcfc', endColorstr='#eaeaea',GradientType=0 ); /* IE6-9 */
        display: flex;
        align-items: center;
        padding: 16px;
        border-radius: 4px;
        border: 1px solid #ddd;
        margin-bottom:15px;
    }
    .qUickStart:last-child{
        margin-bottom:0px;
    }
    .qUickStart .icon{
        background:#2d1a3e !important;
        flex: 0 0 70px;
        height: 70px;
        border-radius: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        color:#fff;
        margin-right: 10px;
    }
    .qUickStart .qUickStartde h4{
        font-size: 16px;
        text-transform: uppercase;
        font-weight: 700;
        margin: 0;
        margin-bottom: 6px;
        padding-left: 6px;
    }
    .qUickStart .qUickStartde span{
        opacity: 0.6;
        margin-bottom: 6px;
        padding-left: 6px;
    }
</style>