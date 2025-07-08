<?php
class Payscale extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Payscale');
        $this->load->model('Serversidetable_model', 'serverside_table');
    }
    
    public function getPayscaleCommissionSettings()
    {
        $company_id  = logged('company_id');
        $employee_id = $this->input->post('employee_id');

        $payscale_settings = $this->db->get_where('employee_payscale_settings', [
            'company_id'  => $company_id,
            'employee_id' => $employee_id
        ])->row_array();

        $this->db->where('company_id', $company_id);
        $this->db->where('employee_id', $employee_id);
        $commissions = $this->db->get('employee_commission_settings')->result_array();

        echo json_encode([
            'status'     => true,
            'payscale'   => $payscale_settings,
            'commissions'=> $commissions
        ]);
    }

    public function setPayscaleCommissionSettings()
    {
        $company_id  = logged('company_id');
        $employee_id = $this->input->post('employee_id'); 

        $payscale_settings_option = $this->input->post('payscale_option');
        $payscale_settings_amount = $this->input->post('payscale_amount');

        $commission_names   = $this->input->post('commission_name');
        $commission_types   = $this->input->post('commission_type');
        $commission_amounts = $this->input->post('commission_amount');

        $existing = $this->db->get_where('employee_payscale_settings', [
            'company_id'  => $company_id,
            'employee_id' => $employee_id
        ])->row();

        $payscale_settings_data = [
            'company_id'     => $company_id,
            'employee_id'    => $employee_id,
            'payscale_name'  => $payscale_settings_option,
            'payscale_amount'=> $payscale_settings_amount,
            'date_updated'   => date("Y-m-d H:i:s")
        ];

        if ($existing) {
            $this->db->update('employee_payscale_settings', $payscale_settings_data, [
                'id' => $existing->id
            ]);
        } else {
            $payscale_settings_data['date_created'] = date("Y-m-d H:i:s");
            $this->db->insert('employee_payscale_settings', $payscale_settings_data);
        }

        $this->db->delete('employee_commission_settings', [
            'company_id'  => $company_id,
            'employee_id' => $employee_id
        ]);

        if (!empty($commission_names)) {
            foreach ($commission_names as $index => $c_name) {
                $data = [
                    'company_id'       => $company_id,
                    'employee_id'      => $employee_id,
                    'commission_name'  => $c_name,
                    'commission_type'  => $commission_types[$index],
                    'commission_value' => $commission_amounts[$index],
                    'date_created'     => date("Y-m-d H:i:s"),
                    'date_updated'     => date("Y-m-d H:i:s")
                ];
                $this->db->insert('employee_commission_settings', $data);
            }
        }

        echo json_encode(['status' => 'success']);
    }

    public function calculateEarnings()
    {

        $this->calculatePayscale();
        $this->calculatePayroll();
    }

    public function calculatePayscale()
    {
        $payscaleQuery = $this->db->get('employee_payscale_settings');
    
        if ($payscaleQuery->num_rows() == 0) {
            return false;
        }
    
        $employees = $payscaleQuery->result();
    
        foreach ($employees as $payscale_settings) {
            $company_id  = $payscale_settings->company_id;
            $employee_id = $payscale_settings->employee_id;
    
            switch ($payscale_settings->payscale_name) {
                case 'base_hourly_rate':
                    $startOfMonth = date('Y-m-01 00:00:00');
                    $endOfMonth   = date('Y-m-t 23:59:59');
                
                    $this->db->select('DATE(date_created) AS attendance_date');
                    $this->db->from('timesheet_attendance');
                    $this->db->where('user_id', $employee_id);
                    $this->db->where('date_created >=', $startOfMonth);
                    $this->db->where('date_created <=', $endOfMonth);
                    $this->db->group_by('DATE(date_created)');
                    $dates = $this->db->get()->result();
                
                    foreach ($dates as $date) {
                        $attendance_date = $date->attendance_date;
                
                        $this->db->select('SUM(shift_duration + overtime) AS total_hours');
                        $this->db->from('timesheet_attendance');
                        $this->db->where('user_id', $employee_id);
                        $this->db->where('DATE(date_created)', $attendance_date);
                        $attendance_summary = $this->db->get()->row();
                
                        $total_hours = $attendance_summary->total_hours ?? 0;
                
                        $calculated_pay = $total_hours * $payscale_settings->payscale_amount;
                
                        $this->db->where([
                            'company_id'    => $company_id,
                            'employee_id'   => $employee_id,
                            'payscale_name' => 'base_hourly_rate',
                            'DATE(date_created)' => $attendance_date
                        ]);
                        $existing = $this->db->get('employee_payscale_summary');
                
                        if ($existing->num_rows() == 0) {
                            $data = [
                                'company_id'     => $company_id,
                                'employee_id'    => $employee_id,
                                'payscale_name'  => 'base_hourly_rate',
                                'calculated_pay' => $calculated_pay,
                                'date_created'   => $attendance_date . ' 00:00:00',
                                'date_updated'   => date('Y-m-d H:i:s')
                            ];
                            $this->db->insert('employee_payscale_summary', $data);
                        } else {
                            $existing_row = $existing->row();
                            if ($existing_row->calculated_pay != $calculated_pay) {
                                $this->db->where('id', $existing_row->id);
                                $this->db->update('employee_payscale_summary', [
                                    'calculated_pay' => $calculated_pay,
                                    'date_updated'   => date('Y-m-d H:i:s')
                                ]);
                            }
                        }
                    }
                    break;
                case 'base_daily_rate':
                    $today = date('Y-m-d');

                    $this->db->select('SUM(shift_duration + overtime) AS total_hours');
                    $this->db->from('timesheet_attendance');
                    $this->db->where('user_id', $employee_id);
                    $this->db->where('DATE(date_created)', $today);
                    $attendance_summary = $this->db->get()->row();
                    $total_hours = $attendance_summary->total_hours ?? 0;

                    if ($total_hours < 8) {
                        break;
                    }

                    $this->db->where([
                        'company_id'    => $company_id,
                        'employee_id'   => $employee_id,
                        'payscale_name' => 'base_daily_rate'
                    ]);
                    $this->db->where('DATE(date_created)', $today);
                    $existing = $this->db->get('employee_payscale_summary');

                    if ($existing->num_rows() == 0) {
                        $data = [
                            'company_id'     => $company_id,
                            'employee_id'    => $employee_id,
                            'payscale_name'  => 'base_daily_rate',
                            'calculated_pay' => $payscale_settings->payscale_amount,
                            'date_created'   => date('Y-m-d H:i:s'),
                            'date_updated'   => date('Y-m-d H:i:s')
                        ];
                        $this->db->insert('employee_payscale_summary', $data);
                    } else {
                        $existing_row = $existing->row();
                        if ($existing_row->calculated_pay != $payscale_settings->payscale_amount) {
                            $this->db->where('id', $existing_row->id);
                            $this->db->update('employee_payscale_summary', [
                                'calculated_pay' => $payscale_settings->payscale_amount,
                                'date_updated'   => date('Y-m-d H:i:s')
                            ]);
                        }
                    }
                    break;
                case 'base_weekly_rate':
                    $startOfWeek = date('Y-m-d 00:00:00', strtotime('monday this week'));
                    $endOfWeek   = date('Y-m-d 23:59:59', strtotime('friday this week'));
                    
                    $this->db->select('SUM(shift_duration + overtime) AS total_hours');
                    $this->db->from('timesheet_attendance');
                    $this->db->where('user_id', $employee_id);
                    $this->db->where('date_created >=', $startOfWeek);
                    $this->db->where('date_created <=', $endOfWeek);
                    $attendance_summary = $this->db->get()->row();
                    $total_hours = $attendance_summary->total_hours ?? 0;

                    if ($total_hours < 40) {
                        break;
                    }

                    $this->db->where([
                        'company_id'    => $company_id,
                        'employee_id'   => $employee_id,
                        'payscale_name' => 'base_weekly_rate'
                    ]);
                    $this->db->where('DATE(date_created) >=', $startOfWeek);
                    $this->db->where('DATE(date_created) <=', $endOfWeek);
                    $existing_weekly = $this->db->get('employee_payscale_summary');

                    if ($existing_weekly->num_rows() == 0) {
                        $data = [
                            'company_id'     => $company_id,
                            'employee_id'    => $employee_id,
                            'payscale_name'  => 'base_weekly_rate',
                            'calculated_pay' => $payscale_settings->payscale_amount,
                            'date_created'   => date('Y-m-d H:i:s'),
                            'date_updated'   => date('Y-m-d H:i:s')
                        ];
                        $this->db->insert('employee_payscale_summary', $data);
                    } else {
                        $existing_row = $existing_weekly->row();
                        if ($existing_row->calculated_pay != $payscale_settings->payscale_amount) {
                            $this->db->where('id', $existing_row->id);
                            $this->db->update('employee_payscale_summary', [
                                'calculated_pay' => $payscale_settings->payscale_amount,
                                'date_updated'   => date('Y-m-d H:i:s')
                            ]);
                        }
                    }
                    break;
                case 'monthly_salary':
                    $startOfMonth = date('Y-m-01 00:00:00');
                    $endOfMonth   = date('Y-m-t 23:59:59');

                    $this->db->where([
                        'company_id'    => $company_id,
                        'employee_id'   => $employee_id,
                        'payscale_name' => 'monthly_salary',
                        'DATE(date_created) >=' => $startOfMonth,
                        'DATE(date_created) <=' => $endOfMonth,
                    ]);
                    $existing_monthly = $this->db->get('employee_payscale_summary');

                    if ($existing_monthly->num_rows() == 0) {
                        $data = [
                            'company_id'     => $company_id,
                            'employee_id'    => $employee_id,
                            'payscale_name'  => 'monthly_salary',
                            'calculated_pay' => $payscale_settings->payscale_amount,
                            'date_created'   => date('Y-m-d H:i:s'),
                            'date_updated'   => date('Y-m-d H:i:s')
                        ];
                        $this->db->insert('employee_payscale_summary', $data);
                    } else {
                        $existing_row = $existing_monthly->row();
                        if ($existing_row->calculated_pay != $payscale_settings->payscale_amount) {
                            $this->db->where('id', $existing_row->id);
                            $this->db->update('employee_payscale_summary', [
                                'calculated_pay' => $payscale_settings->payscale_amount,
                                'date_updated'   => date('Y-m-d H:i:s')
                            ]);
                        }
                    }
                    break;
                case 'yearly_salary':
                    $calculated_pay = $payscale_settings->payscale_amount / 12;

                    $this->db->where([
                        'company_id'    => $company_id,
                        'employee_id'   => $employee_id,
                        'payscale_name' => 'yearly_salary',
                        'MONTH(date_created)' => date('m'),
                        'YEAR(date_created)'  => date('Y'),
                    ]);
                    $existing = $this->db->get('employee_payscale_summary');

                    if ($existing->num_rows() == 0) {
                        $data = [
                            'company_id'     => $company_id,
                            'employee_id'    => $employee_id,
                            'payscale_name'  => 'yearly_salary',
                            'calculated_pay' => $calculated_pay,
                            'date_created'   => date('Y-m-d H:i:s'),
                            'date_updated'   => date('Y-m-d H:i:s')
                        ];
                        $this->db->insert('employee_payscale_summary', $data);
                    } else {
                        $existing_row = $existing->row();
                        if ($existing_row->calculated_pay != $calculated_pay) {
                            $this->db->where('id', $existing_row->id);
                            $this->db->update('employee_payscale_summary', [
                                'calculated_pay' => $calculated_pay,
                                'date_updated'   => date('Y-m-d H:i:s')
                            ]);
                        }
                    }
                    break;
                case 'part_time_hourly':
                    $startOfMonth = date('Y-m-01 00:00:00');
                    $endOfMonth   = date('Y-m-t 23:59:59');
                
                    $this->db->select('DATE(date_created) AS attendance_date');
                    $this->db->from('timesheet_attendance');
                    $this->db->where('user_id', $employee_id);
                    $this->db->where('date_created >=', $startOfMonth);
                    $this->db->where('date_created <=', $endOfMonth);
                    $this->db->group_by('DATE(date_created)');
                    $dates = $this->db->get()->result();
                
                    foreach ($dates as $date) {
                        $attendance_date = $date->attendance_date;
                
                        $this->db->select('SUM(shift_duration + overtime) AS total_hours');
                        $this->db->from('timesheet_attendance');
                        $this->db->where('user_id', $employee_id);
                        $this->db->where('DATE(date_created)', $attendance_date);
                        $attendance_summary = $this->db->get()->row();
                
                        $total_hours = $attendance_summary->total_hours ?? 0;
                
                        $calculated_pay = $total_hours * $payscale_settings->payscale_amount;
                
                        $this->db->where([
                            'company_id'    => $company_id,
                            'employee_id'   => $employee_id,
                            'payscale_name' => 'part_time_hourly',
                            'DATE(date_created)' => $attendance_date
                        ]);
                        $existing = $this->db->get('employee_payscale_summary');
                
                        if ($existing->num_rows() == 0) {
                            $data = [
                                'company_id'     => $company_id,
                                'employee_id'    => $employee_id,
                                'payscale_name'  => 'part_time_hourly',
                                'calculated_pay' => $calculated_pay,
                                'date_created'   => $attendance_date . ' 00:00:00',
                                'date_updated'   => date('Y-m-d H:i:s')
                            ];
                            $this->db->insert('employee_payscale_summary', $data);
                        } else {
                            $existing_row = $existing->row();
                            if ($existing_row->calculated_pay != $calculated_pay) {
                                $this->db->where('id', $existing_row->id);
                                $this->db->update('employee_payscale_summary', [
                                    'calculated_pay' => $calculated_pay,
                                    'date_updated'   => date('Y-m-d H:i:s')
                                ]);
                            }
                        }
                    }
                    break;
                case 'temp_services':
                    $startOfMonth = date('Y-m-01 00:00:00');
                    $endOfMonth   = date('Y-m-t 23:59:59');
                
                    $this->db->select('DATE(date_created) AS attendance_date');
                    $this->db->from('timesheet_attendance');
                    $this->db->where('user_id', $employee_id);
                    $this->db->where('date_created >=', $startOfMonth);
                    $this->db->where('date_created <=', $endOfMonth);
                    $this->db->group_by('DATE(date_created)');
                    $dates = $this->db->get()->result();
                
                    foreach ($dates as $date) {
                        $attendance_date = $date->attendance_date;
                
                        $this->db->select('SUM(shift_duration + overtime) AS total_hours');
                        $this->db->from('timesheet_attendance');
                        $this->db->where('user_id', $employee_id);
                        $this->db->where('DATE(date_created)', $attendance_date);
                        $attendance_summary = $this->db->get()->row();
                
                        $total_hours = $attendance_summary->total_hours ?? 0;
                
                        $calculated_pay = $total_hours * $payscale_settings->payscale_amount;
                
                        $this->db->where([
                            'company_id'    => $company_id,
                            'employee_id'   => $employee_id,
                            'payscale_name' => 'temp_services',
                            'DATE(date_created)' => $attendance_date
                        ]);
                        $existing = $this->db->get('employee_payscale_summary');
                
                        if ($existing->num_rows() == 0) {
                            $data = [
                                'company_id'     => $company_id,
                                'employee_id'    => $employee_id,
                                'payscale_name'  => 'temp_services',
                                'calculated_pay' => $calculated_pay,
                                'date_created'   => $attendance_date . ' 00:00:00',
                                'date_updated'   => date('Y-m-d H:i:s')
                            ];
                            $this->db->insert('employee_payscale_summary', $data);
                        } else {
                            $existing_row = $existing->row();
                            if ($existing_row->calculated_pay != $calculated_pay) {
                                $this->db->where('id', $existing_row->id);
                                $this->db->update('employee_payscale_summary', [
                                    'calculated_pay' => $calculated_pay,
                                    'date_updated'   => date('Y-m-d H:i:s')
                                ]);
                            }
                        }
                    }
                    break;
                case 'job_type_base_install':
                case 'job_type_base_service':
                    $today = date('Y-m-d');
                    $job_type = ($payscale_settings->payscale_name == 'job_type_base_install') ? 'Install' : 'Service';

                    $this->db->group_start();
                    $this->db->where('employee2_id', $employee_id);
                    $this->db->or_where('employee3_id', $employee_id);
                    $this->db->or_where('employee4_id', $employee_id);
                    $this->db->or_where('employee5_id', $employee_id);
                    $this->db->or_where('employee6_id', $employee_id);
                    $this->db->group_end();

                    $this->db->where('DATE(date_created)', $today);
                    $this->db->where('job_type', $job_type);
                    $this->db->where_in('status', ['Finished', 'Invoiced', 'Completed']);

                    $total_jobs = $this->db->count_all_results('jobs');

                    if ($total_jobs == 0) {
                        break;
                    }

                    $calculated_pay = $total_jobs * $payscale_settings->payscale_amount;

                    $this->db->where([
                        'company_id'    => $company_id,
                        'employee_id'   => $employee_id,
                        'payscale_name' => $payscale_settings->payscale_name
                    ]);
                    $this->db->where('DATE(date_created)', $today);
                    $existing = $this->db->get('employee_payscale_summary');

                    if ($existing->num_rows() == 0) {
                        $data = [
                            'company_id'     => $company_id,
                            'employee_id'    => $employee_id,
                            'payscale_name'  => $payscale_settings->payscale_name,
                            'calculated_pay' => $calculated_pay,
                            'date_created'   => date('Y-m-d H:i:s'),
                            'date_updated'   => date('Y-m-d H:i:s')
                        ];
                        $this->db->insert('employee_payscale_summary', $data);
                    } else {
                        $existing_row = $existing->row();
                        if ($existing_row->calculated_pay != $calculated_pay) {
                            $this->db->where('id', $existing_row->id);
                            $this->db->update('employee_payscale_summary', [
                                'calculated_pay' => $calculated_pay,
                                'date_updated'   => date('Y-m-d H:i:s')
                            ]);
                        }
                    }
                    break;
            }
        }         
    }

    public function calculatePayroll()
    {
        $currentMonth = date('Y-m');

        $this->db->distinct();
        $this->db->select("company_id, employee_id");
        $this->db->from('employee_payscale_summary');
        $this->db->where("DATE_FORMAT(date_created, '%Y-%m') = ", $currentMonth);
        $employees = $this->db->get()->result();

        foreach ($employees as $emp) {
            $company_id  = $emp->company_id;
            $employee_id = $emp->employee_id;

            $this->db->from('employee_payroll_summary');
            $this->db->where([
                'company_id'     => $company_id,
                'employee_id'    => $employee_id,
                'payroll_period' => $currentMonth,
                'status'         => 'Paid'
            ]);
            $this->db->order_by('date_created DESC');
            $latest_paid = $this->db->get()->row();

            if ($latest_paid) {
                preg_match('/to (\d+)/', $latest_paid->payroll_duration, $match);
                $start_day = isset($match[1]) ? (int)$match[1] + 1 : 1;
            } else {
                $start_day = 1;
            }

            $start_date = date("Y-m-") . str_pad($start_day, 2, "0", STR_PAD_LEFT) . " 00:00:00";
            $end_date   = date('Y-m-d 23:59:59');

            $this->db->select("SUM(calculated_pay) AS total_payscale");
            $this->db->from('employee_payscale_summary');
            $this->db->where('company_id', $company_id);
            $this->db->where('employee_id', $employee_id);
            $this->db->where('date_created >=', $start_date);
            $this->db->where('date_created <=', $end_date);
            $payscale_total = $this->db->get()->row()->total_payscale ?? 0;

            $this->db->select("SUM(calculated_commission) AS total_commission");
            $this->db->from('employee_commission_summary');
            $this->db->where('company_id', $company_id);
            $this->db->where('employee_id', $employee_id);
            $this->db->where_in('reference_status', ['Finished', 'Invoiced', 'Completed']);
            $this->db->where('date_created >=', $start_date);
            $this->db->where('date_created <=', $end_date);
            $commission_total = $this->db->get()->row()->total_commission ?? 0;

            $total_amount = $payscale_total + $commission_total;

            $this->db->from('employee_payroll_summary');
            $this->db->where([
                'company_id'     => $company_id,
                'employee_id'    => $employee_id,
                'payroll_period' => $currentMonth,
                'status'         => 'Pending'
            ]);
            $this->db->order_by('date_created DESC');
            $pending_payroll = $this->db->get()->row();

            if ($pending_payroll) {
                $this->db->where('id', $pending_payroll->id);
                $this->db->update('employee_payroll_summary', [
                    'payroll_duration' => "Day " . str_pad($start_day, 2, "0", STR_PAD_LEFT) . " to " . date('d'),
                    'total_amount'     => $total_amount,
                    'date_updated'     => date('Y-m-d H:i:s')
                ]);
            } else {
                if ($start_day <= (int)date('d')) {
                    $this->db->insert('employee_payroll_summary', [
                        'company_id'       => $company_id,
                        'employee_id'      => $employee_id,
                        'payroll_period'   => $currentMonth,
                        'payroll_duration' => "Day " . str_pad($start_day, 2, "0", STR_PAD_LEFT) . " to " . date('d'),
                        'total_amount'     => $total_amount,
                        'status'           => 'Pending',
                        'date_created'     => date('Y-m-d H:i:s'),
                        'date_updated'     => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }

        return true;
    }
        
    public function getPayscaleSummaryServerside($employee_id)
    {
        $company_id = logged('company_id');

         $initializeTable = $this->serverside_table->initializeTable(
            "employee_payscale_summary", 
            array('id', 'company_id', 'employee_id', 'payscale_name', 'calculated_pay', 'date_created'),
            array('id', 'company_id', 'employee_id', 'payscale_name', 'calculated_pay', 'date_created'),
            array('date_created' => 'DESC'),
            array('employee_id' => $employee_id),
        );

        $getData = $this->serverside_table->getRows($this->input->post(), null);

        $data = $row = array();
        $i = $this->input->post('start');
        
        foreach($getData as $getDatas){
            $formatted_payscale_name = ucwords(str_replace('_', ' ', $getDatas->payscale_name));
            $formatted_calculated_pay = '<span class="text-success">+ $' . number_format($getDatas->calculated_pay, 2) . '</span>';
            $formatted_date_created = date('m/d/Y', strtotime($getDatas->date_created));
            
            $data[] = array(
                $formatted_payscale_name,
                $formatted_calculated_pay,
                $formatted_date_created,
            );
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->serverside_table->countAll(),
            "recordsFiltered" => $this->serverside_table->countFiltered($this->input->post()),
            "data" => $data,
        );
        
        echo json_encode($output);
    }

    public function getCommissionSummaryServerside($employee_id)
    {
        $company_id = logged('company_id');

         $initializeTable = $this->serverside_table->initializeTable(
            "employee_commission_summary", 
            array('id', 'company_id', 'employee_id', 'reference_id', 'reference_no', 'commission_name', 'commission_type', 'commission_value', 'calculated_commission', 'date_created'),
            array('id', 'company_id', 'employee_id', 'reference_id', 'reference_no', 'commission_name', 'commission_type', 'commission_value', 'calculated_commission', 'date_created'),
            array('date_created' => 'DESC'),
            array('employee_id' => $employee_id),
        );

        $getData = $this->serverside_table->getRows($this->input->post(), null);

        $data = $row = array();
        $i = $this->input->post('start');
        
        foreach($getData as $getDatas){
            $formatted_commission_name = ucwords(str_replace('_', ' ', $getDatas->commission_name));
            $formatted_commission_type = ucwords(str_replace('_', ' ', $getDatas->commission_type));
            $formatted_commission_value = ($getDatas->commission_type == "fixed_amount") ? "$".number_format($getDatas->commission_value, 2) : "$getDatas->commission_value%";
            $formatted_name = "$formatted_commission_name<br><small class='text-muted'>$formatted_commission_type: $formatted_commission_value</small>";
            $formatted_reference_id = "<a class='text-decoration-none' href='/job/edit/$getDatas->reference_id' target='_blank'>#$getDatas->reference_id</a>";

            if (in_array($getDatas->reference_status, ['Draft', 'Scheduled', 'Arrival', 'Started', 'Approved'])) {
                $formatted_reference_status = "<span class='text-muted'>$getDatas->reference_status</span>";
                $formatted_calculated_commission = '<span class="text-muted">+ $' . number_format($getDatas->calculated_commission, 2) . '</span>';
            } else if (in_array($getDatas->reference_status, ['Finished', 'Invoiced', 'Completed'])) {
                $formatted_reference_status = "<span class='text-success'>$getDatas->reference_status</span>";
                $formatted_calculated_commission = '<span class="text-success">+ $' . number_format($getDatas->calculated_commission, 2) . '</span>';
            } else if (in_array($getDatas->reference_status, ['Cancelled'])) {
                $formatted_reference_status = "<span class='text-danger'>$getDatas->reference_status</span>";
                $formatted_calculated_commission = '<span class="text-muted text-decoration-line-through">$' . number_format($getDatas->calculated_commission, 2) . '</span>';
            } else {
                $formatted_reference_status = "<span class='text-muted'>$getDatas->reference_status</span>";
                $formatted_calculated_commission = '<span class="text-muted">+ $' . number_format($getDatas->calculated_commission, 2) . '</span>';
            }
            
            
            $formatted_date_created = date('m/d/Y', strtotime($getDatas->date_created));
        
            $data[] = array(
                $formatted_name,
                $formatted_reference_id,
                $formatted_reference_status,
                $formatted_calculated_commission,
                $formatted_date_created,
            );
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->serverside_table->countAll(),
            "recordsFiltered" => $this->serverside_table->countFiltered($this->input->post()),
            "data" => $data,
        );
        
        echo json_encode($output);
    }

    public function getPayrollSummaryServerside($employee_id)
    {
        $company_id = logged('company_id');

        $this->serverside_table->initializeTable(
            "employee_payroll_summary",
            array('id', 'company_id', 'employee_id', 'payroll_period', 'total_amount', 'status', 'check_no', 'date_created'),
            array('id', 'company_id', 'employee_id', 'payroll_period', 'total_amount', 'status', 'check_no', 'date_created'),
            array('date_created' => 'DESC'),
            array('employee_id' => $employee_id)
        );

        $getData = $this->serverside_table->getRows($this->input->post());

        $data = array();
        $i = $this->input->post('start');

        foreach ($getData as $getDatas) {
            $formatted_payroll_period = "<strong>".strtoupper(date('F Y', strtotime($getDatas->payroll_period)))."</strong><br><small class='text-muted'>$getDatas->payroll_duration</small>";

            if ($getDatas->status == "Paid") {
                $formatted_total_amount = '<span class="text-success">+ $' . number_format($getDatas->total_amount, 2) . '</span>';
                $formatted_status = "<span class='badge bg-success'>PAID</span>";
            } else {
                $formatted_total_amount = '<span class="text-muted">+ $' . number_format($getDatas->total_amount, 2) . '</span>';
                $formatted_status = "<span class='badge bg-secondary'>PENDING</span>";
            }

            if ($getDatas->status == "Pending" && $getDatas->check_no == "") {
                $formatted_check_id = "<a class='text-decoration-none text-muted' href='/check?create_check_id_for={$getDatas->employee_id}&amount=".$getDatas->total_amount."&payroll_date=".date('m/d/Y', strtotime($getDatas->date_created))."&memo=".strtoupper(date('F Y', strtotime($getDatas->payroll_period)))."' target='_blank' style='font-size: x-small;'>WRITE A CHECK</a>";
            } else if ($getDatas->status == "Paid" && $getDatas->check_no == "") {
                $formatted_check_id = "<p class='text-decoration-none text-muted'>Not Specified</p>";
            } else {
                $formatted_check_id = "<a class='text-decoration-none' href='/check?view_check_id={$getDatas->check_no}' target='_blank'>#{$getDatas->check_no}</a>";
            }

            $formatted_date_created = date('m/d/Y', strtotime($getDatas->date_created));

            $data[] = array(
                $formatted_payroll_period,
                $formatted_total_amount,
                $formatted_status,
                $formatted_check_id,
                $formatted_date_created,
            );
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->serverside_table->countAll(),
            "recordsFiltered" => $this->serverside_table->countFiltered($this->input->post()),
            "data" => $data,
        );

        echo json_encode($output);
    }
}