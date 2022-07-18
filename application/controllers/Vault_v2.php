<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vault_v2 extends MY_Controller
{

    private $company_folder = '';

    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->hasAccessModule(46);
        $this->page_data['page']->title = 'Files Management';
        $this->page_data['page']->menu = 'vault';

        $this->company_folder = getCompanyFolder();
        add_css([
            'assets/css/vault/vault.css',
            'assets/plugins/font-awesome/css/font-awesome.min.css',
        ]);
    }

    public function index()
    {
        $this->page_data['folder_manager'] = getFolderManagerView_v2();
        $this->page_data['page']->title = 'Shared Library';
        $this->load->view('v2/pages/vault/shared_library', $this->page_data);
    }

    public function mylibrary()
    {
        $this->page_data['folder_manager'] = getFolderManagerView_v2(true, true);
        add_footer_js(['assets/js/vaults/dataTables.checkboxes.min.js']);
        $this->load->view('vault/list', $this->page_data);
    }

    public function beforeafter()
    {
        $this->load->model('Before_after_model', 'before_after_model');
        $comp_id = logged('company_id');
        $this->page_data['photos'] = $this->before_after_model->getAllByCompanyId($comp_id);
        $this->load->view('vault/beforeafter', $this->page_data);
    }

    public function businessformtemplates()
    {
        $this->page_data['folder_manager'] = getFolderManagerView_v2(true, false, true);
        $this->load->view('vault/businessformtemplates', $this->page_data);
    }

    public function add()
    {
        $return = array(
            'error' => '',
        );

        $permissions = getUserFileVaultPermissions();
        if ($permissions['add_file'] == 1) {
            $uid = logged('id');
            $company_id = logged('company_id');

            $folder_id = $_POST['folder_id'];
            $file_desc = '';
            $category = '';

            if (isset($_POST['file_desc'])) {
                $file_desc = $_POST['file_desc'];
            }

            if (isset($_POST['category'])) {
                $category = $_POST['category'];
            }

            if (!empty($_FILES['fullfile'])) {
                $filename = $_FILES['fullfile']['name'];
                $filesize = $_FILES['fullfile']['size'];

                if ($filesize <= 8000000) {
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);

                    $record = $this->db->query(
                        'select count(file_id) as `existing`, category_id, softdelete from filevault where folder_id = ' . $folder_id . ' and lower(title) = "' . strtolower($filename) . '" and company_id = ' . $company_id . ' GROUP BY file_id'
                    )->row();

                    if ($record && $record->existing > 0) {
                        $return['error'] = 'File already exists';
                        if ($record->softdelete > 0) {
                            $return['error'] .= ' in recycle bin.';
                        } else if (!empty($record->category_id)) {
                            $return['error'] .= ' in <strong>Business Form Templates</strong> section';
                        }
                    } else {
                        if ($folder_id > 0) {
                            $folder = $this->folders_model->getById($folder_id);
                            $folder_path = $folder->path;
                        } else {
                            $folder_path = '/';
                        }

                        $this->uploadlib->initialize([
                            'file_name' => $filename,
                        ]);

                        $file = $this->uploadlib->uploadImage('fullfile', $this->company_folder . $folder_path);

                        if ($file['status'] === false) {
                            echo json_encode($file);
                            return;
                        }

                        if ($file['status']) {
                            $data = array(
                                'title' => $filename,
                                'description' => $file_desc,
                                'file_path' => $folder_path . $filename,
                                'modified' => date('Y-m-d h:i:s'),
                                'created' => date('Y-m-d h:i:s'),
                                'file_size' => $filesize,
                                'folder_id' => $folder_id,
                                'user_id' => $uid,
                                'company_id' => $company_id,
                            );

                            if ($category != '') {
                                $data['category_id'] = $category;
                            }

                            if (!$this->vault_model->trans_create($data)) {
                                $return['error'] = 'Error in uploading file';
                            }
                        }
                    }
                } else {
                    $return['error'] = 'File is larger than 8mb';
                }
            } else {
                $return['error'] = 'No file to upload';
            }
        } else {
            $return['error'] = 'You dont have permission for adding a file';
        }

        echo json_encode($return);
    }

    public function delete()
    {
        $uid = logged('id');

        $return = array(
            'folder_id' => 0,
            'error' => '',
        );

        $permissions = getUserFileVaultPermissions();
        if ($permissions['trash_folder_file'] == 1) {
            $section = $_POST['section'];
            $file_id = $_POST['file_id'];
            $file = $this->vault_model->getById($file_id);

            if (($file->user_id != $uid) && (($section == 'sharedlibrary') || ($section == 'businessformtemplates'))) {
                $return['error'] = 'Cannot delete file. File is not yours.';
            } else {
                $data = array(
                    'softdelete' => 1,
                    'softdelete_date' => date('Y-m-d h:i:s'),
                    'softdelete_by' => $uid,
                );

                if (!$this->vault_model->trans_update($data, array('file_id' => $file_id))) {
                    $return['error'] = 'Error in deleting file';
                }
            }
        } else {
            $return['error'] = 'You dont have permission to put a file to recycle bin';
        }

        echo json_encode($return);
    }

    public function remove()
    {
        $return = array(
            'folder_id' => 0,
            'error' => '',
        );

        $permissions = getUserFileVaultPermissions();
        if ($permissions['remove_folder_file'] == 1) {
            $file_id = $_POST['file_id'];
            $file = $this->vault_model->getById($file_id);

            if ($this->vault_model->trans_delete(array(), array('file_id' => $file_id))) {
                unlink('./uploads/' . $this->company_folder . $file->file_path);

                $return['folder_id'] = $file->folder_id;
            } else {
                $return['error'] = 'Error in deleting file';
            }
        } else {
            $return['error'] = 'You dont have permission to delete a file permanently';
        }

        echo json_encode($return);
    }

    public function file_exists()
    {
        $return = false;

        echo $return;
    }

    public function most_downloads_files()
    {
        $company_id = logged('company_id');

        $sql = 'select ' .

            'a.*, ' .
            'b.FName as FCreatedBy, b.LName as LCreatedBy, ' .
            'c.folder_name ' .

            'from filevault a ' .
            'left join users b on b.id = a.user_id ' .
            'left join business_profile c on c.id = a.company_id ' .

            'where a.company_id = ' . $company_id . ' and a.downloads_count is not null and a.category_id is null ' .

            'order by downloads_count DESC limit 10';

        $return = $this->db->query($sql)->result_array();

        echo json_encode($return);
    }

    public function most_previewed_files()
    {
        $company_id = logged('company_id');

        $sql = 'select ' .

            'a.*, ' .
            'b.FName as FCreatedBy, b.LName as LCreatedBy, ' .
            'c.folder_name ' .

            'from filevault a ' .
            'left join users b on b.id = a.user_id ' .
            'left join business_profile c on c.id = a.company_id ' .

            'where a.company_id = ' . $company_id . ' and a.previews_count is not null and a.category_id is null ' .

            'order by previews_count DESC limit 10';

        $return = $this->db->query($sql)->result_array();

        echo json_encode($return);
    }

    public function recently_uploaded_files_old()
    {
        $company_id = logged('company_id');

        $sql = 'select ' .

            'a.*, ' .
            'DATEDIFF(NOW(), a.created) as `days`, ' .
            'b.FName as FCreatedBy, b.LName as LCreatedBy, ' .
            'c.folder_name ' .

            'from filevault a ' .
            'left join users b on b.id = a.user_id ' .
            'left join business_profile c on c.id = a.company_id ' .

            'where a.company_id = ' . $company_id . ' and (DATEDIFF(NOW(), a.created) <= 3) and a.category_id is null ' .

            'order by created DESC limit 10';

        $return = $this->db->query($sql)->result_array();

        echo json_encode($return);
    }

    public function recently_uploaded_files()
    {
        // herbert's code
        $companyId = logged('company_id');
        $limit = 7;

        $sql = 'select ' .
            'a.*, ' .
            'DATEDIFF(NOW(), a.created) as `days`, ' .
            'b.FName as FCreatedBy, b.LName as LCreatedBy, ' .
            'c.folder_name ' .

            'from filevault a ' .
            'left join users b on b.id = a.user_id ' .
            'left join business_profile c on c.id = a.company_id ' .

            'where a.company_id = ' . $companyId . ' and a.category_id is null ' .
            'order by created DESC limit ' . $limit;

        $results = $this->db->query($sql)->result_array();
        echo json_encode($results);
    }

    public function download_file($file_id)
    {
        $file = $this->vault_model->getById($file_id);
        $path = '/uploads/' . $this->company_folder . $file->file_path;
        $fc = file_get_contents($path);

        $data = array(
            'downloads_count' => $file->downloads_count + 1,
        );

        $status = $this->vault_model->trans_update($data, array('file_id' => $file_id));

        force_download($file->title, $fc);
    }

    public function update_preview($file_id)
    {
        $file = $this->vault_model->getById($file_id);
        $data = array(
            'previews_count' => $file->previews_count + 1,
        );

        $status = $this->vault_model->trans_update($data, array('file_id' => $file_id));
    }

    public function search_files_and_folders($getByCurrentUser = 0, $getByCategory = 0)
    {
        $keyword = $_GET['keyword'];
        $search_folders = $_GET['search_folders'];
        $search_files = $_GET['search_files'];

        $ofUser = ($getByCurrentUser == 1);
        $ofCategorized = ($getByCategory == 1);

        $files_and_folders = searchFilesOrFolders($keyword, $search_folders, $search_files, $ofUser, $ofCategorized);

        echo json_encode($files_and_folders);
    }

    public function getFile($file_id)
    {
        $return = $this->db->query('select file_id, title, description, file_path, category_id from filevault where file_id = ' . $file_id)->row_array();

        echo json_encode($return);
    }

    public function move($to_folder = 0, $file_id = 0)
    {
        $uid = logged('id');

        $return = array(
            'error' => '',
        );

        $permissions = getUserFileVaultPermissions();
        if ($permissions['move_folder_file'] == 1) {
            if ($file_id > 0) {
                $file = $this->vault_model->getById($file_id);
                $old_path = './uploads/' . $this->company_folder . $file->file_path;
                $new_path = './uploads/' . $this->company_folder . '/' . $file->title;
                if ($to_folder > 0) {
                    $folder = $this->folders_model->getById($to_folder);
                    $new_path = './uploads/' . $this->company_folder . $folder->path . $file->title;
                }

                if (rename($old_path, $new_path)) {
                    $data = array(
                        'folder_id' => $to_folder,
                        'file_path' => $new_path,
                        'modified' => date('Y-m-d h:i:s'),
                        'modified_by' => $uid,
                    );

                    $this->vault_model->trans_update($data, array('file_id' => $file_id));
                } else {
                    $return['error'] = 'Error in moving file ' . $file->title;
                }
            } else {
                $return['error'] = 'Please select a file to update';
            }
        } else {
            $return['error'] = 'You dont have permission to move a file';
        }

        echo json_encode($return);
    }

    public function update()
    {
        $return = array(
            'error' => '',
        );

        $permissions = getUserFileVaultPermissions();
        if ($permissions['edit_folder_file'] == 1) {
            $new_file = false;
            $uid = logged('id');
            $company_id = logged('company_id');

            $file_id = $_POST['file_id'];
            $file = $this->vault_model->getById($file_id);

            $folder_id = $_POST['folder_id'];
            $file_desc = '';
            $category = '';

            if (isset($_POST['file_desc'])) {
                $file_desc = $_POST['file_desc'];
            }

            if (isset($_POST['category'])) {
                $category = $_POST['category'];
            }

            if (!empty($_FILES['fullfile'])) {
                $filename = $_FILES['fullfile']['name'];
                $filesize = $_FILES['fullfile']['size'];

                if ($filesize >= 8000000) {
                    $return['error'] = 'File is larger than 8mb';
                } else {
                    $new_file = true;
                }
            } else {
                $filename = $file->title;
            }

            $record = $this->db->query(
                'select count(file_id) as `existing`, category_id from filevault where folder_id = ' . $folder_id . ' and lower(title) = "' . strtolower($filename) . '" and company_id = ' . $company_id . ' and file_id <> ' . $file_id . ' GROUP BY file_id'
            )->row();

            if ($record && $record->existing > 0) {
                $return['error'] = 'File already exists';
                if (!empty($record->category_id)) {
                    $return['error'] .= ' in <strong>Business Form Templates</strong> section';
                }
            } else {

                $data = array(
                    'description' => $file_desc,
                    'modified' => date('Y-m-d h:i:s'),
                    'modified_by' => $uid,
                );

                if ($new_file) {
                    $this->uploadlib->initialize([
                        'file_name' => $filename,
                    ]);

                    if ($folder_id > 0) {
                        $folder = $this->folders_model->getById($folder_id);
                        $folder_path = $folder->path;
                    } else {
                        $folder_path = '/';
                    }

                    $file_state = $this->uploadlib->uploadImage('fullfile', $this->company_folder . $folder_path);

                    $data['title'] = $filename;
                    $data['file_path'] = $folder_path . $filename;
                    $data['file_size'] = $filesize;
                } else {
                    $file_state['status'] = true;
                }

                if ($file_state['status']) {
                    if ($category != '') {
                        $data['category_id'] = $category;
                    }

                    if (!$this->vault_model->trans_update($data, array('file_id' => $file_id))) {
                        $return['error'] = 'Error in updating file';
                    } else {
                        if ($new_file) {
                            unlink('./uploads/' . $this->company_folder . $file->file_path);
                        }
                    }
                } else {
                    $return['error'] = 'Error uploading new file';
                }
            }
        } else {
            $return['error'] = 'You dont have permission to update a file';
        }

        echo json_encode($return);
    }

    public function getRolesAndUsers()
    {
        $company_id = logged('company_id');

        $return = array(
            'roles' => $this->roles_model->getByWhere(array('company_id' => $company_id), [], true),
            'users' => $this->users_model->getByWhere(array('company_id' => $company_id), [], true)
        );

        echo json_encode($return);
    }

    public function getRolePermissions($id, $internal = false)
    {
        $company_id = logged('company_id');
        $return = $this->file_folders_permissions_roles_model->getByWhere(array('role_id' => $id, 'company_id' => $company_id), [], true);
        if (!empty($return)) {
            $return = $return[0];
        }

        if (!$internal) {
            echo json_encode($return);
        } else {
            return $return;
        }
    }

    public function getUserPermissions($id, $internal = false)
    {
        $company_id = logged('company_id');
        $return = $this->file_folders_permissions_users_model->getByWhere(array('user_id' => $id, 'company_id' => $company_id), [], true);
        if (!empty($return)) {
            $return = $return[0];
        }

        if (!$internal) {
            echo json_encode($return);
        } else {
            return $return;
        }
    }

    public function savepermissions()
    {
        $return = array(
            'permissions' => array(),
            'error' => '',
        );

        $uid = logged('id');
        $role_id = logged('role');
        $company_id = logged('company_id');

        $id = $_POST['vpid'];
        $type = $_POST['vptype'];

        $data = array(
            'create_folder' => $_POST['create_folder'],
            'add_file' => $_POST['add_file'],
            'edit_folder_file' => $_POST['edit_folder_file'],
            'move_folder_file' => $_POST['move_folder_file'],
            'trash_folder_file' => $_POST['trash_folder_file'],
            'remove_folder_file' => $_POST['remove_folder_file'],
            'company_id' => $company_id,
        );

        if ($type == 'role') {
            $count = $this->db->query('select * from file_folders_permissions_roles where role_id = ' . $id . ' and company_id = ' . $company_id);
        } else {
            $count = $this->db->query('select * from file_folders_permissions_users where user_id = ' . $id . ' and company_id = ' . $company_id);
        }

        if ($count->num_rows() <= 0) {
            if ($type == 'role') {
                $data['role_id'] = $id;
                if (!$this->file_folders_permissions_roles_model->trans_create($data)) {
                    $return['error'] = 'Error in saving role permissions';
                }
            } else {
                $data['user_id'] = $id;
                if (!$this->file_folders_permissions_users_model->trans_create($data)) {
                    $return['error'] = 'Error in saving user permissions';
                }
            }
        } else {
            if ($type == 'role') {
                if (!$this->file_folders_permissions_roles_model->trans_update($data, array('role_id' => $id, 'company_id' => $company_id))) {
                    $return['error'] = 'Error in saving role permissions';
                }
            } else {
                if (!$this->file_folders_permissions_users_model->trans_update($data, array('user_id' => $id, 'company_id' => $company_id))) {
                    $return['error'] = 'Error in saving role permissions';
                }
            }
        }

        if (empty($return['error'])) {
            $user_permissions = $this->getUserPermissions($uid, true);
            $role_permissions = $this->getRolePermissions($role_id, true);
            if (empty($user_permissions)) {
                $return['permissions'] = $role_permissions;
            } else {
                $return['permissions'] = $user_permissions;
            }
        }

        echo json_encode($return);
    }

    public function filesvault()
    {
        $this->load->view('vault/filesvault', $this->page_data);
    }
}
