<?php include viewPath('v2/includes/header');?>

<input type="hidden" value="<?=base_url();?>" id="baseurl" />
<input type="hidden" value="<?=$page->deckId;?>" id="deckid">

<div class="fc-loader hide">
    <span>Loading...</span>
</div>

<div class="row page-content g-0">
    <div class="nsm-page">
        <div class="nsm-page-content container">
          <div class="study-cards">
            <div class="study-cards__inner">
              <div class="mb-3">
                Card <strong>3/4</strong>
              </div>
              <study-card></study-card>
            </div>
          </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?=base_url("assets/css/university/flashcard.css")?>">
<script type="module"  src="<?=base_url("assets/js/university/flashcard/study-cards.js")?>"></script>
<?php include viewPath('v2/includes/footer');?>