<?php

Class Material_return_model extends MY_Model {
    private $table = 'material_return_records';
    private $detailTable = 'material_return_record_rows';
  
 public function __construct() {
        parent::__construct();
      }
// Insert registration data in database
public function gir_insert($data) {

// Query to check whether username already exist or not

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
        $this->db->where('material_return_record_id', $id);
        $this->db->delete($this->detailTable);   
        if ($this->input->post('item_id')):
            foreach ($this->input->post('item_id') as $key => $value) :
                $this->db->set('material_return_record_id', $id);
                $this->db->set('item_id', $value);
                $this->db->set('quantity', $this->input->post('qty')[$key]);
                $this->db->set('status', $this->input->post('status')[$key]);
                $this->db->set('description', $this->input->post('description')[$key]);
                $this->db->insert($this->detailTable);
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
              $data=array('material_return_record_id'=>$id,'gir_register_row_id'=>$gir_row_id,'transaction_date'=>$transaction_date,'employee_id'=>$employee_id,'department_id'=>$department_id,'item_id'=>$item_id,'quantity'=>$quantity,'status'=>'In','created_by'=>$employee_id);
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
        $this->db->select('material_return_records.*,suppliers.supplier_name as supplier,categories.category_name as category');
        $this->db->from($this->table);
        $this->db->join('suppliers', 'material_return_records.supplier_id = suppliers.id','left'); 
		$this->db->join('categories', 'material_return_records.categories_id = categories.id','left'); 
		
        //$this->db->join('material_return_record_rows', 'material_return_records.id = material_return_record_rows.purchase_order_id'); 
        //$this->db->where(['material_return_records.flag'=>'0','material_return_records.categories_id !='=>'1']);
		    $this->db->where('material_return_records.flag','0');
        $this->db->order_by('material_return_records.id','ASC');
        $query =  $this->db->get()->result_array();
       
        //print_r($query);exit; //troubleshooting somehting.
        
        //$query->result_array();
        foreach($query as $i=>$gir_data) {

            $this->db->select('material_return_record_rows.*,packing_materials.name as item,packing_materials.unit_name as unit');
            $this->db->join('packing_materials', 'material_return_record_rows.item_id = packing_materials.id'); 
           // $this->db->from('material_return_record_rows');
            $this->db->where('material_return_record_rows.material_return_record_id', $gir_data['id']);
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
	function getMReturnCode(){
      $count=0;
      $this->db->select_max('voucher_code');
      $this->db->from('material_return_records');
      $query=$this->db->get()->row_array();
      //print_r($query['vendor_code']);exit;
      $count=$query['voucher_code']+1;
      return $count;
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

    function getMaterials() { 
       $result = $this->db->select('id, name')->from('packing_materials')->where(['flag'=>'0'])->get()->result_array(); 
        return $result; 
    }
 
       public function getById($id){
        $this->db->select('material_return_records.*,suppliers.supplier_name as supplier,categories.category_name as category,transporters.transporter_name as transporter');
        $this->db->from($this->table);
        $this->db->join('suppliers', 'material_return_records.supplier_id = suppliers.id','left'); 
        $this->db->join('categories', 'material_return_records.categories_id = categories.id','left'); 
         $this->db->join('transporters', 'material_return_records.transporter_id = transporters.id','left'); 
        
        $this->db->where('material_return_records.id',$id);
        //$this->db->order_by('material_return_records.id','ASC');
        $query =  $this->db->get()->result_array();
       //print_r($query);exit;
        foreach($query as $i=>$po_data) {
			
            $this->db->select('material_return_record_rows.*,packing_materials.name as item,packing_materials.unit_name as unit');
            $this->db->join('packing_materials', 'material_return_record_rows.item_id = packing_materials.id','left');
			//$this->db->join('unit', 'material_return_record_rows.unit_id = unit.id','left');
            $this->db->where('material_return_record_rows.material_return_record_id', $po_data['id']);
            $images_query = $this->db->get('material_return_record_rows')->result_array();

           $query[$i]['gir_details'] = $images_query;
        }
       //print_r($query);exit;
        return $query;
    }
        public function getGIRById($id){
        $this->db->select('material_return_records.*,suppliers.supplier_name as supplier,categories.category_name as category,transporters.transporter_name as transporter');
        $this->db->from($this->table);
        $this->db->join('suppliers', 'material_return_records.supplier_id = suppliers.id','left'); 
        $this->db->join('categories', 'material_return_records.categories_id = categories.id','left'); 
         $this->db->join('transporters', 'material_return_records.transporter_id = transporters.id','left'); 
        
        $this->db->where('material_return_records.id',$id);
        //$this->db->order_by('material_return_records.id','ASC');
        $query =  $this->db->get()->result_array();
       //print_r($query);exit;
        foreach($query as $i=>$po_data) {
            
            $this->db->select('material_return_record_rows.*,packing_materials.name as item,unit.unit_name as unit');
            $this->db->join('packing_materials', 'material_return_record_rows.item_id = packing_materials.id','left');
            $this->db->join('unit', 'material_return_record_rows.unit_id = unit.id','left');
            $this->db->where('material_return_record_rows.material_return_record_id', $po_data['id']);
            $images_query = $this->db->get('material_return_record_rows')->result_array();

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
			$this->db->select('material_return_records.*,suppliers.supplier_name as supplier,categories.category_name as category');
			$this->db->from('material_return_records');
			$this->db->join('categories', 'material_return_records.categories_id = categories.id','left'); 
			$this->db->join('suppliers', 'material_return_records.supplier_id = suppliers.id','left'); 
		
					
			//$this->db->where(['suppliers.id'=>@$conditions['supplier_id'],'suppliers.categories_id'=>@$conditions['categories_id'],'suppliers.category_of_approval'=>@$conditions['category_of_approval']]);
			//if($conditions['supplier_id'] !="0")
		      // $this->db->like('suppliers.id',$conditions['supplier_id'],'both');

		    if($conditions['categories_id']!=0)
		       $this->db->where('material_return_records.categories_id',$conditions['categories_id'],'both');
		    if($conditions['supplier_id'] !=0)
				$this->db->where('material_return_records.supplier_id',$conditions['supplier_id'],'both');
			  if($conditions['gir_no'] !=0)
				$this->db->where('material_return_records.voucher_code',$conditions['voucher_code'],'both');
			 if($conditions['from_date']!='1970-01-01')
                $this->db->where('material_return_records.transaction_date >=',$conditions['from_date']); 
             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('material_return_records.transaction_date <=',$conditions['upto_date']); 
			$this->db->where('material_return_records.flag','0');
			$this->db->order_by("material_return_records.id", "asc");
			//print_r($this->db->last_query());  exit;
			$query =  $this->db->get()->result_array();
			//print_r($this->db->last_query());exit; 
			//print_r($query);exit;
              foreach($query as $i=>$gir_data) {

               $this->db->select('material_return_record_rows.*,packing_materials.name as item,packing_materials.unit_name as unit');
			   $this->db->join('packing_materials', 'material_return_record_rows.item_id = packing_materials.id','left');
			   $this->db->join('material_return_records', 'material_return_record_rows.material_return_record_id = material_return_records.id','left');

               // $this->db->from('material_return_record_rows');
               $this->db->where('material_return_record_rows.material_return_record_id', $gir_data['id']);
               $images_query = $this->db->get($this->detailTable)->result_array();
		      // $this->db->like('material_return_record_rows.material_return_record_id',$conditions['material_return_record_id'],'both');
               // Add the images array to the array entry for this product
               $query[$i]['gir_details'] = $images_query;

        }			
			//print_r($query);exit;
			return $query;

		}
		public function export_csv()
		{
			$this->db->select('*');
			$this->db->from('material_return_records');
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
			$result = $this->db->select('id, voucher_code')->from('material_return_records')->where(['flag'=>'0'])->get()->result_array(); 
			return $result; 
		}
    }

?>