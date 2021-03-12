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
<div id="output"></div>
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
        <div class="btn btn-small btn-success"><i class="fa fa-phone" aria-hidden="true"></i></div>
    </div>
    <div class="digit">
        <i class="fa fa-arrow-left" style="font-size: 15px;" aria-hidden="true"></i>
    </div>
</div>

<script id="rendered-js">
    var count = 0;

    $(".digit").on('click', function () {
        var num = $(this).clone().children().remove().end().text();
        if (count < 11) {
            $("#output").append('<span>' + num.trim() + '</span>');

            count++;
        }
    });

    $('.fa-long-arrow-dial-left').on('click', function () {
        $('#output span:last-child').remove();
        count--;
    });
</script>


