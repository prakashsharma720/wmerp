<?php

Class Review_model extends MY_Model {
     private $table = 'review';
    private $detailTable = 'review_details';

	public function getEmployees() { 
        $result = $this->db->select('id, name,employee_code')->from('employees')->where('flag','0')->get()->result_array(); 
        //$result= $result->result_array();
        $employees = array(); 
        $employees[' '] = 'Select employees...'; 
        foreach($result as $r) { 
            $employees[$r['employee_code']] = $r['name'].' (MO-'.$r['employee_code'].')'; 
        } 
        
        return $employees; 
    } 

    function getMonths() { 
		$result = $this->db->select('id, month_name')->from('months')->where('flag','0')->get()->result_array(); 
		$productname = array(); 
        $productname[''] = 'Select leave month...'; 
        foreach($result as $r) { 

      //   	$this->db->select('id');
		    // $this->db->from('leave_allotment');
		    // $this->db->where(['leave_month'=> $r['id'],'leave_year'=>date('Y')]);
		   	// $query=$this->db->get();
		    // $total=$query->num_rows();
		    // if($total == 0){
            $productname[$r['month_name']] = $r['month_name']; 
        	// }
        } 
		return $productname;
      
    }

    function data_insert($data) {
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();
   

    $this->reviewDetails($id);


    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }
    
}
/************** PO Details Insertion ******************/

  function reviewDetails($id) {
        $this->db->where('review_id', $id);
        $this->db->delete($this->detailTable);
             if ($this->input->post('criteria')):
                foreach ($this->input->post('criteria') as $key => $value) :
                    $this->db->set('review_id', $id);   
                    $this->db->set('criteria_name', $value);
                    $this->db->set('criteria_point', $this->input->post('criteria_point')[$key]);
                    $this->db->set('self_review', $this->input->post('self_review')[$key]);
                    $this->db->set('author_review', $this->input->post('author_review')[$key]);

                    $this->db->insert($this->detailTable);
                endforeach;
            endif;   
    }

    function getAllotedReview() { 
		$this->db->select('review.*, months.month_name as review_month, employees.name as employee_id');
    $this->db->from('review');
		$this->db->join('months','review.review_month=months.month_name','left');
		$this->db->join('employees','review.employee_id=employees.id','left');
	
		// $this->db->group_by('leave_allotment.emp_id');
		$query = $this->db->get()->result_array(); 
	
    $j=0;
    foreach ($query as $j => $value) {
        $this->db->select('*');
        $this->db->from('review_details');
        $this->db->where(['review_details.review_id'=>$value['id']]);
        $details1 = $this->db->get()->result_array();
        $query[$j]['review_details'] = $details1;
       
    }
      return $query;
    }

    function getAllotedReviewByEmployee($login_id) { 
		$this->db->select('review.*, months.month_name as review_month, employees.name as employee_id');
		$this->db->join('months','review.review_month=months.month_name','left');
		$this->db->join('employees','review.employee_id=employees.id','left');
        $this->db->where('employees.id',$login_id);
		$this->db->from('review');
		// $this->db->group_by('leave_allotment.emp_id');
		$query = $this->db->get()->result_array(); 
		

    $j=0;
    foreach ($query as $j => $value) {
        $this->db->select('*');
        $this->db->from('review_details');
        $this->db->where(['review_details.review_id'=>$value['id']]);
        $details1 = $this->db->get()->result_array();
        $query[$j]['review_details'] = $details1;
       
    }
    return $query;
    }

}
?>