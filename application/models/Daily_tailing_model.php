<?php

Class Daily_tailing_model extends MY_Model {
    private $table = 'daily_tailing_records';
    private $detailTable = 'daily_tailing_record_details';
 public function __construct() {
        parent::__construct();
      }
// Insert registration data in database
 function dsr_insert($data) {

    // Query to check whether username already exist or not
    $condition = "dtr_code =" . "'" . $data['dtr_code'] . "'";

    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();
    //print_r($data);exit;
    if ($query->num_rows() == 0) {
    // Query to insert data in database
        if ($this->input->post('dsr_id_old')):
            $id = $this->input->post('dsr_id_old');
            $this->db->where('id', $id);
            $this->db->update($this->table,$data);
        else:
            $this->db->insert($this->table, $data);
            $id = $this->db->insert_id();
        endif;

        $this->DailyStackingDetails($id);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else { 
            return false;
        }
    }
}
/************** PO Details Insertion ******************/

  function DailyStackingDetails($id) {
        $this->db->where('daily_tailing_record_id', $id);
        $this->db->delete($this->detailTable);

        if ($this->input->post('finish_good_id')):

            foreach ($this->input->post('finish_good_id') as $key => $value) :
                $this->db->set('daily_tailing_record_id', $id);
                $this->db->set('finish_good_id', $value);
                $this->db->set('finish_good_id', $this->input->post('finish_good_id')[$key]);
                $this->db->set('lot_no', $this->input->post('lot_no')[$key]);
                $this->db->set('batch_no', $this->input->post('batch_no')[$key]);
                $this->db->set('no_of_bags', $this->input->post('no_of_bags')[$key]);
                $this->db->set('bag_weight', $this->input->post('bag_weight')[$key]);
                $this->db->set('tailing_qty_in_mt', $this->input->post('tailing_qty_in_mt')[$key]);
                $this->db->set('total_tailing_for_lot', $this->input->post('total_tailing_for_lot')[$key]);
                $this->db->set('location_of_storage', $this->input->post('location_of_storage')[$key]);
                $this->db->set('reused_grade_id', $this->input->post('reused_grade_id')[$key]);
                $this->db->set('used_qty', $this->input->post('used_qty')[$key]);
                $this->db->set('balance_qty', $this->input->post('balance_qty')[$key]);
                $this->db->set('color', $this->input->post('color')[$key]);
                $this->db->insert($this->detailTable);
            endforeach;

        endif; 
}


/******************* Row Count for Voucher Number ********************/

 
    function getGSRCode(){
    $count=0;
    $this->db->select_max('dtr_code');
    $this->db->from($this->table);
    //$this->db->where('flag','0');
    $query=$this->db->get()->row_array();
    //print_r($query['employee_code']);exit;
    $count=$query['dtr_code']+1;
    return $count;
   
    }

function getTotalQtyForLot($lot_no){
    $count=0;
    $this->db->select_sum('total_tailing_for_lot');
    $this->db->from($this->detailTable);
    $this->db->where(['lot_no'=>$lot_no]);
    $query=$this->db->get()->row_array();
    //print_r($query['employee_code']);exit;
    $count=$query['total_tailing_for_lot'];
    return $count;
   
    }

/******************* edit rs ********************/

 function editDTR($data,$old_id){
    $this->db->where('id', $old_id);
    $this->db->update('daily_tailing_records', $data);
    $this->DailyStackingDetails($old_id);
    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }

} 



// Read data from database to show data in admin page

    function getList(){
        $this->db->select('daily_tailing_records.*,emp1.name as employee,departments.department_name as department');
        $this->db->from('daily_tailing_records');
        $this->db->join('employees as emp1', 'daily_tailing_records.created_by = emp1.id','left'); 
        $this->db->join('departments ', 'daily_tailing_records.department_id = departments.id','left');
       // $this->db->where(['daily_tailing_records.flag'=>'0']);
        $this->db->order_by('daily_tailing_records.id','desc');
        $query =  $this->db->get()->result_array();
        //print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
         foreach($query as $i=>$po_data) {
            $this->db->select('SUM(daily_tailing_record_details.no_of_bags) as no_of_bags');
            $this->db->where('daily_tailing_record_details.daily_tailing_record_id', $po_data['id']);
            $total_bags_query = $this->db->get('daily_tailing_record_details')->row_array();
            $query[$i]['no_of_bags_total'] = $total_bags_query['no_of_bags'];
    
            // Fetching other details
            $this->db->select('daily_tailing_record_details.*,fg1.mineral_name as mineral_name,fg1.grade_name as grade_name,fg2.mineral_name as used_mineral_name,fg2.grade_name as used_grade_name');
            $this->db->join('finish_goods as fg1', 'daily_tailing_record_details.finish_good_id = fg1.id'); 
            $this->db->join('finish_goods as fg2', 'daily_tailing_record_details.reused_grade_id = fg2.id'); 
            $this->db->where('daily_tailing_record_details.daily_tailing_record_id', $po_data['id']);
            $images_query = $this->db->get('daily_tailing_record_details')->result_array();
            $query[$i]['dsr_details'] = $images_query;
        }
       // echo '<pre>'; print_r($query);exit;
        return $query;
    } 

    function getAllReqList($conditions= null){
        //print_r($conditions);exit;
        $this->db->select('daily_tailing_records.*,emp1.name as employee,departments.department_name as department');
        $this->db->from('daily_tailing_records');
        $this->db->join('employees as emp1', 'daily_tailing_records.created_by = emp1.id','left'); 
        $this->db->join('departments ', 'daily_tailing_records.department_id = departments.id','left');
        if(!empty($conditions)){
            // if($conditions['worker_id'] !="0")
            // $this->db->like('work_allotment_registers.worker_id',$conditions['worker_id'],'both');

            if($conditions['department_id'] !="0")
               $this->db->like('daily_tailing_records.department_id',$conditions['department_id'],'both');

            // if($conditions['approved_status'] !="All")
            //    $this->db->like('work_allotment_registers.approved_status',$conditions['approved_status'],'both');

            if($conditions['from_date']!='1970-01-01')
                $this->db->where('daily_tailing_records.transaction_date >=',$conditions['from_date']); 

             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('daily_tailing_records.transaction_date <=',$conditions['upto_date']); 
        }
        

        $this->db->order_by('daily_tailing_records.id','desc');

        $query =  $this->db->get()->result_array();
       // print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('daily_tailing_record_details.*,fg1.mineral_name as mineral_name,fg1.grade_name as grade_name,fg2.mineral_name as used_mineral_name,fg2.grade_name as used_grade_name');
            $this->db->join('finish_goods as fg1', 'daily_tailing_record_details.finish_good_id = fg1.id'); 
            $this->db->join('finish_goods as fg2', 'daily_tailing_record_details.reused_grade_id = fg2.id'); 
            $this->db->where('daily_tailing_record_details.daily_tailing_record_id', $po_data['id']);
            $images_query = $this->db->get('daily_tailing_record_details')->result_array();
            $query[$i]['dsr_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    } 

     

    function deleteDTR($id){
     
        $this->db->where('id',$id);
        if($this->db->delete('daily_tailing_records'))
        {
            $this->db->where('daily_tailing_record_id', $id);
            if($this->db->delete('daily_tailing_record_details'))
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
        $this->db->select('daily_tailing_records.*,departments.department_name as dept,employees.name as ename');
        $this->db->from('daily_tailing_records');
        /*$this->db->join('finish_goods', 'production_registers.finish_good_id = finish_goods.id','left'); */
        $this->db->join('departments', 'daily_tailing_records.department_id = departments.id','left'); 
        $this->db->join('employees', 'daily_tailing_records.created_by = employees.id','left'); 
        $this->db->where('daily_tailing_records.id',$id);
        $query =  $this->db->get()->result_array();
       foreach($query as $i=>$po_data) {
            $this->db->select('daily_tailing_record_details.*,fg1.mineral_name as mineral_name,fg1.grade_name as grade_name,fg2.mineral_name as used_mineral_name,fg2.grade_name as used_grade_name');
            $this->db->join('finish_goods as fg1', 'daily_tailing_record_details.finish_good_id = fg1.id','left'); 
            $this->db->join('finish_goods as fg2', 'daily_tailing_record_details.reused_grade_id = fg2.id','left'); 
            $this->db->where('daily_tailing_record_details.daily_tailing_record_id', $po_data['id']);
            $images_query = $this->db->get('daily_tailing_record_details')->result_array();
            $query[$i]['dsr_details'] = $images_query;
        }
        //print_r($query);exit;
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