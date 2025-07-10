<?php

Class Notifications_Model extends MY_Model {
 private $table = 'notifications';
// Insert registration data in database
  public function __construct() {
        parent::__construct();
        
       // $this->language_id = 1;
    }

 function add_notification($data1){
    $this->db->insert('notifications', $data1);
    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }

} 
/******************* edit notification ********************/

    public function clear_notification($data,$old_id){
    $this->db->where('id', $old_id);
    $this->db->update('notifications', $data);
    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }

}
// Total Count notifications //

 function totalCount(){
    $count=0;
    $query = $this->db->query("SELECT id FROM notifications");
    $count=$query->num_rows();
    //print_r($count);exit;
    return $count;
   
}



// Read data from database to show data  for Super admin 

   public function allnotification(){
        $this->db->select('notifications.*,emp1.name as creator,emp1.photo as creator_photo,emp2.name as employee,emp2.photo as employee_photo');
        $this->db->from('notifications');
        $this->db->join('employees as emp1', 'notifications.created_by = emp1.id', 'left'); 
        $this->db->join('employees as emp2', 'notifications.employee_id = emp2.id', 'left'); 
        $this->db->where('notifications.status',0);

        // $this->db->limit('7');
        $this->db->order_by("notifications.id", "desc");
        $query = $this->db->get();
        //echo var_dump($query->result_array()); //troubleshooting somehting.
        return $query->result_array();

    }
// Read data from database to show data  Employee Wise
    public function allnotification_emp($login_id){
        $this->db->select('notifications.*,emp1.name as creator,emp1.photo as creator_photo,emp2.name as employee,emp2.photo as employee_photo');
        $this->db->from('notifications');
         $this->db->join('employees as emp1', 'notifications.created_by = emp1.id', 'left'); 
        $this->db->join('employees as emp2', 'notifications.employee_id = emp2.id', 'left');
        $this->db->where(['notifications.employee_id'=> $login_id,'notifications.status'=>0]);
        $this->db->or_where('notifications.created_by', $login_id);
        $this->db->order_by("notifications.id", "desc");
        $query = $this->db->get();
        //echo var_dump($query->result_array()); //troubleshooting somehting.
        return $query->result_array();

    }

    function delete_notification($id)
        {
            $data=array('status'=>'1');
            $this->db->where('id',$id);
            if($this->db->update('notifications', $data)){
                return true;
            }
        }
        public function allreminder(){
            $this->db->select('lead_reminder.*,emp1.name as creator');
            $this->db->from('lead_reminder');
            $this->db->join('employees as emp1', 'lead_reminder.employee_id = emp1.id', 'left'); 
            // $this->db->join('employees as emp2', 'notifications.employee_id = emp2.id', 'left'); 
            // $this->db->where('notifications.status',0);
    
            // $this->db->limit('7');
            $this->db->order_by("lead_reminder.id", "desc");
            $query = $this->db->get();
            //echo var_dump($query->result_array()); //troubleshooting somehting.
            return $query->result_array();
    
        }
        public function allreminder_emp($login_id){
            $this->db->select('lead_reminder.*,emp1.name as creator,emp1.photo as creator_photo,emp2.name as employee,emp2.photo as employee_photo');
            $this->db->from('lead_reminder');
             $this->db->join('employees as emp1', 'lead_reminder.employee_id = emp1.id', 'left'); 
            
            $this->db->where(['lead_reminder.employee_id'=> $login_id]);
           
            $this->db->order_by("lead_reminder.id", "desc");
            $query = $this->db->get();
            //echo var_dump($query->result_array()); //troubleshooting somehting.
            return $query->result_array();
    
        }


        function delete_reminder($id)
        {
           if($this->db->delete('lead_reminder', "id = ".$id)) return true;
            
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
        $this->db->from('notifications');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }  

	}

?>