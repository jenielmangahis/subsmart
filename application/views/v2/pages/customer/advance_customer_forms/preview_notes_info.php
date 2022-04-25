<div class="nsm-card">
    <div class="nsm-card-content">
        <div class="row mb-3">
            <div class="col-12">
                <div class="nsm-card-title">
                    <span>Existing Notes</span>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-12">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td colspan="2" data-name="Notes">Notes</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($customer_notes)) : ?>
                            <?php foreach ($customer_notes as $note) : ?>
                                <tr>
                                    <td class="fw-bold nsm-text-primary"><?= $note->note; ?></td>
                                    <td style="text-align: right;"><?= $note->datetime; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td>
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="col-12">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Name">Name</td>
                            <td data-name="Points">Points</td>
                            <td data-name="Purchase Price">Purchase Price</td>
                            <td data-name="Qty">Qty</td>
                            <td data-name="Total">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($jobs_data_items)) :
                            $subtotal = 0.00;
                        ?>
                            <?php
                            foreach ($jobs_data_items as $item) :
                                $total = $item->price * $item->qty;
                            ?>
                                <tr>
                                    <td class="fw-bold nsm-text-primary"><?= $item->title; ?></td>
                                    <td>0</td>
                                    <td>$<?= $item->price; ?></td>
                                    <td><?= $item->qty; ?></td>
                                    <td>$<?= number_format((float)$total, 2, '.', ','); ?></td>
                                </tr>
                            <?php
                                $subtotal = $subtotal + $total;
                            endforeach;
                            ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>