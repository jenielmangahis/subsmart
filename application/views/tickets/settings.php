<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('v2/includes/header'); ?>
<style>

h1, h2, h3, h4, h5, h6 {
}
section {
    padding: 60px 0;
    min-height: 100vh;
}
a, a:hover, a:focus, a:active {
    text-decoration: none;
    outline: none;
}
ul {
    margin: 0;
    padding: 0;
    list-style: none;
}.bg-gray {
    background-color: #f9f9f9;
}

.site-heading h2 {
  display: block;
  font-weight: 500;
  margin-bottom: 10px;
  text-transform: uppercase;
}

.site-heading h2 span {
  color: #ffaf5a;
}

.site-heading h4 {
  display: inline-block;
  padding-bottom: 20px;
  position: relative;
  text-transform: capitalize;
  z-index: 1;
}

.site-heading h4::before {
  background: #ffaf5a none repeat scroll 0 0;
  bottom: 0;
  content: "";
  height: 2px;
  left: 50%;
  margin-left: -25px;
  position: absolute;
  width: 50px;
}

.site-heading h2 span {
  color: #6a4a86;
}

.site-heading {
  margin-bottom: 60px;
  overflow: hidden;
  margin-top: -5px;
}

.pricing-area .site-heading {
  margin-bottom: 100px;
}

.pricing-item {
  background: #ffffff none repeat scroll 0 0;
  -moz-box-shadow: 0 0 10px #cccccc;
  -webkit-box-shadow: 0 0 10px #cccccc;
  -o-box-shadow: 0 0 10px #cccccc;
  box-shadow: 0 0 10px #cccccc;
  margin-bottom: 80px;
  position: relative;
  z-index: 9;
}

.pricing-item .icon {
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  font-size: 50px;
  height: 100px;
  left: 50%;
  line-height: 100px;
  margin-left: -50px;
  margin-top: -50px;
  position: absolute;
  text-align: center;
  top: 0;
  width: 100px;
}

.pricing-item .icon::after {
  background: #ffffff none repeat scroll 0 0;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  content: "";
  height: 100%;
  left: 0;
  position: absolute;
  top: 0;
  width: 100%;
  z-index: -1;
}

.pricing-item.active .icon::after {
  background: #6a4a86 none repeat scroll 0 0;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  content: "";
  height: 100%;
  left: 0;
  position: absolute;
  top: 0;
  width: 100%;
  z-index: -1;
}

.pricing-item.active .icon i {
  color: #ffffff !important;
}

.pricing-item .icon i {
  color: #ffaf5a;
  cursor: inherit !important;
}

.pricing-header h4 {
  font-weight: 600;
  text-transform: uppercase;
  color: #323a45;
}

.pricing-header h2 {
  color: #323a45;
  /* font-size: 50px; */
  font-weight: 900;
  letter-spacing: -1px;
  line-height: 1;
  margin-bottom: 0;
}

.pricing-header h2 sup {
  font-size: 24px;
  font-weight: 500;
  top: -25px;
}

.pricing-header h2 sub {
  font-size: 18px;
  font-weight: 400;
  margin-left: -5px;
}

.pricing-item .pricing-header span {
  font-family: "Poppins",sans-serif;
  font-weight: 600;
  text-transform: uppercase;
}

.pricing-header {
  border-bottom: 1px solid #e5e5e5;
  margin-bottom: 20px !important;
  padding: 50px 30px 30px !important;
}

.pricing-item .footer {
  padding: 20px 30px 30px;
}

.pricing-item li {
  font-family: "Poppins",sans-serif;
  line-height: 40px;
  margin: 0 30px;
  text-transform: capitalize;
}

.pricing-area .pricing-item.active .pricing-header {
  background: #6a4a86 none repeat scroll 0 0;
  border-color: transparent;
  margin: 0;
}

.pricing-area.color-yellow .pricing-item.active .pricing-header {
  background: #ff9800 none repeat scroll 0 0;
}

.pricing-area .pricing-item.active .pricing-header h2,
.pricing-area .pricing-item.active .pricing-header h4,
.pricing-area .pricing-item.active .pricing-header span {
  color: #ffffff;
}

.pricing-area .pricing-item.active .pricing-header span.badge {
  background: #ffffff none repeat scroll 0 0;
  color: #323a45;
}

.pricing-item li i {
  color: #999;
  margin-left: 2px;
  margin-right: 5px;
}

.pricing-item li i:hover {
  cursor: help;
}

.pricing-item li i.fa-times {
  color: #e22626;
}


.btn-sm {
    padding: 8px 35px;
    font-size: 12px;
}
.btn-dark {
  background-color: #323a45;
  color: #ffffff;
  border: 2px solid #323a45;
}

.btn-dark.border {
  background-color: transparent;
  color: #323a45;
  border: 2px solid #323a45;
}

.btn-dark.border:hover {
  background-color: #323a45;
  color: #ffffff !important;
  border: 2px solid #323a45;
}

.btn-theme {
    background-color: #6a4a86;
    color: #ffffff !important;
    border: 2px solid #6a4a86;
}

</style>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo base_url('customer/addTicket') ?>'">
        <i class="bx bx-note"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <h3>Service Tickets Settings</h3>
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Don't Let Your Service Desk Tickets Make it Harder to Run Your Business Effectively. Start Achieving Service Desk Excellence by tagging all your tickets and tracking them to the closed.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <section id="pricing" class="pricing-area bg-gray">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="site-heading text-center">
                                            <h2>Service Tickets <span>Templates</span></h2>
                                            <h4>List of different templates on the system</h4>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row pricing pricing-simple text-center">
                                        <div class="col-md-4">
                                            <div class="pricing-item">
                                                <ul>
                                                    <li class="icon">
                                                        <i class="fas fa-rocket"></i>
                                                    </li>
                                                    <li class="pricing-header">
                                                        <h4>Template</h4>
                                                        <h2>Custom</h2>
                                                    </li>
                                                    <li class="footer">
                                                        <a class="btn btn-dark border btn-sm" href="#">Use Template</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="pricing-item active">
                                                <ul>
                                                    <li class="icon">
                                                        <i class="fas fa-ribbon"></i>
                                                    </li>
                                                    <li class="pricing-header">
                                                        <h4>Template</h4>
                                                        <h2>Standard</h2>
                                                    </li>
                                                    <li class="footer">
                                                        <a class="btn btn-theme effect btn-sm" onclick="location.href='<?php echo base_url('customer/addTicket') ?>'" href="#">Use Template</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="pricing-item">
                                                <ul>
                                                    <li class="icon">
                                                        <i class="far fa-gem"></i>
                                                    </li>
                                                    <li class="pricing-header">
                                                        <h4>Template</h4>
                                                        <h2>Industry</h2>
                                                    </li>
                                                    <li class="footer">
                                                        <a class="btn btn-dark border btn-sm" href="#">Use Template</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </section>


                    </div>
                </div>



            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
<?php //include viewPath('includes/footer'); ?>
<script>
    $(document).on('click', '.delete-ticket', function(){
        var tkID = $(this).attr('data-tk-id');

            $.ajax({
                method: 'POST',
                url: '<?php echo base_url(); ?>tickets/deleteTicket',
                dataType: 'json',
                data: {tkID: tkID},
                success: function (e) {
                //    alert('success');
                // location.reload();
                sucess("Data Deleted Successfully!");
                    
                }
            });
        });

        
        function sucess(information,$id){
            Swal.fire({
                title: 'OK!',
                text: information,
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    location.reload();
                }
            });
        }
</script>