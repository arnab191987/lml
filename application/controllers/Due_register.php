<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Due_register extends MY_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('reciptvoucher_model');
        $this->load->model('customer_model'); 
        $this->load->model('paymentmode_model');
     }

	public function index()
	{
        $this->data['success_msg']="";
        $this->data['error_msg']="";
        $this->data['success_msg']=$this->session->userdata('success_msg');
        $this->data['error_msg']=$this->session->userdata('error_msg');

        $this->session->unset_userdata('success_msg');
        $this->session->unset_userdata('error_msg');

        $list=array();

        $dateQuerystring=date("Y-m");
        // $cond=" add_date LIKE '".$dateQuerystring."-%'";
        // $voucherlist=$this->reciptvoucher_model->fetch($cond);
        $sql="SELECT sale.customer_name,ifnull(sale.debit,0) as debit,ifnull(recipt.credit,0) as credit,sale.add_date FROM (SELECT * FROM `recipt_voucher` WHERE `add_date` LIKE '".$dateQuerystring."-%' AND voucher_type LIKE 'sale' GROUP BY customer_ledger) as sale LEFT JOIN (SELECT * FROM `recipt_voucher` WHERE `add_date` LIKE '".$dateQuerystring."-%' AND voucher_type LIKE 'recipt' GROUP BY customer_ledger) as recipt ON recipt.customer_ledger=sale.customer_ledger";
        $voucherlist =$this->db->query($sql)->result_array();
        // echo $this->db->last_query();
        // die;
        $i=0;
        $prev_customername="";
        $this->data['voucherlist']=$voucherlist;

        $this->load->view('due_register/list',$this->data);
        $this->load->view('common/footer',$this->data);
    }
        
        
}
