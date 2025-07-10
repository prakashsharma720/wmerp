<?php

Class Service_provider_model extends MY_Model {

// Insert registration data in database

public function service_provider_insert($data) 
{

	// Query to check whether username already exist or not
	$condition = "service_provider_name =" . "'" . $data['service_provider_name'] . "'";

	$this->db->select('*');
	$this->db->from('service_providers');
	$this->db->where($condition);
	$this->db->limit(1);
	$query = $this->db->get();
	//print_r($data);exit;
	if ($query->num_rows() == 0) {
	// Query to insert data in database
	$this->db->insert('service_providers', $data);
	if ($this->db->affected_rows() > 0) {
	return true;
	}
	} else { 
	return false;
	}
}
function getServiceProviderCode(){
    $count=0;
    $this->db->select_max('service_provider_code');
    $this->db->from('service_providers');
    $query=$this->db->get()->row_array();
    //print_r($query['vendor_code']);exit;
    $count=$query['service_provider_code']+1;
    return $count;
   
	}

	function editService_provider($data, $old_id){
			$this->db->select('*');
			$this->db->from('service_providers');
			$this->db->where('id', $old_id);
			if($this->db->update('service_providers', $data)){
				return true;
			}
		}

		public function service_provider_list() 
		{
			
			$this->db->select('service_providers.*,categories.category_name as category,states.state_name as state');
			$this->db->from('service_providers');
			$this->db->join('categories', 'service_providers.categories_id = categories.id','left'); 
			$this->db->join('states', 'service_providers.state_id = states.id','left'); 
			$this->db->where('service_providers.flag','0');
			$this->db->order_by("service_providers.service_provider_name", "asc");
			$query =  $this->db->get()->result_array();
	
			return $query;

		}
		
		public function sp_list_by_filter($conditions) 
		{
			//print_r($conditions);echo"<pre>";

			//$conditions['category_of_approval'];
			//$filter_by = "suppliers.id =" . "'" . $conditions['supplier_id'] . "'";
			$this->db->select('service_providers.*,categories.category_name as category');
			$this->db->from('service_providers');
			$this->db->join('categories', 'service_providers.categories_id = categories.id','left'); 
			//$this->db->join('countries', 'suppliers.country_id = countries.id','left'); 
			//$this->db->join('states', 'suppliers.state_id = states.id','left'); 
			//$this->db->join('cities', 'suppliers.city_id = cities.id','left'); 
			//$this->db->where($condition			
			//$this->db->where(['suppliers.id'=>@$conditions['supplier_id'],'suppliers.categories_id'=>@$conditions['categories_id'],'suppliers.category_of_approval'=>@$conditions['category_of_approval']]);
			if($conditions['service_provider_id'] !="0")
		       $this->db->like('service_providers.id',$conditions['service_provider_id'],'both');

		    if($conditions['categories_id'] !="0")
		       $this->db->like('service_providers.categories_id',$conditions['categories_id'],'both');
		    if($conditions['category_of_approval'] !="No")
		       $this->db->like('service_providers.category_of_approval', $conditions['category_of_approval'], 'both');
		   if($conditions['from_date']!='1970-01-01')
                $this->db->where('suppliers.reg_date >=',$conditions['from_date']); 
             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('service_providers.reg_date <=',$conditions['upto_date']); 
			$this->db->where('service_providers.flag','0');
			$this->db->order_by("service_providers.service_provider_name", "asc");
			$query =  $this->db->get()->result_array();
			//print_r($this->db->last_query());exit;  
			//print_r($query);exit;
			return $query;

		}
		
		function deleteService_provider($id)
		{
			//if($this->db->delete('suppliers', "id = ".$id)) return true;
			$data=array('flag'=>'1');
			$this->db->set('flag','flag',false);
			$this->db->where('id',$id);

			if($this->db->update('service_providers', $data)){
				return true;
			}
		}
		public function CheckServiceProviderCode($code)
		{
		    $this->db->select('service_provider_code');
		    $this->db->from('Service_providers');
		    $this->db->where(['service_provider_code'=>$code]);
		    $query=$this->db->get()->num_rows();    
		    return $query;
		   
		}
	public function export_csv()
		{
			$this->db->select('service_providers.*,categories.category_name as category,countries.name as country,states.state_name as state,cities.city as city');
			$this->db->from('service_providers');
			$this->db->join('categories', 'service_providers.categories_id = categories.id','left'); 
			$this->db->join('countries', 'service_providers.country_id = countries.id','left'); 
			$this->db->join('states', 'service_providers.state_id = states.id','left'); 
			$this->db->join('cities', 'service_providers.city_id = cities.id','left'); 
			//$this->db->where($condition);
			$this->db->where('service_providers.flag','0');
			$this->db->order_by("service_providers.service_provider_name", "asc");

			$query =  $this->db->get()->result_array();

			return $query;
		}
		public function TotalService_providers()
		{
			$this->db->select('*');
			$this->db->from('service_providers');
			$this->db->where('flag','0');
			$query = $this->db->get();
			return $query->num_rows();
		}
		
		
		function getCategories() { 
			$result = $this->db->select('id, category_name')->from('categories')->where(['flag'=>'0','category_type'=>'Service Provider'])->get()->result_array();         
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
 /*    function getStates() { 
    	//$result = $this->db->select('id, state_name')->from('states')->where('flag','0')->get()->result_array(); 
        $result = $this->db->select('id, state_name')->get('states')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $states = array(); 
        $states[''] = 'Select State...'; 
        foreach($result as $r) { 
            $states[$r['state_name']] = $r['state_name']; 
        } 
        
        return $states; 
    }  */
	 function getCountries() { 
    	//$result = $this->db->select('id, state_name')->from('states')->where('flag','0')->get()->result_array(); 
        $result = $this->db->select('id, name')->get('countries')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $states = array(); 
        $states[''] = 'Select Country...'; 
        foreach($result as $r) { 
            $states[$r['id']] = $r['name']; 
        } 
        return $states; 
    } 
        function getStates() { 
    	//$result = $this->db->select('id, state_name')->from('states')->where('flag','0')->get()->result_array(); 
        $result = $this->db->select('id, state_name')->get('states')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $states = array(); 
        $states[''] = 'Select State...'; 
        foreach($result as $r) { 
            $states[$r['id']] = $r['state_name']; 
        } 
        return $states; 
    } 
      function getCities() { 
    	//$result = $this->db->select('id, state_name')->from('states')->where('flag','0')->get()->result_array(); 
        $result = $this->db->select('id, city')->get('cities')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $states = array(); 
        $states[''] = 'Select City...'; 
        foreach($result as $r) { 
            $states[$r['id']] = $r['city']; 
        } 
        return $states; 
    } 

  	/*public function fetchcatName($id) {
      $this->db->select('category_name');
      	$this->db->from('categories');
		$this->db->where('id', $id);
		$q = $this->db->get();
		$data = $q->result_array();
		//print_r($data);exit;
		return $data[0]['category_name'];
        
    }*/
   
	public function get_categories(){

        $this->db->select('*');
        $this->db->from('menus');
        $this->db->where('parent_id', 0);
        //Add here role condition
        $parent = $this->db->get();

        $categories = $parent->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->sub_categories($p_cat->id);
            $i++;
        }
        return $categories;
    }
    public function sub_categories($id){

        $this->db->select('*');
        $this->db->from('menus');
        $this->db->where('parent_id', $id);
         //add here role condition
        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->sub_categories($p_cat->id);
            $i++;
        }
        return $categories;       
    }

    function getSProviderByCategory($id) { 
       $result = $this->db->select('id, service_provider_name')->from('service_providers')->where(['flag'=>'0','categories_id'=>$id])->get()->result_array(); 
        
        return $result; 
    }
	
     function getSProviderById($id) { 
       $result = $this->db->select('contact_person,address,mobile_no,service_provider_type')->from('service_providers')->where(['flag'=>'0','id'=>$id])->get()->row_array(); 
        
        return $result; 
    }
    function getAllSProviders() { 
       $result = $this->db->select('id, service_provider_name')->from('service_providers')->where(['flag'=>'0'])->get()->result_array(); 
        return $result; 
    }
	function getAllSPs() { 
       $result = $this->db->select('id, service_provider_name')->from('service_providers')->where(['flag'=>'0'])->get()->result_array(); 
       return $result; 
    }
      public function getById($id){
        $this->db->select('service_providers.*,city1.city as city,state1.state_name as state,county1.name as country,cate.category_name as category');
        $this->db->from('service_providers');
        $this->db->join('categories as cate', 'service_providers.categories_id = cate.id','left'); 
        $this->db->join('countries as county1', 'service_providers.country_id = county1.id','left'); 
        $this->db->join('states as state1', 'service_providers.state_id = state1.id','left'); 
        $this->db->join('cities as city1', 'service_providers.city_id = city1.id','left'); 
        $this->db->where(['service_providers.flag'=>'0','service_providers.id'=>$id]);
        //$this->db->order_by('service_providers.id','ASC');
        $query =  $this->db->get()->row_array();
        //print_r($query);exit;
        return $query;
    }

}

?>