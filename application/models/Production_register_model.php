<?php

Class Production_register_model extends MY_Model {
    private $table = 'production_registers';
    private $detailTable = 'production_register_details';
 public function __construct() {
        parent::__construct();
      }
// Insert registration data in database
 function pr_insert($data) {

// Query to check whether username already exist or not
$condition = "pr_number =" . "'" . $data['pr_number'] . "'";

$this->db->select('*');
$this->db->from($this->table);
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();
//print_r($data);exit;
if ($query->num_rows() == 0) {
// Query to insert data in database
 if ($this->input->post('pr_id_old')):
        $id = $this->input->post('pr_id_old');
        $this->db->where('id', $id);
        $this->db->update($this->table,$data);
    else:
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();
    endif;

    $this->prDetails($id);

    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }
    }
}

function insert_opening_stock($data) {

    $this->db->insert($this->table, $data);
    $id = $this->db->insert_id();

    $this->insertDetailOpeningStock($id);

    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }
    
}
 function insertDetailOpeningStock($id) {
        $this->db->where('production_register_id', $id);
        $this->db->delete('fg_stock_registers');
             if ($this->input->post('finish_good_id')):
                foreach ($this->input->post('finish_good_id') as $key => $value) :
                    $pr_row_id = $id;
                    $transaction_date=date('Y-m-d');
                    $employee_id=$this->login_id;
                    $department_id=$this->department_id;
                    $finish_good_id= $value;
                    $lot_no= $this->input->post('lot_no')[$key];
                    $batch_no= $this->input->post('batch_no')[$key];
                    $packing_size= $this->input->post('packing_size')[$key];
                    $no_of_bags= $this->input->post('no_of_bags')[$key];
                    $production_in_mt= $this->input->post('production_in_mt')[$key];
                    $this->insertStockRegister($id,$pr_row_id,$employee_id,$department_id,$transaction_date,$finish_good_id,$lot_no,$batch_no,$packing_size,$no_of_bags,$production_in_mt);
                endforeach;
            endif; 
    }
    




/************** PO Details Insertion ******************/
function prDetails($id) {
        $this->db->where('production_register_id', $id);
        $this->db->delete($this->detailTable);
        $this->db->where('production_register_id', $id);
        $this->db->delete('fg_stock_registers');
             if ($this->input->post('finish_good_id')):
                foreach ($this->input->post('finish_good_id') as $key => $value) :
                    $this->db->set('production_register_id', $id);
                    $this->db->set('finish_good_id', $value);
                    $this->db->set('lot_no', $this->input->post('lot_no')[$key]);
                    $this->db->set('batch_no', $this->input->post('batch_no')[$key]);
                    $this->db->set('packing_size', $this->input->post('packing_size')[$key]);
                    $this->db->set('no_of_bags', $this->input->post('no_of_bags')[$key]);
                    $this->db->set('production_in_mt', $this->input->post('production_in_mt')[$key]);
                    $this->db->set('kwh_opening', $this->input->post('kwh_opening')[$key]);
                    $this->db->set('kwh_closing', $this->input->post('kwh_closing')[$key]);
                    $this->db->set('kwh_consumed', $this->input->post('kwh_consumed')[$key]);
                    $this->db->set('unit_per_mt', $this->input->post('unit_per_mt')[$key]);
                    $this->db->insert($this->detailTable);
                    $pr_row_id = $this->db->insert_id();
                    $transaction_date=date('Y-m-d');
                    $employee_id=$this->login_id;
                    $department_id=$this->department_id;
                    $finish_good_id= $value;
                    $lot_no= $this->input->post('lot_no')[$key];
                    $batch_no= $this->input->post('batch_no')[$key];
                    $packing_size= $this->input->post('packing_size')[$key];
                    $no_of_bags= $this->input->post('no_of_bags')[$key];
                    $production_in_mt= $this->input->post('production_in_mt')[$key];
                    $this->insertStockRegister($id,$pr_row_id,$employee_id,$department_id,$transaction_date,$finish_good_id,$lot_no,$batch_no,$packing_size,$no_of_bags,$production_in_mt);
                endforeach;
            endif; 
    }

 

           /************** Inser/Update StockRegisters ******************/
        function insertStockRegister($id,$pr_row_id,$employee_id,$department_id,$transaction_date,$finish_good_id,$lot_no,$batch_no,$packing_size,$no_of_bags,$production_in_mt){
            $data=array('production_register_id'=>$id,'production_register_detail_id'=>$pr_row_id,'transaction_date'=>$transaction_date,'employee_id'=>$employee_id,'department_id'=>$department_id,'finish_good_id'=>$finish_good_id,'lot_no'=>$lot_no,'batch_no'=>$batch_no,'packing_size'=>$packing_size,'no_of_bags'=>$no_of_bags,'production_in_mt'=>$production_in_mt,'status'=>'In','created_by'=>$employee_id);
            $this->db->insert('fg_stock_registers', $data);
    }


/******************* Row Count for Voucher Number ********************/

 function rowcount(){
    $count=0;
    $this->db->select_max('pr_number');
    $this->db->from($this->table);
    $query=$this->db->get()->result_array();
    //$query->result_array();
    $count=$query[0]['production_registers'];
    //print_r($count);exit;
    return $count;
   
}
    function getPRCode(){
        // $count=0;
        $query = $this->db->query('SELECT * FROM production_registers');
        return $query->num_rows()+1;

    // $count=0;
    // $this->db->select_max('pr_number');
    // $this->db->from($this->table);
    // $this->db->where('flag','0');
    // $query=$this->db->get()->row_array();
    // //print_r($query['employee_code']);exit;
    // $count=$query['pr_number']+1;
    
   
    }

/******************* edit rs ********************/

 function editProduction($data,$old_id){
    $this->db->where('id', $old_id);
    $this->db->update('production_registers', $data);
    $this->prDetails($old_id);
    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }

} 

function actionRequisition($data,$old_id){
    $this->db->where('id', $old_id);
    $this->db->update('production_registers', $data);
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
        $this->db->select('production_registers.*,emp1.name as employee,departments.department_name as department');
        $this->db->from('production_registers');
        $this->db->join('employees as emp1', 'production_registers.employee_id = emp1.id','left'); 
        $this->db->join('departments ', 'production_registers.department_id = departments.id','left');
        if($this->role_id == 3){
             $this->db->where(['production_registers.flag'=>'0','production_registers.employee_id'=>$this->login_id]);
        }else{
            $this->db->where(['production_registers.flag'=>'0']); 
        }
       
        $this->db->order_by('production_registers.id','desc');
        $query =  $this->db->get()->result_array();
        //print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('production_register_details.*,finish_goods.*');
            $this->db->join('finish_goods', 'production_register_details.finish_good_id = finish_goods.id'); 
            $this->db->where('production_register_details.production_register_id', $po_data['id']);
            $images_query = $this->db->get('production_register_details')->result_array();
            $query[$i]['production_details'] = $images_query;
        }

        // foreach($query as $j=>$po_data) {
        //     $this->db->select('work_allotment_registers.total_workers as total_workers');
        //     $this->db->where(['work_allotment_registers.mill_no'=>$po_data['mill_no'],'work_allotment_registers.transaction_date'=>$po_data['date_of_production']]);
        //     $images_query1 = $this->db->get('work_allotment_registers')->row_array();
        //     $query[$j]['total_workers'] = $images_query1['total_workers'];
        // }

       /* echo "<pre>";
        print_r($query);exit;*/
        return $query;
    } 

     function filter_by_getList($conditions){
       $this->db->select('production_registers.*,emp1.name as employee,departments.department_name as department');
        $this->db->from('production_registers');
        $this->db->join('employees as emp1', 'production_registers.employee_id = emp1.id','left'); 
        $this->db->join('departments ', 'production_registers.department_id = departments.id','left');
        if($this->role_id == 3){
             $this->db->where(['production_registers.flag'=>'0','production_registers.employee_id'=>$this->login_id]);
        }else{
            $this->db->where(['production_registers.flag'=>'0']); 
        }
        if(!empty($conditions['mill_no']))
               $this->db->where('production_registers.mill_no',$conditions['mill_no'],'both');

       
        if(!empty($conditions['from_date']))
            $this->db->where('production_registers.date_of_production >=',$conditions['from_date']); 

         if(!empty($conditions['upto_date']))
           $this->db->where('production_registers.date_of_production <=',$conditions['upto_date']); 
        $this->db->order_by('production_registers.id','desc');
        $query =  $this->db->get()->result_array();
        //print_r($query);exit; //troubleshooting somehting.
       // print_r($this->db->last_query());exit;
        //$query->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('production_register_details.*,finish_goods.*');
            $this->db->join('finish_goods', 'production_register_details.finish_good_id = finish_goods.id'); 
            $this->db->where('production_register_details.production_register_id', $po_data['id']);
            $images_query = $this->db->get('production_register_details')->result_array();
            $query[$i]['production_details'] = $images_query;
        }
        foreach($query as $j=>$po_data) {
            $this->db->select('work_allotment_registers.total_workers as total_workers');
            //$this->db->join('finish_goods', 'production_register_details.finish_good_id = finish_goods.id'); 
            $this->db->where(['work_allotment_registers.mill_no'=>$po_data['mill_no'],'work_allotment_registers.transaction_date'=>$po_data['date_of_production']]);
            $images_query1 = $this->db->get('work_allotment_registers')->row_array();
            //print_r($images_query1);
            if(isset($images_query1['total_workers']))
            {
                $query[$j]['total_workers'] = $images_query1['total_workers'];
            }else{
                $query[$j]['total_workers'] = 0;
            }
            
        }
       // /echo "<pre>";print_r($query);exit;
        return $query;
    } 
     

    function deleteProduction($id){
        //$data=array('flag'=>'1');
        //$this->db->set('flag','flag',false);
        $this->db->where('id',$id);
        if($this->db->delete('production_registers'))
        {
            $this->db->where('production_register_id', $id);
            if($this->db->delete('production_register_details'))
            {
                $this->db->where('production_register_id', $id);
                if($this->db->delete('fg_stock_registers')){
                    return true;
                }
            }
        }
    }

    function getMonths() { 
         $result = $this->db->select('id, month_name')->from('months')->where('flag','0')->get()->result_array(); 
         $productname = array(); 
         $productname[''] = 'Select Month'; 
        foreach($result as $r) { 
            $productname[$r['month_name']] = $r['month_name']; 
        } 
        
        return $productname; 
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
        $this->db->select('production_registers.*,departments.department_name as dept,employees.name as ename');
        $this->db->from('production_registers');
	    /*$this->db->join('finish_goods', 'production_registers.finish_good_id = finish_goods.id','left'); */
	    $this->db->join('departments', 'production_registers.department_id = departments.id','left'); 
	    $this->db->join('employees', 'production_registers.employee_id = employees.id','left'); 

        $this->db->where('production_registers.id',$id);
        $query =  $this->db->get()->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('production_register_details.*,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name,finish_goods.fg_code as fg_code');
            $this->db->join('finish_goods', 'production_register_details.finish_good_id = finish_goods.id'); 
            $this->db->where('production_register_details.production_register_id', $po_data['id']);
            $images_query = $this->db->get('production_register_details')->result_array();
            $query[$i]['production_details'] = $images_query;
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
        
}

?>