<?php
$queries = [];
parse_str($_SERVER['QUERY_STRING'], $queries);

$addRecipients = false;
if (array_key_exists('id', $queries) && array_key_exists('action', $queries)) {
    $addRecipients = $queries['action'] === 'add_fields' && is_numeric($queries['id']);
}

$viewPath = viewPath('v2/pages/esign/docusign/template-create/step1');
if ($addRecipients) {
    $viewPath = viewPath('esign/docusign/template-create/step2');
}
?>

<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<?php include viewPath('v2/includes/header');?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?=put_header_assets();?>

<div class="page-content g-0" role="wrapper">
    <section class="container-fluid mt-3">
        <div class="card--loading">
            <div class="loader">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <div class="nsm-page-nav mb-3">
                <ul>
                    <li class="active">
                        <a class="nsm-page-link" href="<?=base_url('docusign/Files')?>">
                            <span>Home</span>
                        </a>
                    </li>

                    <li class="">
                        <a class="nsm-page-link" href="<?=base_url('docusign_v2/manage?view=inbox')?>">
                            <span>Manage</span>
                        </a>
                    </li>

                    <li class="">
                        <a class="nsm-page-link" href="<?=base_url('docusign_v2/manage?view=sent')?>">
                            <span>Templates</span>
                        </a>
                    </li>
                </ul>
            </div>

            <?php include $viewPath;?>
        </div>
    </section>
</div>

<style>
    .loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 4;
        display: grid;
        place-content: center;
        background-color: #fff;
    }
</style>

<?php include viewPath('v2/includes/footer');?>