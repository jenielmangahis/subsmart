<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="<?=base_url('assets/css/esign/docusign/docusign.css');?>">
</head>
<body>
  <div class="container signing">
    <div class="signing__documentContainer"></div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
  <script src="<?=base_url('assets/js/esign/libs/pdf.js');?>"></script>
  <script src="<?=base_url('assets/js/esign/libs/pdf.worker.js');?>"></script>
  <script src="<?=base_url('assets/js/esign/docusign/signing.js');?>"></script>
</body>
</html>
