<?php

Class MO_leads extends MY_Model {

	private $table = 'mo_website_leads';
    private $lead_followups = 'lead_followups';

    public function __construct() {
        parent::__construct();
       // $this->language_id = 1;
    }
       public function getByWorkshopEmailId($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get('workshop_detail'); // Replace 'users' with the actual table name where user data is stored
        
            if ($query->num_rows() == 1) {
                return $query->row_array(); // Return user data as an associative array
            } else {
                return false; // Return false if no user is found with the given ID
            }
        }

            public function sendMail($id)
        {
            $user = $this->getByWorkshopEmailId($id);  // Retrieve user details by ID

            if ($user) {
            $cc = ['muskowldevelopment@gmail.com'];  // Common CC addresses
    
            $username = $user['your_name'];
            $useremail = $user['your_email'];
         
            $booking_status = $user['booking_status'];
           
    
         $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'mail.muskowl.com',
            'smtp_port' => 465,  // Use port 465 for SSL
            'smtp_user' => 'erp@muskowl.com',
            'smtp_pass' => '#ERP@muskowl2022#',
            'smtp_crypto' => 'ssl',  // Use 'ssl' for port 465
            'smtp_auth' => true,  // Correct authentication setting
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => true
        ];

       
            
       
    
            $this->load->library('email', $config);
    
            $message = '
            <html>
                <head>
                    <title>Booking Status Updated</title>
                </head>
                <body>
                    <p>Dear ' . $username . ', your Booking status is: <b>' . $booking_status . '</b></p>
                    <hr>
                    <b>Thanks & Regards</b>
                    <div>Prakash</div>
                    <div><b>iii</div>
                    <div><b>(Muskowl LLP)</b></div>
                </body>
            </html>';

        $this->email->set_newline("\r\n");
        $this->email->from('erp@muskowl.com');
        $this->email->to($useremail);
        $this->email->cc($cc);
        $this->email->subject('Booking Approved ');
        $this->email->message($message);

        if ($this->email->send()) {
            return true;
        } else {
            show_error($this->email->print_debugger());
        }
    }
}

function getDetailsByID($emp_id) {
		$this->db->select('designation_id,name');
		$this->db->where('id', $emp_id);
		$this->db->from('employees');
		$query=$this->db->get()->row_array();
		return $query;
	}
    public function savemuskowlleads($data) 
	{

	
		// Query to insert data in database
		$this->db->insert('workshop_detail', $data);
	 if ($this->db->affected_rows() > 0) {
        // Get the last inserted ID
        $insert_id = $this->db->insert_id();

        // Generate a random reference ID
        $reference_id = strtoupper(substr(md5(uniqid(rand(), true)), 0, 6));
        $reference_id_md5 = md5('MOWORK'.$reference_id);

        // Update the inserted record with the reference ID
        $this->db->where('id', $insert_id);
        $this->db->update('workshop_detail', ['reference_id' => $reference_id,'access_token'=>$reference_id_md5]);

        // Fetch the last inserted data with the updated reference_id
        $this->db->where('id', $insert_id);
        $last_inserted_data = $this->db->get('workshop_detail')->row_array();

        return ['reference_id' => $reference_id, 'access_token'=>$reference_id_md5,'data' => $last_inserted_data];
    } else { 
        return false;
    }
	}
	public function save($data) 
	{

	
		// Query to insert data in database
		$this->db->insert('mo_website_leads', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		else { 
		return false;
		}
	}
	public function insert($data) 
	{

	
		// Query to insert data in database
		$this->db->insert('inframarket', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		else { 
		return false;
		}
	}

	public function MOLeadList() 
	{
		
		$this->db->select('mo_website_leads.*,categories.category_name as category_name');
		$this->db->from('mo_website_leads');
		$this->db->join('categories','mo_website_leads.category_id=categories.id','left');
		//$this->db->join('grades','leads.grade_id=grades.id');
		// $this->db->where('mo_website_leads.flag','0');
		$this->db->order_by("mo_website_leads.id", "desc");
		$query = $this->db->get();
		return $query->result_array();

	}
	
	public function MOworkshopList($conditions = null) 
{
    $this->db->select('*');
    $this->db->from('workshop_detail');
    
    if(!empty($conditions)){
        if(!empty($conditions['workshop_name'])){
            $this->db->where('workshop_detail.workshop_name', $conditions['workshop_name']);
        }
        if(!empty($conditions['booking_status'])){
            $this->db->where('workshop_detail.booking_status', $conditions['booking_status']);
        }
    }
    
    $this->db->order_by("workshop_detail.id", "desc");
    $query = $this->db->get();
    return $query->result_array();
}

	

	  function getWorkshop() { 
		$result = $this->db->select('id, workshop_name')->from('workshop_detail')->group_by('workshop_name')->get()->result_array(); 
    //   echo "<pre>";print_r($result);exit;
        return $result; 
    }

public function getWorkshopById($access_token) {
    $this->db->select('*');
    $this->db->from('workshop_detail');
    $this->db->where('access_token', $access_token); // Use the reference_id parameter
    $query = $this->db->get();
    return $query->row_array(); // Return single row as an associative array
}

}
?>