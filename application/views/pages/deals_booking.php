<?php include viewPath('includes/header_business_view'); ?>
<style>
.text-h {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 15px;
}
.deal-preview {
    position: relative;
    margin-bottom: 25px;
}
.deal-preview-cnt {
    padding-left: 90px;
}
.deal-preview img {
    position: absolute;
    top: 2px;
    left: 0;
    height: 48px;
    width: auto;
}
</style>
<div class="container" style="padding-top: 0px;background:white;">
    <h1>Book Deal</h1>  
    <div class="row">
        <div class="col-md-8">
            <div class="text-h">One more step left to book this deal</div>
            <div class="deal-preview">
                <img src="<?= base_url("uploads/deals_steals/" . $dealsSteals->company_id . "/" . $dealsSteals->photos); ?>">
                <div class="deal-preview-cnt">
                    <?= $dealsSteals->title; ?><br>
                    $<?= number_format($dealsSteals->deal_price,2); ?> <span class="text-ter"><span style="text-decoration: line-through;">$<?= number_format($dealsSteals->original_price,2); ?></span></span>
                </div>
            </div>

            <form id="frm-booking" method="post" action="#">
                <input type="hidden" name="did" value="<?= $dealsSteals->id; ?>" id="did">
                <div class="card">
                    <p class="margin-bottom">
                        The business <b><?= $company->business_name; ?></b> needs your contact information, please fill in the form below.
                    </p>
                    <div class="form-group">
                        <label>Name</label> <span class="form-required">*</span>
                        <input name="name" required="" type="text" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Phone</label> <span class="form-required">*</span>
                        <input name="phone" required="" id="phone" type="text" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" required="" type="text" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Address</label> <span class="help help-sm">(type in to search for address)</span>
                        <input name="address_full" id="address_full" type="text" required="" class="form-control" autocomplete="off" placeholder="Enter a location">
                    </div>
                    <div class="form-group margin-bottom">
                        <label>Message</label>
                        <div class="help help-sm help-block">Write a message to describe your project shortly.</div>
                        <textarea name="message" required="" rows="3" class="form-control"></textarea>
                    </div>
                    <button class="btn btn-primary btn-lg btn-confirm-booking" type="submit" style="width:30%;">Confirm</button>
                </div>

                <br>
                <br>
            </form>

        </div>
        <div class="col-md-4">
            <div class="side-box">
                <div class="bold margin-bottom">Business Contact Details</div>
                <div class="avatar margin-bottom-sec">
                    <img class="img-circle margin-right-sec" src="<?= getCompanyCoverPhoto($dealsSteals->company_id); ?>" style="height: 36px;">
                    <div class="avatar-cnt">
                       <span class="avatar-name"><?= $company->business_name; ?></span>
                       <span class="text-ter avatar-title"><span class="business-name"><?= $company->contact_name; ?></span></span>
                    </div>
                </div>
                <div class="margin-bottom-sec"><?= $company->address; ?></div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('includes/footer_pages'); ?>
<script>
$(function(){
    $("#frm-booking").submit(function(e){
        e.preventDefault();

        var url = base_url + 'deal/save_booking';
        $(".btn-confirm-booking").html('<span class="spinner-border spinner-border-sm m-0"></span>  Saving');
        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: $("#frm-booking").serialize(),
             success: function(o)
             {
                if( o.is_success == 1 ){
                    Swal.fire({
                        title: 'Congratulations!',
                        text: 'The deal is successfully booked, we will contact you shortly to schedule an appointment',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#32243d',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'View more deals'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                }else{
                    $(".btn-confirm-booking").html('Confirm');

                    Swal.fire({
                      icon: 'error',
                      title: o.msg,
                      text: 'Cannot save booking.'
                    });
                }

                $(".btn-confirm-booking").html('Confirm');
             }
          });
        }, 1000);
    });
});
</script>

