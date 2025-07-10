<?php

Class Worker extends MY_Model {

	// Insert registration data in database
	public function worker_insert($data) 
	{

		// Query to check whether username already exist or not
		$condition = "worker_code =" . "'" . $data['worker_code'] . "'";

		$this->db->select('*');
		$this->db->from('workers');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		//print_r($data);exit;
		if ($query->num_rows() == 0) {
		// Query to insert data in database
		$this->db->insert('workers', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		} else { 
		return false;
		}
	}
	public function worker_update($data,$id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $id);
		$this->db->update('workers', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
		return false;
		}
	}
	function getworkerCode(){
    $count=0;
    $this->db->select_max('worker_code');
    $this->db->from('workers');
    $this->db->where('flag','0');
    $query=$this->db->get()->row_array();
    //print_r($query['worker_code']);exit;
    $count=$query['worker_code']+1;
    return $count;
   
	}

	public function workersList() 
	{
		
		$this->db->select('workers.*,departments.department_name');
		$this->db->from('workers');
		//$this->db->join('roles', 'workers.role_id = roles.id', 'left'); 
		$this->db->join('departments', 'workers.department_id = departments.id', 'left'); 
		$this->db->where('workers.flag','0');
		$this->db->order_by("workers.name", "asc");
		$query = $this->db->get();
		//print_r($query);exit;
		return $query->result_array();

	}
	public function getById($id) {
       $this->db->select('workers.*,departments.department_name');
		$this->db->from('workers');
		//$this->db->join('roles', 'workers.role_id = roles.id', 'left'); 
		$this->db->join('departments', 'workers.department_id = departments.id', 'left'); 
        $this->db->where('workers.id', $id);
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
      function getDepartments() { 
        $result = $this->db->select('id, department_name,department_code')->from('departments')->where(['flag'=>'0','show_dept'=>'1'])->get()->result_array(); 
        //$result= $result->result_array();
        $departments = array(); 
        $departments[''] = 'Select department...'; 
        foreach($result as $r) { 
            $departments[$r['id']] = $r['department_name'].' ('.$r['department_code'].')'; 
        } 
        
        return $departments; 
    } 
    function deleteworker($id)
		{
			//if($this->db->delete('suppliers', "id = ".$id)) return true;
			$data=array('flag'=>'1','status'=>'1');
			$this->db->set('flag','flag',false);
			$this->db->where('id',$id);
			if($this->db->update('workers', $data)){
				return true;
			}
		}



}
?>