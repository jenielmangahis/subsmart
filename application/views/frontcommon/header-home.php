<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> <?php echo $page->title ?> | <?php echo $app->site_title ?> </title>
    <meta name="description" content="Industry.INC HTML Template">
    <meta name="keywords" content="industry, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="<?php echo $url->assets ?>frontend/img/favicon.ico" rel="shortcut icon" />

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>

	<!-- CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo $url->assets ?>frontend/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>frontend/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>frontend/css/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>frontend/css/slicknav.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>frontend/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Main Stylesheets -->
    <link rel="stylesheet" href="<?php echo $url->assets ?>frontend/css/style.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>frontend/fonts/stylesheet.css" />
    <link rel="stylesheet" href="https://allfont.net/css/lane-narrow.css" type="text/css" />

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCL77vydXglokkXuSZV8cF8aJ3ZxueBhrU&libraries=places,geometry"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
    <style>
        #chatbox {
            border-radius: 15px;
        }

        .chatbox_header {
            border-top-left-radius: 15px !important;
            border-top-right-radius: 15px !important;
            background: #6a4a86;
        }

        .chatbot_image {
            height: 50px;
            width: 50px;
        }

        .chatbot_name_section {
            margin-left: 10px;
        }

        .chatbot_name {
            font-weight: bold;
        }

        .chatbot_minimize {
            position: absolute;
            font-size: 25px;
            right: 25px;
            cursor: pointer;
        }

        .chatbot_body {
            background: #f3f3f3;
            border-bottom-right-radius: 15px;
            border-bottom-left-radius: 15px;
            padding: unset;
        }

        .chat_content {
            max-height: 500px;
            height: 500px;
        }

        .send_chat {
            padding-right: 10px;
            padding-top: 20px;
        }

        .send_chat_container {
            border-radius: 15px;
            /* background-color: #6a4a8621; */
            max-width: 350px;
        }

        .receive_chat {
            padding-left: 10px;
            padding-top: 20px;
        }

        .receive_chat_container {
            border-radius: 15px;
            background-color: #f7f7f7;
            max-width: 350px;
        }

        .message_form_container {
            padding: 15px;
            border-top: 1px solid #00000020;
            margin-bottom: unset !important;
        }

        .message_form_button {
            background: #6a4a86;
            color: white;
        }

        .message_form_button_icon {
            font-size: 19px;
            vertical-align: sub;
        }

        .spacer {
            margin: 20px;
        }

        .sender_name {
            font-weight: bold;
            right: 20px;
        }

        .receiver_name {
            font-weight: bold;
            left: 20px;
        }

        .chatbox_container {
            position: fixed;
            bottom: 20px;
            right: 15px;
            width: 450px;
            display: none;
        }

        .chaticon {
            height: auto;
            width: 70px;
            position: fixed;
            bottom: 20px;
            right: 15px;
        }

        .chaticon:hover {
            height: auto;
            width: 75px;
            cursor: pointer;
        }

        .alwaysOnTop {
            z-index: 999 !important;
        }

        .chatmessage_field {
            /* padding: unset; */
			padding-left: 8px !important;
			font-size: 15px !important;
        }

        .chatbox_row {
            font-family: "Quicksand", sans-serif !important;
        }

		.typing_status {
			position: absolute; 
			left: 15px; 
			bottom: 88px;
		}

		.send_chat_message,
		.receive_chat_message {
			font-size: 14px;
		}

		/* Bouncing animation with proper keyframes */
		@keyframes bounce {
            0%, 100% {
                transform: translateY(0); /* Start and end at the same level */
            }
            50% {
                transform: translateY(-5px); /* Bounce up */
            }
        }
        
        /* Apply the animation to the typing status text */
        .typing_status {
            animation: bounce 0.5s infinite; /* Infinite bouncing animation */
        }

        .send_container,
        .receive_container {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .chaticon,
        .typing_status {
            display: none;
        }
    </style>
</head>

<body>
    <!-- Header section  -->
    <header class="header-section clearfix">
        <div class="header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-9 desktop-only">
                        <p>GROW YOUR BUSINESS WITH THE TOOL BUILT FOR YOU! <b class="ml-5 pl-4 sc-33">CALL US AT <span class="blink">(844) 406-7286</span></b> FOR BETTER COMPANY AUTOMATION</p>
                    </div>
                    <div class="col-md-10 mobile-only">
                        <p>GROW YOUR BUSINESS WITH THE TOOL BUILT FOR YOU! <b class="ml-5 sc-33">CALL US AT <span class="blink">(844) 406-7286</span></b> FOR BETTER COMPANY AUTOMATION</p>
                    </div>
                    <div class="col-md-3 text-md-right desktop-only">
                        <ul class="account-menu">
                            <li><a href="<?php echo url('/login') ?>">LOGIN</a></li>
                            <li class="no-break"><a href="<?php echo url('/registration') ?>" class="">SIGN UP</a></li>
                        </ul>
                        <div class="footer-social text-right">
                            <a href=""><i class="fa fa-facebook"></i></a>
                            <a href=""><i class="fa fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="site-navbar">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex align-items-center site-logo-holder">
                        <!-- Logo -->
                        <a href="http://nsmartrac.com/" class="site-logo">
                            <img width="300" src="<?php echo $url->assets ?>frontend/images/logo.png" alt="">
                        </a>

                        <!-- TradingView Widget BEGIN -->
                        <!-- <div class="tradingview-widget-container">
							  <div class="tradingview-widget-container__widget"></div>
							  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com" rel="noopener" target="_blank"><span class="blue-text">Ticker Tape</span></a> by TradingView</div>
							  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
							  {
							  "symbols": [
							    {
							      "proName": "FOREXCOM:SPXUSD",
							      "title": "S&P 500"
							    },
							    {
							      "proName": "FOREXCOM:NSXUSD",
							      "title": "Nasdaq 100"
							    },
							    {
							      "proName": "FX_IDC:EURUSD",
							      "title": "EUR/USD"
							    },
							    {
							      "proName": "BITSTAMP:BTCUSD",
							      "title": "BTC/USD"
							    },
							    {
							      "proName": "BITSTAMP:ETHUSD",
							      "title": "ETH/USD"
							    }
							  ],
							  "colorTheme": "light",
							  "isTransparent": false,
							  "displayMode": "adaptive",
							  "locale": "en"
							}
							  </script>
							</div> -->
                        <!-- TradingView Widget END -->

                        <div style="margin-left: auto; text-align: right;">
                            <!-- <nav class="site-nav-menu1 ml-auto d-none d-md-block">
								<ul class="">
									<li class=""><a href="<?php //echo url('/login') ?>">Login</a></li>
									<li><a class="" href="<?php //echo url('/home/signup') ?>">Sign Up</a></li>
								</ul>
							</nav> -->
                            <nav class="site-nav-menu ml-auto">
                                <!-- <ul class="over-write-menu" style="margin-top:8px;">
									<li><a href="<?php echo url('/login') ?>">LOGIN</a></li>
									<li class="no-break"><a href="<?php echo url('/registration') ?>" class="">SIGN UP</a></li>
								</ul> -->
                                <ul class="over-write-menu" style="margin-top:8px;">
                                    <li class=""><a href="<?php echo url('/') ?>">HOME</a></li>
                                    <li class=""><a href="<?php echo url('/about') ?>">ABOUT US</a></li>
                                    <li><a href="<?php echo url('/features') ?>">FEATURES</a></li>
                                    <li><a href="<?php echo url('/pricing') ?>">PRICING </a></li>
                                    <li><a href="<?php echo url('/contact') ?>">CONTACT</a></li>
                                    <li><a href="<?php echo url('/find-pros') ?>">FIND PRO</a></li>
                                    <li class=""><a href="<?php echo url('/demo') ?>" class="no-break">DEMO</a></li>
                                    <li class="no-break desktop-only-b"><a href="#" class="no-break dl-home desktop-only">DOWNLOAD</a></li>
                                    <li class="mobile-only"><a href="#">DOWNLOAD </a></li>
                                    <li class="mobile-only"><a href="<?php echo url('/login') ?>">LOGIN </a></li>
                                    <li class="mobile-only"><a href="<?php echo url('/registration') ?>">SIGN UP</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-12 d-flex align-items-center site-logo-holder">

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header section end  -->

    <!-- Chatbot -->
    <div class="row d-flex position-relative alwaysOnTop chatbox_row">
        <img class="chaticon alwaysOnTop" src="https://static.vecteezy.com/system/resources/previews/014/441/089/original/chat-message-icon-design-in-blue-circle-png.png">
        <div class="col-md-8 col-lg-6 col-xl-4 chatbox_container">
            <div id="chatbox" class="card">
                <div class="card-header chatbox_header d-flex align-items-center p-3 text-white border-bottom-0">
                    <img class="chatbot_image" src="https://cdn-icons-png.flaticon.com/512/8943/8943377.png">
                    <p class="mb-0 chatbot_name_section"><span class="chatbot_name">Chatbot</span><br><small>nSmarTrac Chatbot</small></p>
                    <i class="fas fa-times chatbot_minimize"></i>
                </div>
                <div class="card-body chatbot_body">
                    <div class="table-responsive chat_content">
                        <div class="receive_container position-relative">
                            <small class="receiver_name position-absolute">🤖 <span class="chatbot_name">Chatbot</span></small>
                            <div class="receive_chat d-flex flex-row justify-content-start">
                                <div class="p-3 me-3 border receive_chat_container">
                                    <p class="mb-0">Hi, I'm <u class="chatbot_name fw-normal">Chatbot</u>, a chatbot from nSmarTrac, who can help you with your queries.</p>
                                </div>
                            </div>
                        </div>
                        <div class="receive_container position-relative">
                        <small class="receiver_name position-absolute">🤖 <span class="chatbot_name">Chatbot</span></small>
                            <div class="receive_chat d-flex flex-row justify-content-start">
                                <div class="p-3 me-3 border receive_chat_container">
                                    <p class="mb-0">How can I help you today?</p>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="typing_status"><small class="text-muted"><span class="chatbot_name fw-normal">Chatbot</span> is typing...</small></div>
                    <form id="sendchat_form">
                        <div class="input-group message_form_container">
                            <input name="request" class="form-control chatmessage_field" type="text" placeholder="Type your message here..." required>
                            <button type="submit" class="btn message_form_button">
                                <strong><i class='bx bxs-send message_form_button_icon'></i></strong>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
	var BASE_URL = window.origin;
   // Custom Function ===============
   function formDisabler(selector, state) {
        const element = $(selector);
        const submitButton = element.find('button[type="submit"]');
        element.find("input, button, textarea, select").prop('disabled', state);

        if (state) {
            element.find('a').hide();
            if (!submitButton.data('original-content')) {
                submitButton.data('original-content', submitButton.html());
            }
            submitButton.prop('disabled', true);
        } else {
            element.find('a').show();
            const originalContent = submitButton.data('original-content');
            if (originalContent) {
                submitButton.prop('disabled', false).html(originalContent);
            }
        }
    }

    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: BASE_URL + "/chatbot/preference",
            dataType: "JSON",
            success: function(response) {
                $('.chatbot_name').text(response[0]['chatbot_name']);
                $('.chatbox_header, .message_form_button').css('background', response[0]['color']);
                $('.chatbox_header').attr('data-bgcolor', response[0]['color']);
                $('.chaticon').show();
            }
        });

        $(document).on('submit', '#sendchat_form', function(e) {
            e.preventDefault();
            let sendchatData = $(this);
            let chatMessage = sendchatData.find('input[name="request"]').val();
            let chatbot_name = $('.chatbot_name').eq(0).text();
            let bgcolor = $('.chatbox_header').attr('data-bgcolor');

            $.ajax({
                type: "POST",
                url: BASE_URL + "/chatbot/request",
                data: sendchatData.serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    formDisabler(sendchatData, true);
                    $('.chat_content').append('<div class="send_container position-relative"> <small class="sender_name position-absolute">You</small> <div class="send_chat d-flex flex-row justify-content-end"> <div class="p-3 send_chat_container" style="background-color: ' + bgcolor + '21;"> <p class="mb-0 send_chat_message">' + chatMessage + '</p> </div> </div> </div>').scrollTop($('.chat_content')[0].scrollHeight);
                    setTimeout(() => {
                        $('.typing_status').fadeIn('fast');
                    }, 500);
                },
                success: function (response) {
                    setTimeout(() => {
                        $('.chat_content').append('<div class="receive_container position-relative"> <small class="receiver_name position-absolute">🤖 ' + chatbot_name + '</small> <div class="receive_chat d-flex flex-row justify-content-start"> <div class="p-3 me-3 border receive_chat_container"> <p class="mb-0">' + response + '</p> </div> </div> </div>').scrollTop($('.chat_content')[0].scrollHeight);
                        $('.typing_status').hide();
                        sendchatData.find('input').val(null);
                        formDisabler(sendchatData, false);
                    }, 1000);
                }
            });
        });

        $('.chaticon').click(function(e) {
            $('.chatbox_container').slideDown();
            $('.chaticon').fadeOut();
        });

        $('.chatbot_minimize').click(function(e) {
            $('.chatbox_container').slideUp();
            $('.chaticon').fadeIn();
        });
    });
</script>