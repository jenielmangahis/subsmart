<?php include viewPath('v2/includes/header'); ?>
<style>
    #scheduledcall_table_wrapper .dataTables_length,
    #scheduledcall_table_wrapper .dataTables_filter {
        display: none;
    }

    #scheduledcall_table > tbody {
        font-size: unset;
    }

    #customercontact_table > tbody > tr > td {
        vertical-align: middle;
    }

    .table > :not(:last-child) > :last-child > * {
        border-bottom: 1px solid #dee2e6;
    }

    .noWidth {
        width: 0% !important;
    }
    
    .dotsOption {
        text-decoration: none;
        color: gray;
    }
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/call_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">List of scheduled calls made by users seeking assistance with the system. Log in to the RingCentral floating widget first before using the call feature.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <input id="scheduledcall_table_search" class="form-control mt-0 mb-2 w-25" type="text" placeholder="Search...">
                        <table id="scheduledcall_table" class="table table-hover w-100 mb-3">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Notes</th>
                                    <th>Status</th>
                                    <th class="noWidth"></th>
                                </tr>
                            </thead>
                            <tbody><tr></tr></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var BASE_URL = window.origin;
    $.getScript('https://ringcentral.github.io/ringcentral-embeddable-voice/adapter.js').done(function() {
        setTimeout(() => {
            if ($('header[class="Adapter_header Adapter_minimized"]').length === 1) {
                $('.Adapter_minimizeIcon').click();
            }
        }, 1500);
    });

    $(document).on('click', '.call-customer', function () {
        if ($('header[class="Adapter_header Adapter_minimized"]').length === 1) {
            $('.Adapter_minimizeIcon').click();
        }
    });

    $(document).ready(function() {
        // DataTable Configuration ===============
        const scheduledcall_table = $('#scheduledcall_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": BASE_URL + "/TechSupportSidebar/viewSchedule",
                "type": "POST",
            },
            "language": {
                "infoFiltered": "",
            },
            // "order": [[0, 'desc'] ],
        });

        $('#scheduledcall_table_search').keyup(function() {
            scheduledcall_table.search($(this).val()).draw();
        });

        $('#scheduledcall_table').removeClass('dataTable');
    });


    // FOR FUTURE DEVELOPMENT
    // const config = {
    //     RINGCENTRAL_CLIENT_ID: '0FjReB9otaSe8mCb3MExzk',
    //     RINGCENTRAL_CLIENT_SECRET: '2GvWuHzygmOfSFm3WgFgcE3BisWM2vWYaeEIMVYUpJfQ',
    //     RINGCENTRAL_SERVER_URL: 'https://platform.ringcentral.com',
    //     REDIRECT_URL: window.location.href,
    // };

    // function connectRingCentralAPI() {
    //     const authUri = `${config.RINGCENTRAL_SERVER_URL}/restapi/oauth/authorize` + `?response_type=code` + `&client_id=${encodeURIComponent(config.RINGCENTRAL_CLIENT_ID)}` + `&redirect_uri=${encodeURIComponent(config.REDIRECT_URL)}`;

    //     const popup = window.open(authUri, 'RingCentralLogin', 'width=500,height=750');
    //     if (!popup) {
    //         Swal.fire({
    //             icon: "error",
    //             title: "Popup blocked!",
    //             html: "Please allow popups for this site.",
    //             showConfirmButton: true,
    //             confirmButtonText: "Okay",
    //             showCloseButton: true,
    //         });
    //         return;
    //     }

    //     const pollOAuth = setInterval(() => {
    //         try {
    //             if (!popup || popup.closed) {
    //                 clearInterval(pollOAuth);
    //                 Swal.fire({
    //                     icon: "error",
    //                     title: "Failed to Connect!",
    //                     html: "Login popup has been closed.",
    //                     showConfirmButton: true,
    //                     confirmButtonText: "Okay",
    //                     showCloseButton: true,
    //                 });
    //                 return;
    //             }

    //             const currentUrl = popup.location.href;
    //             if (currentUrl.includes(config.REDIRECT_URL)) {
    //                 clearInterval(pollOAuth);
    //                 popup.close();
    //                 const code = new URLSearchParams(currentUrl.split('?')[1]).get('code');

    //                 if (code) {
    //                     exchangeAuthorizationCodeForToken(code);
    //                 } else {
    //                     Swal.fire({
    //                         icon: "error",
    //                         title: "Error!",
    //                         html: "Authorization code not found.",
    //                         showConfirmButton: true,
    //                         confirmButtonText: "Okay",
    //                         showCloseButton: true,
    //                     });
    //                 }
    //             }
    //         } catch (e) {}
    //     }, 500);
    // }

    // function exchangeAuthorizationCodeForToken(code) {
    //     const tokenUrl = `${config.RINGCENTRAL_SERVER_URL}/restapi/oauth/token`;

    //     const body = {
    //         grant_type: 'authorization_code',
    //         code: code,
    //         redirect_uri: config.REDIRECT_URL,
    //         client_id: config.RINGCENTRAL_CLIENT_ID,
    //         client_secret: config.RINGCENTRAL_CLIENT_SECRET
    //     };

    //     $.ajax({
    //         url: tokenUrl,
    //         method: 'POST',
    //         data: body,
    //         dataType: 'json',
    //         success: function(data) {
    //             Swal.fire({
    //                 icon: "success",
    //                 title: "API Connected!",
    //                 html: "RingCentral API was connected successfully.",
    //                 showConfirmButton: true,
    //                 confirmButtonText: "Okay",
    //                 showCloseButton: true,
    //             });
    //             console.log('Access Token:', data.access_token);

    //             // $.ajax({
    //             //     url: 'https://platform.ringcentral.com/restapi/v1.0/account/~/extension/~/sms',
    //             //     method: 'POST',
    //             //     headers: {
    //             //         'Authorization': `Bearer ${data.access_token}`, 
    //             //         'Content-Type': 'application/json'
    //             //     },
    //             //     data: JSON.stringify({
    //             //         from: { phoneNumber: '+18333426872' },
    //             //         to: [{ phoneNumber: '+13135243034' }], 
    //             //         text: 'Hello! This is a test message from RingCentral.'
    //             //     }),
    //             //     success: function(response) {
    //             //         console.log('SMS sent successfully:', response);
    //             //     },
    //             //     error: function(xhr, status, error) {
    //             //         console.error('Failed to send SMS:', status, error);
    //             //     }
    //             // });

    //         },
    //         error: function(xhr, status, error) {
    //             console.error('Error:', error);
    //             Swal.fire({
    //                 icon: "error",
    //                 title: "Login Failed!",
    //                 html: "Failed to login: " + error,
    //                 showConfirmButton: true,
    //                 confirmButtonText: "Okay",
    //                 showCloseButton: true,
    //             });
    //         }
    //     });
    // }
</script>
<?php include viewPath('v2/includes/footer'); ?>