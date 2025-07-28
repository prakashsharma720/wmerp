<?php

Class CustomerSupport_model extends MY_Model {

	private $table = 'customer_support';
    private $lead_followups = 'lead_followups';

    public function __construct() {
        parent::__construct();
    }
	public function checkRecors($created_by,$date){
		$this->db->select('id');
		$this->db->from('lead_count');
		$this->db->where(['employee_id'=>$created_by,'date'=>$date]);
		$count=$this->db->get()->num_rows();
		return $count;
	}
	// Insert registration data in database
	public function insert($data) 
	{

		
		// Query to insert data in database
		$this->db->insert('customer_support', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		else { 
		return false;
		}
	}

	




	public function getList() 
	{
		$data =[];
		$this->db->select('*');
		$this->db->from('customer_support');
		$query= $this->db->get()->result_array();
		//   echo "<pre>";print_r($data['ticket_data']);exit;
		foreach($query as $key=>$row){
			$data[$key]['ticket_data'] = $row;
			// $data[$key]['customer_data'] = $this->getFollowupById($row['ticket']);
			$data[$key]['followups'] = $this->getFollowUps($row['ticket']);
		}

		// echo "<pre>";print_r($data);exit;
		return $data;

	}
	
	public function update_status ($id,$data){
				$this->db->where('id', $id);
				$this->db->update('customer_support', $data);
				if ($this->db->affected_rows() > 0) {
				return true;
				}
				else { 
				return false;
				}
}
	public function getById($id) {
       	$this->db->select('*');
		$this->db->from('customer_support');
        $this->db->where('ticket', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
	public function getFollowupById($id) {
       	$this->db->select('customer_support.*,employees.name');
		$this->db->from('customer_support');
	 	$this->db->join('employees', 'customer_support.auth_id = employees.id','left'); 
	 	$this->db->where('customer_support.ticket', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

	 public function insertFollowup($data) 
	{
		$this->db->insert('customer_followups', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
		return false;
		}
	}
 function deletefollowup($id)
		{
			if($this->db->delete('customer_followups', "id = ".$id)) return true;
		}
	  public function getFollowUps($id) {
       	$this->db->select('customer_followups.*,customer_support.order_id ');
		$this->db->from('customer_followups');
	 	$this->db->join('customer_support', 'customer_followups.customer_id = customer_support.id','left'); 
	 	$this->db->where('customer_followups.ticket', $id);
        $query = $this->db->get();
        return $query->result_array();
    }


	 function getOrder() { 
		$result = $this->db->select('id, invoice_no')->from('invoices')->where('flag','0')->get()->result_array(); 
        //$result = $this->db->select('id, category_name')->get('categories')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $productname = array(); 
        $productname[''] = 'Select Order...'; 
        foreach($result as $r) { 
            $productname[$r['invoice_no']] = $r['invoice_no']; 
        } 
        
        return $productname; 
    }
}
?>
