<style>
.modules-list{
    list-style: none;
}
.modules-list li{
    display: inline-block;
    width: 46%;
    background-color: #DDDDDD;
    margin: 8px;
    padding: 10px;
    box-shadow: 10px 5px 8px #888888;
}
</style>
<h3 style="color:#ffffff;background-color: #5699D2;font-size: 15px; padding: 10px;">SUBSCRIBER DETAILS</h3>
<table class="table table-hover">
    <tr>
        <td style="width: 30%;">Name</td>
        <td>: <?= $subscriber->first_name . ' ' . $subscriber->last_name; ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td>: <?= $subscriber->email_address; ?></td>
    </tr>
    <tr>
        <td>Phone Number</td>
        <td>: <?= $subscriber->phone_number; ?></td>
    </tr>
    <tr>
        <td>Business Name</td>
        <td>: <?= $subscriber->business_name; ?></td>
    </tr>
    <tr>
        <td>Business Address</td>
        <td>: <?= $subscriber->business_address; ?></td>
    </tr>
    <tr>
        <td>Number of Employees</td>
        <td>: <?= $subscriber->number_of_employee; ?></td>
    </tr>
    <tr>
        <td>Plan Name</td>
        <td>: <?= $subscriber->plan_name; ?> / $<?= $subscriber->price; ?> Subscription</td>
    </tr>
    <tr>
        <td>Industry Type</td>
        <td>: <?= $subscriber->industry_type_name; ?></td>
    </tr>
    <tr>
        <td>Status</td>
        <td>: 
            <?php 
                $status = "-";
                if( $subscriber->is_plan_active == 1 ){
                    $cell = 'cell-active';
                    $status = "Active";
                }else{
                    $cell = 'cell-inactive';
                    $status = "Expire";
                }
            ?>
            <span class="<?= $cell; ?>" style="padding: 10px; color:#ffffff;display: inline-block;"><?= $status; ?></span>
        </td>
    </tr>
</table>
<h3 style="color:#ffffff;background-color: #5699D2;font-size: 15px; padding: 10px;">MODULES</h3>
<div style="height: 200px; overflow: auto; width: 100%;">
<ul class="modules-list">
    <?php foreach( $templateModules as $t ){ ?>
        <li>
            <h3 style="font-size: 15px;margin-bottom: 0px;"><?= $t->industry_module_name; ?></h3>
            <p><?= $t->industry_module_description; ?></p>
        </li>
    <?php } ?>
</ul>
</div>    
</table>
<h3 style="color:#ffffff;background-color: #5699D2;font-size: 15px; padding: 10px;">UPGRADES</h3>
<table class="table table-hover">
    <?php foreach( $upgrades as $u ){ ?>
        <tr>
            <td colspan="2">
                <h3 style="font-size: 15px;margin-bottom: 0px;"><?= $u->name; ?></h3>
                <p><?= $u->description; ?></p>
            </td>
        </tr>

    <?php } ?>
</table>