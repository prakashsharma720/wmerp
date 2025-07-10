<?php

Class Grades_Model extends MY_Model {

	// Insert registration data in database
	public function grade_insert($data) 
	{

		// Query to check whether username already exist or not
		$condition = "grade =" . "'" . $data['grade'] . "'";

		$this->db->select('*');
		$this->db->from('grades');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		//print_r($data);exit;
		if ($query->num_rows() == 0) {
		// Query to insert data in database
		$this->db->insert('grades', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		} else { 
		return false;
		}
	}
	public function grade_update($data,$id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $id);
		$this->db->update('grades', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		else { 
		return false;
		}
	}
	public function gradeList() 
	{
		
		$this->db->select('grades.*,categories.category_name as category');
		$this->db->from('grades');
		$this->db->join('categories', 'grades.categories_id = categories.id');
		$this->db->where('grades.flag','0');
		$this->db->order_by("grades.grade", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}
	public function getById($id) {
       	$this->db->select('*');
		$this->db->from('grades');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    // ************* show grid name by id *****************//
	/*public function fetchcatName($id) {
       	$this->db->select('grid_name');
		$this->db->from('grids');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
        //print_r($query);exit;
    }*/

	function getCategories() { 
		$result = $this->db->select('id, category_name')->from('categories')->where(['flag'=>'0'])->get()->result_array();         
        return $result; 
    } 
	function getGradeByCategory($category_id) { 
		$result = $this->db->select('id, grade')->from('grades')->where(['flag'=>'0','categories_id'=>$category_id])->get()->result_array();         
        return $result; 
    } 

}
?>