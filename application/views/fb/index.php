<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  include viewPath('includes/header'); 
?>

<div class="wrapper">
  <div __wrapper_section class="fb-wrapper">

    <div class="fb-header py-2">
      <h2 class="text-gray d-inline-block">My Forms</h2>
      <a href="/fb/add" class="d-inline-block btn btn-outline-primary">&#43; Create New Form</a>
    </div>

    <div id="fb-table" class="container-fluid">
      <div id="table-controls" class="row">
        <div class="form-group col-12 col-md-3">
          <div class="row">
            <select name="folder" id="folderSelect" onchange="filterForms()" class="form-control form-control-sm col-10">
              <option value="0">All forms</option>
              <option value="1">Uncategorized forms</option>
              <option value="2">Deleted forms</option>
              <optgroup label="User defined folders">
              </optgroup>

            </select>
            <a href="/fb/folders" class="btn btn-sm btn-default col-2 tall-anchor"><i class="fa fa-folder"></i></a>
          </div>
        </div>
        <div class="form-group col-12 col-md-6 offset-md-3">
            <div class="row">
              <input type="text" class="form-control form-control-sm col-11" id="searchInput" oninput="filterForms()" placeholder="Search">
              <button class="btn btn-sm btn-default col-1"><i class="fa fa-columns"></i></button>
            </div>
          </div>
      </div>
      <div class="table-container table-responsive">
        <table class="table table-hover table-bordered" id="formsIndexTable">
          <thead class="bg-secondary color-white">
            <td class="w-50">Form Name</td>
            <td class="">Results</td>
            <td class="">Favorite</td>
            <td class="">Daily Results</td>
            <td class="">Modified</td>
          </thead>
          <tbody id="emptyFormIndicator">
            <tr>
              <td colspan="5" class="text-center">No forms found</td>
            </tr>
          </tbody>
          <tbody id="tableContents">
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<?php include viewPath('includes/footer'); ?>