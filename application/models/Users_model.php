<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Users_model extends MY_Model
{
    public $table = 'users';

    /**
     * @return mixed
     */
    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id !=', 1);
        $query = $this->db->get();

        return $query->result();
    }

    // public function getUser($customer_id)
    // {

    //     $this->db->select('*');
    //     $this->db->from($this->table);
    //     $this->db->where('prof_id', $customer_id);

    //     $query = $this->db->get();
    //     return $query->row();
    // }


    /**
     * @param $data
     * @return bool|string
     */
    public function attempt($data)
    {
        $this->db->where('username', $data['username']);

        $this->db->or_where('email', $data['username']);



        $query = $this->db->get($this->table);



        // validate user

        if (!empty($query) && $query->num_rows() > 0) {
            // checks the password

            if ($query->row()->password == hash("sha256", $data['password'])) {
                if ($query->row()->status==='1') {
                    return 'valid';
                } // if valid password and username and allowed

                else {
                    return 'not_allowed';
                }
            } else {
                return 'invalid_password';
            } // if invalid password
        }



        return false;
    }

    /**
     * @param $data
     * @return bool|string
     */
    public function admin_attempt($data)
    {
        $this->db->where('username', $data['username']);
        $this->db->where('user_type', 1);
        $query = $this->db->get($this->table);

        // validate user
        if (!empty($query) && $query->num_rows() > 0) {
            if ($query->row()->password == hash("sha256", $data['password'])) {
                if ($query->row()->status==='1') {
                    return 'valid';
                } 
                else {
                    return 'not_allowed';
                }
            } else {
                return 'invalid_password';
            } 
        }
        return false;
    }

    public function getUsers()
    {

        /*$parent_id = getLoggedUserID();
        //$cid=logged('comp_id');

        $cid=logged('company_id');

        $this->db->select('*');
        $this->db->from($this->table);
        //$this->db->where('parent_id', $parent_id);
        $this->db->where('parent_id', $parent_id);
        $this->db->or_where('id', $parent_id);
        $this->db->or_where('company_id',$cid );
        // $this->db->where('role !=', 1);
        $query = $this->db->get();
        // echo $this->db->last_query(); die;
        return $query->result();*/

        // edited using the new column names
        $parent_id = getLoggedUserID();
        $cid=logged('company_id');

        $this->db->select('*');
        $this->db->from($this->table);
        //$this->db->where('parent_id', $parent_id);
        $this->db->where('id', $parent_id);
        $this->db->or_where('company_id', $cid);
        $query = $this->db->get();

        return $query->result();
    }

    public function getAllUsers()
    {
        $this->db->select('users.*, clients.business_name');
        $this->db->join('clients', 'users.company_id = clients.id','left');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function getCompanyUsers($company_id, $filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        if ( !empty($filters) ) {
            if ( $filters['search'] != '' ) {
                $this->db->like('FName', $filters['search'], 'both');
                $this->db->or_like('LName', $filters['search'], 'both');
            }

            if( $filters['eids'] != '' ){
                $this->db->where_in('id', $filters['eids']);                
            }
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function getActiveCompanyUsers($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('status', 1);
        $this->db->order_by('LName', 'asc');
        $this->db->order_by('FName', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getCompanyUsersWithFilter($status = [1], $order = 'asc', $orderColumn = 'name')
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where_in('status', $status);
        switch ($orderColumn) {
            case 'pay_rate':
                $this->db->order_by('pay_rate', $order);
            break;
            case 'pay_method':
                // $this->db->order_by();
            break;
            case 'status':
                $this->db->order_by('status', $order);
            break;
            case 'email_address':
                $this->db->order_by('email', $order);
            break;
            case 'phone_number':
                $this->db->order_by('phone', $order);
                $this->db->order_by('mobile', $order);
            break;
            default:
                $this->db->order_by('LName', $order);
                $this->db->order_by('FName', $order);
            break;
        }

        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function getRoleById($role_id)
    {
        $this->db->where('id', $role_id);
        $query = $this->db->get('roles');
        return $query->row();
    }

    public function getTotalUsers()
    {
        $this->db->where('id', getLoggedUserID());
        $this->db->or_where('company_id', logged('company_id'));
        $qry = $this->db->get($this->table);
        return $qry->num_rows();
    }

    public function getRecentUsers()
    {
        $parent_id = getLoggedUserID();
        $cid=logged('company_id');

        $this->db->select('*');
        $this->db->from($this->table);
        //$this->db->where('parent_id', $parent_id);
        $this->db->where('id', $parent_id);
        $this->db->or_where('company_id', $cid);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(3);
        $query = $this->db->get();

        return $query->result();
    }

    public function getAllRecentUsers()
    {
        $parent_id = getLoggedUserID();
        $this->db->select('*');
        $this->db->from($this->table);
        //$this->db->where('parent_id', $parent_id);
        $this->db->where('id', $parent_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(3);
        $query = $this->db->get();

        return $query->result();
    }


    public function getUser($user_id)
    {
        $parent_id = getLoggedUserID();
        $cid=logged('company_id');

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $user_id);
        // $this->db->where('role !=', 1);
        $query = $this->db->get();
        // echo $this->db->last_query(); die;
        return $query->row();
    }

    public function getCompanyUser($id, $company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getCompanyUserByEmail($company_id, $email)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('email', $email);
        $query = $this->db->get();        
        return $query->row();
    }

    public function countAllUsers()
    {
        $parent_id = getLoggedUserID();

        $this->db->select('COUNT(id) as totalUsers');
        $this->db->from($this->table);
        //$this->db->where('parent_id', $parent_id);
        $this->db->where('company_id', $parent_id);
        $query = $this->db->get()->row();

        return $query->totalUsers;
    }

    public function countAllCompanyUsers($company_id)
    {
        $this->db->select('COUNT(id) as totalUsers');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get()->row();

        return $query->totalUsers;
    }

    public function login($row, $remember = false)
    {
        $time = time();

        // encypting userid and password with current time $time

        $login_token = sha1($row->id.$row->password.$time);

        $this->db->select('id AS client_id, is_plan_active');
        $this->db->from('clients');
        $this->db->where('id', $row->company_id);
        $company = $this->db->get()->row();

        if ($remember===false) {
            $array = [

                'login' => true,

                // saving encrypted userid and password as token in session

                'login_token' => $login_token,
                'logged' => [
                    'id' => $row->id,
                    'time' => $time,
                    'role' => $row->role,
                    'company_id' => $row->company_id,
                    'is_plan_active' => $company->is_plan_active
                ]

            ];

            $this->session->set_userdata($array);
        } else {
            $data = [
                'id' => $row->id,
                'time' => time()."",
                'company_id' => $row->company_id,
                'role' => $row->role,
                'usertimezone' => $this->session->userdata('usertimezone'),
                'offset_zone'=> $this->session->userdata('offset_zone'),
                'is_plan_active' => $company->is_plan_active

            ];

            $expiry = strtotime('+7 days');

            set_cookie('login', true, $expiry);

            set_cookie('logged', json_encode($data), $expiry);

            set_cookie('login_token', $login_token, $expiry);
            $array = [

                'login' => true,

                // saving encrypted userid and password as token in session

                'login_token' => $login_token,
                'logged' => [
                    'id' => $row->id,
                    'time' => $time,
                    'role' => $row->role,
                    'company_id' => $row->company_id
                ]

            ];

            $this->session->set_userdata($array);
        }



        $this->update($row->id, [

            'last_login' => date('Y-m-d H:m:i')

        ]);



        $this->activity_model->add($row->FName.' ('.$row->username.') Logged in', $row->id);
    }



    public function logout()
    {

        // Deleting Sessions

        $this->session->unset_userdata('login');

        $this->session->unset_userdata('logged');

        // Deleting Cookie

        delete_cookie('login');

        delete_cookie('logged');

        delete_cookie('login_token');
    }

    public function admin_logout()
    {

        // Deleting Sessions
        $this->session->unset_userdata('admin_login');
        $this->session->unset_userdata('admin_logged');

        // Deleting Cookie
        delete_cookie('admin_login');
        delete_cookie('admin_logged');
        delete_cookie('admin_login_token');
    }

    public function resetPassword($data)
    {
        $this->db->where('username', $data['username']);
        $this->db->or_where('email', $data['username']);

        $user = $this->db->get_where($this->table)->row();

        if (!empty($user)) {
        } else {
            return 'invalid';
        }



        $reset_token	=	password_hash((time().$user->id), PASSWORD_BCRYPT);

        $this->db->where('id', $user->id);
        $this->db->update($this->table, compact('reset_token'));


        $this->email->from(setting('company_email'), setting('company_name'));
        $this->email->to($user->email);

        $this->email->subject('Reset Your Account Password | ' . setting('company_name'));
        $reset_link = url('login/new_password?token='.$reset_token);



        $data = getEmailShortCodes();

        $data['user_id'] = $user->id;

        $data['user_name'] = $user->FName;

        $data['user_email'] = $user->email;

        $data['user_username'] = $user->username;

        $data['reset_link'] = $reset_link;



        $html = $this->parser->parse('templates/email/reset', $data, true);



        $this->email->message($html);



        $this->email->send();



        return $user->email;
    }

    public function getAllUsersByCompany($user_id=0, $loggedUserId=0)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        //$this->db->where('parent_id', $user_id);
        $this->db->where('company_id', $user_id);

        if ($loggedUserId) {
            $this->db->where('id !=', $loggedUserId);
        }

        $query = $this->db->get();
        return $query->result();
    }


    public function getAllUsersByCompanyID($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        //$this->db->where('parent_id', $user_id);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }
    public function findAllUsersByCompanyId($company_id=0, $loggedUserId=0)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        //$this->db->where('parent_id', $user_id);
        $this->db->where('company_id', $company_id);

        if ($loggedUserId) {
            $this->db->where('id !=', $loggedUserId);
        }

        $query = $this->db->get();
        return $query->result();
    }
    public function getUsersByName($search)
    {
        $this->db->like('FName', $search);
        $this->db->or_like('LName', $search);
        $qry = $this->db->get($this->table);
        return $qry->result();
    }
    public function getRoles($company_id = 0)
    {
        if ($company_id != 1) {
            $this->db->where('id <>', 1);
            $this->db->where('id <>', 2);
        }
        $qry = $this->db->get('roles');
        return $qry->result();
    }
    public function getRolesBySearch($search, $company_id = 0)
    {
        $this->db->like('title', $search);
        if ($company_id != 1) {
            $this->db->where('id <>', 1);
            $this->db->where('id <>', 2);
        }
        $qry = $this->db->get('roles')->result();
        return $qry;
    }

    public function addNewEmployee($add)
    {
        $query = $this->db->get_where('users', array('email'=>$add['email'],'username'=>$add['username']))->num_rows();
        if ($query == 0) {
            $this->db->insert('users', $add);
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function addProfilePhoto($photo)
    {
        $this->db->insert('user_profile_photo', $photo);
        return $this->db->insert_id();
    }

    public function getProfilePhoto($photo_id)
    {
        $this->db->select('*');
        $this->db->from('user_profile_photo');
        $this->db->where('id', $photo_id);
        // $this->db->where('role !=', 1);
        $query = $this->db->get();
        // echo $this->db->last_query(); die;
        return $query->row();
    }
    

    public function getAllUserId()
    {
        $this->db->select('id');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function deleteUser($id)
    {
        $this->db->delete($this->table, array('id' => $id));
    }

    public function deleteCompanyUser($id, $company_id)
    {
        $this->db->delete($this->table, array('id' => $id, 'company_id' => $company_id));
    }

    public function getUserByUsernname($user_name)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('username', $user_name);
        $query = $this->db->get();
        return $query->row();
    }

    public function getUserByID($id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function addPaySchedule($data)
    {
        $this->db->insert('pay_schedule', $data);
        return $this->db->insert_id();
    }

    public function getPaySchedules()
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('status', 1);
        $query = $this->db->get('pay_schedule');
        return $query->result();
    }
    
    public function getPaySchedule($id)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $query = $this->db->get('pay_schedule');
        return $query->row();
    }

    public function getPayScheduleUsed()
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('use_for_new_employees', 1);
        $this->db->where('status', 1);
        $query = $this->db->get('pay_schedule');
        return $query->row();
    }

    public function updateUsedForNewEmp($id, $use)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('id', $id);
        $update = $this->db->update('pay_schedule', ['use_for_new_employees' => $use]);
        return $update;
    }

    public function updatePaySchedule($id, $data)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $update = $this->db->update('pay_schedule', $data);
        return $update;
    }

    public function insertEmployeePayDetails($data)
    {
        $this->db->insert('employee_pay_details', $data);
        return $this->db->insert_id();
    }

    public function getEmployeePayDetails($user_id)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('employee_pay_details');
        return $query->row();
    }

    public function updateEmployeePayDetails($user_id, $data)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('user_id', $user_id);
        $update = $this->db->update('employee_pay_details', $data);
        return $update;
    }

    public function deleteEmployeePayDetails($user_id)
    {
        $this->db->delete('employee_pay_details', array('company_id' => logged('company_id'), 'user_id' => $user_id));
    }

    public function getPayDetailsByPayType($payType)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('pay_type', $payType);
        $this->db->where('status', 1);
        $query = $this->db->get('employee_pay_details');
        return $query->result();
    }

    public function getActiveEmployeePayDetails()
    {
        $company_id = logged('company_id');
        $this->db->select('*');
        $this->db->from('employee_pay_details');
        $this->db->join('users', 'users.id = employee_pay_details.user_id');
        $this->db->where('users.company_id', $company_id);
        $this->db->where('users.status', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function getPayDetailsByPaySched($paySchedId)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('pay_schedule_id', $paySchedId);
        $this->db->where('status', 1);
        $query = $this->db->get('employee_pay_details');
        return $query->result();
    }
    public function getEmployeeLastestAux($user_id)
    {
        $qry = $this->db->query("SELECT *,timesheet_attendance.status as att_status fROM timesheet_logs Join users ON users.id=timesheet_logs.user_id JOIN timesheet_attendance ON timesheet_attendance.id = timesheet_logs.attendance_id WHERE timesheet_logs.user_id = $user_id order by timesheet_logs.id DESC Limit 1");
        return $qry->row();
    }

    public function admin_login($row, $remember = false)
    {
        $time = time();

        // encypting userid and password with current time $time

        $login_token = sha1($row->id.$row->password.$time);

        if ($remember===false) {
            $array = [

                'admin_login' => true,
                'admin_login_token' => $login_token,
                'admin_logged' => [
                    'id' => $row->id,
                    'time' => $time,
                    'role' => $row->role,
                    'company_id' => $row->company_id
                ]

            ];

            $this->session->set_userdata($array);
        } else {
            $data = [
                'id' => $row->id,
                'time' => time()."",
                'company_id' => $row->company_id,
                'role' => $row->role,
                'usertimezone' => $this->session->userdata('usertimezone'),
                'offset_zone'=> $this->session->userdata('offset_zone')

            ];

            $expiry = strtotime('+7 days');

            set_cookie('admin_login', true, $expiry);

            set_cookie('admin_logged', json_encode($data), $expiry);

            set_cookie('admin_login_token', $login_token, $expiry);
            $array = [

                'admin_login' => true,
                'admin_login_token' => $login_token,
                'admin_logged' => [
                    'id' => $row->id,
                    'time' => $time,
                    'role' => $row->role,
                    'company_id' => $row->company_id
                ]

            ];

            $this->session->set_userdata($array);
        }



        $this->update($row->id, [

            'last_login' => date('Y-m-d H:m:i')

        ]);

        $this->activity_model->add($row->FName.' ('.$row->username.') Logged in', $row->id);
    }
}



/* End of file Users_model.php */

/* Location: ./application/models/Users_model.php */
