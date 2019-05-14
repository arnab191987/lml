<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userlogin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('agent_model');
        $this->load->library('session');
    }

    public function index()
    {
            $this->load->helper('url');
            $this->data['base_url']= base_url();
            $this->load->view('users/login',$this->data);
    }
        
    public function check_login() {
        $this->load->helper('url');
        $this->load->library('session');
        
        $loginDetails = $this->input->post('login');
        
        $password= md5($loginDetails['password']);
        $cond = "username='{$loginDetails['username']}' and password='{$password}' AND user_role=2";
        $result = $this->user_model->fetch($cond);
        echo $this->db->last_query();
        $this->session->set_userdata('userID', $result[0]['user_id']);
        $this->session->set_userdata($result[0]);
        
       
        redirect('users/dashboard');
        // if($result[0]['user_role']!=1){
        //     redirect('index.php/bill/');
        // }
        // else{
            // redirect('index.php/user/');
        // }
    }
    
    function logout() {
        
        $this->load->helper('url');
        $this->load->library('session');

        $this->session->unset_userdata('usr_id');
        $this->session->unset_userdata('usr_name');
        $this->session->sess_destroy();

        $msg = "You have successfully logout";
        redirect(base_url()."users/");

    }

    public function changepass(){
        $this->load->helper('url');
        $this->data['base_url']= base_url();

        $message=$agent_id="";

        $agent_id=$this->input->post('agent_id');
        $oldpass=$this->input->post('oldpass');
        $newpass=$this->input->post('newpass');
        $confpass=$this->input->post('confpass');

        if($agent_id!=""){
            $oldpass= md5($oldpass);
            $cond = "user_id=".$agent_id." and password='".$oldpass."' AND user_role=2";
            $result = $this->user_model->fetch($cond);

            if(count($result) > 0){
                if($newpass == $confpass){
                    $cond = "user_id=".$agent_id;
                    $update['password']=md5($newpass);
                    $result = $this->user_model->edit_cond($update,$cond);  

                    $cond = "agent_username LIKE '".$result[0]['username']."'";
                    $update['agent_password']=md5($newpass);
                    $result = $this->agent_model->edit_cond($update,$cond);  

                    $message="Congratulations, password successfully changed!";   
                }
                else{
                   $message="New password and confirm password must be the same!";
                }
            }
            else{
                $message="Old password is mismatched.";
            }
        }

        $this->data['message']= $message;
        $this->load->view('userscommon/header',$this->data);
        $this->load->view('users/changepass');
        $this->load->view('userscommon/footer',$this->data);
    }
}
