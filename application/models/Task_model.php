<?php

Class task_model extends MY_Model {

    private $table          = 'projects';
    private $lead_followups = 'leave_details';

  public function __construct() {
        parent::__construct();
         }
public function getByIdTask($id) {
    $this->db->select('*');
     $this->db->from('projects');
     $this->db->where('id', $id);
     $query = $this->db->get();
     return $query->row_array();
 }
 public function getById($id) {
    $this->db->select('*');
 $this->db->from('daily_tasks');
 $this->db->where('id', $id);
 $query = $this->db->get();
 return $query->row_array();
}
 public function getdailytask(){

    $query=$this->db->query('SELECT * FROM projects');
   
    $count=$query->num_rows();
    //print_r($count);exit;
    return $count;
   
    }

 public function task_update($data,$id) 
 {
     /*print_r($id);
     print_r($data);
     exit;
     */
     $this->db->where('id', $id);
     $this->db->update('projects', $data);
     if ($this->db->affected_rows() > 0) {
     return true;
     }
     else { 
     return false;
     }
 }

 public function task_edit($data,$id) 
 {
     /*print_r($id);
     print_r($data);
     exit;
     */
     $this->db->where('id', $id);
     $this->db->update('daily_tasks', $data);
     if ($this->db->affected_rows() > 0) {
     return true;
     }
     else { 
     return false;
     }
 }
 public function project_edit($data,$id) 
 {
     /*print_r($id);
     print_r($data);
     exit;
     */
     $this->db->where('id', $id);
     $this->db->update('projects', $data);
     if ($this->db->affected_rows() > 0) {
     return true;
     }
     else { 
     return false;
     }
 }
  public function insert($table_name,$data) 
	{

		// Query to check whether username already exist or not
	
		// Query to insert data in database
		$this->db->insert($table_name, $data);
		 //$id = $this->db->insert_id();
		if ($this->db->affected_rows() > 0) 
        {
			// // if($this->sendMail($id) == true){
			// // 	return true;
			// }
            return true;
		} 
		else { 
		return false;
		}
	}
 
 public function projectList() 
	{
		
		$this->db->select('projects.*,departments.department_name as department_id');
		$this->db->from('projects');
        $this->db->join('departments','projects.department_id=departments.id','left');
		$this->db->where('projects.flag','0');
		$this->db->order_by("projects.project_name", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}
    public function taskList() 
	{
		
		$this->db->select('daily_tasks.*,emp1.name as employee_name,emp2.name as assign_by');
		$this->db->from('daily_tasks');
        $this->db->join('employees as emp1','daily_tasks.Assign_to=emp1.id','left');
        $this->db->join('employees as emp2','daily_tasks.Assign_by=emp2.id','left');
		// $this->db->where('flag','0');
		$this->db->order_by("daily_tasks.id", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}

    public function taskListByEmployee($login_id) 
    {
        
        $this->db->select('daily_tasks.*,emp1.name as employee_name,emp2.name as assign_by');
        $this->db->from('daily_tasks');
        $this->db->join('employees as emp1','daily_tasks.Assign_to=emp1.id','left');
        $this->db->join('employees as emp2','daily_tasks.Assign_by=emp2.id','left');
        $this->db->where('daily_tasks.Assign_to',$login_id);
        $this->db->order_by("daily_tasks.id", "asc");
        $query = $this->db->get();
        return $query->result_array();

    }
   

    function getproject_id () { 
		$result = $this->db->select('id, project_name')->from('projects')->where('flag','0')->get()->result_array();
        //$result = $this->db->select('id, category_name')->get('categories')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $productname = array(); 
        $productname[''] = 'Select Project...'; 
        foreach($result as $r) { 
            $productname[$r['id']] = $r['project_name']; 
        } 
        
        return $productname; 
    }

    function getempname_id () { 
		$result = $this->db->select('id, name')->from('employees')->where('flag','0')->get()->result_array();
        //$result = $this->db->select('id, category_name')->get('categories')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        // $productname = array(); 
        // $productname[''] = 'Select Employee...'; 
        // foreach($result as $r) { 
        //     $productname[$r['id']] = $r['name']; 
        // } 
        
        return $result; 
    }

    function getDepartments() { 
        $result = $this->db->select('id, department_name,department_code')->from('departments')->where('flag','0')->get()->result_array(); 
        //$result= $result->result_array();
        $departments = array(); 
        $departments[' '] = 'Select department...'; 
        foreach($result as $r) { 
            $departments[$r['id']] = $r['department_name'].' ('.$r['department_code'].')'; 
        } 
        
        return $departments; 
    }

    function getTList() { 
		$result = $this->db->select('id,name')->from('employees')->where(['flag'=>'0','designation_id'=>'8'])->get()->result_array(); ; 
        //$result = $this->db->select('id, category_name')->get('categories')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $productname = array(); 
        $productname[''] = 'Employee name'; 
        foreach($result as $r) { 
         $productname[$r['id']] = $r['name']; 
        } 
        
        return $productname; 
    }

     function getemployeeList($department_id = null) { 
         if(!empty($department_id)){
            $result = $this->db->select('id,name')->from('employees')->where(['flag'=>'0','designation_id !='=>'8','department_id'=>$department_id])->get()->result_array(); ; 

         }else{
            $result = $this->db->select('id,name')->from('employees')->where(['flag'=>'0'])->get()->result_array(); ; 

         }
        //$result = $this->db->select('id, category_name')->get('categories')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $productname = array(); 
        $productname[''] = 'Employee name'; 
        foreach($result as $r) { 
         $productname[$r['id']] = $r['name']; 
        } 
        
        return $productname; 
    }
    
    public function getFollowUps($id) {
        $this->db->select('*');
     $this->db->from('task_history');
    //   $this->db->join('daily_tasks', 'task_history.task_id = daily_tasks.id','left'); 
    //  $this->db->join('employees', 'task_history.followup_by = employees.id','left'); 
      $this->db->where('task_id', $id);
     $query = $this->db->get();
     return $query->result_array();
 }
 public function insertFollowup($data) 
 {
     $this->db->insert('task_history', $data);
     if ($this->db->affected_rows() > 0) {
     return true;
     }
      else { 
     return false;
     }
 }




    function deleteItem($id)
		{
			if($this->db->delete('daily_tasks', "id = ".$id)) return true;
        }

       
        function deletefollowup($id)
		{
			if($this->db->delete('task_history', "id = ".$id)) return true;
        }
       

        public function TaskListCSV($conditions = null) 
        {
            // echo "<pre>"; print_r($conditions);exit;
            // $this->db->select('daily_tasks.*,employees.name as employee');
            // $this->db->from('daily_tasks');
            // $this->db->join('employees','daily_tasks.Assign_to=employees.id','left');
            $this->db->select('daily_tasks.*,emp1.name as employee_name,emp2.name as assign_by');
		$this->db->from('daily_tasks');
        $this->db->join('employees as emp1','daily_tasks.Assign_to=emp1.id','left');
        $this->db->join('employees as emp2','daily_tasks.Assign_by=emp2.id','left');
            // $this->db->join('leave_types','leaves.leave_type_id=leave_types.id','left');
            if(!empty($conditions)){            
               if(!empty($conditions['employee_id'])){
                $this->db->where('daily_tasks.Assign_to',$conditions['employee_id'],'both');
            }
            if(!empty($conditions['project_id'])){
                $this->db->where('daily_tasks.project_id',$conditions['project_id'],'both');
            }
            if(!empty($conditions['task_status'])){
                $this->db->where('daily_tasks.status',$conditions['task_status'],'both');
            }
            if(!empty($conditions['from_date'])){
                $this->db->where('daily_tasks.start_date >=',$conditions['from_date'],'both');
            }
            if(!empty($conditions['upto_date'])){
                $this->db->where('daily_tasks.end_date <=',$conditions['upto_date'],'both');
            }
        }
            //$query = $this->db->get()->result_array();
            
            // $this->db->where('daily_tasks.flag <=',$conditions['upto_date'],'both');
            $this->db->order_by('daily_tasks.id', 'desc');
            // $query = $this->db->get()->result_array();
            // echo "<pre>"; print_r($this->db->last_query()); exit;
            return $query = $this->db->get()->result_array();
        }
        

 

	


}
?>
