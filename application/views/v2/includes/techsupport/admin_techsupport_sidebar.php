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
    }

    .client_chat_bubble {
        padding-left: 10px;
        padding-top: 10px;
    }

    .admin_chatBubbleContainer {
        border-radius: 5px;
    }

    .admin_chatBubbleContainer:hover {
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
                        <div class="card-header admin_chatboxHeader d-flex align-items-center p-3 text-white border-bottom-0">
                            <p class="mb-0 admin_chatNameSection"><span>Chat List</span></p>
                        </div>
                        <div class="card-body admin_chatlistBody">
                            <div class="table-responsive admin_chatlistContent"></div>
                        </div>
                    </div>
                    <div id="admin_chatbox" class="card" style="display: none;">
                        <div class="card-header admin_chatboxHeader d-flex align-items-center p-3 text-white border-bottom-0">
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
        $('input[name="admin_chatMessage"]').on('focus', function() {
            $.ajax({
                url: BASE_URL + '/TechSupportSidebar/realtimeChatPusherRequest/tech_typing',
                type: 'POST',
                data: {
                    isTyping: 1,
                    client_id: CLIENT_ID,
                    client_company_id: CLIENT_COMPANY_ID,
                    channel: CLIENT_CHANNEL,
                    event: CLIENT_EVENT,
                }
            });
        });

        $('input[name="admin_chatMessage"]').on('blur', function() {
            $.ajax({
                url: BASE_URL + '/TechSupportSidebar/realtimeChatPusherRequest/tech_typing',
                type: 'POST',
                data: {
                    isTyping: 0,
                    client_id: CLIENT_ID,
                    client_company_id: CLIENT_COMPANY_ID,
                    channel: CLIENT_CHANNEL,
                    event: CLIENT_EVENT,
                }
            });
        });

        $(document).on('click', '.admin_openChat, .backToChatList', function() {
            $('.admin_chatlistContent').html('');
            const bgcolor = "#6a4a86";
            const tech_id = <?php echo $user_id; ?>;

            $.ajax({
                url: BASE_URL + '/TechSupportSidebar/fetchClientChatList',
                type: 'POST',
                beforeSend: function() {
                    $('.admin_chatlistContent').append('<div class="position-relative fetchingChatlistLoader"><div class="receive_chat d-flex flex-row justify-content-center"><div class="p-3 me-3"><i class="mb-0 text-muted">Fetching chat list, please wait...</i></div></div></div>');
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    $('.fetchingChatlistLoader').remove();

                    data.forEach(function(chat) {
                        let clientName = chat.client_name;
                        clientName = decodeURIComponent(escape(clientName));
                        const clientMessage = chat.message;
                        const formattedMessage = chat.message.length > 100 ? chat.message.substr(0, 100) + '...' : chat.message;
                        const chatHtml = `
                            <div class="position-relative">
                                <div class="client_chat_bubble d-flex flex-row justify-content-start">
                                    <div class="p-3 me-3 w-100 admin_chatBubbleContainer" data-clientid='${chat.client_id}' data-clientcompanyid='${chat.client_company_id}' data-clientname='${clientName}' data-clientbusinessname='${chat.client_business_name}' data-channel='${chat.channel}' data-event='${chat.event}'>
                                        <span class="mb-0">
                                            <strong>${clientName}</strong><br>
                                            <small>${chat.client_business_name}</small><br>
                                            <small class="text-muted"><i>${formattedMessage}</i></small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        `;

                        $('.admin_chatlistContent').prepend(chatHtml);
                    });
                }
            });

            $('.admin_supportMenuPanel').hide();
            $('.admin_realtimeChat').fadeIn();
            $('#admin_chatlist').fadeIn();
            $('#admin_chatbox').hide();

            let chatListContent_height = $(window).height() - 242;
            $('.admin_chatlistContent').css('height', chatListContent_height + 'px');
        });

        $(document).on('click', '.admin_chatBubbleContainer', function() {
            $('.admin_chatContent').html('');
            const clientid = $(this).attr('data-clientid').trim();
            const clientcompanyid = $(this).attr('data-clientcompanyid').trim();
            const clientname = $(this).attr('data-clientname').trim();
            const clientbusinessname = $(this).attr('data-clientbusinessname').trim();
            const channelName = $(this).attr('data-channel');
            const event = $(this).attr('data-event');
            const bgcolor = "#6a4a86";
            const tech_id = <?php echo $user_id; ?>;
            CLIENT_ID = clientid;
            CLIENT_COMPANY_ID = clientcompanyid;
            CLIENT_CHANNEL = channelName;
            CLIENT_EVENT = event;

            if (typeof pusher === 'undefined') {
                Pusher.logToConsole = false;
                var pusher = new Pusher('33cfc0c407521da10fe6', {
                    cluster: 'ap1'
                });
            }

            if (typeof channel !== 'undefined' && channel !== null) {
                pusher.unsubscribe(channel);
            }

            var channel = pusher.subscribe(channelName);

            channel.bind(event, function(data) {
                if (data.sender_type === "client") {
                    $('.admin_chatContent').append(`
                        <div class="receive_container position-relative">
                            <small class="receiver_name position-absolute">${clientname}</small>
                            <div class="receive_chat d-flex flex-row justify-content-start">
                                <div class="p-3 me-3 border receive_chat_container">
                                    <span class="mb-0">${data.message}</span>
                                </div>
                            </div>
                        </div>
                    `).scrollTop($('.admin_chatContent')[0].scrollHeight);
                }

                switch (data.status) {
                    case 'client_isTyping':
                        $('.clientTypingAnimation').fadeIn('fast');
                        $('.techTypingAnimation').hide();
                        break;
                    case 'client_isNotTyping':
                        $('.clientTypingAnimation').hide();
                        $('.techTypingAnimation').hide();
                        break;
                    case 'tech_isTyping':
                        $('.clientTypingAnimation').hide();
                        $('.techTypingAnimation').fadeIn('fast');
                        break;
                    case 'tech_isNotTyping':
                        $('.clientTypingAnimation').hide();
                        $('.techTypingAnimation').hide();
                        break;
                }
            });

            $('.client_name').text(clientname);
            $('.client_businessName').text(clientbusinessname);
            $('#admin_chatlist').hide();
            $('#admin_chatbox').fadeIn();

            $.ajax({
                url: BASE_URL + '/TechSupportSidebar/fetchClientMessages',
                type: 'POST',
                data: {
                    client_id: clientid
                },
                beforeSend: function() {
                    $('.admin_chatContent').append(`
                        <div class="position-relative fetchingConversationLoader">
                            <div class="receive_chat d-flex flex-row justify-content-center">
                                <div class="p-3 me-3">
                                    <i class="mb-0 text-muted">Fetching conversation, please wait...</i>
                                </div>
                            </div>
                        </div>
                    `);
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    $('.fetchingConversationLoader').remove();
                    data.forEach(msg => {
                        if (msg.client_id == clientid) {
                            if (msg.sender_type === "tech") {
                                $('.admin_chatContent').prepend(`
                                    <div class="send_container position-relative"> 
                                        <small class="sender_name position-absolute">You</small> 
                                        <div class="send_chat d-flex flex-row justify-content-end"> 
                                            <div class="p-3 send_chat_container" style="background-color:${bgcolor}21;"> 
                                                <span class="mb-0 send_chat_message">${msg.message}</span> 
                                            </div> 
                                        </div> 
                                    </div>
                                `);
                            } else if (msg.sender_type === "client") {
                                $('.admin_chatContent').prepend(`
                                    <div class="receive_container position-relative"> 
                                        <small class="receiver_name position-absolute">${msg.client_name}</small> 
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

                    $('.admin_chatContent').scrollTop($('.admin_chatContent')[0].scrollHeight);
                }
            });

            let admin_chatContentHeight = $(window).height() - 334;
            $('.admin_chatContent').css('height', admin_chatContentHeight + 'px');
        });

        $('#admin_chatForm').on('submit', function(e) {
            e.preventDefault();
            const formElement = $(this);
            const message = $(this).find('input[name="admin_chatMessage"]').val();
            let bgcolor = "#6a4a86";
            const data = {
                sender_type: 'tech',
                client_id: CLIENT_ID,
                client_company_id: CLIENT_COMPANY_ID,
                channel: CLIENT_CHANNEL,
                event: CLIENT_EVENT,
                message: message,
            };

            $.ajax({
                url: BASE_URL + '/TechSupportSidebar/realtimeChatPusherRequest/send_message',
                type: 'POST',
                data: data,
                beforeSend: function() {
                    formDisabler(formElement, true);
                    $('.admin_chatContent').append('<div class="send_container position-relative"> <small class="sender_name position-absolute">You</small> <div class="send_chat d-flex flex-row justify-content-end"> <div class="p-3 send_chat_container" style="background-color: ' + bgcolor + '21;"> <span class="mb-0 send_chat_message">' + message + '</span> </div> </div> </div>').scrollTop($('.admin_chatContent')[0].scrollHeight);
                },
                success: function(response) {
                    formElement.find('input').val(null);
                    formDisabler(formElement, false);
                }
            });
        });

        $(document).on('click', '.returnToMenu', function() {
            $('.admin_supportMenuPanel').fadeIn();
            $('.admin_realtimeChat').hide();
        });
    });
</script>