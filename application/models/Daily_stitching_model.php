<?php

Class Daily_stitching_model extends MY_Model {
    private $table = 'daily_stiching_records';
    private $detailTable = 'daily_stiching_record_details';
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

    $this->DailyStitchingDetails($id);

    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }
    }
}
/************** PO Details Insertion ******************/

  function DailyStitchingDetails($id) {
        $this->db->where('daily_stiching_record_id', $id);
        $this->db->delete($this->detailTable);
             if ($this->input->post('worker_id')):
                foreach ($this->input->post('worker_id') as $key => $value) :
                    $this->db->set('daily_stiching_record_id', $id);
                    $this->db->set('worker_id', $value);
                    $this->db->set('finish_good_id', $this->input->post('finish_good_id')[$key]);
                    $this->db->set('no_of_bags', $this->input->post('no_of_bags')[$key]);
                    $this->db->set('rate', $this->input->post('rate')[$key]);
                    $this->db->set('total_amount', $this->input->post('total')[$key]);
                    $this->db->insert($this->detailTable);
                endforeach;
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
    $this->db->update('daily_stiching_records', $data);
    $this->DailyStitchingDetails($old_id);
    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }

} 



// Read data from database to show data in admin page

    function getList(){
        $this->db->select('daily_stiching_records.*,emp1.name as employee,departments.department_name as department');
        $this->db->from('daily_stiching_records');
        $this->db->join('employees as emp1', 'daily_stiching_records.created_by = emp1.id','left'); 
        $this->db->join('departments ', 'daily_stiching_records.department_id = departments.id','left');
       // $this->db->where(['daily_stiching_records.flag'=>'0']);
        $this->db->order_by('daily_stiching_records.id','desc');
        $query =  $this->db->get()->result_array();
        //print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
         foreach($query as $i=>$po_data) {
            $this->db->select('daily_stiching_record_details.*,workers.name as worker_name,workers.worker_code as worker_code,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name');
            $this->db->join('finish_goods', 'daily_stiching_record_details.finish_good_id = finish_goods.id'); 
            $this->db->join('workers', 'daily_stiching_record_details.worker_id = workers.id'); 
            $this->db->where('daily_stiching_record_details.daily_stiching_record_id', $po_data['id']);
            $images_query = $this->db->get('daily_stiching_record_details')->result_array();
            $query[$i]['dsr_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    } 

    function getAllReqList($conditions= null){
        //print_r($conditions);exit;
        $this->db->select('daily_stiching_records.*,emp1.name as employee,departments.department_name as department');
        $this->db->from('daily_stiching_records');
        $this->db->join('employees as emp1', 'daily_stiching_records.created_by = emp1.id','left'); 
        $this->db->join('departments ', 'daily_stiching_records.department_id = departments.id','left');
        if(!empty($conditions)){
            // if($conditions['worker_id'] !="0")
            // $this->db->like('work_allotment_registers.worker_id',$conditions['worker_id'],'both');

            if($conditions['department_id'] !="0")
               $this->db->like('daily_stiching_records.department_id',$conditions['department_id'],'both');

            // if($conditions['approved_status'] !="All")
            //    $this->db->like('work_allotment_registers.approved_status',$conditions['approved_status'],'both');

            if($conditions['from_date']!='1970-01-01')
                $this->db->where('daily_stiching_records.transaction_date >=',$conditions['from_date']); 

             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('daily_stiching_records.transaction_date <=',$conditions['upto_date']); 
        }
        

        $this->db->order_by('daily_stiching_records.id','desc');

        $query =  $this->db->get()->result_array();
       // print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('daily_stiching_record_details.*,workers.name as worker_name,workers.worker_code as worker_code,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name');
            $this->db->join('finish_goods', 'daily_stiching_record_details.finish_good_id = finish_goods.id'); 
            $this->db->join('workers', 'daily_stiching_record_details.worker_id = workers.id'); 
            $this->db->where('daily_stiching_record_details.daily_stiching_record_id', $po_data['id']);
            $images_query = $this->db->get('daily_stiching_record_details')->result_array();
            $query[$i]['dsr_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    } 

     

    function deleteGSR($id){
     
        $this->db->where('id',$id);
        if($this->db->delete('daily_stiching_records'))
        {
            $this->db->where('daily_stiching_record_id', $id);
            if($this->db->delete('daily_stiching_record_details'))
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
        $this->db->select('daily_stiching_records.*,departments.department_name as dept,employees.name as ename');
        $this->db->from('daily_stiching_records');
	    /*$this->db->join('finish_goods', 'production_registers.finish_good_id = finish_goods.id','left'); */
	    $this->db->join('departments', 'daily_stiching_records.department_id = departments.id','left'); 
	    $this->db->join('employees', 'daily_stiching_records.created_by = employees.id','left'); 
        $this->db->where('daily_stiching_records.id',$id);
        $query =  $this->db->get()->result_array();
       foreach($query as $i=>$po_data) {
            $this->db->select('daily_stiching_record_details.*,workers.name as worker_name,workers.worker_code as worker_code,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name');
            $this->db->join('finish_goods', 'daily_stiching_record_details.finish_good_id = finish_goods.id'); 
            $this->db->join('workers', 'daily_stiching_record_details.worker_id = workers.id'); 
            $this->db->where('daily_stiching_record_details.daily_stiching_record_id', $po_data['id']);
            $images_query = $this->db->get('daily_stiching_record_details')->result_array();
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
        return $result; 
    } 
        
}

?>