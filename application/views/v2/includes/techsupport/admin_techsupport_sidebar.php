<script src="https://js.pusher.com/8.3.0/pusher.min.js"></script>
<style>
    #admin_chatbox,
    #admin_chatlist {
        border-radius: 15px;
    }

    .admin_chatboxHeader {
        border-top-left-radius: 15px !important;
        border-top-right-radius: 15px !important;
        background: #6a4a86;
    }

    .chatbot_image,
    .admin_realtimeImage {
        height: 50px;
        width: 50px;
    }

    .chatbot_name_section,
    .admin_chatNameSection {
        margin-left: 10px;
    }

    .chatbot_name,
    .client_name {
        font-weight: bold;
    }

    .chatbot_name_section>.chatbot_name,
    .admin_chatNameSection>.client_name {
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
    .admin_chatBody,
    .admin_chatlistBody {
        background: #f3f3f3;
        border-bottom-right-radius: 15px;
        border-bottom-left-radius: 15px;
        padding: unset;
    }

    .chatbot_chat_content,
    .admin_chatContent,
    .admin_chatlistContent {
        font-weight: 500;
    }

    .send_chat {
        padding-right: 10px;
    }

    .send_chat_container {
        border-radius: 10px;
        /* background-color: #6a4a8621;  */
        max-width: 350px;
    }

    .receive_chat {
        padding-left: 10px;
    }

    .receive_chat_container {
        border-radius: 10px;
        background-color: #f7f7f7;
    }

    .client_chat_bubble {
        padding-left: 10px;
        padding-top: 10px;
    }

    .admin_chatBubbleContainer {
        border-radius: 5px;
    }

    .admin_chatBubbleContainer:hover,
    .admin_chatBubbleContainer:hover ~ .client_business_image {
        background-color: white;
        cursor: pointer;
    }


    .initialMessage {
        padding-left: 10px;
        justify-self: center;
    }

    .initialMessage_container > i {
        color: darkgray;
    }

    .message_form_container {
        padding: 10px;
        border-top: 1px solid #00000020;
    }

    input[name="admin_chatMessage"] {
        border-bottom-left-radius: 10px;
    }

    .message_form_button {
        border-bottom-right-radius: 10px;
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
        bottom: 60px;
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

    .admin_supportSidebarCanvas {
        width: 435px;
    }

    .admin_supportSidebarCanvas > .offcanvas-header {
        background: #6a4a86;
    }

    .ccCheckbox {
        width: 18px;
        height: 18px;
    }

    .viewVideoFromBinderModal .modal-body {
        margin-bottom: -10px;
    }

    #admin_supportSidebarLabel {
        font-weight: bold; 
        margin: 0; 
        color: white;
    }

    .receive_chat_container > span > p,
    .admin_chatBubbleContainer > span > p {
        margin-bottom: 0;
    }

    .backToChatList {
        font-size: 33px;
        color: #ffffff75;
        transform: rotateY(180deg);
        position: absolute;
        right: 20px;
    }

    .backToChatList:hover {
        color: white;
    }

    .msgPadding {
        padding: 12px;
    }

    .admin_chatContent::-webkit-scrollbar,
    .admin_chatlistContent::-webkit-scrollbar {
        width: 10px; 
    }

    .admin_chatContent::-webkit-scrollbar-track,
    .admin_chatlistContent::-webkit-scrollbar-track {
        background: transparent;
    }

    .admin_chatContent::-webkit-scrollbar-thumb,
    .admin_chatlistContent::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.3); 
    }

    .admin_chatContent::-webkit-scrollbar-thumb:hover,
    .admin_chatlistContent::-webkit-scrollbar-thumb:hover {
        background: rgba(0, 0, 0, 0.5); 
    }

    .fw-normal {
        font-weight: 500 !important;
    }
    
    @keyframes pulseRed {
        0% {
            color: rgba(255, 0, 0, 0.7);
        }
        50% {
            color: rgb(0, 0, 0);
        }
        100% {
            color: rgba(255, 0, 0, 0.7);
        }
    }

    .testIcon {
        font-size: 40px; /* Adjust icon size */
        animation: pulseRed 1.5s infinite;
    }


</style>
<div class="offcanvas offcanvas-end admin_supportSidebarCanvas" tabindex="-1" id="admin_supportSidebarID" aria-labelledby="admin_supportSidebarLabel">
    <div class="offcanvas-header">
        <h5 id="admin_supportSidebarLabel">Tech Support <span class="badge bg-danger">Admin Panel</span></h5>
        <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close" style="color: white !important;float: left;padding: 0;"><span class="float-start"><small>Close</small></span></button>
    </div>
    <div class="offcanvas-body">
        <div class="container">
            <div class="row admin_supportMenuPanel" style="display: non;">
                <div class="col-12-md mb-3">
                    <h5 class="fw-bold">Manage and respond to client support requests efficiently.</h5>
                </div>
                <div class="col-12-md mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Client Support Chat</h5>
                            <p class="card-text">Monitor and respond to client inquiries in real-time.</p>
                            <a href="#" class="btn btn-primary fw-bold admin_openChat">
                                <i class="fas fa-headset"></i>&nbsp;&nbsp;View Chats
                            </a>
                        </div>
                        <div class="card-footer text-muted">
                            <i class="fas fa-info-circle"></i>&nbsp;&nbsp;Stay available to assist clients during operational hours.
                        </div>
                    </div>
                </div>
            </div>
            <div class="row admin_realtimeChat" style="display: none;">
                <div class="col-12-md">
                    <h4 class="fw-bold float-start">Client Support Chat</h4>
                    <span class="text-muted float-end cursorPointer returnToMenu"><i class='bx bxs-left-top-arrow-circle'></i> Return to Menu</span>
                </div>
                <div class="col-12-md mb-3">
                    <span>Monitor and respond to client inquiries in real-time. Stay available during operational hours to provide efficient support and assistance.</span>
                </div>
                <div class="col-12-md admin_chatContainer">
                    <div id="admin_chatlist" class="card" style="display: non;">
                        <div class="card-header admin_chatboxHeader d-flex align-items-center msgPadding text-white border-bottom-0">
                            <p class="mb-0 admin_chatNameSection"><span class="fw-normal">Chat List</span></p>
                        </div>
                        <div class="card-body admin_chatlistBody">
                            <div class="table-responsive admin_chatlistContent"></div>
                        </div>
                    </div>
                    <div id="admin_chatbox" class="card" style="display: none;">
                        <div class="card-header admin_chatboxHeader d-flex align-items-center msgPadding text-white border-bottom-0">
                            <img class="admin_realtimeImage" src="https://cdn-icons-png.flaticon.com/256/6009/6009864.png">
                            <p class="mb-0 admin_chatNameSection"><span class="client_name">[CLIENT_NAME]</span><br><small class="client_businessName">[CLIENT_BUSINESS_NAME]</small></p>
                            <i class="fas fa-sign-in-alt backToChatList cursorPointer"></i>
                        </div>
                        <div class="card-body admin_chatBody">
                            <div class="table-responsive admin_chatContent"></div>
                            <div class="typing_status clientTypingAnimation"><small class="text-muted"><span class="fw-normal">Client</span> is typing...</small></div>
                            <form id="admin_chatForm">  
                                <div class="input-group message_form_container">
                                    <input name="admin_chatMessage" class="form-control" type="text" placeholder="Type your message here..." autocomplete="off" required>
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

<script>
    var BASE_URL = window.origin;
    var CLIENT_ID = 0;
    var CLIENT_COMPANY_ID = 0;
    var CLIENT_CHANNEL = "";
    var CLIENT_EVENT = "";
    var CLIENT_IMAGE = "";
    var adminChatListPusher = null;
    var adminChatListChannel = null;
    var adminChatBoxPusher = null;
    var adminChatBoxChannel = null;
    var randomNum = () => Math.floor(1e9 + Math.random() * 9e9);

    function formDisabler(selector, state) {
        const element = $(selector);
        const submitButton = element.find('button[type="submit"]');
        element.find("input, button, textarea, select").prop('disabled', state);

        if (state) {
            element.find('a').hide();
            if (!submitButton.data('original-content')) {
                submitButton.data('original-content', submitButton.html());
            }
            submitButton.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin-pulse"></i> Processing...');
        } else {
            element.find('a').show();
            const originalContent = submitButton.data('original-content');
            if (originalContent) {
                submitButton.prop('disabled', false).html(originalContent);
            }
        }
    }

    function fetchChatList() {
        $.ajax({
            url: `${BASE_URL}/TechSupportSidebar/fetchChatList`,
            type: 'POST',
            beforeSend: function() {
                $('.fetchingChatlistLoader').remove();
                $('.admin_chatlistContent').append('<div class="position-relative fetchingChatlistLoader"><div class="receive_chat d-flex flex-row justify-content-center"><div class="msgPadding me-3"><i class="mb-0 text-muted">Fetching chat list, please wait...</i></div></div></div>');
            },
            success: function(response) {
                const data = JSON.parse(response);
                $('.fetchingChatlistLoader').remove();
                $('.admin_chatlistContent').html('');

                if (data.length > 0) {
                    data.forEach(function(chat) {
                        var clientName = decodeURIComponent(escape(chat.client_name));
                        const formattedMessage = chat.message.length > 100 ? chat.message.substr(0, 100) + '...' : chat.message;
                        const chatHtml = `
                            <div class="position-relative">
                                <div class="client_chat_bubble d-flex flex-row justify-content-start">
                                    <div class="msgPadding me-3 w-100 admin_chatBubbleContainer" 
                                        data-clientid="${chat.client_id}" 
                                        data-clientcompanyid="${chat.client_company_id}" 
                                        data-clientname="${clientName}" 
                                        data-clientbusinessname="${chat.client_business_name}" 
                                        data-clientbusinessimage="${BASE_URL}/${chat.client_business_image}?${randomNum()}" 
                                        data-channel="${chat.channel}" 
                                        data-event="${chat.event}">
                                        <div class="d-flex">
                                            <img src="${BASE_URL}/${chat.client_business_image}?${randomNum()}" alt="${chat.client_business_name}" 
                                                class="client_business_image me-2" 
                                                style="width: 50px; height: 50px; border-radius: 50%; align-self: flex-start;">
                                            <div>
                                                <strong>${clientName}</strong><br>
                                                <small>${chat.client_business_name}</small><br>
                                                <small class="text-muted"><i>${formattedMessage}</i></small>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        `;

                        $('.admin_chatlistContent').append(chatHtml);
                    });
                } else {
                    $('.admin_chatlistContent').append('<div class="position-relative fetchingChatlistLoader"><div class="receive_chat d-flex flex-row justify-content-center"><div class="msgPadding me-3"><i class="mb-0 text-muted">No chats available</i></div></div></div>');
                }
            }
        });
    }

    function fetchMessages(client_id) {
        const bgcolor = "#6a4a86";
        $.ajax({
            url: `${BASE_URL}/TechSupportSidebar/fetchMessages`,
            type: 'POST',
            data: {
                client_id: client_id
            },
            beforeSend: function() {
                $('.admin_chatContent').append(`
                        <div class="position-relative fetchingConversationLoader">
                            <div class="receive_chat d-flex flex-row justify-content-center">
                                <div class="msgPadding me-3">
                                    <i class="mb-0 text-muted">Fetching conversation, please wait...</i>
                                </div>
                            </div>
                        </div>
                    `);
            },
            success: function(response) {
                const data = JSON.parse(response);
                $('.fetchingConversationLoader').remove();
                $('.admin_chatContent').html('');

                data.forEach(msg => {
                    if (msg.client_id == client_id) {
                        if (msg.sender_type === "tech") {
                            $('.admin_chatContent').prepend(`
                                    <div class="send_container position-relative"> 
                                        <div class="send_chat d-flex flex-row justify-content-end"> 
                                            <div class="msgPadding send_chat_container" style="background-color:${bgcolor}21;"> 
                                                <span class="mb-0 send_chat_message">${msg.message}</span> 
                                            </div> 
                                        </div> 
                                    </div>
                                `);
                        } else if (msg.sender_type === "client") {
                            $('.admin_chatContent').prepend(`
                                    <div class="receive_container position-relative"> 
                                        <div class="receive_chat d-flex flex-row justify-content-start"> 
                                            <div class="msgPadding me-3 border receive_chat_container"> 
                                                <span class="mb-0">${msg.message}</span> 
                                            </div> 
                                        </div> 
                                    </div>
                                `);
                        }
                    }
                });

                $('.admin_chatContent').scrollTop($('.admin_chatContent')[0].scrollHeight);
            }
        });
    }

    function sendMessage(formElement) {
        const message = formElement.find('input[name="admin_chatMessage"]').val();
        const bgcolor = "#6a4a86";
        const data = {
            sender_type: 'tech',
            client_id: CLIENT_ID,
            client_company_id: CLIENT_COMPANY_ID,
            channel: CLIENT_CHANNEL,
            event: CLIENT_EVENT,
            message: message,
        };

        $.ajax({
            url: `${BASE_URL}/TechSupportSidebar/chatRequestProcess/send_message`,
            type: 'POST',
            data: data,
            beforeSend: function() {
                formDisabler(formElement, true);
                $('.fetchingChatlistLoader').remove();
            },
            success: function(response) {
                $('.admin_chatContent').append(`
                        <div class="send_container position-relative"> 
                            <div class="send_chat d-flex flex-row justify-content-end"> 
                                <div class="msgPadding send_chat_container" style="background-color: ${bgcolor}21;"> 
                                    <span class="mb-0 send_chat_message">${message}</span> 
                                </div> 
                            </div> 
                        </div>
                    `).scrollTop($('.admin_chatContent')[0].scrollHeight);
                formElement.find('input').val(null);
                formDisabler(formElement, false);
            }
        });
    }

    function chatNotification() {
        if (adminChatListPusher) {
            adminChatListPusher.disconnect();
        }

        Pusher.logToConsole = false;
        adminChatListPusher = new Pusher('33cfc0c407521da10fe6', {
            cluster: 'ap1'
        });
        adminChatListChannel = adminChatListPusher.subscribe('realtime_chatlist_channel');

        adminChatListChannel.unbind('chatlist_event');
        adminChatListChannel.bind('chatlist_event', function(data) {
            console.log('test');
            fetchChatList();
            if (!$('.admin_supportSidebarCanvas').hasClass('show')) {
                iziToast.info({
                    message: 'New messages on support chat. <strong><a href="#" class="openChatList">View</a></strong>',
                    displayMode: 1,
                    timeout: 10000,
                    position: 'bottomRight',
                });
            } else if ($('.admin_supportSidebarCanvas').hasClass('show') && $('#admin_chatbox').css('display') === 'none') {
                iziToast.info({
                    message: 'New messages on support chat.',
                    displayMode: 1,
                    timeout: 3000,
                    position: 'bottomRight',
                });
            }
        });
    } 

    $(document).ready(function() {
        chatNotification();
        $('input[name="admin_chatMessage"]').on('focus blur', function(event) {
            $.post(`${BASE_URL}/TechSupportSidebar/chatRequestProcess/tech_typing`, {
                isTyping: event.type === 'focus' ? 1 : 0,
                client_id: CLIENT_ID,
                client_company_id: CLIENT_COMPANY_ID,
                channel: CLIENT_CHANNEL,
                event: CLIENT_EVENT
            });
        });

        $(document).on('click', '.admin_openChat, .backToChatList', function() {
            $('.admin_chatlistContent').html('');
            const bgcolor = "#6a4a86";
            const tech_id = <?php echo $user_id; ?>;

            fetchChatList();
            $('.admin_supportMenuPanel').hide();
            $('.admin_realtimeChat').fadeIn();
            $('#admin_chatlist').fadeIn();
            $('#admin_chatbox').hide();

            const chatListContent_height = $(window).height() - 236;
            $('.admin_chatlistContent').css('height', `${chatListContent_height}px`);
        });

        $(document).on('click', '.admin_chatBubbleContainer', function() {
            $('.admin_chatContent').html('');
            const clientid = $(this).attr('data-clientid').trim();
            const clientcompanyid = $(this).attr('data-clientcompanyid').trim();
            const clientname = $(this).attr('data-clientname').trim();
            const clientbusinessname = $(this).attr('data-clientbusinessname').trim();
            const clientbusinessimage = $(this).attr('data-clientbusinessimage').trim();
            const channelName = $(this).attr('data-channel');
            const event = $(this).attr('data-event');
            const tech_id = <?php echo $user_id; ?>;
            CLIENT_ID = clientid;
            CLIENT_COMPANY_ID = clientcompanyid;
            CLIENT_CHANNEL = channelName;
            CLIENT_EVENT = event;
            CLIENT_IMAGE = clientbusinessimage;

            $('.client_name').text(clientname);
            $('.client_businessName').text(clientbusinessname);
            $('#admin_chatlist').hide();
            $('#admin_chatbox').fadeIn();
            $('.admin_realtimeImage').attr('src', `${clientbusinessimage}`);

            if (adminChatBoxPusher) {
                adminChatBoxPusher.disconnect();
            }

            Pusher.logToConsole = false;
            adminChatBoxPusher = new Pusher('33cfc0c407521da10fe6', { cluster: 'ap1' });
            adminChatBoxChannel = adminChatBoxPusher.subscribe(channelName);

            adminChatBoxChannel.unbind(event);
            adminChatBoxChannel.bind(event, function(data) {
                if (data.sender_type === "client") {
                    $('.admin_chatContent').append(`
                        <div class="receive_container position-relative">
                            <div class="receive_chat d-flex flex-row justify-content-start">
                                <div class="msgPadding me-3 border receive_chat_container">
                                    <span class="mb-0">${data.message}</span>
                                </div>
                            </div>
                        </div>
                    `).scrollTop($('.admin_chatContent')[0].scrollHeight);
                }

                switch (data.status) {
                    case 'client_isTyping':
                        $('.clientTypingAnimation').show();
                        $('.techTypingAnimation').hide();
                        break;
                    case 'client_isNotTyping':
                    case 'tech_isNotTyping':
                        $('.clientTypingAnimation').hide();
                        $('.techTypingAnimation').hide();
                        break;
                    case 'tech_isTyping':
                        $('.clientTypingAnimation').hide();
                        $('.techTypingAnimation').show();
                        break;
                }
            });

            fetchMessages(clientid);
            const admin_chatContentHeight = $(window).height() - 320;
            $('.admin_chatContent').css('height', `${admin_chatContentHeight}px`);
        });

        $('#admin_chatForm').on('submit', function(e) {
            e.preventDefault();
            sendMessage($(this));
        });

        $(document).on('click', '.openChatList', function () {
            iziToast.destroy(); 
            new bootstrap.Offcanvas($('.admin_supportSidebarCanvas').get(0)).show();

            setTimeout(() => {
                $('.admin_openChat').click();
            }, 500);
        });

        $(document).on('click', '.returnToMenu', function() {
            $('.admin_supportMenuPanel').fadeIn();
            $('.admin_realtimeChat').hide();
        });
    });
</script>