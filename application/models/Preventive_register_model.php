<?php

Class Preventive_register_model extends MY_Model {

	// Insert registration data in database
	public function record_insert($data) 
	{

		// Query to check whether username already exist or not
		/*$condition = "employee_code =" . "'" . $data['employee_code'] . "'";

		$this->db->select('*');
		$this->db->from('employees');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();*/
		//print_r($data);exit;
		// Query to insert data in database
		$this->db->insert('preventive_maintenance_records', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
		return false;
		}
	}
	public function record_update($data,$id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $id);
		$this->db->update('preventive_maintenance_records', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
		return false;
		}
	}
	function getJobORderCode(){
    $count=0;
    $this->db->select_max('voucher_code');
    $this->db->from('preventive_maintenance_records');
    $query=$this->db->get()->row_array();
    //print_r($query['employee_code']);exit;
    $count=$query['voucher_code']+1;
    return $count;
   
	}

	public function getList($conditions=NULL){
		
		/*$this->db->select('preventive_maintenance_records.*,workers.name as worker_name,workers.worker_code as worker_code,employees.name as emp_name,employees.employee_code as emp_code,areas.area_name as area_name');*/
		$this->db->select('preventive_maintenance_records.*,employees.name as emp_name,employees.employee_code as emp_code,plants.plant as plant_name');
		$this->db->from('preventive_maintenance_records');
		$this->db->join('plants', 'preventive_maintenance_records.plant_id = plants.id', 'left'); 
		//$this->db->join('workers', 'preventive_maintenance_records.worker_id = workers.id', 'left'); 
		$this->db->join('employees', 'preventive_maintenance_records.created_by = employees.id', 'left'); 
		//$this->db->join('departments', 'employees.department_id = departments.id', 'left'); 
		$this->db->where('preventive_maintenance_records.flag','0');
		$this->db->order_by("preventive_maintenance_records.id", "asc");
		if(!empty($conditions)){
            
            if($conditions['area'] !=" ")
               $this->db->like('preventive_maintenance_records.plant_id',$conditions['area']);
           
            if($conditions['from_date']!='1970-01-01')
                $this->db->where('preventive_maintenance_records.date_of_maintenance >=',$conditions['from_date']); 

             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('preventive_maintenance_records.date_of_maintenance <=',$conditions['upto_date']); 
        }
		$query = $this->db->get();
		return $query->result_array();

	}
	public function getById($id) {
       $this->db->select('*');
		$this->db->from('preventive_maintenance_records');
        $this->db->where('preventive_maintenance_records.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    function getWorkers() { 
        $result = $this->db->select('id,name,worker_code')->from('workers')->where('flag','0')->get()->result_array(); 
        $roles = array(); 
        $roles[''] = 'Select Worker'; 
        foreach($result as $r) { 
        	$voucher_no= $r['worker_code'];
            if($voucher_no<10){
            $worker_id_code='WC000'.$voucher_no;
            }
            else if(($voucher_no>=10) && ($voucher_no<=99)){
              $worker_id_code='WC00'.$voucher_no;
            }
            else if(($voucher_no>=100) && ($voucher_no<=999)){
              $worker_id_code='WC0'.$voucher_no;
            }
            else{
              $worker_id_code='WC'.$voucher_no;
            }
            $roles[$r['id']] = $r['name'].' ('.$worker_id_code.')'; 
        } 
        
        return $roles; 
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
      function getAreas() { 
        $result = $this->db->select('id, plant')->from('plants')->where('flag','0')->get()->result_array(); 
        //$result= $result->result_array();
        $areas = array(); 
        $areas[' '] = 'Select Plant...'; 
        foreach($result as $r) { 
            $areas[$r['id']] = $r['plant']; 
        } 
        
        return $areas; 
    } 
    function deleteRecord($id)
		{
			//if($this->db->delete('suppliers', "id = ".$id)) return true;
			$data=array('flag'=>'1');
			$this->db->set('flag','flag',false);
			$this->db->where('id',$id);
			if($this->db->update('preventive_maintenance_records', $data)){
				return true;
			}
		}



}
?>