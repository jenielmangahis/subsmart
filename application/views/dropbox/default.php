<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php
    $this->load->view('includes/sidebars/api_connectors', $sidebar);
    ?>

    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="row align-items-center mt-0 bg-white">
                <div class="card p-0">
                    <div class="card-body" >
                        <div class="col-sm-12">
                            <h3 class="page-title">Dropbox</h3>
                            <div class="alert alert-warning col-lg-12 mt-4 mb-4" role="alert">
                                <span style="color:black;">
                                    Lorem Ipsum
                                </span>
                            </div>
                            <?php 
                            if ($this->session->dBoxIsAuthenticated): ?>

                                <div class="col-lg-12" id="droboxBody">
                                    <div class="alert alert-success col-lg-12 mt-4 mb-4" role="alert">
                                        <span style="color:black;">
                                            Dropbox for this Account is now Connected with token: <?= $this->session->dBoxData['dBoxAuthCode'] ?>!
                                        </span>
                                    </div>

                                </div>
                            <?php else: ?>
                                <button class="btn btn-small btn-primary" onclick="authorize()">Login to Dropbox</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    var appKey = 'yr72ccr2b8243i8';
    var redirectUri = 'http://localhost/projects/nsmartrac/dropbox';

    $(document).ready(function(){
        getFolderList()
    });
    
    function authorize()
    {
        var authUri = 'https://www.dropbox.com/oauth2/authorize?client_id='+appKey+'&response_type=token&redirect_uri='+redirectUri;
        var win         = window.open(authUri, 'windowname1', 'width=800, height=600'); 
        var pollOAuth   = window.setInterval(function() { 
            try {
                console.log(win.location.hash);
                var fn = win.location.hash.replace('#','&');
                
                var callbackUrl = win.document.URL;
                if (callbackUrl.indexOf(redirectUri) != -1) {
                    window.clearInterval(pollOAuth);
                    var newURI = redirectUri+'?authCallBack'+fn;
                    win.close();
                    document.location = newURI;
                    //console.log(newURI)
                }
                
                
//                if(fn.length){
//                    for(var i=0; i < fn.length;i++){
//                        console.log(fn[i]);
//                    }
//                }
            }catch(e) {
                //console.log(e);
                //win.close();
            }
        }, 500);
    }
    
    function getFolderList()
    {
        
        var url = "https://api.dropboxapi.com/2/files/list_folder";
        
        fetch(url,{
            method : 'POST',
            headers :{
                'Content-Type':'application/json',
                'Authorization':'Bearer <?= $this->session->dBoxData['dBoxAuthCode'] ?>'
            },
            body: JSON.stringify({
                path:""
            })
        }).then(res => {
            return res.json();
        }).then(data => processData(data));
    }
    
    function processData(data)
    {
        console.log(data.entries)
    }
    
    function getListOfFolder()
    {
        var url = "https://api.dropboxapi.com/2/files/list_folder";

        var xhr = new XMLHttpRequest();
        xhr.open("POST", url);

        xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->dBoxData['dBoxAuthCode'] ?>");
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                console.log(xhr.status);
                console.log(xhr.responseText);
                $('#droboxBody').html(xhr.responseText);
            }
        };

        var data = '{"path": ""}';

        xhr.send(data);
    }

</script>

<?php
include viewPath('includes/footer');
