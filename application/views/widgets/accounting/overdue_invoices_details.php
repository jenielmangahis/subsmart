<table class="table table-bordered table-striped table-responsive">
    <thead>
        <tr>
            <th>Invoice #</th>
            <th>Description</th>
            <th>Amount Due</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($invoices as $invoice):
        ?>
        <tr>
            <td><strong><?= $invoice->invoice_number ?></strong><br /><small class="text-success"><?= $invoice->first_name.' '.$invoice->last_name ?></small></td>
            <td>Draft</td>
            <td class="text-danger">$ <?= number_format($invoice->total_due,2,'.',',') ?></td>
        </tr>
        <?php
            endforeach;
        ?>
    </tbody>
</table>