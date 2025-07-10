<?php

Class Production_logsheet_model extends MY_Model {
    private $table = 'production_logsheets';
    private $detailTable = 'production_logsheet_details';
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
        $this->db->where('production_logsheet_id', $id);
        $this->db->delete($this->detailTable);
             if ($this->input->post('finish_good_id')):
                foreach ($this->input->post('finish_good_id') as $key => $value) :
                    $this->db->set('production_logsheet_id', $id);
                    $this->db->set('finish_good_id', $value);
                    $this->db->set('machine_start_date', date('Y-m-d',strtotime($this->input->post('date1')[$key])));
                   // $time1=$this->input->post('hrs1')[$key].'.'.$this->input->post('min1')[$key]
                    $this->db->set('hrs1', $this->input->post('hrs1')[$key]);
                    $this->db->set('min1', $this->input->post('min1')[$key]);
                      $this->db->set('machine_stop_date', date('Y-m-d',strtotime($this->input->post('date2')[$key])));
                    $this->db->set('hrs2', $this->input->post('hrs2')[$key]);
                    $this->db->set('min2', $this->input->post('min2')[$key]);
                   /* $this->db->set('machin_stop_time', date('h:i a',strtotime($this->input->post('time2')[$key])));*/
                    $this->db->set('machine_total_time', $this->input->post('machine_total_time')[$key]);
                    $this->db->set('machine_down_time', $this->input->post('machine_down_time')[$key]);
                    $this->db->set('down_reason', $this->input->post('down_reason')[$key]);
                    $this->db->set('machine_actual_time', $this->input->post('machine_actual_time')[$key]);
                    
                    $this->db->set('lot_no', $this->input->post('lot_no')[$key]);
                    $this->db->set('batch_no', $this->input->post('batch_no')[$key]);
                    $this->db->set('packing_size', $this->input->post('packing_size')[$key]);
                    $this->db->set('no_of_bags', $this->input->post('no_of_bags')[$key]);
                    $this->db->set('production_in_mt', $this->input->post('production_in_mt')[$key]);
                    $this->db->set('per_hour_production', $this->input->post('per_hour_production')[$key]);
                    $this->db->set('tailing_qty', $this->input->post('tailing_qty')[$key]);
                    $this->db->set('tailing_per', $this->input->post('tailing_per')[$key]);
                    $this->db->set('tailing_qty', $this->input->post('tailing_qty')[$key]);
                    $this->db->set('kwh_opening', $this->input->post('kwh_opening')[$key]);
                    $this->db->set('kwh_closing', $this->input->post('kwh_closing')[$key]);
                    $this->db->set('kwh_consumed', $this->input->post('kwh_consumed')[$key]);
                    $this->db->set('unit_per_mt', $this->input->post('unit_per_mt')[$key]);
                    $this->db->set('mill_rpm', $this->input->post('mill_rpm')[$key]);
                    $this->db->set('mill_amp', $this->input->post('mill_amp')[$key]);
                    $this->db->set('blower_in_hrz', $this->input->post('blower_in_hrz')[$key]);
                    $this->db->set('blower_amp', $this->input->post('blower_amp')[$key]);
                    $this->db->set('screw_rpw', $this->input->post('screw_rpw')[$key]);
                    $this->db->set('air_washer_rpm', $this->input->post('air_washer_rpm')[$key]);
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

 function editGSR($data,$old_id){
    $this->db->where('id', $old_id);
    $this->db->update('production_logsheets', $data);
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
        $this->db->select('production_logsheets.*,emp1.name as employee,departments.department_name as department');
        $this->db->from('production_logsheets');
        $this->db->join('employees as emp1', 'production_logsheets.created_by = emp1.id','left'); 
        $this->db->join('departments ', 'production_logsheets.department_id = departments.id','left');
       // $this->db->where(['production_logsheets.id'=>'16']);
        $this->db->order_by('production_logsheets.id','desc');
        $query =  $this->db->get()->result_array();
        //print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
         foreach($query as $i=>$po_data) {
            $this->db->select('production_logsheet_details.*,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name,finish_goods.fg_code as fg_code');
            $this->db->join('finish_goods', 'production_logsheet_details.finish_good_id = finish_goods.id');
            $this->db->where('production_logsheet_details.production_logsheet_id', $po_data['id']);
            $images_query = $this->db->get('production_logsheet_details')->result_array();
            $query[$i]['production_details'] = $images_query;
            
        }
        return $query;
    } 

    function filter_by_getList($conditions){
        $this->db->select('production_logsheets.*,emp1.name as employee,departments.department_name as department');
        $this->db->from('production_logsheets');
        $this->db->join('employees as emp1', 'production_logsheets.created_by = emp1.id','left'); 
        $this->db->join('departments ', 'production_logsheets.department_id = departments.id','left');
       
       // $this->db->where(['production_logsheets.flag'=>'0']);
        if(!empty($conditions['mill_no']))
               $this->db->where('production_logsheets.mill_no',$conditions['mill_no'],'both');

        if($conditions['from_date']!='1970-01-01')
            $this->db->where('production_logsheets.transaction_date >=',$conditions['from_date']); 

         if($conditions['upto_date']!='1970-01-01')
           $this->db->where('production_logsheets.transaction_date <=',$conditions['upto_date']); 

        $this->db->order_by('production_logsheets.id','ASC');
        $query =  $this->db->get()->result_array();
        // $str = $this->db->last_query();
        // echo "<pre>";
        // print_r($str);
        // exit;
        //print_r($query);exit;
         foreach($query as $i=>$po_data) {
            $this->db->select('production_logsheet_details.*,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name,finish_goods.fg_code as fg_code');
            $this->db->join('finish_goods', 'production_logsheet_details.finish_good_id = finish_goods.id');
            
            if(!empty($conditions['finish_good_id'])){
               $this->db->where('production_logsheet_details.finish_good_id',$conditions['finish_good_id']);
                $this->db->where('production_logsheet_details.production_logsheet_id', $po_data['id']);
            }else{
                 $this->db->where('production_logsheet_details.production_logsheet_id', $po_data['id']);
            }
            $images_query = $this->db->get('production_logsheet_details')->result_array();
            if(!empty($images_query)){
                $query[$i]['production_details'] = $images_query;
            }
        }
        //print_r($query);exit;
        return $query;
    } 

     

    function deleteProduction($id){
     
        $this->db->where('id',$id);
        if($this->db->delete('production_logsheets'))
        {
            $this->db->where('production_logsheet_id', $id);
            if($this->db->delete('production_logsheet_details'))
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
        $this->db->select('production_logsheets.*,departments.department_name as dept,employees.name as ename');
        $this->db->from('production_logsheets');
	    /*$this->db->join('finish_goods', 'production_registers.finish_good_id = finish_goods.id','left'); */
	    $this->db->join('departments', 'production_logsheets.department_id = departments.id','left'); 
	    $this->db->join('employees', 'production_logsheets.created_by = employees.id','left'); 
        $this->db->where('production_logsheets.id',$id);
        $query =  $this->db->get()->result_array();

        foreach($query as $i=>$po_data) {
            $this->db->select('production_logsheet_details.*,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name,finish_goods.fg_code as fg_code');
            $this->db->join('finish_goods', 'production_logsheet_details.finish_good_id = finish_goods.id');
            $this->db->where('production_logsheet_details.production_logsheet_id', $po_data['id']);
            $images_query = $this->db->get('production_logsheet_details')->result_array();
            $query[$i]['production_details'] = $images_query;
        }

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