<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid bg-white p-5 mb-5" id="marketplace">
            <div class="row">
                <div class="col-md-7">
                    <h3>Quickbooks Capital and Quickbooks Marketplace: two ways to fuel your business.</h3>
                    <br>
                    <h6>They are both great business funding options. But Quickbooks Capital and Quickbooks Marketplace are different. Learn more about what Quickbooks Capital has to offer.</h6>
                    <br>
                    <div class="learn-more d-flex align-items-center">
                        <a href="#" class="btn btn-success">Read on</a>
                        <span class="ml-3">2 minute read</span>
                    </div>
                    <br>
                    <p class="m-0">If you have any other questions about Quickbooks Capital, give us a call at 800.556.9165 M-F, 6:00 AM to 6:00 PM, PT</p>
                </div>
            </div>
        </div>

        <div class="container-fluid bg-white py-5" id="faq">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="pb-3 faq-header">Get the right answers:</h3>
                    <div class="accordion" id="faq-accordion">
                        <div class="card p-0 m-0">
                            <div class="card-header" id="question1">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#first-question" aria-expanded="true" aria-controls="first-question">
                                    Do I qualify for financing?
                                    </button>
                                </h2>
                            </div>

                            <div id="first-question" class="collapse show" aria-labelledby="question1" data-parent="#faq-accordion">
                                <div class="card-body">
                                    <p>QuickBooks Capital helps you get an answer to that question quickly. Whether or not you qualify for financing depends on the decision of our financing partners when they review your application. With your permission, we share your years in business, revenue, and other QuickBooks information with the financing partner you choose. If options from our partners are available, you'll see them in minutes.</p>
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
                        <div class="card p-0 m-0">
                            <div class="card-header" id="question2">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#second-question" aria-expanded="false" aria-controls="second-question">
                                    Will seeing options through QuickBooks Capital damage my credit?
                                    </button>
                                </h2>
                            </div>

                            <div id="second-question" class="collapse" aria-labelledby="question2" data-parent="#faq-accordion">
                                <div class="card-body">
                                    <p>No. Seeing your options just requires a soft pull of your credit. A soft pull won't affect your credit score in any way.</p>                                    
                                </div>
                            </div>
                        </div>
                        <div class="card p-0 m-0">
                            <div class="card-header" id="question3">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#third-question" aria-expanded="false" aria-controls="third-question">
                                    What role does QuickBooks Capital pay?
                                    </button>
                                </h2>
                            </div>

                            <div id="third-question" class="collapse" aria-labelledby="question3" data-parent="#faq-accordion">
                                <div class="card-body">
                                    <p>QuickBooks Capital helps you navigate the financing process. We negotiate with financing partners to get you competitive rates, and we make it easier by providing your information to the partner you choose, saving you time. We help in a few ways:</p>                                    
                                    <ul>
                                        <li>We help provide some of the information for the application form required by financing partners.</li>
                                        <li>We work with a limited number of hand selected partners to help bring you the right financing for your business.</li>
                                        <li>We help you see the options our financing partners have available for your business in one place, making it easier for you to compare rates and terms. If we can't match you with an offer from a financing partner, don't be discouraged. You can work with these and other financing partners directly.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card p-0 m-0">
                            <div class="card-header" id="question4">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#fourth-question" aria-expanded="false" aria-controls="fourth-question">
                                    What's the right type of loan product for me?
                                    </button>
                                </h2>
                            </div>

                            <div id="fourth-question" class="collapse" aria-labelledby="question4" data-parent="#faq-accordion">
                                <div class="card-body">
                                    <p>We offer access to several types of financing on our platform:</p> 
                                    <ul>
                                        <li>Line of credit: You want to have extra money on hand to be able to draw from as unexpected expenses come up.</li>
                                        <li>Invoice financing: You use the invoicing feature in QuickBooks and are looking for short-term working capital.</li>
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
    <!-- page wrapper end -->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>
<?php include viewPath('includes/footer_accounting'); ?>
