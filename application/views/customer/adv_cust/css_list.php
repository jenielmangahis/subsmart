<style>
    .form-line{
        padding-bottom: 4px;
    }
    .hid-deskx {
        display: none !important;
    }
    body {
        margin: 0;
        padding: 0;
        font-family: Arial,Helvetica,sans-serif;
        font-weight: 400;
        font-size: 13px;
    }
    .indata {
        width : 100%;
        float: left;
        height:auto;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        flex-flow: wrap;
    }
    .module{
        border: 2px solid #e4e4e4 !important;
        border-radius: 10px;
        width: 470px !important;
        max-width: 100%;
        float: left;
        box-sizing: border-box;
        padding: 10px  0 10px 38px;
        height : 190px;
        position: relative;
        margin-left: 10px;
        margin-bottom: 10px;
        background: #ffffff !important;
    }
    .module_med{
        border: 1px solid #32243d;
        border-radius: 10px;
        width: 470px;
        max-width: 100%;
        float: left;
        box-sizing: border-box;
        padding: 10px 0 10px 38px;
        height : 380px;
        position: relative;
        margin-left: 10px;
        margin-bottom: 10px;
        background: #ffffff !important;
    }
    .module_lg{
        border: 1px solid #32243d;
        border-radius: 10px;
        width: 450px;
        max-width: 100%;
        float: left;
        box-sizing: border-box;
        padding: 0 0 10px 38px;
        height : 540px;
        position: relative;
        margin-left: 10px;
        margin-bottom: 10px;
        background: #ffffff !important;
    }
    @media only screen and (max-width: 954px){
        .module {
            width: 590px;
            max-width: 100%;
            font-size: 10px !important;
        }
    }
    @media only screen and (max-width: 500px){
        .module {
            width: 490px;
            max-width: 100%;
        }
    }
    @media (min-width: 600px) and (max-width: 767px){
        .module {
            width: 460px ;
            max-width: 100%;
        }
    }
    @media only screen and (max-width: 375px){
        .module {
            width: 490px;
            max-width: 90%;
        }
    }
    @media only screen and (max-width: 900px){
        #container2 { width: 90%; }
    }
    .individual-module h6 {
        transform: rotate(-90deg);
        width: 190px;
        text-align: center;
        background: #34203f;
        padding: 5px;
        position: absolute;
        float: left;
        left: -120px;
        top: 58px;
        color: white;
        border-radius: 10px 10px 0px 0;
        cursor: pointer;
    }
    .client {
        background-image: url('https://app.creditrepaircloud.com/application/images/client_new.png');
        width: 530px;
        float: left;
        margin: 0 0 0 10px;
        padding: 0 0 0 40px;
    }
    .client, .project {
        height: 185px;
        background-repeat: no-repeat;
    }
    .contactrighttab:hover {
        border: 1px solid #dfdfdf;
        border-radius: 5px;
        box-shadow: 0 0 8px #ddd;
        cursor: pointer;
        color: #0070c8;
    }
    .contactrighttab {
        height: 35px;
        margin-top: 6px;
        padding-top: 3px;
        padding-bottom: 3px;
        float: left;
        border: 1px solid #fff;
    }
    .contactrighttxt {
        width: 207px;
        font-size: 12px;
        line-height: 130%;
    }
    .contactrighttxt a {
        color: #1e5da9;
        text-decoration: none;
    }
    .contactrightimg {
        float: left;
        margin-right: 10px;
        font-size: 10px;
        padding: 2px;
        width: 35px;
    }
    .project {
        background-image: url('https://app.creditrepaircloud.com/application/images/scores_new.png');
        width: 530px;
        float: left;
        margin: 10px 0 0 10px;
        padding: 0 0 0 40px;
    }
    .storescontent {
        float: left;
        width: 279px;
        margin-top: 15px;
        min-height: 121px;
    }
    .chartzoom {
        float: right;
        position: absolute;
        z-index: 990;
        width: 425px;
    }
    .chart {
        width: 139px!important;
        height: 159px;
        margin: 2px 2px 0 0;
        border-top-right-radius: 9px;
        -webkit-border-top-right-radius: 9px;
        -moz-border-top-right-radius: 9px;
        -ms-border-top-right-radius: 9px;
        -o-border-top-right-radius: 9px;
        border-bottom-right-radius: 9px;
        -webkit-border-bottom-right-radius: 9px;
        -moz-border-bottom-right-radius: 9px;
        -ms-border-bottom-right-radius: 9px;
        -o-border-bottom-right-radius: 9px;
    }
    .chart, .chart2 {
        background-color: #d4f6ff;
        float: right;
        padding: 0;
    }
    .add {
        font-size: 13px;
        font-weight: 400;
        margin: 0 0 0 120px;
    }
    .add, .add a {
        color: #1e5da9;
    }
    .clear {
        clear: both;
        height: 10px;
    }
    .paperwork {
        background-image: url('https://app.creditrepaircloud.com/application/images/documents_new.png');
        background-repeat: no-repeat;
        width: 530px;
        height: 165px;
        float: left;
        margin: 10px 0 0 10px;
        padding: 0 0 0 50px;
    }
    .statusbg {
        background-image: url('https://app.creditrepaircloud.com/application/images/status_new.png');
        height: 340px;
        width: 520px;
        float: left;
        margin: 10px 0 0 11px;
        padding: 0;
    }
    .btn, .btn:hover, .details, .statusbg {
        background-repeat: no-repeat;
    }
    .statuscontent {
        float: left;
        width: 274px;
        margin-top: 15px;
        padding-left: 50px;
    }
    .chart2 {
        width: 140px;
        height: 336px;
        margin: 1px 1px 0 0;
        -webkit-border-top-right-radius: 10px;
        -moz-border-top-right-radius: 10px;
        -ms-border-top-right-radius: 10px;
        -o-border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        -webkit-border-bottom-right-radius: 10px;
        -moz-border-bottom-right-radius: 10px;
        -ms-border-bottom-right-radius: 10px;
        -o-border-bottom-right-radius: 10px;
    }
    .chart2, .signin {
        border-top-right-radius: 10px;
    }
    .reminder {
        background-image: url('https://app.creditrepaircloud.com/application/images/reminder_new.png');
        width: 480px;
        margin: -167px 145px 0 10px;
    }
    .invoice, .reminder {
        background-repeat: no-repeat;
        float: left;
        height: 165px;
        padding-left: 50px;
    }
    .task-tab {
        width: 443px;
    }
    .task-tab ul.tab {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #f1f1f1;
        width: 435px;
        border-radius: 0 9px 0 0;
        text-align: center;
    }
    .task-tab .tabcontent {
        display: none;
        padding: 6px 12px;
        border-top: none;
    }
    .task-tab ul.tab li {
        float: left;
        width: 50%;
    }
    .memo {
        background-image: url('https://app.creditrepaircloud.com/application/images/memo1_new.png');
        width: 480px;
    }
    .assigncontactbg, .billing, .memo {
        background-repeat: no-repeat;
        padding-top: 10px;
    }
    .billing, .memo {
        height: 165px;
        margin-left: 10px;
        padding-left: 50px;
        float: left;
    }
    .invoice {
        background-image: url('https://app.creditrepaircloud.com/application/images/invoice_new.png');
        width: 480px;
        padding-top: 10px;
        float: left;
        margin: 10px 0 0 65px;
    }
    .invoice, .reminder {
        background-repeat: no-repeat;
        float: left;
        height: 165px;
        padding-left: 50px;
    }
    .boverdue {
        font-size: 12px;
        color: #000;
        padding-bottom: 10px;
    }
    .boverdue, .noinvoice, .positive, .removed, .update {
        font-weight: 700;
    }
    .balance {
        font-size: 12px;
        color: #666;
        width: 99%;
        height: 70px;
        overflow: auto;
    }
    .invoicetext {
        font-size: 13px;
        color: #0070c8;
        font-weight: 400;
        margin: 10px 0 0 50px;
        line-height: 27px;
    }
    .assigncontactbg {
        background-image: url('https://app.creditrepaircloud.com/application/images/contacts-bg.png');
        height: 265px;
        width: 1539px;
        margin-left: 12px;
        padding-left: 32px;
    }
    .assigncontactbg, .billing, .memo {
        background-repeat: no-repeat;
        padding-top: 10px;
    }
    @media (max-width: 767px) {
        .client, .project {
            height: auto !important;
            width: 100% !important;
            padding: 30px 30px;
            margin-bottom: 40px;
        }
        div.ui-state-default div a {
            margin-left: 16px;
        }
        table.widget_client {
            position: relative;
            right: 25px;
        }
        div#chart_column, .contactrighttxt {
            position: relative;
            left: 20px;
        }
        .assigncontactlist.normaltext1 img {
            margin: 0 auto;
        }
        div.ui-state-default {
            padding: 30px 10px;
            clear: both;
            margin-bottom: 40px;
            height: auto;
        }
    }
    @media only screen and (max-width: 600px) {
        .hid-desk {
            display: none !important;
        }
        .hid-deskx {
            display: block !important;
        }
    }
    .banking-tab-container {
        border-bottom: 1px solid grey;
        padding-left: 0;
    }
</style>