<style>
.inquiry-details td.td-label{
    background-color:#6c757d; 
    color:#ffffff;
    width: 200px;
}
.inquiry-label{
    background-color:#32243d;
    font-size: 14px;
    padding: 10px;
    color: #ffffff;
}
</style>
<div class="row" style="max-height:600px;overflow: auto;">
    <div class="col-12">
        <h3 class="inquiry-label">Booking Info</h3>
        <table class="table inquiry-details">
            <tr>
                <td class="td-label">Name</td>
                <td><?php echo $inquiry->name; ?></td>
            </tr>
            <tr>
                <td class="td-label">Phone</td>
                <td><?php echo $inquiry->phone; ?></td>
            </tr>
            <tr>
                <td class="td-label">Email</td>
                <td><?php echo $inquiry->email; ?></td>
            </tr>
            <tr>
                <td class="td-label">Status</td>
                <td>
                    <?php 
                        $status = "";
                        if($inquiry->status == 1) {
                            $status = "<span class='badge badge-info' style='width:23%;'>New</span>";
                        }elseif($inquiry->status == 2) {
                            $status = "<span class='badge badge-success' style='width:23%;'>Contacted</span>";
                        }elseif($inquiry->status == 3) {
                            $status = "<span class='badge badge-success' style='width:23%;'>Follow Up</span>";
                        }elseif($inquiry->status == 4) {
                            $status = "<span class='badge badge-success' style='width:23%;'>Assigned</span>";
                        }elseif($inquiry->status == 5) {
                            $status = "<span class='badge badge-warning' style='width:23%;'>Closed</span>";
                        }

                        echo $status;
                    ?>
                </td>
            </tr>
            <tr>
                <td class="td-label">How did you hear about us</td>
                <td><?php echo $inquiry->how_did_you_hear_about_us; ?></td>
            </tr>
            <tr>
                <td class="td-label">Preferred time to contact</td>
                <td>
                    <?php 
                        switch ($inquiry->preferred_time_to_contact) {
                            case 0:
                                echo 'Any time';
                                break;
                            case 1:
                                echo '7am to 10am';
                                break;
                            case 2:
                                echo '10am to Noon';
                                break;
                            case 3:
                                echo 'Noon to 4pm';
                                break;
                            case 4:
                                echo '4pm to 7pm';
                                break;
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="td-label" colspan="2">Address</td>
            </tr>
            <tr>
                <td colspan="2"><?php echo $inquiry->address; ?></td>
            </tr>
            <tr>
                <td class="td-label" colspan="2">Message</td>
            </tr>
            <tr>
                <td colspan="2"><?php echo $inquiry->message; ?></td>
            </tr>
        </table>
        <h3 class="inquiry-label">Booking Items</h3>
        <table class="table inquiry-details">
            <tr>
                <td class="td-label">Schedule Date / Time</td>
                <td>
                    <?php 
                        echo date("F d, Y", strtotime($inquiry->schedule_date)) . ' : ' . $inquiry->schedule_time_from . ' to ' . $inquiry->schedule_time_to; 
                    ?>
                </td>
            </tr>
            <tr>
                <td class="td-label">Subtotal Amount</td>
                <td><?php echo number_format($inquiry->subtotal_amount,2); ?></td>
            </tr>
            <tr>
                <td class="td-label">Discounted Amount</td>
                <td><?php echo number_format($inquiry->discounted_amount,2); ?></td>
            </tr>
            <tr>
                <td class="td-label">Total Amount</td>
                <td><?php echo number_format($inquiry->total_amount,2); ?></td>
            </tr>
        </table>
        <table class="table table-hover">
            <thead>
                <tr class="row-header">
                    <th style="width:60%;">Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>                    
                </tr>
            </thead>
            <tbody>
                <?php foreach($bookingItems as $bi){ ?>
                    <?php 
                        $total_amount = $bi->price * $bi->quantity_ordered;
                    ?>
                    <tr>
                        <td><?php echo $bi->item_name; ?></td>
                        <td><?php echo number_format($bi->item_price,2) . '/'. $bi->item_unit; ?></td>
                        <td><?php echo $bi->quantity_ordered; ?></td>
                        <td><?php echo number_format($bi->total_amount, 2); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>