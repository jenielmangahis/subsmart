<style>
    .form-control {
        font-size: 12px;
        height: 30px !important;
        line-height: 150%;
    }
    label{
        font-size: 12px !important;
        margin-bottom: 1px !important;
    }
    hr{
        border: 2px solid #32243d !important;
        width: 100%;
    }
    .form-group {
        margin-bottom: 3px !important;
    }
    .required{
        color : red!important;
    }
    .msg-count-cus {
        height: 30px;
        width: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
    }

    #overlay {
        display: none;
        background: rgba(255, 255, 255, 0.7);
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
        z-index: 9998;
        align-items: center;
        justify-content: center;
        margin: auto;
    }
    .mapping-line{
        text-align: right;
        right: 0;
        position: absolute;
    }
    table{
    overflow-x:scroll !important;
    overflow-y:scroll !important;
    display:block !important;
    height:500px !important;
    }
    /**  */
    * {
    margin: 0;
    padding: 0;
    }
    #progress-bar-container li .step-inner {
    position: absolute;
    width: 100%;
    bottom: 0;
    font-size: 14px;
    }

    #progress-bar-container li.active,
    #progress-bar-container li:hover {
    color: #444;
    }

    #progress-bar-container li::after {
    content: " ";
    display: block;
    width: 6px;
    height: 6px;
    background-color: #777;
    margin: auto;
    border: 7px solid #fff;
    border-radius: 50%;
    margin-top: 40px;
    box-shadow: 0 2px 13px -1px rgba(0, 0, 0, 0.2);
    transition: all ease 0.25s;
    }
    #progress-bar-container li:hover::after {
    background: #555;
    }

    #progress-bar-container li.active::after {
    background: #207893;
    }

    #progress-bar-container #line {
    width: 80%;
    margin: auto;
    background-color: #eee;
    height: 6px;
    position: absolute;
    left: 10%;
    top: 57px;
    z-index: 1;
    border-radius: 50px;
    transition: all ease 0.75s;
    }

    #progress-bar-container #line-progress {
    content: " ";
    width: 8%;
    height: 100%;
    background-color: #207893;
    background: linear-gradient(to right #207893 0%, #2ea3b7 100%);
    position: absolute;
    z-index: 2;
    border-radius: 50px;
    transition: 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.25);
    }
    #progress-content-section {
    position: relative;
    top: 100px;
    width: 90%;
    margin: auto;
    background: #f3f3f3;
    border-radius: 4px;
    }
    #progress-content-section .section-content {
    padding: 30px 40px;
    text-align: center;
    }

    .section-content h2 {
    font-size: 17px;
    text-transform: uppercase;
    color: #333;
    letter-spacing: 1px;
    }

    .section-content p {
    font-size: 16px;
    line-height: 1.8rem;
    color: #777;
    }

    .section-content {
    display: none;
    animation: FadeinUp 0.7s ease 1 forwards;
    transform: translateY(15px);
    opacity: 0;
    }

    .section-content.active {
    display: block;
    opacity: 1;
    }
    .progress-wrapper {
    margin: auto;
    max-width: auto;
    }
    #progress-bar-container {
    position: relative;
    width: 90%;
    margin: auto;
    height: 100%;
    margin-top: 65px;
    }
    #progress-bar-container ul {
    padding-top: 15px;
    z-index: 999;
    position: absolute;
    width: 100%;
    margin-top: -40px;
    }
    #progress-bar-container li::before {
    content: " ";
    display: block;
    margin: auto;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: 2px solid #aaa;
    transition: all ease 0.3s;
    }

    #progress-bar-container li.active::before,
    #progress-bar-container li:hover::before {
    border: 2px solid #fff;
    background-color: #32243d;
    }

    #progress-bar-container li {
    list-style: none;
    float: left;
    width: 33%;
    text-align: center;
    color: #aaa;
    text-transform: uppercase;
    font-size: 11px;
    cursor: pointer;
    font-weight: 700;
    transition: all ease 0.2s;
    vertical-align: bottom;
    height: 60px;
    position: relative;
    }

    @keyframes FadeInUp {
    0% {
        transform: translateY(15px);
        opacity: 0;
    }
    100% {
        transform: translateY(0px);
        opacity: 1;
    }
    }

    .btn-primary:disabled {
        color: #fff !important;;
        background-color: #ccc !important;
        border: 1px solid transparent !important;;
    }

    .tbl { border-collapse: collapse;}
    .tbl th, .tbl td { padding: 2px; border: solid 1px #777; }
    .tbl th { background-color: lightblue; }
    .tbl-separate { border-collapse: separate; border-spacing: 5px;}
</style>
