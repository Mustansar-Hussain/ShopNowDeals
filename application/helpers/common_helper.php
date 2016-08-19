<?php

function _debug($data) {
    echo "<pre/>";
    print_r($data);
    exit(1);
}

function SessionData() {

    $CI = &get_instance();
    $userdata = $CI->session->all_userdata();
    if (!empty($userdata['logged_in'])) {
        $data['session'] = true;
        $data['logged_in'] = $userdata['logged_in'];
        $data['user_id'] = $userdata['user_id'];
        $data['user'] = $userdata['user'];
        $data['user_role'] = $userdata['user_role'];
    } else {
        $data['session'] = false;
        $data['logged_in'] = false;
    }
    return $data;
}

function is_allow_special_programs() {
    $CI = &get_instance();
    $CI->load->model("camp_model");
    $User = $CI->session->userdata("user");
    $Camp = $CI->camp_model->get_camp($User['CampID']);
    if (!empty($Camp['AllowSpecial']))
        return true;
    else
        return false;
}

function is_council() {
    $CI = & get_instance();
    if ($CI->session->userdata['user_role'] == 'Council') {
        return TRUE;
    } else {
        return FALSE;
    }
}

function is_troop() {
    $CI = & get_instance();
    if ($CI->session->userdata['user_role'] == 'Troop') {
        return TRUE;
    } else {
        return FALSE;
    }
}

function is_counselor() {
    $CI = & get_instance();
    if ($CI->session->userdata['user_role'] == 'Counselor') {
        return TRUE;
    } else {
        return FALSE;
    }
}

function is_camp_admin() {
    $CI = & get_instance();
    if ($CI->session->userdata['user_role'] == 'Camp Admin') {
        return TRUE;
    } else {
        return FALSE;
    }
}

function is_business_manager() {
    $CI = & get_instance();
    if ($CI->session->userdata['user_role'] == 'Business Manager') {
        return TRUE;
    } else {
        return FALSE;
    }
}

function is_scheduled($needle, $haystack) {
    if (count($needle) > 0) {
        foreach ($needle as $row):
            if (in_array($row['SectionID'], $haystack)) {
                return array_keys($haystack, $row['SectionID'])['0'];
                break;
            }
        endforeach;
    }
}

function is_class_prepay($class_id) {
    $CI = &get_instance();
    $CI->load->model("class_model");
    $class = $CI->class_model->get_class($class_id);
    if (!empty($class['ForcePay']))
        return true;
    else
        return false;
}

function schedule_prepay_status($schedul_id) {
    $CI = &get_instance();
    $CI->load->model("prepay_model");
    $prepay = $CI->prepay_model->get_prepay('', $schedul_id);
    if (!empty($prepay['PrepayStatus']))
        return true;
    else
        return false;
}

function council_name() {
    $CI = &get_instance();
    $CI->load->model("users_model");
    $userData = $CI->session->userdata("user");
    $Council = $CI->users_model->get_user_by_id($userData['CouncilID']);
    if (!empty($Council['Council']))
        echo $Council['Council'];
    else
        return false;
}

function is_camp_week_available() {
    $CI = &get_instance();
    $CI->load->model("campweek_model", "CampWeekModel");
    $CI->load->model("schedule_model", "ScheduleModel");
    $CI->load->model("users_model" , "UsersModel");
    $User = $CI->session->userdata("user");
    $UserData = $CI->UsersModel->get_user_by_id($User['UserID']);
     $camp_week = $CI->CampWeekModel->get_camp_week($UserData['CampWeekID']);
    if ($CI->ScheduleModel->override_class_date($camp_week, $UserData['OverrideClass']))
        return true;
    else
        return false;
}

function is_scout_naming_time_available(){
    $CI = &get_instance();
    $CI->load->model("campweek_model", "CampWeekModel");
    $CI->load->model("schedule_model", "ScheduleModel");
    $CI->load->model("users_model" , "UsersModel");
    $User = $CI->session->userdata("user");
    $UserData = $CI->UsersModel->get_user_by_id($User['UserID']);
    $camp_week = $CI->CampWeekModel->get_camp_week($UserData['CampWeekID']);
    if((todaydate() >= get_date_12pm($camp_week['SignupNameStart'])) && (todaydate() <= get_date_12pm($camp_week['SignupNameStop']) ))
        return true;
    else
        return false;
    
}

function is_class_available(){
    $CI = &get_instance();
    $CI->load->model("campweek_model", "CampWeekModel");
    $CI->load->model("schedule_model", "ScheduleModel");
    $CI->load->model("users_model" , "UsersModel");
    $User = $CI->session->userdata("user");
    $UserData = $CI->UsersModel->get_user_by_id($User['UserID']);
    $camp_week = $CI->CampWeekModel->get_camp_week($UserData['CampWeekID']);
    if(todaydate() < get_date_12pm($camp_week['ClassesStop']))
        return true;
    else
        return false;
       
}

function createDateRangeArray($strDateFrom, $strDateTo){
    
    // takes two dates formatted as YYYY-MM-DD and creates an
    // inclusive array of the dates between the from and to dates.
    // could test validity of dates here but I'm already doing
    // that in the main script
    $aryRange = array();

    $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
    $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

    if ($iDateTo >= $iDateFrom) {
        array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
        while ($iDateFrom < $iDateTo) {
            $iDateFrom+=86400; // add 24 hours
            array_push($aryRange, date('Y-m-d', $iDateFrom));
        }
    }
    return $aryRange;
}

function calculate_age($date_of_birth){
    #object oriented
    $from = new DateTime($date_of_birth);
    $to   = new DateTime('today');
    echo $from->diff($to)->y.'&nbsp;Years';
    # procedural
    //echo date_diff(date_create($from), date_create('today'))->y;
}

function get_date_12pm($date){
    
     $ans = date("Y-m-d h:i a" , strtotime('+10 hours', strtotime($date)));
     return strtotime($ans);
     
}

function todaydate(){
   return strtotime(date("Y-m-d h:i a")); 
}

function payment_status($class_status , $scout_status){
   
    if(!empty($class_status)){
       if(!empty($scout_status))
          return  "($)"; 
       else
          return  " ";
    }
}


function summary_report_status($UserType , $ForcePay  , $PaymentStatus  , $Fee){
    
    if(empty($Fee)){
       echo "Ok";
    }else if($UserType == "Leader"){
        if(!empty($PaymentStatus)){
            echo "OK";
        }else{
            echo "Reserved";
        }
    }else if($UserType == "Scout"){
        if(empty($ForcePay)){
            echo "OK";
        }else if(!empty($ForcePay) && empty($PaymentStatus)){
            echo "Reserved";
       }else if(!empty($PaymentStatus)){
           echo "Ok";
       }
    }
}

