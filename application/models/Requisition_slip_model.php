<?php

Class Requisition_Slip_model extends MY_Model {
    private $table = 'requisition_slips';
    private $detailTable = 'requisition_slip_rows';
 public function __construct() {
        parent::__construct();
      }
// Insert registration data in database
 function requisition_insert($data) {

// Query to check whether username already exist or not
$condition = "requisition_slip_no =" . "'" . $data['requisition_slip_no'] . "'";

$this->db->select('*');
$this->db->from($this->table);
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();
//print_r($data);exit;
if ($query->num_rows() == 0) {
// Query to insert data in database
 if ($this->input->post('requisition_id_old')):
        $id = $this->input->post('requisition_id_old');
        $this->db->where('id', $id);
        $this->db->update($this->table,$data);
    else:
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();
    endif;

    $this->requisitionDetails($id);


    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }
    }
}
/************** PO Details Insertion ******************/

  function requisitionDetails($id) {
        $this->db->where('requisition_slip_id', $id);
        $this->db->delete($this->detailTable);
             if ($this->input->post('products')):
                foreach ($this->input->post('products') as $key => $value) :
                    $this->db->set('requisition_slip_id', $id);
                    $this->db->set('item_id', $value);
                    $this->db->set('quantity', $this->input->post('qty')[$key]);
                    $this->db->set('pending_qty', $this->input->post('qty')[$key]);
                    $this->db->set('order_pending_qty', $this->input->post('qty')[$key]);
                    $this->db->set('unit_id', $this->input->post('unit_id')[$key]);
                    $this->db->set('description', $this->input->post('description')[$key]);
                    $this->db->insert($this->detailTable);
                endforeach;
            endif;   
                /*else{
             if ($this->input->post('products')):
                foreach ($this->input->post('products') as $key => $value) :
                    $this->db->set('requisition_slip_id', $id);
                    $this->db->set('item_id', $value);
                    $this->db->set('quantity', $this->input->post('qty')[$key]);
                    $this->db->set('pending_qty', $this->input->post('qty')[$key]);
                    $this->db->set('unit_id', $this->input->post('unit_id')[$key]);
                    $this->db->set('description', $this->input->post('description')[$key]);
                    $this->db->insert($this->detailTable);
                endforeach;
            endif;   
        } */     

    }

/******************* Row Count for Voucher Number ********************/

 function rowcount(){
    $count=0;
    $this->db->select('id');
    $this->db->from($this->table);
    $query=$this->db->get();
    $total=$query->num_rows();
    //print_r($query['vendor_code']);exit;
    $count=$total+1;
    return $count;
   
}
    function getRequisitionCode(){
    $count=0;
    $this->db->select_max('requisition_slip_no');
    $this->db->from($this->table);
    //$this->db->where(['flag'=>'0']);
    $query=$this->db->get()->row_array();
    //print_r($query['requisition_slip_no']);exit;
    $count=$query['requisition_slip_no']+1;
    //print_r($count);exit;
    return $count;
   
    }

/******************* edit rs ********************/

 function editRequisition($data,$old_id){
    $this->db->where('id', $old_id);
    $this->db->update('requisition_slips', $data);
    $this->requisitionDetails($old_id);
    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }

}
/*******************  Notification Entries ********************/

 function add_notification($data1){
    $this->db->insert('notifications', $data1);
    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }

} 

function actionRequisition($data,$old_id){
    $this->db->where('id', $old_id);
    $this->db->update('requisition_slips', $data);
    //$this->requisitionDetails($old_id);
    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }

}

// Read data from database to show data in admin page

    function getList(){
        $this->db->select('requisition_slips.*,emp1.name as requestor,emp2.name as approver,emp3.name as rejector,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name,departments.department_name as department');
        $this->db->from('requisition_slips');
        $this->db->join('departments', 'requisition_slips.department_id = departments.id','left'); 
        $this->db->join('employees as emp1', 'requisition_slips.created_by = emp1.id','left'); 
        $this->db->join('employees as emp2', 'requisition_slips.approved_by = emp2.id','left'); 
        $this->db->join('employees as emp3', 'requisition_slips.rejected_by = emp3.id','left'); 
        $this->db->join('finish_goods ', 'requisition_slips.finish_good_id = finish_goods.id','left');
        $this->db->where(['requisition_slips.flag'=>'0','requisition_slips.employee_id'=>$this->login_id]);

        $this->db->order_by('requisition_slips.id','ASC');

        $query =  $this->db->get()->result_array();
        //print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('requisition_slip_rows.*,packing_materials.name as material_name,packing_materials.code as material_code,unit.unit_name as unit');
            $this->db->join('packing_materials', 'requisition_slip_rows.item_id = packing_materials.id'); 
            $this->db->join('unit', 'requisition_slip_rows.unit_id = unit.id'); 
            $this->db->where('requisition_slip_rows.requisition_slip_id', $po_data['id']);
            $images_query = $this->db->get('requisition_slip_rows')->result_array();
            $query[$i]['requisition_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    } 

    function getAllReqList($conditions= null){
        //print_r($conditions);exit;
        $this->db->select('requisition_slips.*,emp1.name as requestor,emp2.name as approver,emp3.name as rejector,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name,departments.department_name as department');
        $this->db->from('requisition_slips');
        $this->db->join('departments', 'requisition_slips.department_id = departments.id','left'); 
        $this->db->join('employees as emp1', 'requisition_slips.created_by = emp1.id','left'); 
        $this->db->join('employees as emp2', 'requisition_slips.approved_by = emp2.id','left'); 
        $this->db->join('employees as emp3', 'requisition_slips.rejected_by = emp3.id','left'); 
        $this->db->join('finish_goods ', 'requisition_slips.finish_good_id = finish_goods.id','left');
        $this->db->where(['requisition_slips.flag'=>'0','requisition_slips.employee_id'=>$this->login_id]);
        if(!empty($conditions)){
            if($conditions['employee_id'] !="0")
               $this->db->like('requisition_slips.employee_id',$conditions['employee_id'],'both');

            if($conditions['department_id'] !="0")
               $this->db->like('requisition_slips.department_id',$conditions['department_id'],'both');

            if($conditions['approved_status'] !="All")
               $this->db->like('requisition_slips.approved_status',$conditions['approved_status'],'both');

            if($conditions['from_date']!='1970-01-01')
                $this->db->where('requisition_slips.transaction_date >=',$conditions['from_date']); 

             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('requisition_slips.transaction_date <=',$conditions['upto_date']); 
        }
        

        $this->db->order_by('requisition_slips.id','ASC');

        $query =  $this->db->get()->result_array();
        //print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('requisition_slip_rows.*,packing_materials.name as material_name,packing_materials.code as material_code,unit.unit_name as unit');
            $this->db->join('packing_materials', 'requisition_slip_rows.item_id = packing_materials.id'); 
            $this->db->join('unit', 'requisition_slip_rows.unit_id = unit.id'); 
            $this->db->where('requisition_slip_rows.requisition_slip_id', $po_data['id']);
            $images_query = $this->db->get('requisition_slip_rows')->result_array();
            $query[$i]['requisition_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    } 


    function getRSListforApproval(){
        //echo $this->role_id;exit;
        if($this->role_id=='1'){
            $this->db->select('requisition_slips.*,emp1.name as requestor,emp2.name as approver,emp3.name as rejector,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name');
            $this->db->from('requisition_slips');
            $this->db->join('employees as emp1', 'requisition_slips.created_by = emp1.id','left'); 
            $this->db->join('employees as emp2', 'requisition_slips.approved_by = emp2.id','left'); 
            $this->db->join('employees as emp3', 'requisition_slips.rejected_by = emp3.id','left'); 
            $this->db->join('finish_goods ', 'requisition_slips.finish_good_id = finish_goods.id','left');
            $this->db->where(['requisition_slips.flag'=>'0','requisition_slips.po_flag'=>'0','requisition_slips.approved_status'=>'Approved','requisition_slips.issue_completed'=>'0','requisition_slips.po_flag'=>'0','requisition_slips.admin_approve_status'=>'Pending']);
            $this->db->order_by('requisition_slips.id','ASC');
            $query =  $this->db->get()->result_array();
            //print_r($query);exit; //troubleshooting somehting.
            //$query->result_array();
            foreach($query as $i=>$po_data) {
                $this->db->select('requisition_slip_rows.*,packing_materials.*');
                $this->db->join('packing_materials', 'requisition_slip_rows.item_id = packing_materials.id'); 
                $this->db->where('requisition_slip_rows.requisition_slip_id', $po_data['id']);
                $images_query = $this->db->get('requisition_slip_rows')->result_array();
               $query[$i]['requisition_details'] = $images_query;
            }
          //  print_r($query);exit;
            return $query;
        }
        else if($this->role_id=='4')
        {
           // echo'hy';exit;
        $this->db->select('requisition_slips.*,emp1.name as requestor,emp2.name as approver,emp3.name as rejector,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name');
        $this->db->from('requisition_slips');
        $this->db->join('employees as emp1', 'requisition_slips.created_by = emp1.id','left'); 
        $this->db->join('employees as emp2', 'requisition_slips.approved_by = emp2.id','left'); 
        $this->db->join('employees as emp3', 'requisition_slips.rejected_by = emp3.id','left'); 
        $this->db->join('finish_goods ', 'requisition_slips.finish_good_id = finish_goods.id','left');
        $this->db->where(['requisition_slips.flag'=>'0','requisition_slips.po_flag'=>'0','requisition_slips.approved_status'=>'Pending','requisition_slips.issue_completed'=>'0','requisition_slips.po_flag'=>'0']);
        $this->db->order_by('requisition_slips.id','ASC');
        $query =  $this->db->get()->result_array();
        //print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('requisition_slip_rows.*,packing_materials.*');
            $this->db->join('packing_materials', 'requisition_slip_rows.item_id = packing_materials.id'); 
            $this->db->where('requisition_slip_rows.requisition_slip_id', $po_data['id']);
            $images_query = $this->db->get('requisition_slip_rows')->result_array();
           $query[$i]['requisition_details'] = $images_query;
        }
       // print_r($query);exit;
        return $query;
        }
    } 
    function getRSListForIssueSlip(){
        $this->db->select('requisition_slips.*,emp1.name as requestor,emp2.name as approver,emp3.name as rejector,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name');
        $this->db->from('requisition_slips');
        $this->db->join('employees as emp1', 'requisition_slips.created_by = emp1.id','left'); 
        $this->db->join('employees as emp2', 'requisition_slips.approved_by = emp2.id','left'); 
        $this->db->join('employees as emp3', 'requisition_slips.rejected_by = emp3.id','left'); 
        $this->db->join('finish_goods ', 'requisition_slips.finish_good_id = finish_goods.id','left');
        //$this->db->where(['requisition_slips.flag'=>'0','issue_completed'=>'0','requisition_slips.approved_status'=>'Approved','requisition_slips.admin_approve_status'=>'Approved']);
        $this->db->where(['requisition_slips.flag'=>'0','issue_completed'=>'0','requisition_slips.approved_status'=>'Approved']);
        $this->db->order_by('requisition_slips.id','ASC');
        $query =  $this->db->get()->result_array();
        //print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('requisition_slip_rows.*,packing_materials.*');
            $this->db->join('packing_materials', 'requisition_slip_rows.item_id = packing_materials.id'); 
            $this->db->where('requisition_slip_rows.requisition_slip_id', $po_data['id']);
            $images_query = $this->db->get('requisition_slip_rows')->result_array();
           $query[$i]['requisition_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    }

    function deleteRequisition($id){
        $data=array('flag'=>'1');
        $this->db->set('flag','flag',false);
        $this->db->where('id',$id);
        if($this->db->update('requisition_slips', $data)){
            return true;
        }
    }

	function getSuppliers()
	{ 
        $result = $this->db->select('id, supplier_name,vendor_code')->get('suppliers')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $suppliername = array(); 
        $suppliername[''] = 'Select Supplier...'; 
        foreach($result as $r) { 
            $suppliername[$r['id']] = $r['supplier_name'].'('.$r['vendor_code'].')'; 
        } 
        return $suppliername; 
    }
    function getCategories() { 
       $result = $this->db->select('id, category_name')->from('categories')->where('flag','0')->get()->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        /*$productname = array(); 
       // $productname[''] = 'Select Category...'; 
        foreach($result as $r) { 
            $productname[$r['id']] = $r['category_name']; 
        } */
        
        return $result; 
    }

    function getItems() { 
       $result = $this->db->select('id,name')->from('packing_materials')->where('flag','0')->get()->result_array(); 
        return $result; 
    }
    function getFGmaterialsList() { 
       $result = $this->db->select('id, item_name')->from('item_masters')->where('flag','0')->get()->result_array(); 


        return $result; 
    }

     function getGrades() { 
       $result = $this->db->select('id, grade')->from('grades')->where('flag','0')->get()->result_array(); 
        //print_r($result);exit;
        //order_by('category_name', 'asc');
       /* $productname = array(); 
       // $productname[''] = 'Select Category...'; 
        foreach($result as $r) { 
            $productname['id'] = $r['id']; 
            $productname['item_name'] = $r['item_name']; 
        } */
        
        return $result; 
    }

    public function getById($id){
        $this->db->select('requisition_slips.*,finish_goods.mineral_name as mineral,finish_goods.grade_name as grade,departments.department_name as dept,employees.name as ename');
        $this->db->from('requisition_slips');
	    $this->db->join('finish_goods', 'requisition_slips.finish_good_id = finish_goods.id','left'); 
	    $this->db->join('departments', 'requisition_slips.department_id = departments.id','left'); 
	    $this->db->join('employees', 'requisition_slips.employee_id = employees.id','left'); 

        $this->db->where('requisition_slips.id',$id);
        $query =  $this->db->get()->result_array();
        foreach($query as $i=>$po_data) {
			$this->db->select('requisition_slip_rows.*,packing_materials.name as item,packing_materials.unit_name as unit,packing_materials.code as item_code');
            $this->db->join('packing_materials', 'requisition_slip_rows.item_id = packing_materials.id','left');
		   // $this->db->join('unit', 'requisition_slip_rows.unit_id = unit.id','left');
            $this->db->where(['requisition_slip_rows.requisition_slip_id'=>$po_data['id']]);
            $images_query = $this->db->get('requisition_slip_rows')->result_array();
           $query[$i]['requisition_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    }

     public function getByIdForIssueSlip($id){
        $this->db->select('requisition_slips.*,finish_goods.mineral_name as mineral,finish_goods.grade_name as grade,departments.department_name as dept,employees.name as ename');
        $this->db->from('requisition_slips');
        $this->db->join('finish_goods', 'requisition_slips.finish_good_id = finish_goods.id','left'); 
        $this->db->join('departments', 'requisition_slips.department_id = departments.id','left'); 
        $this->db->join('employees', 'requisition_slips.employee_id = employees.id','left'); 

        $this->db->where('requisition_slips.id',$id);
        $query =  $this->db->get()->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('requisition_slip_rows.*,packing_materials.name as item,packing_materials.unit_name as unit,packing_materials.code as item_code');
            $this->db->join('packing_materials', 'requisition_slip_rows.item_id = packing_materials.id','left');
           // $this->db->join('unit', 'requisition_slip_rows.unit_id = unit.id','left');
            $this->db->where(['requisition_slip_rows.requisition_slip_id'=>$po_data['id'],'requisition_slip_rows.pending_qty >'=>'0']);
            $images_query = $this->db->get('requisition_slip_rows')->result_array();
            //print_r($images_query);
                foreach ($images_query as $key => $value) {
                    //print_r($value['item_id']);exit;
                    $item_id=$value['item_id'];
                    $this->db->select('SUM(stock_registers.quantity) as total');
                    $this->db->where(['stock_registers.item_id'=>$item_id,'stock_registers.status'=>'In']);
                    $total_in=$this->db->get('stock_registers')->row_array();
                    //print_r($total_in);

                    $item_id=$value['item_id'];
                    $this->db->select('SUM(stock_registers.quantity) as total');
                    $this->db->where(['stock_registers.item_id'=>$item_id,'stock_registers.status'=>'Out']);
                    $total_out=$this->db->get('stock_registers')->row_array();
                    //print_r($total_out['total']);exit;

                    $stock_in= $total_in['total']-$total_out['total'];
                    //print_r($stock_in);exit;
                    $images_query[$key]['stock_in'] = $stock_in;
                    //$images_query=$stock_in ;
                    # code...
                }
            $query[$i]['requisition_details'] = $images_query;

        }
        //print_r($query);exit;
        return $query;
    }

    
	
    public function getFGmineralsList() { 
       $result = $this->db->select('id, mineral_name,grade_name,fg_code')->from('finish_goods')->where(['flag'=>'0'])->group_by('mineral_name')->get()->result_array(); 
        return $result; 
    }
    public function getFGgradesList() { 
       $result = $this->db->select('id, grade_name')->from('finish_goods')->where(['flag'=>'0'])->group_by('grade_name')->get()->result_array(); 
        
        return $result; 
    } 
   function getEmployees() { 
        $result = $this->db->select('id, name')->from('employees')->where('flag','0')->get()->result_array(); 
        return $result; 
    }
    function getDepartments() { 
        $result = $this->db->select('id, department_name,department_code')->from('departments')->where('flag','0')->get()->result_array(); 
              return $result; 
    } 
      //----------- Approved Requisition List --------------------
     public function getStoreApprovedRequisitions(){
        if($this->role_id=='4')
        {
            $this->db->select('requisition_slips.id as req_id');
            $this->db->from('requisition_slips');
            $this->db->where(['requisition_slips.flag'=>'0','requisition_slips.po_flag'=>'0','requisition_slips.approved_status'=>'Approved','requisition_slips.issue_completed'=>'0','requisition_slips.po_flag'=>'0','requisition_slips.admin_approve_status'=>'approved']);
            $query =  $this->db->get()->row_array();
            if(!empty($query)){
            //print_r($query);exit;
            foreach($query as $i=>$po_data) {
                $this->db->select('requisition_slip_rows.id,requisition_slip_rows.item_id, SUM(requisition_slip_rows.order_pending_qty) as total,requisition_slip_rows.unit_id,requisition_slip_id,packing_materials.name as item_name,packing_materials.code as item_code,unit.unit_name as unit');
                $this->db->join('packing_materials', 'requisition_slip_rows.item_id = packing_materials.id');
                $this->db->join('unit', 'requisition_slip_rows.unit_id = unit.id');
                $this->db->where(['requisition_slip_rows.requisition_slip_id'=>$po_data,'requisition_slip_rows.order_pending_qty >'=>'0']);
                $this->db->group_by(['requisition_slip_rows.item_id']); 
                //$this->db->order_by('total', 'desc'); 
                $req_details=$this->db->get('requisition_slip_rows')->result_array();
                $data[$i] = $req_details;
            }
           // print_r($data);exit;
            return $data;
            }
        }
        else{
            $this->db->select('requisition_slips.id as req_id');
            $this->db->from('requisition_slips');
            $this->db->where(['requisition_slips.flag'=>'0','requisition_slips.po_flag'=>'0','requisition_slips.approved_status'=>'Approved','requisition_slips.issue_completed'=>'0','requisition_slips.store_rs'=>'0','requisition_slips.po_flag'=>'0','requisition_slips.admin_approve_status'=>'Approved']);
            $query =  $this->db->get()->result_array();
            if(!empty($query)){
            //print_r($query);exit;
            foreach($query as $i=>$po_data) {
                $this->db->select('requisition_slip_rows.id,requisition_slip_rows.item_id, SUM(requisition_slip_rows.order_pending_qty) as total,requisition_slip_rows.unit_id,requisition_slip_id,packing_materials.name as item_name,packing_materials.code as item_code,unit.unit_name as unit');
                $this->db->join('packing_materials', 'requisition_slip_rows.item_id = packing_materials.id');
                $this->db->join('unit', 'requisition_slip_rows.unit_id = unit.id');
                $this->db->where(['requisition_slip_rows.requisition_slip_id'=>$po_data['req_id'],'requisition_slip_rows.order_pending_qty >'=>'0']);
                $this->db->group_by(['requisition_slip_rows.item_id']); 
                //$this->db->order_by('total', 'desc'); 
                $req_details=$this->db->get('requisition_slip_rows')->result_array();
                $data[$i] = $req_details;
            }
            //print_r($data);exit;
            return $data;
            }
        }
        
    }
}

?>