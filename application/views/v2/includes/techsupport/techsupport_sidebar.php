<script src="https://js.pusher.com/8.3.0/pusher.min.js"></script>
<style>
    #chatbox {
        border-radius: 15px;
    }

    .chatbox_header {
        border-top-left-radius: 15px !important;
        border-top-right-radius: 15px !important;
        background: #6a4a86;
    }

    .client_chatboxHeader {
        border-top-left-radius: 15px !important;
        border-top-right-radius: 15px !important;
        background: #6a4a86;
    }

    .chatbot_image,
    .client_realtimeImage {
        height: 50px;
        width: 50px;
    }

    .chatbot_name_section,
    .client_chatNameSection {
        margin-left: 10px;
    }

    .chatbot_name,
    .tech_name {
        font-weight: bold;
    }

    .chatbot_name_section>.chatbot_name,
    .client_chatNameSection>.tech_name {
        font-size: 15px;
    }

    .chatbot_minimize,
    .realtimechat_minimize {
        position: absolute;
        font-size: 25px;
        right: 25px;
        cursor: pointer;
    }

    .chatbot_chat_body,
    .client_chatBody {
        background: #f3f3f3;
        border-bottom-right-radius: 15px;
        border-bottom-left-radius: 15px;
        padding: unset;
    }

    .chatbot_chat_content,
    .client_chatContent {
        font-weight: 500;
    }

    .send_chat {
        padding-right: 10px;
        padding-top: 20px;
    }

    .send_chat_container {
        border-radius: 15px;
        /* background-color: #6a4a8621;  */
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

    .initialMessage {
        padding-left: 10px;
        justify-self: center;
    }

    .initialMessage_container > i {
        color: darkgray;
    }

    .message_form_container {
        padding: 15px;
        border-top: 1px solid #00000020;
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

    /* .chatbox_container, .client_chatContainer {
        position: fixed;
        bottom: 20px;
        right: 15px;
        width: 450px;
        display: none;
        z-index: 999 !important;
    } */

    .chaticon {
        height: auto;
        width: 70px;
        position: fixed;
        bottom: 20px;
        right: 15px;
        z-index: 999 !important;
    }

    .chaticon:hover {
        height: auto;
        width: 75px;
        cursor: pointer;
    }

    .typing_status {
        position: absolute;
        left: 15px;
        bottom: 70px;
    }

    @keyframes bounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }
    }

    .typing_status {
        animation: bounce 0.5s infinite;
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

    .offcanvas {
        transition: transform 0.3s ease;
    }

    .offcanvas-end {
        border-left: unset;
    }

    .cursorPointer {
        cursor: pointer;
    }

    .playCirleSize {
        font-size: 25px;
    }

    .watchClip {
        margin-bottom: -6px;
        margin-top: -2px;
    }

    .watchClip:hover {
        font-weight: bold;
        color: #ff00009e;
    }

    #previewBinder_table_info {
        display: none;
    }

    #previewBinder_table.dataTable.no-footer {
        border-bottom: 0px solid #dee2e6 !important;
    }

    #previewBinder_table.dataTable thead th,
    #previewBinder_table.dataTable thead td,
    #previewBinder_table.dataTable tbody td {
        padding: 6px;
    }

    #previewBinder_table.dataTable tbody td {
        border-bottom: 1px solid lightgray !important;
    }

    #previewBinder_table.dataTable>thead>tr>th {
        border: 1px solid lightgray !important;
    }

    #previewBinder_table_wrapper .dataTables_length,
    #previewBinder_table_wrapper .dataTables_filter {
        display: none;
    }

    #previewBinder_table>tbody {
        font-size: unset;
    }

    .techSupportSidebarCanvas {
        width: 435px;
    }

    .techSupportSidebarCanvas > .offcanvas-header {
        background: #6a4a86;
    }

    .ccCheckbox {
        width: 18px;
        height: 18px;
    }

    .viewVideoFromBinderModal .modal-body {
        margin-bottom: -10px;
    }

    #client_supportSidebarIDLabel {
        font-weight: bold; 
        margin: 0; 
        color: white;
    }

    .receive_chat_container > span > p {
        margin-bottom: 0;
    }
</style>
<!-- 
<div class="row d-flex position-relative">
    <img class="chaticon" src="https://static.vecteezy.com/system/resources/previews/014/441/089/original/chat-message-icon-design-in-blue-circle-png.png">
</div> -->

<div class="offcanvas offcanvas-end techSupportSidebarCanvas" tabindex="-1" id="client_supportSidebarID" aria-labelledby="client_supportSidebarIDLabel">
    <div class="offcanvas-header">
        <h5 id="client_supportSidebarIDLabel">Tech Support</h5>
        <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close" style="color: white !important;float: left;padding: 0;"><span class="float-start"><small>Close</small></span></button>
    </div>
    <div class="offcanvas-body">
        <div class="container">
            <div class="row techSupportMenu" style="display: non;">
                <div class="col-12-md mb-3">
                    <h4 class="fw-bold">How do you prefer to get in touch with us?</h4>
                </div>
                <div class="col-12-md mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Call us</h5>
                            <p class="card-text">Schedule a call, and we'll reach out to you as soon as possible.</p>
                            <a href="#" class="btn btn-success fw-bold openCallUs"><i class="fas fa-phone"></i>&nbsp;&nbsp;Let's talk in call</a>
                        </div>
                        <div class="card-footer text-muted"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;Support via call is available only Monday to Friday from 6:00am to 10:00pm.</div>
                    </div>
                </div>
                <div class="col-12-md mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Real-time chat</h5>
                            <p class="card-text">Engage in real-time chat with us and expect a prompt response.</p>
                            <a href="#" class="btn btn-success fw-bold openRealTimeChat"><i class="fas fa-comments"></i>&nbsp;&nbsp;Start chatting</a>
                        </div>
                        <div class="card-footer text-muted"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;Our team is ready to assist you during our operational hours.</div>
                    </div>
                </div>
                <div class="col-12-md mb-2">
                    <hr>
                </div>
                <div class="col-12-md mb-3">
                    <h4 class="fw-bold">Others</h4>
                </div>
                <div class="col-12-md mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Video Binder</h5>
                            <p class="card-text">Access our video binder for comprehensive pre-recorded information about the system.</p>
                            <a href="#" class="btn btn-primary fw-bold openVideoBinder"><i class="fas fa-folder"></i>&nbsp;&nbsp;Open Video Binder</a>
                        </div>
                        <div class="card-footer text-muted"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;The video binder is a collection of pre-recorded videos providing detailed information about the system.</div>
                    </div>
                </div>
                <div class="col-12-md mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Chatbot</h5>
                            <p class="card-text">Interact with our chatbot for quick assistance.</p>
                            <a href="#" class="btn btn-primary fw-bold openChatbotButton"><i class="fas fa-robot"></i>&nbsp;&nbsp;Open chatbot</a>
                        </div>
                        <div class="card-footer text-muted"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;Our chatbot is available 24/7 to help answer questions on system-related inquiries.</div>
                    </div>
                </div>
            </div>
            <div class="row callUs" style="display: none;">
                <div class="col-12-md">
                    <h4 class="fw-bold float-start">Call Us</h4>
                    <span class="text-muted float-end cursorPointer returnToMenu"><i class='bx bxs-left-top-arrow-circle'></i> Return to Menu</span>
                </div>
                <div class="col-12-md mb-3">
                    <span>Schedule a call, and we'll reach out to you as soon as possible. Support via call is available only <strong>Monday to Friday</strong> from <strong>6:00am to 10:00pm</strong>.</span>
                </div>
                <div class="col-12-md">
                    <form id="scheduleCallForm">
                        <div class="col-md-12 mb-3">
                            <label class="mb-1 fw-xnormal">Date&nbsp;<small class="text-muted">(mm/dd/yyyy)</small></label>
                            <input name="schedule_date" class="form-control mt-0" type="date" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="mb-1 fw-xnormal">Time&nbsp;<small class="text-muted">(hh:mm AM/PM)</small></label>
                            <div class="input-group">
                                <select name="schedule_time_hrs" class="nsm-field form-select" required>
                                    <option value="" selected disabled hidden>&mdash;</option>
                                    <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                            $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                                            echo "<option value='$hour'>$hour</option>";
                                        }
                                    ?>
                                </select>
                                <select name="schedule_time_mins" class="nsm-field form-select" required>
                                    <?php
                                        for ($i = 0; $i <= 59; $i++) {
                                            $minute = str_pad($i, 2, '0', STR_PAD_LEFT);
                                            echo "<option value='$minute'>$minute</option>";
                                        }
                                    ?>
                                </select>
                                <select name="schedule_time_notation" class="nsm-field form-select" required>
                                    <option value="" selected disabled hidden>&mdash;</option>
                                    <option value="AM">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="mb-1 fw-xnormal">CC&nbsp;<small class="text-muted">(Send a schedule copy to your email)</small></label>
                            <div class="input-group mb-3">
                                <div class="input-group-text">
                                    <input name="schedule_cc_checkbox" class="form-check-input mt-0 ccCheckbox cursorPointer" type="checkbox" checked>
                                </div>
                                <input name="schedule_cc" class="form-control mt-0" type="email" value="<?php echo logged('email');; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="mb-1 fw-xnormal">Notes&nbsp;<small class="text-muted">(Specify notes, queries etc. Optional)</small></label>
                            <textarea name="schedule_notes" class="form-control" placeholder="eg. I want help on Job module."></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button class="nsm-button primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row client_realtimeChat" style="display: none;">
                <div class="col-12-md">
                    <h4 class="fw-bold float-start">Real-time Chat</h4>
                    <span class="text-muted float-end cursorPointer returnToMenu"><i class='bx bxs-left-top-arrow-circle'></i> Return to Menu</span>
                </div>
                <div class="col-12-md mb-3">
                    <span>Get instant help from our tech support team via real-time chat! Available during operation hours <strong>(Monday to Friday, 6am to 10pm)</strong>, our experts are ready to assist you with any issues.</span>
                </div>
                <div class="col-12-md client_chatContainer">
                    <div id="chatbox" class="card">
                        <div class="card-header client_chatboxHeader d-flex align-items-center p-3 text-white border-bottom-0">
                            <img class="client_realtimeImage" src="https://cdn-icons-png.flaticon.com/512/4231/4231001.png">
                            <p class="mb-0 client_chatNameSection"><span class="tech_name">Tech Support</span><br><small class="client_businessName">nSmarTrac</small></p>
                        </div>
                        <div class="card-body client_chatBody">
                            <div class="table-responsive client_chatContent">
                                <!-- <div class="receive_container position-relative">
                                    <small class="receiver_name position-absolute">🤖 <span class="tech_name">Tech</span></small>
                                    <div class="receive_chat d-flex flex-row justify-content-start">
                                        <div class="p-3 me-3 border receive_chat_container">
                                            <p class="mb-0">Hello! Thank you for reaching out to nSmarTrac Tech Support. My name is <u class="tech_name">[TECH_NAME]</u>, and I’m here to assist you with any technical issues or questions you may have. How can I help you today?</p>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="typing_status techTypingAnimation"><small class="text-muted"><span class="fw-normal">Tech</span> is typing...</small></div>
                            <form id="client_chatForm">
                                <div class="input-group message_form_container">
                                    <input name="client_chatMessage" class="form-control" type="text" placeholder="Type your message here..." autocomplete="off" required>
                                    <button type="submit" class="btn message_form_button">
                                        <strong><i class='bx bxs-send message_form_button_icon'></i></strong>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row videoBinder" style="display: none;">
                <div class="col-12-md">
                    <h4 class="fw-bold float-start">Video Binder</h4>
                    <span class="text-muted float-end cursorPointer returnToMenu"><i class='bx bxs-left-top-arrow-circle'></i> Return to Menu</span>
                </div>
                <div class="col-12-md mb-3">
                    <span>The video binder is a collection of pre-recorded videos providing detailed information about the system.</span>
                </div>
                <div class="col-12-md">
                    <input id="previewBinder_table_search" class="form-control mt-0 mb-2 w-100" type="text" placeholder="Search...">
                    <table id="previewBinder_table" class="table table-bordered table-hover table-sm w-100 mb-2">
                        <thead><tr><th></th></tr></thead>
                        <tbody><tr></tr></tbody>
                    </table>
                </div>
            </div>
            <div class="row chatBotMessenger" style="display: none;">
                <div class="col-12-md">
                    <h4 class="fw-bold float-start">ChatBot</h4>
                    <span class="text-muted float-end cursorPointer returnToMenu"><i class='bx bxs-left-top-arrow-circle'></i> Return to Menu</span>
                </div>
                <div class="col-12-md mb-3">
                    <span>A chatbot is a tool that assists users by answering system inquiries and providing relevant information automatically.</span>
                </div>
                <div class="col-12-md chatbox_container">
                    <div id="chatbox" class="card">
                        <div class="card-header chatbox_header d-flex align-items-center p-3 text-white border-bottom-0">
                            <img class="chatbot_image" src="https://cdn-icons-png.flaticon.com/512/8943/8943377.png">
                            <p class="mb-0 chatbot_name_section"><span class="chatbot_name">Chatbot</span><br><small>Chatbot</small></p>
                            <!-- <i class="fas fa-times chatbot_minimize"></i> -->
                        </div>
                        <div class="card-body chatbot_chat_body">
                            <div class="table-responsive chatbot_chat_content">
                                <div class="receive_container position-relative">
                                    <small class="receiver_name position-absolute">🤖 <span class="chatbot_name">Chatbot</span></small>
                                    <div class="receive_chat d-flex flex-row justify-content-start">
                                        <div class="p-3 me-3 border receive_chat_container">
                                            <p class="mb-0">Hi, I'm <u class="chatbot_name">Chatbot</u>, a chatbot from nSmarTrac, who can help you with your queries.</p>
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
                            <form id="chatbot_chat_form">
                                <div class="input-group message_form_container">
                                    <input name="request" class="form-control" type="text" placeholder="Type your message here..." autocomplete="off" required>
                                    <button type="submit" class="btn message_form_button">
                                        <strong><i class='bx bxs-send message_form_button_icon'></i></strong>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade viewVideoFromBinderModal"  role="dialog" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- <div class="modal-header d-none">
                <span class="modal-title content-title" style="font-size: 17px;">Preview Video</span>
                <i class="bx bx-fw bx-x m-0 text-muted exit_preview_modal" data-bs-dismiss="modal" style="cursor: pointer;"></i>
            </div> -->
            <div class="modal-body">
                <div id="viewVideoContent" class="text-center">
                    <p class="text-muted">No file selected for preview.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var BASE_URL = window.origin;
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

    function loadChatbotPreference() {
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
    }

    $(document).ready(function() {
        loadChatbotPreference();

        $(document).on('click', '.redirectOnClick', function (e) {
            const page = $(this).attr('data-page');
            e.preventDefault();
            switch (page) {
                case 'video_binder':
                    if (!$.fn.DataTable.isDataTable('#previewBinder_table')) {
                        const previewBinder_table = $('#previewBinder_table').DataTable({
                            "processing": true,
                            "serverSide": true,
                            "ordering": false,
                            "pageLength": 20,
                            "ajax": {
                                "url": BASE_URL + "/VideoBinder/getAllVideos",
                                "type": "POST",
                            },
                            "language": {
                                "infoFiltered": "",
                            },
                            "order": []
                        });

                        $('#previewBinder_table_search').keyup(function() {
                            previewBinder_table.search($(this).val()).draw();
                        });
                    }

                    $('.techSupportMenu').hide();
                    $('.callUs').hide();
                    $('.client_realtimeChat').hide();
                    $('.videoBinder').fadeIn();
                    $('.chatBotMessenger').hide();
                    break;
                case 'call_us':
                    $('.techSupportMenu').hide();
                    $('.callUs').fadeIn();
                    $('.client_realtimeChat').hide();
                    $('.videoBinder').hide();
                    $('.chatBotMessenger').hide();
                    break;
                case 'pricing':
                    window.open(BASE_URL + "/pricing", "_blank");
                    break;
                case 'realtime_chat':
                    $('.techSupportMenu').hide();
                    $('.callUs').hide();
                    $('.client_realtimeChat').fadeIn();
                    $('.videoBinder').hide();
                    $('.chatBotMessenger').hide();

                    let chatContent_height = $(window).height() - 354;
                    $('.chatbot_chat_content').css('height', chatContent_height + 'px');
                    break;
            }
        });        

        $(document).on('click', '.openCallUs', function() {
            $('.techSupportMenu').hide();
            $('.callUs').fadeIn();
            $('.client_realtimeChat').hide();
            $('.videoBinder').hide();
            $('.chatBotMessenger').hide();
        });

        $(document).on('click', '.openRealTimeChat', function() {
            $('.client_chatContent').html('');
            const bgcolor = "#6a4a86";
            const client_id = <?php echo $user_id; ?>;
            
            $.ajax({
                url: BASE_URL + '/TechSupportSidebar/fetchClientMessages',
                type: 'POST',
                data: { client_id: client_id },
                beforeSend: function() {
                    $('.client_chatContent').append('<div class="position-relative fetchingConversationLoader"><div class="receive_chat d-flex flex-row justify-content-center"><div class="p-3 me-3"><i class="mb-0 text-muted">Fetching conversation, please wait...</i></div></div></div>');
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    $('.fetchingConversationLoader').remove();
                    data.forEach(msg => {
                        if (msg.client_id == client_id) { 
                            if (msg.sender_type === "client") {
                                $('.client_chatContent').prepend(`
                                    <div class="send_container position-relative"> 
                                        <small class="sender_name position-absolute">You</small> 
                                        <div class="send_chat d-flex flex-row justify-content-end"> 
                                            <div class="p-3 send_chat_container" style="background-color:` + bgcolor + `21;"> 
                                                <span class="mb-0 send_chat_message">${msg.message}</span> 
                                            </div> 
                                        </div> 
                                    </div>
                                `);
                            } else if (msg.sender_type === "tech") {
                                $('.client_chatContent').prepend(`
                                    <div class="receive_container position-relative"> 
                                        <small class="receiver_name position-absolute">Tech</small> 
                                        <div class="receive_chat d-flex flex-row justify-content-start"> 
                                            <div class="p-3 me-3 border receive_chat_container"> 
                                                <span class="mb-0">${msg.message}</span> 
                                            </div> 
                                        </div> 
                                    </div>
                                `);
                            }
                        }
                    });

                    $('.client_chatContent').scrollTop($('.client_chatContent')[0].scrollHeight);
                }

            });

            $('.techSupportMenu').hide();
            $('.callUs').hide();
            $('.client_realtimeChat').fadeIn();
            $('.videoBinder').hide();
            $('.chatBotMessenger').hide();

            let chatContent_height = $(window).height() - 354;
            $('.client_chatContent').css('height', chatContent_height + 'px');
        });

        $(document).on('click', '.openVideoBinder', function() {
            if (!$.fn.DataTable.isDataTable('#previewBinder_table')) {
                const previewBinder_table = $('#previewBinder_table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ordering": false,
                    "pageLength": 20,
                    "ajax": {
                        "url": BASE_URL + "/VideoBinder/getAllVideos",
                        "type": "POST",
                    },
                    "language": {
                        "infoFiltered": "",
                    },
                    "order": []
                });

                $('#previewBinder_table_search').keyup(function() {
                    previewBinder_table.search($(this).val()).draw();
                });
            }

            $('.techSupportMenu').hide();
            $('.callUs').hide();
            $('.client_realtimeChat').hide();
            $('.videoBinder').fadeIn();
            $('.chatBotMessenger').hide();
        });

        $(document).on('click', '.openChatbotButton', function() {
            $('.techSupportMenu').hide();
            $('.callUs').hide();
            $('.client_realtimeChat').hide();
            $('.videoBinder').hide();
            $('.chatBotMessenger').fadeIn();

            let chatContent_height = $(window).height() - 312;
            $('.chatbot_chat_content').css('height', chatContent_height + 'px');
        });

        $(document).on('click', '.returnToMenu', function() {
            $('.techSupportMenu').fadeIn();
            $('.callUs').hide();
            $('.client_realtimeChat').hide();
            $('.videoBinder').hide();
            $('.chatBotMessenger').hide();
        });

        $(document).on('click', '.watchClip', function() {
            const fileName = $(this).attr('data-filename');
            const fileUrl = `${BASE_URL}/uploads/files/${fileName}`;
            const fileType = fileName.split('.').pop().toLowerCase();
            const previewContent = $('#viewVideoContent');

            let content = '';
            if (['jpg', 'jpeg', 'png', 'gif'].includes(fileType)) {
                content = `<img src="${fileUrl}" class="img-fluid" alt="Video Image">`;
            } else if (['mp4', 'avi', 'mov', 'wmv'].includes(fileType)) {
                content = `
                    <video controls class="w-100">
                        <source src="${fileUrl}" type="video/${fileType}">
                        Your browser does not support the video tag.
                    </video>`;
            } else {
                content = `<p class="text-danger">Unsupported file format for preview.</p>`;
            }

            previewContent.html(content);
            $('.viewVideoFromBinderModal').modal('show');
        });

        $(document).on('hidden.bs.modal', '.viewVideoFromBinderModal', function() {
            $(this).find('video').remove();
        });

        $('select[name="schedule_time_hrs"]').on('change', function() {
            const hrs = parseInt($(this).val());
            const mins = $('select[name="schedule_time_mins"]').val();
            const $notation = $('select[name="schedule_time_notation"]');
            $notation.empty();

            if (hrs >= 6 && hrs <= 10) {
                $notation.append(new Option("AM", "AM"));
                $notation.append(new Option("PM", "PM"));
            } else if (hrs === 11) {
                $notation.append(new Option("AM", "AM"));
            } else {
                $notation.append(new Option("PM", "PM"));
            }

            if (hrs == 10 & mins > 0) {
                $notation.empty();
                $notation.append(new Option("AM", "AM"));
            } else if (hrs == 10 & mins == 0) {
                $notation.empty();
                $notation.append(new Option("AM", "AM"));
                $notation.append(new Option("PM", "PM"));
            }
        });

        $('select[name="schedule_time_mins"]').on('change', function() {
            const hrs = $('select[name="schedule_time_hrs"]').val();
            const mins = parseInt($(this).val());
            const $notation = $('select[name="schedule_time_notation"]');

            if (hrs == 10 & mins > 0) {
                $notation.empty();
                $notation.append(new Option("AM", "AM"));
            } else if (hrs == 10 & mins == 0) {
                $notation.empty();
                $notation.append(new Option("AM", "AM"));
                $notation.append(new Option("PM", "PM"));
            }
        });

        $('input[name="schedule_cc_checkbox"]').on('change', function() {
            if ($(this).prop('checked')) {
                $('input[name="schedule_cc"]').prop('required', true);
            } else {
                $('input[name="schedule_cc"]').prop('required', false);
            }
        });

        $('input[name="schedule_date"]').on("keydown", function(e) {
            e.preventDefault();
        });

        const dateInput = $('input[name="schedule_date"]');
        const today = new Date();
        const currentDate = today.toISOString().split("T")[0];
        const lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
        const lastDayFormatted = lastDay.getFullYear() + '-' + (lastDay.getMonth() + 1).toString().padStart(2, '0') + '-' + lastDay.getDate().toString().padStart(2, '0');
        dateInput.attr('min', currentDate);
        dateInput.attr('max', lastDayFormatted);
        dateInput.on('change', function() {
            const selectedDate = new Date($(this).val());
            const dayOfWeek = selectedDate.getDay();

            if (dayOfWeek === 0 || dayOfWeek === 6) {
                $(this).val(''); // Clear the input
                Swal.fire({
                    icon: "error",
                    title: "Failed to set date!",
                    html: "Support via call is available only <u>Monday</u> to <u>Friday</u>.",
                    showConfirmButton: true,
                    confirmButtonText: "Okay",
                    showCloseButton: true,
                });
            }
        });

        $(document).on('submit', '#scheduleCallForm', function(e) {
            e.preventDefault();
            let scheduledForm = $(this);

            $.ajax({
                type: "POST",
                url: BASE_URL + "/TechSupportSidebar/addSchedule",
                data: scheduledForm.serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    formDisabler(scheduledForm, true);
                    Swal.fire({
                        icon: "info",
                        title: "Saving Entry!",
                        html: "Please wait while the process is running...",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                },
                success: function(response) {
                    $('#scheduleCallForm')[0].reset();
                    formDisabler(scheduledForm, false);
                    Swal.fire({
                        icon: "success",
                        title: "Entry Saved!",
                        html: "Call support has beed scheduled.",
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        html: "An unexpected error occurred: " + error,
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                    });
                    formDisabler(scheduledForm, false);
                },
            });
        });

        $(document).on('submit', '#chatbot_chat_form', function(e) {
            e.preventDefault();
            let sendchatData = $(this);
            let chatMessage = sendchatData.find('input[name="request"]').val();
            let chatbot_name = $('.chatbot_name').eq(0).text();
            let bgcolor = "#6a4a86";

            $.ajax({
                type: "POST",
                url: BASE_URL + "/chatbot/request",
                data: sendchatData.serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    formDisabler(sendchatData, true);
                    $('.chatbot_chat_content').append('<div class="send_container position-relative"> <small class="sender_name position-absolute">You</small> <div class="send_chat d-flex flex-row justify-content-end"> <div class="p-3 send_chat_container" style="background-color: ' + bgcolor + '21;"> <span class="mb-0 send_chat_message">' + chatMessage + '</span> </div> </div> </div>').scrollTop($('.chatbot_chat_content')[0].scrollHeight);
                    setTimeout(() => {
                        $('.typing_status').fadeIn('fast');
                    }, 500);
                },
                success: function(response) {
                    setTimeout(() => {
                        $('.chatbot_chat_content').append('<div class="receive_container position-relative"> <small class="receiver_name position-absolute">🤖 ' + chatbot_name + '</small> <div class="receive_chat d-flex flex-row justify-content-start"> <div class="p-3 me-3 border receive_chat_container"> <span class="mb-0">' + response + '</span> </div> </div> </div>').scrollTop($('.chatbot_chat_content')[0].scrollHeight);
                        $('.typing_status').hide();
                        sendchatData.find('input').val(null);
                        formDisabler(sendchatData, false);
                    }, 1000);
                }
            });
        });

        // For Real-Time Chat
        Pusher.logToConsole = false;
        const pusher = new Pusher('33cfc0c407521da10fe6', { cluster: 'ap1' });
        const channel = pusher.subscribe('realtime_chat_channel');

        channel.bind(`chat_${<?php echo $user_id; ?>}_event`, function (data) {
            const chatContent = $('.client_chatContent');
            
            if (data.sender_type === "tech") {
                chatContent.append(`
                    <div class="receive_container position-relative">
                        <small class="receiver_name position-absolute">Tech</small>
                        <div class="receive_chat d-flex flex-row justify-content-start">
                            <div class="p-3 me-3 border receive_chat_container">
                                <span class="mb-0">${data.message}</span>
                            </div>
                        </div>
                    </div>
                `).scrollTop(chatContent[0].scrollHeight);
            }

            const clientTyping = $('.clientTypingAnimation');
            const techTyping = $('.techTypingAnimation');

            switch (data.status) {
                case 'client_isTyping':
                    clientTyping.fadeIn('fast');
                    techTyping.hide();
                    break;
                case 'client_isNotTyping':
                case 'tech_isNotTyping':
                    clientTyping.hide();
                    techTyping.hide();
                    break;
                case 'tech_isTyping':
                    clientTyping.hide();
                    techTyping.fadeIn('fast');
                    break;
            }
        });

        const chatInput = $('input[name="client_chatMessage"]');

        chatInput.on('focus', () => {
            $.post('/TechSupportSidebar/realtimeChatPusherRequest/client_typing', { isTyping: 1 });
        });

        chatInput.on('blur', () => {
            $.post('/TechSupportSidebar/realtimeChatPusherRequest/client_typing', { isTyping: 0 });
        });

        $('#client_chatForm').on('submit', function (e) {
            e.preventDefault();
            const formElement = $(this);
            const message = chatInput.val();
            const bgcolor = "#6a4a86";
            
            const data = {
                sender_type: 'client',
                message: message,
            };

            $.ajax({
                url: `${BASE_URL}/TechSupportSidebar/realtimeChatPusherRequest/send_message`,
                type: 'POST',
                data: data,
                beforeSend: function () {
                    formDisabler(formElement, true);
                    $('.client_chatContent').append(`
                        <div class="send_container position-relative">
                            <small class="sender_name position-absolute">You</small>
                            <div class="send_chat d-flex flex-row justify-content-end">
                                <div class="p-3 send_chat_container" style="background-color: ${bgcolor}21;">
                                    <span class="mb-0 send_chat_message">${message}</span>
                                </div>
                            </div>
                        </div>
                    `).scrollTop($('.client_chatContent')[0].scrollHeight);
                },
                success: function () {
                    chatInput.val(null);
                    formDisabler(formElement, false);
                }
            });
        });

        // $('.chaticon').click(function(e) {
        //     $('.chatbox_container').slideDown();
        //     $('.chaticon').fadeOut();
        // });

        // Disable - For Later development
        // $('.chatbot_minimize').click(function(e) {
        //     $('.chatbox_container').slideUp();
        //     $('.chaticon').fadeIn();
        // });

    });
</script>