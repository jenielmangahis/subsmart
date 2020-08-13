<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>

<!-- Main content -->
<section class="content">

  <div class="row">

    <div class="col-sm-3">

      <?php include VIEWPATH.'/settings/sidebar.php'; ?>

    </div>
    <div class="col-sm-9">

      <!-- Default box -->
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">Email Templates</h3>
        </div>

        <div class="box-body">

          <table id="dataTable1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Id</th>
            <th>Code</th>
            <th>Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($this->templates_model->get() as $row): ?>
            <tr>
              <td width="60"><?php echo $row->id ?></td>
              <td ><?php echo $row->code ?></td>
              <td ><?php echo $row->name ?></td>
              <td>
                  <a href="<?php echo url('settings/edit_email_templates/'.$row->id) ?>" class="btn btn-sm btn-default" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
              </td>
            </tr>
          <?php endforeach ?>

        </tbody>
      </table>


        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->

    </div>
  </div>

</section>
<!-- /.content -->

<script>
  $(document).ready(function() {
    $('.form-validate').validate();

      //Initialize Select2 Elements
    $('.select2').select2()

  })

  function previewImage(input, previewDom) {

    if (input.files && input.files[0]) {

      $(previewDom).show();

      var reader = new FileReader();

      reader.onload = function(e) {
        $(previewDom).find('img').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }else{
      $(previewDom).hide();
    }

  }
</script>

<?php include viewPath('includes/footer'); ?>

