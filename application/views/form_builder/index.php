<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  include viewPath('includes/header'); 
?>
<style>
  .form-list-item-options{
    display: none
  }
  .form-list-item.options:hover{
    display: block;
  }
  
</style>
<div class="wrapper">
  <div __wrapper_section>
    <div class="card my-2">
      
      
      <div class="text-left">
        <h1>My Forms <a href="<?= base_url()?>formbuilder/create" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Add new form</a></h1>
      </div>

      <hr/>
  
      
      <div class="row">
        <div class="col-xs-12 col-md-8">


          <div class="d-flex w-100 justify-content-between">
            <div class="form-group has-feedback">
              <input type="text" name="txtFormSearch" id="txtFormSearch" placeholder="Search form.." class="form-control">
            </div>
          </div>
          <table class="table table-hover">
            <thead class="thead-light">
              <tr>
                <th>Form Name</th>
                <th>Results</th>
                <th>Today</th>
                <th class="text-right">Created</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach($forms as $formKey => $form){
                  ?>
                    <tr class="form-list-item">
                      <td>
                        <?= $form->forms_title?>
                          <div class="btn-group d-block form-list-item-options">
                            <button class="btn btn-sm btn-primary"> <a href="<?=base_url()?>formbuilder/edit/<?= $form->forms_id?>" class="stretched-link"></a> <i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-sm btn-primary"><i class="fa fa-settings"></i> Settings</button>
                            <button class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Share</button>
                            <button class="btn btn-sm btn-primary"><i class="fa fa-list"></i> Results</button>
                          </div>
                      </td>
                      <td>0</td>
                      <td>0</td>
                      <td class="text-right">0</td>
                    </tr>
                  <?php
                }
              ?>
            </tbody>
          </table>

        </div>
        <div class="col-xs-12 col-md-4">

        </div>
      </div>
    



    </div>
  </div>

</div>

<script src="<?= base_url() ?>/assets/dashboard/js/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>
  
</script>