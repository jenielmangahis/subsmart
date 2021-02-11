<div class="col-lg-3 col-md-6 col-sm-12"  id="widget_<?= $id ?>">
    <div class="card" style="margin-top:0;">
        <div class="card-header" style="background: #40c057; color:white;">
            <i class="fa fa-money" aria-hidden="true"></i> Bank Accounts

            <div class="registerLink float-right">
                <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                    <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                        &nbsp;<span class="fa fa-ellipsis-v"></span></span>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#" class="dropdown-item">Corporate Account (XXXXXX 5850)</a></li>
                        <li><a href="#" class="dropdown-item">Cash on hand</a></li>
                        <li><a href="#" class="dropdown-item">Corporate Account (XXXXXX 5850)Te</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row" id="bankBody" style="height: 310px; overflow-y: scroll;">
                <div class="bankList col-lg-12">
                    <div class="dgrid-row connectedAccount">
                        <div class="bankAccountRowLink bankAccountRow">
                            <div class="bankRow">
                                <div class="bankRowHeader">
                                    <div class="qboNameHeader">
                                        <div class="qboName">Corporate Account (XXXXXX 5850)</div>
                                    </div>
                                    <div class="headerMessage">
                                        <div class="pendingTxns">11 to review</div>
                                    </div>
                                </div>
                                <div class="bankRowDetail">
                                    <div class="description">
                                        <div class="balanceDescription">Bank balance</div>
                                        <div class="nsBalanceDescription">In nSmartrac</div>
                                    </div>
                                    <div class="accountDetails">
                                        <div class="balance">
                                            <div class="bankBalance">$5,741.11</div>
                                            <div class="nsBalance">$-7,049.40</div>
                                        </div>
                                        <div class="count">
                                            <div class="lastUpdated line-clamp ml-3">Updated 1 day ago</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dgrid-row">
                        <div class="bankAccountRowLink bankAccountRow">
                            <div class="bankRow">
                                <div class="bankRowHeader">
                                    <div class="qboNameHeader">
                                        <div class="qboName">Cash on hand</div>
                                    </div>
                                    <div class="headerMessage">
                                        <div class="pendingTxns"></div>
                                    </div>
                                </div>
                                <div class="bankRowDetail">
                                    <div class="description">
                                        <div class="nsBalanceDescription">In nSmartrac</div>
                                    </div>
                                    <div class="accountDetails">
                                        <div class="count">
                                            <div class="bankBalance" style="display: none">$0</div>
                                            <div class="nsBalance">$111,101.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dgrid-row">
                        <div class="bankAccountRowLink bankAccountRow">
                            <div class="bankRow">
                                <div class="bankRowHeader">
                                    <div class="qboNameHeader">
                                        <div class="qboName">Corporate Account (XXXXXX 5850)Te</div>
                                    </div>
                                    <div class="headerMessage">
                                        <div class="pendingTxns"></div>
                                    </div>
                                </div>
                                <div class="bankRowDetail">
                                    <div class="description">
                                        <div class="nsBalanceDescription">In nSmartrac</div>
                                    </div>
                                    <div class="accountDetails">
                                        <div class="count">
                                            <div class="bankBalance" style="display: none">$0</div>
                                            <div class="nsBalance">$0</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-left">
                <a class="text-info text-left" href="<?= base_url() ?>job">Connect Accounts</a>
            </div>

        </div>

    </div>
</div>

