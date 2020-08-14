<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="documents module ui-state-default" id="docu">
    <div class="col-sm-12">
        <div class="row">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td width="100%" align="left" valign="top" class="issued"> <!--Paperwork Issued / Signed--> Issued/Received</td>
                </tr>
                <tr>
                    <td align="left" valign="top" style="padding-right:10px;">
                        <div  id="paper_place_load">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                <tr>
                                    <td width="" align="center" valign="top">
                                        <!-- updated on 10-11-2016 start (fixed client agreement permission issue) -->
                                        <input type="checkbox" class="cb" name="chk_paperwork[]" id="chk_paperwork_1" value="1" checked="">
                                        <!-- updated on 10-11-2016 end -->
                                    </td>
                                    <td align="left" valign="top">
                                        <iframe id="frame1" style="display:none"></iframe>
                                        <form name="uploadDoc" id="uploadDoc_1" method="post" enctype="multipart/form-data" action="" style="width:100%;">
                                            <div style="float:left; width:75%;">
                                                <input type="hidden" name="paperwork_id" value="1">
                                                <input type="hidden" name="paperworktxt" value="Client Agreement">
                                                <label title="Client Agreement" for="chk_paperwork_1">Client Agreement</label>&nbsp;<br>

                                                <input type="file" name="upload_document" id="upload_document_1" style="visibility:hidden; width:2px; height:1px;">
                                            </div>
                                            <div style="float:right;  width:70px;">
                                                <a href="javascript:void(0);" style="text-decoration:none;display:inline-block;"  title="Choose File" class="js-qwynlraxz">
                                                    <img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/file-upload.png" style="vertical-align:middle;">
                                                </a>
                                                <a href="" style="text-decoration:none;display:inline-block;" title="Download Document" class="js-qwynlraxz">
                                                    <img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/download-icon.png">
                                                </a>
                                                <a href="" style="text-decoration:none;display:inline-block;" title="Delete Document" class="js-qwynlraxz">
                                                    <img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/cross.png">
                                                </a>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="" align="center" valign="top">
                                        <!-- updated on 10-11-2016 start (fixed client agreement permission issue) -->
                                        <input type="checkbox" class="cb" name="chk_paperwork[]" id="chk_paperwork_4" value="4">
                                        <!-- updated on 10-11-2016 end -->
                                    </td>
                                    <td align="left" valign="top">
                                        <iframe id="frame1" style="display:none"></iframe>
                                        <form name="uploadDoc" id="uploadDoc_4" method="post" enctype="multipart/form-data" action="" style="width:100%;">
                                            <div style="float:left; width:75%;">
                                                <input type="hidden" name="paperwork_id" value="4">
                                                <input type="hidden" name="paperworktxt" value="Photo ID Copy">
                                                <label title="Photo ID Copy" for="chk_paperwork_4">Photo ID Copy</label>&nbsp;<br>

                                                <input type="file" name="upload_document" id="upload_document_4" style="visibility:hidden; width:2px; height:1px;">
                                            </div>
                                            <div style="float:right;  width:70px;">
                                                <a href="javascript:void(0);" style="text-decoration:none;display:inline-block;"  title="Choose File" class="js-qwynlraxz">
                                                    <img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/file-upload.png" style="vertical-align:middle;">
                                                </a>
                                                <a href="" style="text-decoration:none;display:inline-block;" title="Download Document" class="js-qwynlraxz">
                                                    <img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/download-icon.png">
                                                </a>
                                                <a href="" style="text-decoration:none;display:inline-block;" title="Delete Document" class="js-qwynlraxz">
                                                    <img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/cross.png">
                                                </a>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="25" align="center" valign="top">
                                        <!-- updated on 10-11-2016 start (fixed client agreement permission issue) -->
                                        <input type="checkbox" class="cb" name="chk_paperwork[]" id="chk_paperwork_6" value="6">
                                        <!-- updated on 10-11-2016 end -->
                                    </td>
                                    <td align="left" valign="top">
                                        <iframe id="frame1" style="display:none"></iframe>
                                        <form name="uploadDoc" id="uploadDoc_6" method="post" enctype="multipart/form-data" action="" style="width:100%;">
                                            <div style="float:left; width:75%;">
                                                <input type="hidden" name="paperwork_id" value="6">
                                                <input type="hidden" name="paperworktxt" value="Social Security Card (optional)">
                                                <label title="Social Security Card (optional)" for="chk_paperwork_6">Proof of Residency</label>&nbsp;<br>

                                                <input type="file" name="upload_document" id="upload_document_6" style="visibility:hidden; width:2px; height:1px;">
                                            </div>
                                            <div style="float:right;  width:70px;">
                                                <a href="javascript:void(0);" style="text-decoration:none;display:inline-block;"  title="Choose File" class="js-qwynlraxz">
                                                    <img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/file-upload.png" style="vertical-align:middle;">
                                                </a>
                                                <a href="" style="text-decoration:none;display:inline-block;" title="Download Document" class="js-qwynlraxz">
                                                    <img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/download-icon.png">
                                                </a>
                                                <a href="" style="text-decoration:none;display:inline-block;" title="Delete Document" class="js-qwynlraxz">
                                                    <img width="16px" height="16px" border="0" src="https://app.creditrepaircloud.com/application/images/cross.png">
                                                </a>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                </tbody></table>

                        </div>

                    </td>
                </tr>

                </tbody></table>
            <div style="margin-right:15px; padding-top:1px;" align="left" class="normaltext1">
                <a href="#" style="color:#58bc4f;">Customize list</a>&nbsp;&nbsp;

                <!--  <a href="javascript:void(0);">Action/Notes</a>-->
            </div>
        </div>
    </div>
</div>