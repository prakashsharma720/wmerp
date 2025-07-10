<?php

Class Rm_Model extends MY_Model {

// Insert registration data in database
public function rm_insert($data) {

// Query to check whether username already exist or not
$condition = "rm_code =" . "'" . $data['rm_code'] . "'";

$this->db->select('*');
$this->db->from('rm_codes');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();
//print_r($data);exit;
if ($query->num_rows() == 0) {
// Query to insert data in database
$this->db->insert('rm_codes', $data);
if ($this->db->affected_rows() > 0) {
return true;
}
} else { 
return false;
}
}
/******************* edit rmcode ********************/

public function editRMcode($data,$old_id){
    $this->db->where('id', $old_id);
    $this->db->update('rm_codes', $data);
    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }

}

// Read data from database to show data in admin page

   public function getList(){
        $this->db->select('rm_codes.*,suppliers.supplier_name as supplier,categories.category_name as category');
        $this->db->from('rm_codes');
        $this->db->join('suppliers', 'rm_codes.supplier_id = suppliers.id', 'left'); 
        $this->db->join('categories', 'rm_codes.categories_id = categories.id', 'left'); 
        $this->db->where('rm_codes.flag','0');
        //$this->db->order_by("rm_codes.grade", "asc");
        $query = $this->db->get();
        //echo var_dump($query->result_array()); //troubleshooting somehting.
        return $query->result_array();

    }

    function deleteRMcode($id){
        $data=array('flag'=>'1');
        $this->db->set('flag','flag',false);
        $this->db->where('id',$id);
        if($this->db->update('rm_codes', $data)){
            return true;
        }
    }

	function getSuppliers($categories_id)
    { 
        //$result = $this->db->select('id, supplier_name,vendor_code')->get('suppliers')->result_array(); 
	$result = $this->db->select('id, supplier_name')->from('suppliers')->where(['flag'=>'0','categories_id'=>$categories_id])->get()->result_array(); 
        //print_r($result);exit;
        //order_by('category_name', 'asc');
        /*$suppliername = array(); 
        $suppliername[''] = 'Select Supplier...'; 
        foreach($result as $r) { 
            $suppliername[$r['id']] = $r['supplier_name'].'('.$r['vendor_code'].')'; 
        } */
        return $result; 
    }
    function getCategories() { 
       $result = $this->db->select('id, name,code')->from('packing_materials')->where(['flag'=>'0','categories_id'=>'1'])->get()->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $productname = array(); 
       // $productname[''] = 'Select Category...'; 
        foreach($result as $r) { 
            $productname[$r['name']] = $r['name'].' ('.$r['code'].')'; 
        } 
        
        return $productname; 
    }
    function getSupplierCategories() { 
       $result = $this->db->select('id, category_name')->from('categories')->where(['flag'=>'0','category_type'=>'Supplier'])->get()->result_array(); 
        
        return $result; 
    }
    function getGrids() { 
       $result = $this->db->select('id, grid_name')->from('grid')->where(['flag'=>'0'])->get()->result_array(); 
        $grids = array(); 
        foreach($result as $r) { 
            $grids[$r['grid_name']] = $r['grid_name']; 
        } 
        
        return $grids; 
    }
	 function getTransporterCategories() { 
       $result = $this->db->select('id, category_name')->from('categories')->where(['flag'=>'0','category_type'=>'Transporter'])->get()->result_array(); 
        
        return $result; 
    }

     function getSProviderCategories() { 
       $result = $this->db->select('id, category_name')->from('categories')->where(['flag'=>'0','category_type'=>'Service Provider'])->get()->result_array(); 
        
        return $result; 
    }


    public function getById($id) {
        $this->db->select('*');
        $this->db->from('rm_codes');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }  

	}

?>