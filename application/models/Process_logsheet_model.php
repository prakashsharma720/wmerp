<?php

Class Process_logsheet_model extends MY_Model {
    private $table = 'process_logsheets';
    private $detailTable = 'process_logsheet_details';
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
        $this->db->where('process_logsheet_id', $id);
        $this->db->delete($this->detailTable);
             if ($this->input->post('finish_good_id')):
                foreach ($this->input->post('finish_good_id') as $key => $value) :
                    $this->db->set('process_logsheet_id', $id);
                    $this->db->set('date', date('Y-m-d',strtotime($this->input->post('date1')[$key])));
                    $this->db->set('hrs1', $this->input->post('hrs1')[$key]);
                    $this->db->set('min1', $this->input->post('min1')[$key]);
                    $this->db->set('finish_good_id', $value);
                    $this->db->set('lot_no', $this->input->post('lot_no')[$key]);
                    $this->db->set('batch_no', $this->input->post('batch_no')[$key]);
                    $this->db->set('previous_bag_no', $this->input->post('previous_bag_no')[$key]);
                    // $this->db->set('date', date('Y-m-d',strtotime($this->input->post('date')[$key])));
                    // $this->db->set('time', date('H:i a',strtotime($this->input->post('time')[$key])));
                    $this->db->set('plate_weight', $this->input->post('plate_weight')[$key]);
                    $this->db->set('grate_weight', $this->input->post('grate_weight')[$key]);
                    $this->db->set('avg_temp_pulverizer', $this->input->post('avg_temp_pulverizer')[$key]);
                    $this->db->set('avg_temp_pribbon', $this->input->post('avg_temp_pribbon')[$key]);
                    $this->db->set('avg_temp_hopper', $this->input->post('avg_temp_hopper')[$key]);
                    $this->db->set('oversize_weight', $this->input->post('oversize_weight')[$key]);
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
    $this->db->update('process_logsheets', $data);
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
        $this->db->select('process_logsheets.*,emp1.name as employee,departments.department_name as department');
        $this->db->from('process_logsheets');
        $this->db->join('employees as emp1', 'process_logsheets.created_by = emp1.id','left'); 
        $this->db->join('departments ', 'process_logsheets.department_id = departments.id','left');
       // $this->db->where(['process_logsheets.flag'=>'0']);
        $this->db->order_by('process_logsheets.id','desc');
        $query =  $this->db->get()->result_array();
        //print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
         foreach($query as $i=>$po_data) {
            $this->db->select('process_logsheet_details.*,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name,finish_goods.fg_code as fg_code');
            $this->db->join('finish_goods', 'process_logsheet_details.finish_good_id = finish_goods.id');
            $this->db->where('process_logsheet_details.process_logsheet_id', $po_data['id']);
            $images_query = $this->db->get('process_logsheet_details')->result_array();
            $query[$i]['process_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    } 

     

    function deleteGSR($id){
     
        $this->db->where('id',$id);
        if($this->db->delete('process_logsheets'))
        {
            $this->db->where('process_logsheet_id', $id);
            if($this->db->delete('process_logsheet_details'))
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
        $this->db->select('process_logsheets.*,departments.department_name as dept,employees.name as ename');
        $this->db->from('process_logsheets');
	    /*$this->db->join('finish_goods', 'process_registers.finish_good_id = finish_goods.id','left'); */
	    $this->db->join('departments', 'process_logsheets.department_id = departments.id','left'); 
	    $this->db->join('employees', 'process_logsheets.created_by = employees.id','left'); 
        $this->db->where('process_logsheets.id',$id);
        $query =  $this->db->get()->result_array();
       foreach($query as $i=>$po_data) {
            $this->db->select('process_logsheet_details.*,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name,finish_goods.fg_code as fg_code');
            $this->db->join('finish_goods', 'process_logsheet_details.finish_good_id = finish_goods.id');
            $this->db->where('process_logsheet_details.process_logsheet_id', $po_data['id']);
            $images_query = $this->db->get('process_logsheet_details')->result_array();
            $query[$i]['process_details'] = $images_query;
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