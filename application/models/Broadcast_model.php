<?php

Class Broadcast_model extends MY_Model {
    //  private $table = 'review';
    // private $detailTable = 'review_details';
    
  public function __construct()
  {
    parent::__construct();
  }
    function getDepartments() { 
      $result = $this->db->select('id, department_name,department_code')->from('departments')->where('flag','0')->get()->result_array(); 
      //$result= $result->result_array();
      $departments = array(); 
      $departments[' '] = 'Select All..'; 
      foreach($result as $r) { 
          $departments[$r['id']] = $r['department_name'].' ('.$r['department_code'].')'; 
      } 
      
      return $departments; 
  }
   

    public function data_insert($data) 
    {
      $this->db->insert('broadcast', $data);
      if ($this->db->affected_rows() > 0) {
        return true;
      }
       else { 
        return false;
      }
    }
    public function broadcastList($conditions = null) 
	{
		$this->db->select('broadcast.*,departments.department_name as department_id');
		$this->db->from('broadcast');
    $this->db->join('departments','broadcast.department_id=departments.id','left');
    $this->db->where('broadcast.flag','0');

    if (!empty($conditions['department_id'])) {
      $this->db->group_start();
      $this->db->where('broadcast.department_id', $conditions['department_id']);
      $this->db->or_where('broadcast.department_id', '0');
      $this->db->group_end();
    }
      $query = $this->db->get()->result_array();
    // If no broadcast found, return empty
    if (empty($query)) {
      return [];
    }
    // Fetch read details for each broadcast
    foreach ($query as &$broadcast) {
      $this->db->select('broadcast_read_status.*, employees.name as user_name');
      $this->db->from('broadcast_read_status');
      $this->db->join('employees', 'broadcast_read_status.user_id = employees.id', 'left');
      $this->db->where('broadcast_read_status.broadcast_id', $broadcast['id']);
      $broadcast['read_details'] = $this->db->get()->result_array();
    }
		//  print_r($query);
		return $query;

	}
  public function get_active_messages($user_id, $department_id)
  {
    $this->db->select("b.*, IF(brs.broadcast_id IS NOT NULL, 1, 0) AS is_read", false);
    $this->db->from('broadcast b');
    $this->db->join('broadcast_read_status brs', "b.id = brs.broadcast_id AND brs.user_id = " . (int) $user_id, 'left');
    $this->db->where("(b.department_id = " . (int) $department_id . " OR b.department_id = 0)");
    $this->db->where("b.flag", 0);
    $this->db->order_by('b.date_time', 'DESC');

    $query = $this->db->get();
    return $query->result_array();
  }






  public function getById($id) {
    $this->db->select('broadcast.*,departments.department_name,');
 $this->db->from('broadcast');
 $this->db->join('departments', 'broadcast.department_id = departments.id', 'left'); 
 //$this->db->join('departments', 'employees.department_id = departments.id', 'left'); 
     $this->db->where('broadcast.id', $id);
     $query = $this->db->get();
     return $query->row_array();
 }
 public function broadcast_update($data,$id) 
 {
   /*print_r($id);
   print_r($data);
   exit;
   */
   $this->db->where('id', $id);
   $this->db->update('broadcast', $data);
   if ($this->db->affected_rows() > 0) {
   return true;
   }
   else { 
   return false;
   }
 }
}


?>