<!-- Modal for add account-->

<div class="full-screen-modal">
    <div id="customer_type_modal" class="modal fade modal-fluid" role="dialog">
        <div id="new-customer-type-popup">
            <div class="the-body">
                <div class="modal-title">
                    <h2>New customer type</h2>
                </div>
                <form id="customer_type_form">
                    <input type="text" class="form-control" name="customer-type-id" style="display: none;">
                    <div class=" new-customer-type-modal-content">
                        <div class="form-group">
                            <input type="text" class="form-control" name="customer_type" required>
                        </div>
                    </div>
                    <div class="select_customer_type_modal-footer">
                        <button class="btn btn-default float-left cancel-btn" type="button">
                            Cancel
                        </button>
                        <button class="btn btn-success float-right" type="submit">
                            Save
                        </button>
                    </div>

                </form>
            </div>
        </div>
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        Customer Types
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                            class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body" style="height:calc(100vh - 133px);">
                
                <div class="btn-section">
                    <button class="btn btn-success float-right new-customer-type-btn" type="submit">
                        New customer type
                    </button>
                </div>
                <div class="table-section">
                    <div class="modal-loader">
                        <center><img src="<?=base_url("assets/img/accounting/customers/loader.gif")?>" alt=""></center>
                    </div>
                    <table class="customer_types_table table table-striped " style="display: none;">
                        <thead>
                            <tr>
                                <th>NAME</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sample Type</td>
                                <td>
                                    <a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><span class="separator"></span>
                                    <a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
                <div class="security-assurance-section">
                        <div class="texts">
                            <span><i class="fa fa-lock fa-lg" style="color: rgb(225,226,227);margin-right: 15px"></i> At
                                nSmartrac, the privacy and
                                security of your information are top priorities.</span>
                        </div>
                        <div class="privacy-link">
                            <a href="">Privacy</a>
                        </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</div>

<?php include viewPath('accounting/add_new_payment_method');
