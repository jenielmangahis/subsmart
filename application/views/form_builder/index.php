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
                <th class="text-right">Modified</th>
              </tr>
            </thead>
            <tbody>
              <tr class="form-list-item">
                <td>
                  asdfasdf
                    <div class="btn-group d-block form-list-item-options">
                      <button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</button>
                      <button class="btn btn-sm btn-primary"><i class="fa fa-settings"></i> Settings</button>
                      <button class="btn btn-sm btn-primary"><i class="fa fa-share"></i> Share</button>
                      <button class="btn btn-sm btn-primary"><i class="fa fa-list"></i> Results</button>
                    </div>
                </td>
                <td>asdfasdf</td>
                <td>asdfasdf</td>
                <td class="text-right">asdfasdf</td>
              </tr>
              <tr>
                <td>
                  asdfasdf
                  
                </td>
                <td>asdfasdf</td>
                <td>asdfasdf</td>
                <td class="text-right">asdfasdf</td>
              </tr>
            </tbody>
          </table>

        </div>
        <div class="col-xs-12 col-md-4">

        </div>
      </div>
    



    </div>
  </div>

</div>

