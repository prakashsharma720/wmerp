<?php

Class Job_order_model extends MY_Model {

	// Insert registration data in database
	public function jobcard_insert($data) 
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
		$this->db->insert('job_order_records', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
		return false;
		}
	}
	public function job_order_update($data,$id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $id);
		$this->db->update('job_order_records', $data);
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
    $this->db->from('job_order_records');
    $query=$this->db->get()->row_array();
    //print_r($query['employee_code']);exit;
    $count=$query['voucher_code']+1;
    return $count;
   
	}

	public function JobOrderList() 
	{
		
		$this->db->select('job_order_records.*,workers.name as worker_name,workers.worker_code as worker_code,employees.name as emp_name,employees.employee_code as emp_code');
		$this->db->from('job_order_records');
		$this->db->join('workers', 'job_order_records.assigned_to = workers.id', 'left'); 
		$this->db->join('employees', 'job_order_records.reported_by = employees.id', 'left'); 
		//$this->db->join('departments', 'employees.department_id = departments.id', 'left'); 
		$this->db->where('job_order_records.flag','0');
		$this->db->order_by("job_order_records.id", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}
	public function getById($id) {
       $this->db->select('*');
		$this->db->from('job_order_records');
        $this->db->where('job_order_records.id', $id);
        $query = $this->db->get();
        return $query->row_array();
	}
	
	function getAllReqList($conditions= null){
        //print_r($conditions);exit;
        $this->db->select('job_order_records.*,workers.name as worker_name,workers.worker_code as worker_code,employees.name as emp_name,employees.employee_code as emp_code');
		$this->db->from('job_order_records');
		$this->db->join('workers', 'job_order_records.assigned_to = workers.id', 'left'); 
		$this->db->join('employees', 'job_order_records.reported_by = employees.id', 'left'); 
		if(!empty($conditions)){
            // if($conditions['worker_id'] !="0")
            // $this->db->like('work_allotment_registers.worker_id',$conditions['worker_id'],'both');

            // if($conditions['department_id'] !="0")
            //    $this->db->like('job_order_records.department_id',$conditions['department_id'],'both');

            // if($conditions['approved_status'] !="All")
            //    $this->db->like('work_allotment_registers.approved_status',$conditions['approved_status'],'both');

            if($conditions['from_date']!='1970-01-01')
                $this->db->where('job_order_records.transaction_date >=',$conditions['from_date']); 

             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('job_order_records.transaction_date <=',$conditions['upto_date']); 
        }
        

        $this->db->order_by('job_order_records.id','ASC');

        $query =  $this->db->get()->result_array();
       // print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
        // foreach($query as $i=>$po_data) {
        //     $this->db->select('daily_tailing_record_details.*,fg1.mineral_name as mineral_name,fg1.grade_name as grade_name,fg2.mineral_name as used_mineral_name,fg2.grade_name as used_grade_name');
        //     $this->db->join('finish_goods as fg1', 'daily_tailing_record_details.finish_good_id = fg1.id'); 
        //     $this->db->join('finish_goods as fg2', 'daily_tailing_record_details.reused_grade_id = fg2.id'); 
        //     $this->db->where('daily_tailing_record_details.daily_tailing_record_id', $po_data['id']);
        //     $images_query = $this->db->get('daily_tailing_record_details')->result_array();
        //     $query[$i]['dsr_details'] = $images_query;
        // }
        //print_r($query);exit;
        return $query;
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
    function deleteRecord($id)
		{
			//if($this->db->delete('suppliers', "id = ".$id)) return true;
			$data=array('flag'=>'1');
			$this->db->set('flag','flag',false);
			$this->db->where('id',$id);
			if($this->db->update('job_order_records', $data)){
				return true;
			}
		}
		
	function getPlants() { 
        $result = $this->db->select('id, plant')->from('plants')->where('flag','0')->get()->result_array(); 
        //$result= $result->result_array();
        $areas = array(); 
        $areas[' '] = 'Select Plant...'; 
        foreach($result as $r) { 
            $areas[$r['plant']] = $r['plant']; 
        } 
        
        return $areas; 
    } 



}
?>