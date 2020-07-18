<div id="" class="row dashboard-container-header cs15-padding">
    <div class="col-md-12 booking-tab-container">
        <a href="<?php echo base_url('more/addon/booking') ?>" class="<?= ($this->uri->uri_string() == 'more/addon/booking') ? "booking-tab-active" : "booking-tab";  ?>">Dashboard</a>
        <a href="<?php echo base_url('more/addon/booking/products') ?>" class="<?= ($this->uri->uri_string() == 'more/addon/booking/products') ? "booking-tab-active" : "booking-tab";  ?>">My Service/Items</a>
        <a href="<?php echo base_url('more/addon/booking/time') ?>" class="booking-tab <?= ($this->uri->uri_string() == 'more/addon/booking/time') ? "booking-tab-active" : "booking-tab";  ?>">Time Slots</a>
        <a href="<?php echo base_url('more/addon/booking/form') ?>" class="booking-tab <?= ($this->uri->uri_string() == 'more/addon/booking/form') ? "booking-tab-active" : "booking-tab";  ?>">Booking Form</a>
        <a href="<?php echo base_url('more/addon/booking/coupons') ?>" class="booking-tab <?= ($this->uri->uri_string() == 'more/addon/booking/coupons') ? "booking-tab-active" : "booking-tab";  ?>">Coupons</a>
        <a href="<?php echo base_url('more/addon/booking/settings') ?>" class="booking-tab <?= ($this->uri->uri_string() == 'more/addon/booking/settings') ? "booking-tab-active" : "booking-tab";  ?>">Settings</a>
        <a href="<?php echo base_url('more/addon/booking/preview') ?>" class="booking-tab <?= ($this->uri->uri_string() == 'more/addon/booking/preview') ? "booking-tab-active" : "booking-tab";  ?>">Web Integration</a>
    </div>
</div>
