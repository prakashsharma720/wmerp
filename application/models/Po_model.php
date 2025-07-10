<?php

Class Po_Model extends MY_Model {
    private $table = 'purchase_orders';
    private $detailTable = 'purchase_order_rows';

 public function __construct() {
        parent::__construct();
       // $this->language_id = 1;
    }
// Insert registration data in database
public function po_insert($data) {

// Query to check whether username already exist or not
$condition = "po_number =" . "'" . $data['po_number'] . "'";

$this->db->select('*');
$this->db->from($this->table);
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();
//print_r($data);exit;
if ($query->num_rows() == 0) {
// Query to insert data in database
 if ($this->input->post('po_id_old')):
        $id = $this->input->post('po_id_old');
        $this->db->where('id', $id);
        $this->db->update($this->table,$data);
    else:
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();
    endif;

    $this->poDetails($id);


    if ($this->db->affected_rows() > 0) {
    return $id;
    }
    else { 
    return false;
        }
    }
}
/************** PO Details Insertion ******************/

 public function poDetails($id) {
        $this->db->where('purchase_order_id', $id);
        $this->db->delete($this->detailTable);   
        if ($this->input->post('item_id')):
            foreach ($this->input->post('item_id') as $key => $value) :
                $this->db->set('purchase_order_id', $id);
                $this->db->set('item_id', $value);
                $this->db->set('grade', $this->input->post('grade')[$key]);
                $this->db->set('quantity', $this->input->post('ordered_qty')[$key]);
                $this->db->set('rate', $this->input->post('rate')[$key]);
                $this->db->set('amount', $this->input->post('total')[$key]);
                $this->db->set('requisition_slip_row_id', $this->input->post('requisition_slip_row_id')[$key]);
                $this->db->insert($this->detailTable);
                $item_id= $value;
                $order_qty= $this->input->post('ordered_qty')[$key];
                $req_row_id= $this->input->post('requisition_slip_row_id')[$key];
                $req_data=$this->fetchRequisionSlipDetails($req_row_id);
                $old_pending_qty=$req_data['order_pending_qty'];
                if($old_pending_qty!='0.00'){
                     $new_pendin_qty=$old_pending_qty-$order_qty;
                }else{
                     $new_pendin_qty='0';
                }
                $old_order_qty=$req_data['order_qty'];
                $new_order_qty=$old_order_qty+$order_qty;
               
                $this->updateRequisitionDetails($req_row_id,$new_order_qty,$new_pendin_qty);
                //$this->getRequisionSlipTotalQty($req_row_id);
            endforeach;
        endif;                  
    }
 function fetchRequisionSlipDetails($id){
    $count=0;
    $this->db->select('order_pending_qty,order_qty');
    $this->db->from('requisition_slip_rows');
    $this->db->where('id',$id);
    $query=$this->db->get()->row_array();
    //print_r($query);exit;
    //$count=$query['pending_qty'];
    return $query;
   
    }
     /************** Update Requisition Slip ******************/
    function updateRequisitionDetails($req_row_id,$new_order_qty,$new_pendin_qty){
                
                    $data=array('order_qty'=>$new_order_qty,'order_pending_qty'=>$new_pendin_qty);
                    $this->db->where(['id'=>$req_row_id]);
                    $this->db->update('requisition_slip_rows',$data);

    } 
    
    public function updateRequisitionPOCompleted($req_id)
    {
        $po_completed='1';
        $data1=array('po_flag'=>$po_completed);
        $this->db->where('id', $req_id);
        $this->db->update('requisition_slips',$data1);
    }
/******************* Row Count for Voucher Number ********************/

 /*function rowcount(){
    $count=0;
    $this->db->select_max('po_number');
    $this->db->from($this->table);
    $query=$this->db->get()->result_array();
    //$query->result_array();
    $count=$query[0]['po_number'];
    //print_r($count);exit;
    return $count;
   
}*/
function getPOCode(){
      $count=0;
      $this->db->select_max('po_number');
      $this->db->from($this->table);
      $query=$this->db->get()->row_array();
      //print_r($query['vendor_code']);exit;
      $count=$query['po_number']+1;
      return $count;
    }

/******************* edit rmcode ********************/

public function editPO($data,$old_id){
    $this->db->where('id', $old_id);
    $this->db->update('purchase_orders', $data);
    $this->poDetails($old_id);
    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }

}

// Read data from database to show data in admin page

   public function getList($conditions= null){
        $this->db->select('purchase_orders.*,suppliers.supplier_name as supplier,departments.department_name as department');
        $this->db->from('purchase_orders');
        $this->db->join('suppliers', 'purchase_orders.supplier_id = suppliers.id'); 
         $this->db->join('departments', 'purchase_orders.department_id = departments.id','left'); 
        //$this->db->join('purchase_order_rows', 'purchase_orders.id = purchase_order_rows.purchase_order_id'); 
        if(!empty($conditions)){
            if($conditions['supplier_id'] !="0")
               $this->db->like('purchase_orders.supplier_id',$conditions['supplier_id'],'both');

            if($conditions['department_id'] !="0")
               $this->db->like('purchase_orders.department_id',$conditions['department_id'],'both');

           if($conditions['purchase_indent'] !="All")
               $this->db->like('purchase_orders.purchase_indent',$conditions['purchase_indent'],'both');

            if($conditions['admin_approval'] !="All")
               $this->db->like('purchase_orders.admin_approval',$conditions['admin_approval'],'both');

            if($conditions['from_date']!='1970-01-01')
                $this->db->where('purchase_orders.transaction_date >=',$conditions['from_date']); 

             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('purchase_orders.transaction_date <=',$conditions['upto_date']); 
        }

        $this->db->where('purchase_orders.flag','0');
        $this->db->order_by('purchase_orders.id','ASC');
        $query =  $this->db->get()->result_array();
       
        //print_r($query);exit; //troubleshooting somehting.
        
        //$query->result_array();
        foreach($query as $i=>$po_data) {

            $this->db->select('purchase_order_rows.*,packing_materials.name as material_name,packing_materials.code as material_code,packing_materials.unit_name as unit');
            $this->db->join('packing_materials', 'purchase_order_rows.item_id = packing_materials.id'); 
           // $this->db->from('purchase_order_rows');
            $this->db->where('purchase_order_rows.purchase_order_id', $po_data['id']);
            $images_query = $this->db->get('purchase_order_rows')->result_array();

           // Add the images array to the array entry for this product
           $query[$i]['po_details'] = $images_query;

        }
        //print_r($query);exit;
        return $query;
    } 

      public function getPOListforApproval(){
        $this->db->select('purchase_orders.*,suppliers.supplier_name as supplier,');
        $this->db->from('purchase_orders');
        $this->db->join('suppliers', 'purchase_orders.supplier_id = suppliers.id'); 
        //$this->db->join('purchase_order_rows', 'purchase_orders.id = purchase_order_rows.purchase_order_id'); 
        $this->db->where(['purchase_orders.flag'=>'0','purchase_orders.admin_approval'=>'Pending','purchase_orders.purchase_indent'=>'0']);
        $this->db->order_by('purchase_orders.id','ASC');
        $query =  $this->db->get()->result_array();
       
        //print_r($query);exit; //troubleshooting somehting.
        
        //$query->result_array();
        foreach($query as $i=>$po_data) {

            $this->db->select('purchase_order_rows.*,packing_materials.name as item');
            $this->db->join('packing_materials', 'purchase_order_rows.item_id = packing_materials.id'); 
           // $this->db->from('purchase_order_rows');
            $this->db->where('purchase_order_rows.purchase_order_id', $po_data['id']);
            $images_query = $this->db->get('purchase_order_rows')->result_array();

           // Add the images array to the array entry for this product
           $query[$i]['po_details'] = $images_query;

        }
        //print_r($query);exit;
        return $query;
    }
    function actionPO($data,$old_id){
        $this->db->where('id', $old_id);
        //$this->requisitionDetails($old_id);
        if ($this->db->update('purchase_orders', $data)) {
        return true;
        }
        else { 
        return false;
        }

    }

       public function getListForGIR(){
        $this->db->select('purchase_orders.*,suppliers.supplier_name as supplier,requisition_slips.rs_for as po_for');
        $this->db->from('purchase_orders');
        $this->db->join('suppliers', 'purchase_orders.supplier_id = suppliers.id'); 
        $this->db->join('requisition_slips', 'purchase_orders.requisition_slip_id = requisition_slips.id'); 
        //$this->db->join('purchase_order_rows', 'purchase_orders.id = purchase_order_rows.purchase_order_id'); 

        $this->db->where(['purchase_orders.flag'=>'0','purchase_orders.gir_status'=>'0']);

        //$this->db->or_where(['purchase_orders.flag'=>'0','purchase_orders.gir_status'=>'0','purchase_orders.purchase_indent'=>'1']);

        $this->db->order_by('purchase_orders.id','ASC');
        $query =  $this->db->get()->result_array();
       
        //print_r($query);exit; //troubleshooting somehting.
        //print_r($this->db->last_query());exit;
        //$query->result_array();
        foreach($query as $i=>$po_data) {

            $this->db->select('purchase_order_rows.*,packing_materials.name as item,packing_materials.unit_name as unit,packing_materials.code as code');
            $this->db->join('packing_materials', 'purchase_order_rows.item_id = packing_materials.id'); 
           // $this->db->from('purchase_order_rows');
            $this->db->where('purchase_order_rows.purchase_order_id', $po_data['id']);
            $images_query = $this->db->get('purchase_order_rows')->result_array();

           // Add the images array to the array entry for this product
           $query[$i]['po_details'] = $images_query;

        }
        //print_r($query);exit;
        return $query;
    }
	 public function getListForRMGIR(){
        $this->db->select('purchase_orders.*,suppliers.supplier_name as supplier,requisition_slips.rs_for as po_for');
        $this->db->from('purchase_orders');
        $this->db->join('suppliers', 'purchase_orders.supplier_id = suppliers.id'); 
        $this->db->join('requisition_slips', 'purchase_orders.requisition_slip_id = requisition_slips.id'); 
        //$this->db->join('purchase_order_rows', 'purchase_orders.id = purchase_order_rows.purchase_order_id'); 

        $this->db->where(['purchase_orders.flag'=>'0','purchase_orders.gir_status'=>'0']);

        //$this->db->or_where(['purchase_orders.flag'=>'0','purchase_orders.gir_status'=>'0','purchase_orders.purchase_indent'=>'1']);

        $this->db->order_by('purchase_orders.id','ASC');
        $query =  $this->db->get()->result_array();
       
        //print_r($query);exit; //troubleshooting somehting.
        //print_r($this->db->last_query());exit;
        //$query->result_array();
        foreach($query as $i=>$po_data) {

            $this->db->select('purchase_order_rows.*,packing_materials.name as item,packing_materials.unit_name as unit,packing_materials.code as code');
            $this->db->join('packing_materials', 'purchase_order_rows.item_id = packing_materials.id'); 
           // $this->db->from('purchase_order_rows');
            $this->db->where('purchase_order_rows.purchase_order_id', $po_data['id']);
            $images_query = $this->db->get('purchase_order_rows')->result_array();

           // Add the images array to the array entry for this product
           $query[$i]['po_details'] = $images_query;

        }
        //print_r($query);exit;
        return $query;
    }

    //----------- Approved Requisition List --------------------
     public function getApprovedRequisitions(){
        $this->db->select('requisition_slips.*,emp1.name as requestor,emp2.name as approver,emp3.name as rejector,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name');
        $this->db->from('requisition_slips');
        $this->db->join('employees as emp1', 'requisition_slips.created_by = emp1.id','left'); 
        $this->db->join('employees as emp2', 'requisition_slips.approved_by = emp2.id','left'); 
        $this->db->join('employees as emp3', 'requisition_slips.rejected_by = emp3.id','left'); 
        $this->db->join('finish_goods ', 'requisition_slips.finish_good_id = finish_goods.id','left');
        $this->db->where(['requisition_slips.flag'=>'0','requisition_slips.po_flag'=>'0','requisition_slips.approved_status'=>'Approved','requisition_slips.issue_completed'=>'0']);
        $this->db->order_by('requisition_slips.id','ASC');
        $query =  $this->db->get()->result_array();
        //print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('requisition_slip_rows.*,packing_materials.name as item,packing_materials.unit_name as unit,packing_materials.code as code');
            $this->db->join('packing_materials', 'requisition_slip_rows.item_id = packing_materials.id'); 
            $this->db->where(['requisition_slip_rows.requisition_slip_id'=> $po_data['id'],'requisition_slip_rows.order_pending_qty >'=>'0']);
            $images_query = $this->db->get('requisition_slip_rows')->result_array();

           $query[$i]['requisition_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    }
     public function getApprovedRequisitionsPO($id){
        $this->db->select('requisition_slips.*,emp1.name as requestor,emp2.name as approver,emp3.name as rejector,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name');
        $this->db->from('requisition_slips');
        $this->db->join('employees as emp1', 'requisition_slips.created_by = emp1.id','left'); 
        $this->db->join('employees as emp2', 'requisition_slips.approved_by = emp2.id','left'); 
        $this->db->join('employees as emp3', 'requisition_slips.rejected_by = emp3.id','left'); 
        $this->db->join('finish_goods ', 'requisition_slips.finish_good_id = finish_goods.id','left');
        $this->db->where(['requisition_slips.id'=>$id,'requisition_slips.flag'=>'0','requisition_slips.po_flag'=>'0','requisition_slips.approved_status'=>'Approved','requisition_slips.issue_completed'=>'0']);
        $this->db->order_by('requisition_slips.id','ASC');
        $query =  $this->db->get()->result_array();
        //print_r($query);exit; 
        //$query->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('requisition_slip_rows.*,packing_materials.name as item,packing_materials.unit_name as unit,packing_materials.code as code');
            $this->db->join('packing_materials', 'requisition_slip_rows.item_id = packing_materials.id'); 
            $this->db->where(['requisition_slip_rows.requisition_slip_id'=> $po_data['id'],'requisition_slip_rows.order_pending_qty >'=>'0']);
            $images_query = $this->db->get('requisition_slip_rows')->result_array();

           $query[$i]['requisition_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    }

    function deletePO($id){
        $data=array('flag'=>'1');
        $this->db->set('flag','flag',false);
        $this->db->where('id',$id);
        if($this->db->update('purchase_orders', $data)){
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
        $productname = array(); 
       // $productname[''] = 'Select Category...'; 
        foreach($result as $r) { 
            $productname[$r['category_name']] = $r['category_name']; 
        } 
        
        return $productname; 
    }

    function getItems() { 
       $result = $this->db->select('id, item_name')->from('item_masters')->where('flag','0')->get()->result_array(); 
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


  /*  public function getById($id) {
         $this->db->select('purchase_orders.*,purchase_order_rows.*');
        $this->db->from('purchase_orders');
        //$this->db->join('suppliers', 'purchase_orders.supplier_id = suppliers.id', 'left'); 
        $this->db->join('purchase_order_rows', 'purchase_orders.id = purchase_order_rows.id', 'left'); 
        $this->db->where('purchase_orders.id',$id);
        $query = $this->db->get();
        return $query->result_array();

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    } */ 

       public function getById($id){
        $this->db->select('purchase_orders.*,suppliers.supplier_name as supplier,suppliers.prefix as prefix,suppliers.address as address,suppliers.contact_person as c_person,suppliers.vendor_code as vendor_code,suppliers.mobile_no as mobile_no,suppliers.email as email');
        $this->db->from('purchase_orders');
        $this->db->join('suppliers', 'purchase_orders.supplier_id = suppliers.id'); 
        $this->db->where('purchase_orders.id',$id);
        //$this->db->order_by('purchase_orders.id','ASC');
        $query =  $this->db->get()->result_array();
       
        foreach($query as $i=>$po_data) {
			$this->db->select('purchase_order_rows.*,packing_materials.name as item,packing_materials.unit_name as unit,packing_materials.code as code');
            $this->db->join('packing_materials', 'purchase_order_rows.item_id = packing_materials.id','left');
            $this->db->where('purchase_order_rows.purchase_order_id', $po_data['id']);
			
            $images_query = $this->db->get('purchase_order_rows')->result_array();

           $query[$i]['po_details'] = $images_query;

           foreach($query[$i]['po_details'] as $i=>$po_data1) {
             //print_r($po_data);exit;
            //$req_data=[];
            $this->db->select('order_qty,order_pending_qty');
            $this->db->where(['requisition_slip_rows.id'=>$po_data1['requisition_slip_row_id']]);
            $req_data=$this->db->get('requisition_slip_rows')->row_array();
            $query[$i]['order_qty'] = $req_data['order_qty'];
            $query[$i]['order_pending_qty'] = $req_data['order_pending_qty'];
            //$data[$i] = $total_in;
            }
        }
        //print_r($query);exit;
        return $query;
    }

     function getEmployees() { 
        $result = $this->db->select('id, name')->from('employees')->where('flag','0')->get()->result_array(); 
        return $result; 
    }
    function getDepartments() { 
        $result = $this->db->select('id, department_name,department_code')->from('departments')->where('flag','0')->get()->result_array(); 
              return $result; 
    } 

	}

?>