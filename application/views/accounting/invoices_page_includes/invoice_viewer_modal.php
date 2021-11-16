<div id="invoice-viewer-modal">
    <div class="the-modal-body right-side-modal">
        <div class="the-title">Invoice <span class="invoice-number">11001</span></div>
        <div class="the-close">x</div>
        <div class="status-section">
            <div class="status-icon success"><i class="fa fa-check-circle" aria-hidden="true"></i></div>
            <div class="status-text">Paid (Deposited)</div>
        </div>
        <div class="total-amount-section">
            <div class="label">Total</div>
            <div class="amount">$1.08</div>
        </div>
        <div class="invoice-info invoice-date">
            <div class="label">Invoice date</div>
            <div class="date">1/28/2021</div>
        </div>
        <div class="invoice-info due-date">
            <div class="label">Due date</div>
            <div class="date">2/28/2021</div>
        </div>
        <div class="section-loader">
            <img
                src="<?=base_url("assets/img/accounting/customers/loader.gif")?>">
        </div>
        <div class="section hidden">
            <div class="title">
                <span class="customer-name">Lou Pinton</span>
                <span class="icon"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
            </div>
            <div class="section-content ">
                <div class="email">pintonlou@gmail.com</div>
            </div>
        </div>
        <div class="section shown">
            <div class="title">
                <span class="normal">Invoice activity</span>
                <span class="icon"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
            </div>
            <div class="section-content ">
                <ul class="status-tracker">
                    <div class="status-marker next-completed">
                        <div class="line"></div>
                    </div>
                    <li class="status-step completed">
                        <div class="status-marker completed next-completed">
                            <div class="circle default"></div>
                            <div class="line"></div>
                        </div>
                        <div class="status-info">
                            <div class="status-title">Opened</div>
                            <div class="status-event-info">
                                <div><span class="status-date">1/28/2021</span></div>
                                <div></div>
                            </div>
                        </div>
                    </li>
                    <li class="status-step completed">
                        <div class="status-marker completed next-completed">
                            <div class="circle default"></div>
                            <div class="line"></div>
                        </div>
                        <div class="status-info">
                            <div class="status-title">Paid</div>
                            <div class="status-event-info">
                                <div><span class="status-date">2/1/2021</span></div>
                                <div><span><span class="money">$1.08</span></span></div><a tabindex="0"
                                    class="action-button">View payment #2674</a>
                            </div>
                        </div>
                    </li>
                    <li class="status-step completed">
                        <div class="status-marker completed">
                            <div class="circle default last-active-status"></div>
                        </div>
                        <div class="status-info">
                            <div class="status-title">Deposited</div>
                            <div class="status-event-info">
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="the-modal-footer">
            <div class="the-modal-footer-container">

                <div class="section hidden">
                    <div class="title">
                        <span class="normal">Products and services</span>
                        <span class="icon"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                    </div>
                    <div class="section-content ">
                        <div class="items">
                            <div class="item"><span class="title">Sales</span><span class="price">$1.00</span></div>
                        </div>
                        <div class="more-description-section">
                            <div class="more-description-info">
                                this is a test product<br>
                                Taxable
                            </div>
                            <a href="#" class="show-more">More details</a>
                        </div>
                    </div>
                </div>
                <div class="buttons">
                    <div class="button-dropdown-options">
                        <span>More actions</span> <span class="float-right"><i class="fa fa-chevron-down"
                                aria-hidden="true"></i></span>
                        <ul class="options">
                            <li class="print">Print</li>
                            <li class="openCloneInvoice" tabindex="-1" href="javascript:void(0)" data-toggle="modal"
                                data-target="#cloneModal" data-invoice-number="INV-000000015" data-id="37">Duplicate
                            </li>
                            <li class="send">Send</li>
                            <li class="print-packaging" data-invoice-id="">Print packaging slip</li>
                            <li class="void" data-invoice-id="">Void</li>
                            <li class="delete" data-invoice-id="">Delete</li>
                        </ul>
                    </div>
                    <button class="edit-invoice-btn success">Edit invoice</button>
                </div>
            </div>
        </div>
    </div>
</div>