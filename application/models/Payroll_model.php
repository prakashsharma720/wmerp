<?php

Class Payroll_model extends MY_Model {
 // Get unique attendance dates
 public function getUniqueAttendanceDates() {
    $this->db->distinct();
    $this->db->select('date,id');
    $this->db->from('attendance');
    $this->db->group_by('date');
    $this->db->order_by('date', 'DESC');
    $query= $this->db->get()->result_array();
    // echo "<pre>";print_r($query);exit;
    foreach( $query as $key=>$list){
        $query[$key]['dateil']=$this->getAttendanceByDate($list['date']);
        $query[$key]['absent_count'] = $this->getTotalAbsent($list['date']); // Get absent count
        $query[$key]['present_count'] = $this->getTotalPresent($list['date']); // Get absent count

    }
        return $query;

}
public function getSalaryList() {
    $this->db->select('
    salary_table.*, 
    employees.name as emp_name,
    employees.employee_code,
    employees.designation_id,
    employees.department_id,
    employees.date_of_joining,
    employees.uan,
    employees.pf as pf_no,
    employees.esi,
    employees.bank_name,
    employees.account_number,
    employees.branch_name,
    employees.ifsc_code,
    employees.pan_no,
    employees.salary,
    employees.hra,
    employees.c_allowance,
    employees.m_allowance,
    employees.o_allowance,
    employees.total_net_salary,
    months.month_name,
    designations.designation as designation_name, 
    departments.department_name as department_name
'); 
$this->db->from('salary_table');
$this->db->join('employees', 'employees.id = salary_table.emp_id', 'left'); 
$this->db->join('months', 'months.id = salary_table.month_id', 'left'); 
$this->db->join('departments', 'departments.id = employees.department_id', 'left'); 
$this->db->join('designations', 'designations.id = employees.designation_id', 'left'); 
    $query = $this->db->get();
    return $query->result_array();
}

public function get_attendance_by_date($date) {
    $this->db->select('attendance.*, employees.name as emp_name'); // Select attendance data + employee name
    $this->db->from('attendance');
    $this->db->join('employees', 'employees.id = attendance.emp_id', 'left'); 
    $this->db->where('attendance.date', $date);
    $query = $this->db->get();
    return $query->result_array();
}
public function update_attendance_record($emp_id, $date, $updateData)
{
    $this->db->where('emp_id', $emp_id);
    $this->db->where('date', $date); // Ensure correct date format
    $this->db->update('attendance', $updateData);
    // echo $this->db->last_query(); exit;
    
}
function deleteItem($id)
{
    if($this->db->delete('salary_table', "id = ".$id)) return true;
   
}

function getEmployeesList() { 
    $result = $this->db->select('id, name')->from('employees')->where('flag','0')->get()->result_array(); 
    $productname[''] = 'Select Employee ...'; 
        foreach($result as $r) { 

      //   	$this->db->select('id');
		    // $this->db->from('leave_allotment');
		    // $this->db->where(['leave_month'=> $r['id'],'leave_year'=>date('Y')]);
		   	// $query=$this->db->get();
		    // $total=$query->num_rows();
		    // if($total == 0){
            $productname[$r['id']] = $r['name']; 
        	// }
        } 
		return $productname;
  
}
public function save_salary_calculation($data)
{
    $this->db->replace('salary_calculations', $data); // Replace existing entry
}
public function save_salary_details($data)
{
    $this->db->insert('salary_details', $data);
}

public function get_salary_calculation($emp_id, $month_id)
{
    return $this->db->get_where('salary_calculations', ['employee_id' => $emp_id, 'month_id' => $month_id])->row_array();
}
public function get_attendance_summary($emp_id, $month, $year)
{
    $this->db->select("employees.salary,employees.total_net_salary, 
                        SUM(CASE WHEN a.status = 'Present' THEN 1 ELSE 0 END) as present,
                        SUM(CASE WHEN a.status = 'Absent' THEN 1 ELSE 0 END) as absent");
    $this->db->from('attendance a');
    $this->db->join('employees', 'employees.id = a.emp_id', 'left'); // Join with employees table
    $this->db->where('a.emp_id', $emp_id);
    $this->db->where("MONTH(a.date)", $month);
    $this->db->where("YEAR(a.date)", $year);
    
    $query = $this->db->get();
    return $query->row_array();
}


public function getTotalAbsent($date) {
    $this->db->select('COUNT(*) as absent_count'); // Count absent employees
    $this->db->from('attendance');
    $this->db->where(['attendance.date' => $date, 'attendance.status' => 'Absent']);

    $query = $this->db->get()->row_array();  
    return $query['absent_count'] ?? 0; // Return count (0 if no records)
}
public function getTotalPresent($date) {
    $this->db->select('COUNT(*) as present_count'); // Count absent employees
    $this->db->from('attendance');
    $this->db->where(['attendance.date' => $date, 'attendance.status' => 'Present']);

    $query = $this->db->get()->row_array();  
    return $query['present_count'] ?? 0; // Return count (0 if no records)
}
public function getTotalEmployee() {
    $this->db->select('COUNT(*) as total_count'); // Alias count as 'total_count'
    $this->db->from('employees'); // Use attendance table to count employees on the given date

    $query = $this->db->get()->row_array();
    return $query['total_count'] ?? 0; // Return the total count (default to 0)
}

// Get attendance records by date
public function getAttendanceByDate($date) {
    $this->db->select('attendance.*, employees.name as emp_name');
    $this->db->from('attendance');
    $this->db->join('employees', 'attendance.emp_id = employees.id', 'left');
    $this->db->where('attendance.date', $date);
    
    return $this->db->get()->result_array();
}
}
?>