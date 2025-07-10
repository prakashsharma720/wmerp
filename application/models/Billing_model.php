<?php

Class review_model extends MY_Model {
    private $table = 'review';
    private $detailTable = 'review_details';

 public function __construct() {
        parent::__construct();
      
    }
// Insert registration data in database
 function data_insert($data) {
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();
    endif;

    $this->reviewDetails($id);


    if ($this->db->affected_rows() > 0) {
    return true;
    }
    else { 
    return false;
    }
    
}
/************** PO Details Insertion ******************/

  function reviewDetails($id) {
        $this->db->where('review_id', $id);
        $this->db->delete($this->detailTable);
             if ($this->input->post('criteria_name')):
                foreach ($this->input->post('criteria_name') as $key => $value) :
                    $this->db->set('review_id', $id);
                    $this->db->set('criteria_name', $value);
                    $this->db->set('criteria_point', $this->input->post('criteria_point')[$key]);
                    $this->db->set('self_review', $this->input->post('self_review')[$key]);
                    $this->db->insert($this->detailTable);
                endforeach;
            endif;   
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


/******************* edit rs ********************/

 function editreview($data,$old_id){
    $this->db->where('id', $old_id);
    $this->db->update('review', $data);
    $this->reviewDetails($old_id);
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



// Read data from database to show data in admin page

    function getList(){
        $this->db->select('review.*,employees.name as creator');
        $this->db->from('review');
        $this->db->join('employees', 'review.employee_id = employees.id','left'); 
        $this->db->order_by('review.id','ASC');

        $query =  $this->db->get()->result_array();
        //print_r($query);exit; //troubleshooting somehting.
        //$query->result_array();
        foreach($query as $i=>$po_data) {
            $this->db->select('review_details.*');
            $this->db->where('review_id', $po_data['id']);
            $images_query = $this->db->get('review_details')->result_array();
            $query[$i]['review_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    } 

  
   
    function deleteRecord($id){
        $data=array('flag'=>'1');
        $this->db->set('flag','flag',false);
        $this->db->where('id',$id);
        if($this->db->update('review', $data)){
            return true;
        }
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

   
  
    public function getById($id){
        $this->db->select('*');
        $this->db->from('review');
	    // $this->db->join('finish_goods', 'requisition_slips.finish_good_id = finish_goods.id','left'); 
	    // $this->db->join('departments', 'requisition_slips.department_id = departments.id','left'); 
	    // $this->db->join('employees', 'requisition_slips.employee_id = employees.id','left'); 

        $this->db->where('review.id',$id);
        $query =  $this->db->get()->result_array();
        foreach($query as $i=>$po_data) {
			$this->db->select('review_details.*');
            $this->db->where(['review_details.review_id'=>$po_data['id']]);
            $images_query = $this->db->get('review_details')->result_array();
           $query[$i]['review_details'] = $images_query;
        }
        //print_r($query);exit;
        return $query;
    }

    

  
   function getEmployees() { 
        $result = $this->db->select('id, name')->from('employees')->where('flag','0')->get()->result_array(); 
        return $result; 
    }

      //----------- Approved Requisition List --------------------
   
        
}

?>