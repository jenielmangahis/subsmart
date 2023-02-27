<table id="JOB_LIST_TABLE" class="nsm-table w-100">
    <thead>
        <tr>
            <td class="table-icon"></td>
            <td data-name="Payment Method">Payment Method</td>            
            <td data-name="Amount" style="width:10%;">Amount</td>
            <td data-name="Date Created" style="width:10%;">Date</td>
            <!-- <td data-name="Manage" style="width:10%;"></td> -->
        </tr>
    </thead>
    <tbody>
        <?php foreach($jobPayments as $jp){ ?>
            <tr>
                <td><div class="table-row-icon"><i class='bx bx-receipt'></i></div></td>
                <td><?= $jp->payment_method; ?></td>
                <td><?= number_format($jp->amount,2); ?></td>
                <td><?= date('m/d/Y', strtotime($jp->date_created)); ?></td>
                <!-- <td></td> -->
            </tr>
        <?php } ?>
    </tbody>
</table>