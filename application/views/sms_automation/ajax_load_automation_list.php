<div class="row">
    <div class="col-xl-12 col-md-12">
        <table id="dataTableAutomation">
            <thead>
                <tr>
                    <th>Automation Name</th>
                    <th>Event</th>
                    <th>Details</th>
                    <th>Texts</th>           
                    <th>Active</th>
                    <th></th>            
                </tr>
            </thead>
            <tbody>
                <?php foreach($smsAutomation as $s){ ?>
                    <tr>
                        <td><?= $s->automation_name; ?></td>
                        <td><?= $optionRuleEvent[$s->rule_event]; ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>