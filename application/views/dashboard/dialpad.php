<style>

    .row-dial {
        margin: 0 auto;
        width: 100%;
        float:left;
        text-align: center;
        font-family: 'Exo';
    }

    .digit,
    .dig {
        float: left;
        width: 33%;
        font-size: 2rem;
        cursor: pointer;
    }
    .digit-delete {
        float: left;
        width: 33%;
        font-size: 2rem;
        cursor: pointer;
    }

    .sub {
        font-size: 0.8rem;
        color: grey;
    }

    #output {
        font-family: "Exo";
        font-size: 2rem;
        height: 60px;
        font-weight: bold;
        color: #1976d2;
        margin-top:10px;
    }

    #call {
        display: inline-block;
        background-color: #66bb6a;
        padding: 4px 30px;
        margin: 10px;
        color: white;
        border-radius: 4px;
        float: left;
        cursor: pointer;
    }

    .botrow-dial {
        margin: 0 auto;
        width: 100%;
        text-align: center;
        font-family: 'Exo';
    }

    .digit:active,
    .dig:active {
        background-color: #e6e6e6;
    }

    #call:hover {
        background-color: #81c784;
    }

    .dig {
        float: left;
        padding: 10px 20px;
        margin: 10px;
        width: 30px;
        cursor: pointer;
    }
</style>

<input type="tel" id="output" style="width: 100%;border: none; text-align: center"/>
<div class="row-dial">
    <div class="digit" id="one">1</div>
    <div class="digit" id="two">2
        <div class="sub">ABC</div>
    </div>
    <div class="digit" id="three">3
        <div class="sub">DEF</div>
    </div>
</div>
<div class="row-dial">
    <div class="digit" id="four">4
        <div class="sub">GHI</div>
    </div>
    <div class="digit" id="five">5
        <div class="sub">JKL</div>
    </div>
    <div class="digit">6
        <div class="sub">MNO</div>
    </div>
</div>
<div class="row-dial">
    <div class="digit">7
        <div class="sub">PQRS</div>
    </div>
    <div class="digit">8
        <div class="sub">TUV</div>
    </div>
    <div class="digit">9
        <div class="sub">WXYZ</div>
    </div>
</div>
<div class="row-dial">
    <div class="digit">+
    </div>
    <div class="digit">0
    </div>
    <div class="digit">#
    </div>
</div>
<div class="row-dial mb-3 mt-3">
    <div class="digit">
        <i class="fa fa-star" style="font-size: 15px;" aria-hidden="true"></i>
    </div>    
    <div class="digit">
        <div class="btn btn-small btn-success" id="initiateCallBtn" style="height: 52px; padding:10px; width: 75px"><i style="font-size: 25px;" class="fa fa-phone-alt" aria-hidden="true"></i></div>
    </div>
    <div class="digit-delete" id="deleteNumberBtn">
        <i class="fa fa-arrow-left" style="font-size: 15px;" aria-hidden="true"></i>
    </div>

    <div class="col-lg-12 float-left mt-3" id="callStatus"></div>
</div>
<div id="hang-up" style="display: none;">
    <img src="<?= base_url('assets/ringcentral/') . 'hang-up.png' ?>" style="width: 80%;margin: 0 auto;height: 20px;" />
</div>

<script id="rendered-js">

    var count = 0;
    var pollCheckStatus = 0;
    var phoneNumber = '';

    $(".digit").on('click', function () {
        var num = $(this).clone().children().remove().end().text();
        if (count < 12) {
            phoneNumber += num.trim();
            count++;

            
        }

        $('#output').val(phoneNumber);
    });

    $('#deleteNumberBtn').on('click', function () {
        $('#output span:last-child').remove();
        count--;
    });

    $('#initiateCallBtn').click(function () {

        if($(this).hasClass('btn-success'))
        {
            $(this).html($('#hang-up').html());
            $(this).removeClass('btn-success');
            $(this).addClass('btn-danger');
            var num = $('#output').val();
            $.ajax({
               url: '<?php echo base_url(); ?>ring_central/initiateCallOut',
               method: 'POST',
               dataType:'json',
               data: {to: num},
               success: function (response) {
                   $('#callStatus').html(response.status);
                   console.log(response.id);
                   checkCallStatus(response.id)
                   $('#output').val(num);
               }
           });
        
        }else{
            
            $(this).removeClass('btn-danger');
            $(this).addClass('btn-success');
            $(this).html('<i style="font-size: 25px;" class="fa fa-phone-alt" aria-hidden="true"></i>');
            $('#callStatus').html('');
            window.clearInterval(pollCheckStatus);
        }

    });
    
    function initiateCallOut()
    {

    }

    function checkCallStatus(result_id)
    {
       // alert(phoneNumber)
        pollCheckStatus = window.setInterval(function () {
            $.ajax({
                url: '<?php echo base_url(); ?>ring_central/checkCallStatus/'+result_id,
                method: 'POST',
                dataType:'json',
                data: {id: result_id},
                success: function (response) {
                    $('#callStatus').html(response.status);
                    console.log(response.status_all);
                    
                    if(response.status == "Finished"){
                        window.clearInterval(pollCheckStatus);
                        $('#initiateCallBtn').html('<i style="font-size: 25px;" class="fa fa-phone-alt" aria-hidden="true"></i>');
                        $('#initiateCallBtn').removeClass('btn-danger');
                        $('#initiateCallBtn').addClass('btn-success');
                        $('#callStatus').html(response.status);
                    }else if(response.callStatus=="Success"){
                        $('#callStatus').html(response.callStatus);
                        
                    }
                }
            });
            
           
        }, 3000);
    }


</script>


