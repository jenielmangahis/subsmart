<style>
    .qUickStart{
        /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#fcfcfc+0,eaeaea+100 */
        background: #fcfcfc; /* Old browsers */
        background: -moz-linear-gradient(top,  #fcfcfc 0%, #eaeaea 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top,  #fcfcfc 0%,#eaeaea 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom,  #fcfcfc 0%,#eaeaea 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfcfc', endColorstr='#eaeaea',GradientType=0 ); /* IE6-9 */
        display: flex;
        align-items: center;
        padding: 10px;
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
        font-family: Sarabun, sans-serif !important;
        text-transform: uppercase;
        font-weight: 700;
        margin: 0;
        margin-bottom: 0px;
        margin-bottom: 6px;
    }
    .qUickStart .qUickStartde span{
        opacity: 0.6;
    }
</style>
<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h4 class="mt-0 header-title mb-4">Quick Start</h4>
            <a href="<?php echo url('/customer/add_lead') ?>">
                <div class="qUickStart">
                    <span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;">A</span>
                    <div class="qUickStartde">
                        <h4>Add a New Client</h4>
                        <span>Sign up a new client and add to database</span>
                    </div>
                </div>
            </a>
            <br>
            <a href="javascript:void(0);" data-toggle="modal" data-target="#modal_customer">
                <div class="qUickStart">
                    <span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;">B</span>
                    <div class="qUickStartde">
                        <h4>Select an Existing Client</h4>
                        <span>Work with an existing client</span>
                    </div>
                </div>
            </a>
            <br>
            <a id="shortcut_link" href="#<?php //echo url('/workorder/add')    ?>">
                <div class="qUickStart">
                    <span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;">C</span>
                    <div class="qUickStartde">
                        <h4>Add a New Event</h4>
                        <span>Choose from a various quick shortcuts</span>
                    </div>
                </div>
            </a>
            <br>
            <a id="shortcut_link" href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal">
                <div class="qUickStart">
                    <span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;">D</span>
                    <div class="qUickStartde">
                        <h4>Add a New Feed</h4>
                        <span>Send a private message to particular user</span>
                    </div>
                </div>
            </a>
            <br>
            <a id="shortcut_link" href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal2">
                <div class="qUickStart">
                    <span class="icon" style="background-color: #e60000 !important; font-weight: bold; font-size: 40px;">E</span>
                    <div class="qUickStartde">
                        <h4>Add a News Letter</h4>
                        <span>Send a company news letter to all user</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
