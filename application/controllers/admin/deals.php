<?php

class deals extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->_load();
        if(!$this->LoggedIn())
            redirect("admin/login");
    }
    
    function index(){
         redirect("/admin/deals/add");
    }
    
    function add(){
      
       $data['companies'] = $this->CompanyModel->get_companies();
       $this->template->load('admin_template', 'admin/add_deal',$data, "Add Deal");
    }
    
    function save_deal(){
        
       $DealName  = $this->input->post('deal_name');
       $CompanyID  = $this->input->post('CompanyID');
       $DealPrice  =  $this->input->post('DealPrice');
       $DealDiscountPercent =   $this->input->post('DealDiscountPercent');
       $DealStart  = $this->input->post('DealStart');
       $DealExpire = $this->input->post('DealExpire');
       $DealDescription =  $this->input->post('DealDescription');
       $DealData = array(
           "DealName"=>$DealName,
           "CompanyID"=>$CompanyID,
           "DealPrice"=>$DealPrice,
           "DealDiscountPercent"=>$DealDiscountPercent,
           "DealStart"=>date("Y-m-d H:i",  strtotime($DealStart)),
           "DealExpire"=>date("Y-m-d H:i",  strtotime($DealExpire)),
           "DealDescription"=>$DealDescription,
           "DealCreatedAt"=>date("Y-m-d H:i")
       ); 
       
       $deal_id  = $this->DealModel->save_deal($DealData);
       if(!empty($deal_id)){
          $extenion = $this->upload_deal_img($deal_id);
          $attachment_name =  $this->upload_deal_attch($deal_id);
          if(!empty($extenion)){
             $deal_update = array();
             $deal_update['DealImageExten'] = $extenion;
             $deal_update['DealAttachmentName'] = $attachment_name;
             $this->DealModel->update_deal($deal_id , $deal_update);
          }  
       }
       $this->session->set_flashdata('success', 'deal successfuly saved.');
       redirect('/admin'); 
       
   }
    
    function update(){
        
        
    }
   
    function save_update(){
   
    }
    
    function upload_deal_img($deal_id){
        
         $allowed_extensions = array("jpg","png");
         if(!empty($_FILES["deal_img"]["tmp_name"])>0){
             $upload_file  = $_FILES["deal_img"]["tmp_name"];
             $exten  = pathinfo($_FILES['deal_img']['name'] , PATHINFO_EXTENSION);
             $temp_file_path = FCPATH.'/uploads/';
             move_uploaded_file($_FILES["deal_img"]["tmp_name"], $temp_file_path.'temp.'.$exten);
            $path_to_save = FCPATH.'/uploads/deals/';
             if(!is_dir($path_to_save))
                mkdir ($path_to_save, 0777);
             
             $path_to_save = $path_to_save."deal_$deal_id/";
             if(!is_dir($path_to_save))
                mkdir ($path_to_save, 0777);
              
             
             $image_name = "large_img";
             $this->manageimage->image($temp_file_path , $path_to_save , $image_name, $exten  , 568  , 289);
             $image_name = "samll_1_img";
             $this->manageimage->image($temp_file_path , $path_to_save , $image_name, $exten  , 551  , 384);
             $image_name = "samll_2_img";
             $this->manageimage->image($temp_file_path , $path_to_save , $image_name, $exten  , 259  , 180);
            $temp_file_remove = $temp_file_path.'temp.'.$exten;
            if($temp_file_remove){
               unset($temp_file_remove);
            }
            return $exten;
         }else
           return false;
    }
    
    function upload_deal_attch($deal_id){
        
         if(!empty($_FILES["deal_attach"]["tmp_name"])>0){
             $upload_file  = $_FILES["deal_attach"]["tmp_name"];
             $exten  = pathinfo($_FILES['deal_attach']['name'] , PATHINFO_EXTENSION);
             $file_name = $_FILES['deal_attach']['name'];
             $path_to_save = FCPATH.'/uploads/deals/';
             if(!is_dir($path_to_save))
                mkdir ($path_to_save, 0777);
             
            $path_to_save =  $path_to_save."deal_".$deal_id."_attach/";
             if(!is_dir($path_to_save))
                mkdir ($path_to_save, 0777);
             
            move_uploaded_file($_FILES["deal_attach"]["tmp_name"], $path_to_save.$file_name);
            return $file_name;
         }else
           return false;
    }
   
    private function _load() {
       $this->load->library('manageimage');
       $this->load->model('Deals_model', "DealModel");
       $this->load->model('Company_model', "CompanyModel");
      
       
    }
    
    
}
