<div id="edit-cashflow-customer">
    <div class="modal-body">
        <div class="container">
            <div class="cont-close">
                <button class="closing"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="holder">
                <h3>EDIT THE FOLLOWING FIELDS</h3>
                <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</h6>
                <div class="input-holder">
                    <h5 id="merchant_name"></h5>
                    <input type="text" id="id" style="display: none;">
                    ENTER DATE: <input type="date" value="" id="date"><br>
                    ENTER AMOUNT: <input type="text" class="text">
                </div>
                <button class="saving">SAVE</button>
            </div>
        </div>
    </div>
</div>

<style>
    div#edit-cashflow-customer {
        position: fixed;
        top: 0;
        z-index: 1059;
        width: 100%;
        height: 100%;
        background: #00000082;
        display: none;
        text-align: -webkit-center;
    }

    #edit-cashflow-customer input#date {
        margin: 20px 26px;
        height: 37px;
        width: 206px;
        border-radius: 20px;
        padding: 20px;
    }

    #edit-cashflow-customer input.text {
        height: 37px;
        width: 206px;
        border-radius: 20px;
        padding: 20px;
    }

    #edit-cashflow-customer button.saving {
        width: 100px;
        margin: 44px 129px;
        border-radius: 20px;
        background-color: #2ca01d;
        color: white;
    }

    #edit-cashflow-customer .modal-body {
        background-color: white;
        width: 30%;
        border-radius: 30px;
        text-align: left;
        margin-top: 125px;
    }

    #edit-cashflow-customer .cont-close {
        text-align: right;
    }

    #edit-cashflow-customer button.closing {
        background: none;
        border: none;
        font-size: 23px;
    }
</style>