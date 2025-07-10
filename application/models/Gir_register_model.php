<?php

Class Gir_Register_model extends MY_Model {
    private $table = 'gir_registers';
    private $detailTable = 'gir_register_rows';
  
 public function __construct() {
        parent::__construct();
      }
// Insert registration data in database
public function gir_insert($data) {

// Query to check whether username already exist or not
/*$condition = "po_number =" . "'" . $data['po_number'] . "'";

$this->db->select('*');
$this->db->from($this->table);
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();
//print_r($data);exit;
if ($query->num_rows() == 0) {
*/// Query to insert data in database
 if ($this->input->post('gir_id_old')):
        $id = $this->input->post('gir_id_old');
        $this->db->where('id', $id);
        $this->db->update($this->table,$data);
    else:
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();
    endif;

    $this->girDetails($id);


    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }
}

/******************* edit rmcode ********************/

public function editGIR($data,$old_id){
    $this->db->where('id', $old_id);
    $this->db->update($this->table, $data);
    $this->girDetails($old_id);
    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }

}
/************** GIR Details Insertion ******************/

 public function girDetails($id) {
        $this->db->where('gir_register_id', $id);
        $this->db->delete($this->detailTable);   
        if ($this->input->post('item_id')):
            foreach ($this->input->post('item_id') as $key => $value) :
                $this->db->set('gir_register_id', $id);
                $this->db->set('item_id', $value);
                $this->db->set('quantity', $this->input->post('qty')[$key]);
                $this->db->set('po_row_id', $this->input->post('purchase_order_row_id')[$key]);
                $this->db->set('description', $this->input->post('description')[$key]);
                $this->db->insert($this->detailTable);
                //$po_row_id=$this->input->post('purchase_order_row_id')[$key];
                //$po_ordered_qty=$this->input->post('ordered_qty')[$key];
                $gir_row_id = $this->db->insert_id();
                $po_row_id = $this->input->post('purchase_order_row_id')[$key];
                $employee_id=$this->login_id;
                $department_id=$this->department_id;
                $item_id= $value;
                $quantity= $this->input->post('qty')[$key];
                $transaction_date=date('Y-m-d');
                $this->insertStockRegister($id,$gir_row_id,$employee_id,$department_id,$transaction_date,$item_id,$quantity,$status);

               // $po_pending_qty=$this->input->post('pending_qty')[$key];
                //$this->updatePurchaseOrder($po_row_id,$po_ordered_qty);
                $po_data=$this->getPendingPOquantity($po_row_id);
                $old_gir_qty=$po_data['gir_qty'];
                $new_gir_qty=$old_gir_qty+$quantity;
                $data=array('gir_qty'=>$new_gir_qty);
                $this->db->where(['id'=>$po_row_id]);
                $this->db->update('purchase_order_rows',$data);
            endforeach;
        endif;                  
    }
    function getPendingPOquantity($po_row_id){
    //$count=0;
    $this->db->select('gir_qty');
    $this->db->from('purchase_order_rows');
    $this->db->where('id',$po_row_id);
    $query=$this->db->get()->row_array();
    //print_r($query);exit;
    //$count=$query['pending_qty'];
    return $query;
   
    }
       /************** Inser/Update StockRegisters ******************/
    function insertStockRegister($id,$gir_row_id,$employee_id,$department_id,$transaction_date,$item_id,$quantity){
              $data=array('gir_register_id'=>$id,'gir_register_row_id'=>$gir_row_id,'transaction_date'=>$transaction_date,'employee_id'=>$employee_id,'department_id'=>$department_id,'item_id'=>$item_id,'quantity'=>$quantity,'status'=>'In','created_by'=>$employee_id);
              $this->db->insert('stock_registers', $data);
    }

    function updatePurchaseCompleted($po_id){
        $data=array('gir_status'=>'1');
        $this->db->where(['id'=>$po_id]);
        $this->db->update('purchase_orders',$data);
    }

/******************* Row Count for Voucher Number ********************/

 function rowcount(){
    $count=0;
    $this->db->select_max('gir_no');
    $this->db->from($this->table);
    $query=$this->db->get()->result_array();
    //$query->result_array();
    $count=$query[0]['gir_no'];
    //print_r($count);exit;
    return $count;
   
}


function getUnits() { 
        $result = $this->db->select('id,unit_name')->from('unit')->where('flag','0')->get()->result_array(); 
        //$result = $this->db->select('id, category_name')->get('categories')->result_array(); 
        //print_r($result);exit;
        //order_by('category_name', 'asc');
        /*$productname = array(); 
       // $productname[''] = 'Select Category...'; 
        foreach($result as $r) { 
            $productname[$r['id']] = $r['category_name']; 
        } */
        
        return $result; 
    } 
// Read data from database to show data in admin page

   public function getListGeneral(){
        $this->db->select('gir_registers.*,suppliers.supplier_name as supplier,categories.category_name as category');
        $this->db->from($this->table);
        $this->db->join('suppliers', 'gir_registers.supplier_id = suppliers.id','left'); 
		    $this->db->join('categories', 'gir_registers.categories_id = categories.id','left'); 
		
        //$this->db->join('gir_register_rows', 'gir_registers.id = gir_register_rows.purchase_order_id'); 
        //$this->db->where(['gir_registers.flag'=>'0','gir_registers.categories_id !='=>'1']);
		    $this->db->where('gir_registers.flag','0');
        $this->db->order_by('gir_registers.id','ASC');
        $query =  $this->db->get()->result_array();
       
        //print_r($query);exit; //troubleshooting somehting.
        
        //$query->result_array();
        foreach($query as $i=>$gir_data) {

            $this->db->select('gir_register_rows.*,packing_materials.name as item,');
            $this->db->join('packing_materials', 'gir_register_rows.item_id = packing_materials.id'); 
           // $this->db->from('gir_register_rows');
            $this->db->where('gir_register_rows.gir_register_id', $gir_data['id']);
            $images_query = $this->db->get($this->detailTable)->result_array();

           // Add the images array to the array entry for this product
           $query[$i]['gir_details'] = $images_query;

        }
        //print_r($query);exit;
        return $query;
    }
       public function getListRMgir(){
        $this->db->select('gir_registers.*,suppliers.supplier_name as supplier,');
        $this->db->from($this->table);
        $this->db->join('suppliers', 'gir_registers.supplier_id = suppliers.id','left'); 
        //$this->db->join('transporters', 'gir_registers.transporter_id = transporters.id','left'); 
        //$this->db->join('gir_register_rows', 'gir_registers.id = gir_register_rows.purchase_order_id'); 
        $this->db->where(['gir_registers.flag'=>'0','gir_registers.categories_id ='=>'1']);
        $this->db->order_by('gir_registers.id','ASC');
        $query =  $this->db->get()->result_array();
       
        //print_r($query);exit; //troubleshooting somehting.
        
        //$query->result_array();
        foreach($query as $i=>$gir_data) {

            $this->db->select('gir_register_rows.*,packing_materials.name as item,');
            $this->db->join('packing_materials', 'gir_register_rows.item_id = packing_materials.id'); 
           // $this->db->from('gir_register_rows');
            $this->db->where('gir_register_rows.gir_register_id', $gir_data['id']);
            $images_query = $this->db->get($this->detailTable)->result_array();

           // Add the images array to the array entry for this product
           $query[$i]['gir_details'] = $images_query;

        }
        //print_r($query);exit;
        return $query;
    }

    function deletegir($id){
        $data=array('flag'=>'1');
        $this->db->set('flag','flag',false);
        $this->db->where('id',$id);
        if($this->db->update($this->table, $data)){
            return true;
        }
    }

    function getSuppliers()
    { 
       // $result = $this->db->select('id, supplier_name,vendor_code')->get('suppliers')->result_array(); 
        $result = $this->db->select('id, supplier_name')->from('suppliers')->where(['flag'=>'0'])->get()->result_array(); 
        return $result; 
        //print_r($result);exit;
        //order_by('category_name', 'asc');
       /*  $suppliername = array(); 
        $suppliername[''] = 'Select Supplier...'; 
        foreach($result as $r) { 
            $suppliername[$r['id']] = $r['supplier_name'].'('.$r['vendor_code'].')'; 
        }  */
       // return $result; 
    }
    function getTransporters()
    { 
       // $result = $this->db->select('id, supplier_name,vendor_code')->get('suppliers')->result_array(); 
        $result = $this->db->select('id, transporter_name')->from('transporters')->where('flag','0')->get()->result_array(); 
       // return $result; 
        //print_r($result);exit;
        //order_by('category_name', 'asc');
       /*  $transportername = array(); 
       // $transportername[''] = 'Select Supplier...'; 
        foreach($result as $r) { 
            $transportername[$r['id']] = $r['transporter_name']; 
        }   */
       return $result; 
    }
    function getCategories() { 
       $result = $this->db->select('id, category_name')->from('categories')->where(['flag'=>'0','show_flag'=>'0'])->get()->result_array(); 
	  // $result = $this->db->select('id, category_name')->from('categories')->where('flag','0')->get()->result_array(); 
        //print_r($result);exit;
        //order_by('category_name', 'asc');
       /*  $productname = array(); 
       // $productname[''] = 'Select Category...'; 
        foreach($result as $r) { 
            $productname[$r['id']] = $r['category_name']; 
        } 
         */
        return $result; 
    }
	function getGirCode(){
      $count=0;
      $this->db->select_max('gir_no');
      $this->db->from('gir_registers');
      $query=$this->db->get()->row_array();
      //print_r($query['vendor_code']);exit;
      $count=$query['gir_no']+1;
      return $count;
	}
	public function CheckGirCode($code)
		{
		    $this->db->select('gir_no');
		    $this->db->from('gir_registers');
		    $this->db->where(['gir_no'=>$code]);
		    $query=$this->db->get()->num_rows();    
		    return $query;
		   
		}
    function getItems() { 
       $result = $this->db->select('id, name')->from('packing_materials')->where('flag','0')->get()->result_array(); 
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

    function getRMItems() { 
       $result = $this->db->select('id, name')->from('packing_materials')->where(['flag'=>'0','categories_id'=>'1'])->get()->result_array(); 
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
         $this->db->select('gir_registers.*,gir_register_rows.*');
        $this->db->from('gir_registers');
        //$this->db->join('suppliers', 'gir_registers.supplier_id = suppliers.id', 'left'); 
        $this->db->join('gir_register_rows', 'gir_registers.id = gir_register_rows.id', 'left'); 
        $this->db->where('gir_registers.id',$id);
        $query = $this->db->get();
        return $query->result_array();

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    } */ 

       public function getById($id){
        $this->db->select('gir_registers.*,suppliers.supplier_name as supplier,categories.category_name as category,transporters.transporter_name as transporter');
        $this->db->from($this->table);
        $this->db->join('suppliers', 'gir_registers.supplier_id = suppliers.id','left'); 
        $this->db->join('categories', 'gir_registers.categories_id = categories.id','left'); 
         $this->db->join('transporters', 'gir_registers.transporter_id = transporters.id','left'); 
        
        $this->db->where('gir_registers.id',$id);
        //$this->db->order_by('gir_registers.id','ASC');
        $query =  $this->db->get()->result_array();
       //print_r($query);exit;
        foreach($query as $i=>$po_data) {
			
            $this->db->select('gir_register_rows.*,packing_materials.name as item,unit.unit_name as unit');
            $this->db->join('packing_materials', 'gir_register_rows.item_id = packing_materials.id','left');
			$this->db->join('unit', 'gir_register_rows.unit_id = unit.id','left');
            $this->db->where('gir_register_rows.gir_register_id', $po_data['id']);
            $images_query = $this->db->get('gir_register_rows')->result_array();

           $query[$i]['gir_details'] = $images_query;
        }
       //print_r($query);exit;
        return $query;
    }
		public function gir_list_by_filter($conditions) 
		{
			//print_r($conditions);echo"<pre>";

			//$conditions['category_of_approval'];
			//$filter_by = "suppliers.id =" . "'" . $conditions['supplier_id'] . "'";
			$this->db->select('gir_registers.*,suppliers.supplier_name as supplier,categories.category_name as category');
			$this->db->from('gir_registers');
			$this->db->join('categories', 'gir_registers.categories_id = categories.id','left'); 
			$this->db->join('suppliers', 'gir_registers.supplier_id = suppliers.id','left'); 
		
					
			//$this->db->where(['suppliers.id'=>@$conditions['supplier_id'],'suppliers.categories_id'=>@$conditions['categories_id'],'suppliers.category_of_approval'=>@$conditions['category_of_approval']]);
			//if($conditions['supplier_id'] !="0")
		      // $this->db->like('suppliers.id',$conditions['supplier_id'],'both');

		    if($conditions['categories_id']!=0)
		       $this->db->where('gir_registers.categories_id',$conditions['categories_id'],'both');
		    if($conditions['supplier_id'] !=0)
				$this->db->where('gir_registers.supplier_id',$conditions['supplier_id'],'both');
			  if($conditions['gir_no'] !=0)
				$this->db->where('gir_registers.gir_no',$conditions['gir_no'],'both');
			 if($conditions['from_date']!='1970-01-01')
                $this->db->where('gir_registers.transaction_date >=',$conditions['from_date']); 
             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('gir_registers.transaction_date <=',$conditions['upto_date']); 
			$this->db->where('gir_registers.flag','0');
			$this->db->order_by("gir_registers.id", "asc");
			//print_r($this->db->last_query());  exit;
			$query =  $this->db->get()->result_array();
			//print_r($this->db->last_query());exit; 
			//print_r($query);exit;
              foreach($query as $i=>$gir_data) {

               $this->db->select('gir_register_rows.*,packing_materials.name as item');
			   $this->db->join('packing_materials', 'gir_register_rows.item_id = packing_materials.id','left');
			   $this->db->join('gir_registers', 'gir_register_rows.gir_register_id = gir_registers.id','left');

               // $this->db->from('gir_register_rows');
               $this->db->where('gir_register_rows.gir_register_id', $gir_data['id']);
               $images_query = $this->db->get($this->detailTable)->result_array();
		      // $this->db->like('gir_register_rows.gir_register_id',$conditions['gir_register_id'],'both');
               // Add the images array to the array entry for this product
               $query[$i]['gir_details'] = $images_query;

        }			
			//print_r($query);exit;
			return $query;

		}
		public function export_csv()
		{
			$this->db->select('*');
			$this->db->from('gir_registers');
			//$this->db->join('categories', 'transporters.categories_id = categories.id'); 
			$this->db->where('flag','0');
			$this->db->order_by("gir_no", "asc");
			$query =  $this->db->get()->result_array();
	
			return $query;
		}
		 function getAllSuppliers() { 
			$result = $this->db->select('id, supplier_name')->from('suppliers')->where(['flag'=>'0'])->get()->result_array(); 
			return $result; 
		}
		 function getAllRMSuppliers() { 
			$result = $this->db->select('id, supplier_name')->from('suppliers')->where(['flag'=>'0','categories_id'=>'1'])->get()->result_array(); 
			return $result; 
		}
		 function getGIRno() { 
			$result = $this->db->select('id, gir_no')->from('gir_registers')->where(['flag'=>'0'])->get()->result_array(); 
			return $result; 
		}
    }

?>