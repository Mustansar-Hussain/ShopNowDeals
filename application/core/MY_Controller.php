<?php

class MY_Controller extends CI_Controller {
    
    public function __construct() {

        parent::__construct();
        $this->date_default_timezone_set();
    }

    function date_default_timezone_set() {
        
        //date_default_timezone_set('America/Los_Angeles');
        //date_default_timezone_set('Asia/Karachi');
        date_default_timezone_set('America/Denver');
        $this->load->library('email');
    }

    function ReturnJSON($success, $message, $data = array(), $send = true) {

        $response['application'] = 'Camponline';
        $response['status'] = $success;
        $response['message'] = $message;
        $response['data'] = $data;
        if ($send == false) {
            return json_encode($response);
        } else {
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
   
    function Session($key) {
        $userdata = $this->session->all_userdata();
        if (isset($userdata[$key]))
            return $userdata [$key];
        else
            return '';
    }

    function LoggedIn() {
        $userdata = $this->session->all_userdata();
        if (isset($userdata ['logged_in']))
            return true;
        else
            return false;
    }

    function SessionCheck($service = true) {
        if ($this->LoggedIn()) {
            if ($service == false) {
                redirect('/dashboard/', 'location');
                return false;
            } else {
                $data['login'] = true;
                $this->ReturnJSON(false, "YOU ARE NOT LOGGED IN", $data);
                return false;
            }
        } else {
            return true;
        }
    }

    function get_paging($total_items, $total_current_items, $items_per_page, $current_page) {

        $temp = $total_items / $items_per_page;
        $total_pages = (int) $temp;
        if ($total_pages < $temp)
            $total_pages ++;
        $data['total'] = $total_items;
        $data['current'] = $total_current_items;
        $data['items_per_page'] = $items_per_page;
        $data['total_pages'] = $total_pages;
        $data['current_page'] = $current_page;
        return $data;
    }

    function destroy_session() {
        $this->session->sess_destroy();
        redirect("/login");
    }

    function SendEmail($to, $subject, $message) {
        $result = $this->email
                ->from('shirleyn@bsa-brmc.org')
                ->to($to)
                ->subject($subject)
                ->message($message)
                ->send();
        if ($result)
            return true;
        else
            return false;
    }

    function no_permission() {
        $this->template->load('min_template', 'no_permission');
    }

}
