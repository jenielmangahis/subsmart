<style>
.address-list{
    list-style: none;
    padding: 0px;
    margin: 0px;
}
.address-list li{
    margin-right: 0px;
    vertical-align: top;
    display: inline-block;
}
.address-label{
    display: inline-block;
}
</style>
<div class="mt-3" style="background-color: #416FA6;color: #ffffff;padding: 6px;">
<label class="content-title" style="cursor: pointer">
    <ul class="address-list">
        <li><span class="address-label"><i class="bx bxs-map-pin"></i> Address :</span></li>  
        <li>
            <span class="address-label"><?= $customer->mail_add; ?></span>
            <span class="address-label" style="display:block;"><?= $customer->city . ', ' . $customer->state . ', ' . $customer->zip_code; ?></span>
        </li> 
    </ul>    
</label>
<label class="content-title" style="cursor: pointer;margin-bottom: 4px;margin-top: 5px;">
    <i class="bx bxs-phone"></i> Contact Number : <?= $customer->phone_m != '' ? $customer->phone_m : '---'; ?>
</label>
</div>
