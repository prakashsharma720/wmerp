<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Set default language if not set
        if (!$this->session->userdata('site_language')) {
            $this->session->set_userdata('site_language', 'english');
        }

        // Load language file globally
        $this->lang->load('admin', $this->session->userdata('site_language'));
    }
}
