<?php

Class Printing_logsheet_model extends MY_Model {
    private $table = 'printing_machine_logsheets';
    private $detailTable = 'printing_machine_logsheet_details';
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
        $this->db->where('printing_machine_logsheet_id', $id);
        $this->db->delete($this->detailTable);
             if ($this->input->post('finish_good_id')):
                foreach ($this->input->post('finish_good_id') as $key => $value) :
                    $this->db->set('printing_machine_logsheet_id', $id);
                    $this->db->set('finish_good_id', $value);
                    $this->db->set('production_month_id', $this->input->post('production_month_id')[$key]);
                    $this->db->set('production_year', $this->input->post('production_year')[$key]);
                    $this->db->set('lot_no', $this->input->post('lot_no')[$key]);
                    $this->db->set('lot_no', $this->input->post('lot_no')[$key]);
                    $this->db->set('batch_no', $this->input->post('batch_no')[$key]);
                    $this->db->set('no_of_bags', $this->input->post('no_of_bags')[$key]);
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
    $this->db->update('printing_machine_logsheets', $data);
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
        $this->db->select('printing_machine_logsheets.*,emp1.name as employee,departments.department_name as department');
        $this->db->from('printing_machine_logsheets');
        $this->db->join('employees as emp1', 'printing_machine_logsheets.created_by = emp1.id','left'); 
        $this->db->join('departments ', 'printing_machine_logsheets.department_id = departments.id','left');
       // $this->db->where(['printing_machine_logsheets.flag'=>'0']);
        $this->db->order_by('printing_machine_logsheets.id','desc');
        $query =  $this->db->get()->result_array();
        //print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
         foreach($query as $i=>$po_data) {
            $this->db->select('printing_machine_logsheet_details.*,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name,finish_goods.fg_code as fg_code,months.month_name as month_name');
            $this->db->join('finish_goods', 'printing_machine_logsheet_details.finish_good_id = finish_goods.id');
            $this->db->join('months', 'printing_machine_logsheet_details.production_month_id = months.id');
            $this->db->where('printing_machine_logsheet_details.printing_machine_logsheet_id', $po_data['id']);
            $images_query = $this->db->get('printing_machine_logsheet_details')->result_array();
            $query[$i]['process_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    } 

    function getAllReqList($conditions= null){
        //print_r($conditions);exit;
        $this->db->select('printing_machine_logsheets.*,emp1.name as employee,departments.department_name as department');
        $this->db->from('printing_machine_logsheets');
        $this->db->join('employees as emp1', 'printing_machine_logsheets.created_by = emp1.id','left'); 
        $this->db->join('departments ', 'printing_machine_logsheets.department_id = departments.id','left');
        if(!empty($conditions)){
            // if($conditions['worker_id'] !="0")
            // $this->db->like('work_allotment_registers.worker_id',$conditions['worker_id'],'both');

            if($conditions['department_id'] !="0")
               $this->db->like('printing_machine_logsheets.department_id',$conditions['department_id'],'both');

            // if($conditions['approved_status'] !="All")
            //    $this->db->like('work_allotment_registers.approved_status',$conditions['approved_status'],'both');

            if($conditions['from_date']!='1970-01-01')
                $this->db->where('printing_machine_logsheets.transaction_date >=',$conditions['from_date']); 

             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('printing_machine_logsheets.transaction_date <=',$conditions['upto_date']); 
        }
        

        $this->db->order_by('printing_machine_logsheets.id','desc');

        $query =  $this->db->get()->result_array();
       // print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('printing_machine_logsheet_details.*,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name,finish_goods.fg_code as fg_code,months.month_name as month_name');
            $this->db->join('finish_goods', 'printing_machine_logsheet_details.finish_good_id = finish_goods.id');
            $this->db->join('months', 'printing_machine_logsheet_details.production_month_id = months.id');
            $this->db->where('printing_machine_logsheet_details.printing_machine_logsheet_id', $po_data['id']);
            $images_query = $this->db->get('printing_machine_logsheet_details')->result_array();
            $query[$i]['process_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    } 


    function deleteGSR($id){
     
        $this->db->where('id',$id);
        if($this->db->delete('printing_machine_logsheets'))
        {
            $this->db->where('printing_machine_logsheet_id', $id);
            if($this->db->delete('printing_machine_logsheet_details'))
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
        $this->db->select('printing_machine_logsheets.*,employees.name as ename');
        $this->db->from('printing_machine_logsheets');
	    /*$this->db->join('finish_goods', 'process_registers.finish_good_id = finish_goods.id','left'); */
	    //$this->db->join('departments', 'printing_machine_logsheets.department_id = departments.id','left'); 
	    $this->db->join('employees', 'printing_machine_logsheets.created_by = employees.id','left'); 
        $this->db->where('printing_machine_logsheets.id',$id);
        $query =  $this->db->get()->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('printing_machine_logsheet_details.*,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name,finish_goods.fg_code as fg_code');
            $this->db->join('finish_goods', 'printing_machine_logsheet_details.finish_good_id = finish_goods.id');
            $this->db->where('printing_machine_logsheet_details.printing_machine_logsheet_id', $po_data['id']);
            $images_query = $this->db->get('printing_machine_logsheet_details')->result_array();
            $query[$i]['process_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    }

    public function getMonthList() { 
       $result = $this->db->select('id, month_name')->from('months')->where(['flag'=>'0'])->get()->result_array(); 
        return $result;
    }
    public function getFGgradesList() { 
       $result = $this->db->select('id, grade_name,mineral_name')->from('finish_goods')->where(['flag'=>'0'])->get()->result_array(); 
        
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