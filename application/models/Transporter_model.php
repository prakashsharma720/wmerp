<?php

Class Transporter_Model extends MY_Model {

// Insert registration data in database
public function transporter_insert($data) 
{

	// Query to check whether username already exist or not
	$condition = "transporter_name =" . "'" . $data['transporter_name'] . "'";

	$this->db->select('*');
	$this->db->from('transporters');
	$this->db->where($condition);
	$this->db->limit(1);
	$query = $this->db->get();
	//print_r($data);exit;
	if ($query->num_rows() == 0) {
	// Query to insert data in database
	$this->db->insert('transporters', $data);
	if ($this->db->affected_rows() > 0) {
	return true;
	}
	} else { 
	return false;
	}
}
	function edittransporter($data, $old_id){
			$this->db->select('*');
			$this->db->from('transporters');
			$this->db->where('id', $old_id);
			if($this->db->update('transporters', $data)){
				return true;
			}
		}
		public function transporter_list() 
		{
			
			$this->db->select('*');
			$this->db->from('transporters');
			//$this->db->join('categories', 'transporters.categories_id = categories.id'); 
			$this->db->where('flag','0');
			$this->db->order_by("transporter_name", "asc");
			$query =  $this->db->get()->result_array();
	
			return $query;

		}
		public function transporter_list_by_filter($conditions) 
		{
			$this->db->select('transporters.*');
			$this->db->from('transporters');
		//	$this->db->join('categories', 'transporters.categories_id = categories.id','left'); 
			//$this->db->join('countries', 'customers.country_id = countries.id','left'); 
		//	$this->db->join('states', 'customers.state_id = states.id','left'); 
			//$this->db->join('cities', 'customers.city_id = cities.id','left'); 
			//$this->db->where($condition			
			//$this->db->where(['customers.id'=>@$conditions['customer_id'],'customers.categories_id'=>@$conditions['categories_id'],'customers.category_of_approval'=>@$conditions['category_of_approval']]);
			if($conditions['transporter_id'] !="0")
		       $this->db->like('transporters.id',$conditions['transporter_id'],'both');

		    //if($conditions['categories_id'] !="0")
		      // $this->db->like('transporters.categories_id',$conditions['categories_id'],'both');
		    if($conditions['category_of_approval'] !="No")
		       $this->db->like('transporters.category_of_approval', $conditions['category_of_approval'], 'both');
		    if($conditions['from_date']!='1970-01-01')
                $this->db->where('transporters.reg_date >=',$conditions['from_date']); 
             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('transporters.reg_date <=',$conditions['upto_date']); 

			$this->db->where('transporters.flag','0');
			      //  $this->db->where(['customers.flag'=>'0','customers.id<>'=>' ']);
			$this->db->order_by("transporters.transporter_name", "asc");
			//print_r($this->db->last_query());  exit;
			$query =  $this->db->get()->result_array();
			//print_r($this->db->last_query());exit;  
			//print_r($query);exit;
			return $query;


		}
	function getTransporterCode(){
    $count=0;
    $this->db->select_max('vendor_code');
    $this->db->from('transporters');
    $query=$this->db->get()->row_array();
    //print_r($query['vendor_code']);exit;
    $count=$query['vendor_code']+1;
    return $count;
   
	}
		
		function deletetransporter($id)
		{
			//if($this->db->delete('transporters', "id = ".$id)) return true;
			$data=array('flag'=>'1');
			$this->db->set('flag','flag',false);
			$this->db->where('id',$id);

			if($this->db->update('transporters', $data)){
				return true;
			}
		}
		
		
		function getCategories() { 
		$result = $this->db->select('id, category_name')->from('categories')->where(['flag'=>'0','category_type'=>'Transporter'])->get()->result_array(); 
        //$result = $this->db->select('id, category_name')->get('categories')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        /*$productname = array(); 
       // $productname[''] = 'Select Category...'; 
        foreach($result as $r) { 
            $productname[$r['id']] = $r['category_name']; 
        } */
        
        return $result; 
    } 
	function getCategoriesEditPage() { 
       $result = $this->db->select('id, category_name')->from('categories')->where('flag','0')->get()->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $productname = array(); 
       // $productname[''] = 'Select Category...'; 
        foreach($result as $r) { 
            $productname[$r['category_name']] = $r['category_name']; 
        } 
        
        return $productname; 
    }
	 function getStates() { 
    	//$result = $this->db->select('id, state_name')->from('states')->where('flag','0')->get()->result_array(); 
        $result = $this->db->select('id, state_name')->get('states')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $states = array(); 
        $states['All'] = 'All India'; 
        foreach($result as $r) { 
            $states[$r['state_name']] = $r['state_name']; 
        } 
        
        return $states; 
    } 

public function export_csv()
		{
			$this->db->select('*');
			$this->db->from('transporters');
			//$this->db->join('categories', 'transporters.categories_id = categories.id'); 
			$this->db->where('flag','0');
			$this->db->order_by("transporter_name", "asc");
			$query =  $this->db->get()->result_array();
	
			return $query;
		}

 public function getTransporterByCategory($id) { 
       $result = $this->db->select('id, transporter_name')->from('transporters')->where(['flag'=>'0','categories_id'=>$id])->get()->result_array(); 
        
        return $result; 
    }
	function getAllTransporters() { 
       $result = $this->db->select('id, transporter_name')->from('transporters')->where(['flag'=>'0'])->get()->result_array(); 
        return $result; 
    }

     
		public function CheckTranspoterCode($code)
		{
		    $this->db->select('vendor_code');
		    $this->db->from('transporters');
		    $this->db->where(['vendor_code'=>$code]);
		    $query=$this->db->get()->num_rows();    
		    return $query;
		   
		}
		 
     function getTransporterById($id) { 
       $result = $this->db->select('contact_person,address,mobile_no,transporter_type')->from('transporters')->where(['flag'=>'0','id'=>$id])->get()->row_array(); 
        return $result; 
    }
	function getIDById($id) { 
		$result = $this->db->select('gst_no')->from('transporters')->where(['flag'=>'0','id'=>$id])->get()->row_array(); 
		 
		 return $result; 
	 }
	
     public function getById($id){
        $this->db->select('transporters.*');
        $this->db->from('transporters');
       // $this->db->join('categories as cate', 'suppliers.categories_id = cate.id','left'); 
        //$this->db->join('countries as county1', 'suppliers.country_id = county1.id','left'); 
       // $this->db->join('states as state1', 'suppliers.state_id = state1.id','left'); 
       // $this->db->join('cities as city1', 'suppliers.city_id = city1.id','left'); 
        $this->db->where(['transporters.flag'=>'0','transporters.id'=>$id]);
        //$this->db->order_by('suppliers.id','ASC');
        $query =  $this->db->get()->row_array();
        //print_r($query);exit;
        return $query;
    }


}

?>