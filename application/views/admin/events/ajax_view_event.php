<style>
.bold{
    font-weight: bold;
}
.table-label{
    width: 137px;
}
.event-header{
    font-size: 15px;
    background-color: #cccccc;
    padding: 5px;
    margin-bottom: 10px;
    clear: both;
    font-weight: bold;
}
</style>
<?php if($company_info->business_image != "" ): ?>
    <img style="width: 141px; float: right; margin-bottom: 28px;" alt="Company Logo" src="<?= base_url('uploads/users/business_profile/'.$company_info->id.'/'.$company_info->business_image); ?> ">
<?php endif; ?>
<p class="event-header">Event Details</p>
<table class="table table-bordered">
<tr>
    <td class="bold table-label">Company Name</td>
    <td colspan=""><?= $company_info->business_name; ?></td>    
    <td class="bold table-label">Customer</td>
    <td colspan=""><?= $event->first_name . ' ' . $event->last_name; ?></td>    
</tr>
<tr>
    <td class="bold table-label">Event Number</td>
    <td><?= $event->event_number; ?></td>
    <td class="bold table-label">Description</td>
    <td><?= $event->event_description; ?></td>
</tr>
<tr>
    <td class="bold table-label">Event Type</td>
    <td><?= $event->event_type; ?></td>
    <td class="bold table-label">Event Tags</td>
    <td><?= $event->event_tag; ?></td>
</tr>
<!-- <tr><td colspan="4" style="background-color: #6a4a86;"></td></tr> -->
<tr>
    <td class="bold table-label">Start Date</td>
    <td><?= date('F g, Y g:i A',strtotime($event->start_date . ' ' .  $event->start_time)); ?></td>
    <td class="bold table-label">End Date</td>
    <td><?= date('F g, Y g:i A',strtotime($event->end_date . ' ' .  $event->end_time)); ?></td>
</tr>
<tr>
    <td class="bold table-label">Address</td>
    <td><?= $event->event_address . ' ' . $event->event_zip_code; ?></td>
    <td class="bold table-label">Status</td>
    <td><?= $event->status; ?></td>
</tr>
</table>
<p class="event-header">Event Items</p>
<table class="table table-bordered">
    <thead>
        <tr>
            <td>Items</td>
            <td>Qty</td>
            <td>Price</td>
            <td>Total</td>
        </tr>
    </thead>
    <tbody>
        <?php
            $subtotal = 0.00;
            foreach ($event_items as $item):
            $total = $item->price * $item->qty;
        ?>
            <tr>
                <td><?= $item->title; ?></td>
                <td><?= $item->qty; ?></td>
                <td>$<?= $item->price; ?></td>
                <td>$<?= number_format((float)$total,2,'.',','); ?></td>
            </tr>
    <?php
        $subtotal = $subtotal + $total;
        endforeach;
    ?>
    </tbody>
</table>
<hr>
<b>Sub Total</b>
<b class="right-text">$<?= number_format((float)$subtotal,2,'.',','); ?></b>
<br><hr>

<?php if($event->tax != NULL): ?>
    <b>Tax </b>
    <i class="right-text">$0.00</i>
    <br><hr>
<?php endif; ?>

<?php if($event->discount != NULL): ?>
    <b>Discount </b>
    <i class="right-text">$0.00</i>
    <br><hr>
<?php endif; ?>

<b>Grand Total</b>
<b class="right-text">$<?= number_format((float)$subtotal,2,'.',','); ?></b>