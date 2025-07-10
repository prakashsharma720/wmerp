<?php

Class Daily_stacking_model extends MY_Model {
    private $table = 'daily_stack_records';
    private $detailTable = 'daily_stack_record_details';

 public function __construct() {
        parent::__construct();
    }
// Insert registration data in database
 function dsr_insert($data) {

    // Query to check whether username already exist or not
    $condition = "dsr_code =" . "'" . $data['dsr_code'] . "'";

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
        $this->db->where('daily_stack_record_id', $id);
        $this->db->delete($this->detailTable);
        //print_r($this->input->post('worker_ids'));exit;

        if ($this->input->post('finish_good_id')):
            //$worker_names=[];
            $i=0;
            foreach ($this->input->post('finish_good_id') as $key => $value) :

                if(!empty($this->input->post('worker_ids')))
                {
                    $worker_names=implode(',',$this->input->post('worker_ids'));
                    /*foreach ($this->input->post('worker_ids') as $worker) 
                    {
                        $worker_names[]=implode(',',$worker);
                    }*/
                    
                }
                //print_r($worker_names);exit;
                $this->db->set('daily_stack_record_id', $id);
                $this->db->set('worker_ids', $worker_names);
                $this->db->set('work_location', $this->input->post('work_location')[$key]);
                $this->db->set('finish_good_id', $value);
                $this->db->set('bag_weight_stack_up', $this->input->post('bag_weight_stack_up')[$key]);
                $this->db->set('no_of_bags_stack_up', $this->input->post('no_of_bags_stack_up')[$key]);
                $this->db->set('stacking_up_rate', $this->input->post('rate_stack_up')[$key]);
                $this->db->set('stack_up_total', $this->input->post('total_stack_up')[$key]);
                $this->db->set('bag_weight_stack_down', $this->input->post('bag_weight_stack_down')[$key]);
                $this->db->set('no_of_bags_stack_down', $this->input->post('no_of_bags_stack_down')[$key]);
                $this->db->set('stacking_down_rate', $this->input->post('rate_stack_down')[$key]);
                $this->db->set('stack_down_total', $this->input->post('total_stack_down')[$key]);
                $this->db->set('total_no_of_bags', $this->input->post('no_of_bags')[$key]);
                $this->db->set('total_amount', $this->input->post('total')[$key]);
                $this->db->insert($this->detailTable);
            endforeach;
            $i++;
        endif; 
}


/******************* Row Count for Voucher Number ********************/

 
    function getGSRCode(){
    $count=0;
    $this->db->select_max('dsr_code');
    $this->db->from($this->table);
    //$this->db->where('flag','0');
    $query=$this->db->get()->row_array();
    //print_r($query['employee_code']);exit;
    $count=$query['dsr_code']+1;
    return $count;
   
    }

/******************* edit rs ********************/

 function editGSR($data,$old_id){
    $this->db->where('id', $old_id);
    $this->db->update('daily_stack_records', $data);
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
        $this->db->select('daily_stack_records.*,emp1.name as employee,departments.department_name as department');
        $this->db->from('daily_stack_records');
        $this->db->join('employees as emp1', 'daily_stack_records.created_by = emp1.id','left'); 
        $this->db->join('departments ', 'daily_stack_records.department_id = departments.id','left');
       // $this->db->where(['daily_stack_records.flag'=>'0']);
        $this->db->order_by('daily_stack_records.id','desc');
        $query =  $this->db->get()->result_array();
        //print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
         foreach($query as $i=>$po_data) {
            $this->db->select('daily_stack_record_details.*,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name');
            $this->db->join('finish_goods', 'daily_stack_record_details.finish_good_id = finish_goods.id'); 
            //$this->db->join('workers', 'daily_stack_record_details.worker_id = workers.id'); 
            $this->db->where('daily_stack_record_details.daily_stack_record_id', $po_data['id']);
            $images_query = $this->db->get('daily_stack_record_details')->result_array();
            $query[$i]['dsr_details'] = $images_query;
        }
       // echo '<pre>'; print_r($query);exit;
        return $query;
    } 
    function getAllReqList($conditions= null){
        //print_r($conditions);exit;
        $this->db->select('daily_stack_records.*,emp1.name as employee,departments.department_name as department');
        $this->db->from('daily_stack_records');
        $this->db->join('employees as emp1', 'daily_stack_records.created_by = emp1.id','left'); 
        $this->db->join('departments ', 'daily_stack_records.department_id = departments.id','left');
          if(!empty($conditions)){
            // if($conditions['worker_id'] !="0")
            // $this->db->like('work_allotment_registers.worker_id',$conditions['worker_id'],'both');

            if($conditions['department_id'] !="0")
               $this->db->like('daily_stack_records.department_id',$conditions['department_id'],'both');

            // if($conditions['approved_status'] !="All")
            //    $this->db->like('work_allotment_registers.approved_status',$conditions['approved_status'],'both');

            if($conditions['from_date']!='1970-01-01')
                $this->db->where('daily_stack_records.transaction_date >=',$conditions['from_date']); 

             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('daily_stack_records.transaction_date <=',$conditions['upto_date']); 
        }
        

        $this->db->order_by('daily_stack_records.id','desc');

        $query =  $this->db->get()->result_array();
       // print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('daily_stack_record_details.*,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name');
            $this->db->join('finish_goods', 'daily_stack_record_details.finish_good_id = finish_goods.id'); 
            //$this->db->join('workers', 'daily_stack_record_details.worker_id = workers.id'); 
            $this->db->where('daily_stack_record_details.daily_stack_record_id', $po_data['id']);
            $images_query = $this->db->get('daily_stack_record_details')->result_array();
            $query[$i]['dsr_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    } 

     

    function deleteGSR($id){
     
        $this->db->where('id',$id);
        if($this->db->delete('daily_stack_records'))
        {
            $this->db->where('daily_stack_record_id', $id);
            if($this->db->delete('daily_stack_record_details'))
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
        $this->db->select('daily_stack_records.*,departments.department_name as dept,employees.name as ename');
        $this->db->from('daily_stack_records');
        /*$this->db->join('finish_goods', 'production_registers.finish_good_id = finish_goods.id','left'); */
        $this->db->join('departments', 'daily_stack_records.department_id = departments.id','left'); 
        $this->db->join('employees', 'daily_stack_records.created_by = employees.id','left'); 
        $this->db->where('daily_stack_records.id',$id);
        $query =  $this->db->get()->result_array();
       foreach($query as $i=>$po_data) {
            $this->db->select('daily_stack_record_details.*,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name');
            $this->db->join('finish_goods', 'daily_stack_record_details.finish_good_id = finish_goods.id'); 
            //$this->db->join('workers', 'daily_stack_record_details.worker_id = workers.id'); 
            $this->db->where('daily_stack_record_details.daily_stack_record_id', $po_data['id']);
            $images_query = $this->db->get('daily_stack_record_details')->result_array();
            $query[$i]['dsr_details'] = $images_query;
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
       //$workerNames = array(); 
       // $productname[''] = 'Select Category...'; 
        /*foreach($result as $wk) { 
            $voucher_no= $wk['worker_code']; 
            if($voucher_no<10){
            $worker_id_code='WC000'.$voucher_no;
            }
            else if(($voucher_no>=10) && ($voucher_no<=99)){
              $worker_id_code='WC00'.$voucher_no;
            }
            else if(($voucher_no>=100) && ($voucher_no<=999)){
              $worker_id_code='WCP0'.$voucher_no;
            }
            else{
              $worker_id_code='WC'.$voucher_no;
            }
            $workerNames[$wk['name']] = $wk['name'].' ('.$worker_id_code.')'; 
        } */
        return $result; 
    } 
        
}

?>