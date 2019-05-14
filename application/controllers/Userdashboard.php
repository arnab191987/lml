<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userdashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
    }

    public function index()
    {
        $this->load->helper('url');
        $this->data['base_url']= base_url();
        $this->load->view('userscommon/header',$this->data);
        $this->load->view('users/dashboard',$this->data);
        $this->load->view('userscommon/footer',$this->data);
    }
   
}
