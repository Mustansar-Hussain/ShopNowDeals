<?php

class Company_model extends CI_Model {
   
    function __construct() {
        parent::__construct();
    }
    
    function save_company($data) {

        $Company = $this->Tables("companies");
        if ($this->db->insert($Company , $data))
            return $this->db->insert_id();
        else
            return false;
    }
    
    function get_companies($company_id = '', $limit = false, $start = 0, $count = 10, $order_by = '', $sort = 'ASC') {

        $Companies = $this->Tables("companies");
    
        $this->db->select("*");
        $this->db->from($Companies);
        if ($company_id != '')
            $this->db->where("CompanyID", $company_id);
        if ($limit)
            $this->db->limit($count, $start);
        if ($order_by != '')
            $this->db->order_by("$order_by", "$sort");
        else
            $this->db->order_by("CompanyID", "DESC");
       
        $query = $this->db->get();
        $result = $query->result_array();
        if (count($result) > 0)
            return $result;
        else
            return array();
    }
  
    function update_company($company_id , $data) {
        return $this->db->update($this->Tables("companies"), $data, array("CompanyID" => $company_id));
    }
     
    function remove_company($company_id) {
        return $this->db->delete($this->Tables("companies"), array("CompanyID" => $company_id));
    }
  
    Private function Tables($table) {
        $TABLE['deals'] = 'deals';
        $TABLE['user'] = 'user';
        $TABLE['companies'] = 'companies';
        return $TABLE[$table];
    }

}
