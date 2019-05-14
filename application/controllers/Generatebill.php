<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generatebill extends MY_Controller {

	 public function __construct() {
       parent::__construct();
       $this->load->model('customer_model');
       $this->load->model('agent_model');
       $this->load->model('reciptvoucher_model');
   }

	public function index()
	{
      $this->data['success_msg']=$this->session->userdata('success_msg');
      $this->data['error_msg']=$this->session->userdata('error_msg');
      
      $this->session->unset_userdata('success_msg');
      $this->session->unset_userdata('error_msg');

      $salevoucherList=array();
      
      $dateQuerystring=date("Y-m");
      $cond="voucher_type='sale' AND add_date LIKE '".$dateQuerystring."-%'";
      $salevoucherList=$this->reciptvoucher_model->fetch($cond);
     
      $this->data['salevoucherList']=$salevoucherList;
  		$this->load->view('generatebill/list',$this->data);
  		$this->load->view('common/footer',$this->data);
	}

  public function generate(){
    $this->data['success_msg']=$this->session->userdata('success_msg');
    $this->data['error_msg']=$this->session->userdata('error_msg');

    $this->session->unset_userdata('success_msg');
    $this->session->unset_userdata('error_msg');

    // $amount="";
    // $amount=$this->input->post('amount');

    // if($amount!=""){
      $customerList = $this->customer_model->fetch();
      foreach ($customerList as $key => $value) {
        $recipt=array(
          "voucher_type" => 'sale',
          "customer_ledger" => $value['customer_ledger'],
          "customer_name" => $value['customer_name'],
          "debit" => $value['customer_subscription'],
          "credit" => 0.00,
          "narration" =>"",
        );
        $this->reciptvoucher_model->add($recipt);
      }
     
      redirect('index.php/generatebill');
    // }
    // $this->load->view('generatebill/add',$this->data);
    $this->load->view('common/footer',$this->data);
  }
	
  public function register(){
      $this->data['success_msg']=$this->session->userdata('success_msg');
      $this->data['error_msg']=$this->session->userdata('error_msg');

      $this->session->unset_userdata('success_msg');
      $this->session->unset_userdata('error_msg');

      $search=$this->input->post('search');
      $cond="voucher_type LIKE 'recipt'";

      if(count($search) > 0){
          if($search['agent']!="0"){
              $searchDoc="recipt_voucher.agent_id LIKE '".$search['agent']."' AND ";
          }
          $cond=$searchDoc."add_date >='".$search['from_date']." 00:00:00' AND add_date <='".$search['to_date']." 23:59:59'";
      } 
      $join_cond =  array(
                        'agent' => array('agent.agent_id=recipt_voucher.agent_id', 'left'),
                    );
      $reciptvoucherList=$this->reciptvoucher_model->fetch_join($join_cond,$cond);
      $this->data['reciptvoucherList']=$reciptvoucherList;

     
      $agentList=$this->agent_model->fetch();
      $this->data['agentList']=$agentList;

      $this->load->view('generatebill/reciptvoucherlist',$this->data);
      $this->load->view('common/footer',$this->data);
    }
	
}
