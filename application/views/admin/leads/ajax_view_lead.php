<table class="table">
    <tr>
        <td>Company</td>
        <td><?= $lead->business_name; ?></td>
    </tr>
    <tr>
        <td>Lead Type</td>
        <td><?= $lead->lead_type; ?></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><?= $lead->firstname . ' ' . $lead->lastname; ?></td>
    </tr>
    <tr>
        <td>Phone Home</td>
        <td><?= $lead->phone_home; ?></td>
    </tr>
    <tr>
        <td>Mobile Number</td>
        <td><?= $lead->phone_cell; ?></td>
    </tr>
    <tr>
        <td>Country</td>
        <td><?= $lead->country; ?></td>
    </tr>
    <tr>
        <td>State</td>
        <td><?= $lead->state; ?></td>
    </tr>
    <tr>
        <td>Zip</td>
        <td><?= $lead->zip; ?></td>
    </tr>
</table>