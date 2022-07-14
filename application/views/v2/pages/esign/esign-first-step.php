<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive.css" />
    <title>DocuSign</title>
</head>
<body>
    
    <!-- Header -->
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="left-part">
                        <a href="#" class="back-step"><i class="fa fa-angle-left"></i></a>
                        <p>Upload a Document and Add Envelope Recipients</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="right-part">
                        <ul>
                            <li><a href="#"><i class="fa fa-question-circle-o"></i></a></li>
                            <li class="dropdown"><a href="#" class="acdrop dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">HTML</a></li>
                                    <li><a href="#">CSS</a></li>
                                    <li><a href="#">JavaScript</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="recent-view">Recipient Preview </a></li>
                            <li><a href="#" class="recent-view next-btn">next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->

    <!-- Main Wrapper -->
    <section class="main-wrapper">
        <div class="container">
            <h1>Add Documents to the Envelope</h1>

            <div class="custome-fileup">
                <div class="upload-btn-wrapper">
                    <button class="btn">
                        <img src="images/fileup-ic.png" alt="">
                        <span>upload</span>
                    </button>
                    <input type="file" name="myfile" />
                </div>

                <div class="dropdown">
                    <button class="btn-upl dropdown-toggle" type="button" data-toggle="dropdown">Get from Cloud
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#"><img src="images/clude-ic1.png" alt=""> Box</a></li>
                        <li><a href="#"><img src="images/clude-ic2.png" alt=""> Dropbox</a></li>
                        <li><a href="#"><img src="images/clude-ic3.png" alt=""> Google Drive</a></li>
                        <li><a href="#"><img src="images/clude-ic4.png" alt=""> One Drive</a></li>
                    </ul>
                </div>
            </div>

            <div class="add-recipeit">
                <h1>Add Recipients to the Envelope</h1>

                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="add-note">
                            <p>As the sender, you automatically receive a copy of the completed envelope.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="quick-act">
                            <ul>
                                <li><a href="#"><i class="fa fa-address-book"></i> Add from contacts</a></li>
                                <li><a href="#"><i class="fa fa-code-fork"></i> Signing Order</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="rec-envlo-block">
                    <div class="row">
                        <div class="col-md-7 col-sm-8">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Main Wrapper -->

    <!-- Footer --->
    <footer>
        <div class="container-fluid">
            <ul>
                <li><a href="#">Send Now</a></li>
                <li><a href="#" class="next-btn">next</a></li>
            </ul>
        </div>
    </footer>
    <!-- End Footer --->

    <script type="text/javascript" src="js/jquery.min.js"></script> 
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>