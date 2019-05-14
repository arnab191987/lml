<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends MY_Controller {

	 public function __construct() {
             parent::__construct();
             $this->load->model('agent_model');
             $this->load->model('user_model');
         }

	public function index()
	{
      $this->data['success_msg']=$this->session->userdata('success_msg');
      $this->data['error_msg']=$this->session->userdata('error_msg');

      $this->session->unset_userdata('success_msg');
      $this->session->unset_userdata('error_msg');

      $agentList = $this->agent_model->fetch();
      $this->data['agentList']=$agentList;
      $this->load->view('agent/list',$this->data);
      $this->load->view('common/footer',$this->data);
	}
	
	public function add()
	{
            $agent=array();
            $agent=$this->input->post('agent');
            
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            
            if(count($agent) > 0){
              $agent['agent_password']=md5($agent['agent_password']);
              $result=$this->agent_model->add($agent);
              if($result > 0){
                  $userArr['username']=$agent['agent_username'];
                  $userArr['password']=$agent['agent_password'];
                  $userArr['name']=$agent['agent_name'];
                  $userArr['user_role']=2;
                  $this->user_model->add($userArr);
                  $this->data['success_msg']="Agent information added";
              }
              else{
                  $this->data['error_msg']="Agent information not added";
              }
            }
            
            $this->load->view('agent/add',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
        public function edit($id=null)
	{
            $agent=array();
            $agent=$this->input->post('agent');
            
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            if(count($agent) > 0){
              $agent['agent_password']=md5($agent['agent_password']);
              $result=$this->agent_model->add($agent);
              $result=$this->agent_model->edit($agent,$id);
              if($result > 0){
                  $userArr['username']=$agent['agent_username'];
                  $userArr['password']=$agent['agent_password'];
                  $userArr['name']=$agent['agent_name'];
                  $userArr['user_role']=2;
                  $this->user_model->edit($userArr);
                  $this->data['success_msg']="agent information updated";
              }
              else{
                  $this->data['error_msg']="agent information not updated";
              }
            }
            
            $cond="agent_id=".$id;
            $details=$this->agent_model->fetch($cond);
            $this->data['details']=$details[0];
            
            $this->load->view('agent/edit',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
  public function deleteagent($id=null)
	{
      $result=$this->agent_model->delete('agent_id',$id);
      if($result > 0){
          $this->session->set_userdata('success_msg', "Agent information deleted");
      }
      else{
          $this->session->set_userdata('error_msg', "Agent information not deleted");
      }
      redirect('index.php/agent/');
	}

  public function checkunique($username="", $isAjax=true){
      $cond="agent_username LIKE '".$username."'";
      $details=$this->agent_model->fetch($cond);
      if(count($details) > 0){
         $show="true";
      }
      else{
        $show="false";
      }
      if($isAjax){
        echo $show;
        die;
      }
      else{
        return $show;
      }
  }
}
