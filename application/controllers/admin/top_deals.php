<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class top_deals extends My_Controller {

	public function __construct() {
        parent::__construct();
        $this->_load();
    }

	public function index(){
	

        $tops = $this->DealModel->get_top_deals();
		
	
	//	$deals = $this->DealModel->get_deals();
		echo "comming here";
	//	print_r($deals);
		print_r($tops);
   	  	exit(1);
        $this->template->load('admin_template', 'admin/top_deals', $data , "Top Deals");
	}

	private function _load(){
		$this->load->model('deals_model', "DealModel");
	}
}