<?php include viewPath('v2/includes/header');?>

<input type="hidden" value="<?=base_url();?>" id="baseurl" />

<div class="fc-loader hide">
    <span>Loading...</span>
</div>

<div class="row page-content g-0">
    <div class="nsm-page">
        <div class="nsm-page-content container">
          <div class="row add-cards">
            <div class="col-3 p-3">
              <button class="nsm-button m-0 mb-3" data-action="createcard">
                <i class="bx bx-fw bx-plus"></i> <span>Create new card</span>
              </button>

              <div id="previewwrapper"></div>
            </div>

            <div class="col-9 p-3" id="formwrapper">
              <add-cards-form></add-cards-form>
              <div class="mt-3 d-flex justify-content-end">
                <a href="javascript:void(0);" data-action="deletecard">Delete card</a>
              </div>

              <hr />

              <button class="nsm-button">Reset</button>
              <button class="nsm-button primary">Save Deck</button>
            </div>
          </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/uuid/8.3.2/uuid.min.js"></script>

<link rel="stylesheet" href="<?=base_url("assets/css/university/flashcard.css")?>">
<script type="module"  src="<?=base_url("assets/js/university/flashcard/add-cards.js")?>"></script>
<?php include viewPath('v2/includes/footer');?>