<?php 

foreach($widgets as $w):
?>
    <div class="list-group col-lg-6 float-left">
        <a onclick="$(this).addClass('active')" href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start mb-3">

            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><?= $w->w_name ?></h5>
            </div>
            <p class="mb-1"><?= $w->w_description ?></p>
        </a>             
    </div>

<?php    
endforeach;

