<?php
$queries = [];
parse_str($_SERVER['QUERY_STRING'], $queries);

$addRecipients = false;
if (array_key_exists('id', $queries) && array_key_exists('action', $queries)) {
    $addRecipients = $queries['action'] === 'add_fields' && is_numeric($queries['id']);
}

$viewPath = viewPath('esign/docusign/template-create/step1');
if ($addRecipients) {
    $viewPath = viewPath('esign/docusign/template-create/step2');
}
?>

<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<?php include viewPath('includes/header');?>

<div class="wrapper docusignTemplateCreate" role="wrapper">
    <?php include viewPath('includes/sidebars/docusign/home');?>
    <section class="container-fluid mt-3">
        <div class="card p-5 card--loading">
            <div class="loader">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <?php include $viewPath;?>
        </div>
    </section>
</div>



<?php include viewPath('includes/footer');?>