<?php

Class Raw_material_Model extends MY_Model {

	// Insert registration data in database
	public function rm_insert($data) 
	{

		// Query to check whether username already exist or not
		$condition = "rm_name =" . "'" . $data['rm_name'] . "'";

		$this->db->select('*');
		$this->db->from('raw_material');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		//print_r($data);exit;
		if ($query->num_rows() == 0) {
		// Query to insert data in database
		$this->db->insert('raw_material', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		} else { 
		return false;
		}
	}
	public function rm_update($data,$rm_id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $rm_id);
		$this->db->update('raw_material', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
		return false;
		}
	}
	public function rmsList() 
	{
		
		$this->db->select('raw_material.*');
		$this->db->from('raw_material');
		//$this->db->join('categories','raw_material.category_id=categories.id');
		$this->db->where('raw_material.flag','0');
		$this->db->order_by("raw_material.rm_name", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}
	public function getById($id) {
       	$this->db->select('*');
		$this->db->from('raw_material');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

   /*  function getCategories() { 
		$result = $this->db->select('id, category_name')->from('categories')->where('flag','0')->get()->result_array(); 
        //$result = $this->db->select('id, category_name')->get('categories')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $productname = array(); 
        $productname[''] = 'Select Category...'; 
        foreach($result as $r) { 
            $productname[$r['id']] = $r['category_name']; 
        } 
        
        return $productname; 
    } */

     /* function getGrades() { 
		$result = $this->db->select('id, grade')->from('grades')->where('flag','0')->get()->result_array(); 
        //$result = $this->db->select('id, category_name')->get('categories')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $productname = array(); 
        $productname[''] = 'Select Grade...'; 
        foreach($result as $r) { 
            $productname[$r['grade']] = $r['grade']; 
        } 
        
        return $productname; 
    }  */

 	 function deleterm($id)
		{
			//if($this->db->delete('suppliers', "id = ".$id)) return true;
			$data=array('flag'=>'1');
			$this->db->set('flag','flag',false);
			$this->db->where('id',$id);
			if($this->db->update('raw_material', $data)){
				return true;
			}else{
				return false;
			}
		}


}
?>