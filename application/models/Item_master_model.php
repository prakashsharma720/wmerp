<?php

Class Item_Master_Model extends MY_Model {

	// Insert registration data in database
	public function item_insert($data) 
	{

		// Query to check whether username already exist or not
		$condition = "item_name =" . "'" . $data['item_name'] . "'";

		$this->db->select('*');
		$this->db->from('item_masters');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		//print_r($data);exit;
		if ($query->num_rows() == 0) {
		// Query to insert data in database
		$this->db->insert('item_masters', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		} else { 
		return false;
		}
	}
	public function item_update($data,$item_id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $item_id);
		$this->db->update('item_masters', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
		return false;
		}
	}
	public function itemsList() 
	{
		
		$this->db->select('item_masters.*');
		$this->db->from('item_masters');
		//$this->db->join('categories','item_masters.category_id=categories.id');
		//$this->db->join('grades','item_masters.grade_id=grades.id');
		$this->db->where('flag','0');
		$this->db->order_by("item_name", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}
	public function getById($id) {
       	$this->db->select('*');
		$this->db->from('item_masters');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function getCategories() { 
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
    }

     function getGrades() { 
		$result = $this->db->select('id, grade')->from('grades')->where('flag','0')->get()->result_array(); 
        //$result = $this->db->select('id, category_name')->get('categories')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $productname = array(); 
        $productname[''] = 'Select Grade...'; 
        foreach($result as $r) { 
            $productname[$r['id']] = $r['grade']; 
        } 
        
        return $productname; 
    } 

 	 function deleteItem($id)
		{
			//if($this->db->delete('suppliers', "id = ".$id)) return true;
			$data=array('flag'=>'1');
			$this->db->set('flag','flag',false);
			$this->db->where('id',$id);
			if($this->db->update('item_masters', $data)){
				return true;
			}else{
				return false;
			}
		}
	public function getProductsByCategory($id) { 
       $result = $this->db->select('id, name')->from('packing_materials')->where(['flag'=>'0','categories_id'=>$id])->get()->result_array(); 
        
        return $result; 
    }


}
?>