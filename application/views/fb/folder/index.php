<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  include viewPath('includes/header'); 
?>

<div class="wrapper px-0">
    <div __wrapper_section class="fb-wrapper">

        <div class="container-fluid my-3">
            <div class="row">
                <div class="col-12 col-md-3 bg-white py-3">
                    <button class="btn btn-success btn-sm" onclick="handleNewFolderClicked()">New Folder</button>
                    <div class="my-2 min-vh-100">
                        <table class="border-0 w-100">
                            <tbody id="newFolderTBody" class="d-none">
                                <tr class="bg-light folder-tr active">
                                    <td class="w-75 px-1">
                                        <b>New Folder<b><br><small>not saved yet</small>
                                    </td>
                                    <td class="w-25 px-1 text-right btn-td"></td>
                                </tr>
                            </tbody>
                            <tbody id="foldersTBody">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="row">
                        <h4 class="col-6">Forms</h4>
                        <p class="col-6 text-right"><i>Use Folders to organize your forms.</i></p>
                    </div>
                    <div class="card">
                        <div id="loadingContainer" class="bg-primary indicator">
                            <p class="text-white">loading...</p>
                        </div>
                        <div id="dangerIndicator" class="bg-danger indicator">
                            <p class="text-white">error saving changes.</p>
                        </div>
                        <div id="successIndicator" class="bg-success indicator">
                            <p class="text-white">changes saved.</p>
                        </div>
                        <div class="form-group w-50">
                            <label for="folder-name">Folder name:</label>
                            <input type="text" class="form-control" name="folder-name" id="folderName">
                        </div>
                        <div class="w-100 text-center">
                            <button class="btn btn-success" id="folderSaveBtn"
                                onclick="handleFolderSave()">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include viewPath('includes/footer'); ?>