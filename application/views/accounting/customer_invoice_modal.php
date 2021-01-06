<!-- Modal for add account-->
<div class="full-screen-modal">
    <div id="addinvoiceModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Invoice</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    Customer
                                    <select class="form-control">
                                        <option></option>
                                        <option>Add New</option>
                                        <option>John Doe</option>
                                        <option>Alpha</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    Customer email
                                    <input type="text" class="form-control">
                                    <input type="checkbox"> Send later
                                </div>
                                <div class="col-md-3">
                                    Online payments<br>
                                    <input type="checkbox" checked> Cards<br>
                                    <input type="checkbox" checked> Bank Transfer
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    Billing address
                                    <textarea style="height:100px;width:100%;"></textarea>
                                </div>
                                <div class="col-md-3">
                                    Terms
                                    <select class="form-control">
                                        <option></option>
                                        <option>Add New</option>
                                        <option>John Doe</option>
                                        <option>Alpha</option>
                                    </select><br><br>
                                    Ship via<br>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    Invoice date<br>
                                    <input type="text" class="form-control"><br>
                                    Shipping date<br>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    Due date<br>
                                    <input type="text" class="form-control"><br>
                                    Tracking no.<br>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    Shipping to
                                    <textarea style="height:100px;width:100%;"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    Tags <a href="#" style="float:right">Manage tags</a>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" id="reportstable">
                                <thead>
                                    <th></th>
                                    <th>#</th>
                                    <th>PRODUCT/SERVICE</th>
                                    <th>DESCRIPTION</th>
                                    <th>QTY</th>
                                    <th>RATE</th>
                                    <th>AMOUNT</th>
                                    <th>TAX</th>
                                    <th></th>
                                </thead>
                                <tr>
                                    <td></td>
                                    <td>1</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>2</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        <div>
                    </div>
                <hr>
                
                    <div class="row">
                        <div class="col-md-1">
                           <button class="btn">Add lines</button>
                        </div>
                        <div class="col-md-1">
                           <button class="btn">Clear all lines</button>
                        </div>
                        <div class="col-md-1">
                           <button class="btn">Add subtotal</button>
                        </div>
                        <div class="col-md-7">
                        </div>
                        <div class="col-md-1">
                            <b>Subtotal</b>
                        </div>
                        <div class="col-md-1">
                            <b>$0.00</b>
                        </div>
                    </div>
                    <hr>


                    
                    <div class="container modal-container">
                        <div class="header-modal"><h3>Let's get a picture of your profits</h3></div>
                        <div class="sub-header-modal"><span>Connect your bank or credit card to bring in your transactions.</span></div>
                        <div class="body-modal">
                            <input type="text" class="form-control" placeholder="Enter your bank name or URL" style=" margin: 40px 0 50px 0;">
                            <div class=""><span>Here are some of the most popular ones</span></div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/citibank.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/chase-logo.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/bank-of-america.png') ?>" alt="">

                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/Wells_Fargo.png') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/co-1200.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/us-bank-logo-vector.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/paypal_PNG20.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="bank-img-container">
                                        <img class="banks-img" src="<?php echo base_url('assets/img/accounting/pncbank_pms_c.png') ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div style="margin: auto;">
                    <span style="font-size: 14px"><i class="fa fa-lock fa-lg" style="color: rgb(225,226,227);margin-right: 15px"></i>At nSmartrac, the privacy and security of your information are top priorities.</span>
                </div>
                <div style="margin: auto">
                    <a href="" style="text-align: center">Privacy</a>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</div>