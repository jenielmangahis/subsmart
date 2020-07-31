<input type="hidden" name="inquiry_id" id="inquiry_id" value="<?php echo $inquiry_id; ?>">
<h2>Basic Info</h2>
<div class="row">
            <div class="col-md-6">
 
                <div class="form-group">
                    <label>Name</label> <span class="help"></span>
                    <input type="text" name="name" id="name" value="<?php echo $inquiry->name; ?>" class="form-control" autocomplete="off" required="">
                </div>    

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" id="phone" value="<?php echo $inquiry->phone; ?>" class="form-control" autocomplete="off" required="">
                </div> 

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="email" value="<?php echo $inquiry->email; ?>" class="form-control" autocomplete="off" required="">
                </div>     

                <div class="form-group">
                    <label>Status</label> <span class="help"></span>
                    <select name="status" id="status" class="form-control">
                        <option <?php echo $inquiry->status == 1 ? 'selected="selected"' : ''; ?> value="1">New</option>
                        <option <?php echo $inquiry->status == 2 ? 'selected="selected"' : ''; ?> value="2">Contacted</option>
                        <option <?php echo $inquiry->status == 3 ? 'selected="selected"' : ''; ?> value="3">Follow Up</option>
                        <option <?php echo $inquiry->status == 4 ? 'selected="selected"' : ''; ?> value="4">Assigned</option>
                        <option <?php echo $inquiry->status == 5 ? 'selected="selected"' : ''; ?> value="5">Closed</option>
                    </select>
                </div>                 

            </div>
            <div class="col-md-6">   

                <div class="form-group">
                    <label>Address</label>
                    <textarea name="address" id="address" cols="40" rows="5" class="form-control"><?php echo $inquiry->address; ?></textarea>
                </div> 

                <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" id="message" cols="40" rows="5" class="form-control"><?php echo $inquiry->message; ?></textarea>
                </div>  

                <div class="form-group">
                    <label>How did you hear about us</label>
                    <input type="text" name="how_did_you_hear_about_us" id="how_did_you_hear_about_us" value="<?php echo $inquiry->how_did_you_hear_about_us; ?>" class="form-control" autocomplete="off" required="">
                </div>     

                <div class="form-group">
                    <label>Preferred time to contact</label> <span class="help"></span>
                    <select name="preferred_time_to_contact" id="preferred_time_to_contact" class="form-control">
                        <option <?php echo $inquiry->preferred_time_to_contact == 0 ? 'selected="selected"' : ''; ?> value="0">Any time</option> 
                        <option <?php echo $inquiry->preferred_time_to_contact == 1 ? 'selected="selected"' : ''; ?> value="1">7am to 10am</option> 
                        <option <?php echo $inquiry->preferred_time_to_contact == 2 ? 'selected="selected"' : ''; ?> value="2">10am to Noon</option> 
                        <option <?php echo $inquiry->preferred_time_to_contact == 3 ? 'selected="selected"' : ''; ?> value="3">Noon to 4pm</option> 
                        <option <?php echo $inquiry->preferred_time_to_contact == 4 ? 'selected="selected"' : ''; ?> value="4">4pm to 7pm</option>
                    </select>
                </div>                  

            </div>              
        </div>