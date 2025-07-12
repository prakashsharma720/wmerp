<?php 
Class AdminController extends MY_Controller {
    public function __construct()
{
    parent::__construct();

    $this->load->library('user_agent');  // ✅ Load the User Agent library
}

    public function change_language($lang)
    {
        $this->session->set_userdata('site_language', $lang);
         redirect($this->agent->referrer());
    }
}
?>