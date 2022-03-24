<div id="edit-cashflow-customer">
    <div class="modal-body">
        <div class="container">
            <div class="holder">
                <!-- <h3>EDIT THE FOLLOWING FIELDS</h3>
                <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</h6> -->
                <div class="input-holder">
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
    }

    #edit-cashflow-customer .holder {
        position: absolute;
        padding: 20px;
        top: 0px;
        left: 95px;
    }

    #edit-cashflow-customer .container {
        position: relative;
        height: 120px;
    }

    #edit-cashflow-customer #date {
        width: 232px;
        height: 36px;
        letter-spacing: 9px;
        font-size: 14px;
        border-radius: 19px;
        margin-right: 20px;
    }

    #edit-cashflow-customer input.text {
        width: 232px;
        height: 36px;
        letter-spacing: 9px;
        font-size: 14px;
        border-radius: 19px;
        margin-right: 20px;
    }



    #edit-cashflow-customer button.saving {
        width: 100px;
        border-radius: 100px;
        border: none;
        background-color: #2aa01c;
        color: white;
        letter-spacing: 4px;
        margin-left: 109px;
    }

    #edit-cashflow-customer .modal-body {
        padding-top: 25px;
        width: 46%;
        background-color: white;
        top: 180px;
        left: 403px;

    }
</style>