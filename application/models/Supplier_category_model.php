<?php

Class Supplier_category_model extends MY_Model {

	// Insert registration data in database
	public function category_insert($data) 
	{

		// Query to check whether username already exist or not
		$condition = "category_name =" . "'" . $data['category_name'] . "'";

		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		//print_r($data);exit;
		if ($query->num_rows() == 0) {
		// Query to insert data in database
		$this->db->insert('categories', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		} else { 
		return false;
		}
	}
	public function category_update($data,$id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $id);
		$this->db->update('categories', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		else { 
		return false;
		}
	}
	public function categoriesList() 
	{
		
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('flag','0');
		$this->db->order_by("category_name", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}
	public function getById($id) {
       	$this->db->select('*');
		$this->db->from('categories');
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