<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    protected int $status = 1;
    protected int $login_id;
    protected int $department_id;
    protected int $role_id;
    protected int $flag = 0;

    public function __construct()
    {
        parent::__construct();

        $this->login_id = (int) ($this->session->userdata['logged_in']['id'] ?? 0);
        $this->department_id = (int) ($this->session->userdata['logged_in']['department_id'] ?? 0);
        $this->role_id = (int) ($this->session->userdata['logged_in']['role_id'] ?? 0);
    }
}
