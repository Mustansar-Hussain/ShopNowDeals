<?php

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
   
    function validate($user_name, $password) {
        $Users = $this->Tables("user");
      
        $this->db->select("$Users.*");
        $this->db->from($Users);
        $this->db->where('UserName', $user_name);
        $this->db->where('Password', md5($password));
        $query = $this->db->get();
        $UserData = $query->result_array();
        if (count($UserData)>0) {
            $UserData = $UserData['0'];
            $this->session->set_userdata("user",$UserData);
            $data['session'] = true;
            $this->session->set_userdata("logged_in", true);
            $this->session->set_userdata("user_id", $UserData['UserID']);
            return true;
        } else
            return false;
    }
    
    Private function Tables($table) {
         $TABLE['user'] = 'user';
         return $TABLE[$table];
    }

}
