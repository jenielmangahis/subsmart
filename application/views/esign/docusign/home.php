<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<?php include viewPath('includes/header');?>

<div class="wrapper docusignHome" role="wrapper">
    <?php include viewPath('includes/sidebars/docusign/home');?>

    <section class="container-fluid mt-3">
        <div class="card docusignHome__container">
            <div class="container">
                <div>
                    <ul class="summary">
                        <li class="summary__item">
                            <a>
                                <span class="summary__count">2</span>
                                <span class="summary__title">Action Required</span>
                            </a>
                        </li>
                        <li class="summary__item">
                            <a>
                                <span class="summary__count">2</span>
                                <span class="summary__title">Waiting for Others</span>
                            </a>
                        </li>
                        <li class="summary__item">
                            <a>
                                <span class="summary__count">0</span>
                                <span class="summary__title">Expiring Soon</span>
                            </a>
                        </li>
                        <li class="summary__item">
                            <a>
                                <span class="summary__count">3</span>
                                <span class="summary__title">Completed</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="docusignHome__spacer"></div>

                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary">
                        <i class="fa fa-plus"></i>
                        New Template
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include viewPath('includes/footer');?>