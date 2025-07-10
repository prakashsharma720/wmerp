<?php

Class Work_allotment_model extends MY_Model {
    private $table = 'work_allotment_registers';
    private $detailTable = 'work_allotment_details';
 public function __construct() {
        parent::__construct();
      }
// Insert registration data in database
 function wa_insert($data) {

// Query to check whether username already exist or not
$condition = "wa_code =" . "'" . $data['wa_code'] . "'";

$this->db->select('*');
$this->db->from($this->table);
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();
//print_r($data);exit;
if ($query->num_rows() == 0) {
// Query to insert data in database
 if ($this->input->post('wa_id_old')):
        $id = $this->input->post('wa_id_old');
        $this->db->where('id', $id);
        $this->db->update($this->table,$data);
    else:
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();
    endif;

    $this->WorkDetails($id);

    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }
    }
}
/************** PO Details Insertion ******************/

  function WorkDetails($id) {
        $this->db->where('work_allotment_register_id', $id);
        $this->db->delete($this->detailTable);
             if ($this->input->post('worker_id')):
                foreach ($this->input->post('worker_id') as $key => $value) :
                    $this->db->set('work_allotment_register_id', $id);
                    $this->db->set('worker_id', $value);
                    $this->db->set('work_allotted', $this->input->post('work_allotted')[$key]);
                    $this->db->set('attendance', $this->input->post('attendance')[$key]);
                    $this->db->insert($this->detailTable);
                endforeach;
            endif; 
    }

         
/******************* Row Count for Voucher Number ********************/


    function getWorkAllotCode(){
    $count=0;
    $this->db->select_max('wa_code');
    $this->db->from($this->table);
    $this->db->where('flag','0');
    $query=$this->db->get()->row_array();
    //print_r($query['employee_code']);exit;
    $count=$query['wa_code']+1;
    return $count;
   
    }

/******************* edit rs ********************/

 function editWork_alloted($data,$old_id){
    $this->db->where('id', $old_id);
    $this->db->update('work_allotment_registers', $data);
    $this->WorkDetails($old_id);
    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }

} 


// Read data from database to show data in admin page

    function getList(){
        $this->db->select('work_allotment_registers.*,emp1.name as employee,departments.department_name as department');
        $this->db->from('work_allotment_registers');
        $this->db->join('employees as emp1', 'work_allotment_registers.created_by = emp1.id','left'); 
        $this->db->join('departments ', 'work_allotment_registers.department_id = departments.id','left');
        $this->db->where(['work_allotment_registers.flag'=>'0']);
        $this->db->order_by('work_allotment_registers.id','desc');
        $query =  $this->db->get()->result_array();
        //print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('work_allotment_details.*,workers.name as worker_name,workers.worker_code as worker_code');
            $this->db->join('workers', 'work_allotment_details.worker_id = workers.id'); 
            $this->db->where('work_allotment_details.work_allotment_register_id', $po_data['id']);
            $images_query = $this->db->get('work_allotment_details')->result_array();
            $query[$i]['work_alloted_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    } 

    function getAllReqList($conditions= null){
        //print_r($conditions);exit;
        $this->db->select('work_allotment_registers.*,emp1.name as employee,departments.department_name as department');
        $this->db->from('work_allotment_registers');
        $this->db->join('employees as emp1', 'work_allotment_registers.created_by = emp1.id','left'); 
        $this->db->join('departments ', 'work_allotment_registers.department_id = departments.id','left');
        $this->db->where(['work_allotment_registers.flag'=>'0']);
        //$this->db->join('finish_goods ', 'work_allotment_registers.finish_good_id = finish_goods.id','left');
        //$this->db->where(['work_allotment_registers.flag'=>'0','work_allotment_registers.worker_id'=>$this->login_id]);
        if(!empty($conditions)){
            // if($conditions['worker_id'] !="0")
            // $this->db->like('work_allotment_registers.worker_id',$conditions['worker_id'],'both');

            if($conditions['department_id'] !="0")
               $this->db->like('work_allotment_registers.department_id',$conditions['department_id'],'both');

            // if($conditions['approved_status'] !="All")
            //    $this->db->like('work_allotment_registers.approved_status',$conditions['approved_status'],'both');

            if($conditions['from_date']!='1970-01-01')
                $this->db->where('work_allotment_registers.transaction_date >=',$conditions['from_date']); 

             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('work_allotment_registers.transaction_date <=',$conditions['upto_date']); 
        }
        

        $this->db->order_by('work_allotment_registers.id','desc');

        $query =  $this->db->get()->result_array();
       // print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('work_allotment_details.*,workers.name as worker_name,workers.worker_code as worker_code');
            $this->db->join('workers', 'work_allotment_details.worker_id = workers.id'); 
            $this->db->where('work_allotment_details.work_allotment_register_id', $po_data['id']);
            $images_query = $this->db->get('work_allotment_details')->result_array();
            $query[$i]['work_alloted_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    } 



    function deleteWork_alloted($id){
        //$data=array('flag'=>'1');
        //$this->db->set('flag','flag',false);
        $this->db->where('id',$id);
        if($this->db->delete('work_allotment_registers'))
        {
            $this->db->where('work_allotment_register_id', $id);
            if($this->db->delete('work_allotment_details'))
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
        $this->db->select('work_allotment_registers.*,departments.department_name as dept,employees.name as ename');
        $this->db->from('work_allotment_registers');
	    /*$this->db->join('finish_goods', 'production_registers.finish_good_id = finish_goods.id','left'); */
	    $this->db->join('departments', 'work_allotment_registers.department_id = departments.id','left'); 
	    $this->db->join('employees', 'work_allotment_registers.created_by = employees.id','left'); 

        $this->db->where('work_allotment_registers.id',$id);
        $query =  $this->db->get()->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('work_allotment_details.*');
           // $this->db->join('finish_goods', 'work_allotment_details.finish_good_id = finish_goods.id'); 
            $this->db->where('work_allotment_details.work_allotment_register_id', $po_data['id']);
            $images_query = $this->db->get('work_allotment_details')->result_array();
            $query[$i]['work_details'] = $images_query;
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