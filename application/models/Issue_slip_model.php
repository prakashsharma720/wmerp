<?php

Class Issue_Slip_model extends MY_Model {
    private $table = 'issue_slips';
    private $detailTable = 'issue_slip_rows';
   
 public function __construct() {
        parent::__construct();

    }
// Insert registration data in database

 function issue_insert($data) {

// Query to check whether username already exist or not
$condition = "issue_slip_no =" . "'" . $data['issue_slip_no'] . "'";

$this->db->select('*');
$this->db->from($this->table);
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();
//print_r($data);exit;
if ($query->num_rows() == 0) {
// Query to insert data in database
 if ($this->input->post('issue_id_old')):
        $id = $this->input->post('issue_id_old');
        $this->db->where('id', $id);
        $this->db->update($this->table,$data);
    else:
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();
    endif;

    $this->issueDetails($id);

    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }
    }
}
/************** PO Details Insertion ******************/

  function issueDetails($id) {
        $this->db->where('issue_slip_id',$id);
        $this->db->delete($this->detailTable);   
        if ($this->input->post('item_id')):
            foreach ($this->input->post('item_id') as $key => $value) :
                $this->db->set('issue_slip_id', $id);
                $this->db->set('item_id', $value);
                $this->db->set('quantity', $this->input->post('issue_qty')[$key]);
                $this->db->set('requisition_slip_row_id', $this->input->post('requisition_row_id')[$key]);
                //$this->db->set('description', $this->input->post('description')[$key]);
                $issue_slip_id= $id;
                $req_row_id= $this->input->post('requisition_row_id')[$key];
                $item_id= $value;
                $issue_qty= $this->input->post('issue_qty')[$key];
                $this->db->insert($this->detailTable);
                $issue_row_id = $this->db->insert_id();
                $this->updateRequisitionDetails($req_row_id,$issue_qty);
                $issue_data=$this->fetchIssueSlipDetails($id);
                $employee_id=$issue_data['employee_id'];
                $department_id=$issue_data['department_id'];
                $transaction_date=$issue_data['transaction_date'];
                $this->insertStockRegister($issue_slip_id,$issue_row_id,$employee_id,$department_id,$transaction_date,$item_id,$issue_qty);
            endforeach;
        endif;                  

    }
    /************** Update Requisition Slip ******************/
    function updateRequisitionDetails($req_row_id,$issue_qty){
                $req_data=$this->getRequisitionQty($req_row_id);
                $order_pending_qty=$req_data['order_pending_qty'];
                if($order_pending_qty!='0.00'){
                    $new_order_pending_qty=$order_pending_qty-$issue_qty;
                }else{
                    $new_order_pending_qty='0';
                }
                
                $requisition_row_id=$req_data['id'];
                $old_issue_qty=$req_data['issue_qty'];
                $req_pending_qty=$req_data['pending_qty'];
                if($req_pending_qty!='0.00'){
                    $pending_qty=$req_pending_qty-$issue_qty;
                }else{
                    $pending_qty='0';
                }
                $requisition_slip_id=$req_data['requisition_slip_id'];
                $total_issue_qty=$old_issue_qty+$issue_qty;
                $data=array('issue_qty'=>$total_issue_qty,'pending_qty'=>$pending_qty,'order_pending_qty'=>$new_order_pending_qty);
                $this->db->where(['id'=>$requisition_row_id]);
                $this->db->update('requisition_slip_rows',$data);
                //$this->db->set('description', $this->input->post('description')[$key]);
                    
    } 
       /************** Inser/Update StockRegisters ******************/
    function insertStockRegister($issue_slip_id,$issue_row_id,$employee_id,$department_id,$transaction_date,$item_id,$issue_qty){
                $data=array('issue_slip_id'=>$issue_slip_id,'issue_slip_row_id'=>$issue_row_id,'transaction_date'=>$transaction_date,'employee_id'=>$employee_id,'department_id'=>$department_id,'item_id'=>$item_id,'quantity'=>$issue_qty,'status'=>'In','created_by'=>$this->login_id);
                $this->db->insert('stock_registers', $data);
                $data1=array('issue_slip_id'=>$issue_slip_id,'issue_slip_row_id'=>$issue_row_id,'transaction_date'=>$transaction_date,'employee_id'=>$this->login_id,'department_id'=>$this->department_id,'item_id'=>$item_id,'quantity'=>$issue_qty,'status'=>'Out','created_by'=>$this->login_id);
                $this->db->insert('stock_registers', $data1);
                //$this->db->set('description', $this->input->post('description')[$key]);
                    
    }
    public function updateIssueCompleted($requisition_id_old)
    {
        $issue_completed='1';
        $data1=array('issue_completed'=>$issue_completed);
        $this->db->where('id', $requisition_id_old);
        $this->db->update('requisition_slips',$data1);
    }
    function getRequisitionQty($req_row_id){
    $count=0;
    $this->db->select('pending_qty,issue_qty,order_pending_qty,requisition_slip_id,id');
    $this->db->from('requisition_slip_rows');
    $this->db->where('id',$req_row_id);
    $query=$this->db->get()->row_array();
    //print_r($query);exit;
    //$count=$query['pending_qty'];
    return $query;
   
    }

 function fetchIssueSlipDetails($id){
    $count=0;
    $this->db->select('employee_id,department_id,transaction_date');
    $this->db->from('issue_slips');
    $this->db->where('id',$id);
    $query=$this->db->get()->row_array();
    //print_r($query);exit;
    //$count=$query['pending_qty'];
    return $query;
   
    }

/******************* Row Count for Voucher Number ********************/

function getIssueSlipCode(){
  $count=0;
  $this->db->select_max('issue_slip_no');
  $this->db->from($this->table);
  $query=$this->db->get()->row_array();
  //print_r($query['vendor_code']);exit;
  $count=$query['issue_slip_no']+1;
  return $count;
}


/******************* edit rmcode ********************/

 function editissue($data,$old_id){
    $this->db->where('id', $old_id);
    $this->db->update('issue_slips', $data);
    $this->issueDetails($old_id);
    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }

}

// Read data from database to show data in admin page

    function getList(){
        $this->db->select('issue_slips.*');
        $this->db->from('issue_slips');
       // $this->db->join('suppliers', 'issue_slips.supplier_id = suppliers.id'); 
        //$this->db->join('issue_slip_rows', 'issue_slips.id = issue_slip_rows.purchase_order_id'); 
        $this->db->where('issue_slips.flag','0');
        $this->db->order_by('issue_slips.id','ASC');
        $query =  $this->db->get()->result_array();
       
        //print_r($query);exit; //troubleshooting somehting.
        
        //$query->result_array();
        foreach($query as $i=>$po_data) {

            $this->db->select('issue_slip_rows.*,packing_materials.name as item,packing_materials.unit_name as unit,packing_materials.code as item_code');
            $this->db->join('packing_materials', 'issue_slip_rows.item_id = packing_materials.id'); 
           // $this->db->from('issue_slip_rows');
            $this->db->where('issue_slip_rows.issue_slip_id', $po_data['id']);
            $images_query = $this->db->get('issue_slip_rows')->result_array();

           // Add the images array to the array entry for this product
           $query[$i]['issue_details'] = $images_query;

        }
        //print_r($query);exit;
        return $query;
    }

    function deleteissue($id){
        $data=array('flag'=>'1');
        $this->db->set('flag','flag',false);
        $this->db->where('id',$id);
        if($this->db->update('issue_slips', $data)){
            return true;
        }
    }

	function getEmployees()
	{ 
       // $result = $this->db->select('id, name,employee_code')->get('employees')->result_array(); 
        $result = $this->db->select('id,name,employee_code')->from('employees')->where('flag','0')->get()->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $employeeList = array(); 
        $employeeList[''] = 'Select Employee...'; 
        foreach($result as $r) { 
                $voucher_no =$r['employee_code'];
                if($voucher_no<10){
                $rs_id_code='EMP000'.$voucher_no;
                }
                else if(($voucher_no>=10) && ($voucher_no<=99)){
                  $rs_id_code='EMP00'.$voucher_no;
                }
                else if(($voucher_no>=100) && ($voucher_no<=999)){
                  $rs_id_code='EMP0'.$voucher_no;
                }
                else{
                  $rs_id_code='EMP'.$voucher_no;
                }
            $employeeList[$r['id']] = $r['name'].' ('.$rs_id_code.')'; 
        } 
        return $employeeList; 
        //return $result; 
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

      function getItems() { 
       $result = $this->db->select('id,name')->from('packing_materials')->where('flag','0')->get()->result_array(); 
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
    /*  public function getApprovedRequisitions($id){
        $this->db->select('requisition_slips.*');
        $this->db->from('requisition_slips');
        $this->db->where(['requisition_slips.flag'=>'0','requisition_slips.po_flag'=>'0','requisition_slips.approved_status'=>'Approved','requisition_slips.id'=>$id]);
        $query =  $this->db->get()->row_array();
       // print_r($query);exit;
        foreach($query as $i=>$po_data) {
            $this->db->select('requisition_slip_rows.id,requisition_slip_rows.item_id, SUM(requisition_slip_rows.quantity) as total,requisition_slip_rows.unit_id,requisition_slip_id,packing_materials.name as item_name,unit.unit_name as unit');
            $this->db->join('packing_materials', 'requisition_slip_rows.item_id = packing_materials.id');
            $this->db->join('unit', 'requisition_slip_rows.unit_id = unit.id');
            $this->db->where(['requisition_slip_rows.requisition_slip_id'=>$po_data]);
            $this->db->group_by(['requisition_slip_rows.item_id']); 
            //$this->db->order_by('total', 'desc'); 
            $req_details=$this->db->get('requisition_slip_rows')->result_array();
            $data[$i] = $req_details;
        }
        //print_r($data);exit;
        return $data;
        }
    */
       public function getById($id){
        $this->db->select('issue_slips.*,requisition_slips.transaction_date as date, requisition_slips.requisition_slip_no as requisition_no,departments.department_name as dept,employees.name as ename');
        $this->db->from('issue_slips');
        //$this->db->join('suppliers', 'issue_slips.supplier_id = suppliers.id');
       $this->db->join('requisition_slips', 'issue_slips.requisition_slip_id = requisition_slips.id','left'); 
		$this->db->join('departments', 'issue_slips.department_id = departments.id','left'); 
	    $this->db->join('employees', 'issue_slips.employee_id = employees.id','left'); 
        $this->db->where('issue_slips.id',$id);
        //$this->db->order_by('issue_slips.id','ASC');
        $query =  $this->db->get()->result_array();
       
        foreach($query as $i=>$po_data) {
    			$this->db->select('issue_slip_rows.*,packing_materials.name as item,unit.unit_name as unit,
    			requisition_slip_rows.quantity as req_qty,requisition_slip_rows.pending_qty as pending_qty');
    		    $this->db->join('requisition_slip_rows', 'issue_slip_rows.requisition_slip_row_id = requisition_slip_rows.id','left');
                $this->db->join('packing_materials', 'requisition_slip_rows.item_id = packing_materials.id','left');
    		    $this->db->join('unit', 'requisition_slip_rows.unit_id = unit.id','left');
                $this->db->where('issue_slip_rows.issue_slip_id', $po_data['id']);
                $images_query = $this->db->get('issue_slip_rows')->result_array();

               $query[$i]['issue_details'] = $images_query;
            }
        //print_r($query);exit;
        return $query;
    }
     function getDepartments() { 
        $result = $this->db->select('id, department_name,department_code')->from('departments')->where('flag','0')->get()->result_array(); 
              return $result; 
    } 
	}

?>