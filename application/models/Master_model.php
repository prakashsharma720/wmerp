<?php

Class Master_Model extends MY_Model {

	// Insert registration data in database
	public function category_insert($data) 
	{

		// Query to check whether username already exist or not

		$this->db->insert('categories', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
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
	public function categoriesListByType($type= null) 
	{
		
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where(['flag'=>'0','category_type'=>$type]);
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
	public function getByroleId($id) {
		$this->db->select('*');
	 $this->db->from('roles');
	 $this->db->where('id', $id);
	 $query = $this->db->get();
	 return $query->row_array();
 }
 public function rolelist() 
 {
	 
	 $this->db->select('*');
	 $this->db->from('roles');
	 $this->db->where('flag','0');
	 $this->db->order_by("role", "asc");
	 $query = $this->db->get();
	 return $query->result_array();

 }
 public function role_insert($data) 
 {

	 // Query to check whether username already exist or not

	 $this->db->insert('roles', $data);
	 if ($this->db->affected_rows() > 0) {
	 return true;
	 }
	  else { 
	 return false;
	 }
 }

 public function role_update($data,$id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $id);
		$this->db->update('roles', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		else { 
		return false;
		}
	}
	function deleteItem($id)
		{
			if($this->db->delete('roles', "id = ".$id)) return true;
			
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
    /*public function categoriesList() 
	{
		
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('flag','0');
		$this->db->order_by("category_name", "asc");
		$query = $this->db->get();
		return $query->result_array();
	}
*/}
?>