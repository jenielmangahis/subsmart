<table class="table">
    <tr><td><i class="fa fa-user"></i> Name : <?php echo $inquiry->name; ?></td><td><i class="fa fa-envelope"></i> Email : <?php echo $inquiry->email; ?></td></tr>
    <tr><td><i class="fa fa-phone"></i> Phone : <?php echo $inquiry->phone; ?></td><td><i class="fa fa-map-marker"></i> Address : <?php echo $inquiry->address; ?></td></tr>
    <tr><td><i class="fa fa-calendar"></i> Preferred time to contact : <?php echo $inquiry->preferred_time_to_contact; ?></td><td><i class="fa fa-info"></i> How did you hear from us : <?php echo $inquiry->how_did_you_hear_about_us; ?></td></tr>
    <tr></tr>    
    <tr><td colspan="2"><i class="fa fa-list"></i> Message : <?php echo $inquiry->message; ?></td></tr>
</table>