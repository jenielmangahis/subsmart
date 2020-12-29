<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="col-sm-4" id="job">
    <div class="expenses tile-container">
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
                                    <div class="card-body pt-0 pb-0">
                                        <?php foreach($feeds as $feed) : ?>
                                            <div class="wid-peity mb-4">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div>
                                                            <p class="text-muted"><?php echo $feed->company_id; ?></p>
                                                            <h5><?php echo $feed->subject; ?></h5>
                                                            <p><?php echo $feed->description; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-4"><span class="peity-line" data-width="100%"
                                                                                data-peity='{ "fill": ["rgba(2, 164, 153,0.3)"],"stroke": ["rgba(2, 164, 153,0.8)"]}'
                                                                                data-height="60"><?php echo $feed->date; ?></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
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
        <?php echo form_open('dashboard/saveFeed', ['class' => 'form-validate require-validation', 'id' => 'feed_form', 'autocomplete' => 'off']); ?>
            <div class="col-md-6 form-group">
                <label for="job_customer">Recipient</label>
                <select class="form-control" id="job_customer" name="job_customer">
                    <?php if(!empty($customers)) : ?>
                        <option disabled selected>--Select--</option>
                        <?php foreach($customers as $customer) : ?>
                            <option value="<?php echo $customer->user_id; ?>"><?php echo $customer->contact_name; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <input type="hidden" id="recipient_id" name="recipient_id" value="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="job_name">Subject</label>
                <input type="text" class="form-control" name="feed_subject" id="feed_subject" required/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="job_name">Description</label>
                <textarea name="feed_description" class="form-control" id="feed_description" cols="30" rows="10"></textarea>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Add Feed</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>