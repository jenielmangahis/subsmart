
<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  include viewPath('includes/header'); 
?>
<style>
  #windowPreviewTemplate{
    min-height: 90%;
  }
  
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
    
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url()?>formbuilder">Form Builder</a></li>
          <li class="breadcrumb-item active">Create new Form</li>
        </ol>
      </nav>
    
      <div class="text-left">
        <h1>Create new form</h1>
      </div>

      <hr/>

      <div class="row">
        <div class="col-xs-12 col-md-2">
          <div class="d-block form-group">
            <input type="text" name="txtFormTemplateSearch" id="txtFormTemplateSearch" class="form-control" placeholder="Search Template..">

            <div id="accordion" class="overflow-auto">
              
                <button class="btn btn-secondary btn-block" data-toggle="collapse" data-target="#collapse0" aria-expanded="true" aria-controls="collapse0">
                  Blank Form
                </button>
                <div id="collapse0" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                  <a href="#" class="btn btn-link" onclick="selectFormTemplate(0)" data-toggle="modal" data-target="#modalCreateForm">Blank Form</a>
                </div>
            
            
                <button class="btn btn-secondary btn-block" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                  Collapsible Group Item #2
                </button>
                <div id="collapse1" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                </div>
                <button class="btn btn-secondary btn-block" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                  Collapsible Group Item #3
                </button>
                <div id="collapse2" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                </div>
                <button class="btn btn-secondary btn-block" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                  Collapsible Group Item #4
                </button>
                <div id="collapse3" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                </div>
                <button class="btn btn-secondary btn-block" data-toggle="collapse" data-target="#class" aria-expanded="true" aria-controls="collapseOne">
                  Collapsible Group Item #5
                </button>
                <div id="collapse4" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                </div>
                <button class="btn btn-secondary btn-block" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapseOne">
                  Collapsible Group Item #6
                </button>
                <div id="collapse5" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                </div>
                <button class="btn btn-secondary btn-block" data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapseOne">
                  Collapsible Group Item #7
                </button>
                <div id="collapse6" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                </div>
                <button class="btn btn-secondary btn-block" data-toggle="collapse" data-target="#collapse7" aria-expanded="true" aria-controls="collapseOne">
                  Collapsible Group Item #8
                </button>
                <div id="collapse7" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                </div>
                <button class="btn btn-secondary btn-block" data-toggle="collapse" data-target="#collapse7" aria-expanded="true" aria-controls="collapseOne">
                  Collapsible Group Item #8
                </button>
                <div id="collapse7" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                  <a href="#" class="btn btn-link">This is a template</a>
                </div>

            </div>


          </div>
        </div>
        <div class="col-xs-12 col-md-10">
          <div id="windowPreviewTemplate" class="card">
            asdklfjasdf
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<div id="modalCreateForm" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title">
          Create new form
        </h1>
      </div>
      <div class="modal-body">
        Are you sure you want to create a form using this template? (Template name)
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary" data-dismiss="modal">Not yet</button>
        <button id="btnSubmitNewForm" class="btn btn-success">Yes, I want to use this template</button>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url() ?>/assets/dashboard/js/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<script>
  selectedForm = 0;

  document.querySelector('#btnSubmitNewForm').addEventListener('click', () => {
    
    title = "Blank formy"
    data = {
      forms_title: title, // static,
      forms_slag: title.replace(/\s/g, '-').toLowerCase()
    }; 
    
    $.ajax({
      url: "<?= base_url()?>formbuilder/form/add",
      data: data,
      dataType: 'json',
      type: 'POST',
      success: function(res){
        window.location = `<?= base_url()?>formbuilder/edit/${res.id}`
        return;
      }
    })
  })
</script>