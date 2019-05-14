<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {

	 public function __construct() {
       parent::__construct();
       $this->load->model('customer_model');
   }

	public function index()
	{
      $this->data['success_msg']=$this->session->userdata('success_msg');
      $this->data['error_msg']=$this->session->userdata('error_msg');
      
      $this->session->unset_userdata('success_msg');
      $this->session->unset_userdata('error_msg');
      
      $customerList = $this->customer_model->fetch();
      $this->data['customerList']=$customerList;
  		$this->load->view('customer/list',$this->data);
  		$this->load->view('common/footer',$this->data);
	}
	
	public function add()
	{
      $customer=array();
      $customer=$this->input->post('customer');

      $this->data['success_msg']="";
      $this->data['error_msg']="";
      
      if(count($customer) > 0){
        $checkunique=$this->checkunique($customer['customer_ledger'],false);
        if($checkunique=="false"){
          $result=$this->customer_model->add($customer);
          
          if($result > 0){
              $this->data['success_msg']="customer added";
          }
          else{
              $this->data['error_msg']="customer is not added";
          }
        }
        else{
          $this->data['error_msg']="Ledger name must be unique, unless can not save.";
        }
      }
      
      $this->load->view('customer/add',$this->data);
      $this->load->view('common/footer',$this->data);
	}
        
  public function edit($customer_id=null)
	{
            $customer=array();
            $customer=$this->input->post('customer');
            
            $this->data['success_msg']="";
            $this->data['error_msg']="";
          
            if(count($customer) > 0){
              $result=$this->customer_model->edit($customer,$customer_id); 
              
              if($result > 0){
                  $this->data['success_msg']="customer updated";
              }
              else{
                  $this->data['error_msg']="customer is not updated";
              }
            }
            
            /// Fetch all the value of the admission ///
            $cond="customer_id=".$customer_id;
            $details=$this->customer_model->fetch($cond);
            $this->data['details']=$details[0];
            
            $this->load->view('customer/edit',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
  public function deletecustomer($id=null)
	{
      $result=$this->customer_model->delete('customer_id',$id);
      if($result > 0){
          $this->session->set_userdata('success_msg', "customer deleted");
      }
      else{
          $this->session->set_userdata('error_msg', "customer not deleted");
      }
      redirect('index.php/customer/');
	}

  public function checkunique($ledgerName="", $isAjax=true){
      $cond="customer_ledger LIKE '".$ledgerName."'";
      $details=$this->customer_model->fetch($cond);
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

  public function checkuniqueboxno($box_no="", $isAjax=true){
      $cond="customer_box_no LIKE '".$box_no."'";
      $details=$this->customer_model->fetch($cond);
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

  public function fetchname($box_no="", $isAjax=true){
      $cond="customer_box_no LIKE '".$box_no."'";
      $details=$this->customer_model->fetch($cond);
      if(count($details) > 0){
         $name=$details[0]['customer_name'];
      }
      else{
        $name="";
      }
      if($isAjax){
        echo $name;
        die;
      }
      else{
        return $name;
      }
  }
}
