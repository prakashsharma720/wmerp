<?php

Class Employee extends MY_Model {

	// Insert registration data in database
	public function employee_insert($data) 
	{

		// Query to check whether username already exist or not
		$condition = "employee_code =" . "'" . $data['employee_code'] . "'";

		$this->db->select('*');
		$this->db->from('employees');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		//print_r($data);exit;
		if ($query->num_rows() == 0) {
		// Query to insert data in database
		$this->db->insert('employees', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		} else { 
		return false;
		}
	}
	public function employee_update($data,$id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $id);
		$this->db->update('employees', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
		return false;
		}
	}
	function getEmployeeCode(){
    $count=0;
    $this->db->select_max('employee_code');
    $this->db->from('employees');
    $query=$this->db->get()->row_array();
    //print_r($query['employee_code']);exit;
    $count=$query['employee_code']+1;
    return $count;
   
	}

	public function employeesList() 
	{
		
		$this->db->select('employees.*,roles.role,departments.department_name as department_name,designations.designation as designation');
		$this->db->from('employees');
		$this->db->join('roles', 'employees.role_id = roles.id', 'left'); 
		$this->db->join('departments', 'employees.department_id = departments.id', 'left'); 
		$this->db->join('designations', 'employees.designation_id = designations.id', 'left'); 
		$this->db->where('employees.flag','0');
		$this->db->order_by("employees.name", "asc");
		$query = $this->db->get();
		//print_r($query);exit;
		return $query->result_array();

	}
	public function upcomingBirthdays($days)
	{
		$this->db->select('employees.*, roles.role, departments.department_name, designations.designation');
		$this->db->from('employees');
		$this->db->join('roles', 'employees.role_id = roles.id', 'left');
		$this->db->join('departments', 'employees.department_id = departments.id', 'left');
		$this->db->join('designations', 'employees.designation_id = designations.id', 'left');
		$this->db->where('employees.flag', '0');

		// Extract month and day from `dob`, compare it with today and next X days
		$this->db->where("DATE_FORMAT(dob, '%m-%d') BETWEEN DATE_FORMAT(NOW(), '%m-%d') 
        AND DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $days DAY), '%m-%d')", NULL, FALSE);

		$this->db->order_by("MONTH(dob)", "ASC");
		$this->db->order_by("DAY(dob)", "ASC");


		$query = $this->db->get();

		return $query->result_array();
	}

	public function upcomingWorkAnniversary($days)
	{
		$this->db->select('employees.*, roles.role, departments.department_name, designations.designation');
		$this->db->from('employees');
		$this->db->join('roles', 'employees.role_id = roles.id', 'left');
		$this->db->join('departments', 'employees.department_id = departments.id', 'left');
		$this->db->join('designations', 'employees.designation_id = designations.id', 'left');
		$this->db->where('employees.flag', '0');

		// Extract month and day from `dob`, compare it with today and next X days
		$this->db->where("DATE_FORMAT(date_of_joining, '%m-%d') BETWEEN DATE_FORMAT(NOW(), '%m-%d') 
        AND DATE_FORMAT(DATE_ADD(NOW(), INTERVAL $days DAY), '%m-%d')", NULL, FALSE);

		$this->db->order_by("MONTH(date_of_joining)", "ASC");
		$this->db->order_by("DAY(date_of_joining)", "ASC");


		$query = $this->db->get();

		return $query->result_array();
	}
	
	public function getById($id) {
       $this->db->select('employees.*,roles.role,designations.designation');
		$this->db->from('employees');
		$this->db->join('roles', 'employees.role_id = roles.id', 'left');
		        $this->db->join('designations', 'employees.designation_id = designations.id', 'left');

		//$this->db->join('departments', 'employees.department_id = departments.id', 'left'); 
        $this->db->where('employees.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    function getRoles() { 
        $result = $this->db->select('id, role')->from('roles')->where('flag','0')->get()->result_array(); 
        $roles = array(); 
        $roles[''] = 'Select Role...'; 
        foreach($result as $r) { 
            $roles[$r['id']] = $r['role']; 
        } 
        
        return $roles; 
    } 
    function getUsersList() { 
        $result = $this->db->select('id, name')->from('employees')->where('flag','0')->get()->result_array(); 
        $users = array(); 
        $users[''] = 'Select User...'; 
        foreach($result as $r) { 
            $users[$r['id']] = $r['name']; 
        } 
        return $users; 
    } 


      function getDepartments() { 
        $result = $this->db->select('id, department_name,department_code')->from('departments')->where('flag','0')->get()->result_array(); 
        //$result= $result->result_array();
        $departments = array(); 
        $departments[' '] = 'Select department...'; 
        foreach($result as $r) { 
            $departments[$r['id']] = $r['department_name'].' ('.$r['department_code'].')'; 
        } 
        
        return $departments; 
    }
	function getDesignation() { 
        $result = $this->db->select('id, designation')->from('designations')->where('flag','0')->get()->result_array(); 
        //$result= $result->result_array();
        $designation = array(); 
         $designation[' '] = 'Select designation...'; 
        foreach($result as $r) { 
            $designation[$r['id']] = $r['designation']; 
        } 
        
        return $designation; 
    }
	function getEmployees() { 
        $result = $this->db->select('id, name,employee_code')->from('employees')->where('flag','0')->get()->result_array(); 
        //$result= $result->result_array();
        $employees = array(); 
        $employees[' '] = 'Select employees...'; 
        foreach($result as $r) { 
            $employees[$r['employee_code']] = $r['name'].' (MO-'.$r['employee_code'].')'; 
        } 
        
        return $employees; 
    }  
    function deleteemployee($id)
		{
			//if($this->db->delete('suppliers', "id = ".$id)) return true;
			$data=array('flag'=>'1','status'=>'1');
			$this->db->set('flag','flag',false);
			$this->db->where('id',$id);
			if($this->db->update('employees', $data)){
				return true;
			}
		}

	function get_author_email($author_id) {
		$this->db->select('email');
		$this->db->where('id', $author_id);
		$this->db->from('employees');
		$query=$this->db->get()->row_array();
		return $query['email'];
	}

}
?>