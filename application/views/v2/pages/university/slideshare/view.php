<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>nSmarTrac: Slide Share</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://use.fontawesome.com/f61f458313.js"></script>

  <link href="https://vjs.zencdn.net/7.19.2/video-js.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/v2/boxicons.min.css")?>">
  <link rel="stylesheet" href="<?=base_url("assets/css/university/slideshare.css")?>">
</head>
<body id="sharedview">
  <header class="container">
    <a class="nsm-logo-link" href="<?=base_url("/")?>">
      <img class="nsm-logo" src="<?=base_url("assets/images/v2/logo.png")?>">
    </a>
  </header>
  <div class="container">
    <div class="video-wrapper mb-2">
        <video controls class="video video-js vjs-default-skin" preload="none" data-setup="{}">
        <source src="<?=base_url($slideshare->url);?>" type="video/mp4" />
        <p class="vjs-no-js">
            To view this video please enable JavaScript, and consider upgrading to a
            web browser that
            <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
        </p>
        </video>
    </div>
    <div>
        <h1 class="title"><?=$slideshare->display_name;?></h1>

        <div class="row">
            <div class="col-md-9 col-sm-12">
                <?php if (strlen(trim($slideshare->description))): ?>
                    <p><?=trim($slideshare->description);?></p>
                <?php else: ?>
                    <p><i>No description.</i></p>
                <?php endif;?>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="video-info">
                    <div class="mb-1">
                        <span class="bx bx-fw bx-user"></span>
                        <span><?=$slideshare->user->FName . ' ' . $slideshare->user->LName;?></span>
                    </div>
                    <div>
                        <span class="bx bx-fw bx-calendar"></span>
                        <span data-date="<?=$slideshare->created_at;?>"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <script src="https://vjs.zencdn.net/7.19.2/video.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
  <script type="module"  src="<?=base_url("assets/js/university/plupload.full.min.js")?>"></script>
  <script>
    const $date = document.querySelector("[data-date]");
    $date.textContent = moment.utc($date.dataset.date).fromNow();
  </script>
</body>
</html>
