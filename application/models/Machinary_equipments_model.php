<?php

Class Machinary_equipments_model extends MY_Model {
    private $table = 'machinary_equipments';
    // private $detailTable = 'daily_stack_record_details';

 public function __construct() {
        parent::__construct();
       
    }
// Insert registration data in database
 function pme_insert($data) {

    // Query to check whether username already exist or not
    $condition = "pme_code =" . "'" . $data['pme_code'] . "'";

    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();
    // echo '<pre>';print_r($data);exit;
    if ($query->num_rows() == 0)
    {
        // Query to insert data in database
        if ($this->input->post('pme_id_old')):

            $id = $this->input->post('pme_id_old');
            $this->db->where('id', $id);
            $this->db->update($this->table,$data);

        else:

            if ($this->input->post('equipment_name')):

                // echo '';print_r();exit;

                foreach ($this->input->post('equipment_name') as $key => $value) :

                    $this->db->set('transaction_date', $this->input->post('transaction_date'));
                    $this->db->set('pme_code',$this->input->post('pme_code'));
                    $this->db->set('created_by', $data['created_by']);

                    $this->db->set('department_id',$this->input->post('department_id'));
                    $this->db->set('equipment_name', $value);
                    $this->db->set('equipment_id', $this->input->post('equipment_id')[$key]);
                    $this->db->set('model_type', $this->input->post('model_type')[$key]);
                    $this->db->set('sr_no', $this->input->post('sr_no')[$key]);
                    $this->db->set('make', $this->input->post('equipment_make')[$key]);
                    $this->db->set('year_of_install', $this->input->post('year_of_install')[$key]);
                    
                    $this->db->insert($this->table);

                endforeach;
            endif;

            // $this->db->insert($this->table, $data);
            $id = $this->db->insert_id();

            // echo $id;exit;
        endif;

        // $this->DailyStackingDetails($id);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else { 
            return false;
        }
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

 function editGSR($data,$old_id){
    $this->db->where('id', $old_id);
    $this->db->update($this->table, $data);
    // $this->DailyStitchingDetails($old_id);
    if ($this->db->affected_rows() > 0)
    {
        return true;
    }
    else
    { 
        return false;
    }

} 

// Read data from database to show data in admin page
 
    function getList($conditions=NULL){
        $this->db->select('machinary_equipments.*,emp1.name as employee,departments.department_name as department, packing_materials.name as equip_name');
        $this->db->from('machinary_equipments');
        $this->db->join('employees as emp1', 'machinary_equipments.created_by = emp1.id','left'); 
        $this->db->join('departments', 'machinary_equipments.department_id = departments.id','left');
        $this->db->join('packing_materials','machinary_equipments.equipment_name = packing_materials.id','left');
        $this->db->order_by('machinary_equipments.id','ASC');
        if(!empty($conditions)){
            
            if($conditions['area'] !="0")
               $this->db->like('machinary_equipments.department_id',$conditions['area']);
           
            if($conditions['from_date']!='1970-01-01')
                $this->db->where('machinary_equipments.transaction_date >=',$conditions['from_date']); 

             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('machinary_equipments.transaction_date <=',$conditions['upto_date']); 
        }
        $query =  $this->db->get()->result_array();

        // echo 'here in machinary model<pre>'; print_r($query);exit;
        
        return $query;
    }

    function deleteGSR($id){
        $this->db->where('id',$id);
        if($this->db->delete('machinary_equipments'))
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
        $this->db->select('machinary_equipments.*,departments.department_name as dept,employees.name as ename');
        $this->db->from('machinary_equipments');
	    /*$this->db->join('finish_goods', 'production_registers.finish_good_id = finish_goods.id','left'); */
	    $this->db->join('departments', 'machinary_equipments.department_id = departments.id','left'); 
	    $this->db->join('employees', 'machinary_equipments.created_by = employees.id','left'); 
        $this->db->where('machinary_equipments.id',$id);
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