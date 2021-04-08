<h6 class="text-center"><strong>Activity Logs</strong></h6>

<table class="table table-responsive-sm table-striped">
    <thead>
        <tr>
            <th>Logs</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($activity_logs as $logs): ?>
        <tr>
            <td class="text-left"><small><strong><?= strtoupper($logs->activityName) ?></strong></small><br /><?= $logs->activity ?></td>
            <td><?= date('F d, Y g:i:s', strtotime($logs->createdAt)) ?></td>
        </tr>
        
        <?php endforeach; ?>
    </tbody>
</table>