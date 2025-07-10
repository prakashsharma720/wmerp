<?php

Class Maintenance_history_model extends MY_Model {
    private $table = 'maintenance_history';
    // private $detailTable = 'daily_stack_record_details';

 public function __construct() {
        parent::__construct();
      
    }
// Insert registration data in database
 function pme_insert($data) {

    // Query to check whether username already exist or not
    
    
            $this->db->insert($this->table, $data);
           
            // echo $id;exit;
        
        // $this->DailyStackingDetails($id);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else { 
            return false;
        }
    }


/******************* Row Count for Voucher Number ********************/

 
    function getGSRCode(){
        $count=0;
        $this->db->select_max('pme_code');
        $this->db->from($this->table);
        //$this->db->where('flag','0');
        $query=$this->db->get()->row_array();
        //print_r($query['employee_code']);exit;
        $count=$query['pme_code']+1;
        return $count;
    }

/******************* edit rs ********************/

 function editGSR($data,$id){
    // $this->db->where('id',$id);
	// $this->db->update('login_table',$data);
    // // $this->DailyStitchingDetails($old_id);
    // if ($this->db->affected_rows() > 0)
    // {
    //     return true;
    // }
    // else
    // { 
    //     return false;
	// }
	
	return $data;

} 

// Read data from database to show data in admin page
 
    function getList(){
        $this->db->select('maintenance_history.*,emp1.name as employee,departments.department_name as department, packing_materials.name as equip_name');
        $this->db->from('maintenance_history');
        $this->db->join('employees as emp1', 'maintenance_history.created_by = emp1.id','left'); 
        $this->db->join('departments', 'maintenance_history.department_id = departments.id','left');
        $this->db->join('packing_materials','maintenance_history.equipment_name = packing_materials.id','left');
        $this->db->order_by('maintenance_history.id','ASC');
        $query =  $this->db->get()->result_array();

        // echo 'here in machinary model<pre>'; print_r($query);exit;
        
        return $query;
    }

    function deleteGSR($id){
        $this->db->where('id',$id);
        if($this->db->delete('maintenance_history'))
        {
            return true;                
        }
    }

    function getCategories() { 
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

    public function getById($id){
        $this->db->select('maintenance_history.*,departments.department_name as dept,employees.name as ename');
        $this->db->from('maintenance_history');
	    /*$this->db->join('finish_goods', 'production_registers.finish_good_id = finish_goods.id','left'); */
	    $this->db->join('departments', 'maintenance_history.department_id = departments.id','left'); 
	    $this->db->join('employees', 'maintenance_history.created_by = employees.id','left'); 
        $this->db->where('maintenance_history.id',$id);
        $query =  $this->db->get()->result_array();
       // foreach($query as $i=>$po_data) {
       //      $this->db->select('daily_stack_record_details.*,workers.name as worker_name,workers.worker_code as worker_code,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name');
       //      $this->db->join('finish_goods', 'daily_stack_record_details.finish_good_id = finish_goods.id'); 
       //      $this->db->join('workers', 'daily_stack_record_details.worker_id = workers.id'); 
       //      $this->db->where('daily_stack_record_details.daily_stack_record_id', $po_data['id']);
       //      $images_query = $this->db->get('daily_stack_record_details')->result_array();
       //      $query[$i]['dsr_details'] = $images_query;
       //  }
        // echo "here<pre>";
       // print_r($query);exit;
        return $query;
    }

    public function getFGmineralsList() { 
       $result = $this->db->select('id, mineral_name,grade_name,fg_code,packing_type,hsn_code')->from('finish_goods')->where(['flag'=>'0'])->get()->result_array(); 
        return $result;
    }
    public function getFGgradesList() { 
       $result = $this->db->select('id, grade_name')->from('finish_goods')->where(['flag'=>'0'])->group_by('grade_name')->get()->result_array(); 
        
        return $result; 
    }
     function getDepartments() { 
        $result = $this->db->select('id, department_name,department_code')->from('departments')->where('flag','0')->get()->result_array(); 
              return $result; 
    } 
    function getWorkers() { 
        $result = $this->db->select('id, name,worker_code')->from('workers')->where('flag','0')->get()->result_array(); 
        return $result; 
    }        
}
?>
