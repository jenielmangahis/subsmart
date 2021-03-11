<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php
    $this->load->view('includes/sidebars/api_connectors', $sidebar);
    ?>
    
    <style>
        .dboxfolders{
            margin-right: 15px;
            padding: 10px;
            font-size: 15px;
            height: 150px;
            cursor: pointer;
            text-align: center;
            text-transform: uppercase;
            
        }
    </style>

    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="row align-items-center mt-0 bg-white">
                <div class="card p-0 col-lg-12">
                    <div class="card-body" >
                        <div class="col-sm-12 justify-content-center">
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
                                            Dropbox for this Account is now Connected!
                                        </span>
                                    </div>
                                    <div class="col-lg-12" id="dboxFolders">
                                        <div class="progress" style="height:40px;"><div class="progress-bar progress-bar-striped bg-warning active" role="progressbar" style="width: 100%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Fetching Dropbox Data</div></div>
                                    </div>
                                </div>
                                
                                <input type="hidden" id="previousFolderPath" />
                                <input type="hidden" id="currentFolderPath" />
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
            }catch(e) {
                //console.log(e);
                //win.close();
            }
        }, 500);
    }
    
    function getFolderList(folderPath=null)
    {
        var url = "https://api.dropboxapi.com/2/files/list_folder";
        $('#previousFolderPath').val($('#currentFolderPath').val());
        $('#currentFolderPath').val(folderPath==null?"":folderPath);
        fetch(url,{
            method : 'POST',
            headers :{
                'Content-Type':'application/json',
                'Authorization':'Bearer <?= $this->session->dBoxData['dBoxAuthCode'] ?>'
            },
            body: JSON.stringify({
                path:folderPath==null?"":folderPath
            })
        }).then(res => {
            return res.json();
        }).then(data => processData(data, folderPath))
          .catch(error => console.log('Error :'+error));
    }
    
    function processData(data)
    {
        $('.progress').hide();
        $('#dboxFolders').html('')
        var pp = $('#previousFolderPath').val();
        if($('#currentFolderPath').val()!=""){
            $('#dboxFolders').append('<div onclick="getFolderList(\''+pp+'\')" class="dboxfolders float-left text-center col-lg-1"><i class="fa fa-folder fa-3x"></i><br />...</div>')
        }
        for(var i=0; i<=data.entries.length; i++)
        {
            //console.log(data.entries[i].name)
            if(data.entries[i]['.tag'] == 'folder'){
                $('#dboxFolders').append('<div onclick="getFolderList(\''+data.entries[i].path_lower+'\')" class="dboxfolders float-left text-center col-lg-1"><i class="fa fa-folder fa-3x"></i><br />'+data.entries[i].name+'</div>')
            }else{
                $('#dboxFolders').append('<div class="dboxfolders float-left text-center col-lg-1"><i class="fa fa-file fa-3x"></i><br />'+data.entries[i].name+'</div>')
            }
        }
    }
</script>

<?php
include viewPath('includes/footer');
