<?php

class home extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->_load();
    }
   
    function index() {
      //  echo "some working"; exit();
       
//        $classes = $this->ClassModel->get_all_classes($this->council_id, '', true, $items_per_page * ($current_page - 1), $items_per_page);
//        $all_classes_times = $this->ClassModel->get_all_classes($this->council_id);
//        $data['classes'] = $classes;
//        $data['paging'] = $this->get_paging(count($all_classes_times), count($classes), $items_per_page, $current_page);
//        $data['content'] = $this->load->view("admin/_ajax/_class", $data, true);
          $data = array();
          $this->template->load('user_template', 'home', $data, "Home");
    }

    private function _load() {
        //$this->load->model('class_model', "ClassModel");
        //$this->load->model('Location_model', "LocationModel");
        //$this->load->model("class_prerequisite_model", "ClassPrerequisiteModel");
    }

}
