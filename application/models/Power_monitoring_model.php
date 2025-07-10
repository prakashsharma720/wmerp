<?php

Class Power_monitoring_model extends MY_Model {
    private $table = 'power_monitoring_registers';
    private $detailTable = 'power_monitoring_register_details';
 public function __construct() {
        parent::__construct();
      }
// Insert registration data in database
 function pl_insert($data) {

// Query to check whether username already exist or not
$condition = "voucher_code =" . "'" . $data['voucher_code'] . "'";

$this->db->select('*');
$this->db->from($this->table);
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();
//print_r($data);exit;
if ($query->num_rows() == 0) {
// Query to insert data in database
 if ($this->input->post('pl_id_old')):
        $id = $this->input->post('pl_id_old');
        $this->db->where('id', $id);
        $this->db->update($this->table,$data);
    else:
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();
    endif;

    $this->PLDetails($id);

    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }
    }
}
/************** PO Details Insertion ******************/

  function PLDetails($id) {
        $this->db->where('power_monitoring_register_id', $id);
        $this->db->delete($this->detailTable);
             if ($this->input->post('meter_id')):
                foreach ($this->input->post('meter_id') as $key => $value) :
                    $this->db->set('power_monitoring_register_id', $id);
                    $this->db->set('meter_id', $value);
                    $this->db->set('opening_reading', $this->input->post('opening_reading')[$key]);
                    $this->db->set('closing_reading', $this->input->post('closing_reading')[$key]);
                    $this->db->set('unit_consumed', $this->input->post('unit_consumed')[$key]);
                    $this->db->set('production_in_mt', $this->input->post('production_in_mt')[$key]);
                    $this->db->set('unit_per_ton', $this->input->post('unit_per_ton')[$key]);
                    $this->db->insert($this->detailTable);
                endforeach;
            endif; 
    }


/******************* Row Count for Voucher Number ********************/

 
    function getPLCode(){
    $count=0;
    $this->db->select_max('voucher_code');
    $this->db->from($this->table);
    //$this->db->where('flag','0');
    $query=$this->db->get()->row_array();
    //print_r($query['employee_code']);exit;
    $count=$query['voucher_code']+1;
    return $count;
   
    }

/******************* edit rs ********************/

 function editPMR($data,$old_id){
    $this->db->where('id', $old_id);
    $this->db->update('power_monitoring_registers', $data);
    $this->PLDetails($old_id);
    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }

} 



// Read data from database to show data in admin page

    function getList(){
        $this->db->select('power_monitoring_registers.*,emp1.name as employee');
        $this->db->from('power_monitoring_registers');
        $this->db->join('employees as emp1', 'power_monitoring_registers.created_by = emp1.id','left'); 
       // $this->db->join('departments ', 'power_monitoring_registers.department_id = departments.id','left');
       // $this->db->where(['power_monitoring_registers.flag'=>'0']);
        $this->db->order_by('power_monitoring_registers.id','desc');
        $query =  $this->db->get()->result_array();
        //print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
         foreach($query as $i=>$po_data) {
            $this->db->select('power_monitoring_register_details.*,meters.meter_name as meter_name');
            $this->db->join('meters', 'power_monitoring_register_details.meter_id = meters.id');
            $this->db->where('power_monitoring_register_details.power_monitoring_register_id', $po_data['id']);
            $images_query = $this->db->get('power_monitoring_register_details')->result_array();
            $query[$i]['process_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    } 

    function getAllReqList($conditions= null){
        //print_r($conditions);exit;
        $this->db->select('power_monitoring_registers.*,emp1.name as employee');
        $this->db->from('power_monitoring_registers');
        $this->db->join('employees as emp1', 'power_monitoring_registers.created_by = emp1.id','left'); 
        if(!empty($conditions)){
            // if($conditions['worker_id'] !="0")
            // $this->db->like('work_allotment_registers.worker_id',$conditions['worker_id'],'both');

            // if($conditions['department_id'] !="0")
            //    $this->db->like('power_monitoring_registers.department_id',$conditions['department_id'],'both');

            // if($conditions['approved_status'] !="All")
            //    $this->db->like('work_allotment_registers.approved_status',$conditions['approved_status'],'both');

            if($conditions['from_date']!='1970-01-01')
                $this->db->where('power_monitoring_registers.transaction_date >=',$conditions['from_date']); 

             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('power_monitoring_registers.transaction_date <=',$conditions['upto_date']); 
        }
        

        $this->db->order_by('power_monitoring_registers.id','desc');

        $query =  $this->db->get()->result_array();
       // print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('power_monitoring_register_details.*,meters.meter_name as meter_name');
            $this->db->join('meters', 'power_monitoring_register_details.meter_id = meters.id');
            $this->db->where('power_monitoring_register_details.power_monitoring_register_id', $po_data['id']);
            $images_query = $this->db->get('power_monitoring_register_details')->result_array();
            $query[$i]['process_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    } 


    function deleteGSR($id){
     
        $this->db->where('id',$id);
        if($this->db->delete('power_monitoring_registers'))
        {
            $this->db->where('power_monitoring_register_id', $id);
            if($this->db->delete('power_monitoring_register_details'))
            {
                return true;
                
            }
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
        $this->db->select('power_monitoring_registers.*,employees.name as ename');
        $this->db->from('power_monitoring_registers');
	    /*$this->db->join('finish_goods', 'process_registers.finish_good_id = finish_goods.id','left'); */
	    //$this->db->join('departments', 'power_monitoring_registers.department_id = departments.id','left'); 
	    $this->db->join('employees', 'power_monitoring_registers.created_by = employees.id','left'); 
        $this->db->where('power_monitoring_registers.id',$id);
        $query =  $this->db->get()->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('power_monitoring_register_details.*,meters.meter_name as meter_name');
            $this->db->join('meters', 'power_monitoring_register_details.meter_id = meters.id');
            $this->db->where('power_monitoring_register_details.power_monitoring_register_id', $po_data['id']);
            $images_query = $this->db->get('power_monitoring_register_details')->result_array();
            $query[$i]['process_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    }

    public function getMeterList() { 
       $result = $this->db->select('id, meter_name')->from('meters')->where(['flag'=>'0'])->get()->result_array(); 
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