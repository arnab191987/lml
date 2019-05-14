<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reciptvoucher extends CI_Controller {

	 public function __construct() {
            parent::__construct();
            $this->load->model('reciptvoucher_model');
            $this->load->model('customer_model'); 
            $this->load->model('paymentmode_model');
         }

	

    public function add(){
        $this->load->helper('url');
        $this->data['base_url']= base_url();
        $reciptvoucher=array();
        $reciptvoucher=$this->input->post('reciptvoucher');

        if(count($reciptvoucher) > 0){
            $reciptVoucherList=$this->reciptvoucher_model->fetch();
            $totalrecivouchercount=count($reciptVoucherList)+1;
            // Generate Voucher No //
            $voucherNo= str_pad($totalrecivouchercount, 6,"0",STR_PAD_LEFT);
            $reciptvoucher['voucher_no']= "R".$voucherNo;
            $reciptvoucher['voucher_type']="recipt";
            $result=$this->reciptvoucher_model->add($reciptvoucher);
            if($result){
              redirect('users/dashboard');
            }
        }

        $this->load->view('userscommon/header',$this->data);
        $this->load->view('users/recipt_voucher_add');
        $this->load->view('userscommon/footer',$this->data);
    }
	
    public function statement(){
        $this->load->helper('url');
        $this->data['base_url']= base_url();
        $reciptvoucher=array();
        $reciptvoucher=$this->input->post('reciptvoucher');


        $customerList=$this->customer_model->fetch();
        $this->data['customerList']=$customerList;
       

        $this->load->view('userscommon/header',$this->data);
        $this->load->view('users/statement',$this->data);
        $this->load->view('userscommon/footer',$this->data);
    }

     public function statement_show(){
        $this->load->helper('url');
        $this->data['base_url']= base_url();
        $search=$reciptvoucherList=array();
        $search=$this->input->post('search');
        
        $cond="add_date >='".$search['from_date']." 00:00:00' AND add_date <='".$search['to_date']." 11:59:59' AND customer_ledger LIKE '".$search['customer_ledger']."'";
        $reciptvoucherList=$this->reciptvoucher_model->fetch($cond);
        // echo $this->db->last_query();
        // print_r($reciptvoucherList);
        // die;
        $this->data['reciptvoucherList']=$reciptvoucherList;

        $this->load->view('users/statement_show',$this->data);
    }

    public function mycollection(){
        $this->load->helper('url');
        $this->data['base_url']= base_url();
        $search=$reciptvoucherList=array();
        $search=$this->input->post('search');
        
        $cond="agent_id LIKE '".$this->session->userdata('user_id')."'";
        $reciptvoucherList=$this->reciptvoucher_model->fetch($cond);
        // echo $this->db->last_query();
        // print_r($reciptvoucherList);
        // die;
        $this->data['reciptvoucherList']=$reciptvoucherList;

        $this->load->view('users/mycollection',$this->data);
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
