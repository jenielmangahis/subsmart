<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="col-sm-4" id="spotlight">
    <div class="expenses tile-container" style="top:0px; margin-bottom: 30px;">
        <div class="inner-container">
            <div class="tileContent">
                <div class="clear">
                    <div class="inner-content">
                        <div class="header-container" style="border-bottom:1px solid gray;">
                            <h3 class="header-content"><i class="fa fa-lightbulb-o" aria-hidden="true"></i> Today's Spotlight</h3>
                        </div>
                        <div class="expenses-money-section" style="margin-top:10px;">
                            <div class="spot-img">
                                <!-- <img src="<?php //echo $url->assets ?>dashboard/images/users/user.jpg" alt=""> -->
                                <img src="<?php echo userProfileImage(logged('id')) ?>" alt="user">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>