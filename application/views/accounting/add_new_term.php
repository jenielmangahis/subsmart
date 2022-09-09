<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog"  id="modal-dialog2" role="document" style="width:500px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align:left;">New Term</h5>
        <button name="button" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
            <?php echo form_open_multipart('accounting/add_terms', ['class' => 'form-validate require-validation', 'id' => 'invoice_form', 'autocomplete' => 'off']); ?>
            <div class="modal-body">

                  <table>
                    <tr>
                      <td><b>Name</b></td>
                    </tr>
                    <tr>
                      <td><input type="text" name="name" id="name" class="form-control"> </td>
                      <td></td>
                    </tr>
                </table>
                <br><br>
                <table>
                    <tr>
                      <td><input class="form-check-input" type="radio" name="type" id="type1" value="1" checked> Due in fixed number of days</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><input type="number" class="form-control" id="net_due_days" name="net_due_days"></td>
                      <td><b style="">&emsp;days</b></td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr>
                      <td><input class="form-check-input" type="radio" name="type" id="type2" value="2"> Due by certain day of the month</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><input type="number" class="form-control" id="day_of_month_due" name="day_of_month_due" disabled></td>
                      <td><b style="">&emsp;day of month</b></td>
                    </tr>
                </table>
                <br>
                <table>
                    <tr>
                      <td>Due the next month if issued within</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><input type="number" class="form-control" id="minimum_days_to_pay" name="minimum_days_to_pay" disabled></td>
                      <td><b style="">&emsp;days of due date</b></td>
                    </tr>
                </table>
                
              
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-primary">Save</button> -->
              <input type="submit" value="Save" class="btn btn-primary">
            </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="update_tc" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align:left;">Update Terms and Conditions</h5>
        <button name="button" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="row">
            <div class="col-md-12">
                <textarea name="update_tc" class="form-control" style="height:300px;">2. Install of the system. Company agrees to schedule and install an alarm system and/or devices in connection with a Monitoring Agreement which customer will receive at the time of installation. Customer hereby agrees to buy the system/devices described below and incorporated herein for all purposes by this reference (the “System /Services”), in accordance with the terms and conditions set forth. IF CUSTOMER FAIL TO FULLFILL THE MONITORING AGREEMENT, Customer agrees to pay the consultation fee, the cost of the system and recovering fees.

                3. Customer agrees to have system maintained for an initial term of 60 months at the above monthly rate in exchange for a reduced cost of the system. Upon the execution of this agreement shall automatically start the billing process. Customer understands that the monthly payments must be paid through “Direct Billing” through their banking institution or credit card. Customers acknowledge that they authorize Company to obtain a Security System. Residential Clients: CUSTOMER HAS THE RIGHT TO CANCEL THIS TRANSACTION at any time prior to midnight on the 3rd business day after the above date of this work order in writing. Customer agrees that no verbal method is valid, and must be submitted only in writing. The date on this agreement is the agreed upon date for both the Company and the Customer

                4. Client verifies that they are owners of the property listed above. In the event the system has to be removed, Client agrees and understands that there will be an additional $299.00 restocking/removal fee and early termination fees will apply.

                5. Client understands that this is a new Monitoring Agreement through our central station. Alarm.com or .net is not affiliated nor has any bearing on the current monitoring services currently or previously initiated by Client with other alarm companies. By signing this work order, Client agrees and understands that they have read the above requirements and would like to take advantage of our services. Client understand that is a binding agreement for both party.

                6. Customer agrees that the system is preprogramed for each specific location. accordance with the terms and conditions set forth. IF CUSTOMER FAIL TO FULLFILL THE MONITORING AGREEMENT, Customer agrees to pay the consultation fee, the cost of the system and recovering fees. Customer agrees that this is a customized order. By signing this workorder, customer agrees that customized order can not be cancelled after three day of this signed document.</textarea>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12" align="center">
              <input type="submit" value="Update" class="btn btn-warning">
              </div>
          </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save</button>
      </div> -->
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="update_TU" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align:left;">Update Terms of Use</h5>
        <button name="button" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="row">
            <div class="col-md-12">
                <textarea name="update_tc" class="form-control" style="height:300px;">
                **This isn't everything... just a summary** You may CANCEL this transaction, within THREE BUSINESS DAYS from the above date. If You cancel, You must make available to US in substantially as good condition as when received, any goods delivered to You under this contract or sale, You may, if You wish, comply with Our instructions regarding the return shipment of the goods at Your expense and risk. To cancel this transaction, mail deliver a signed and postmarket, dated copy of this Notice of Cancellation or any other written notice to ALarm Direct, Inc., 6866 Pine Forest ROad, Suite B, Pensacola, FL 32526. NOT LATER THAN MIDNIGHT OF {Date plus 3 business days}</textarea>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12" align="center">
              <input type="submit" value="Update" class="btn btn-warning">
              </div>
          </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save</button>
      </div> -->
    </div>
  </div>
</div>

<script>
$('input[name="type"]').on('change', function() {
    if($(this).val() === "1" || $(this).val() === 1) {
        $('#net_due_days').prop('disabled', false);

        $('#day_of_month_due, #minimum_days_to_pay').prop('disabled', true);
        $('#day_of_month_due, #minimum_days_to_pay').val('');
    } else if($(this).val() === "2" || $(this).val() === 2) {
        $('#net_due_days').prop('disabled', true);
        $('#net_due_days').val('');

        $('#day_of_month_due, #minimum_days_to_pay').prop('disabled', false);
    }
});
</script>