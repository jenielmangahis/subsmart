<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include viewPath('v2/includes/accounting_header'); 
?>
<link rel="stylesheet" href="<?= base_url("assets/css/accounting/accounting.css") ?>">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.1/apexcharts.min.css" integrity="sha512-qc0GepkUB5ugt8LevOF/K2h2lLGIloDBcWX8yawu/5V8FXSxZLn3NVMZskeEyOhlc6RxKiEj6QpSrlAoL1D3TA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.1/apexcharts.min.js" integrity="sha512-mDe5mwqn4f61Fafj3rll7+89g6qu7/1fURxsWbbEkTmOuMebO9jf1C3Esw95oDfBLUycDza2uxAiPa4gdw/hfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<style>

</style>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('events/new_event') ?>'">
        <i class='bx bx-user-plus'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/dashboard'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="container-fluid bg-white p-5 mb-5" id="marketplace">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>nSmarTrac Capital and nSmarTrac Marketplace: two ways to fuel your business.</h3>
                            <br>
                            <h6>They are both great business funding options. But nSmarTrac Capital and nSmarTrac Marketplace are different. Learn more about what nSmarTrac Capital has to offer.</h6>
                            <br>
                            <div class="learn-more d-flex align-items-center">
                                <a href="#" class="nsm-button primary">Read on</a>
                                <span class="ml-3">2 minute read</span>
                            </div>
                            <br>
                            <p class="m-0">If you have any other questions about nSmarTrac Capital, give us a call at 800.556.9165 M-F, 6:00 AM to 6:00 PM, PT</p>
                        </div>
                    </div>
                </div>   
                <div class="container-fluid bg-white p-5 mb-5" id="marketplace">
                    <h2><strong>Get the right answers:</strong></h2>
                    <div class="row">
                        <div class="accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button content-title" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse-1" aria-expanded="true"
                                        aria-controls="collapse-<?php echo 1; ?>">
                                        Do I qualify for financing?
                                    </button>
                                </h2>      
                                <div id="collapse-<?php echo 1; ?>"  class="accordion-collapse collapse show"> 
                                    <div class="accordion-body">
                                        <p>nSmarTrac Capital helps you get an answer to that question quickly. Whether or not you qualify for financing depends on the decision of our financing partners when they review your application. With your permission, we share your years in business, revenue, and other nSmarTrac information with the financing partner you choose. If options from our partners are available, you'll see them in minutes.</p>
                                        <p>Key criteria that go into whether your business may qualify for financing:</p>
                                        <ul>
                                            <li>Years in business: Most of our financing partners are looking for two or more years in business.</li>
                                            <li>Revenue: Most of our financing partners look for at least $75,000 in gross revenue.</li>
                                            <li>Personal credit history: Your FICO score can affect whether you're approved, as well as financing terms and rates.</li>
                                            <li>Credit history: Personal and business bankruptcies as well as major derogatory information (such as late payments or liens) could also impact whether your business will be approved for financing.</li>
                                        </ul>
                                        <p>The criteria above are generally just the minimum criteria for pre-approval.</p>
                                    </div>
                                </div>                        
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button content-title" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse-2" aria-expanded="true"
                                        aria-controls="collapse-<?php echo 2; ?>">
                                        Will seeing options through nSmarTrac Capital damage my credit?
                                    </button>
                                </h2>      
                                <div id="collapse-<?php echo 2 ?>"  class="accordion-collapse collapse"> 
                                    <div class="accordion-body">
                                    <p>No. Seeing your options just requires a soft pull of your credit. A soft pull won't affect your credit score in any way.</p> 
                                    </div>
                                </div>                        
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button content-title" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse-3" aria-expanded="true"
                                        aria-controls="collapse-<?php echo 3; ?>">
                                        What role does nSmarTrac Capital pay?
                                    </button>
                                </h2>      
                                <div id="collapse-<?php echo 3 ?>"  class="accordion-collapse collapse"> 
                                    <div class="accordion-body">
                                        <p>nSmarTrac Capital helps you navigate the financing process. We negotiate with financing partners to get you competitive rates, and we make it easier by providing your information to the partner you choose, saving you time. We help in a few ways:</p>                                    
                                        <ul>
                                            <li>We help provide some of the information for the application form required by financing partners.</li>
                                            <li>We work with a limited number of hand selected partners to help bring you the right financing for your business.</li>
                                            <li>We help you see the options our financing partners have available for your business in one place, making it easier for you to compare rates and terms. If we can't match you with an offer from a financing partner, don't be discouraged. You can work with these and other financing partners directly.</li>
                                        </ul>
                                    </div>
                                </div>                        
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button content-title" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse-4" aria-expanded="true"
                                        aria-controls="collapse-<?php echo 4; ?>">
                                        What's the right type of loan product for me?
                                    </button>
                                </h2>      
                                <div id="collapse-<?php echo 4 ?>"  class="accordion-collapse collapse"> 
                                    <div class="accordion-body">
                                        <p>We offer access to several types of financing on our platform:</p> 
                                        <ul>
                                            <li>Line of credit: You want to have extra money on hand to be able to draw from as unexpected expenses come up.</li>
                                            <li>Invoice financing: You use the invoicing feature in nSmarTrac and are looking for short-term working capital.</li>
                                            <li>SBA Loans: You can wait a little longer (1-2 months) to get a lower rate for a larger dollar amount, and you plan on keeping the loan for a number of years. These loans have the lowest APRs on our platform.</li>
                                            <li>Long-term loan: You are planning an expansion of your business.</li>
                                            <li>Short-term loan: You are looking for some extra working capital to help smooth cash flow or purchase inventory.</li>
                                        </ul> 
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
<script>
    $(".close").click(function() {
    $(this)
        .parent(".alert")
        .fadeOut();
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>

