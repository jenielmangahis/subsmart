<style>
.news-details .content-title{
    width: 650px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.news-details .content-subtitle{
    width: 650px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.content-news-date{
    display:block;
    font-size:11px;
}
.view-newsletter-details:hover{
    cursor:pointer;
}
</style>
<?php if( count($newsLetters) > 0 ){ ?>
    <table class="nsm-table" id="dashboard-newsletters">
        <thead>
            <tr><td data-name="Activity"></td></tr>
        </thead>
        <tbody>
        <?php foreach($newsLetters as $news){ ?>
            <tr>
                <td>                    
                    <div class="widget-item view-newsletter-details" data-id="<?= $news->id; ?>">
                        <?php $image = userProfilePicture($news->user_id); ?>
                        <?php if (is_null($image)) { ?>
                            <div class="nsm-profile">
                                <span><?= getLoggedNameInitials($news->user_id); ?></span>
                            </div>
                        <?php } else { ?>
                            <div class="nsm-profile" style="background-image: url('<?= $image; ?>');"></div>
                        <?php } ?>
                        <div class="content">
                            <div class="details news-details" style="width:15% !important;">                                                    
                                <span class="content-title">
                                    <?= $news->title ?>
                                    <span class="content-news-date text-muted"><i class='bx bxs-calendar'></i> <?= date('F d, Y g:i A', strtotime($news->date_created)) ?></span>
                                </span>
                                <span class="content-subtitle d-block mt-2"><?= $news->message ?></span>
                            </div>
                            <div class="controls"></div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php }else{ ?>
    <div class="nsm-empty">
        <i class='bx bx-meh-blank'></i>
        <span>Bulletin is empty.</span>
    </div>
<?php } ?>
<script>
$(function(){
    $("#dashboard-newsletters").nsmPagination({itemsPerPage:5});      
});
</script>