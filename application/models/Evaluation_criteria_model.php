<?php

Class Evaluation_criteria_Model extends MY_Model {

	// Insert registration data in database
	public function ec_insert($data) 
	{

		// Query to check whether username already exist or not
		$condition = "ec_name =" . "'" . $data['ec_name'] . "' && ec_type=" . "'".$data['ec_type']."'";

		$this->db->select('*');
		$this->db->from('evaluation_criteria');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		//print_r($data);exit;
		if ($query->num_rows() == 0) {
		// Query to insert data in database
		$this->db->insert('evaluation_criteria', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		} else { 
		return false;
		}
	}
	public function ec_update($data,$id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $id);
		$this->db->update('evaluation_criteria', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		else { 
		return false;
		}
	}
	public function ECList() 
	{
		
		$this->db->select('*');
		$this->db->from('evaluation_criteria');
		$this->db->where('flag','0');
		$this->db->order_by("id", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}
	public function SupllierECList() 
	{
		
		$this->db->select('*');
		$this->db->from('evaluation_criteria');
		$this->db->where(['flag'=>'0','ec_type'=>'Supplier']);
		$this->db->order_by("id", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}
	public function TransporterECList() 
	{
		
		$this->db->select('*');
		$this->db->from('evaluation_criteria');
		$this->db->where(['flag'=>'0','ec_type'=>'Transporter']);
		$this->db->order_by("id", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}
	public function SProviderECList() 
	{
		
		$this->db->select('*');
		$this->db->from('evaluation_criteria');
		$this->db->where(['flag'=>'0','ec_type'=>'Service Provider']);
		$this->db->order_by("id", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}
	public function getById($id) {
       	$this->db->select('*');
		$this->db->from('evaluation_criteria');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    // ************* show category name by id *****************//
	/*public function fetchcatName($id) {
       	$this->db->select('category_name');
		$this->db->from('categories');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
        //print_r($query);exit;
    }*/
    
}
?>