<div class="modal fade nsm-modal fade" id="campaign_360_modal" tabindex="-1" aria-labelledby="campaign_360_modal_label" aria-hidden="true">
    <div class="modal-dialog">
        <?php echo form_open_multipart('campaign_blast/save_blast', ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="campaign_360_modal_label">Add Campaign Blast</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row gx-2">
                    <div class="col-12">
                        <input type="text" placeholder="Campaign Name" name="name" class="nsm-field form-control mb-2" required />
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12 mb-2">
                        <label class="content-title">Postcard Return Address</label>
                        <label class="content-subtitle d-block mb-2">Complete the fields below to return the postcard if it can not be delivered.</label>
                    </div>
                    <div class="col-12">
                        <input type="text" placeholder="Return to Name/Company" name="postcard_return_address_name" id="postcard_return_address_name" class="nsm-field form-control mb-2" autocomplete="off" required />
                    </div>

                    <div class="col-12">
                        <input type="text" placeholder="Address" name="postcard_return_address_address" id="postcard_return_address_address" class="nsm-field form-control mb-2" required />
                        <input type="hidden" name="postcard_return_address_latlng" id="postcard_return_address_latlng" class="nsm-field form-control">
                    </div>
                    <div class="col-12">
                        <input type="text" placeholder="Suite/Unit" name="postcard_return_address_address_secondary" class="nsm-field form-control mb-2" required autocomplete="off" />
                    </div>
                    <div class="col-12 col-md-8">
                        <input type="text" placeholder="City" name="postcard_return_address_city" id="postcard_return_address_city" class="nsm-field form-control mb-2" required autocomplete="off" />
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="text" placeholder="Zip/Postal Code" name="postcard_return_address_zip" id="postcard_return_address_zip" class="nsm-field form-control mb-2" required autocomplete="off" />
                    </div>
                    <div class="col-12">
                        <select class="nsm-field form-select" name="postcard_return_address_state" id="postcard_return_address_state" required>
                            <option value="" selected="selected">State/Province</option>
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
                        <input type="hidden" name="postcard_return_address_country" id="postcard_return_address_country" value="us" class="nsm-field form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary">Save</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>