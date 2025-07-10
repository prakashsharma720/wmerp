<?php

Class Waste_material_model extends MY_Model {
    private $table = 'waste_material_records';
    private $detailTable = 'waste_material_record_details';
 public function __construct() {
        parent::__construct();
      }
// Insert registration data in database
 function wa_insert($data) {

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
/************** Waste Material Details Insertion ******************/

  function WorkDetails($id) {
        $this->db->where('waste_material_record_id', $id);
        $this->db->delete($this->detailTable);
             if ($this->input->post('waste_material_name')):
                foreach ($this->input->post('waste_material_name') as $key => $value) :
                    $this->db->set('waste_material_record_id', $id);
                    $this->db->set('waste_material_name', $value);
                    $this->db->set('service_provider_id', $this->input->post('service_provider_id')[$key]);
                    $this->db->set('quantity', $this->input->post('quantity')[$key]);
                    $this->db->set('unit', $this->input->post('unit')[$key]);
                    $this->db->insert($this->detailTable);
                endforeach;
            endif; 
    }

         
/******************* Row Count for Voucher Number ********************/


    function getVoucherCode(){
    $count=0;
    $this->db->select_max('voucher_code');
    $this->db->from($this->table);
    $this->db->where('flag','0');
    $query=$this->db->get()->row_array();
    //print_r($query['employee_code']);exit;
    $count=$query['voucher_code']+1;
    return $count;
   
    }

/******************* edit rs ********************/

 function editWaste_material($data,$old_id){
    $this->db->where('id', $old_id);
    $this->db->update('waste_material_records', $data);
    $this->WorkDetails($old_id);
    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }

} 


// Read data from database to show data in admin page

    function getList($conditions=NULL){
        $this->db->select('waste_material_records.*,emp1.name as employee,departments.department_name as department');
        $this->db->from('waste_material_records');
        $this->db->join('employees as emp1', 'waste_material_records.created_by = emp1.id','left'); 
        $this->db->join('departments ', 'waste_material_records.department_id = departments.id','left');
        $this->db->where(['waste_material_records.flag'=>'0']);
        $this->db->order_by('waste_material_records.id','ASC');
        if(!empty($conditions)){
            
            if($conditions['department_id'] !="0")
               $this->db->like('waste_material_records.department_id',$conditions['department_id'],'both');
           
            if($conditions['from_date']!='1970-01-01')
                $this->db->where('waste_material_records.transaction_date >=',$conditions['from_date']); 

             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('waste_material_records.transaction_date <=',$conditions['upto_date']); 
        }
        $query =  $this->db->get()->result_array();
       //echo "<pre>"; print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
        
        foreach($query as $i=>$po_data) {
            $this->db->select('waste_material_record_details.*,service_providers.service_provider_name as service_provider_name,service_providers.service_provider_code as service_provider_code');
            //$this->db->join('packing_materials', 'waste_material_record_details.waste_material_id = packing_materials.id'); 
            $this->db->join('service_providers', 'waste_material_record_details.service_provider_id = service_providers.id'); 
            $this->db->where('waste_material_record_details.waste_material_record_id', $po_data['id']);
            $images_query = $this->db->get('waste_material_record_details')->result_array();
            $query[$i]['waste_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    } 

     

    function deleteRecord($id){
        //$data=array('flag'=>'1');
        //$this->db->set('flag','flag',false);
        $this->db->where('id',$id);
        if($this->db->delete('waste_material_records'))
        {
            $this->db->where('waste_material_record_id', $id);
            if($this->db->delete('waste_material_record_details'))
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
        $this->db->select('waste_material_records.*,departments.department_name as dept,employees.name as ename');
        $this->db->from('waste_material_records');
	    /*$this->db->join('finish_goods', 'production_registers.finish_good_id = finish_goods.id','left'); */
	    $this->db->join('departments', 'waste_material_records.department_id = departments.id','left'); 
	    $this->db->join('employees', 'waste_material_records.created_by = employees.id','left'); 

        $this->db->where('waste_material_records.id',$id);
        $query =  $this->db->get()->result_array();
       foreach($query as $i=>$po_data) {
            $this->db->select('waste_material_record_details.*,service_providers.service_provider_name as service_provider_name,service_providers.service_provider_code as service_provider_code');
            //$this->db->join('packing_materials', 'waste_material_record_details.waste_material_id = packing_materials.id'); 
             $this->db->join('service_providers', 'waste_material_record_details.service_provider_id = service_providers.id'); 
            $this->db->where('waste_material_record_details.waste_material_record_id', $po_data['id']);
            $images_query = $this->db->get('waste_material_record_details')->result_array();
            $query[$i]['waste_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    }

    public function getMaterialsList() { 
       $result = $this->db->select('id,name,code')->from('packing_materials')->where(['flag'=>'0'])->get()->result_array(); 
        return $result;
    }
    public function getservice_providers() { 
       $result = $this->db->select('id, service_provider_name,service_provider_code')->from('service_providers')->where(['flag'=>'0'])->get()->result_array(); 
        
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
        
}

?>