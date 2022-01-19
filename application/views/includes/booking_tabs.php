<style>
.nav{
    margin-bottom:45px;
}
.nav-pills .nav-link.active{
    background-color: #32243d;
    color: #ffffff;
    font-size: 15px;
}
</style>
<ul class="nav nav-pills" style="">
  <li class="nav-item">
    <a href="<?php echo base_url('more/addon/booking') ?>" class="nav-link <?= ($this->uri->uri_string() == 'more/addon/booking') ? "active" : "booking-tab";  ?>">Dashboard</a>
  </li>
  <li class="nav-item">
    <a href="<?php echo base_url('more/addon/booking/products') ?>" class="nav-link <?= ($this->uri->uri_string() == 'more/addon/booking/products') ? "active" : "booking-tab";  ?>">My Service / Items</a>
  </li>
  <li class="nav-item">
    <a href="<?php echo base_url('more/addon/booking/time') ?>" class="nav-link booking-tab <?= ($this->uri->uri_string() == 'more/addon/booking/time') ? "active" : "booking-tab";  ?>">Time Slots</a>
  </li>
  <li class="nav-item">
    <a href="<?php echo base_url('more/addon/booking/form') ?>" class="nav-link booking-tab <?= ($this->uri->uri_string() == 'more/addon/booking/form') ? "active" : "booking-tab";  ?>">Booking Form</a>
  </li>
  <li class="nav-item">
    <a href="<?php echo base_url('more/addon/booking/coupons') ?>" class="nav-link booking-tab <?= ($this->uri->uri_string() == 'more/addon/booking/coupons') || ($this->uri->uri_string() == 'more/addon/booking/coupons/coupon_tab/closed') || ($this->uri->uri_string() == 'more/addon/booking/coupons/coupon_tab/active') ? "active" : "booking-tab";  ?>">Coupons</a>
  </li>
  <li class="nav-item">
    <a href="<?php echo base_url('more/addon/booking/settings') ?>" class="nav-link booking-tab <?= ($this->uri->uri_string() == 'more/addon/booking/settings') ? "active" : "booking-tab";  ?>">Settings</a>
  </li>
  <li class="nav-item">
    <a href="<?php echo base_url('more/addon/booking/preview') ?>" class="nav-link booking-tab <?= ($this->uri->uri_string() == 'more/addon/booking/preview') ? "active" : "booking-tab";  ?>">Web Integration</a>
  </li>
  <li class="nav-item">
    <a href="<?php echo base_url('more/addon/inquiries') ?>" class="nav-link booking-tab <?= ($this->uri->uri_string() == 'more/addon/inquiries') ? "active" : "booking-tab";  ?>">Inquiry</a>
  </li>
</ul>
