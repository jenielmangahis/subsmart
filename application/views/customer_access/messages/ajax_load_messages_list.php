<style>
.messages-list li.messages-you .message-img {
    float: left;
}
.messages-list li.messages-you .message-header {
    text-align: left;
}
.message-header {
    text-align: right;
    width: 100%;
    margin-bottom: 0.5rem;
}
.messages-list li.messages-you p {
    float: left;
    text-align: left;
}
.message-img {
    float: right;
    margin: 0px 5px;
}
.messages-list li.messages-me p {
    float: right;
}
.messages-list li p {
    max-width: 60%;
    padding: 5px;
    /*border: #e6e7e9 1px solid;*/
}
.messages-box{
    max-height: 400px;
    overflow-y: scroll;
}
.avatar-sm{
    width: 74px;
}
.message-header h3{
    font-size: 18px;
    text-align: left;
}
.header-msg{
    font-size: 15px;
    text-align: left;
    padding: 10px;
    background-color: #c1c1c1;
    margin-bottom: 30px;
    max-height: 200px;
    overflow-y: scroll;
}
.messages-you{
    background-color: #6a4a86;
    color: #ffffff;
    padding: 25px;
    margin-bottom: 22px;
}
.messages-me{
    background-color: #529562ba;
    color: #ffffff;
    padding: 25px;
    margin-bottom: 22px;
}
.text-muted{
    color: #ffffff !important;
}
</style>
<div class="message-header">
    <h3><?= $customerMessage->subject; ?></h3>
    <div class="header-msg"><?= $customerMessage->message; ?></div>
</div>
<div class="messages-box">    
    <ul class="list-unstyled messages-list">
        <?php foreach($customerMessageReplies as $r){ ?>
            <?php 
                $li_message_type = 'messages-me';
                $avatar = base_url('assets/img/default-agent.png');
                if( $r->prof_id > 0 ){
                    $li_message_type = 'messages-you';
                    $avatar = base_url('assets/img/default-customer.png');
                }
            ?>

            <li class="<?= $li_message_type; ?> clearfix">
                <span class="message-img img-circle">
                    <img src="<?= $avatar; ?>" alt="User Avatar" class="avatar-sm border rounded-circle">
                </span>
                <div class="message-body clearfix">
                    <div class="message-header">
                        <strong class="messages-title"><?= $r->name; ?></strong> 
                        <small class="time-messages text-muted">
                            <span class="fas fa-time"></span><?= date("F d, Y g:i A", strtotime($r->date_created)); ?>
                        </small>
                    </div>
                    <p class="messages-p"><?= $r->message; ?></p>
                </div>
            </li>

        <?php } ?>        
    </ul>
</div>
<br />
<div class="col">
    <div class="panel-body">
        <form role="form" id="frm-send-reply">
            <input type="hidden" id="cid" name="cid" value="<?= $customerMessage->id; ?>">
            <fieldset>
                <div class="form-group">
                    <textarea class="form-control" name="message_reply" id="message-reply" rows="3" placeholder="Write a reply" autofocus=""></textarea>
                </div>
                <br />
                <button type="submit" class="btn btn-success btn-send-reply">Post reply</button>
            </fieldset>
        </form>
    </div>
</div>
<script>
$(function(){    
    function load_replies(){
        var cid = "<?= $customerMessage->id; ?>";
        var url = base_url + 'acs_access/_load_message_thread';
        $.ajax({
            type: "POST",
            url: url,
            data: {cid:cid},
            success: function(o)
            {  
                $(".messages-list").html(o);
            }
        });
    }

    $(document).on('submit', '#frm-send-reply', function(e){
        e.preventDefault();

        var url = base_url + 'acs_access/_send_message_reply';
        $(".btn-send-reply").html('<span class="spinner-border spinner-border-sm m-0"></span>');

        var formData = new FormData($("#frm-send-reply")[0]);   

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: 'json',
             contentType: false,
             cache: false,
             processData:false,
             data: formData,
             success: function(o)
             {  
                if( o.is_success == 1 ){
                  load_replies();
                  Swal.fire({
                      title: 'Great!',
                      text: 'Message was successfully sent.',
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonColor: '#32243d',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Ok'
                  }).then((result) => {
                    $('#message-reply').val('');                    
                  });
                }else{                      
                  Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    confirmButtonColor: '#32243d',
                    html: o.msg
                  });
                } 

                $(".btn-send-reply").html('Post reply');
             }
          });
        }, 800);
    });
});
</script>