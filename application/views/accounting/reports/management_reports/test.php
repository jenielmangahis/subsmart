<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap js library -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="container">
  <form method="post">

    <div class="row fieldGroup">
      <div class="col-md-10  ">
        <div class="form-group">
          <label for="sectionTitle">Section Title</label>
          <input type="text" name="sectionTitle" id="sectionTitle" class="form-control">
        </div>
      </div>
      <div class="col-md-2  ">
        <a href="javascript:void(0)" class="btn btn-success addMore">
          <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Add
        </a>
      </div>
      <div class="col-md-12  ">
        <div class="form-group">
          <h4>Section Content</h4>
          <textarea name="sectionContent[]" class="editor"></textarea>
        </div>
      </div>
    </div>

  </form>
</div>

<div class="row" id="fieldGroupTemplate">
  <div class="col-md-10  ">
    <div class="form-group floating-label">
      <label for="sectionTitle">Section Title</label>
      <input type="text" name="sectionTitle" id="sectionTitle" class="form-control">

    </div>
  </div>
  <div class="col-md-2  ">
    <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</a>
  </div>
  <div class="col-sm-12 ">
    <div class="form-group">
      <h4>Section Content</h4>
      <textarea name="sectionContent[]"></textarea>
    </div>
  </div>
</div>

  <script type="text/javascript">
  	$(function() {

  //section add limit
  var maxGroup = 10;

  // initialize all current editor(s)
  $('.editor').ckeditor();

  //add more section
  $(".addMore").click(function() {

    // define the number of existing sections
    var numGroups = $('.fieldGroup').length;

    // check whether the count is less than the maximum
    if (numGroups < maxGroup) {

      // create new section from template
      var $fieldHTML = $('<div>', {
        'class': 'row fieldGroup',
        'html': $("#fieldGroupTemplate").html()
      });

      // insert new group after last one
      $('.fieldGroup:last').after($fieldHTML);

      // instantiate ckeditor on new textarea
      $('.fieldGroup:last').find('textarea').ckeditor();

    } else {
      alert('Maximum ' + maxGroup + ' sections are allowed.');
    }

  });

  //remove fields 
  $("body").on("click", ".remove", function() {
    $(this).parents(".fieldGroup").remove();
  });

});

  </script>
<?php include viewPath('includes/footer_accounting'); ?>