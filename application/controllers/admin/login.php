<?php

class login extends MY_Controller {
   
    public function __construct() {
        parent::__construct();
        $this->_load();
        $method_name  =  $this->router->fetch_method();
        if($this->LoggedIn() && $method_name !='logout')
           redirect("/admin");
    }
    
    function index() {
        
          $data['res_url'] = base_url().'assets/';
          $this->template->load('admin_login_template', 'admin/login', $data , "Login");
    }
    
    function validate(){
       
          $user_name  = $this->input->post("user_name");
          $password   =  $this->input->post("password");
          if($this->UserMpdel->validate($user_name, $password)){
              redirect("/admin");
          }else{
              $this->session->set_flashdata("error","Invalid username/password");
              redirect("/admin/login");
          }
    }
    
    function logout(){
        $this->destroy_session();
    } 
    
    private function _load() {
        $this->load->model('Users_model', "UserMpdel");
    }

}
