<?php
foreach ($tags as $tag) :
?>
    <a class="tagsData" href="javascript:void(0);" onclick="window.open('<?= base_url('job?job_tag='.$tag->id) ?>', '_blank', 'location=yes,height=1080,width=1280,scrollbars=yes,status=yes');">
        <span class="nsm-badge big badge-circle stats-item"><?= $tag->name; ?> (<?= $tag->total_job_tags; ?>)</span>
    </a>
<?php
endforeach;
?>