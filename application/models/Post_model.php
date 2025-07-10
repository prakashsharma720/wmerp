<?php

Class posts_model extends MY_Model {
		private $table = 'posts';
    	private $table_details = 'installment_details';

	// Insert registration data in database
	public function record_insert($data) 
	{

		// Query to insert data in database
		$this->db->insert($this->table, $data);
		$id = $this->db->insert_id();
		if ($this->db->affected_rows() > 0) {
		return $this->getById($id);
		}
		else { 
		return false;
		}
	}
	public function addLoanDetails($id){
     	$this->db->where('loan_register_id', $id);
        $this->db->delete($this->table_details);
        $no_of_installment=$this->input->post('no_of_installment');

       

        for($i=1;$i<=$no_of_installment;$i++){

        	 $month =date("m",strtotime($this->input->post('first_installment_date')));
            
            if($month == 12){
                $date[$i]=date('Y-m-d',strtotime('+1 year +1 month',strtotime($this->input->post('first_installment_date'))));
            }
            else{
               $date[$i]=date('Y-m-d',strtotime('+1 month',strtotime($this->input->post('first_installment_date')))); 
            }

        	$this->db->set('loan_register_id', $id);
        	$this->db->set('installment_amount', $this->input->post('installment_amount'));
        	// if($i==1){
        	// 	$this->db->set('installment_date', date('Y-m-d',strtotime($this->input->post('first_installment_date'))));
        	// }else{
        	$this->db->set('installment_date', $date[$i]);
        	// }
        	$this->db->set('status', 'Pending');
        	$this->db->insert($this->table_details);
          

        }
        // foreach ($this->input->post('finish_name') as $key => $value) :
        //     	$this->db->set('product_id', $id);
        //     	$this->db->set('finish_type', $value);
        //     	$this->db->set('file_path', base_url($uploadImgDataFinish[$key]['file_name']));
        //         $this->db->insert($this->table_details);        	
        // endforeach;
     }


	public function getList() 
	{
		
		$this->db->select('*');
		$this->db->from('posts');
		$this->db->order_by("posts.id", "desc");
		$query = $this->db->get()->result_array();
		//print_r($query);exit;
		return $query;

	}
	public function getById($id) {
       	$this->db->select('*');
		$this->db->from('posts');
		$this->db->order_by("posts.id", "desc");
		$query = $this->db->get()->row_Array();
		//print_r($query);exit;
		return $query;
        //print_r($query);exit;

    }
    
    
    function delete_record($id)
		{
			//if($this->db->delete('suppliers', "id = ".$id)) return true;
			$this->db->where('id', $id);
    		if($this->db->delete('posts')){
    			return true;
    		}else{
    			return false;
    		}
		}

	public function sendEmailToAdmin($id) {
        $this->data = array();
        $data = $this->getById($id);
        if ($data):
            $this->data['name'] = $data['name'];
            $this->data['email'] = $data['email'];
            $email_to = $data['email'];
            $this->data['contact'] = $data['mobile'];
            $this->data['inquiry'] = $data['looking_for'];
           // $this->data['modified_date'] = $data['modified_date'];

        $html = $this->load->view('email_admin', $this->data, TRUE);
        $config = Array(
		  'protocol' => 'smtp',
		  //'smtp_host' => 'smtp.gmail.com',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'prakash1.muskowl@gmail.com', // change it to yours
		  'smtp_pass' => 'Ymdc@1995', // change it to yours
		  'mailtype' => 'html',
		  'charset' => 'iso-8859-1',
		  'wordwrap' => TRUE
		);
		$this->load->helper('string');
		$code= random_string('numeric', 6);

		//$code='123456';
        $this->load->library('email', $config);
	    $this->email->set_newline("\r\n");
	    $this->email->from('prakashsharma720@gmail.com'); // change it to yours
	    $this->email->to('prakashsharma720@gmail.com');// change it to yours
	    $this->email->subject('Pyrotech Workspace Landing Page Enquiry ');        
        $this->email->message($html);
       	if($this->email->send()):
            return TRUE;
        else:
            return FALSE;
        endif;
    	endif;
    }
    public function sendEmailToUser($id) {
        $this->data = array();
        $data = $this->getById($id);
        if ($data):
            $this->data['name'] = $data['name'];
            $this->data['email'] = $data['email'];
            $email_to = $data['email'];
            $this->data['contact'] = $data['mobile'];
            $this->data['inquiry'] = $data['looking_for'];
           // $this->data['modified_date'] = $data['modified_date'];

        $html = $this->load->view('email_user', $this->data, TRUE);
        $config = Array(
		  'protocol' => 'smtp',
		  //'smtp_host' => 'smtp.gmail.com',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'prakash1.muskowl@gmail.com', // change it to yours
		  'smtp_pass' => 'Ymdc@1995', // change it to yours
		  'mailtype' => 'html',
		  'charset' => 'iso-8859-1',
		  'wordwrap' => TRUE
		);
		$this->load->helper('string');
		$code= random_string('numeric', 6);

		//$code='123456';
        $this->load->library('email', $config);
	    $this->email->set_newline("\r\n");
	    $this->email->from('prakashsharma720@gmail.com'); // change it to yours
	    $this->email->to($email_to);// change it to yours
	    $this->email->subject('Greetings From Pyrotech Workspace');        
        $this->email->message($html);
       	if($this->email->send()):
            return TRUE;
        else:
            return FALSE;
        endif;
    	endif;
    }
}
?>