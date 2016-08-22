<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include('simpleimage.php');
class ManageImage{
 
 public function image($temp_path , $path_to_save , $image_name, $image_exten ,$imagex,$imagey)
 {  
        $final = new SimpleImage();
        $final->load($temp_path.'temp.'.$image_exten);
        $final->resize($imagex,$imagey);
        if($final->save($path_to_save.($image_name).'.'.$image_exten))
           return true;	
        else
          return false;
   }
   
 }

?>