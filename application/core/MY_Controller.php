<?php

/**
 * Core Controllers
 */
class MY_Controller extends CI_Controller{
    
    public $data = array();
    public $paginationOffset = "";
    
    public function __construct() {
        parent::__construct();
        $this->paginationOffset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->load->library('session');
        $this->load->library('pdf');
        //load mPDF library
        $this->load->library('m_pdf');
        $this->load->helper('url');

        $this->load->model('financial_year_model');
        
        $this->isLogin();
        $this->setINI();
    }
    
    private function setINI(){
        ini_set('memory_limit', "2048M");
        ini_set('upload_max_filesize', '50M');
        
        $this->load->helper('url');
        $this->data['base_url']= base_url();

        $this->load->view('common/header',$this->data);
        $this->load->view('common/leftsidebar',$this->data);
    }
    
    private function isLogin(){
        
         if ($this->session->userdata('userID') !== NULL) {
            $this->data['site_admin_id'] = $this->session->userdata('user_id');
            $this->data['site_admin_name'] = $this->session->userdata('name');
            $this->data['site_admin_type ']= $this->session->userdata('user_role');
        }
        else{
            redirect(base_url());
        }
    }

    

    protected function initializePagination($totalRows, $perPage){
        $this->load->library('pagination');
        $config['base_url'] = base_url()."dashboardctrl/keywordlist";
        $config['total_rows'] = $totalRows;
        $config['per_page'] = $perPage;
        
        $config['full_tag_open'] = '<div class="dataTables_paginate paging_bootstrap pagination"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next &rarr; ';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
    }
    
    
}