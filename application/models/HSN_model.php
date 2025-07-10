<?php

Class hsn_Model extends MY_Model {

	// Insert registration data in database
	public function hsn_insert($data) 
	{

		// Query to check whether username already exist or not
		$condition = "hsn_code =" . "'" . $data['hsn_code'] . "'";

		$this->db->select('*');
		$this->db->from('hsn');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		//print_r($data);exit;
		if ($query->num_rows() == 0) {
		// Query to insert data in database
		$this->db->insert('hsn', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		} else { 
		return false;
		}
	}
	public function hsn_update($data,$id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $id);
		$this->db->update('hsn', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		else { 
		return false;
		}
	}
	public function hsnList() 
	{
		
		$this->db->select('hsn.*');
		$this->db->from('hsn');
		//$this->db->join('categories', 'hsn.categories_id = categories.id');
		$this->db->where('hsn.flag','0');
		$this->db->order_by("hsn.mineral_name", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}
	public function getById($id) {
       	$this->db->select('*');
		$this->db->from('hsn');
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

	function getCategories() { 
		$result = $this->db->select('id, category_name')->from('categories')->where(['flag'=>'0'])->get()->result_array();         
        return $result; 
    } 
	function gethsnByCategory($category_id) { 
		$result = $this->db->select('id, hsn')->from('hsn')->where(['flag'=>'0','categories_id'=>$category_id])->get()->result_array();         
        return $result; 
    } 
 function getmineralById($id) { 
       $result = $this->db->select('hsn_code')->from('hsn')->where(['flag'=>'0','mineral_name'=>$id])->get()->row_array(); 
        
        return $result; 
    }
 
}
?>