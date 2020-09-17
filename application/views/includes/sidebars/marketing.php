<style type="text/css">
    div[role="wrapper"] .navbar-side .nav-header {
        background-color: #32243d;
        padding: 20px;
        margin-bottom: 0px;
        color: #45a73c;
        /*border-bottom: 1px solid #ccc;*/
    }
    div[role="wrapper"] .navbar-side {
        background-color: #32243d;
    }
    ul.nav li.submenus:hover {
        background: #45a73c;
        background: -moz-linear-gradient(top, #45a73c 0%, #67ce5e 100%);
        background: -webkit-linear-gradient(top, #45a73c 0%,#67ce5e 100%);
        background: linear-gradient(to bottom, #45a73c 0%,#67ce5e 100%);
    }
    div[role="wrapper"] .navbar-side .nav li > a {
        color: #fff;
        text-align: left;
    }
</style>
<nav class="navbar-side d-none d-md-block">
    <ul class="nav"><span class="nav-close">        <svg viewBox="0 0 16 14" id="svg-sprite-menu-close" xmlns="http://www.w3.org/2000/svg" transform="scale(1, -1)" width="20px" height="100%"><path d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z"></path></svg>           </span>
        <li class="nav-header">Marketing </li>
        <li class="submenus <?= ($this->uri->uri_string() == 'marketing' || $this->uri->uri_string() == 'customer') ? "active" : "";  ?>"><a href="<?php echo base_url('customer') ?>" title="Marketing"><span class="fa fa-user"></span>&nbsp;&nbsp;My Customers</a></li>
        <li class="submenus <?= ($this->uri->uri_string() == 'sms_campaigns') ? "active" : "";  ?>"><a href="<?php echo base_url('Sms_Campaigns'); ?>" title="SMS Blast"><span class="fa fa-users"></span>SMS Blast</a></li>
        <li class="submenus <?= ($this->uri->uri_string() == 'survey') ? 'active' : "" ?>"><a href="<?= base_url('survey') ?>" title="Survey"><span class="fa fa-cube"></span>Survey</a></li>
        <li class="submenus <?= ($this->uri->uri_string() == 'sms_automation') ? "active" : "";  ?>"><a href="<?php echo base_url('sms_automation'); ?>" title="SMS Automation"><span class="fa fa-cube"></span>SMS Automation</a></li>
        <li class="submenus <?= ($this->uri->uri_string() == 'voicemail_campaigns') ? "active" : "";  ?>"><a href="<?php echo base_url('voicemail_campaigns'); ?>" title="Voicemail Blast"><span class="fa fa-cube"></span>Voicemail Blast</a></li>
        <li class="submenus <?= ($this->uri->uri_string() == 'email_campaigns') ? "active" : "";  ?>"><a href="<?php echo base_url('email_campaigns'); ?>" title="Email Blast"><span class="fa fa-cube"></span>Email Blast</a></li>
        <li class="submenus <?= ($this->uri->uri_string() == 'email_automation') ? "active" : "";  ?>"><a href="email_automation" title="Email Automation"><span class="fa fa-cube"></span>Email Automation</a></li>
        <li class="submenus <?= ($this->uri->uri_string() == 'offers') ? "active" : "";  ?>"><a href="<?php echo base_url('offers'); ?>" title="Offers"><span class="fa fa-cube"></span>Offers</a></li>
        <li class="submenus  <?= ($this->uri->uri_string() == 'campaign_blast') ? "active" : "";  ?>"><a href="campaign_blast" title="Credentials"><span class="fa fa-cube"></span>Campaign Blast</a></li>
        <li class="submenus"><a href="#" title="Credentials"><span class="fa fa-cube"></span>Customer Finder 360</a></li>
        <li class="submenus"><a href="#" title="Credentials"><span class="fa fa-cube"></span>My Leads List</a></li>

        <?php /*<li class="nav-header">Connectors </li>Q
        <li class="submenus"><a href="#" title="Credentials"><span class="fa fa-cube"></span>Connectors</a></li>
        <li class="submenus"><a href="#" title="Credentials"><span class="fa fa-cube"></span>NiceJob</a></li>
        <li class="submenus"><a href="#" title="Credentials"><span class="fa fa-cube"></span>Google Contacts</a></li>
        <li class="submenus"><a href="#" title="Credentials"><span class="fa fa-cube"></span>Zapier</a></li>
        <li class="submenus"><a href="#" title="Credentials"><span class="fa fa-cube"></span>QuickBooks Payroll</a></li>
        <li class="submenus"><a href="#" title="Credentials"><span class="fa fa-cube"></span>Mailchimp</a></li>
        <li class="submenus"><a href="#" title="Credentials"><span class="fa fa-cube"></span>Active Campaign</a></li>
        <li class="submenus"><a href="#" title="Credentials"><span class="fa fa-cube"></span>API Integration</a></li>
        <li class="submenus"><a href="#" title="Credentials"><span class="fa fa-cube"></span>API Connectors</a></li>*/ ?>
    </ul>
</nav>
