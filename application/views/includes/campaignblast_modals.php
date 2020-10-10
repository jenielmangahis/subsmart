<!-- Modal Add Campaign Blast -->
<div class="modal fade bd-example-modal-lg" id="modalAddCampaignBlast" tabindex="-1" role="dialog" aria-labelledby="modalAddCampaignBlastmTitle" aria-hidden="true">
  <?php echo form_open_multipart('campaign_blast/save_blast', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Campaign Blast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form data-form="form" method="post" action="#">
                
            <div class="card">
                <div class="row margin-bottom">
                    <div class="col-sm-18 col-xl-12">
                        <label>Campaign Name</label>
                        <input type="text" name="name" value="" class="form-control" required="">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-18 col-xl-12">
                        <label>Postcard Return Address</label>
                        <div class="help help-sm margin-bottom-sec">Complete the fields below to return the postcard if it can not be delivered.</div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Return to Name/Company</label>
                                    <input type="text" name="postcard_return_address_name" value="" id="postcard_return_address_name" class="form-control" autocomplete="off" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Address</label> <span class="help help-sm">(type in to search for address)</span>
                                    <input type="text" required="" name="postcard_return_address_address" value="" id="postcard_return_address_address" class="form-control pac-target-input" autocomplete="off" placeholder="e.g. 123 Old Oak Drive">
                                    <input name="postcard_return_address_latlng" id="postcard_return_address_latlng" type="hidden" value="">
                                </div>
                                <div class="col-sm-12">
                                    <label>Suite/Unit</label>
                                    <input type="text" name="postcard_return_address_address_secondary" value="" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-7">
                                <label>City </label>
                                <input type="text" required="" name="postcard_return_address_city" value="" id="postcard_return_address_city" class="form-control" autocomplete="off">
                            </div>
                            <div class="col-sm-5">
                                <label>Zip/Postal Code</label>
                                <input type="text" required="" name="postcard_return_address_zip" value="" id="postcard_return_address_zip" class="form-control" autocomplete="off">
                            </div>
                            <div class="col-sm-12">
                                <label>State/Province</label>
                                <select required="" name="postcard_return_address_state" id="postcard_return_address_state" class="form-control">
                                  <option value="" selected="selected">- select -</option>
                                  <option value="AK">Alaska</option>
                                  <option value="AL">Alabama</option>
                                  <option value="AR">Arkansas</option>
                                  <option value="AZ">Arizona</option>
                                  <option value="CA">California</option>
                                  <option value="CO">Colorado</option>
                                  <option value="CT">Connecticut</option>
                                  <option value="DC">District of Columbia</option>
                                  <option value="DE">Delaware</option>
                                  <option value="FL">Florida</option>
                                  <option value="GA">Georgia</option>
                                  <option value="HI">Hawaii</option>
                                  <option value="IA">Iowa</option>
                                  <option value="ID">Idaho</option>
                                  <option value="IL">Illinois</option>
                                  <option value="IN">Indiana</option>
                                  <option value="KS">Kansas</option>
                                  <option value="KY">Kentucky</option>
                                  <option value="LA">Louisiana</option>
                                  <option value="MA">Massachusetts</option>
                                  <option value="MD">Maryland</option>
                                  <option value="ME">Maine</option>
                                  <option value="MI">Michigan</option>
                                  <option value="MN">Minnesota</option>
                                  <option value="MO">Missouri</option>
                                  <option value="MS">Mississippi</option>
                                  <option value="MT">Montana</option>
                                  <option value="NC">North Carolina</option>
                                  <option value="ND">North Dakota</option>
                                  <option value="NE">Nebraska</option>
                                  <option value="NH">New Hampshire</option>
                                  <option value="NJ">New Jersey</option>
                                  <option value="NM">New Mexico</option>
                                  <option value="NV">Nevada</option>
                                  <option value="NY">New York</option>
                                  <option value="OH">Ohio</option>
                                  <option value="OK">Oklahoma</option>
                                  <option value="OR">Oregon</option>
                                  <option value="PA">Pennsylvania</option>
                                  <option value="RI">Rhode Island</option>
                                  <option value="SC">South Carolina</option>
                                  <option value="SD">South Dakota</option>
                                  <option value="TN">Tennessee</option>
                                  <option value="TX">Texas</option>
                                  <option value="UT">Utah</option>
                                  <option value="VA">Virginia</option>
                                  <option value="VT">Vermont</option>
                                  <option value="WA">Washington</option>
                                  <option value="WI">Wisconsin</option>
                                  <option value="WV">West Virginia</option>
                                  <option value="WY">Wyoming</option>
                                </select>
                                <input type="hidden" name="postcard_return_address_country" value="us" id="postcard_return_address_country">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="card-hr" >
            <button type="button" style="float: right;" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save & Continue</button>            
        </form>     		
      </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
  <?php echo form_close(); ?>
</div>

<!-- Modal Delete Campaign Blast --> 
<div class="modal fade" id="modalDeleteCampaignBlast" tabindex="-1" role="dialog" aria-labelledby="modalDeleteCampaignBlastTitle" aria-hidden="true">
    <?php echo form_open_multipart('campaign_blast/delete_blast', ['class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
    <?php echo form_input(array('name' => 'tid', 'type' => 'hidden', 'value' => '', 'id' => 'tid'));?>
     <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> Delete Campaign</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Delete selected campaign blast?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-danger">Yes</button>
          </div>
        </div>
      </div>
  <?php echo form_close(); ?>
</div>
