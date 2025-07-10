<?php

Class Grid_Model extends MY_Model {

	// Insert registration data in database
	public function grid_insert($data) 
	{

		// Query to check whether username already exist or not
		$condition = "grid_name =" . "'" . $data['grid_name'] . "'";

		$this->db->select('*');
		$this->db->from('grid');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		//print_r($data);exit;
		if ($query->num_rows() == 0) {
		// Query to insert data in database
		$this->db->insert('grid', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		} else { 
		return false;
		}
	}
	public function grid_update($data,$id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $id);
		$this->db->update('grid', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		else { 
		return false;
		}
	}
	public function gridList() 
	{
		
		$this->db->select('*');
		$this->db->from('grid');
		$this->db->where('flag','0');
		$this->db->order_by("grid_name", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}
	public function getById($id) {
       	$this->db->select('*');
		$this->db->from('grid');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    // ************* show grid name by id *****************//
	/*public function fetchcatName($id) {
       	$this->db->select('grid_name');
		$this->db->from('grids');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
        //print_r($query);exit;
    }*/



}
?>