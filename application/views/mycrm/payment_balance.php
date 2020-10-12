<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.hide {
    display:none;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/mycrm'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
    <div class="container-page">
    <div class="container-fluid">

<h1>Payments Balance</h1>
<p class="margin-bottom-sec">
    View details about due and paid payments, and other transactions associated with your account.
    Your current balance shows the difference between how much you've accrued in due payments and how much you've paid.
</p>
<div class="margin-bottom">
    <div class="row">
        <div class="col-sm-12">
            <div class="balance-label">Current Balance</div>
            <span class="balance-sums">$0.00</span>
        </div>
    </div>
</div>
<div class="card">
<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th style="width: 30%">Date</th>
            <th>Description</th>
            <th class="text-right">Amount</th>
        </tr>
    </thead>
    <tbody>
                <tr>
            <td>37620</td>
            <td>2020-09-15 00:01:51</td>
            <td>
                Paid order #19800 ($44.95)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/19800">view</a>
                            </td>
            <td class="text-right">
                                $44.95                            </td>
        </tr>
                <tr>
            <td>37619</td>
            <td>2020-09-15 00:01:51</td>
            <td>
                Payment due for order #19800 ($44.95)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/19800">view</a>
                            </td>
            <td class="text-right">
                                -$44.95                            </td>
        </tr>
                <tr>
            <td>35444</td>
            <td>2020-08-23 21:08:28</td>
            <td>
                Paid order #18555 ($5.00)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/18555">view</a>
                            </td>
            <td class="text-right">
                                $5.00                            </td>
        </tr>
                <tr>
            <td>35443</td>
            <td>2020-08-23 21:08:28</td>
            <td>
                Payment due for order #18555 ($5.00)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/18555">view</a>
                            </td>
            <td class="text-right">
                                -$5.00                            </td>
        </tr>
                <tr>
            <td>34688</td>
            <td>2020-08-15 00:01:44</td>
            <td>
                Paid order #18105 ($44.95)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/18105">view</a>
                            </td>
            <td class="text-right">
                                $44.95                            </td>
        </tr>
                <tr>
            <td>34687</td>
            <td>2020-08-15 00:01:44</td>
            <td>
                Payment due for order #18105 ($44.95)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/18105">view</a>
                            </td>
            <td class="text-right">
                                -$44.95                            </td>
        </tr>
                <tr>
            <td>31914</td>
            <td>2020-07-15 00:01:48</td>
            <td>
                Paid order #16514 ($44.95)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/16514">view</a>
                            </td>
            <td class="text-right">
                                $44.95                            </td>
        </tr>
                <tr>
            <td>31913</td>
            <td>2020-07-15 00:01:48</td>
            <td>
                Payment due for order #16514 ($44.95)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/16514">view</a>
                            </td>
            <td class="text-right">
                                -$44.95                            </td>
        </tr>
                <tr>
            <td>30654</td>
            <td>2020-07-01 20:21:28</td>
            <td>
                Paid order #15823 ($5.00)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/15823">view</a>
                            </td>
            <td class="text-right">
                                $5.00                            </td>
        </tr>
                <tr>
            <td>30653</td>
            <td>2020-07-01 20:21:28</td>
            <td>
                Payment due for order #15823 ($5.00)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/15823">view</a>
                            </td>
            <td class="text-right">
                                -$5.00                            </td>
        </tr>
                <tr>
            <td>30432</td>
            <td>2020-06-29 18:43:01</td>
            <td>
                Paid order #15702 ($5.00)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/15702">view</a>
                            </td>
            <td class="text-right">
                                $5.00                            </td>
        </tr>
                <tr>
            <td>30431</td>
            <td>2020-06-29 18:43:01</td>
            <td>
                Payment due for order #15702 ($5.00)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/15702">view</a>
                            </td>
            <td class="text-right">
                                -$5.00                            </td>
        </tr>
                <tr>
            <td>30430</td>
            <td>2020-06-29 18:42:23</td>
            <td>
                Paid order #15701 ($10.00)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/15701">view</a>
                            </td>
            <td class="text-right">
                                $10.00                            </td>
        </tr>
                <tr>
            <td>30429</td>
            <td>2020-06-29 18:42:23</td>
            <td>
                Payment due for order #15701 ($10.00)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/15701">view</a>
                            </td>
            <td class="text-right">
                                -$10.00                            </td>
        </tr>
                <tr>
            <td>29290</td>
            <td>2020-06-15 00:01:47</td>
            <td>
                Paid order #15072 ($39.95)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/15072">view</a>
                            </td>
            <td class="text-right">
                                $39.95                            </td>
        </tr>
                <tr>
            <td>29289</td>
            <td>2020-06-15 00:01:47</td>
            <td>
                Payment due for order #15072 ($39.95)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/15072">view</a>
                            </td>
            <td class="text-right">
                                -$39.95                            </td>
        </tr>
                <tr>
            <td>26818</td>
            <td>2020-05-15 00:01:48</td>
            <td>
                Paid order #13682 ($39.95)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/13682">view</a>
                            </td>
            <td class="text-right">
                                $39.95                            </td>
        </tr>
                <tr>
            <td>26817</td>
            <td>2020-05-15 00:01:48</td>
            <td>
                Payment due for order #13682 ($39.95)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/13682">view</a>
                            </td>
            <td class="text-right">
                                -$39.95                            </td>
        </tr>
                <tr>
            <td>24588</td>
            <td>2020-04-15 00:01:49</td>
            <td>
                Paid order #12463 ($39.95)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/12463">view</a>
                            </td>
            <td class="text-right">
                                $39.95                            </td>
        </tr>
                <tr>
            <td>24587</td>
            <td>2020-04-15 00:01:49</td>
            <td>
                Payment due for order #12463 ($39.95)                                &nbsp; <span class="middot">·</span> <a class="a-ter" href="https://www.markate.com/pro/account/orders/view/id/12463">view</a>
                            </td>
            <td class="text-right">
                                -$39.95                            </td>
        </tr>
            </tbody>
</table>
</div>
<div class="row pagination-container">
	<div class="col-md-6"><ul class="pagination"><li class="active"><span>1</span></li><li><a data-page="2" href="https://www.markate.com/pro/account/balance/index?page=2" title=" Jump to 2 page "> 2 </a></li><li><a data-page="2" href="https://www.markate.com/pro/account/balance/index?page=2" title=" Next ">Next »</a></li></ul></div>
    <div class="col-md-6 text-right"><span class="pagination-page-of">Page <b>1</b> of <b>2</b></span></div>
</div>
    </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>