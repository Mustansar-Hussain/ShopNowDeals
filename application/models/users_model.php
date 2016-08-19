<?php

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
   
    /**
     * Validate the login's data with the database
     * @param string $user_name
     * @param string $password
     * @return Boolean
     */
    function validate($user_name, $password) {
        $Users = $this->Tables("users");
        $UserRole = $this->Tables("user_role");
        $Roles = $this->Tables("roles");
        $Address = $this->Tables("address");
        $Troop = $this->Tables("troop");
        $this->db->select("$Users.* , $Users.CampID AS UserCampID , $Users.UserID  AS CUserID , $Roles.* , $Address.* ,$Troop.* , $Address.Council AS  Council ");
        $this->db->where('Username', $user_name);
        $this->db->where('Password', $password);
        $this->db->from($Users);
        $this->db->join($UserRole, "$UserRole.UserID = $Users.UserID", 'left');
        $this->db->join($Roles, "$Roles.RoleID = $UserRole.RoleID", 'left');
        $this->db->join($Address, "$Address.UserID = $UserRole.UserID", 'left');
        $this->db->join($Troop, "$Troop.UserID = $Users.UserID", 'left');
        $result = $this->db->get();
        if ($result->num_rows == 1) {
            $UserData = $result->result_array()['0'];
            $this->session->set_userdata("user", $UserData);
            $data['session'] = true;
            $this->session->set_userdata("logged_in", true);
            $this->session->set_userdata("user_id", $UserData['CUserID']);
            $this->session->set_userdata("user_role", $UserData['RoleName']);
            if (is_council())
                $this->session->set_userdata("council_id", $UserData['CUserID']);
            else if (is_troop())
                $this->session->set_userdata("council_id", $UserData['CouncilID']);
            else if (is_camp_admin()){
                $this->session->set_userdata("council_id", $UserData['CouncilID']);
                $this->session->set_userdata("camp_id", $UserData['UserCampID']);
            }else if(is_business_manager()){
                 $this->session->set_userdata("council_id", $UserData['CouncilID']);
            }
            return true;
        } else
            return false;
    }

    function is_unique($user_name = '', $email = '', $camp_id = '', $user_id = '' , $CampWeekID ='') {
      
        $USERS = $this->Tables("users");
        $ADDRESS = $this->Tables("address");
        $TROOP = $this->Tables("troop");
        $this->db->select("$USERS.*");
        $this->db->from($USERS);
        $this->db->join($TROOP, "$TROOP.UserID = $USERS.UserID", "LEFT");
        $this->db->join($ADDRESS, "$ADDRESS.UserID = $USERS.UserID", "LEFT");
        if ($user_name != '')
            $this->db->where("$USERS.Username", $user_name);
        if ($email != '')
            $this->db->where("$ADDRESS.Email", $email);
        if ($CampWeekID != '')  
            $this->db->where("$TROOP.CampWeekID", $CampWeekID);
        
        if($camp_id != '')
           $this->db->where("$TROOP.CampID", $camp_id);
        $result = $this->db->get();
        $result = $result->result_array();
        if (!empty($user_id)) {
            if (count($result) > 0 && $result['0']['UserID'] == $user_id)
                return false;
            else if (count($result) > 0)
                return true;
        }else {
            if (count($result) > 0)
                return true;
            else
                return false;
        }
    }

    function is_unique_councillor($user_name = '', $email = '', $council_id, $user_id = '') {
       
        $USERS = $this->Tables("users");
        $ADDRESS = $this->Tables("address");
        $this->db->select("$USERS.*");
        $this->db->from($USERS);
        $this->db->join($ADDRESS, "$ADDRESS.UserID = $USERS.UserID", "LEFT");
        if ($user_name != '')
            $this->db->where("$USERS.Username", $user_name);
        if ($email != '')
            $this->db->where("$ADDRESS.Email", $email);
        if($council_id != '')  
          $this->db->where("$USERS.CouncilID", $council_id);
       
        $result = $this->db->get();
        $result = $result->result_array();
        if (!empty($user_id)) {
            if (count($result) > 0 && $result['0']['UserID'] == $user_id)
                return false;
            else if (count($result) > 0)
                return true;
        }else {
            if (count($result) > 0)
                return true;
            else
                return false;
        }
    }
   
    function save_user($data) {
        $this->db->set('CreatedAt', 'NOW()', FALSE);
        $this->db->insert($this->Tables("users"), $data);
        return $this->db->insert_id();
    }

    function update_user($user_id, $data) {
        $this->db->set('CreatedAt', 'NOW()', FALSE);
        return $this->db->update($this->Tables("users"), $data, array("UserID" => $user_id));
    }

    function get_user_by_id($user_id) {
       
        $USERS = $this->Tables("users");
        $USERROLE = $this->Tables("user_role");
        $ROLE = $this->Tables("roles");
        $Address = $this->Tables("address");
        $TROOP = $this->Tables("troop");
        $this->db->select("$USERS.* , $USERS.CampID AS CCAMPID , $USERS.UserID AS CUserID ,  $TROOP.CampID , $TROOP.OverrideLogin ,  $TROOP.OverrideClass ,$TROOP.CampWeekID , $Address.Email , $Address.QuickPhone , $Address.Address1 , $Address.Address2 ,$Address.Council ,  $Address.city , $Address.state , $Address.zip_code , $Address.FirstName , $Address.LastName , $Address.EmergencyName , $Address.EmergencyPhone , $Address.Dob ,  $ROLE.RoleName , $ROLE.RoleParentID  AS ParentID , (SELECT `RoleName` FROM `$ROLE` WHERE $ROLE.RoleID = ParentID ) AS ParentRoleName ");
        $this->db->from($USERS);
        $this->db->join($USERROLE, "$USERROLE.UserID = $USERS.UserID", "LEFT");
        $this->db->join($ROLE, "$ROLE.RoleID = $USERROLE.RoleID", "LEFT");
        $this->db->join($Address, "$Address.UserID = $USERS.UserID", "LEFT");
        $this->db->join($TROOP, "$TROOP.UserID = $USERS.UserID", "LEFT");
        $this->db->where("$USERS.UserID", $user_id);
        $query = $this->db->get();
        $result = $query->result_array();
        if (count($result) > 0) {
            return $result['0'];
        } else
            return array();
    }

    function get_troop_schedule_users($troop_id) {
         
        $troop_participants = array();
        $USERS = $this->Tables("users");
        $USERROLE = $this->Tables("user_role");
        $ROLE = $this->Tables("roles");
        $Address = $this->Tables("address");
        $this->db->select("$USERS.* , $USERS.UserID AS CUserID , $Address.FirstName , $Address.LastName , $ROLE.RoleName , $ROLE.RoleParentID  AS ParentID , (SELECT `RoleName` FROM `$ROLE` WHERE $ROLE.RoleID = ParentID ) AS ParentRoleName ");
        $this->db->from($USERS);
        $this->db->join($USERROLE, "$USERROLE.UserID = $USERS.UserID", "LEFT");
        $this->db->join($ROLE, "$ROLE.RoleID = $USERROLE.RoleID", "LEFT");
        $this->db->join($Address, "$Address.UserID = $USERS.UserID", "LEFT");
        $this->db->where("$USERS.TroopID", $troop_id);
        $this->db->where("$Address.FirstName !=", "");
        $this->db->where("$Address.LastName !=", "");
        
        $this->db->order_by("ParentRoleName", "DESC");
        $this->db->order_by("$Address.FirstName", "ASC");
        
        $query = $this->db->get();
        $result = $query->result_array();
        if (count($result) > 0) {
            foreach ($result as $user):
                $troop_participants[$user['ParentRoleName']][] = $user;
            endforeach;
            return $troop_participants;
        } else
            return array();
    }

    function get_troop_participants($troop_id) {
       
        $troop_participants = array();
        $USERS = $this->Tables("users");
        $USERROLE = $this->Tables("user_role");
        $ROLE = $this->Tables("roles");
        $Address = $this->Tables("address");
        $this->db->select("$USERS.* , $USERS.UserID AS CUserID , $Address.FirstName , $Address.LastName  , $Address.EmergencyName ,$Address.EmergencyPhone , $ROLE.RoleName , $ROLE.RoleParentID  AS ParentID , (SELECT `RoleName` FROM `$ROLE` WHERE $ROLE.RoleID = ParentID ) AS ParentRoleName");
        $this->db->from($USERS);
        $this->db->join($USERROLE, "$USERROLE.UserID = $USERS.UserID", "LEFT");
        $this->db->join($ROLE, "$ROLE.RoleID = $USERROLE.RoleID", "LEFT");
        $this->db->join($Address, "$Address.UserID = $USERS.UserID", "LEFT");
        $this->db->where("$USERS.TroopID", $troop_id);
        $this->db->order_by("$Address.FirstName","ASC");
        $query = $this->db->get();
        $result = $query->result_array();
        if (count($result) > 0){
            return $result;
        } else
            return array();
    }
   
    function get_councillors($council_id ,$limit = false, $start = 0, $count = 10 , $camp_id = '') {
        $USERS = $this->Tables("users");
        $USERROLE = $this->Tables("user_role");
        $ROLE = $this->Tables("roles");
        $Address = $this->Tables("address");
        $this->db->select("$USERS.* , $USERS.UserID AS CUserID , $Address.FirstName , $Address.LastName  , $Address.Email , $Address.QuickPhone , $Address.EmergencyName ,$Address.EmergencyPhone , $ROLE.RoleName , $ROLE.RoleParentID  AS ParentID , (SELECT `RoleName` FROM `$ROLE` WHERE $ROLE.RoleID = ParentID ) AS ParentRoleName ");
        $this->db->from($USERS);
        $this->db->join($USERROLE, "$USERROLE.UserID = $USERS.UserID", "LEFT");
        $this->db->join($ROLE, "$ROLE.RoleID = $USERROLE.RoleID", "LEFT");
        $this->db->join($Address, "$Address.UserID = $USERS.UserID", "LEFT");
        $this->db->where("$USERS.CouncilID", $council_id);
        if($camp_id != '')
           $this->db->where("$USERS.CampID", $camp_id);
        
        $this->db->where("$ROLE.RoleName", "Counselor");
        if ($limit)
            $this->db->limit($count, $start);
        $query = $this->db->get();
        $result = $query->result_array();
        if (count($result) > 0)
            return $result;
        else
            return array();
    }
   
    function get_troop_participants_dropdown($troop_id , $scout_id = '') {
        $participants = $this->UsersModel->get_troop_schedule_users($troop_id);
        if(empty($scout_id)){
            $html = ' <option value="">Choose Participant...</option>';
            foreach ($participants as $key => $participant):
                foreach ($participant as $row):
                    if(!empty($scout_id) && $scout_id == $row['UserID'])
                       $html .= "<option value=" . $key . "_" . $row['UserID'] . " selected='selected'>" . $key . ":&nbsp;&nbsp;" . $row['FirstName'] . "&nbsp;,&nbsp;" . $row['LastName'] . "</option>";
                   else
                      $html .= "<option value=" . $key . "_" . $row['UserID'] . ">" . $key . ":&nbsp;&nbsp;" . $row['FirstName'] . "&nbsp;,&nbsp;" . $row['LastName'] . "</option>"; 
                  endforeach;
            endforeach;
            return $html;
        }else if(!empty ($scout_id)){
          return $participants;
        }
    }
    
    function get_councillor_dropdown($council_id , $councillor_id = '' , $section_id = '' , $camp_week_id =''  , $camp_id =''){
        
        $response = array();
        $councillors   = $this->get_councillors($council_id , "" , "" , "" , $camp_id);
        $is_counselor_has_activities = false;
        if(!empty($councillor_id) && !empty($section_id) && !empty($camp_week_id)){
           $scount_attendance  = $this->get_attendance($section_id ,  $camp_week_id , $councillor_id);
           if(!empty($scount_attendance) && count($scount_attendance)>0)
              $is_counselor_has_activities = true;
           
           $scout_requirements = $this->get_requirement('' , $camp_week_id , $section_id  , $councillor_id);
           if(!empty($scout_requirements) && count($scout_requirements)>0)
              $is_counselor_has_activities = true; 
        }
        
        
        $html = ' <option value="">Choose Counselor...</option>';
        foreach ($councillors as $row):
            if(!empty($councillor_id) && $councillor_id == $row['UserID'])
                $html .= "<option value=".$row['UserID']. " selected='true'>" .$row['FirstName'].'&nbsp;'.$row['LastName']. "</option>";
            else
                $html .= "<option value=".$row['UserID']. ">" .$row['FirstName'].'&nbsp;'.$row['LastName']. "</option>";
         endforeach;
         
        $response['html'] = $html;
        $response['is_counselor_has_activities'] = $is_counselor_has_activities;
        return $response;
        
    }
    
    function check_counselor_status($council_id , $councillor_id = '' , $section_id = '' , $camp_week_id =''){
        
        $response = array();
        $councillors   = $this->get_councillors($council_id);
        $is_counselor_has_activities = false;
        if(!empty($councillor_id) && !empty($section_id) && !empty($camp_week_id)){
           $scount_attendance  = $this->get_attendance($section_id ,  $camp_week_id , $councillor_id);
           if(!empty($scount_attendance) && count($scount_attendance)>0)
              $is_counselor_has_activities = true;
            
           $scout_requirements = $this->get_requirement('' , $camp_week_id , $section_id  , $councillor_id);
           if(!empty($scout_requirements) && count($scout_requirements)>0)
              $is_counselor_has_activities = true; 
        }
        
        if(!empty($is_counselor_has_activities))
           return true;
        else
          return false;
    }
    
    function remove($UserID){
        $this->db->delete($this->Tables("users"),array("UserID"=>"$UserID"));
        $this->db->delete($this->Tables("address"),array("UserID"=>"$UserID"));
        $this->db->delete($this->Tables("user_role"),array("UserID"=>"$UserID"));
        $this->db->delete($this->Tables("troop"),array("UserID"=>"$UserID"));
        return true;
    }
    
    function remove_scout($UserID , $TroopData , $scout_type){
       
        $this->db->delete($this->Tables("users"),array("UserID"=>"$UserID"));
        $this->db->delete($this->Tables("address"),array("UserID"=>"$UserID"));
        $this->db->delete($this->Tables("user_role"),array("UserID"=>"$UserID"));
        if(strtolower(trim($scout_type)) == "leader"){
           if(!empty($TroopData['LeaderSlots'])){
               $TroopData['LeaderSlots'] = $TroopData['LeaderSlots'] - 1;
               $this->db->update($this->Tables("troop") , array("LeaderSlots"=>$TroopData['LeaderSlots']) , array("UserID"=>$TroopData['UserID']));
           }
         }else if(strtolower(trim($scout_type)) == "scout"){
           if(!empty($TroopData['ScoutsSlots'])){
               $TroopData['ScoutsSlots'] = $TroopData['ScoutsSlots'] -1;
               $this->db->update($this->Tables("troop") , array("ScoutsSlots"=>$TroopData['ScoutsSlots']) , array("UserID"=>$TroopData['UserID']));
           }
        }
        return true;
    }
    
    function test(){
        
        $SQL = "SELECT DISTINCT  troop.TroopPassword , users.Username , camp.CampName , campweek.CampPretty FROM troop 
LEFT JOIN users on users.UserID=troop.UserID
LEFT JOIN camp ON camp.CampID = troop.CampID
LEFT JOIN campweek ON campweek.CampWeekID = troop.CampWeekID
Order By camp.CampName ASC";
        $query  = $this->db->query($SQL);
        $result = $query->result_array();
        return $result;
    }
    
    function add_data($data){
         $this->db->insert("export_test",$data);
    }
    
    function get_attendance($class_id = '',  $camp_week_id = '' , $counselor_id ='' , $user_id = '' ){
        $ATTENDANCE = $this->Tables("attendance");
        $this->db->select("*");
        $this->db->from($ATTENDANCE);
        if($class_id != '')
           $this->db->where("$ATTENDANCE.ClassID", $class_id);
        if($camp_week_id != '')
           $this->db->where("$ATTENDANCE.CampWeekID", $camp_week_id);
        if($counselor_id != '')
           $this->db->where("$ATTENDANCE.CouncillorID", $counselor_id);
        if($user_id != '')
          $this->db->where("$ATTENDANCE.UserID", $user_id);  
        //$this->db->where("$ATTENDANCE.Date", date("Y-m-d"));
        $query = $this->db->get();
        //echo $this->db->last_query();
        //exit(1);
        
        $result = $query->result_array();
        if (count($result) > 0)
            return $result;
        else
            return array();
    }
    
    function get_requirement($class_Name = '' , $camp_week_id ='' , $section_id ='' , $counselor_id ='' , $scout_id ='' ){
       
         $this->db->distinct();
         $this->db->select('*');
         $this->db->from($this->Tables("class_scouts_requirements"));
         if($class_Name != '')
            $this->db->where("ClassName",$class_Name);
         if($camp_week_id != '')
            $this->db->where("CampWeekID",$camp_week_id);   
         if($section_id != '')
            $this->db->where("SectionID" , $section_id);   
         if($counselor_id != '')
            $this->db->where("CounselorID" , $counselor_id); 
         if($scout_id != '')
            $this->db->where("ScoutID" , $scout_id); 
          
         $query  = $this->db->get(); 
         $result = $query->result_array();
         if(count($result)>0)
            return $result;
         else
            return  array(); 
    }
    
    function get_user_pasword($user_id){
        $this->db->select('UserPassword');
        $this->db->from($this->Tables("users"));
        $this->db->where("UserID",$user_id);
        $query   = $this->db->get();
        $result = $query->result_array();
        if(!empty($result['0']['UserPassword']))
           return  base64_decode ($result['0']['UserPassword']);
        else
          return false;
    }
    
    function get_camp_admins($council_id , $limit = false, $start = 0, $count = 10) {
       
        $USERS = $this->Tables("users");
        $USERROLE = $this->Tables("user_role");
        $ROLE = $this->Tables("roles");
        $Address = $this->Tables("address");
        $this->db->select("$USERS.* , $USERS.UserID AS CUserID , $Address.FirstName , $Address.LastName  , $Address.Email , $Address.QuickPhone , $Address.EmergencyName ,$Address.EmergencyPhone , $ROLE.RoleName , $ROLE.RoleParentID  AS ParentID , (SELECT `RoleName` FROM `$ROLE` WHERE $ROLE.RoleID = ParentID ) AS ParentRoleName ");
        $this->db->from($USERS);
        $this->db->join($USERROLE, "$USERROLE.UserID = $USERS.UserID", "LEFT");
        $this->db->join($ROLE, "$ROLE.RoleID = $USERROLE.RoleID", "LEFT");
        $this->db->join($Address, "$Address.UserID = $USERS.UserID", "LEFT");
        $this->db->where("$USERS.CouncilID", $council_id);
        if($camp_id != '')
           $this->db->where("$USERS.CampID", $camp_id);
        
        $this->db->where("$ROLE.RoleName", "Camp Admin");
        if ($limit)
            $this->db->limit($count, $start);
        $query = $this->db->get();
        $result = $query->result_array();
        if (count($result) > 0)
            return $result;
        else
            return array();
    }
    
     function get_business_managers($council_id , $limit = false, $start = 0, $count = 10) {
         
        $USERS = $this->Tables("users");
        $USERROLE = $this->Tables("user_role");
        $ROLE = $this->Tables("roles");
        $Address = $this->Tables("address");
        $this->db->select("$USERS.* , $USERS.UserID AS CUserID , $Address.FirstName , $Address.LastName  , $Address.Email , $Address.QuickPhone , $Address.EmergencyName ,$Address.EmergencyPhone , $ROLE.RoleName , $ROLE.RoleParentID  AS ParentID , (SELECT `RoleName` FROM `$ROLE` WHERE $ROLE.RoleID = ParentID ) AS ParentRoleName ");
        $this->db->from($USERS);
        $this->db->join($USERROLE, "$USERROLE.UserID = $USERS.UserID", "LEFT");
        $this->db->join($ROLE, "$ROLE.RoleID = $USERROLE.RoleID", "LEFT");
        $this->db->join($Address, "$Address.UserID = $USERS.UserID", "LEFT");
        $this->db->where("$USERS.CouncilID", $council_id);
        if($camp_id != '')
           $this->db->where("$USERS.CampID", $camp_id);
       
        $this->db->where("$ROLE.RoleName", "Business Manager");
        if ($limit)
            $this->db->limit($count, $start);
        $query = $this->db->get();
        $result = $query->result_array();
        if (count($result) > 0)
            return $result;
        else
            return array();
    }
    
    
    function search_scouts($camp_week_id , $first_name = ''  , $last_name = ''){
        
        $USERS = $this->Tables("users");
        $USERROLE = $this->Tables("user_role");
        $ROLE = $this->Tables("roles");
        $Address = $this->Tables("address");
        $TROOP = $this->Tables("troop");
        $this->db->select("$USERS.UserID , $USERS.TroopID ,  $Address.FirstName , $Address.LastName ,  $TROOP.CampWeekID , $TROOP.TroopIDStr , $TROOP.UnitNum , $ROLE.RoleParentID  AS ParentID , (SELECT `RoleName` FROM `$ROLE` WHERE $ROLE.RoleID = ParentID ) AS ParentRoleName ");
        $this->db->from($USERS);
        $this->db->join($Address, "$Address.UserID = $USERS.UserID", "LEFT");
        $this->db->join($USERROLE, "$USERROLE.UserID = $USERS.UserID", "LEFT");
        $this->db->join($ROLE, "$ROLE.RoleID = $USERROLE.RoleID", "LEFT");
        $this->db->join($TROOP, "$TROOP.UserID = $USERS.TroopID", "LEFT");
        $this->db->where("$TROOP.CampWeekID", $camp_week_id);
        $this->db->where("$USERS.TroopID !=", '0');
        $this->db->where("$Address.FirstName !=", '');
        $this->db->where("$Address.LastName !=", '');
        if($first_name != '')
           $this->db->like("$Address.FirstName", $first_name);
        if($last_name != '')
           $this->db->like("$Address.LastName", $last_name);
        
        //$this->db->order_by("$TROOP.UnitNum" , "ASC");
        $this->db->order_by("$Address.FirstName" , "ASC");
        
        $query = $this->db->get();
        
        $result = $query->result_array();
        if (count($result) > 0) {
            return $result;
        } else
            return array();
        
    }
    
    
    
    Private function Tables($table) {
        $TABLE['users'] = 'users';
        $TABLE['roles'] = 'roles';
        $TABLE['user_role'] = 'user_role';
        $TABLE['address'] = 'address';
        $TABLE['troop'] = 'troop';
        $TABLE['attendance'] = 'attendance';
        $TABLE['class_scouts_requirements'] = 'class_scouts_requirements';
        return $TABLE[$table];
    }

}
