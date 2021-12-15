<tr class="accordion_content">
    <td colspan="7">
        <div class="row" style="padding-left: 45px;">
            <div class="col-md-12 form-group">
                <input type="radio" name="method" class="payment_method" value="CC" checked id="CC">
                <label >Categorize</label> &nbsp;&nbsp;

                <input type="radio" name="method1" class="payment_method" value="CASH" id="CASH">
                <label >Find Match</label> &nbsp;&nbsp;

                <input type="radio" name="method2"  class="payment_method" value="CHECK" id="CHECK">
                <label >Record as Transfer</label> &nbsp;&nbsp;

                <input type="radio" name="method3" class="payment_method" value="ACH" id="ACH">
                <label >Record as credit card payment</label> &nbsp;&nbsp;
            </div>
            <div class="col-md-12">
                <div id="categorize">
                    <form method="post" id="stripe_form" class="row">
                        <div class="col-md-3">
                            <label for="">Vendor/Customer</label><br>
                            <select name="customer" id="" class="form_select vendor-customer">
                                <option value="0">None</option>
                                <option value="PT5M">5 minutes before</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Category</label><br>
                            <select name="customer" id="" class="form_select category">
                                <option value="0">None</option>
                                <option value="PT5M">5 minutes before</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Customer/project</label><br>
                            <select name="customer" id="" class="form_select project">
                                <option value="0">None</option>
                                <option value="PT5M">5 minutes before</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <br><br>
                            <input type="checkbox" name="method" class="" value="CC" id="is_billable">
                            <label for="is_billable">Billable</label>
                        </div>

                        <div class="col-md-6">
                            <label for="">Tags</label><br>
                            <select name="customer" id="" class="form_select tags_select">
                                <option value="0">None</option>
                                <option value="PT5M">5 minutes before</option>
                            </select>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <label for="">Memo</label><br>
                            <input type="text" name="id" class="form-control" id="jobid" >
                            <br>
                        </div>
                        <div class="col-md-6"></div>

                        <div class="col-md-12 modal-footer">
                            <button type="button" class="btn btn-default ">Split</button>
                            <button type="submit" class="btn btn-success " id="">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </td>
</tr>