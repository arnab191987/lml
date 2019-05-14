<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reciptvoucher extends MY_Controller {

	 public function __construct() {
             parent::__construct();
             $this->load->model('reciptvoucher_model');
             $this->load->model('paymentmode_model');
             $this->load->model('customer_model');
         }

	public function index()
	{
                $this->data['success_msg']="";
                $this->data['error_msg']="";
                
                $this->data['success_msg']=$this->session->userdata('success_msg');
                $this->data['error_msg']=$this->session->userdata('error_msg');
                
                $this->session->unset_userdata('success_msg');
                $this->session->unset_userdata('error_msg');
                
                
                $join_cond = array(
                    'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
                    'customer' => array('customer_ledger=recipt_voucher.posting_ledger', 'left'),
                );
                $cond="voucher_type='recipt'";
                $reciptvoucherList = $this->reciptvoucher_model->fetch_join($join_cond,$cond);
                for($i=0;$i <count($reciptvoucherList);$i++){
                    $getOpdDetails=array();
                   if($reciptvoucherList[$i]['recipt_voucher_type']=='opd'){
                        $opdcond="opd_no LIKE '".$reciptvoucherList[$i]['party']."'";
                        $getOpdDetails=$this->opd_patient_model->fetch($opdcond);
                        if(count($getOpdDetails) > 0){
                            $reciptvoucherList[$i]['patient_name']=$getOpdDetails[0]['patient_name'];
                            $reciptvoucherList[$i]['age']=$getOpdDetails[0]['age'];
                            $reciptvoucherList[$i]['sex']=$getOpdDetails[0]['sex'];
                            $reciptvoucherList[$i]['patient_address']=$getOpdDetails[0]['patient_address'];
                            $reciptvoucherList[$i]['patient_ps']=$getOpdDetails[0]['patient_ps'];
                            $reciptvoucherList[$i]['patient_city_district']=$getOpdDetails[0]['patient_city_district'];
                            $reciptvoucherList[$i]['patient_pin']=$getOpdDetails[0]['patient_pin'];
                        }
                   }
                }
                $this->data['reciptvoucherList']=$reciptvoucherList;
        		$this->load->view('reciptvoucher/list',$this->data);
        		$this->load->view('common/footer',$this->data);
	}
        
        public function mrregister()
	{
                $this->data['success_msg']="";
                $reciptvoucher=array();
                $reciptvoucher=$this->input->post('reciptvoucher');
                if(count($reciptvoucher) > 0){
                    if($reciptvoucher['to_date'] >= $reciptvoucher['from_date']){
                        if($reciptvoucher['to_date'] == $reciptvoucher['from_date']){
                            $cond=" recipt_voucher.add_date LIKE '%".$reciptvoucher['from_date']."%' AND voucher_type='recipt'";
                        }
                        else{
                            $reciptvoucher['from_date']=$reciptvoucher['from_date']." 00:00:00";
                            $reciptvoucher['to_date']=$reciptvoucher['to_date']." 23:59.59";
                            $cond=" recipt_voucher.add_date >= '".$reciptvoucher['from_date']."' AND recipt_voucher.add_date < '".$reciptvoucher['to_date']."' AND voucher_type='recipt'";
                        }
                        if(!empty($reciptvoucher['vouchar_no'])){
                            $cond.=" AND recipt_voucher.voucher_no='".$reciptvoucher['vouchar_no']."'";
                        }
                        $join_cond = array(
                            'admission' => array('admission.ipd_no=recipt_voucher.party', 'left'),
                            'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
                            'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
                        );
                        $voucharList = $this->reciptvoucher_model->fetch_join($join_cond,$cond,'*,recipt_voucher.add_date as add_date');
                    }
                    else{
                        $voucharList=array();
                        $this->data['success_msg']="To Date must be greated then from Date";
                    }
                }
                else{
                    $voucharList=array();   
                }
//               echo $this->db->last_query();
                $this->data['voucharList']=$voucharList;
		$this->load->view('report/mrregister',$this->data);
		$this->load->view('common/footer',$this->data);
	}

    public function add(){
        echo "hii";
        $this->load->view('userscommon/header');
        $this->load->view('users/add');
        $this->load->view('userscommon/footer');
    }
	
	public function addstep1()
	{
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            
            $this->data['success_msg']=$this->session->userdata('success_msg');
            $this->data['error_msg']=$this->session->userdata('error_msg');
            
            $this->session->unset_userdata('success_msg');
            $this->session->unset_userdata('error_msg');

            $reciptvoucher=array();
            $reciptvoucher=$this->input->post('reciptvoucher');
            
            if(count($reciptvoucher) > 0){
              $result=$this->admission_model->add($admission);
            }
            
            $this->load->view('reciptvoucher/addstep1',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
        public function addstep2() {
            $admission=array();
            $admission=$this->input->post('admission');
            $admissionData=array();
            if(empty($admission['ipd_no'])){
                redirect('index.php/reciptvoucher/addstep1');
            }

            if($admission['recipt_voucher_type']=="ipd"){
                $cond="ipd_no='".$admission['ipd_no']."'";
                $admissionData = $this->admission_model->fetch($cond);    
            }
            elseif ($admission['recipt_voucher_type']=="opd") {
                $cond="opd_no='".$admission['ipd_no']."'";
                $admissionData = $this->opd_patient_model->fetch($cond); 
            }

            if(count($admissionData) > 0){
                $admissionData[0]['depositer_name']=$this->input->post('admission[depositer_name]');
                $this->data['details']=$admissionData[0];
            }
            if(count($admissionData)==0){
                $this->session->set_userdata('error_msg', "Match not found");

                redirect('index.php/reciptvoucher/addstep1');
            }
            $this->data['recipt_voucher_type']=$admission['recipt_voucher_type'];
            $this->load->view('reciptvoucher/addstep2',$this->data);
            $this->load->view('common/footer',$this->data);
        }
        
        public function addstep3() {
            $ledgerList=$this->ledgermaster_model->fetch();
            $this->data['ledgerList']=$ledgerList;
            
            $paymentModeList=$this->paymentmode_model->fetch();
            $this->data['paymentModeList']=$paymentModeList;
            
            $this->data['ipd']=$this->input->post('admission[ipd_no]');
            $this->data['depositer_name']=$this->input->post('admission[depositer_name]');
            $this->data['recipt_voucher_type']=$this->input->post('admission[recipt_voucher_type]');
            $voucher=array();
            $voucher=$this->input->post('voucher');
            if(count($voucher) > 0){
              $voucher['voucher_type']='recipt';
              $result=$this->reciptvoucher_model->add($voucher);
              // Generate Voucher No //
              $voucherNo= str_pad($result[0]['id'], 6,"0",STR_PAD_LEFT);
              $voucher['voucher_no']= "R".$voucherNo;
              
              $val=0;
              $val=$this->reciptvoucher_model->edit($voucher,$result[0]['id']);
              if($val!=0){
                  redirect('index.php/reciptvoucher');
              }
            }
            
            $this->load->view('reciptvoucher/addstep3',$this->data);
            $this->load->view('common/footer',$this->data);
        }
        
        public function edit($voucherno=null) {
            $this->data['success_msg']="";
            $this->data['error_msg']="";
                
            $ledgerList=$this->ledgermaster_model->fetch();
            $this->data['ledgerList']=$ledgerList;
            
            $paymentModeList=$this->paymentmode_model->fetch();
            $this->data['paymentModeList']=$paymentModeList;
            
            $this->data['ipd']=$this->input->post('admission[ipd_no]');
            
            $voucher=array();
            $voucher=$this->input->post('voucher');
            if(count($voucher) > 0){
              $val=0;
              $cond=" voucher_no='".$voucherno."'";
              $val=$this->reciptvoucher_model->edit_cond($voucher,$cond);
              if($val!=0){
                  $this->session->set_userdata('success_msg','Vocher updated successfully.');
                 
              }
              else{
                  $this->session->set_userdata('error_msg','Cannot update the vouchar.');
              }
               redirect('index.php/reciptvoucher');
            }
            else{
                 $join_cond = array(
                    'admission' => array('admission.ipd_no=recipt_voucher.party', 'left'),
                    'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
                    'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
                );
                $cond="voucher_type='recipt' AND recipt_voucher.voucher_no='".$voucherno."'";
                $reciptvoucherDetails = $this->reciptvoucher_model->fetch_join($join_cond,$cond);
            }
            $this->data['reciptvoucherDetails']=$reciptvoucherDetails;
            $this->data['voucher']=$reciptvoucherDetails[0]['voucher_no'];
            $this->load->view('reciptvoucher/edit',$this->data);
            $this->load->view('common/footer',$this->data);
        }
        
        public function deletevoucher($voucherno=null)
	{
            $result=$this->reciptvoucher_model->delete('voucher_no ',$voucherno);
            if($result > 0){
                $this->session->set_userdata('success_msg', "Vouchar deleted");
            }
            else{
                $this->session->set_userdata('error_msg', "Vouchar is not deleted");
            }
            redirect('index.php/reciptvoucher/');
	}
        
        public function viewvoucherbyipd($ipd=null)
	{
                $join_cond = array(
                    'admission' => array('admission.ipd_no=recipt_voucher.party', 'left'),
                    'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
                    'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
                );
                $cond="voucher_type='recipt' AND party='".$ipd."'";
                $reciptvoucherList = $this->reciptvoucher_model->fetch_join($join_cond,$cond);
                $this->data['reciptvoucherList']=$reciptvoucherList;
	
                $this->pdf->load_view('reciptvoucher/listPdfPrint',$this->data);
                $this->pdf->render();
                $this->pdf->stream("Recipt Voucher.pdf",array('Attachment'=>0));
	}
        
        public function printall()
	{
                $join_cond = array(
                    'admission' => array('admission.ipd_no=recipt_voucher.party', 'left'),
                    'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
                    'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
                );
                $cond="voucher_type='recipt'";
                $reciptvoucherList = $this->reciptvoucher_model->fetch_join($join_cond,$cond);
                $this->data['reciptvoucherList']=$reciptvoucherList;
	
                $this->pdf->load_view('reciptvoucher/listPdfPrint',$this->data);
                $this->pdf->render();
                $this->pdf->stream("Recipt Voucher.pdf",array('Attachment'=>0));
	}
        
        public function printmr($voucherno=null)
	{
                if(!empty($voucherno)){
                $join_cond = array(
                    'admission' => array('admission.ipd_no=recipt_voucher.party', 'left'),
                    'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
                    'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
                );
                $cond="voucher_type='recipt' AND voucher_no='".$voucherno."'";
                $reciptvoucherDetails = $this->reciptvoucher_model->fetch_join($join_cond,$cond,'*,recipt_voucher.add_date as reciptvouchar_date');
                $this->data['reciptvoucherDetails']=$reciptvoucherDetails[0];
	
                $this->pdf->load_view('reciptvoucher/mr_print',$this->data);
                $this->pdf->render();
                $this->pdf->stream("Recipt Voucher.pdf",array('Attachment'=>0));
                }
                else{
                    redirect('index.php/reciptvoucher/');
                }
	}

    public function closingreport(){
        $this->data['success_msg']="";
        $this->data['error_msg']="";

        $reciptvoucher=array();
        $reciptvoucher=$this->input->post('reciptvoucher');
        if(count($reciptvoucher) > 0){
        $date=$reciptvoucher['from_date'];
        ///////////////// FIND RECIPT VOUCHAR DETAILS //////////////////

        $cond=" recipt_voucher.add_date LIKE '%".$reciptvoucher['from_date']."%' AND voucher_type='recipt'";
                
        $join_cond = array(
            'admission' => array('admission.ipd_no=recipt_voucher.party', 'left'),
            'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
            'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
        );
        $reciptVoucharList = $this->reciptvoucher_model->fetch_join($join_cond,$cond,'*,recipt_voucher.add_date as add_date');

        ///////////////// FIND PAYMENT VOUCHAR DETAILS //////////////////
         
        $cond=" recipt_voucher.add_date LIKE '%".$reciptvoucher['from_date']."%' AND voucher_type='payment'";
             
        $join_cond = array(
            'admission' => array('admission.ipd_no=recipt_voucher.party', 'left'),
            'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
            'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
        );
        $paymentVoucharList = $this->reciptvoucher_model->fetch_join($join_cond,$cond,'*,recipt_voucher.add_date as add_date');   

        ///////////////// FIND PAYMENT VOUCHAR DETAILS //////////////////

        ///////////////////// CASH RECIVED ////////////////////////////
        $cashrecived=0;
        $cashgiven=0;
        $cashcredit=array();
        $cond=" recipt_voucher.add_date LIKE '%".$reciptvoucher['from_date']."%' AND voucher_type='recipt' AND mode=1";
                
        $join_cond = array(
            'admission' => array('admission.ipd_no=recipt_voucher.party', 'left'),
            'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
            'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
        );
        $cashcredit = $this->reciptvoucher_model->fetch_join($join_cond,$cond,'sum(credit) as cashcredit');

        if(count($cashcredit) > 0){
            $cashrecived=$cashcredit[0]['cashcredit'];
        }
        ///////////////////// CASH GIVEN ////////////////////////////
        $cashdebit=array();
        $cond=" recipt_voucher.add_date LIKE '%".$reciptvoucher['from_date']."%' AND voucher_type='payment' AND mode=1";
                
        $join_cond = array(
            'admission' => array('admission.ipd_no=recipt_voucher.party', 'left'),
            'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
            'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
        );
        $cashdebit = $this->reciptvoucher_model->fetch_join($join_cond,$cond,'sum(debit) as cashdebit');
        // echo $this->db->last_query();
        if(count($cashdebit) > 0){
            $cashgiven=$cashdebit[0]['cashdebit'];
        }

        }
        else{
            $reciptVoucharList=array();   
            $paymentVoucharList=array();
            $cashrecived=0;
            $cashgiven=0;
            $cashcredit=array();
            $cashdebit=array();
            $date=date("Y-m-d");
        }
//               echo $this->db->last_query();
        $this->data['date']=$date;
        $this->data['reciptVoucharList']=$reciptVoucharList;
        $this->data['paymentVoucharList']=$paymentVoucharList;
        $this->data['cashcredit']=$cashrecived;
        $this->data['cashdebit']=$cashgiven;
        $this->data['cashinhand']=$cashrecived-$cashgiven;

        $this->load->view('report/closeing_report',$this->data);
        $this->load->view('common/footer',$this->data);
    }

    public function closingreportpdf($date=""){
        $this->data['success_msg']="";
        $this->data['error_msg']="";

        $reciptvoucher=array();
        $reciptvoucher=$this->input->post('reciptvoucher');
    
        
        ///////////////// FIND RECIPT VOUCHAR DETAILS //////////////////

        $cond=" recipt_voucher.add_date LIKE '%".$date."%' AND voucher_type='recipt'";
                
        $join_cond = array(
            'admission' => array('admission.ipd_no=recipt_voucher.party', 'left'),
            'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
            'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
        );
        $reciptVoucharList = $this->reciptvoucher_model->fetch_join($join_cond,$cond,'*,recipt_voucher.add_date as add_date');

        ///////////////// FIND PAYMENT VOUCHAR DETAILS //////////////////
         
        $cond=" recipt_voucher.add_date LIKE '%".$date."%' AND voucher_type='payment'";
             
        $join_cond = array(
            'admission' => array('admission.ipd_no=recipt_voucher.party', 'left'),
            'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
            'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
        );
        $paymentVoucharList = $this->reciptvoucher_model->fetch_join($join_cond,$cond,'*,recipt_voucher.add_date as add_date');   

        ///////////////// FIND PAYMENT VOUCHAR DETAILS //////////////////

        ///////////////////// CASH RECIVED ////////////////////////////
        $cashrecived=0;
        $cashgiven=0;
        $cashcredit=array();
        $cond=" recipt_voucher.add_date LIKE '%".$date."%' AND voucher_type='recipt' AND mode=1";
                
        $join_cond = array(
            'admission' => array('admission.ipd_no=recipt_voucher.party', 'left'),
            'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
            'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
        );
        $cashcredit = $this->reciptvoucher_model->fetch_join($join_cond,$cond,'sum(credit) as cashcredit');

        if(count($cashcredit) > 0){
            $cashrecived=$cashcredit[0]['cashcredit'];
        }
        ///////////////////// CASH GIVEN ////////////////////////////
        $cashdebit=array();
        $cond=" recipt_voucher.add_date LIKE '%".$date."%' AND voucher_type='payment' AND mode=1";
                
        $join_cond = array(
            'admission' => array('admission.ipd_no=recipt_voucher.party', 'left'),
            'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
            'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
        );
        $cashdebit = $this->reciptvoucher_model->fetch_join($join_cond,$cond,'sum(debit) as cashdebit');
        // echo $this->db->last_query();
        if(count($cashdebit) > 0){
            $cashgiven=$cashdebit[0]['cashdebit'];
        }

        
//               echo $this->db->last_query();
        $this->data['date']=$date;
        $this->data['reciptVoucharList']=$reciptVoucharList;
        $this->data['paymentVoucharList']=$paymentVoucharList;
        $this->data['cashcredit']=$cashrecived;
        $this->data['cashdebit']=$cashgiven;
        $this->data['cashinhand']=$cashrecived-$cashgiven;

        //load the view, pass the variable and do not show it but "save" the output into $html variable
        $html=$this->load->view('report/closeing_report_pdf',$this->data,true);

        //this the the PDF filename that user will get to download
        $pdfFilePath = "Closing report.pdf";
        
        //actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //generate the PDF!
        $pdf->WriteHTML($html);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "I");
    }

    public function closingreportsummarypdf($date=""){
        $this->data['success_msg']="";
        $this->data['error_msg']="";

        $reciptvoucher=array();
        $reciptvoucher=$this->input->post('reciptvoucher');
    
        
        ///////////////// FIND RECIPT VOUCHAR DETAILS //////////////////

        $cond=" recipt_voucher.add_date LIKE '%".$date."%' AND voucher_type='recipt'";
                
        $join_cond = array(
            'admission' => array('admission.ipd_no=recipt_voucher.party', 'left'),
            'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
            'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
        );
        $reciptVoucharList = $this->reciptvoucher_model->fetch_join($join_cond,$cond,'*,recipt_voucher.add_date as add_date');

        ///////////////// FIND PAYMENT VOUCHAR DETAILS //////////////////
         
        $cond=" recipt_voucher.add_date LIKE '%".$date."%' AND voucher_type='payment'";
             
        $join_cond = array(
            'admission' => array('admission.ipd_no=recipt_voucher.party', 'left'),
            'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
            'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
        );
        $paymentVoucharList = $this->reciptvoucher_model->fetch_join($join_cond,$cond,'*,recipt_voucher.add_date as add_date');   

        ///////////////// FIND PAYMENT VOUCHAR DETAILS //////////////////

        ///////////////////// CASH RECIVED ////////////////////////////
        $cashrecived=0;
        $cashgiven=0;
        $cashcredit=array();
        $cond=" recipt_voucher.add_date LIKE '%".$date."%' AND voucher_type='recipt' AND mode=1";
                
        $join_cond = array(
            'admission' => array('admission.ipd_no=recipt_voucher.party', 'left'),
            'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
            'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
        );
        $cashcredit = $this->reciptvoucher_model->fetch_join($join_cond,$cond,'sum(credit) as cashcredit');

        if(count($cashcredit) > 0){
            $cashrecived=$cashcredit[0]['cashcredit'];
        }
        ///////////////////// CASH GIVEN ////////////////////////////
        $cashdebit=array();
        $cond=" recipt_voucher.add_date LIKE '%".$date."%' AND voucher_type='payment' AND mode=1";
                
        $join_cond = array(
            'admission' => array('admission.ipd_no=recipt_voucher.party', 'left'),
            'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
            'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
        );
        $cashdebit = $this->reciptvoucher_model->fetch_join($join_cond,$cond,'sum(debit) as cashdebit');
        // echo $this->db->last_query();
        if(count($cashdebit) > 0){
            $cashgiven=$cashdebit[0]['cashdebit'];
        }

        
//               echo $this->db->last_query();
        $this->data['date']=$date;
        $this->data['reciptVoucharList']=$reciptVoucharList;
        $this->data['paymentVoucharList']=$paymentVoucharList;
        $this->data['cashcredit']=$cashrecived;
        $this->data['cashdebit']=$cashgiven;
        $this->data['cashinhand']=$cashrecived-$cashgiven;

        //load the view, pass the variable and do not show it but "save" the output into $html variable
        $html=$this->load->view('report/closeing_report_summary_pdf',$this->data,true);

        //this the the PDF filename that user will get to download
        $pdfFilePath = "Closing report.pdf";
        
        //actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //generate the PDF!
        $pdf->WriteHTML($html);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "I");
    }
        
}
