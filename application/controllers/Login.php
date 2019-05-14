<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('session');
    }

    public function index()
    {
            $this->load->helper('url');
            $this->data['base_url']= base_url();
            $this->load->view('login',$this->data);
    }
        
    public function check_login() {
        $this->load->helper('url');
        $this->load->library('session');
        
        $loginDetails = $this->input->post('login');
        
        $password= md5($loginDetails['password']);
        $cond = "username='{$loginDetails['username']}' and password='{$password}'";
        $result = $this->user_model->fetch($cond);
        
        $this->session->set_userdata('userID', $result[0]['user_id']);
        $this->session->set_userdata($result[0]);
        
//        print_r($result);
        // if($result[0]['user_role']!=1){
        //     redirect('index.php/bill/');
        // }
        // else{
            redirect('index.php/user/');
        // }
    }
    
    function logout() {
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->session->unset_userdata('usr_id');
        $this->session->unset_userdata('usr_name');
        $this->session->sess_destroy();

        $msg = "You have successfully logout";
        redirect(base_url());

    }
}
