<?php
foreach ($tags as $tag) :
?>
    <span class="nsm-badge big badge-circle stats-item"><?= $tag->name; ?> (0)</span>
<?php
endforeach;
?>