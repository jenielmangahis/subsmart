<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="col-sm-4" id="job">
    <div class="expenses tile-container" style="top:0px; margin-bottom: 30px;">
        <div class="inner-container">
            <div class="tileContent">
                <div class="clear">
                    <div class="inner-content">
                        <div class="header-container" style="border-bottom:1px solid gray;">
                            <h3 class="header-content"><i class="fa fa-calendar" aria-hidden="true"></i> Upcoming Jobs</h3>
                        </div>
                        <div class="expenses-money-section" style="margin-top:10px;">
                            <div class="inner-news">
                                <p>Welcome to nSmartrac!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="expenses tile-container" style="top:0px; margin-bottom: 30px;">
        <div class="inner-container">
            <div class="tileContent">
                <div class="clear">
                    <div class="inner-content">
                        <div class="header-container" style="border-bottom:1px solid gray;">
                            <h3 class="header-content"><i class="fa fa-feed" aria-hidden="true"></i> Feeds</h3>
                        </div>
                        <div class="expenses-money-section" style="margin-top:10px;">
                            <div class="inner-news">
                                <div class="card">
                                    <div class="card-body pt-0">
                                        <a href="javascript:void(0)" class="card-link" data-toggle="modal" data-target="#exampleModal">Add New Feed</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Feed</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="job_customer">Customer</label>
                <select class="form-control" id="job_customer" name="job_customer">
                    <?php if(!empty($customers)) : ?>
                        <option disabled selected>--Select--</option>
                        <?php foreach($customers as $customer) : ?>
                            <option value="<?php echo $customer->user_id; ?>"><?php echo $customer->contact_name; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <input type="hidden" id="customer_id" name="customer_id" value="">
            </div>
            <div class="col-md-6 form-group">
                <label for="job_name">Job Title</label>
                <input type="text" class="form-control" name="job_name" id="job_name" required/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="job_name">Subject</label>
                <input type="text" class="form-control" name="job_name" id="job_name" required/>
            </div>
            <div class="col-md-6 form-group">
                <label for="job_name">Date</label>
                <input type="text" class="form-control" name="job_name" id="job_name" required/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="job_name">Description</label>
                <textarea name="" class="form-control" id="" cols="30" rows="10"></textarea>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>