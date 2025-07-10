<?php

Class Area_cleaning_record_model extends MY_Model {
	  	private $table = 'area_cleaning_records';
    	private $detailTable = 'area_cleaning_details';

	// Insert registration data in database
	public function record_insert($data) 
	{
		$this->db->insert($this->table, $data);
		$id = $this->db->insert_id();
		$this->ACRDetails($id);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
		return false;
		}
	}

	public function ACRDetails($id) {
		$this->db->where('area_cleaning_record_id', $id);
        $this->db->delete($this->detailTable);
        if ($this->input->post('area_id')):
                foreach ($this->input->post('area_id') as $key => $value) :
                    $this->db->set('area_cleaning_record_id', $id);
                    $this->db->set('area_id', $value);
                    //$this->db->set('frequency', $this->input->post('frequency')[$key]);
                    $this->db->set('status_of_work', $this->input->post('status_of_work')[$key]);
                    $this->db->set('remark', $this->input->post('remark')[$key]);
                    $this->db->set('worker_id', $this->input->post('worker_id')[$key]);
                    $this->db->insert($this->detailTable);
                endforeach;
            endif; 
	}
	public function record_update($data,$id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		$this->ACRDetails($id);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
		return false;
		}
	}
	function getACRCode(){
	    $count=0;
	    $this->db->select_max('id');
	    $this->db->from('area_cleaning_records');
	    $query=$this->db->get()->row_array();
	    //print_r($query['employee_code']);exit;
	    $count=$query['id']+1;
	    return $count;
	}

    function AreaCleaningList(){
        $this->db->select('area_cleaning_records.*,emp1.name as employee');
        $this->db->from('area_cleaning_records');
        $this->db->join('employees as emp1', 'area_cleaning_records.created_by = emp1.id','left'); 
       // $this->db->where(['process_logsheets.flag'=>'0']);
        $this->db->order_by('area_cleaning_records.id','ASC');
        $query =  $this->db->get()->result_array();
        //print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
         foreach($query as $i=>$po_data) {
            $this->db->select('area_cleaning_details.*,workers.name as worker_name,workers.worker_code as worker_code,areas.area_name as area_name,areas.frequency as frequency');
            $this->db->join('areas', 'area_cleaning_details.area_id = areas.id');
            $this->db->join('workers', 'area_cleaning_details.worker_id = workers.id', 'left'); 
            $this->db->where('area_cleaning_details.area_cleaning_record_id', $po_data['id']);
            $images_query = $this->db->get('area_cleaning_details')->result_array();
            $query[$i]['area_cleaning_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    } 
	
	public function getById($id) {
       $this->db->select('area_cleaning_records.*,emp1.name as employee');
        $this->db->from('area_cleaning_records');
        $this->db->join('employees as emp1', 'area_cleaning_records.created_by = emp1.id','left'); 
        $this->db->where(['area_cleaning_records.id'=>$id]);
        $query =  $this->db->get()->result_array();
        //print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
         foreach($query as $i=>$po_data) {
            $this->db->select('area_cleaning_details.*,workers.name as worker_name,workers.worker_code as worker_code,areas.area_name as area_name,areas.frequency as frequency');
            $this->db->join('areas', 'area_cleaning_details.area_id = areas.id');
            $this->db->join('workers', 'area_cleaning_details.worker_id = workers.id', 'left'); 
            $this->db->where('area_cleaning_details.area_cleaning_record_id', $po_data['id']);
            $images_query = $this->db->get('area_cleaning_details')->result_array();
            $query[$i]['area_cleaning_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    }
    function getWorkers() { 
       $result = $this->db->select('id, name,worker_code')->from('workers')->where('flag','0')->get()->result_array();  
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
        $result = $this->db->select('id, area_name,frequency')->from('areas')->where('status','0')->get()->result_array(); 
        //$result= $result->result_array();
        // $areas = array(); 
        // $areas[' '] = 'Select Area...'; 
        // foreach($result as $r) { 
        //     $areas[$r['id']] = $r['area_name']; 
        // } 
        
        return $result; 
    } 
    function deleteRecord($id)
		{
			 $this->db->where('id',$id);
		       if($this->db->delete('area_cleaning_records'))
		        {
		            $this->db->where('area_cleaning_record_id', $id);
		            if($this->db->delete('area_cleaning_details'))
		            {
		                return true;
		                
		            }
		        }
		}



}
?>