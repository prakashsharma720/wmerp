<?php

Class Stock_registers_model extends MY_Model {
    private $table = 'stock_registers';
 public function __construct() {
        parent::__construct();
      }


// Read data from database to show data in admin page

    function getList(){
        $this->db->select('requisition_slips.*,emp1.name as requestor,emp2.name as approver,emp3.name as rejector,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name');
        $this->db->from('requisition_slips');
        $this->db->join('employees as emp1', 'requisition_slips.created_by = emp1.id','left'); 
        $this->db->join('employees as emp2', 'requisition_slips.approved_by = emp2.id','left'); 
        $this->db->join('employees as emp3', 'requisition_slips.rejected_by = emp3.id','left'); 
        $this->db->join('finish_goods ', 'requisition_slips.finish_good_id = finish_goods.id','left');
        $this->db->where('requisition_slips.flag','0');
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

    function getRSListForIssueSlip(){
        $this->db->select('requisition_slips.*,emp1.name as requestor,emp2.name as approver,emp3.name as rejector,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name');
        $this->db->from('requisition_slips');
        $this->db->join('employees as emp1', 'requisition_slips.created_by = emp1.id','left'); 
        $this->db->join('employees as emp2', 'requisition_slips.approved_by = emp2.id','left'); 
        $this->db->join('employees as emp3', 'requisition_slips.rejected_by = emp3.id','left'); 
        $this->db->join('finish_goods ', 'requisition_slips.finish_good_id = finish_goods.id','left');
        $this->db->where(['requisition_slips.flag'=>'0','issue_completed'=>'0']);
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
       
        return $result; 
    }

    function getItems() { 
       $result = $this->db->select('id,name,code')->from('packing_materials')->where('flag','0')->get()->result_array(); 
        return $result; 
    }
    function getEmployees() { 
       $result = $this->db->select('id,name,employee_code')->from('employees')->where('flag','0')->get()->result_array(); 
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
			$this->db->select('requisition_slip_rows.*,packing_materials.name as item,unit.unit_name as unit');
            $this->db->join('packing_materials', 'requisition_slip_rows.item_id = packing_materials.id','left');
		    $this->db->join('unit', 'requisition_slip_rows.unit_id = unit.id','left');

            $this->db->where('requisition_slip_rows.requisition_slip_id', $po_data['id']);
			
            $images_query = $this->db->get('requisition_slip_rows')->result_array();
           $query[$i]['requisition_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    }
    
	
    public function getMaterialsList() { 
       $result = $this->db->select('id,mineral_name,grade_name,fg_code')->from('finish_goods')->where(['flag'=>'0'])->get()->result_array(); 
        
        return $result; 
    }
    public function getFGgradesList() { 
       $result = $this->db->select('id, grade_name')->from('finish_goods')->where(['flag'=>'0'])->get()->result_array(); 
        
        return $result; 
    }
    function getDepartments() { 
        $result = $this->db->select('id, department_name,department_code')->from('departments')->where('flag','0')->get()->result_array(); 
              return $result; 
    } 
      //----------- Approved Requisition List --------------------
     public function getMaterialsStock($conditions=NULL){
         if (!is_array($conditions)) {
        $conditions = [];
    }
        $this->db->select('stock_registers.*,packing_materials.name as item,packing_materials.unit_name as unit,employees.name as employee,departments.department_name as department');
        $this->db->from('stock_registers');
        $this->db->join('employees','stock_registers.employee_id=employees.id','left');
        $this->db->join('departments','stock_registers.department_id=departments.id','left');
        $this->db->join('packing_materials','stock_registers.item_id=packing_materials.id','left');
        
        if (!empty($conditions['department_id']) && $conditions['department_id'] != 0)
        $this->db->where('stock_registers.department_id', $conditions['department_id']);

    if (!empty($conditions['item_id']) && $conditions['item_id'] != 0)
        $this->db->where('stock_registers.item_id', $conditions['item_id']);

    if (!empty($conditions['employee_id']) && $conditions['employee_id'] != 0)
        $this->db->where('stock_registers.employee_id', $conditions['employee_id']);

    if (!empty($conditions['status']) && $conditions['status'] != 'Select Status')
        $this->db->where('stock_registers.status', $conditions['status']);

    if (!empty($conditions['from_date']))
        $this->db->where('stock_registers.transaction_date >=', $conditions['from_date']);

    if (!empty($conditions['upto_date']))
        $this->db->where('stock_registers.transaction_date <=', $conditions['upto_date']);

        $this->db->where(['stock_registers.flag'=>'0']);

        $query =  $this->db->get()->result_array();
        //print_r($this->db->last_query()); exit;
        /*if(!empty($query)){
        //print_r($query);exit;
        foreach($query as $i=>$po_data) {
            $this->db->select('requisition_slip_rows.id,requisition_slip_rows.item_id, SUM(requisition_slip_rows.pending_qty) as total,requisition_slip_rows.unit_id,requisition_slip_id,packing_materials.name as item_name,packing_materials.code as item_code,unit.unit_name as unit');
            $this->db->join('packing_materials', 'requisition_slip_rows.item_id = packing_materials.id');
            $this->db->join('unit', 'requisition_slip_rows.unit_id = unit.id');
            $this->db->where('requisition_slip_rows.requisition_slip_id', $po_data['req_id']);
            $this->db->group_by(['requisition_slip_rows.item_id']); 
            //$this->db->order_by('total', 'desc'); 
            $req_details=$this->db->get('requisition_slip_rows')->result_array();
            $data[$i] = $req_details;
        }*/
        //print_r($data);exit;
        return $query;
    }
    public function getCurrentStock($conditions=NULL){
        // print_r($condition);
        $this->db->select('stock_registers.transaction_date,stock_registers.item_id as item_id,stock_registers.employee_id as employee_id,stock_registers.department_id as department_id,packing_materials.name as item,packing_materials.unit_name as unit,packing_materials.minimum_inventory_qty as minimum_inventory_qty,employees.name as employee,departments.department_name as department');
        $this->db->from('stock_registers');
        $this->db->join('employees','stock_registers.employee_id=employees.id','left');
        $this->db->join('departments','stock_registers.department_id=departments.id','left');
        $this->db->join('packing_materials','stock_registers.item_id=packing_materials.id','left');
        $this->db->where(['stock_registers.flag'=>'0']);
        $this->db->group_by(['stock_registers.item_id']); 
        if(!empty($conditions)){
             if($conditions['from_date']!='1970-01-01')
                $this->db->where('stock_registers.transaction_date >=',$conditions['from_date']); 
             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('stock_registers.transaction_date <=',$conditions['upto_date']); 
        }
        $query =  $this->db->get()->result_array();
        //if(!empty($query)){
        //print_r($query);
        foreach($query as $i=>$po_data) {
            //print_r($po_data);exit;
            $total_in=0;
            $this->db->select('SUM(stock_registers.quantity) as total');
            $this->db->where(['stock_registers.item_id'=>$po_data['item_id'],'stock_registers.status'=>'In','stock_registers.department_id'=>$this->department_id]);
            $total_in=$this->db->get('stock_registers')->row_array();
            $query[$i]['total_in'] = $total_in;
            //$data[$i] = $total_in;
        }
        foreach($query as $i=>$po_data) {
             //print_r($po_data);exit;
            $total_out=0;
            $this->db->select('SUM(stock_registers.quantity) as total');
            $this->db->where(['stock_registers.item_id'=>$po_data['item_id'],'stock_registers.status'=>'Out','stock_registers.department_id'=>$this->department_id]);
            $total_in=$this->db->get('stock_registers')->row_array();
            $query[$i]['total_out'] = $total_in;
            //$data[$i] = $total_in;
        }
        //print_r($query);exit;
        return $query;
    }

     public function getMyStock(){
        $this->db->select('stock_registers.item_id as item_id,stock_registers.employee_id as employee_id,stock_registers.department_id as department_id,packing_materials.name as item,packing_materials.unit_name as unit,employees.name as employee,departments.department_name as department');
        $this->db->from('stock_registers');
        $this->db->join('employees','stock_registers.employee_id=employees.id','left');
        $this->db->join('departments','stock_registers.department_id=departments.id','left');
        $this->db->join('packing_materials','stock_registers.item_id=packing_materials.id','left');
        if($this->role_id == 3){
            $this->db->where(['stock_registers.flag'=>'0','stock_registers.employee_id'=>$this->login_id]);
        }else{
           $this->db->where(['stock_registers.flag'=>'0']); 
        }
        
        $this->db->group_by(['stock_registers.item_id']); 
        $query =  $this->db->get()->result_array();
        //if(!empty($query)){
        //print_r($query);
        foreach($query as $i=>$po_data) {
             //print_r($po_data);exit;
            $total_in=0;
            $total_out=0;
           $this->db->select('SUM(stock_registers.quantity) as total');
            $this->db->where(['stock_registers.item_id'=>$po_data['item_id'],'stock_registers.status'=>'In','stock_registers.department_id'=>$this->department_id]);
            $total_in=$this->db->get('stock_registers')->row_array();
            $query[$i]['total_in'] = $total_in;
            //$data[$i] = $total_in;
        }
        foreach($query as $i=>$po_data) {
             //print_r($po_data);exit;
            $total_in=0;
            $total_out=0;
           $this->db->select('SUM(stock_registers.quantity) as total');
            $this->db->where(['stock_registers.item_id'=>$po_data['item_id'],'stock_registers.status'=>'Out','stock_registers.department_id'=>$this->department_id]);
            $total_in=$this->db->get('stock_registers')->row_array();
            $query[$i]['total_out'] = $total_in;
            //$data[$i] = $total_in;
        }
        //print_r($query);exit;
        return $query;
    }
      public function getFGStockReport($conditions=NULL){

        // echo "<pre>";print_r($conditions);exit;

        $this->db->select('fg_stock_registers.*,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name,finish_goods.fg_code as fg_code,employees.name as employee,departments.department_name as department');
        $this->db->from('fg_stock_registers');
        $this->db->join('employees','fg_stock_registers.employee_id=employees.id','left');
        $this->db->join('departments','fg_stock_registers.department_id=departments.id','left');
        $this->db->join('finish_goods','fg_stock_registers.finish_good_id=finish_goods.id','left');
       
        if(!empty($conditions['department_id']))
               $this->db->where('fg_stock_registers.department_id',$conditions['department_id'],'both');
        if(!empty($conditions['finish_good_id']))
                $this->db->where('fg_stock_registers.finish_good_id',$conditions['finish_good_id'],'both');
        if(!empty($conditions['employee_id']))
            $this->db->where('fg_stock_registers.employee_id',$conditions['employee_id'],'both');
        if(!empty($conditions['status']))
            $this->db->where('fg_stock_registers.status',$conditions['status'],'both');

       if(!empty($conditions['from_date']))
            $this->db->where('fg_stock_registers.transaction_date >=',$conditions['from_date']); 

        if(!empty($conditions['upto_date']))
            $this->db->where('fg_stock_registers.transaction_date <=',$conditions['upto_date']); 
       
        
        $this->db->where(['fg_stock_registers.flag'=>'0']);
        //$this->db->order_by(['fg_stock_registers.id'=>'desc']);
        //$this->db->group_by(['fg_stock_registers.finish_good_id']); 

        $query =  $this->db->get()->result_array();
        // print_r($this->db->last_query());exit;
        // echo"<pre>";print_r($query);exit;
        foreach($query as $i=>$fg_data) {
            //print_r($po_data);exit;
            $total_in=0;
           $this->db->select('SUM(fg_stock_registers.production_in_mt) as total');
            $this->db->where(['fg_stock_registers.finish_good_id'=>$fg_data['finish_good_id'],'fg_stock_registers.status'=>'In','fg_stock_registers.department_id'=>$this->department_id]);
            $total_in=$this->db->get('fg_stock_registers')->row_array();
            $query[$i]['total_in'] = $total_in;
            //$data[$i] = $total_in;
        }
        foreach($query as $i=>$fg_data) {
            //print_r($po_data);exit;
            $total_out=0;
           $this->db->select('SUM(fg_stock_registers.production_in_mt) as total');
            $this->db->where(['fg_stock_registers.finish_good_id'=>$fg_data['finish_good_id'],'fg_stock_registers.status'=>'Out','fg_stock_registers.department_id'=>$this->department_id]);
            $total_in=$this->db->get('fg_stock_registers')->row_array();
            $query[$i]['total_out'] = $total_in;
            //$data[$i] = $total_in;

        }
        //$query[$i]['total_balance']=$query[$i]['total_in']-$query[$i]['total_out'];
        // echo"<pre>";print_r($query);exit;
        return $query;
    }

     public function getFGCurrentStock($conditions=NULL){
        $this->db->select('fg_stock_registers.transaction_date,fg_stock_registers.finish_good_id as finish_good_id,fg_stock_registers.employee_id as employee_id,fg_stock_registers.department_id as department_id,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name,finish_goods.fg_code as fg_code,employees.name as employee,departments.department_name as department');
        $this->db->from('fg_stock_registers');
        $this->db->join('employees','fg_stock_registers.employee_id=employees.id','left');
        $this->db->join('departments','fg_stock_registers.department_id=departments.id','left');
        $this->db->join('finish_goods','fg_stock_registers.finish_good_id=finish_goods.id','left');
        $this->db->where(['fg_stock_registers.flag'=>'0']);
        $this->db->group_by(['fg_stock_registers.finish_good_id']); 
        if(!empty($conditions)){
             if($conditions['from_date']!='1970-01-01')
                $this->db->where('fg_stock_registers.transaction_date >=',$conditions['from_date']); 
             if($conditions['upto_date']!='1970-01-01')
               $this->db->where('fg_stock_registers.transaction_date <=',$conditions['upto_date']); 
        }
        $query =  $this->db->get()->result_array();
        //if(!empty($query)){
        //print_r($query);
        foreach($query as $i=>$po_data) {
            //print_r($po_data);exit;
            $total_in=0;
           $this->db->select('SUM(fg_stock_registers.production_in_mt) as total');
            //$this->db->where(['fg_stock_registers.finish_good_id'=>$po_data['finish_good_id'],'fg_stock_registers.status'=>'In','fg_stock_registers.department_id'=>$this->department_id]);
            $this->db->where(['fg_stock_registers.finish_good_id'=>$po_data['finish_good_id'],'fg_stock_registers.status'=>'In']);
            $total_in=$this->db->get('fg_stock_registers')->row_array();
            $query[$i]['total_in'] = $total_in;
            //$data[$i] = $total_in;
        }
        foreach($query as $i=>$po_data) {
             //print_r($po_data);exit;
            $total_out=0;
            $this->db->select('SUM(fg_stock_registers.production_in_mt) as total');
            $this->db->where(['fg_stock_registers.finish_good_id'=>$po_data['finish_good_id'],'fg_stock_registers.status'=>'Out']);
            $total_in=$this->db->get('fg_stock_registers')->row_array();
            $query[$i]['total_out'] = $total_in;
            //$data[$i] = $total_in;
        }
        //print_r($query);exit;
        return $query;
    }
   
}

?>