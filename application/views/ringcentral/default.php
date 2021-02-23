<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php $this->load->view('includes/sidebars/api_connectors', $sidebar) ;
            
       $url = $platform->authUrl(array(
          'redirectUri' => $RINGCENTRAL_REDIRECT_URL,
          'state' => 'initialState',
          'brandId' => '',
          'display' => '',
          'prompt' => ''
        ));
               
            
    ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="row align-items-center mt-5 bg-white">
                <div class="card">
                    <div class="card-body" >
                        <div class="col-sm-12">
                            <h3 class="page-title">Ring Central</h3>
                            <div class="alert alert-warning col-md-12 mt-4 mb-4" role="alert">
                                <span style="color:black;">
                                    Call, Message, and Meet Seamlessly
                                    The Ring Central app's intuitive and unified user interface allows you to seamlessly transition between phone calls, video meetings, and team chat without
                                    losing track of what you’re working on. Less toggling between communications applications and solutions means your projects move forward, your teams
                                    stay connected, and your productivity increases.
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-sm-12">
                            <?php if(!$this->session->isRCLogin) : ?>
                                <a class="btn btn-primary btn-small" href="<?= $url; ?>">Login RingCentral Account</a>
                            <?php else: ?>
                                <a class="btn btn-primary btn-small" href="<?= base_url('ring_central/logout') ?>">Logout</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('includes/footer');