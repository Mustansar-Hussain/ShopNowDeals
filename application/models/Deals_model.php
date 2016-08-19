<?php

class Deals_model extends CI_Model {
   
    function __construct() {
        parent::__construct();
    }

    function save_deal($data) {

        $Deals = $this->Tables("deals");
        if ($this->db->insert($Deals, $data))
            return $this->db->insert_id();
        else
            return false;
    }

    function get_deals($deal_id = '', $limit = false, $start = 0, $count = 10, $order_by = '', $sort = 'ASC') {

        $Deals = $this->Tables("deals");
        $Companies = $this->Tables("companies");
        
        $this->db->select("$Deals.* , $Companies.CompanyName");
        $this->db->from($Deals);
        $this->db->join($Companies, "$Companies.CompanyID = $Deals.CompanyID", "LEFT");
        if ($deal_id != '')
            $this->db->where("$Deals.DealID", $deal_id);
        if ($limit)
            $this->db->limit($count, $start);
        if ($order_by != '')
            $this->db->order_by("$order_by", "$sort");
        else
            $this->db->order_by("$Deals.DealID", "DESC");

        $query = $this->db->get();
        $result = $query->result_array();
        if (count($result) > 0)
            return $result;
        else
            return array();
    }

    function update_deal($deal_id, $data) {
        return $this->db->update($this->Tables("deals"), $data, array("DealID" => $deal_id));
    }

    function remove_deal($deal_id) {
        return $this->db->delete($this->Tables("deals"), array("DealID" => $deal_id));
    }

    Private function Tables($table) {
        $TABLE['deals'] = 'deals';
        $TABLE['user'] = 'user';
        $TABLE['companies'] = 'companies';
        return $TABLE[$table];
    }

}