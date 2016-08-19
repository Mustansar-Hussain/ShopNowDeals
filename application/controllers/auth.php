<?php

class Auth extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("users_model");
        $this->load->model('campweek_model', "CampWeekModel");
    }
     
//    function validate(){
//        $Username = $this->input->post("username");
//        $Password = $this->input->post("password");
//        $Remember = $this->input->post("remember");
//        $response = $this->users_model->validate($Username, md5($Password));
//        $UserData = $this->session->userdata("user");
//        if (!empty($response)) {
//            if (is_troop()) {
//                $UserData = $this->session->userdata("user");
//                if (empty($UserData['Active'])) {
//                    $this->session->sess_destroy();
//                    $this->ReturnJSON(false, "This account currently not active.", "");
//                    die();
//                } else if (!empty($UserData['OverrideLogin'])){
//                    //$this->override_login($this->camp_week($UserData['CampWeekID']), TRUE);
//                } else if (empty($UserData['OverrideLogin'])){
//                    $this->override_login($this->camp_week($UserData['CampWeekID']), FALSE);
//                }
//                if(!$this->is_camp_availble($this->camp_week($UserData['CampWeekID']))){
//                    $this->session->sess_destroy();
//                    $this->ReturnJSON(false, "Note: Sorry, camp is not available.", "");
//                    die();
//                }
//            }
//            $data['user_role'] = $this->Session("user_role");
//            $this->ReturnJSON(true, "Successfully loggedin.", $data);
//            die();
//        } else {
//            $this->ReturnJSON(false, "Invalid Username or Password.", "");
//            die();
//        }
//    }
    
     function validate(){
        $Username = $this->input->post("username");
        $Password = $this->input->post("password");
        $Remember = $this->input->post("remember");
        $response = $this->users_model->validate($Username, md5($Password));
        $UserData = $this->session->userdata("user");
        if (!empty($response)) {
            if (is_troop()) {
                $UserData = $this->session->userdata("user");
                if (empty($UserData['Active'])) {
                    $this->session->sess_destroy();
                    $this->session->set_flashdata("error_message","This account currently not active.");
                    redirect('/login');                        
                } else if (!empty($UserData['OverrideLogin'])){
                    //$this->override_login($this->camp_week($UserData['CampWeekID']), TRUE);
                } else if (empty($UserData['OverrideLogin'])){
                    $this->override_login($this->camp_week($UserData['CampWeekID']), FALSE);
                }
                if(!$this->is_camp_availble($this->camp_week($UserData['CampWeekID']))){
                    $this->session->sess_destroy();
                    $this->session->set_flashdata("error_message","Note: Sorry, camp is not available.");
                    redirect('/login');   
                }
            }
            $data['user_role'] = $this->Session("user_role");
            $this->session->set_flashdata("success_message","Successfully loggedin.");
            redirect('/');   
        } else {
            $this->session->set_flashdata("error_message","Invalid Username or Password.");
            redirect('/login');  
        }
    }
    
    function camp_week($camp_week_id) {
        $camp_week = $this->CampWeekModel->get_camp_week($camp_week_id);
        return $camp_week;
    }
    
    function is_camp_availble($campWeek){
         return (!empty($campWeek['Available']) ? true : false);
         
    }
    
    function override_login($camp_week, $is_override_login = false) {
        
        if (!empty($is_override_login)){
            if(todaydate() <=  get_date_12pm($camp_week['LoginStop'])) {
                redirect('/');
            }else{
                $this->session->sess_destroy();
//                $this->ReturnJSON(false, "Note: Sorry, your login period begins at " . date("d-m-Y h:i a " , get_date_12pm($camp_week['LoginStart'])). " and goes through " . date("d-m-Y h:i a " , get_date_12pm($camp_week['LoginStop'])) . ".", "");
//                die();
                $this->session->set_flashdata("error_message","Note: Sorry, your login period begins at " . date("d-m-Y h:i a " , get_date_12pm($camp_week['LoginStart'])). " and goes through " . date("d-m-Y h:i a " , get_date_12pm($camp_week['LoginStop'])) . ".");
                redirect('/login');   
                
            }
        }else if (empty($is_override_login)) {
            if (todaydate() >= get_date_12pm($camp_week['LoginStart']) &&  todaydate() <=  get_date_12pm($camp_week['LoginStop'])) {
                redirect('/');
             } else {
                $this->session->sess_destroy();
//                $this->ReturnJSON(false, "Note: Sorry, your login period begins at " . date("d-m-Y h:i a " , get_date_12pm($camp_week['LoginStart'])). " and goes through " . date("d-m-Y h:i a " , get_date_12pm($camp_week['LoginStop'])) . ".", "");
//                die();
                $this->session->set_flashdata("error_message","Note: Sorry, your login period begins at " . date("d-m-Y h:i a " , get_date_12pm($camp_week['LoginStart'])). " and goes through " . date("d-m-Y h:i a " , get_date_12pm($camp_week['LoginStop'])) . ".");
                redirect('/login');  
            }
        }
    }

}
