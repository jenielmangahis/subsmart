<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header'); ?>
<style>
* {
  margin: 0px;
  padding: 0px;
  transition: all 0.5s ease 0s;
  -webkit-transition: all 0.5s ease 0s;
  -moz-transition: all 0.5s ease 0s;
  -ms-transition: all 0.5s ease 0s;
  -o-transition: all 0.5s ease 0s;
}
html, body, address, blockquote, div, dl, form, h1, h2, h3, h4, h5, h6, ol, p, pre, table, ul, dd, dt, li, tbody, td, tfoot, th, thead, tr, button, del, ins, map, object, a, abbr, acronym, b, bdo, big, br, cite, code, dfn, em, i, img, kbd, q, samp, small, span, strong, sub, sup, tt, var, legend, fieldset, p {
  margin: 0;
  padding: 0;
  border: none;
}
a, input, select, textarea {
  outline: none;
  margin: 0;
  padding: 0;
}
a:hover,focus{
  text-decoration:none;
  outline: none;
  border: none;
}
img, fieldset {
  border: 0;
}
a {
  outline: none;
  border: none;
}
img {
  max-width: 100%;
  height: auto;
  width: auto\9;
  vertical-align: middle;
  border: none;
  outline: none;
}
article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section {
  display: block;
  margin: 0;
  padding: 0;
}
div, h1, h2, h3, h4, span, p, input, form, img, hr, img, a {
  margin: 0;
  padding: 0;
  border: none;
}
.mt-30, .mb-30{margin: 30px 0;}
.clear {
  clear: both;
}
.refer-form-content a {
    background: #694a85;
    color: #fff;
    font-weight: 500;
    font-size: 18px;
    width: 100%;
    height: 50px;
    cursor: pointer;
}
.share-boxes p {margin: 15px 0 0; font-size: 15px; font-weight: bold;}
.share-boxes {background: #f9f9f9; text-align: center; border-radius: 10px;  box-shadow: 0 0 17px #ccc;
    padding: 20px 0;  position: relative;}
.share-boxes img.dotted-line {position: absolute; left: -167px; top: 5px; transform: rotate(-3deg);}
.share-boxes img.dotted-line2 {position: absolute; right: -173px; top: 5px; transform: rotate(-4deg);}
.refer-image img {width: 100%;}
.refer-form ul li {float: left; list-style: none; width: 33.333%; text-align: center;}
.refer-form ul li a {background: #9fb0f8; display: block; padding: 14px; color: #fff; text-transform: uppercase;
    font-weight: 600;}
.refer-form ul {margin: 0;}
.refer-form ul li.facebook-color a{background: #9fb0f8}
.refer-form ul li.youtube-color a{background: #eb8c8c}
.refer-form ul li.twitter-color a{background: #9cd0fc}
.refer-form ul li.facebook-color a:hover{background: #4667f7; text-decoration: none;}
.refer-form ul li.youtube-color a:hover{background: #dd2020; text-decoration: none;}
.refer-form ul li.twitter-color a:hover{background: #40a7ff; text-decoration: none;}
.refer-form-content {float: left; width: 100%; background: #f9f9f9; padding: 30px; }
.refer-form-content h2 {color: #694a85; font-weight: bold; text-transform: uppercase; font-size: 25px; margin: 0 0 10px; }
.refer-form-content P a {color: #ffc3c9; font-weight: 500; }
.refer-form-content input{height: 50px; width: 100%; padding: 15px; border-radius: 1px; margin-bottom: 20px; box-shadow: 0 0 6px #ccc; }
.container-checkbox {display: block; position: relative; padding-left: 30px; margin-bottom: 12px; cursor: pointer; font-size: 16px; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; }
.container-checkbox input {position: absolute; opacity: 0; cursor: pointer; height: 0; width: 0; } 
.checkmark {position: absolute; top: 3px; left: 0; height: 20px; width: 20px; background-color: transparent; border: 2px solid #ffc3c9; }
.container-checkbox:hover input ~ .checkmark {background-color: #ccc; } 
.container-checkbox input:checked ~ .checkmark {background-color: #ffc3c9; } 
.checkmark:after {content: ""; position: absolute; display: none; } 
.container-checkbox input:checked ~ .checkmark:after {display: block; } 
.container-checkbox .checkmark:after {left: 5px; top: 0px; width: 7px; height: 12px; border: solid white; border-width: 0 3px 3px 0; -webkit-transform: rotate(45deg); -ms-transform: rotate(45deg); transform: rotate(45deg); } 
.refer-form-content form button {background: #694a85; color: #fff; font-weight: 500; font-size: 18px; width: 100%; height: 50px; cursor: pointer; } 
.refer-form-content form button:hover{background: #000;}
.refer-form-content input::placeholder{color:#c5c5c5; font-size: 14px;}
.row.refer-form-sec {height: auto; overflow: hidden; margin-top: 55px; }
.referal-progress table td:nth-child(2) {text-align: right; } 
.referal-progress table td {border: 1px solid #cccc; padding: 15px 20px; } 
.row.refer-form-sec .col:first-child {padding-right: 0; } 
.row.refer-form-sec .col:last-child {padding-left: 0; }
.referal-progress h2 {color: #ffc3c9; font-size: 22px; margin: 10px 0 15px; }
.share-boxes:after {content: ""; background: url("https://i.ibb.co/WHdS3G1/circle.png") no-repeat 0 0; position: absolute; left: 0; right: 0; bottom: -65px; margin: 0 auto; z-index: 99999; height: 60px; width: 20px; }
@media only screen and (max-width: 1100px){
.share-boxes img.dotted-line, .share-boxes img.dotted-line2 {
    display: none;
}

}
@media only screen and (max-width: 767px){
.share-boxes {
    margin: 0 0 52px;
}
.row.refer-form-sec {
    height: auto;
    overflow: hidden;
    margin-top: 55px;
    display: block;
}
.row.refer-form-sec .col:first-child {
    padding-right: 15px;
    margin: 0 0 30px;
}
.row.refer-form-sec .col:last-child {
    padding-left: 15px;
}
}
@media only screen and (max-width: 380px){
.refer-form ul li a {
    padding: 9px;
    font-size: 14px;
}
.refer-form-content h2 {
    font-size: 22px;
}
}
</style>
<div class="container">
        <div class="row refer-form-sec">
          <div class="col">
            <div class="refer-image">
              <img src="<?php echo base_url('assets/img/refer_friend_bannerjpg.png'); ?>" style="padding: 54px;">
            </div>
          </div>
          <div class="col">
            <div class="refer-form-content" style="margin-top:40px;">
              <h2>Email Successfully Sent!</h2>
              <p>Click button to redirect to the dashboard </p>
              <br />
              <div class="mt-3">
                <form action="#" method="#" id="form-referer">
                  <button type="submit" class="btn-send">Go To Dashboard</button>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
<?php include viewPath('frontcommon/footer'); ?>
<script>
$(function(){
  $(document).on('click', '.btn-add-more', function(){
    var rowItems = $('.row-fields').length + 1;
    var add_element = '<div class="row row-fields"><div class="col-md-5"><input type="text" name="refer['+rowItems+'][name]" placeholder="Name"></div><div class="col-md-5"><input type="email" name="refer['+rowItems+'][email]" placeholder="Email"></div></div>';
    $(".referer-fields").append(add_element);
  });

  $("#form-referer").submit(function(e){
    e.preventDefault();
    window.location.href='/dashboard';
  });
});
</script>
