<style>
    .sidebar {
        height: 100%;
        width: 45px;
        position: fixed;
        z-index: 100;
        top: 90px;
        left: 0;
        background-color: #32243d;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 20px;
    }

    .sidebar a {
        text-decoration: none;
        font-size: 20px;
        color: #fff;
        display: block;
        transition: 0.3s;
        padding: 10px;
        text-align: center;
    }

    .sidebar a:hover {
        color: #f1f1f1;
        background-color: #444;
    }

    .sidebar .closebtn {
        position: absolute;
        top: 0;
        font-size: 25px;
        display: none;
    }

    .openbtn {
        font-size: 20px;
        cursor: pointer;
        color: white;
    }

    .openbtn:hover {
        background-color: #444;
    }

    #main {
/*        transition: margin-left .5s;*/
        padding: 16px;
        margin-left:45px;
    }

    /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
    @media screen and (max-height: 450px) {
        .sidebar {padding-top: 15px;}
        .sidebar a {font-size: 18px;}
    }
    
    #dashOverlay{
        display:none;
        height: 100vh;
        width:99%;
        background: white;
        transition: margin-left .5s;
    }
    .a-title{
        display:none;
    }
    #controlBtn{
        display: none;
    }
</style>
</head>
<body>

    <div id="mySidebar" class="sidebar">
        <a id="controlBtn" style="display: none;" onclick="closeBtn()" href="#"><svg style="fill:white;" viewBox="0 0 16 14" id="svg-sprite-menu-close" xmlns="http://www.w3.org/2000/svg" transform="scale(1, -1)" width="20px" height="100%"><path d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z"></path></svg></a>
        <a class="links" href="#"><i class="fa fa-sms fa-fw"></i> <span class="a-title">SMS</span></a>
        <a class="links" href="#"><i class="fas fa-photo-video fa-fw"></i> <span class="a-title">MMS</span></a>
        <a class="links" href="#"><i class="fa fa-phone-alt fa-fw"></i> <span class="a-title">Call Logs</span></a>
        <a class="links" href="#"><i class="fa fa-clone fa-fw"></i> <span class="a-title">Smart Zoom</span></a>
        <a class="links" href="#"><i class="fa fa-inbox fa-fw"></i> <span class="a-title">Inbox</span></a>
        <a class="links" href="#"><i class="fa fa-paper-plane fa-fw"></i> <span class="a-title">Sent</span></a>
        <a class="links" href="#"><i class="fa fa-headset fa-fw"></i> <span class="a-title">Support</span></a>
    </div>
    <div id="dashOverlay" class="col-lg-12">
        <h3 class="text-center">Content here</h3>
    </div>

    <script type="text/javascript">
        
        $(document).ready(function(){
            var sidebar = $('#mySidebar');
            $('.sidebar a.links').click(function(){
                if(!sidebar.hasClass('open'))
                {
                    $('.sidebar a.links').attr('style','text-align:left;');
                    sidebar.addClass('open');
                    document.getElementById("mySidebar").style.width = "200px";
                    document.getElementById("dashOverlay").style.marginLeft = "200px";
                    $('#dashOverlay').show();
                    $('.a-title').show();
                }
                $('#controlBtn').attr('style','display:block; text-align:right;');
            });
        });
        function closeBtn(){
            var sidebar = $('#mySidebar');
            sidebar.removeClass('open');
            $('.sidebar a.links').attr('style','text-align:center;');
            $('.a-title').hide();
            document.getElementById("mySidebar").style.width = "45px";
            $('#dashOverlay').hide();
                $('#controlBtn').attr('style','display:none;');
        };
    </script>