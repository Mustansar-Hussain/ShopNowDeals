<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include('simpleimage.php');
class ManageImage{
 
 public function image($path,$image_name,$imagex,$imagey)
  {
        $final=new SimpleImage();
		$final->load($path.'temp.jpg');
               $final->resize($imagex,$imagey);
        if($final->save($path.($image_name).'.jpg'))
	   return true;	
        else
          return false;
   }
   
 }

?>