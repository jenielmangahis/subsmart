<div class="content" style="padding:10px;">
    <div class="details">                                                    
        <span class="content-title">
            <?= $newsLetter->title ?>
            <span class="content-news-date text-muted" style="margin-top:4px;"><i class='bx bxs-calendar'></i> <?= date('F d, Y g:i A', strtotime($newsLetter->date_created)) ?></span>
        </span>
        <div class="content-subtitle d-block mt-4" style="line-height:22px;"><?= $newsLetter->message ?></div>
    </div>
    <div class="controls mt-3">
        <?php if( $newsLetter->file_link != '' ){ ?>
            <a class="btn btn-sm" style="padding:0px;" href="<?= base_url('uploads/news/'.$newsLetter->company_id.'/'.$newsLetter->file_link); ?>" target="_new"><i class='bx bx-file'></i> <?= $newsLetter->file_link; ?></a>
        <?php } ?>
    </div>
</div>