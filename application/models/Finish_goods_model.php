<?php

Class Finish_goods_Model extends MY_Model {

	// Insert registration data in database
	public function fg_insert($data) 
	{

		// Query to check whether username already exist or not
		$condition = "fg_code =" . "'" . $data['fg_code'] . "'";

		$this->db->select('*');
		$this->db->from('finish_goods');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		//print_r($data);exit;
		if ($query->num_rows() == 0) {
		// Query to insert data in database
		$this->db->insert('finish_goods', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		} else { 
		return false;
		}
	}
	function getFGCode(){
    $count=0;
    $this->db->select_max('fg_code');
    $this->db->from('finish_goods');
    $this->db->where('flag','0');
    $query=$this->db->get()->row_array();
    //print_r($query['employee_code']);exit;
    $count=$query['fg_code']+1;
    return $count;
   
	}

	public function fg_update($data,$item_id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $item_id);
		$this->db->update('finish_goods', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
		return false;
		}
	}
	public function fgList() 
	{
		
		$this->db->select('*');
		$this->db->from('finish_goods');
		//$this->db->join('categories','finish_goods.category_id=categories.id');
		//$this->db->join('grades','finish_goods.grade_id=grades.id');
		$this->db->where('flag','0');
		$this->db->order_by("id", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}
	public function getById($id) {
       	$this->db->select('*');
		$this->db->from('finish_goods');
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

 	 function deleteFG($id)
		{
			$this->db->where('id',$id);
			if($this->db->delete('finish_goods')){
				return true;
			}else{
				return false;
			}
		}
	public function getFinishGoodsByCategory($id) { 
       $result = $this->db->select('id, item_name')->from('finish_goods')->where(['flag'=>'0','category_id'=>$id])->get()->result_array(); 
        
        return $result; 
    }
    public function getFGmineralsList($id) { 
       $result = $this->db->select('id, mineral_name')->from('finish_goods')->where(['flag'=>'0'])->get()->result_array(); 
        
        return $result; 
    }
    public function getFGgradesList($id) { 
       $result = $this->db->select('id, grade_name')->from('finish_goods')->where(['flag'=>'0'])->get()->result_array(); 
        
        return $result; 
    }
function getHSN() { 
		$result = $this->db->select('id, mineral_name,hsn_code')->from('hsn')->where('flag','0')->get()->result_array();         
        return $result; 
    } 

}
?>