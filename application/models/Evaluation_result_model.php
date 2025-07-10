<?php

Class Evaluation_result_model extends MY_Model {
    private $table = 'evaluation_result';
    private $detailTable = 'evaluation_result_details';

 public function __construct() {
        parent::__construct();
    }
// Insert registration data in database
public function er_insert($data) {

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
 if ($this->input->post('er_id_old')):
        $id = $this->input->post('er_id_old');
        $this->db->where('id', $id);
        $this->db->update($this->table,$data);
    else:
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();
    endif;

    $this->erDetails($id);
    //$this->updateSupplierGrade($data['supplier_id']);


    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }
}
/************** PO Details Insertion ******************/

 public function erDetails($id) {
        $this->db->where('evaluation_result_id', $id);
        $this->db->delete($this->detailTable);   
        if ($this->input->post('evaluation_criteria_id')):
            foreach ($this->input->post('evaluation_criteria_id') as $key => $value) :
                $this->db->set('evaluation_result_id', $id);
                $this->db->set('evaluation_criteria_id', $value);
                $this->db->set('marks_obtained', $this->input->post('marks_obtained')[$key]);
                $this->db->insert($this->detailTable);
            endforeach;
        endif;                  

    }

/******************* Update Supplier Grade ********************/
    function updateSupplierGrade($data,$supplier_id){
            $this->db->select('*');
            $this->db->from('suppliers');
            $this->db->where('id', $supplier_id);
            if($this->db->update('suppliers', $data)){
                return true;
            }
        }

/******************* Update Transporter Grade ********************/
    function updateTransporterGrade($data,$transporter_id){
            $this->db->select('*');
            $this->db->from('transporters');
            $this->db->where('id', $transporter_id);
            if($this->db->update('transporters', $data)){
                return true;
            }
        }

/******************* Update Service Provider Grade ********************/
    function updateSProviderGrade($data,$service_provider_id){
            $this->db->select('*');
            $this->db->from('service_providers');
            $this->db->where('id', $service_provider_id);
            if($this->db->update('service_providers', $data)){
                return true;
            }
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

/******************* edit rmcode ********************/

public function editER($data,$old_id){
    $this->db->where('id', $old_id);
    $this->db->update($this->table, $data);
    $this->erDetails($old_id);
    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }

}

// Fitered Data for evaluations //
   public function evaluations_list_by_filter($conditions){
       $this->db->select('evaluation_result.*,suppliers.supplier_name as supplier_name,suppliers.address as saddress,suppliers.contact_person as s_person,suppliers.mobile_no as s_mobile,categories.category_name as category,');
        $this->db->from($this->table);
        $this->db->join('suppliers', 'evaluation_result.supplier_id = suppliers.id','left');
        $this->db->join('categories', 'evaluation_result.categories_id = categories.id','left');  
        //$this->db->join('gir_register_rows', 'evaluation_result.id = gir_register_rows.purchase_order_id'); 
        if($conditions['supplier_id'] !="0")
               $this->db->where('evaluation_result.supplier_id',$conditions['supplier_id'],'both');

            if($conditions['categories_id'] !="0")
               $this->db->where('evaluation_result.categories_id',$conditions['categories_id'],'both');
            if($conditions['category_of_approval'] !="No")
               $this->db->where('evaluation_result.approval_grade', $conditions['category_of_approval'], 'both');
             if($conditions['from_date']!='1970-01-01')
                $this->db->where('evaluation_result.date >=',$conditions['from_date']); 
             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('evaluation_result.date <=',$conditions['upto_date']); 
            
        $this->db->where(['evaluation_result.flag'=>'0','evaluation_result.supplier_id<>'=>' ']);
        $this->db->order_by('evaluation_result.id','ASC');
        $query =  $this->db->get()->result_array();
        //print_r($this->db->last_query());  exit;
        //print_r($query);exit; //troubleshooting somehting.
        
        //$query->result_array();
        foreach($query as $i=>$er_data) {

            $this->db->select('evaluation_result_details.*,evaluation_criteria.ec_name as criteria,');
            $this->db->join('evaluation_criteria', 'evaluation_result_details.evaluation_criteria_id = evaluation_criteria.id'); 
           // $this->db->from('gir_register_rows');
            $this->db->where('evaluation_result_details.evaluation_result_id', $er_data['id']);
            $images_query = $this->db->get($this->detailTable)->result_array();

           // Add the images array to the array entry for this product
           $query[$i]['er_details'] = $images_query;

        }
        //print_r($query);exit;
        return $query;
   }
   public function getEVList(){
        $this->db->select('evaluation_result.*,suppliers.supplier_name as supplier_name,suppliers.address as saddress,suppliers.contact_person as s_person,suppliers.mobile_no as s_mobile,categories.category_name as category');
        $this->db->from($this->table);
        $this->db->join('suppliers', 'evaluation_result.supplier_id = suppliers.id','left');
        $this->db->join('categories', 'evaluation_result.categories_id = categories.id','left');  
        //$this->db->join('gir_register_rows', 'evaluation_result.id = gir_register_rows.purchase_order_id'); 
        $this->db->where(['evaluation_result.flag'=>'0','evaluation_result.supplier_id<>'=>' ']);
        $this->db->order_by('evaluation_result.id','ASC');
        $query =  $this->db->get()->result_array();
       
        //print_r($query);exit; //troubleshooting somehting.
        
        //$query->result_array();
        foreach($query as $i=>$er_data) {

            $this->db->select('evaluation_result_details.*,evaluation_criteria.ec_name as criteria,');
            $this->db->join('evaluation_criteria', 'evaluation_result_details.evaluation_criteria_id = evaluation_criteria.id'); 
           // $this->db->from('gir_register_rows');
            $this->db->where('evaluation_result_details.evaluation_result_id', $er_data['id']);
            $images_query = $this->db->get($this->detailTable)->result_array();

           // Add the images array to the array entry for this product
           $query[$i]['er_details'] = $images_query;

        }
        //print_r($query);exit;
        return $query;
    }
    public function getTPEVList(){
        $this->db->select('evaluation_result.*,transporters.transporter_name as transporter_name,transporters.address as taddress,transporters.contact_person as t_person,transporters.mobile_no as t_mobile');
        $this->db->from($this->table);
        $this->db->join('suppliers', 'evaluation_result.supplier_id = suppliers.id','left');
        $this->db->join('transporters', 'evaluation_result.transporter_id = transporters.id','left');  
        //$this->db->join('gir_register_rows', 'evaluation_result.id = gir_register_rows.purchase_order_id'); 
        $this->db->where(['evaluation_result.flag'=>'0','evaluation_result.transporter_id<>'=>' ']);
        $this->db->order_by('evaluation_result.id','ASC');
        $query =  $this->db->get()->result_array();
       
        //print_r($query);exit; //troubleshooting somehting.
        
        //$query->result_array();
        foreach($query as $i=>$er_data) {

            $this->db->select('evaluation_result_details.*,evaluation_criteria.ec_name as criteria,');
            $this->db->join('evaluation_criteria', 'evaluation_result_details.evaluation_criteria_id = evaluation_criteria.id'); 
           // $this->db->from('gir_register_rows');
            $this->db->where('evaluation_result_details.evaluation_result_id', $er_data['id']);
            $images_query = $this->db->get($this->detailTable)->result_array();

           // Add the images array to the array entry for this product
           $query[$i]['er_details'] = $images_query;

        }
        //print_r($query);exit;
        return $query;
    }
        public function evaluations_tplist_by_filter($conditions){
        $this->db->select('evaluation_result.*,suppliers.supplier_name as supplier,transporters.transporter_name as transporter');
        $this->db->from($this->table);
        $this->db->join('suppliers', 'evaluation_result.supplier_id = suppliers.id','left');
        $this->db->join('transporters', 'evaluation_result.transporter_id = transporters.id','left');  
        //$this->db->join('gir_register_rows', 'evaluation_result.id = gir_register_rows.purchase_order_id'); 
        
         if($conditions['transporter_id'] !="0")
               $this->db->where('evaluation_result.transporter_id',$conditions['transporter_id'],'both');

            //if($conditions['categories_id'] !="0")
               //$this->db->where('evaluation_result.categories_id',$conditions['categories_id'],'both');
            if($conditions['category_of_approval'] !="No")
               $this->db->where('evaluation_result.approval_grade', $conditions['category_of_approval'], 'both');
             if($conditions['from_date']!='1970-01-01')
                $this->db->where('evaluation_result.date >=',$conditions['from_date']); 
             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('evaluation_result.date <=',$conditions['upto_date']); 
        
        $this->db->where(['evaluation_result.flag'=>'0','evaluation_result.transporter_id<>'=>' ']);
        $this->db->order_by('evaluation_result.id','ASC');
        $query =  $this->db->get()->result_array();
       
        //print_r($query);exit; //troubleshooting somehting.
        
        //$query->result_array();
        foreach($query as $i=>$er_data) {

            $this->db->select('evaluation_result_details.*,evaluation_criteria.ec_name as criteria,');
            $this->db->join('evaluation_criteria', 'evaluation_result_details.evaluation_criteria_id = evaluation_criteria.id'); 
           // $this->db->from('gir_register_rows');
            $this->db->where('evaluation_result_details.evaluation_result_id', $er_data['id']);
            $images_query = $this->db->get($this->detailTable)->result_array();

           // Add the images array to the array entry for this product
           $query[$i]['er_details'] = $images_query;

        }
        //print_r($query);exit;
        return $query;
    }
        public function Filter_bygetSPEVList($conditions){
        $this->db->select('evaluation_result.*,service_providers.service_provider_name as sp_name,service_providers.address as saddress,service_providers.contact_person as s_person,service_providers.mobile_no as s_mobile,categories.category_name as category');
        $this->db->from($this->table);
        $this->db->join('service_providers', 'evaluation_result.service_provider_id = service_providers.id');
        $this->db->join('categories', 'evaluation_result.categories_id = categories.id');  
        if($conditions['service_provider_id'] !="0")
               $this->db->like('evaluation_result.service_provider_id',$conditions['service_provider_id'],'both');

            if($conditions['categories_id'] !="0")
               $this->db->like('evaluation_result.categories_id',$conditions['categories_id'],'both');
            if($conditions['category_of_approval'] !="No")
               $this->db->like('evaluation_result.approval_grade', $conditions['category_of_approval'], 'both');
        $this->db->where(['evaluation_result.flag'=>'0','evaluation_result.service_provider_id<>'=>' ']);
        $this->db->order_by('evaluation_result.id','ASC');
        $query =  $this->db->get()->result_array();
       
        //print_r($query);exit; //troubleshooting somehting.
        
        //$query->result_array();
        foreach($query as $i=>$er_data) {

            $this->db->select('evaluation_result_details.*,evaluation_criteria.ec_name as criteria,');
            $this->db->join('evaluation_criteria', 'evaluation_result_details.evaluation_criteria_id = evaluation_criteria.id'); 
           // $this->db->from('gir_register_rows');
            $this->db->where('evaluation_result_details.evaluation_result_id', $er_data['id']);
            $images_query = $this->db->get($this->detailTable)->result_array();

           // Add the images array to the array entry for this product
           $query[$i]['er_details'] = $images_query;

        }
        //print_r($query);exit;
        return $query;
    }

    public function getSPEVList(){
        $this->db->select('evaluation_result.*,service_providers.service_provider_name as sp_name,service_providers.address as saddress,service_providers.contact_person as s_person,service_providers.mobile_no as s_mobile,categories.category_name as category');
        $this->db->from($this->table);
        $this->db->join('service_providers', 'evaluation_result.service_provider_id = service_providers.id');
        $this->db->join('categories', 'evaluation_result.categories_id = categories.id');  
        //$this->db->join('gir_register_rows', 'evaluation_result.id = gir_register_rows.purchase_order_id'); 
        $this->db->where(['evaluation_result.flag'=>'0','evaluation_result.service_provider_id<>'=>' ']);
        $this->db->order_by('evaluation_result.id','ASC');
        $query =  $this->db->get()->result_array();
       
        //print_r($query);exit; //troubleshooting something.
        
        //$query->result_array();
        foreach($query as $i=>$er_data) {

            $this->db->select('evaluation_result_details.*,evaluation_criteria.ec_name as criteria,');
            $this->db->join('evaluation_criteria', 'evaluation_result_details.evaluation_criteria_id = evaluation_criteria.id'); 
           // $this->db->from('gir_register_rows');
            $this->db->where('evaluation_result_details.evaluation_result_id', $er_data['id']);
            $images_query = $this->db->get($this->detailTable)->result_array();

           // Add the images array to the array entry for this product
           $query[$i]['er_details'] = $images_query;

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

    function getSuppliers($categories_id= NULL)
    { 
        $result = $this->db->select('id, supplier_name,vendor_code')->from('suppliers')->where(['flag'=>'0','categories_id'=>$categories_id])->get()->result_array(); 
        //print_r($result);exit;
        //order_by('category_name', 'asc');
        /*$suppliername = array(); 
        $suppliername[''] = 'Select Supplier...'; 
        foreach($result as $r) { 
            $suppliername[$r['id']] = $r['supplier_name'].'('.$r['vendor_code'].')'; 
        } */
        return $result; 
    }

    function getTransporters()
    { 
        $result = $this->db->select('id, transporter_name,vendor_code')->from('transporters')->where(['flag'=>'0'])->get()->result_array(); 
        //print_r($result);exit;
        //order_by('category_name', 'asc');
        /*$suppliername = array(); 
        $suppliername[''] = 'Select Supplier...'; 
        foreach($result as $r) { 
            $suppliername[$r['id']] = $r['supplier_name'].'('.$r['vendor_code'].')'; 
        } */
        return $result; 
    }
    function getSProviders($categories_id= NULL)
    { 
        $result = $this->db->select('id, service_provider_name,service_provider_code')->from('service_providers')->where(['flag'=>'0','categories_id'=>$categories_id])->get()->result_array(); 
        //print_r($result);exit;
        //order_by('category_name', 'asc');
        /*$suppliername = array(); 
        $suppliername[''] = 'Select Supplier...'; 
        foreach($result as $r) { 
            $suppliername[$r['id']] = $r['supplier_name'].'('.$r['vendor_code'].')'; 
        } */
        return $result; 
    }
    
    function getCategories() { 
       $result = $this->db->select('id, category_name')->from('categories')->where(['flag'=>'0'])->get()->result_array(); 
        return $productname; 
    }

    function getItems() { 
       $result = $this->db->select('id, item_name')->from('item_masters')->where('flag','0')->get()->result_array(); 
    
        return $result; 
    }
	  public function getById($id){
       $this->db->select('evaluation_result.*,suppliers.supplier_name as supplier,
	   suppliers.contact_person as contact_person1,suppliers.supplier_type as supplier_type,suppliers.address as address1 ,
	   transporters.transporter_name as transporter,transporters.contact_person as contact_person2,transporters.transporter_type as transporter_type,transporters.address as address2,
	   service_providers.service_provider_name as sprovider,service_providers.contact_person as contact_person3,service_providers.service_provider_type as service_provider_type,service_providers.address as address3,categories.category_name as category');
        $this->db->from($this->table);
        $this->db->join('suppliers', 'evaluation_result.supplier_id = suppliers.id','left'); 
		$this->db->join('categories', 'evaluation_result.categories_id = categories.id','left'); 
        $this->db->join('transporters', 'evaluation_result.transporter_id = transporters.id','left');  
        $this->db->join('service_providers', 'evaluation_result.service_provider_id = service_providers.id','left');  
        $this->db->where('evaluation_result.id',$id);
        //$this->db->order_by('evaluation_result.id','ASC');
        $query =  $this->db->get()->result_array();
         foreach($query as $i=>$er_data) {

            $this->db->select('evaluation_result_details.*,evaluation_criteria.ec_name as criteria,evaluation_criteria.ec_type as ec_type');
            $this->db->join('evaluation_criteria', 'evaluation_result_details.evaluation_criteria_id = evaluation_criteria.id'); 
           // $this->db->from('gir_register_rows');
		   //$this->db->where(['evaluation_criteria.flag'=>'0','ec_type'=>'Supplier']);
	
            $this->db->where('evaluation_result_details.evaluation_result_id', $er_data['id']);
            $images_query = $this->db->get($this->detailTable)->result_array();

           // Add the images array to the array entry for this product
           $query[$i]['er_details'] = $images_query;

        }
       /* foreach($query as $i=>$po_data) {
            $this->db->where('evaluation_result_details.evaluation_result_id', $po_data['id']);
            $images_query = $this->db->get('evaluation_result_details')->result_array();

           $query[$i]['er_details'] = $images_query;
        }*/
        //print_r($query);exit;
        return $query;
    }

    }

?>