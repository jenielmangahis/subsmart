<table class="nsm-table mt-5">                        
    <thead>
        <tr>
            <td class="table-icon" style="width:40%;">Employee</td>
            <td data-name="TotalRecords">Type</td>
            <td data-name="TotalExported">Clock In</td>
            <td data-name="TotalExported">Clock Out</td>
            <td data-name="TotalExported">Worked Hours</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($attendance_logs as $log){ ?>
            <tr>
                <td><?= $log['name']; ?></td>
                <td>Clock In-Out</td>
                <td><?= $log['checkin']; ?></td>
                <td><?= $log['checkout'] != '' ? $log['checkout'] : '---'; ?></td>
                <td><?= $log['total_hrs']; ?></td>                                            
            </tr>
        <?php } ?>                                                                        
    </tbody>
</table>