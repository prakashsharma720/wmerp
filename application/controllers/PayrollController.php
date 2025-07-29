<?php

//session_start(); //we need to start session in order to access it through CI

Class PayrollController extends MY_Controller {

public function __construct() {
parent::__construct();
if(!$this->session->userdata['logged_in']['id']){
    redirect('User_authentication/index');
}
/*require_once APPPATH.'third_party/PHPExcel.php';
$this->excel = new PHPExcel(); */

// Load form helper library
$this->load->helper('form');
$this->load->helper('url');
// new security feature
$this->load->helper('security');
// Load form validation library
$this->load->library('form_validation');

//$this->load->library('encryption');

// Load session library
$this->load->library('session');

$this->load->model('Payroll_model');
$this->load->model('Leave_model');

$this->load->library('template');


}


public function index() {
    $data['title'] = 'Attendance List';
    $data['AttendanceDates'] = $this->Payroll_model->getUniqueAttendanceDates();
	// echo"<pre>";print_r($data['AttendanceDates']);exit;
    $data['employees']  = $this->Leave_model->getEmployeesList();
    $data['totalemployees']  = $this->Payroll_model->getTotalEmployee();
    
    $this->template->load('layout/template', 'leave-module/attendance', $data);
}

public function add() {
    $data['title'] = 'Add Attendance';

    $data['employees']  = $this->Leave_model->getEmployeesList();

    $this->template->load('template', 'payroll/add_attendance', $data);
  
}

public function edit($date = null) {
    if (!$date) {
        redirect('PayrollController'); // Redirect if no date provided
    }

    // Fetch all attendance records for the given date
    $data['attendanceRecords'] = $this->Payroll_model->get_attendance_by_date($date);
				// echo "<pre>";print_r($data['attendanceRecords']);exit;	
    
    if (empty($data['attendanceRecords'])) {
        $this->session->set_flashdata('failed', 'No attendance records found for this date.');
        redirect('PayrollController');
    }
    $data['employees']  = $this->Leave_model->getEmployeesList();

    $data['title'] = "Edit Attendance - " . date("d-m-Y", strtotime($date));
    $this->template->load('layout/template', 'leave-module/edit_attandace', $data);
}

public function update_attendance()
{
    echo "<pre>";
    print_r($_POST)  ;
    $dates = $this->input->post('date'); // Array of dates
    $check_in = $this->input->post('check_in'); // Check-In times
    $check_out = $this->input->post('check_out'); // Check-Out times
    $status = $this->input->post('status'); // Statuses
    $emp_id = $this->input->post('emp_id'); // Employee IDs

    if (!empty($check_in) && !empty($check_out) && !empty($status)) {
        foreach ($check_in as $key => $in_time) {
            echo "return";

            if (!empty($dates)) { 
                // echo "hello";exit;

                $updateData = [
                    'check_in'  => !empty($in_time) ? date('H:i:s', strtotime($in_time)) : null,
                    'check_out' => !empty($check_out[$key]) ? date('H:i:s', strtotime($check_out[$key])) : null,
                    'status'    => isset($status[$key]) ? $status[$key] : 'Absent',
                ];

                // Get correct emp_id for the employee
                $employee_id = $emp_id[$key]; 

                // Debugging (optional)
                // echo "Updating Employee: $employee_id, Date: $dates";
                // print_r($updateData);
                // exit();

                // Update attendance record for the correct date and employee
                $this->Payroll_model->update_attendance_record($employee_id, $dates, $updateData);




            }
        }

        $this->session->set_flashdata('success', 'Attendance updated successfully.');
    } else {
        $this->session->set_flashdata('failed', 'Failed to update attendance. Please check the inputs.');
    }

    redirect('/PayrollController/index', 'refresh');
}



public function add_attendance() {
	$date= $this->input->post('date');
    $year = date('Y');
    $month = date('m');
	$created_by=$this->session->userdata['logged_in']['id'];
    foreach ($this->input->post('emp_id') as $key => $emp_id) {
        // Fetch the input values
        $date      = $date ?? null;
        $created_by      = $created_by ?? null;
        $check_in  = $this->input->post('check_in')[$key] ?? null;
        $check_out = $this->input->post('check_out')[$key] ?? null;
        $status    = $this->input->post('status')[$key] ?? null;

        // Only save the row if any of the fields (except emp_id) has a value
        if (!empty($check_in) || !empty($check_out) || !empty($status)) {
            $data = array(
                'emp_id'    => $emp_id,  
                'date'      => $date,
                'year'      => $year,
                'month'      => $month,
                'check_in'  => $check_in,
                'check_out' => $check_out,
                'status'    => $status,
                'created_by'    => $created_by,
            );

            $this->db->insert('attendance', $data);
        }
    }

    $this->session->set_flashdata('success', 'Attendance successfully added!');  
	redirect('/PayrollController/index', 'refresh');

}

public function show_calculation(){
    // echo"hello";
	
    $data['employees']  = $this->Payroll_model->getEmployeesList();
    $data['months'] 	= $this->Leave_model->getMonths();
    $data['salaries']  = $this->Payroll_model->getSalaryList();
// echo "<pre>";print_r($data['salaries']);exit;
    $data['title'] = "Attendance Calculation";
    $this->template->load('layout/template', 'leave-module/attandace_calculation', $data);
}

public function calculate_salary()
{
    $month_id = $this->input->post('month_id');
    $emp_id = $this->input->post('emp_id');

    if (!empty($month_id) && !empty($emp_id)) {
        $year = date('Y');
        $total_days = cal_days_in_month(CAL_GREGORIAN, $month_id, $year);

        $this->load->model('Payroll_model');
        $attendance = $this->Payroll_model->get_attendance_summary($emp_id, $month_id, $year) ?? [];
        $present_days = isset($attendance['present']) ? $attendance['present'] : 0;
        $absent_days = isset($attendance['absent']) ? $attendance['absent'] : 0;
        $basic_salary = isset($attendance['total_net_salary']) ? $attendance['total_net_salary'] : 0;
        $salary_per_day = ($basic_salary > 0 && $total_days > 0) ? ($basic_salary / $total_days) : 0;
        $gross_salary = $salary_per_day * $present_days;

        echo '
        <form id="salaryUpdateForm">
            <h4>Salary Calculation</h4>
            
            <div class="row form-group">
                <div class="col-md-4">Total Days in Month:</div>
                <div class="col-md-3"><input type="text" name="total_days" id="total_days" class="form-control" value="' . $total_days . '" readonly></div>
            </div>

            <div class="row form-group">
                <div class="col-md-4">Present Days:</div>
                <div class="col-md-3"><input type="text" class="form-control" value="' . $present_days . '" readonly></div>
            </div>

            <div class="row form-group">
                <div class="col-md-4">Absent Days:</div>
                <div class="col-md-3"><input type="text" id="absent_days" name="absent_days" class="form-control" value="' . $absent_days . '" readonly></div>
            </div>

            <div class="row form-group">
                <div class="col-md-4">Payable Days:</div>
                <div class="col-md-3"><input type="number" id="payable_days" name="payable_days" class="form-control" value="' . $present_days . '"></div>
            </div>

            <div class="row form-group">
                <div class="col-md-4">Basic Salary (₹):</div>
                <div class="col-md-3"><input type="text" id="basic_salary" class="form-control" value="' . $basic_salary . '" readonly></div>
            </div>

            <div class="row form-group">
                <div class="col-md-4">Gross Salary (₹):</div>
                <div class="col-md-3"><input type="text" id="gross_salary" name="gross_salary" class="form-control" value="' . $gross_salary . '" readonly></div>
            </div>

            <div class="row form-group">
                <div class="col-md-4">TDS (₹):</div>
                <div class="col-md-3"><input type="number" id="tds" class="form-control" value="0"></div>
            </div>

            <div class="row form-group">
                <div class="col-md-4">Provident Fund (PF) (₹):</div>
                <div class="col-md-3"><input type="number" id="pf" class="form-control" value="0"></div>
            </div>

            <div class="row form-group">
                <div class="col-md-4">ECS Deduction (₹):</div>
                <div class="col-md-3"><input type="number" id="ecs" class="form-control" value="0"></div>
            </div>

            <div class="row form-group">
                <div class="col-md-4">Other Salary Cuts (₹):</div>
                <div class="col-md-3"><input type="number" id="other_cuts" class="form-control" value="0"></div>
            </div>

            <div class="row form-group">
                <div class="col-md-4">Total Salary After Deductions (₹):</div>
                <div class="col-md-3"><input type="text" id="final_salary" class="form-control" value="' . $gross_salary . '" readonly></div>
            </div>

            <div class="row form-group">
                <div class="col-md-4"></div>
                <div class="col-md-4"><button type="button" id="saveSalary" class="btn btn-success btn-block">Save Salary</button></div>
            </div>
        </form>';
    } else {
        echo '<p class="text-danger">Please select both Month and Employee.</p>';
    }
}
public function save_salary()
{
    $emp_id = $this->input->post('emp_id');
    $month_id = $this->input->post('month_id');
    $total_days = $this->input->post('total_days');
    $payable_days = $this->input->post('payable_days');
    $absent_days = $this->input->post('absent_days');
    $gross_salary = $this->input->post('gross_salary');
    $tds = $this->input->post('tds');
    $pf = $this->input->post('pf');
    $other_cuts = $this->input->post('other_cuts');
    $ecs = $this->input->post('ecs'); // Get ECS deduction
    $total_salary = $this->input->post('total_salary');

    $data = [
        'emp_id' => $emp_id,
        'month_id' => $month_id,
        'year' => date('Y'),
        'total_days' => $total_days,

        'payable_days' => $payable_days,
        'absent_days' => $absent_days,
        'gross_salary' => $gross_salary,
        'tds' => $tds,
        'pf' => $pf,
        'other_cuts' => $other_cuts,
        'ecs' => $ecs, // Save ECS
        'total_salary' => $total_salary
    ];
    $this->db->insert('salary_table', $data);

    $this->session->set_flashdata('success', 'Salary successfully added!');  
	redirect('/PayrollController/show_calculation', 'refresh');
    exit(); // Force redirection
}

	public function deleteItem($id= null){
  	 	$id = $this->uri->segment('3');
  	 	$result =$this->Payroll_model->deleteItem($id);
  	 	if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Item deleted Successfully !');
            redirect('/PayrollController/show_calculation', 'refresh');
			//$this->fetchSuppliers();
		} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
            redirect('/PayrollController/show_calculation', 'refresh');
		}
  	}
}