<?php

class dashboard extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->_load();
        if(!$this->LoggedIn())
            redirect("admin/login");
    }
    
    function index($items_per_page = 10, $current_page = 1) {
            
            $deals = $this->DealModel->get_deals("",true, $items_per_page * ($current_page - 1), $items_per_page);
            $all_deals = $this->DealModel->get_deals("");
            $data['deals'] = $deals;
            $data['paging'] = $this->get_paging(count($all_deals), count($deals), $items_per_page, $current_page);
            $data['deals_content'] = $this->load->view("admin/_ajax/_deals" , $data, true);
            $this->template->load('admin_template', 'admin/dashboard', $data , "Dashboard");
    }
   
    function deals($items_per_page = 10, $current_page = 1){
        
          $deals = $this->DealModel->get_deals("",true, $items_per_page * ($current_page - 1), $items_per_page);
          $all_deals = $this->DealModel->get_deals("");
          $data['deals'] = $deals;
          $data['paging'] = $this->get_paging(count($all_deals), count($deals), $items_per_page, $current_page);
          $data['deals_content'] = $this->load->view("admin/_ajax/_deals" , $data, true);
          $this->template->load('admin_template', 'admin/dashboard', $data , "Dashboard");
    }
    
    private function _load() {
       $this->load->model('Deals_model', "DealModel");
    }
    
    
}
