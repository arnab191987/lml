<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	 public function __construct() {
             parent::__construct();
             $this->load->model('user_model');
             $this->load->model('user_role_model');
         }

	public function index()
	{
                $this->data['success_msg']=$this->session->userdata('success_msg');
                $this->data['error_msg']=$this->session->userdata('error_msg');
                
                $this->session->unset_userdata('success_msg');
                $this->session->unset_userdata('error_msg');
                
                $join_cond = array(
                    'user_role' => array('user_role.role_id=user.user_role', 'left')
                );
                $userList = $this->user_model->fetch_join($join_cond);
                $this->data['userList']=$userList;
		$this->load->view('user/list',$this->data);
		$this->load->view('common/footer',$this->data);
	}
	
	public function add()
	{
            $user=array();
            $user=$this->input->post('user');
            $roleList=$this->user_role_model->fetch();
            $this->data['roleList']=$roleList;
            
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            
            if(count($user) > 0){
              $user['user_role']=$user['user_role'];
              $user['password']=md5($user['password']);
              $result=$this->user_model->add($user);
              if($result > 0){
                  $this->data['success_msg']="User is added";
              }
              else{
                  $this->data['error_msg']="User is not added";
              }
            }
            
            $this->load->view('user/add',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
        public function edit($user_id=null){
            
            $user=array();
            $user=$this->input->post('user');
            $roleList=$this->user_role_model->fetch();
            $this->data['roleList']=$roleList;
            
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            
            if(count($user) > 0){
              $user['user_role']=$user['user_role'];
              $user['password']=$user['password'];
              if($user['password']==""){
                  unset($user['password']);
              }
              $result=$this->user_model->edit($user,$user_id);
              if($result > 0){
                  $this->data['success_msg']="User is updated";
              }
              else{
                  $this->data['error_msg']="User is not updated";
              }
            } 
            
            /// Fetch all the value of the user ///
            $cond="user_id=".$user_id;
            $details=$this->user_model->fetch($cond);
            $this->data['details']=$details[0];
            
            $this->load->view('user/edit',$this->data);
            $this->load->view('common/footer',$this->data);
        }
        
        public function deleteuser($id=null)
	{
            $result=$this->user_model->delete('user_id',$id);
            if($result > 0){
                $this->session->set_userdata('success_msg', "User is deleted");
            }
            else{
                $this->session->set_userdata('error_msg', "User is not deleted");
            }
            redirect('index.php/user/');
	}
}
